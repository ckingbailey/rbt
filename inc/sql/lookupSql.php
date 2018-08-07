<?php
require_once 'lookupViewEls.php';

$sqlStrings = [
    'listAll' => "SELECT 'location' AS name, COUNT(locationID) AS count FROM location WHERE locationName <> ''
            UNION
            SELECT 'system', COUNT(systemID) FROM system WHERE systemName <> ''
            UNION
            SELECT 'component', COUNT(compID) FROM component WHERE compName <> ''
            UNION
            SELECT 'defType', COUNT(deftypeID) FROM defType WHERE deftypeName <> ''
            UNION
            SELECT 'contract', COUNT(contractID) FROM contract WHERE contractName <> ''
            UNION
            SELECT 'evidenceType', COUNT(eviTypeID) FROM evidenceType WHERE eviTypeName <> ''
            UNION
            SELECT 'status', COUNT(statusID) FROM status WHERE statusName <> ''
            UNION
            SELECT 'severity', COUNT(severityID) FROM severity WHERE severityName <> ''
            UNION
            SELECT 'testStatus', COUNT(testStatID) FROM testStatus WHERE testStatName <> ''",
    'component' => [
        'add' => ['compName', 'compDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['compID', 'compName', 'compDescrip'],
        'update' => ['compName', 'compDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'contract' => [
        'add' => ['contractName', 'contractDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['contractID', 'contractName', 'contractDescrip'],
        'update' => ['contractName', 'contractDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'defType' => [
        'add' => ['defTypeName', 'defTypeDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['defTypeID', 'defTypeName', 'defTypeDescrip'],
        'update' => ['defTypeName', 'defTypeDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'evidenceType' => [
        'add' => ['eviTypeName', 'eviTypeDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['eviTypeID', 'eviTypeName', 'eviTypeDescrip'],
        'update' => ['eviTypeName', 'eviTypeDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'location' => [
        'add' => ['locationName', 'locationDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['locationID', 'locationName', 'locationDescrip'],
        'update' => ['locationName', 'locationDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'severity' => [
        'add' => ['severityName', 'severityDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['severityID', 'severityName', 'severityDescrip'],
        'update' => ['severityName', 'severityDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'status' => [
        'add' => ['statusName', 'statusDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['statusID', 'statusName', 'statusDescrip'],
        'update' => ['statusName', 'statusDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'system' => [
        'add' => ['systemName', 'systemDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['systemID', 'systemName', 'systemDescrip'],
        'update' => ['systemName', 'systemDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ],
    'testStatus' => [
        'add' => ['testStatName', 'testStatDescrip', 'updatedBy', 'dateCreated'],
        'list' => ['testStatID', 'testStatName', 'testStatDescrip'],
        'update' => ['testStatName', 'testStatDescrip', 'updatedBy'],
        'formCtrls' => $defaultFormCtrls
    ]
];
