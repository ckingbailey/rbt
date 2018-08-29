<?php
class DefAttachment
{
    use MysqliDb;
    
    private $data = [
        'defPicID' => null,
        'defID' => null,
        'uploadedBy' => null,
        'pathToFile' => null
    ];
    
    public function __construct($data) {
        foreach ($this->data as $fieldName => &$val) {
            $val = $data[$fieldName];
        }
    }
    
    public function insert() {
        $link = new MysqliDb(DB_HOST, DB_NAME, DB_PWD, DB_USER);
        $link->insert($this->data);
        $link->disconnect();
    }
}