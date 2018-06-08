<?php
include('session.php');
include('html_functions/bootstrapGrid.php');
include('sql_functions/stmtBindResultArray.php');
include('error_handling/sqlErrors.php');

$title = "SVBX - Update BART Deficiency";

$defID = $_GET['bartDefID'];
$fieldList = file_get_contents('bartdl.sql');
$fieldsArr = array_fill_keys(explode(',', $fieldList), '?');
$fieldList = implode(',', array_keys($fieldsArr));

$link = f_sqlConnect();

if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['UserID'])) {
    if ($row = $result->fetch_row()) {
        $bdPermit = $row[0];
    }
    $result->close();
}

include('filestart.php');

$sql = "SELECT $fieldList FROM BARTDL WHERE id=$defID";

if ($stmt = $link->prepare($sql)) {
    // echo "
    //     <div style='margin-top: 3.5rem; color: darkCyan'>
    //         <p>$sql</p>";
    if ($stmt->execute()) {
        if ($result = stmtBindResultArray($stmt)[0]) {
            $labelStr = "<label for='%s'%s>%s</label>";
            $required = " class='required'";
            $commentFormat = "
                <div class='thin-grey-border pad mb-3'>
                    <h6 class='d-flex flex-row justify-content-between text-secondary'><span>%s</span><span>%s</span></h6>
                    <p>%s</p>
                </div>";

            function returnLabel($for, $text, $required = '', $str = "<label for='%s'%s>%s</label>") {
                $required && $requiredAttr = " class='required'";
                return sprintf($str, $for, $requiredAttr, $text);
            }


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
            
            $topFields = [
                'row1' => [
                    'col1' => [
                        'options' => [ 'inline' => true ],
                        [
                            [
                                'label' => returnLabel('creator', 'Creator', 'required'),
                                'tagName' => 'select',
                                'element' => "<select name='creator' id='creator' class='form-control' required>%s</select>",
                                'value' => $result['creator'],
                                'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID"
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('next_step', 'Next step'),
                                'tagName' => 'select',
                                'element' => "<select name='next_step' id='next_step' class='form-control'>%s</select>",
                                'query' => 'SELECT bdNextStepID, nextStepName FROM bdNextStep ORDER BY bdNextStepID',
                                'value' => $result['next_step']
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('bic', 'Ball in court'),
                                'tagName' => 'select',
                                'element' => "<select name='bic' id='bic' class='form-control'>%s</select>",
                                'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID",
                                'value' => $result['bic']
                            ]
                        ]
                    ],
                    'descriptive_title_vta' => [
                        'label' => sprintf($labelStr, 'descriptive_title_vta', $required, 'Description'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='descriptive_title_vta' id='descriptive_title_vta' class='form-control' required>".stripcslashes($result['descriptive_title_vta'])."</textarea>",
                        'query' => null
                    ]
                ]
            ];
        
            $vtaFields = [
                'row1' => [
                    'root_prob_vta' => [
                        'label' => sprintf($labelStr, 'root_prob_vta', $required, 'Root problem'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='root_prob_vta' id='root_prob_vta' class='form-control' required>".stripcslashes($result['root_prob_vta'])."</textarea>",
                        'query' => null
                    ]
                ],
                'row2' => [
                    'resolution_vta' => [
                        'label' => sprintf($labelStr, 'resolution_vta', $required, 'Resolution'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='resolution_vta' id='resolution_vta' class='form-control' required>".stripcslashes($result['resolution_vta'])."</textarea>",
                        'query' => null
                    ]
                ],
                'row3' => [
                    'col1' => [
                        'options' => [ 'inline' => true ],
                        'row1' => [
                            [
                                'label' => "<label for='status_vta'>Status</label>",
                                'tagName' => 'select',
                                'element' => "<select name='status_vta' id='status_vta' class='form-control' required>%s</select>",
                                'value' => $result['status_vta'],
                                'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                            ]
                        ],
                        'row2' => [
                            [
                                'label' => "<label for='priority_vta'>Priority</label>",
                                'tagName' => 'select',
                                'element' => "<select name='priority_vta' id='priority_vta' class='form-control required>%s</select>",
                                'value' => $result['priority_vta'],
                                'query' => [ 1, 2, 3 ]
                            ]
                        ],
                        'row3' => [
                            [
                                'label' => "<label for='agree_vta'>Agree</label>",
                                'tagName' => 'select',
                                'element' => "<select name='agree_vta' id='agree_vta' class='form-control' required>%s</select>",
                                'value' => $result['agree_vta'],
                                'query' => "SELECT agreeDisagreeID, agreeDisagreeName FROM agreeDisagree WHERE agreeDisagreeName <> ''"
                            ]
                        ],
                        'row4' => [
                            [
                                'label' => "<label for='safety_cert_vta'>Safety Certiable</label>",
                                'tagName' => 'select',
                                'element' => "<select name='safety_cert_vta' id='safety_cert_vta' class='form-control'>%s</select>",
                                'value' => $result['safety_cert_vta'],
                                'query' => 'SELECT yesNoID, yesNo from YesNo'
                            ]
                        ],
                        'row5' => [ // will need sep table
                            [
                                'label' => "<label for='bdAttachments'>Upload attachment</label>",
                                'tagName' => 'input',
                                'type' => 'file',
                                'element' => "<input name='bdAttachments' id='bdAttachments' type='file' class='form-control' disabled>"
                            ]
                        ]
                    ],
                    'col2' => [
                        'row1' => [
                            'bdCommText' => [
                                'label' => "<label for='bdCommText'>Add comment</label>",
                                'tagName' => 'textarea',
                                'element' => "<textarea name='bdCommText' id='bdCommText' class='form-control'>%s</textarea>",
                                'value' => ''
                            ]
                        ],
                        'row2' => [
                            'options' => [ 'inline' => true ],
                            'resolution_disputed' => [
                                'label' => "<label for='resolution_disputed' class='form-check-label check-label-left'>Resolution disputed</label>",
                                'tagName' => 'input',
                                'type' => 'checkbox',
                                'element' => "<input name='resolution_disputed' id='resolution_disputed' type='checkbox' value='1' class='form-check-input' %s>",
                                'value' => $result['resolution_disputed'],
                                'query' => null
                            ],
                            'structural' => [
                                'label' => "<label for='structural' class='form-check-label check-label-left'>Stuctural</label>",
                                'tagName' => 'input',
                                'type' => 'checkbox',
                                'element' => "<input name='structural' id='structural' type='checkbox' value='1' class='form-check-input' %s>",
                                'value' => $result['structural'],
                                'query' => null
                            ]
                        ]
                    ]
                ]
            ];
        
            $bartFields = [
                'row1' => [
                    'id_bart' => [
                        'label' => returnLabel('id_bart', 'BART ID', 'required'),
                        'tagName' => 'input',
                        'type' => 'text',
                        'element' => "<input name='id_bart' id='id_bart' type='text' value='%s' class='form-control' required>",
                        'value' => $result['id_bart']
                    ]
                ],
                'row2' => [
                    'description_bart' => [
                        'label' => returnLabel('description_bart', 'Description', 1),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='description_bart' id='description_bart' maxlength='1000' class='form-control' required>%s</textarea>",
                        'value' => stripcslashes($result['description_bart'])
                    ]
                ],
                'row3' => [
                    'options' => [ 'inline' => true ],
                    'col1' => [
                        // 'options' => [ 'inline' => true ],
                        [
                            [
                                'label' => returnLabel('cat1_bart', 'Category 1'),
                                'tagName' => 'input',
                                'type' => 'text',
                                'element' => "<input name='cat1_bart' id='cat1_bart' type='text' maxlength='3' value='%s' class='form-control'>",
                                'value' => stripcslashes($result['cat1_bart'])
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('cat2_bart', 'Category 2'),
                                'tagName' => 'input',
                                'type' => 'text',
                                'element' => "<input name='cat2_bart' id='cat2_bart' type='text' maxlength='3' value='%s' class='form-control'>",
                                'value' => stripcslashes($result['cat2_bart'])
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('cat3_bart', 'Category 3'),
                                'tagName' => 'input',
                                'type' => 'text',
                                'element' => "<input name='cat3_bart' id='cat3_bart' type='text' maxlength='3' value='%s' class='form-control'>",
                                'value' => stripcslashes($result['cat3_bart'])
                            ]
                        ]
                    ],
                    'col2' => [
                        // 'options' => [ 'inline' => true ],
                        [
                            'level_bart' => [
                                'label' => returnLabel('level_bart', 'Level', true),
                                'tagName' => 'select',
                                'element' => "<select name='level_bart' id='level_bart' class='form-control' required>%s</select>",
                                'value' => $result['level_bart'],
                                'query' => [ 'PROGRAM', 'PROJECT' ]
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('dateOpen_bart', 'Date open', 1),
                                'tagName' => 'input',
                                'type' => 'date',
                                'element' => "<input name='dateOpen_bart' id='dateOpen_bart' type='date' value='%s' class='form-control' required>",
                                'value' => $result['dateOpen_bart']
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('dateClose_bart', 'Date closed'),
                                'tagName' => 'input',
                                'type' => 'date',
                                'value' => $result['dateClose_bart'],
                                'element' => "<input name='dateClose_bart' id='dateClose_bart' type='date' value='%s' class='form-control'>"
                            ]
                        ],
                        [
                            [
                                'label' => returnLabel('status_bart', 'Status', 1),
                                'tagName' => 'select',
                                'element' => "<select name='status_bart' id='status_bart' class='form-control' required>%s</select>",
                                'value' => $result['status_bart'],
                                'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                            ]
                        ]
                    ]
                ]
            ];
            echo "
                <header class='container page-header'>
                    <h1 class='page-title'>Update Deficiency $defID</h1>
                </header>
                <main role='main' class='container main-content'>
                    <form action='updateBartDefCommit.php' method='POST' enctype='multipart/form-data'>
                        <input type='hidden' name='id' value='{$defID}' >
                        <h5 class='grey-bg pad'>General Information</h5>";
                        foreach ($topFields as $gridRow) {
                            print returnRow($gridRow);
                        }
            echo "
                        <h5 class='grey-bg pad'>VTA Information</h5>";
                        foreach ($vtaFields as $gridRow) {
                            print returnRow($gridRow);
                        }
            echo "
                        <h5 class='grey-bg pad'>BART Information</h5>";
                        foreach ($bartFields as $gridRow) {
                            print returnRow($gridRow);
                        }
                        
            echo "
                        <h5 class='grey-bg pad'>Comments</h5>";
                        foreach ($comments as $comment) {
                            $timestamp = strtotime($comment['date_created']) - (60 * 60 * 7);
                            
                            printf(
                                $commentFormat,
                                $comment['firstname'].' '.$comment['lastname'],
                                date('j/n/Y • g:i a', $timestamp),
                                stripcslashes($comment['bdCommText'])
                            );
                        }

            echo "
                        <div class='center-content'>
                            <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
                        </div>
                    </form>
                </main>";
                
            // echo "<pre>";
            // var_dump($result);
            // echo "</pre>";
        } else {
            printSqlErrorAndExit($stmt, $sql);
        }
    } else {
        printSqlErrorAndExit($stmt, $sql);
    }
    // echo "</div>";
} else {
    printSqlErrorAndExit($link, $sql);
}

$link->close();
include('fileend.php');
