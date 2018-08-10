<?php
$sqlMap = [
    'asset' => [
        'table' => ['assetID as ID', 'assetTag', 'compName', 'locationName', 'installed', 'testStatName'],
        'add' => ['assetTag', 'component', 'location', 'room', 'installStatus', 'testStatus'],
        'update' => ['lastUpdated', 'updatedBy']
    ],
    'component' => [
        'tableName' => 'component',
        'fields' => ['compID', 'compName']
    ],
    'location' => [
        'tableName' => 'location',
        'fields' => ['locationID', 'locationName']
    ],
    'installStatus' => [
        'tableName' => 'yesNo',
        'fields' => ['yesNoID', 'yesNoName']
    ],
    'testStatus' => [
        'tableName' => 'testStatus',
        'fields' => ['testStatId', 'testStatName']
    ]
];