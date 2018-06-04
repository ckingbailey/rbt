<?php
require_once 'html_functions/bootstrapGrid.php';

function layoutSection($section, $labelEl, $inputEl, $data) {
    if ($section === 'top') {
        $topFields = [
            [
                returnRow([ sprintf($labelEl, 'ID'), sprintf($inputEl, $data['ID']) ]).
                returnRow([ sprintf($labelEl, 'Creator'), sprintf($inputEl, $data['Creator']) ]).
                returnRow([ sprintf($labelEl, 'Status_VTA'), sprintf($inputEl, $data['Status_VTA']) ]).
                returnRow([ sprintf($labelEl, 'Next_Step'), sprintf($inputEl, $data['Next_Step']) ]).
                returnRow([ sprintf($labelEl, 'BIC'), sprintf($inputEl, $data['BIC']) ]),
                sprintf($labelEl, 'Descriptive_title_VTA').sprintf($inputEl, $data['Descriptive_title_VTA'])
            ]
        ];
    } elseif ($section === 'vta') {
        $vtaFields = [
            'Root_Prob_VTA' => [ sprintf($labelEl, 'Root_Prob_VTA').sprintf($inputEl, $data['Root_Prob_VTA']) ],
            'Resolution_VTA' => [ sprintf($labelEl, 'Resolution_VTA').sprintf($inputEl, $data['Resolution_VTA']) ],
            [
                returnRow([ sprintf($labelEl, 'Status_VTA'), sprintf($inputEl, $data['Status_VTA']) ]).
                returnRow([ sprintf($labelEl, 'Priority_VTA'), sprintf($inputEl, $data['Priority_VTA']) ]).
                returnRow([ sprintf($labelEl, 'Agree_VTA'), sprintf($inputEl, $data['Agree_VTA']) ]).
                returnRow([ sprintf($labelEl, 'Safety_Cert_VTA'), sprintf($inputEl, $data['Safety_Cert_VTA']) ]).
                returnRow([ sprintf($labelEl, 'Attachments'), sprintf($inputEl, $data['Attachments']) ]), // will need sep table
                sprintf($labelEl, 'Comments_VTA').sprintf($inputEl, $data['Comments_VTA']). // new comments
                // comments will need sep table
                returnRow([
                    sprintf($labelEl, 'Resolution_disputed'), sprintf($inputEl, $data['Resolution_disputed']),
                    sprintf($labelEl, 'Structural'), sprintf($inputEl, $data['Structural'])
                ])
            ]
        ];
    } elseif ($section === 'bart') {
        $bartFields = [
            [
                returnRow([ sprintf($labelEl, 'ID_BART'), sprintf($inputEl, $data['ID_BART']) ]),
                sprintf($labelEl, 'Description_BART').sprintf($inputEl, $data['Description_BART'])
            ],
            [
                returnRow([ sprintf($labelEl, 'Cat1_BART'), sprintf($inputEl, $data['Cat1_BART']) ]).
                returnRow([ sprintf($labelEl, 'Cat2_BART'), sprintf($inputEl, $data['Cat2_BART']) ]).
                returnRow([ sprintf($labelEl, 'Cat3_BART'), sprintf($inputEl, $data['Cat3_BART']) ]),
                returnRow([ sprintf($labelEl, 'Level_BART'), sprintf($inputEl, $data['Level_BART']) ]).
                returnRow([ sprintf($labelEl, 'DateOpen_BART'), sprintf($inputEl, $data['DateOpen_BART']) ]).
                returnRow([ sprintf($labelEl, 'DateClose_BART'), sprintf($inputEl, $data['DateClose_BART']) ]).
                returnRow([ sprintf($labelEl, 'Status_BART'), sprintf($fakeInputStr, $data['Status_BART']) ])
            ]
        ];
    }
}
?>