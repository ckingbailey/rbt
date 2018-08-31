<?php
class AssetDef {
    private $data = [
        'assetDefID' => null,
        'assetID' => null,
        'defID' => null
    ];
    
    public function __construct($data) {
        foreach ($this->data as $field => $val) {
            if (empty($data[$field])) continue;
            else $this->data[$field] = $val;
        }
    }
    
    public function insert() {
    }
    
    public function update() {
    }
    
    public function delete() {
    }
}