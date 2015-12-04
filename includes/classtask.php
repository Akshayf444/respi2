<?php

class task extends Table {

    protected $tablename = "takforce";

    public static function auth($id = '', $password = '') {
        global $database;
        $id = $database->escape_value($id);
        $password = $database->escape_value($password);
        if ($id != '' && $password != '') {
            $sql = "select * from  task_force";
            $sql .= " WHERE empid = '{$id}' ";
            $sql .= " AND password='{$password}'";
              $sql .= " LIMIT 1";
               
            $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : FALSE;
        }
    }

}
