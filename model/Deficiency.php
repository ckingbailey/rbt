<?php
class Deficiency
{
    use MysqliDb;
    
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
        'createdBy' => null,
        'updatedBy' => null,
        'dateCreated' => null,
        'lastUpdated' => null,
        'dateClosed' => null,
        'closureRequested' => null,
        'closureRequestedBy'
    ];
    
    public function __construct($data) {
        foreach ($this->data as $fieldName => $val) {
            $this->data[$fieldName] = $data[$fieldName];
        }
    }
    
    public function update() {
        $link = new MysqliDb(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        $updateData = $this->filter_data();
        
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
    }
}