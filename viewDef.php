<?php
include('session.php');
include('html_functions/bootstrapGrid.php');
include('html_functions/htmlFuncs.php');
include('html_components/defComponents.php');
include('sql_functions/stmtBindResultArray.php');
include('error_handling/sqlErrors.php');

if (isset($_GET['defID'])) $defID = filter_input(INPUT_GET, 'defID');
elseif (isset($_GET['bartDefID'])) $defID = filter_input(INPUT_GET, 'bartDefID');
else $defID = null;

$role = $_SESSION['role'];
$title = "SVBX - Deficiency No. " . $defID;
include('filestart.php');

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

if (isset($_GET['defID']) && $_GET['defID']) {
    $link = f_sqlConnect();
    $sql = file_get_contents("viewDef.sql").$defID;

    try {
        if (!$stmt = $link->prepare("SELECT closureRequested, closureRequestedBy from CDL where defID = ?"))
            throw new mysqli_sql_exception($link->error);
            
        if (!$stmt->bind_param('i', $defID))
            throw new mysqli_sql_exception($stmt->error);
    
        if (!$stmt->execute())
            throw new mysqli_sql_exception($stmt->error);
    
        $closureRequested = stmtBindResultArray($stmt)[0]['closureRequested'];
            
        $stmt->close();
            
        if (!$stmt = $link->prepare($sql)) throw new mysqli_sql_exception($link->error);

        if (!$stmt->execute()) throw new mysqli_sql_exception($stmt->error);

        if (!$stmt->bind_result(
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
                $updatedBy,
                $Created_by,
                $Comments,
                $RequiredBy,
                $contract,
                $Repo,
                $ClosureComments,
                $DueDate,
                $SafetyCert,
                $defType)) throw new mysqli_sql_exception($stmt->error);

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
                'Closure Information',
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
                    sprintf($labelStr, $updatedBy)
                ]
            ];

            if ($Status == "Open") {
                $color = "bg-red text-white";
            } else {
                $color = "bg-success text-white";
            }
            echo "
                <header class='container page-header'>
                    <h1 class='page-title $color pad'>Deficiency No. $defID</h1>";
                    if ($closureRequested) {
                        echo "<h4 class='bg-yellow text-light pad-less'>Closure requested</h4>";
                    }
            echo "
                </header>
                <main class='container main-content'>";
            foreach ([$requiredRows, $optionalRows, $closureRows] as $rowGroup) {
                $rowName = array_shift($rowGroup);
                $content = iterateRows($rowGroup);
                printSection($rowName, $content);
            }
        }

        $stmt->close();

        // query for comments associated with this Def
        $sql = "SELECT firstname, lastname, date_created, cdlCommText
            FROM cdlComments c
            JOIN users_enc u
            ON c.userID=u.userID
            WHERE c.defID=?
            ORDER BY c.date_created DESC";

        if (!$stmt = $link->prepare($sql))
            throw new mysqli_sql_exception($link->error);

        if (!$stmt->bind_param('i', $defID))
            throw new mysqli_sql_exception($stmt->error);

        if (!$stmt->execute())
            throw new mysqli_sql_exception($stmt->error);

        $comments = stmtBindResultArray($stmt) ?: [];

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

        if (count($comments)) {
            print returnCollapseSection(
                'Comments',
                'comments',
                returnCommentsHTML($comments)
            );
        }

        print returnCollapseSection(
            'Modification History',
            'modHistory',
            iterateRows($modHistory)
        );

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
        }

        // if Role has permission level show Update and Clone buttons
        if($role > 10) {
            echo "
                <div class='row item-margin-botom'>
                    <div class='col-12 center-content'>
                        <a href='updateDef.php?defID=$defID' class='btn btn-primary btn-lg'>Update</a>
                        <a href='cloneDef.php?defID=$defID' class='btn btn-primary btn-lg'>Clone</a>
                    </div>
                </div>";
        }
        echo "</main>";
    } catch (Exception $e) {
        print "Unable to retrieve record: $e";
        exit;
    } finally {
        $link->close();
        include('fileend.php');
        exit;
    }
} elseif (isset($_GET['bartDefID']) && $_GET['bartDefID']) {
    $link = f_sqlConnect();
    // check for bartdl permission
    if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['userID'])) {
        if ($row = $result->fetch_row()) {
            $bdPermit = $row[0];
        }
        $result->close();
    }
    if ($bdPermit) {
        // render View for bartDef
        $result = [];
        // query for attachments and render them as a list of links
        $attachments = getAttachments($link, $defID);
        $attachmentList = renderAttachmentsAsAnchors($attachments);
        $attachmentDisplay =
            $vtaElements['bartdlAttachments']['label']
            .sprintf($vtaElements['bartdlAttachments']['element'], $attachmentList);

        // build SELECT query string from sql file
        $fieldList = preg_replace('/\s+/', '', file_get_contents('bartdl.sql'))
            .',form_modified';
        // replace ambiguous or JOINED keys
        $fieldList = str_replace('updated_by', 'BARTDL.updated_by AS updated_by', $fieldList);
        $fieldList = str_replace('status', 's.statusName AS status', $fieldList);
        $fieldList = str_replace('agree_vta', 'ag.agreeDisagreeName AS agree_vta', $fieldList);
        $fieldList = str_replace('creator', 'c.partyName AS creator', $fieldList);
        $fieldList = str_replace('next_step', 'n.nextStepName AS next_step', $fieldList);
        $sql = 'SELECT '
            .$fieldList
            ." FROM BARTDL"
            ." JOIN status s ON BARTDL.status=s.statusID"
            ." JOIN agreeDisagree ag ON BARTDL.agree_vta=ag.agreeDisagreeID"
            ." JOIN bdParties c ON BARTDL.creator=c.partyID"
            ." JOIN bdNextStep n ON BARTDL.next_step=n.bdNextStepID"
            ." WHERE BARTDL.id=?";

        if ($stmt = $link->prepare($sql)) {
            if (!$stmt->bind_param('i', $defID)) printSqlErrorAndExit($stmt, $sql);

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

            if (!$stmt->bind_param('i', $defID)) printSqlErrorAndExit($stmt, $sql);

            if (!$stmt->execute()) printSqlErrorAndExit($stmt, $sql);

            $comments = stmtBindResultArray($stmt) ?: [];

            $stmt->close();

            if($result['status'] === "Closed") {
                $color = "bg-success text-white";
            } else {
                $color = "bg-red text-white";
            }

            echo "
                <header class='container page-header'>
                    <h1 class='page-title $color pad'>Deficiency No. $defID</h1>
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
                    <a href='updateBartDef.php?bartDefID=$defID' class='btn btn-primary btn-lg'>Update</a>
                </div>
            </main>";
            // print "<header class='page-header'><h4 class='text-success'>&darr; BART def view will go here &darr;</h4></header>";
        } else printSqlErrorAndExit($link, $sql);
    }
    $link->close();
    include('fileend.php');
    exit;
} else {
    echo "<h1 class='text-secondary'>No deficiency number found</h1>";
}
