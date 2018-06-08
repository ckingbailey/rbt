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
            $checkboxRequired = " class='form-check-label mr-2 required'";
            $commentFormat = "
                <div class='thin-grey-border pad mb-3'>
                    <h6 class='d-flex flex-row justify-content-between text-secondary'><span>%s</span><span>%s</span></h6>
                    <p>%s</p>
                </div>";

            
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
                [
                    returnRow([
                        sprintf($labelStr, 'creator', $required, 'Creator'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='creator' id='creator' class='form-control' required>%s</select>",
                            'value' => $result['creator'],
                            'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID"
                        ]
                    ]).
                    returnRow([
                       sprintf($labelStr, 'next_step', '', 'Next step'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='next_step' id='next_step' class='form-control'>%s</select>",
                            'query' => 'SELECT bdNextStepID, nextStepName FROM bdNextStep ORDER BY bdNextStepID',
                            'value' => $result['next_step']
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'bic', '', 'Ball in court'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='bic' id='bic' class='form-control'>%s</select>",
                            'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID",
                            'value' => $result['bic']
                        ]
                    ]),
                    'descriptive_title_vta' => [
                        'label' => sprintf($labelStr, 'descriptive_title_vta', $required, 'Description'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='descriptive_title_vta' id='descriptive_title_vta' class='form-control' required>".stripcslashes($result['descriptive_title_vta'])."</textarea>",
                        'query' => null
                    ]
                ]
            ];
        
            $vtaFields = [
                [
                    'root_prob_vta' => [
                        'label' => sprintf($labelStr, 'root_prob_vta', $required, 'Root problem'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='root_prob_vta' id='root_prob_vta' class='form-control' required>".stripcslashes($result['root_prob_vta'])."</textarea>",
                        'query' => null
                    ]
                ],
                [
                    'resolution_vta' => [
                        'label' => sprintf($labelStr, 'resolution_vta', $required, 'Resolution'),
                        'tagName' => 'textarea',
                        'element' => "<textarea name='resolution_vta' id='resolution_vta' class='form-control' required>".stripcslashes($result['resolution_vta'])."</textarea>",
                        'query' => null
                    ]
                ],
                [
                    returnRow([
                        sprintf($labelStr, 'status_vta', $required, 'Status'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='status_vta' id='status_vta' class='form-control' required>%s</select>",
                            'value' => $result['status_vta'],
                            'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'priority_vta', $required, 'Priority'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='priority_vta' id='priority_vta' class='form-control required>%s</select>",
                            'value' => $result['priority_vta'],
                            'query' => [ 1, 2, 3 ]
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'agree_vta', $required, 'Agree'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='agree_vta' id='agree_vta' class='form-control' required>%s</select>",
                            'value' => $result['agree_vta'],
                            'query' => "SELECT agreeDisagreeID, agreeDisagreeName FROM agreeDisagree WHERE agreeDisagreeName <> ''"
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'safety_cert_vta', $required, 'Safety Certiable'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='safety_cert_vta' id='safety_cert_vta' class='form-control'>%s</select>",
                            'value' => $result['safety_cert_vta'],
                            'query' => 'SELECT yesNoID, yesNo from YesNo'
                        ]
                    ]).
                    returnRow([ // will need sep table
                        "<label for='bdAttachments'>Upload attachment</label>",
                        [
                            'tagName' => 'input',
                            'type' => 'file',
                            'element' => "<input name='bdAttachments' id='bdAttachments' type='file' class='form-control' disabled>"
                        ]
                    ]),
                    returnRow([
                        [
                            'label' => "<label for='bdCommText'>Add comment</label>",
                            'tagName' => 'textarea',
                            'element' => "<textarea name='bdCommText' id='bdCommText' class='form-control'>%s</textarea>",
                            'value' => ''
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'resolution_disputed', '', 'Resolution disputed'),
                        'resolution_disputed' => [
                            'tagName' => 'input',
                            'type' => 'checkbox',
                            'element' => "<input name='resolution_disputed' id='resolution_disputed' type='checkbox' value='1' class='form-check-input' %s>",
                            'value' => $result['resolution_disputed'],
                            'query' => null
                        ],
                        sprintf($labelStr, 'structural', '', 'Structural'),
                        'structural' => [
                            'tagName' => 'input',
                            'type' => 'checkbox',
                            'element' => "<input name='structural' id='structural' type='checkbox' value='1' class='form-check-input' %s>",
                            'value' => $result['structural'],
                            'query' => null
                        ]
                    ])
                ]
            ];
        
            $bartFields = [
                'id_bart' => [
                    sprintf($labelStr, 'id_bart', $required, 'BART ID')
                    ."<input name='id_bart' id='id_bart' type='text' value='{$result['id_bart']}' class='form-control' required>"
                ],
                'description_bart' => [
                    sprintf($labelStr, 'description_bart', $required, 'Description')
                    ."<textarea name='description_bart' id='description_bart' maxlength='1000' class='form-control' required>".stripcslashes($result['description_bart'])."</textarea>"
                ],
                [
                    returnRow([
                        sprintf($labelStr, 'cat1_bart', '', 'Category 1'),
                        "<input name='cat1_bart' id='cat1_bart' type='text' maxlength='3' value='".stripcslashes($result['cat1_bart'])."' class='form-control'>"
                    ]).
                    returnRow([
                        sprintf($labelStr, 'cat2_bart', '', 'Category 2'),
                        "<input name='cat2_bart' id='cat2_bart' type='text' maxlength='3' value='".stripcslashes($result['cat2_bart'])."' class='form-control'>"
                    ]).
                    returnRow([
                        sprintf($labelStr, 'cat3_bart', '', 'Category 3'),
                        "<input name='cat3_bart' id='cat3_bart' type='text' maxlength='3' value='".stripcslashes($result['cat3_bart'])."' class='form-control'>"
                    ]),
                    returnRow([
                        sprintf($labelStr, 'level_bart', $required, 'Level'),
                        'level_bart' => [
                            'tagName' => 'select',
                            'element' => "<select name='level_bart' id='level_bart' class='form-control' required>%s</select>",
                            'value' => $result['level_bart'],
                            'query' => [ 'PROGRAM', 'PROJECT' ]
                        ]
                    ]).
                    returnRow([
                        sprintf($labelStr, 'dateOpen_bart', $required, 'Date open'),
                        "<input name='dateOpen_bart' id='dateOpen_bart' type='date' value='{$result['dateOpen_bart']}' class='form-control' required>"
                    ]).
                    returnRow([
                        sprintf($labelStr, 'dateClose_bart', '', 'Date closed'),
                        "<input name='dateClose_bart' id='dateClose_bart' type='date' value='{$result['dateClose_bart']}' class='form-control'>"
                    ]).
                    returnRow([
                        sprintf($labelStr, 'status_bart', $required, 'Status'),
                        [
                            'tagName' => 'select',
                            'element' => "<select name='status_bart' id='status_bart' class='form-control' required>%s</select>",
                            'value' => $result['status_bart'],
                            'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                        ]
                    ])
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
