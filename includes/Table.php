<?php

class Table extends Autopaginate{

    protected $table_name;
    protected $database;
    protected $primary_key = array();
    
    function __construct() {
        global $database;
        $this->database = $database;
    }

    public function create($field_array) {
        return $this->database->create($field_array, $this->table_name);
    }

    public function update($field_array) {
        return $this->database->update($field_array, $this->table_name);
               
    }

    public function delete($field_array) {
        return $this->database->delete($field_array, $this->table_name);
    }

    public static function find_all($table_name) {
        $sql = "SELECT * FROM " . $table_name;
        return Query::executeQuery($sql);
    }

}
