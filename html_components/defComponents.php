<?php

$projectDefEls = [
    $requiredRows = [
        [
            'SafetyCert' => [
                "label" => "<label for='SafetyCert' class='required'>Safety Certifiable</label>",
                "tagName" => 'select',
                'element' => "<select name='SafetyCert' id='SafetyCert' class='form-control' required>%s</select>",
                "type" => '',
                "name" => 'SafetyCert',
                "id" => 'SafetyCert',
                "query" => "SELECT YesNoID, YesNo FROM YesNo ORDER BY YesNo",
                'value' => $safetyCert
            ],
            'SystemAffected' => [
                "label" => "<label for='SystemAffected' class='required'>System Affected</label>",
                "tagName" => 'select',
                'element' => "<select name='SystemAffected' id='SystemAffected' class='form-control' required>%s</select>",
                "type" => '',
                "name" => 'SystemAffected',
                "id" => 'SystemAffected',
                "query" => "SELECT SystemID, System FROM System ORDER BY System",
                'value' => $systemAffected
            ]
        ],
        [
            'LocationName' => [
                "label" => "<label for='LocationName' class='required'>General Location</label>",
                "tagName" => 'select',
                'element' => "<select name='LocationName' id='LocationName' class='form-control' required>%s</select>",
                "type" => '',
                "name" => 'LocationName',
                "id" => 'LocationName',
                "query" => "SELECT LocationID, LocationName FROM Location ORDER BY LocationName",
                'value' => $locationName
            ],
            'SpecLoc' => [
                "label" => "<label for='SpecLoc' class='required'>Specific Location</label>",
                "tagName" => "input",
                "element" => "<input type='text' name='SpecLoc' id='SpecLoc' value='%s' class='form-control' required>",
                "type" => 'text',
                "name" => 'SpecLoc',
                "id" => 'SpecLoc',
                "query" => null,
                'value' => $specLoc
            ]
        ],
        [
            'Status' => [
                "label" => "<label for='Status' class='required'>Status</label>",
                "tagName" => "select",
                "element" => "<select name='Status' id='Status' class='form-control' required>%s</select>",
                "type" => null,
                "name" => 'Status',
                "id" => 'Status',
                "query" => "SELECT StatusID, Status FROM Status WHERE StatusID <> 3 ORDER BY StatusID",
                'value' => $status
            ],
            'SeverityName' => [
                "label" => "<label for='SeverityName' class='required'>Severity</label>",
                "tagName" => "select",
                "element" => "<select name='SeverityName' id='SeverityName' class='form-control' required>%s</select>",
                "type" => null,
                "name" => 'SeverityName',
                "id" => 'SeverityName',
                "query" => "SELECT SeverityID, SeverityName FROM Severity ORDER BY SeverityName",
                'value' => $severityName
            ]
        ],
        [
            'DueDate' => [
                "label" => "<label for='DueDate' class='required'>To be resolved by</label>",
                "tagName" => "input",
                "element" => "<input type='date' name='DueDate' id='DueDate' value='%s' class='form-control' required>",
                "type" => 'date',
                "name" => 'DueDate',
                "id" => 'DueDate',
                "query" => null,
                'value' => $dueDate
            ],
            'GroupToResolve' =>[
                "label" => "<label for='GroupToResolve' class='required'>Group to Resolve</label>",
                "tagName" => "select",
                "element" => "<select name='GroupToResolve' id='GroupToResolve' class='form-control' required>%s</select>",
                "type" => null,
                "name" => 'GroupToResolve',
                "id" => 'GroupToResolve',
                "query" => "SELECT SystemID, System FROM System ORDER BY System",
                'value' => $groupToResolve
            ]
        ],
        [
            'RequiredBy' => [
                "label" => "<label for='RequiredBy' class='required'>Required for</label>",
                "tagName" => "select",
                "element" => "<select name='RequiredBy' id='RequiredBy' class='form-control' required>%s</select>",
                "type" => null,
                "name" => 'RequiredBy',
                "id" => 'RequiredBy',
                "query" => "SELECT ReqByID, RequiredBy FROM RequiredBy ORDER BY RequiredBy",
                'value' => $requiredBy
            ],
            'contract' => [
                'label' => "<label for='contract' class='required'>Contract</label>",
                'tagName' => 'select',
                'element' => "<select name='contractID' id='contractID' class='form-control' required>%s</select>",
                'type' => null,
                'name' => 'contractID',
                'id' => 'contractID',
                'query' => "SELECT contractID, contract FROM Contract ORDER BY contractID",
                'value' => $contract
            ]
        ],
        [
            'IdentifiedBy' => [
                "label" => "<label for='IdentifiedBy' class='required'>Identified By</label>",
                "tagName" => "input",
                "element" => "<input type='text' name='IdentifiedBy' id='IdentifiedBy' class='form-control' value='%s' required>",
                "type" => 'text',
                "name" => 'IdentifiedBy',
                "id" => 'IdentifiedBy',
                "query" => null,
                'value' => stripcslashes($identifiedBy)
            ],
            'defType' => [
                'label' => "<label for='defType' class='required'>Deficiency type</label>",
                'tagName' => "select",
                'element' => "<select name='defType' id='defType' class='form-control' required>%s</select>",
                'type' => null,
                'name' => 'defType',
                'id' => 'defType',
                'query' => 'SELECT defTypeID, defTypeName FROM defType',
                'value' => $defType
            ]
        ],
        [
            'Description' => [
                "label" => "<label for='Description' class='required'>Deficiency Description</label>",
                "tagName" => "textarea",
                "element" => "<textarea name='Description' id='Description' class='form-control' maxlength='1000' required>%s</textarea>",
                "type" => null,
                "name" => 'Description',
                "id" => 'Description',
                "query" => null,
                'value' => stripcslashes($Description)
            ]
        ]
    ],
    $optionalRows = [
        [
            'Spec' => [
                "label" => "<label for='Spec'>Spec or Code</label>",
                "tagName" => "input",
                "element" => "<input type='text' name='Spec' id='Spec' value='%s' class='form-control'>",
                "type" => 'text',
                "name" => 'Spec',
                "id" => 'Spec',
                "query" => null,
                'value' => stripcslashes($spec)
            ],
            'ActionOwner' => [
                "label" => "<label for='ActionOwner'>Action Owner</label>",
                "tagName" => "input",
                "element" => "<input type='text' name='ActionOwner' id='ActionOwner' value='%s' class='form-control'>",
                "type" => 'text',
                "name" => 'ActionOwner',
                "id" => 'ActionOwner',
                "query" => null,
                'value' => stripcslashes($actionOwner)
            ]
        ],
        [
            'OldID' => [
                "label" => "<label for='OldID'>Old Id</label>",
                "tagName" => "input",
                "element" => "<input type='text' name='OldID' id='OldID' value='%s' class='form-control'>",
                "type" => 'text',
                "name" => 'OldID',
                "id" => 'OldID',
                "query" => null,
                'value' => stripcslashes($oldID)
            ],
            'CDL_pics' => [
                'label' => "<label for='CDL_pics'>Upload Photo</label>",
                'tagName' => 'input',
                'element' => "<input type='file' accept='image/*' name='CDL_pics' id='CDL_pics' class='form-control form-control-file'>",
                'type' => 'file',
                'name' => 'CDL_pics',
                'id' => 'CDL_pics',
                'query' => null
            ]
        ],
        [
            'comments' => [
                "label" => "<label for='comments'>More Information</label>",
                "tagName" => "textarea",
                "element" => "<textarea name='comments' id='comments' class='form-control' maxlength='1000'>%s</textarea>",
                "type" => null,
                "name" => 'comments',
                "id" => 'comments',
                "query" => null,
                'value' => stripcslashes($comments)
            ]
        ]
    ],
    $closureRows = [
        [
            'EviType' => [
                "label" => "<label for='EviType'>Evidence Type</label>",
                "tagName" => 'select',
                'element' => "<select name='EviType' id='EviType' class='form-control'>%s</select>",
                "type" => '',
                "name" => 'EviType',
                "id" => 'EviType',
                "query" => "SELECT EviTypeID, EviType FROM EvidenceType ORDER BY EviType",
                'value' => $eviType
            ],
            'Repo' => [
                'label' => "<label for='Repo'>Evidence Repository</label>",
                'tagName' => 'select',
                'element' => "<select name='Repo' id='Repo' class='form-control'>%s</select>",
                'type' => '',
                'name' => 'Repo',
                'id' => 'Repo',
                'query' => "SELECT RepoID, Repo FROM Repo ORDER BY Repo",
                'value' => $repo
            ],
            'EvidenceLink' => [
                'label' => "<label for='EvidenceLink'>Repository Number</label>",
                'tagName' => "input",
                'element' => "<input type='text' name='EvidenceLink' id='EvidenceLink' class='form-control' value='%s'>",
                'type' => 'text',
                'name' => 'EvidenceLink',
                'id' => 'EvidenceLink',
                'query' => null,
                'value' => stripcslashes($evidenceLink)
            ]
        ],
        [
            'ClosureComments' => [
                "label" => "<label for='ClosureComments'>Closure Comments</label>",
                "tagName" => "textarea",
                "element" => "<textarea name='ClosureComments' id='ClosureComments' class='form-control' maxlength='1000'>%s</textarea>",
                "type" => null,
                "name" => 'ClosureComments',
                "id" => 'ClosureComments',
                "query" => null,
                'value' => stripcslashes($ClosureComments)
            ]
        ]
    ]
];

