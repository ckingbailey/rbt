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
    
    $userID = $_SESSION['UserID'];
    $userQry = 'SELECT Username FROM users_enc WHERE UserID = '.$userID;

    // why do we need this if Username is already stored in $_SESSION(?)
    if ($result = $link->query($userQry)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['Username'];
        }
    }

    // check for existing submission
    $check = "SELECT idrID, idrDate, locationID FROM $idrTable WHERE (idrDate='{$_POST['idrDate']}') AND (userID={$_POST['userID']}) AND (locationID={$_POST['locationID']}";
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
            if ($post[$key]) {
                $idrData[$key] = $post[$key];
            }
            // destroy in idrData any key=>val pair not in result
            else unset($idrData[$key]);
            // destroy in $post any key found in result
            unset($post[$key]);
        }
    
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
    
        // this is the block that does actually executes the INSERT query
        if ($result = $link->query($query)) {
            http_response_code(201);
            $code = http_response_code();
            $newIdrID = $link->insert_id;
            // grab new ID and attach it to equip, labor, activity data
            $laborData = [];
            $equipData = [];
            $actData = [];
            foreach ($post as $key => $val) {
                if (strpos($key, 'labor') !== false || strpos($key, 'equip') !== false) {
                    $num = intval(substr($key, strpos($key, '_') + 1));
                    // there shouldn't be any equipOrLabor keys submitted, but if one is found, rm it
                    if (strpos($key, 'equipOrLabor') !== false) unset($post[$key]);
                    elseif (strpos($key, 'labor') !== false) {
                        // assign 'labor' vals to 'labor' keys @ num
                        $laborKey = substr($key, 0, strpos($key, '_'));
                        $laborData[$num][$laborKey] = $val;
                        $laborData[$num]['idrID'] = $newIdrID;
                    } else {
                        // assign 'equip' vals to 'equip' keys @ num
                        $equipKey = substr($key, 0, strpos($key, '_'));
                        $equipData[$num][$equipKey] = $val;
                        $equipData[$num]['idrID'] = $newIdrID;
                    }
                    // and unset $key from $post
                     unset($post, $key);
                } elseif (strpos($key, 'act') !== false) {
                // assign 'act' vals to 'act' keys @ actNum
                    // num following 1st '_' in $key is resource number (labor or equip)
                    $rsrcNum = intval(substr($key, strpos($key, '_') + 1));
                    // num following 2nd '_' in $key is activity number for that resource
                    $actNum = intval(substr($key, strpos($key, '_', strpos($key, '_') + 1) + 1));
                    $actKey = substr($key, 0, strpos($key, '_'));
                    $actData[$rsrcNum][$actNum][$actKey] = $val;
                    $actData[$rsrcNum][$actNum]['idrID'] = $newIdrID;
                    // I'll have to append laborID or equipID after INSERT and retrieval of insert_key
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
                                } else ;//printQryErr($actQry, $link->error);
                            }
                        } else continue;
                    } else ;//printQryErr($query, $link->error);
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
                                } else ;//printQryErr($actQry, $link->error);
                            }
                        } else continue;
                    } else ;//printQryErr($query, $link->error);
                }
            }
            http_response_code(201);
            $code = http_response_code();
            echo "new record created: Inspector's Daily Report #{$newIdrID}\n{$timestamp}";
        } else {
            http_response_code(500);
            $code = http_response_code();
        }
    }
    $typeOfUserID = gettype($_POST['userID']);
    $typeOfIdrDate = gettype($_POST['idrDate']);
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
