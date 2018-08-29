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
        'createdBy' => null, // validate
        'updatedBy' => null, // validate
        'dateCreated' => null, // validate
        'lastUpdated' => null,
        'dateClosed' => null, // validate against status || set
        'closureRequested' => null, // validate against status??
        'closureRequestedBy' => null, // validate
        'relatedAssets' => [],
        'comments' => [],
        'newComment' => null,
        'attachments' => [],
        'newAttachment' => null
    ];
    
    private $filterKeys = [
        'defID' => true,
        'relatedAssets' => true,
        'comments' => true,
        'newComment' => true,
        'attachments' => true,
        'newAttachment' => true
    ];
    
    public function __construct($data) {
        foreach ($this->data as $fieldName => $val) {
            $this->data[$fieldName] = $data[$fieldName];
        }
    }
    
    // TODO: add fn to handle relatedAsset, newComment, newAttachment
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
}