$bartDefEls = [
    $topElements => [
        'creator' => [
            "<label for='creator'>Creator</label>",
            "<select name='creator' id='creator' class='form-control' >
                <option></option>
                <option>VTA</option>
                <option>BART</option>
            </select>"
        ],
        'next_step' => [
            "<label for='next_step'>Next step</label>",
            [
                'tagName' => 'select',
                'element' => "<select name='next_step' id='next_step' class='form-control'>%s</select>",
                'query' => 'SELECT bdNextStepID, nextStepName FROM bdNextStep ORDER BY bdNextStepID',
                'value' => ''
            ]
        ],
        'bic' => [
            "<label for='bic'>Ball in court</label>",
            "<select name='bic' id='bic' class='form-control'>
                <option></option>
                <option>VTA</option>
                <option>BART</option>
            </select>"
        ],
        'descriptive_title_vta' => [
            'label' => "<label for='descriptive_title_vta'>Description</label>",
            'tagName' => 'textarea',
            'element' => "<textarea name='descriptive_title_vta' id='descriptive_title_vta' class='form-control'></textarea>",
            'value' => '',
            'query' => null
        ]
    ],
    $vtaElements => [
        'Root_Prob_VTA' => [
            'label' => "<label for='root_prob_vta'>Root problem</label>",
            'tagName' => 'textarea',
            'element' => "<textarea name='root_prob_vta' id='root_prob_vta' class='form-control'></textarea>",
            'value' => '',
            'query' => null
        ],
        'resolution_vta' => [
            'label' => "<label for='resolution_vta'>Resolution</label>",
            'tagName' => 'textarea',
            'element' => "<textarea name='resolution_vta' id='resolution_vta' class='form-control'></textarea>",
            'value' => '',
            'query' => null
        ],
        'status_vta' => [
            "<label for='status_vta'>Status</label>",
            [
                'tagName' => 'select',
                'element' => "<select name='status_vta' id='status_vta' class='form-control'>%s</select>",
                'value' => '',
                'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
            ]
        ],
        'priority_vta' => [
            "<label for='priority_vta'>Priority</label>",
            "<select name='priority_vta' id='priority_vta' class='form-control'>
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>"
        ],
        'safety_cert_vta' => [
            "<label for='safety_cert_vta'>Safety Certiable?</label>",
            [
                'tagName' => 'select',
                'element' => "<select name='safety_cert_vta' id='safety_cert_vta' class='form-control'>%s</select>",
                'value' => '',
                'query' => 'SELECT yesNoID, yesNo from YesNo'
            ]
        ],
        'bdAttachments' => [
            "<label for='bdAttachments'>Upload attachment</label>",
            [
                'tagName' => 'input',
                'type' => 'file',
                'element' => "<input name='bdAttachments' id='bdAttachments' type='file' class='form-control'>"
            ]
        ],
        'bdComments' => [
            [
                'label' => "<label for='bdComments'>Comment</label>",
                'tagName' => 'textarea',
                'element' => "<textarea name='bdComments' id='bdComments' class='form-control'>%s</textarea>",
                'value' => ''
            ]
        ],
        'resolution_disputed' => [
            [
                'label' => "<label for='resolution_disputed' class='form-check-label mr-2'>Resolution disputed</label>",
                'element' => "<input name='resolution_disputed' id='resolution_disputed' type='checkbox' value='1' class='form-check-input'>"
            ],
            [
                'label' => "<label for='structural' class='form-check-label mr-2'>Structural</label>",
                'element' => "<input name='structural' id='structural' type='checkbox' value='1' class='form-check-input'>"
            ]
        ]
    ],
    $bartElements => [
        'id_bart' => [
            "<label for='id_bart'>BART ID</label>
            <input name='id_bart' id='id_bart' type='text' class='form-control'>"
        ],
        'description_bart' => [
            "<label for='description_bart'>Description</label>
            <textarea name='description_bart' id='description_bart' maxlength='1000' class='form-control'></textarea>"
        ],
        'cat1_bart' => [
            "<label for='cat1_bart'>Cat1</label>",
            "<input name='cat1_bart' id='cat1_bart' type='text' maxlength='3' class='form-control'>"
        ],
        'cat2_bart' => [
            "<label for='cat2_bart'>Cat2</label>",
            "<input name='cat2_bart' id='cat2_bart' type='text' maxlength='3' class='form-control'>"
        ],
        'cat3_bart' => [
            "<label for='cat3_bart'>Cat3</label>",
            "<input name='cat3_bart' id='cat3_bart' type='text' maxlength='3' class='form-control'>"
        ],
        'level_bart' => [
            "<label for='level_bart'>Level</label>",
            "<select name='level_bart' id='level_bart' class='form-control'>
                <option></option>
                <option>PROGRAM</option>
                <option>PROJECT</option>
            </select>"
        ],
        'dateOpen_bart' => [
            "<label for='dateOpen_bart'>Date open</label>",
            "<input name='dateOpen_bart' id='dateOpen_bart' type='date' class='form-control'>"
        ],
        'dateClose_bart' => [
            "<label for='dateClose_bart'>Date closed</label>",
            "<input name='dateClose_bart' id='dateClose_bart' type='date' class='form-control'>"
        ],
        'status_bart' => [
            "<label for='status_bart'>Status</label>",
            [
                'tagName' => 'select',
                'element' => "<select name='status_bart' id='status_bart' class='form-control'>%s</select>",
                'value' => '',
                'query' => "SELECT statusID, status from Status WHERE status <> 'Deleted'"
            ]
        ]
    ]
];