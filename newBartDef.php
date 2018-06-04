<?php
include('session.php');
include('SQLFunctions.php');
include('html_functions/bootstrapGrid.php');
$link = f_sqlConnect();
$title = 'SVBX - New BART Deficiency';

include('filestart.php');

if ($result = $link->query('SELECT bdPermit from users_enc where userID='.$_SESSION['UserID'])) {
    if ($row = $result->fetch_row()) {
        $bdPermit = $row[0];
    }
    $result->close();
}
if ($bdPermit) {
    $labelStr = "<label for='%s'%s>%s</label>";
    $required = " class='required'";
    $checkboxRequired = " class='form-check-label mr-2 required'";
    
    $topFields = [
        [
            returnRow([
                sprintf($labelStr, 'creator', $required, 'Creator'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='creator' id='creator' class='form-control' required>%s</select>",
                    'value' => '',
                    'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID"
                ]
            ]).
            returnRow([
                sprintf($labelStr, 'next_step', '', 'Next step'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='next_step' id='next_step' class='form-control'>%s</select>",
                    'query' => "SELECT bdNextStepID, nextStepName FROM bdNextStep WHERE nextStepName <> '' ORDER BY bdNextStepID",
                    'value' => ''
                ]
            ]).
            returnRow([
                sprintf($labelStr, 'bic', '', 'Ball in court'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='bic' id='bic' class='form-control'>%s</select>",
                    'value' => '',
                    'query' => "SELECT partyID, partyName from bdParties WHERE partyName <> '' ORDER BY partyID"
                ]
            ]),
            'descriptive_title_vta' => [
                'label' => sprintf($labelStr, 'descriptive_title_vta', $required, 'Description'),
                'tagName' => 'textarea',
                'element' => "<textarea name='descriptive_title_vta' id='descriptive_title_vta' class='form-control' required></textarea>",
                'value' => '',
                'query' => null
            ]
        ]
    ];

    $vtaFields = [
        [
            'Root_Prob_VTA' => [
                'label' => sprintf($labelStr, 'root_prob_vta', $required, 'Root problem'),
                'tagName' => 'textarea',
                'element' => "<textarea name='root_prob_vta' id='root_prob_vta' class='form-control' required></textarea>",
                'value' => '',
                'query' => null
            ]
        ],
        [
            'Resolution_VTA' => [
                'label' => sprintf($labelStr, 'resolution_vta', $required, 'Resolution'),
                'tagName' => 'textarea',
                'element' => "<textarea name='resolution_vta' id='resolution_vta' class='form-control' required></textarea>",
                'value' => '',
                'query' => null
            ]
        ],
        [
            returnRow([
                sprintf($labelStr, 'status_vta', $required, 'Status'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='status_vta' id='status_vta' class='form-control' required>%s</select>",
                    'value' => '',
                    'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                ]
            ]).
            returnRow([
                sprintf($labelStr, 'priority_vta', $required, 'Priority'),
                "<select name='priority_vta' id='priority_vta' class='form-control' required>
                    <option></option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>"
            ]).
            returnRow([
                sprintf($labelStr, 'agree_vta', $required, 'Agree'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='agree_vta' id='agree_vta' class='form-control' required>%s</select>",
                    'value' => '',
                    'query' => "SELECT agreeDisagreeID, agreeDisagreeName FROM agreeDisagree WHERE agreeDisagreeName <> ''"
                ]
            ]).
            returnRow([
                sprintf($labelStr, 'safety_cert_vta', $required, 'Safety Certiable'),
                [
                    'tagName' => 'select',
                    'element' => "<select name='safety_cert_vta' id='safety_cert_vta' class='form-control' required>%s</select>",
                    'value' => '',
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
                    'label' => "<label for='bdComments'>Comment</label>",
                    'tagName' => 'textarea',
                    'element' => "<textarea name='bdComments' id='bdComments' class='form-control' disabled>%s</textarea>",
                    'value' => ''
                ]
            ]).
            // comments will need sep table
            returnRow([
                "<div class='form-check form-check-inline'>"
                    .sprintf($labelStr, 'resolution_disputed', '', 'Resolution disputed')
                    ."<input name='resolution_disputed' id='resolution_disputed' type='checkbox' value='1' class='form-check-input'>
                </div>",
                "<div class='form-check form-check-inline'>"
                    .sprintf($labelStr, 'structural', '', 'Structural')
                    ."<input name='structural' id='structural' type='checkbox' value='1' class='form-check-input'>
                </div>"
            ])
        ]
    ];

    $bartFields = [
        'id_bart' => [
            sprintf($labelStr, 'id_bart', $required, 'BART ID')
            ."<input name='id_bart' id='id_bart' type='text' class='form-control' required>"
        ],
        'description_bart' => [
            sprintf($labelStr, 'description_bart', $required, 'Description')
            ."<textarea name='description_bart' id='description_bart' maxlength='1000' class='form-control' required></textarea>"
        ],
        [
            returnRow([
                sprintf($labelStr, 'cat1_bart', '', 'Category 1'),
                "<input name='cat1_bart' id='cat1_bart' type='text' maxlength='3' class='form-control'>"
            ]).
            returnRow([
                sprintf($labelStr, 'cat2_bart', '', 'Category 2'),
                "<input name='cat2_bart' id='cat2_bart' type='text' maxlength='3' class='form-control'>"
            ]).
            returnRow([
                sprintf($labelStr, 'cat3_bart', '', 'Category 3'),
                "<input name='cat3_bart' id='cat3_bart' type='text' maxlength='3' class='form-control'>"
            ]),
            returnRow([
                sprintf($labelStr, 'level_bart', $required, 'Level'),
                "<select name='level_bart' id='level_bart' class='form-control' required>
                    <option></option>
                    <option>PROGRAM</option>
                    <option>PROJECT</option>
                </select>"
            ]).
            returnRow([
                sprintf($labelStr, 'dateOpen_bart', $required, 'Date open'),
                "<input name='dateOpen_bart' id='dateOpen_bart' type='date' class='form-control' required>"
            ]).
            returnRow([
                sprintf($labelStr, 'dateClose_bart', '', 'Date closed'),
                "<input name='dateClose_bart' id='dateClose_bart' type='date' class='form-control'>"
            ]).
            returnRow([
                sprintf($labelStr, 'status_bart', $required, 'Status'),
                'status_bart' => [
                    'tagName' => 'select',
                    'element' => "<select name='status_bart' id='status_bart' class='form-control' required>%s</select>",
                    'value' => '',
                    'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
                ]
            ])
        ]
    ];
    echo "
        <header class='container page-header'>
            <h1 class='page-title'>Add New Deficiency</h1>
        </header>
        <main role='main' class='container main-content'>
            <form action='recBartDef.php' method='POST' enctype='multipart/form-data'>
                <input type='hidden' name='created_by' value='{$_SESSION['UserID']}' />
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
                <div class='center-content'>
                    <button type='submit' class='btn btn-primary btn-lg'>Submit</button>
                    <button type='reset' class='btn btn-primary btn-lg'>Reset</button>
                </div>
            </form>
        </main>";
} else {
    header('Location: unauthorised.php');
    exit;
}

$link->close();
include('fileend.php');
