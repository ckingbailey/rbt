<?php
include('session.php');
include('html_components/defComponents.php');
include('html_functions/bootstrapGrid.php');
include('sql_functions/stmtBindResultArray.php');

$title = "SVBX - Update Deficiency";
$role = $_SESSION['Role'];
$defID = $_GET['defID'];

// prepare sql statement
$fieldList = preg_replace('/\s+/', '', file_get_contents('UpdateDef.sql'));
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');

// replace fields that reference other tables with JOINs
$fieldsArr['safetyCert'];

$link = f_sqlConnect();

include('filestart.php');

try {
    $sql = 'SELECT ' . $fieldList . ' FROM CDL WHERE defID = ?';

    $elements = $requiredElements + $optionalElements + $closureElements;
    
    if (!$stmt = $link->prepare($sql)) throw new mysqli_sql_exception($link->error);
    
    if (!$stmt->bind_param('i', intval($defID))) throw new mysqli_sql_exception($stmt->error);

    if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
    
    if (!stmtBindResultArrayRef($stmt, $elements))
        throw new mysqli_sql_exception($stmt->error);
        
    $stmt->close();
    
    // query for comments associated with this Def
    $sql = "SELECT firstname, lastname, date_created, cdlCommText
        FROM cdlComments c
        JOIN users_enc u
        ON c.userID=u.userID
        WHERE c.defID=?
        ORDER BY c.date_created DESC";
        
    if (!$stmt = $link->prepare($sql)) throw new mysqli_sql_exception($link->error);
    
    if (!$stmt->bind_param('i', $defID)) throw new mysqli_sql_exception($stmt->error);
    
    if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);
    
    $comments = stmtBindResultArray($stmt) ?: [];
    
    $stmt->close();
    
    // query for photos linked to this Def
    if (!$stmt = $link->prepare("SELECT pathToFile FROM CDL_pics WHERE defID=?"))
        throw new mysqli_sql_exception($link->error);
        
    if (!$stmt->bind_param('i', $defID))
        throw new mysqli_sql_exception($stmt->error);
        
    if (!$stmt->execute())
        throw new mysqli_sql_exception($stmt->error);
        
    if (!$stmt->store_result())
        throw new mysqli_sql_exception($stmt->error);
        
    $photos = stmtBindResultArray($stmt);
    
    $stmt->close();
        
    $toggleBtn = '<a data-toggle=\'collapse\' href=\'#%1$s\' role=\'button\' aria-expanded=\'false\' aria-controls=\'%1$s\' class=\'collapsed\'>%2$s<i class=\'typcn typcn-arrow-sorted-down\'></i></a>';
            
    $requiredRows = [
        [
            $elements['safetyCert'],
            $elements['systemAffected']
        ],
        [
            $elements['location'],
            $elements['specLoc']
        ],
        [
            $elements['status'],
            $elements['severity']
        ],
        [
            $elements['dueDate'],
            $elements['groupToResolve']
        ],
        [
            $elements['requiredBy'],
            $elements['contractID']
        ],
        [
            $elements['identifiedBy'],
            $elements['defType']
        ],
        [
            $elements['description']
        ]
    ];
            
    $optionalRows = [
        [
            $elements['spec'],
            $elements['actionOwner']
        ],
        [
            $elements['oldID'],
            $elements['CDL_pics']
        ]
    ];
            
    $closureRows = [
        [
            $elements['evidenceType'],
            $elements['repo'],
            $elements['evidenceLink']
        ],
        [
            $elements['closureComments']
        ]
    ];
    
    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Update Deficiency ".$defID."</h1>
        </header>
        <main class='container main-content'>
        <form action='UpdateDefCommit.php' method='POST' enctype='multipart/form-data' onsubmit='' class='item-margin-bottom'>
            <input type='hidden' name='defID' value='$defID'>
            <div class='row'>
                <div class='col-12'>
                    <h4 class='pad grey-bg'>Deficiency No. $defID</h4>
                </div>
            </div>";
                        
            foreach ($requiredRows as $gridRow) {
                $options = [ 'required' => true ];
                if (count($gridRow) > 1) $options['inline'] = true;
                else $options['colWd'] = 6;
                print returnRow($gridRow, $options);
            }
                
        echo "
            <h5 class='grey-bg pad'>
                <a data-toggle='collapse' href='#optionalInfo' role='button' aria-expanded='false' aria-controls='optionalInfo' class='collapsed'>Optional Information<i class='typcn typcn-arrow-sorted-down'></i></a>
            </h5>
            <div id='optionalInfo' class='collapse item-margin-bottom'>";
            foreach ($optionalRows as $gridRow) {
                $options = [ 'required' => true ];
                if (count($gridRow) > 1) $options['inline'] = true;
                else $options['colWd'] = 6;
                print returnRow($gridRow, $options);
            }
        echo "
                <p class='text-center pad-less bg-yellow'>Photos uploaded from your phone may not preserve rotation information. We are working on a fix for this.</p>
            </div>
            <h5 class='grey-bg pad'>
                <a data-toggle='collapse' href='#closureInfo' role='button' aria-expanded='false' aria-controls='closureInfo' class='collapsed'>Closure Information<i class='typcn typcn-arrow-sorted-down'></i></a>
            </h5>
            <div id='closureInfo' class='collapse item-margin-bottom'>";
            foreach ($closureRows as $gridRow) {
                $options = [ 'required' => true ];
                if (count($gridRow) > 1) $options['inline'] = true;
                else $options['colWd'] = 6;
                print returnRow($gridRow, $options);
            }
        echo "
            </div>
            <h5 class='grey-bg pad'>";
        printf($toggleBtn, 'comments', 'Comments');
        echo "
            </h5>
            <div id='comments' class='collapse item-margin-bottom'>";
        echo returnRow([ $optionalElements['cdlCommText'] ], [ 'colWd' => 8 ]);
            foreach ($comments as $comment) {
                $userFullName = $comment['firstname'].' '.$comment['lastname'];
                $text = stripcslashes($comment['cdlCommText']);
                printf($commentFormat, $userFullName, $comment['date_created'], $text);
            }
        echo "</div>";
            
        if (count($photos)) {
            print returnCollapseSection(
                'Photos',
                'defPics',
                returnPhotoSection(
                    $photos,
                    "<img src='%s' alt='photo related to deficiency number {$defID}'>"
                ),
                'item-margin-bottom'
            );
            // $collapseCtrl = "<h5 class='grey-bg pad'><a data-toggle='collapse' href='#defPics' role='button' aria-expanded='false' aria-controls='defPics' class='collapsed'>Photos<i class='typcn typcn-arrow-sorted-down'></i></a></h5>";
            // $photoSection = sprintf("%s<section id='defPics' class='collapse item-margin-bottom'>", $collapseCtrl) . "%s</section>";
            // $curRow = "<div class='row item-margin-bottom'>%s</div>";
        
            // $i = 0;
            // $j = 1;
            // foreach ($photos as $photo) {
            //     $img = sprintf("<img src='%s' alt='photo related to deficiency number %s'>", $photo['pathToFile'], $defID);
            //     $col = sprintf("<div class='col-md-4 text-center item-margin-bottom'>%s</div>", $img);
            //     $marker = $j < $count ? '%s' : '';
                
            //     if ($i < 2) {
            //         // if this is not 3rd col in row, append an extra format marker '%s' after col
            //         $curRow = sprintf($curRow, $col.$marker);
            //         // if this is the last photo in resultset, append row to section
            //         if ($j >= $count) {
            //             $photoSection = sprintf($photoSection, $curRow);
            //         }
            //         $i++;
            //     }
            //     // if this is 3rd col in row append row to section
            //     else {
            //         // if this is not the last photo is resultset append a str format marker, '%s', to row before appending row to section
            //         $curRow = sprintf($curRow, $col).$marker;
            //         $photoSection = sprintf($photoSection, $curRow);
            //         // reset row string
            //         $curRow = "<div class='row item-margin-bottom'>%s</div>";
            //         $i = 0;
            //     }
            //     $j++;
            // }
            // echo $photoSection;
        }
        
        echo "
            <div class='row item-margin-bottom'>
                <div class='col-12 center-content'>
                    <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
                    <button type='reset' class='btn btn-primary btn-lg'>Reset</button>
                </div>
            </div>
        </form>";
    if ($role === 'S') {
        echo "
            <form action='DeleteDef.php' method='POST' onsubmit=''>
                <div class='row'>
                    <div class='col-12 center-content'>
                        <button class='btn btn-danger btn-lg' type='submit' name='q' value='$defID'
                            onclick='return confirm(`ARE YOU SURE? Deficiencies should not be deleted, your deletion will be logged.`)'>delete</button>
                    </div>
                </div>
            </form>";
    }
    echo "</main>";
} catch (Exception $e) {
    print "Unable to retrieve record";
    $link->close();
    exit;
}
$link->close();
include('fileend.php');
