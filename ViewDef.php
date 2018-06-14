<?php
include('session.php');
include('html_functions/bootstrapGrid.php');
include('html_functions/htmlFuncs.php');
include('sql_functions/stmtBindResultArray.php');
include('error_handling/sqlErrors.php');
$defID = $_GET['defID'];
$bartDefID = $_GET['bartDefID'];
$Role = $_SESSION['Role'];
$title = "SVBX - Deficiency No".$defID;
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('filestart.php'); 
$link = f_sqlConnect();

// $spanStr = "<span>%s</span>";
$labelStr = "<p>%s</p>";
$checkbox = [
    'element' => "<input type='checkbox' value='1' class='x-checkbox' disabled %s>",
    'value' => ''
];
$fakeInputStr = "<p class='mb-0 full-width pad-less thin-grey-border border-radius fake-input'>%s</p>";
$emptyFakeInputStr = "<p class='full-width pad-less thin-grey-border border-radius grey-bg fake-input'>%s</p>";

function returnFakeInputStr($val) {
    $str = "<span class='d-block full-width pad-less thin-grey-border border-radius'>%s</span>";
    $altStr = "<span class='d-block full-width pad-less thin-grey-border border-radius grey-bg fake-input'>%s</span>";
    return returnHtmlForVal($val, $str, $altStr);
}

function iterateRows(array $rowGroup, $title) {
    print "<h5 class='grey-bg pad'>$title</h5>";
    foreach ($rowGroup as $row) {
        $options = count($row) === 1 ? ['colWd' => 6] : [];
        print returnRow($row, $options);
    }
}

