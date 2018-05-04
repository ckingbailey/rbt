<?php
    include('SQLFunctions.php');
    session_start();
    
    $post = $_POST;
    $idrTable = 'IDR';
    $equipTable = 'equipment';
    $laborTable = 'labor';
        $equipActLink = 'equipAct_link';
        $laborActLink = 'laborAct_link';
    $actTable = 'activity';
    $link = f_sqlConnect();
    $timestamp = date('Y-m-d H:i:s');
    $editableUntil = new DateTime($timestamp);
    // an IDR is editable until 1 AM on the day after its creation
    $editableUntil->
        setDate($editableUntil->format('Y'), $editableUntil-> format('m'), $editableUntil->format('j') + 1)->
        setTime('00', '59', '59');
    
    $userID = $_SESSION['UserID'];


    // check for existing submission
    $check = "SELECT idrID, idrDate, LocationID FROM $idrTable WHERE (idrDate='{$_POST['idrDate']}') AND (UserID={$_POST['UserID']}) AND (LocationID={$_POST['LocationID']}";
    $result = $link->query($check);
    
    if ($result) {
        while ($row = $result->fetch_array() > 0) {
            http_response_code(409);
            $code = http_response_code();
            echo "duplicate record found: record # {$row[0]}, record date: {$row[1]}, locationID: {$row[2]}";
        }
    } else {
        // if no dupe, handle POST data
        
        // first, qry IDR column names, store them as keys of an array
        $query = 'SHOW COLUMNS FROM '.$idrTable;
        $result = $link->query($query);
        while($row = $result->fetch_assoc()){
            $key = $row['Field'];
            // if POST data key name matches column name from IDR table, save value to idrData array
            if ($post[$key]) {
                $idrData[$key] = $post[$key];
            }
            // destroy in $post any key found in result
            unset($post[$key]);
        }
        
        // append editableUntil to $idrData;
        $idrData['editableUntil'] = $editableUntil->format($editableUntil::W3C);
        if (!isset($idrData['UserID'])) $idrData['UserID'] = $userID;
    
        $keys = implode(", ", array_keys($idrData));
        $vals = implode("', '", array_values($idrData));
    
        // currently this fcn, found in SQLFunctions, is broken
        // don't repair it unless you're ready to deal with the bugs that may produce
        if (!f_tableExists($link, $idrTable, DB_Name)) {
        // shouldn't this be an error handler like the duplicate check above(?)
            echo 'table "'.$idrTable.'" could not be found';
        } else {
        // create INSERT query
            $query = "INSERT INTO $idrTable ($keys) VALUES ('$vals')";
        }
    
        // this is the block that actually executes the INSERT query
        if ($result = $link->query($query)) {
            http_response_code(201);
            $code = http_response_code();
            $newIdrID = $link->insert_id;
            // grab new ID and attach it to equip, labor, activity data
            $laborData = [];
            $equipData = [];
            $actData = [];
            // test for comment and insert if present
            if ($comment = $post['comment']) {
                $commentQry = "INSERT idrComments (userID, comment, idrID)
                    VALUES ('{$_POST['UserID']}', '{$_POST['comment']}', '{$newIdrID}')";
                if ($result = $link->query($commentQry)) {
                    http_response_code(201);
                    $code = http_response_code();
                }
                else {
                    http_response_code(500);
                    $code = http_response_code();
                    echo "There was a problem adding your comment";
                    return;
                }
            }
            foreach ($post as $key => $val) {
                // parse flattened POST data to nested arrays
                // first, check for labor and equip keys
                if (strpos($key, 'labor') !== false || strpos($key, 'equip') !== false) {
                    $num = intval(substr($key, strpos($key, '_') + 1));
                    // there shouldn't be any equipOrLabor keys submitted, but if one is found, rm it
                    if (strpos($key, 'equipOrLabor') !== false) unset($post[$key]);
                    elseif (strpos($key, 'labor') !== false) {
                        // if key includes 'Location', grab the 'Location...' part of the string
                        if (strpos($key, 'Location') !== false) {
                            $key = substr($key, strpos($key, 'Location'));
                        }
                        // assign 'labor' vals to 'labor' keys @ array[num]
                        // clean '_$num' out of any numbered $key
                        $laborKey = substr($key, 0, strpos($key, '_'));
                        $laborData[$num][$laborKey] = $val;
                        // if idrID is not set, set it
                        if (!isset($laborData[$num]['idrID'])) {
                            $laborData[$num]['idrID'] = $newIdrID;
                        }
                        // unset $key from $post once it's parsed to array
                        unset($post, $key);
                    } else {
                        // if key includes 'Location', grab the 'Location...' part of the string
                        if (strpos($key, 'Location') !== false) {
                            $key = substr($key, strpos($key, 'Location'));
                        }
                        // assign 'equip' vals to 'equip' keys @ array[num]
                        // clean '_$num' out of any numbered $key
                        $equipKey = substr($key, 0, strpos($key, '_'));
                        $equipData[$num][$equipKey] = $val;
                        $equipData[$num]['idrID'] = $newIdrID;
                        // unset $key from $post once it's parsed to array
                        // unset $key from $post once it's parsed to array
                        unset($post, $key);
                    }
                }
                // next, check for act keys
                elseif (strpos($key, 'act') !== false || strpos($key, 'numResources') !== false) {
                    // assign 'act' vals to 'act' keys @ array[actNum]
                    // num following 1st '_' in $key is resource number (labor or equip)
                    $rsrcNum = intval(substr($key, strpos($key, '_') + 1, strpos($key, '_', strpos($key, '_') + 1) - (strpos($key, '_') + 1)));
                    // num following 2nd '_' in $key is activity number for that resource
                    $actNum = intval(substr($key, strpos($key, '_', strpos($key, '_') + 1) + 1));
                    $actKey = substr($key, 0, strpos($key, '_'));
                    $actData[$rsrcNum][$actNum][$actKey] = $val;
                    $actData[$rsrcNum][$actNum]['idrID'] = $newIdrID;
                    unset($post, $val);
                    // link laborID or equipID to activityID after INSERT and retrieval of insert_key
                } else {
                    continue;
                }
            }
            // build labor & equipment queries
            if (count($laborData)) {
                // foreach labor data, find associated activity data & parse it to array
                foreach ($laborData as $index => $subarr) {
                    $keys = implode(", ", array_keys($subarr));
                    $vals = implode("', '", array_values($subarr));
                    $query = "INSERT INTO $laborTable ($keys) VALUES ('$vals')";
                    // once data is parsed & committed, rm it from data array
                    unset($laborData[$index]);
                    // after successful INSERT, unset $key, grab insert_key
                    if ($result = $link->query($query)) {
                        http_response_code(201);
                        $code = http_response_code();
                        // store db ID of new record
                        $newLaborID = $link->insert_id;
                        // build queries from activities that fall within same index as labor
                        if (count($actData[$index])) {
                            foreach ($actData[$index] as $key => $val) {
                                $actKeys = implode(", ", array_keys($val));
                                $actVals = implode("', '", array_values($val));
                                $actQry = "INSERT INTO $actTable ($actKeys) VALUES ('$actVals')";
                                if ($result = $link->query($actQry)) {
                                    // each activity in the db will be ref'd by a linking table
                                    $linkQry = "INSERT INTO $laborActLink (laborID, activityID) VALUES ('$newLaborID', '$link->insert_id')";
                                    if ($result = $link->query($linkQry)) {
                                    } else ;//printQryErr($linkQry, $link->error);
                                } else {
                                    http_response_code(500);
                                    error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error, 0);
                                    error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error."\n", 3, '../error_log.log');
                                    echo __FILE__.': '.__LINE__.': '.$link->error;
                                    return;
                                }
                            }
                        } else continue;
                    } else {
                        http_response_code(500);
                        error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error, 0);
                        error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error."\n", 3, '../error_log.log');
                        echo __FILE__.': '.__LINE__.': '.$link->error;
                        return;
                    }
                }
            }
            if (count($equipData)) {
                // foreach equip data, find associated activity data & parse it to array
                foreach ($equipData as $index => $subarr) {
                    $keys = implode(", ", array_keys($subarr));
                    $vals = implode("', '", array_values($subarr));
                    $query = "INSERT INTO $equipTable ($keys) VALUES ('$vals')";
                    // once data is parsed & committed, rm it from data array
                    unset($equipData[$index]);
                    // after successful INSERT, unset $key, grab insert_key
                    if ($result = $link->query($query)) {
                        http_response_code(201);
                        $code = http_response_code();
                    // store db ID of new record
                        $newEquipID = $link->insert_id;
                    // build queries from activities that fall within same index as equip
                        if (count($actData[$index])) {
                            foreach ($actData[$index] as $key => $val) {
                                $actKeys = implode(", ", array_keys($val));
                                $actVals = implode("', '", array_values($val));
                                $actQry = "INSERT INTO $actTable ($actKeys) VALUES ('$actVals')";
                                if ($result = $link->query($actQry)) {
                                    // each activity in the db will be ref'd by a linking table
                                    $linkQry = "INSERT INTO $equipActLink (equipID, activityID) VALUES ('$newEquipID', '$link->insert_id')";
                                    if ($result = $link->query($linkQry)) {
                                    } else ;//printQryErr($linkQry, $link->error);
                                } else {
                                    http_response_code(500);
                                    error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error, 0);
                                    error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error."\n", 3, '../error_log.log');
                                    echo __FILE__.': '.__LINE__.': '.$link->error;
                                    return;
                                }
                            }
                        } else continue;
                    } else {
                        http_response_code(500);
                        error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error, 0);
                        error_log(__FILE__.': '.__LINE.': '.http_response_code().': '.$link->error."\n", 3, '../error_log.log');
                        echo __FILE__.': '.__LINE__.': '.$link->error;
                        return;
                    }
                }
            }
            http_response_code(201);
            header("Location: /idr.php?idrID={$newIdrID}");
            $code = http_response_code();
            echo "new record created: Inspector's Daily Report #{$newIdrID}\nhttps://{$_SERVER['HTTP_HOST']}/idr.php?idrID={$newIdrID}\n{$timestamp}";
        } else {
            http_response_code(500);
            $code = http_response_code();
        }
    }
