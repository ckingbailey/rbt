<?php
class Deficiency
{
    private $data = [
        'defID' => null,
        'safetyCert' => null,
        'systemAffected' => null,
        'location' => null,
        'specLoc' => null,
        'status' => null,
        'severity' => null,
        'dueDate' => null,
        'groupToResolve' => null,
        'milestone' => null,
        'contract' => null,
        'identifiedBy' => null,
        'defType' => null,
        'description' => null,
        'spec' => null,
        'actionOwner' => null,
        'evidenceType' => null,
        'documentRepo' => null,
        'evidenceLink' => null,
        'oldID' => null,
        'closureComments' => null,
        'createdBy' => null, // validate
        'updatedBy' => null, // validate
        'dateCreated' => null, // validate
        'lastUpdated' => null,
        'dateClosed' => null, // validate against status || set
        'closureRequested' => null, // validate against status??
        'closureRequestedBy' => null, // validate
        'assets' => [],
        'comments' => [],
        'newComment' => null,
        'attachments' => [],
        'newAttachment' => null
    ];
    
    private $filterKeys = [
        'defID' => true,
        'assets' => true,
        'comments' => true,
        'newComment' => true,
        'attachments' => true,
        'newAttachment' => true
    ];
    
    static private $foreignKeys = [
        'safetyCert' => [
            'table' => 'yesNo',
            'fields' => ['yesNoID', 'yesNoName']
        ],
        'systemAffected' => [
            'table' => 'system',
            'fields' => ['systemID', 'systemName']
        ],
        'groupToResolve' => [
            'table' => 'system',
            'fields' => ['systemID', 'systemName']
        ],
        'location' => [
            'table' => 'location',
            'fields' => ['locationID', 'locationName']
        ],
        'status' => [
            'table' => 'status',
            'fields' => ['statusID', 'statusName'],
            'where' => [
                [
                    'field' => 'statusName',
                    'value' => 'open'
                ],
                [
                    'field' => 'statusName',
                    'value' => 'closed'
                ]
            ]
        ],
        'severity' => [
            'table' => 'severity',
            'fields' => ['severityID', 'severityName']
        ],
        'milestone' => [
            'table' => 'milestone',
            'fields' => ['milestoneID', 'milestoneName']
        ],
        'contract' => [
            'table' => 'contract',
            'fields' => ['contractID', 'contractName']
        ],
        'defType' => [
            'table' => 'defType',
            'fields' => ['defTypeID', 'defTypeName']
        ],
        'evidenceType' => [
            'table' => 'evidenceType',
            'fields' => ['eviTypeID', 'eviTypeName']
        ],
        'documentRepo' => [
            'table' => 'documentRepo',
            'fields' => ['docRepoID', 'docRepoName']
        ]
    ];
    
    // TODO: check for incoming defIDi in DB and validate persisted data against incoming data
    public function __construct($data) {
        foreach ($this->data as $fieldName => $val) {
            if (empty($data[$fieldName])) continue;
            else $this->data[$fieldName] = $data[$fieldName];
        }
        // if createdBy, updatedBy, dateCreated not provided, set values for them
        if (empty($this->data['updatedBy'])) $this->data['updatedBy'] = $_SESSION['userID'];

        // TODO: check for defID before checking creation deets
        // check creation details in db before setting them in obj
        if (empty($this->data['createdBy']) || empty($this->data['dateCreated'])) {
            $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
            $link->where('defID', $this->data['defID']);
            $creationStamp = $link->get('deficiency', ['createdBy', 'dateCreated']);
            
            if (empty($this->data['createdBy'])) $this->data['createdBy'] = $_SESSION['userID'];
            if (empty($this->data['dateCreated'])) $this->data['dateCreated'] = date('Y-m-d H:i:s');
        }
    }
    
    public function __toString() {
        return print_r($this->data, true);
    }
    
    // TODO: add fn to handle relatedAsset, newComment, newAttachment
    public function insert() {
        $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        $insertData = $this->filter_data();
        $insertData = filter_var_array($insertData, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $newID = $link->insert('deficiency', $insertData);
        $link->disconnect();
        
        return $newID;
    }
    
    public function update() {
        // validate against user $role
        $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        $updateData = $this->filter_data();
        $updateData = filter_var_array($updateData, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $link->where('defID', $this->defID);
        $link->update($updateData);
        
        $link->disconnect();
    }
    
    private function filter_data() {
        $filterKeys = $this->filterKeys;
        $data = $this->data;
        
        foreach ($data as $fieldName => $val) {
            if (empty($val) || !empty($filterKeys[$fieldName])) unset($data[$fieldName]);
        }
        
        return $data;
    }
    
    static function getLookUpOptions() {
        $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        $options = [];
        
        foreach (self::$foreignKeys as $childField => $lookup) {
            $table = $lookup['table'];
            $fields = $lookup['fields'];
            $fields[0] .= ' AS id';
            $fields[1] .= ' AS name';
            
            if (!empty($lookup['where'])) {
                $i = 0;
                foreach ($lookup['where'] as $where) {
                    if ($i === 0) $link->where($where['field'], $where['value']);
                    else $link->orWhere($where['field'], $where['value']);
                    $i++;
                }
            }
            
            $options[$childField] = $link->get($table, null, $fields);
        }
        
        if (is_a($link, 'MysqliDb')) $link->disconnect();
        return $options;
    }
}
