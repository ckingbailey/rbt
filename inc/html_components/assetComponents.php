<?php
$defaultFormCtrls = [
    'assetTag' => "<label for='assetTag' class='required'>Asset tag</label>
        <input type='text' name='assetTag' maxlength='50' value='%s' class='form-control item-margin-bottom' required>",
    'component' => "<label for='component' class='required'>Component</label>
        <select name='component' class='form-control item-margin-bottom' required>%s</select>",
    'location' => "<label for='location' class='required'>Location</label>
        <select name='location' class='form-control item-margin-bottom' required>%s</select>",
    'room' => "<label for='room' class='required'>Room</label>
        <input type='text' name='room' maxlength='25' value='%s' class='form-control item-margin-bottom' required>",
    'installStatus' => "<label for='installStat' class='required'>Installed?</label>
        <select name='installStatus' class='form-control item-margin-bottom' required>%s</select>",
    'testStatus' => "<label for='testStat'>Test status</label>
        <select name='testStatus' class='form-control item-margin-bottom'>%s</select>"
];

$formCtrlClasslist = 'form-control item-margin-bottom';

$updateFormCtrls = [
    'assetID' => "<input type='hidden' name='assetID' value='%s'>"
];

$tableStructure = [
    // in each case 'value' prop will get append from db query
    'ID' => [
        'value' => '',
        'href' => '/assets.php/view?assetID=', // concat this with value of assetID
        'heading' => [
            'value' => 'ID',
            'cellWd' => 2
        ]
    ],
    'assetTag' => [
        'value' => '',
        'heading' => [
            'value' => 'Tag #',
            'collapse' => 'xs',
            'cellWd' => 4
        ]
    ],
    'compName' => [
        'value' => '',
        'heading' => [
            'value' => 'Component',
            'cellWd' => 4
        ]
    ],
    'locationName' => [
        'value' => '',
        'heading' => [
            'value' => 'Location',
            'cellWd' => 4
        ]
    ],
    'installed' => [
        'value' => '',
        'heading' => [
            'value' => 'Installed?',
            'cellWd' => 3
        ]
    ],
    'testStatName' => [
        'value' => '',
        'heading' => [
            'value' => 'Status',
            'cellWd' => 3
        ]
    ],
    'edit' => [
        'value' => 'edit',
        'icon' => 'typcn-edit',
        'href' => '/assets.php/update?assetID=', // concat this with value of assetID
        'heading' => [
            'value' => 'Edit',
            'collapse' => 'xs',
            'cellWd' => 2
        ]
    ]
];

$formCtrlsAsArrays = [
    'assetID' => [
        'name' => 'assetID',
        'value' => '',
        'type' => 'hidden',
        'attributes' => [
            'class' => $formCtrlClasslist,
            'required' => ''
        ]
    ],
    'assetTag' => [
        'name' => 'assetTag',
        'value' => '',
        'type' => 'text',
        'attributes' => [
            'maxlength' => '50',
            'class' => $formCtrlClasslist,
            'required' => ''
        ]
    ],
    'component' => [
        'name' => 'component',
        'value' => '',
        'values' => '',
        'type' => 'select',
        'attributes' => [
            'class' => $formCtrlClasslist,
            'required' => ''
        ]
    ],
    'location' => [
        'name' => 'location',
        'value' => '',
        'values' => '',
        'type' => 'select',
        'attributes' => [
            'class' => $formCtrlClasslist,
            'required' => ''
        ]
    ],
    'room' => [
        'name' => 'room',
        'value' => '',
        'type' => 'text',
        'attributes' => [
            'class' => $formCtrlClasslist,
            'maxlength' => '25',
            'required' => ''
        ]
    ],
    'installStatus' => [
        'name' => 'installStatus',
        'value' => '',
        'values' => '',
        'type' => 'select',
        'attributes' => [
            'class' => $formCtrlClasslist,
            'required' => ''
        ]
    ],
    'testStatus' => [
        'name' => 'testStatus',
        'value' => '',
        'values' => '',
        'type' => 'select',
        'attributes' => [
            'class' => $formCtrlClasslist,
        ]
    ]
];
