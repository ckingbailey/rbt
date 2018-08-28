<?php
class DefComment
{
    use MysqliDb;
    
    private $data = [
        'defCommentID' => null,
        'defID' => null,
        'defCommentText' => null,
        'dateCreated' => null,
        'createdBy' => null
    ];
    
    public function __construct($data) {
        foreach ($this->data as $fieldName => $val) {
            $this->data[$fieldName] = $data[$fieldName];
        }
    }
    
    public function insert() {
        $link = new MysqliDb(DB_HOST, DB_NAME, DB_PWD, DB_USER);
        
    }
}