if ($defID) {
    $sql = file_get_contents("ViewDef.sql").$defID;
    
    if($stmt = $link->prepare($sql)) {
        $stmt->execute();  
        $stmt->bind_result(
                $OldID, 
                $Location, 
                $SpecLoc, 
                $Severity, 
                $Description, 
                $Spec, 
                $DateCreated, 
                $Status, 
                $IdentifiedBy, 
                $SystemAffected, 
                $GroupToResolve, 
                $ActionOwner, 
                $EvidenceType, 
                $EvidenceLink, 
                $DateClosed, 
                $LastUpdated, 
                $Updated_by, 
                $Created_by, 
                $Comments,
                $RequiredBy,
                $contract,
                $Repo,
                $ClosureComments,
                $DueDate,
                $SafetyCert,
                $defType);  
        while ($stmt->fetch()) {
            $requiredRows = [
                'Required Information',
                [
                    sprintf($labelStr, 'Safety Certifiable'),
                    sprintf($fakeInputStr, $SafetyCert),
                    sprintf($labelStr, 'System Affected'),
                    sprintf($fakeInputStr, $SystemAffected)
                ],
                [
                    sprintf($labelStr, 'General Location'),
                    sprintf($fakeInputStr, $Location),
                    sprintf($labelStr, 'Specific Location'),
                    sprintf($fakeInputStr, stripcslashes($SpecLoc))
                ],
                [
                    sprintf($labelStr, 'Status'),
                    sprintf($fakeInputStr, $Status),
                    sprintf($labelStr, 'Severity'),
                    sprintf($fakeInputStr, $Severity)
                ],
                [
                    sprintf($labelStr, 'Due Date'),
                    sprintf($fakeInputStr, $DueDate),
                    sprintf($labelStr, 'Group to resolve'),
                    sprintf($fakeInputStr, $GroupToResolve)
                ],
                [
                    sprintf($labelStr, 'Resolution required by'),
                    sprintf($fakeInputStr, $RequiredBy),
                    sprintf($labelStr, 'Contract'),
                    sprintf($fakeInputStr, $contract)
                ],
                [
                    sprintf($labelStr, 'Identified By'),
                    sprintf($fakeInputStr, stripcslashes($IdentifiedBy)),
                    sprintf($labelStr, 'Deficiency type'),
                    sprintf($fakeInputStr, $defType)
                ],
                [
                    sprintf($labelStr, 'Deficiency description').sprintf($fakeInputStr, stripcslashes($Description))
                ]
            ];
            
            $optionalRows = [
                'Optional Information',
                [
                    sprintf($labelStr, 'Spec or Code'),
                    returnFakeInputStr(stripcslashes($Spec)),
                    sprintf($labelStr, 'Action Owner'),
                    returnFakeInputStr(stripcslashes($ActionOwner)),
                    sprintf($labelStr, 'Old Id'),
                    returnFakeInputStr(stripcslashes($OldID))
                ],
                [
                    sprintf($labelStr, 'More information').returnFakeInputStr(stripcslashes($Comments))
                ]
            ];
            
            $closureRows = [
                'Clouser Information',
                [
                    sprintf($labelStr, 'Evidence Type'),
                    returnFakeInputStr($EvidenceType),
                    sprintf($labelStr, 'Evidence Repository'),
                    returnFakeInputStr($Repo),
                    sprintf($labelStr, 'Repository No.'),
                    returnFakeInputStr(stripcslashes($EvidenceLink))
                ],
                [
                    sprintf($labelStr, 'Closure comments').returnFakeInputStr(stripcslashes($ClosureComments))
                ]
            ];
            
            $modHistory = [
                'Modification History',
                [
                    sprintf($labelStr, 'Date Created'),
                    sprintf($labelStr, $DateCreated),
                    sprintf($labelStr, 'Created by'),
                    sprintf($labelStr, $Created_by)
                ],
                [
                    sprintf($labelStr, 'Last Updated'),
                    sprintf($labelStr, $LastUpdated),
                    sprintf($labelStr, 'Updated by'),
                    sprintf($labelStr, $Updated_by)
                ]
            ];
    
            if($Status == "Open") {
                $color = "bg-red text-white";
            } else {
                $color = "bg-success text-white"; 
            }
            echo "
                <header class='container page-header'>
                    <h1 class='page-title $color pad'>Deficiency No. $defID</h1>
                </header>
                <main class='container main-content'>";
                    foreach ([$requiredRows, $optionalRows, $closureRows, $modHistory] as $rowGroup) {
                        $rowName = array_shift($rowGroup);
                        iterateRows($rowGroup, $rowName);
                    }
                    // iterateRows($requiredRows, 'Required Information');
                    // <h5 class='grey-bg pad'>Required Information</h5>";
                    // foreach ($requiredRows as $gridRow) {
                    //     $options = count($gridRow) === 1 ? ['colWd' => 6] : [];
                    //     print returnRow($gridRow, $options);
                    // }
                    // print "<h5 class='grey-bg pad'>Optional Information</h5>";
                    // foreach ($optionalRows as $gridRow) {
                    //     $options = count($gridRow) === 1 ? ['colWd' => 6] : [];
                    //     print returnRow($gridRow, $options);
                    // }
                    // print "<h5 class='grey-bg pad'>Closure Information</h5>";
                    // foreach ($closureRows as $gridRow) {
                    //     $options = count($gridRow) === 1 ? ['colWd' => 6] : [];
                    //     print returnRow($gridRow, $options);
                    // }
                    // print "<h5 class='grey-bg pad'>Modification Details</h5>";
                    // foreach ($modHistory as $gridRow) {
                    //     $options = count($gridRow) === 1 ? ['colWd' => 6] : [];
                    //     print returnRow($gridRow, $options);
                    // }
        }
        $stmt->close();
        
        // show photos linked to this Def
        if ($stmt = $link->prepare("SELECT pathToFile FROM CDL_pics WHERE defID=?")) {
            $stmt->bind_param('i', $defID);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pathToFile);
            
            if ($count = $stmt->num_rows) {
                $collapseCtrl = "<h5 class='grey-bg pad'><a data-toggle='collapse' href='#defPics' role='button' aria-expanded='false' aria-controls='defPics' class='collapsed'>Photos<i class='typcn typcn-arrow-sorted-down'></i></a></h5>";
                $photoSection = sprintf("%s<section id='defPics' class='collapse item-margin-bottom'>", $collapseCtrl)."%s</section>";
                $curRow = "<div class='row item-margin-bottom'>%s</div>";
            
                $i = 0;
                $j = 1;
                while ($stmt->fetch()) {
                    $img = sprintf("<img src='%s' alt='photo related to deficiency number %s'>", $pathToFile, $defID);
                    $col = sprintf("<div class='col-md-4 text-center item-margin-bottom'>%s</div>", $img);
                    $marker = $j < $count ? '%s' : '';
                    
                    if ($i < 2) {
                        // if this is not 3rd col in row, append an extra format marker '%s' after col
                        $curRow = sprintf($curRow, $col.$marker);
                        // if this is the last photo in resultset, append row to section
                        if ($j >= $count) {
                            $photoSection = sprintf($photoSection, $curRow);
                        }
                        $i++;
                    }
                    // if this is 3rd col in row append row to section
                    else {
                        // if this is not the last photo is resultset append a str format marker, '%s', to row before appending row to section
                        $curRow = sprintf($curRow, $col).$marker;
                        $photoSection = sprintf($photoSection, $curRow);
                        // reset row string
                        $curRow = "<div class='row item-margin-bottom'>%s</div>";
                        $i = 0;
                    }
                    $j++;
                }
                echo $photoSection;
            }
            $stmt->close();
        } else {
            printSqlErrorAndExit($link, $sql);
        }
        // if Role has permission level show Update and Clone buttons
        if($Role == 'S' OR $Role == 'A' OR $Role == 'U') {
            echo "
                <div style='display: flex; align-items: center; justify-content: center; hspace:20; margin-bottom:3rem'>
                    <a href='UpdateDef.php?defID=$defID' class='btn btn-primary btn-lg'>Update</a>
                    <form action='CloneDef.php' method='POST' onsubmit='' style='text-align:center'>
                        <div style='width:5px; height:auto; display:inline-block'></div>
                        <input type='hidden' name='defID' value='$defID'/>
                        <input type='submit' value='Clone' class='btn btn-primary btn-lg'  />
                    </form>
                </div>";
        }
        echo "</main>";
    } else {  
        printSqlErrorAndExit($link, $sql);
    } 
} elseif ($bartDefID) {
    include('html_components/defComponents.php');
    // check for bartdl permission
    if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['UserID'])) {
        if ($row = $result->fetch_row()) {
            $bdPermit = $row[0];
        }
        $result->close();
    }
    if ($bdPermit) {
        // render View for bartDef
        $result = [];
        $comments = [];
        // query for attachments and render then as a list of links
        $attachments = getAttachments($link, $bartDefID);
        $attachmentList = renderAttachmentsAsAnchors($attachments);
        $attachmentDisplay =
            $vtaElements['bartdlAttachments']['label']
            .sprintf($vtaElements['bartdlAttachments']['element'], $attachmentList);

        // build SELECT query string from sql file
        $fieldList = preg_replace('/\s+/', '', file_get_contents('bartdl.sql'))
            .',form_modified';
        // replace ambiguous or JOINED keys
        $fieldList = str_replace('updated_by', 'BARTDL.updated_by AS updated_by', $fieldList);
        $fieldList = str_replace('status', 's.status AS status', $fieldList);
        $fieldList = str_replace('agree_vta', 'ag.agreeDisagreeName AS agree_vta', $fieldList);
        $fieldList = str_replace('creator', 'c.partyName AS creator', $fieldList);
        $fieldList = str_replace('next_step', 'n.nextStepName AS next_step', $fieldList);
        $sql = 'SELECT '
            .$fieldList
            ." FROM BARTDL"
            ." JOIN Status s ON BARTDL.status=s.statusID"
            ." JOIN agreeDisagree ag ON BARTDL.agree_vta=ag.agreeDisagreeID"
            ." JOIN bdParties c ON BARTDL.creator=c.partyID"
            ." JOIN bdNextStep n ON BARTDL.next_step=n.bdNextStepID"
            ." WHERE BARTDL.id=?";
        
        if ($stmt = $link->prepare($sql)) {
            if (!$stmt->bind_param('i', $bartDefID)) printSqlErrorAndExit($stmt, $sql);
            
            if (!$stmt->execute()) printSqlErrorAndExit($stmt, $sql);
            
            $result = stmtBindResultArray($stmt)[0];
            
            function validateFormatDate($dateStr, $inputFormat, $outputFormat, $nullChar = '—') {
                return (
                    strtotime($dateStr) <= 0
                        ? $nullChar
                        : DateTime::createFromFormat($inputFormat, $dateStr)->format($outputFormat)
                );
            }
            
            function formatOpenCloseDate($dateStr) {
                $inputFormat = 'Y-m-d';
                $outputFormat = 'd/m/Y';
                return validateFormatDate($dateStr, $inputFormat, $outputFormat);
            }
            
            $dateOpen = formatOpenCloseDate($result['dateOpen_bart']);
            $dateClosed = formatOpenCloseDate($result['dateClose_bart']);
            
            $commentFormat = "
                <div class='thin-grey-border pad mb-3'>
                    <h6 class='d-flex flex-row justify-content-between text-secondary'><span>%s</span><span>%s</span></h6>
                    <p>%s</p>
                </div>";
    
            $generalFields = [
                [
                    [
                        [ sprintf($labelStr, 'ID'), sprintf($fakeInputStr, $result['id']) ],
                        [ sprintf($labelStr, 'Creator'), sprintf($fakeInputStr, $result['creator']) ],
                        [ sprintf($labelStr, 'Next step'), sprintf($fakeInputStr, $result['next_step']) ],
                        [ sprintf($labelStr, 'BIC'), sprintf($fakeInputStr, $result['bic']) ],
                        [ sprintf($labelStr, 'Status'), sprintf($fakeInputStr, $result['status']) ]
                    ],
                    [
                        [ sprintf($labelStr, 'Descriptive').sprintf($fakeInputStr, stripcslashes($result['descriptive_title_vta'])) ]
                    ]
                ]
            ];
        
            $vtaFields = [
                'Root_Prob_VTA' => [ sprintf($labelStr, 'Root problem').sprintf($labelStr, sprintf($fakeInputStr, stripcslashes($result['root_prob_vta']))) ],
                'Resolution_VTA' => [ sprintf($labelStr, 'Resolution').sprintf($labelStr, sprintf($fakeInputStr, stripcslashes($result['resolution_vta']))) ],
                [
                    [
                        [ sprintf($labelStr, 'Priority'), sprintf($fakeInputStr, $result['priority_vta']) ],
                        [ sprintf($labelStr, 'Agree'), sprintf($fakeInputStr, $result['agree_vta']) ],
                        [ sprintf($labelStr, 'Safety Certifiable'), sprintf($fakeInputStr, $result['safety_cert_vta']) ],
                        [
                            checkboxLabel('resolution_disputed', 'Resolution disputed').returnCheckboxInput(['value' => $result['resolution_disputed']] + $checkbox),
                            checkboxLabel('structural', 'Structural').returnCheckboxInput(['value' => $result['structural']] + $checkbox)
                        ]
                    ],
                    [
                        [ $attachmentDisplay ]
                    ]
                ]
            ];
        
            $bartFields = [
                'BART ID' => [
                    returnRow([ sprintf($labelStr, 'BART ID').sprintf($fakeInputStr, stripcslashes($result['id_bart'])) ]),
                ],
                'Description' => [
                    returnRow([ sprintf($labelStr, 'Description').sprintf($fakeInputStr, stripcslashes($result['description_bart'])) ])
                ],
                [
                    returnRow([ sprintf($labelStr, 'Cat1'), sprintf($fakeInputStr, $result['cat1_bart']) ]).
                    returnRow([ sprintf($labelStr, 'Cat2'), sprintf($fakeInputStr, $result['cat2_bart']) ]).
                    returnRow([ sprintf($labelStr, 'Cat3'), sprintf($fakeInputStr, $result['cat3_bart']) ]),
                    returnRow([ sprintf($labelStr, 'Level'), sprintf($fakeInputStr, $result['level_bart']) ]).
                    returnRow([ sprintf($labelStr, 'Date open'), sprintf($fakeInputStr, $dateOpen) ]).
                    returnRow([ sprintf($labelStr, 'Date closed'), sprintf($fakeInputStr, $dateClosed) ])
                ]
            ];
        
            $stmt->close();
            
            // query for comments associated with this Def
            $sql = "SELECT firstname, lastname, date_created, bdCommText
                FROM bartdlComments bdc
                JOIN users_enc u
                ON bdc.userID=u.userID
                WHERE bartdlID=?
                ORDER BY date_created DESC";
            
            if (!$stmt = $link->prepare($sql)) printSqlErrorAndExit($link, $sql);
            
            if (!$stmt->bind_param('i', $bartDefID)) printSqlErrorAndExit($stmt, $sql);
            
            if (!$stmt->execute()) printSqlErrorAndExit($stmt, $sql);
            
            $comments = stmtBindResultArray($stmt) ?: [];
            
            $stmt->close();

            if($result['status'] === "Closed") {
                $color = "bg-success text-white";
            } else {
                $color = "bg-red text-white";
            }
            
            print "
                <header class='container page-header'>
                    <h1 class='page-title $color pad'>Deficiency No. $bartDefID</h1>
                </header>
                <main class='container main-content'>";
            foreach ($generalFields as $gridRow) {
                print returnRow($gridRow);
            }
            print "<h5 class='grey-bg pad'>VTA Information</h5>";
            foreach ($vtaFields as $gridRow) {
                print returnRow($gridRow);
            }
            print "<h5 class='grey-bg pad'>BART Information</h5>";
            foreach ($bartFields as $gridRow) {
                print returnRow($gridRow);
            }
            
            if (count($comments)) {
                print "<h5 class='grey-bg pad'>Comments</h5>";
                foreach ($comments as $comment) {
                    $timestamp = strtotime($comment['date_created']) - (60 * 60 * 7);
                    
                    printf(
                        $commentFormat,
                        $comment['firstname'].' '.$comment['lastname'],
                        date('j/n/Y • g:i a', $timestamp),
                        stripcslashes($comment['bdCommText'])
                    );
                }
            }
            
            print "
                <div class='center-content'>
                    <a href='updateBartDef.php?bartDefID=$bartDefID' class='btn btn-primary btn-lg'>Update</a>
                </div>
            </main>";
            // print "<header class='page-header'><h4 class='text-success'>&darr; BART def view will go here &darr;</h4></header>";
        } else printSqlErrorAndExit($link, $sql);
    }
}
include('fileend.php');
$link->close(); 
?>