?>
<?php
// this is all stuff for testing
// pls destroy before deploy
function echoAs2OLs($arr1, $arr2) {
    echo "
        <div style='display: flex; flex-flow: row nowrap;'>
        <ol start='0'>";
            foreach ($arr1 as $key) {
                echo "<li>$key</li>";
            }
    echo "
        </ol>
        <ol start='0'>";
            foreach ($arr2 as $val) {
                echo "<li>$val</li>";
            }
    echo "
        </ol>
        </div>
    ";
}

function picker($str, $arr) {
    foreach ($arr as $key => $el) {
        if (strpos($str, $key) !== false) {
            return $el;
        }
    }
}

function printQueryStr($q) {
    $colors = [
        'labor' => 'magenta',
        'equip' => 'green',
        'act' => 'goldenrod',
        '_link' => 'cyan'
    ];
    $color = picker($q, $colors);
    echo "<p style='margin: .125rem 0; font-size: .9rem; color: $color'>$q</p>";
}

function printQrySuccess($q, $res) {
    echo "<p style='margin: .125rem 0; font-weight: 700; color: royalBlue'>Success! new record, $res, created for query: $q</p>";
}

function printQryErr($q, $e) {
    echo "
    <div style='font-family: monospace'>
        <h1 style='margin: .25rem 0; color: red'>Houston, we have a problem:</h1>
        <h3 style='margin: .25rem 0;'>$q</h3>
        <h3 style='margin: .25rem 0;'>$e</h3>
    </div>";
}
?>
