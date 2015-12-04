<?php

class man_power extends Table {

    protected $table_name = "breathfree_manpower";

    public static function authenticate($id = "", $password = "") {
        global $database;
        $id = $database->escape_value($id);
        $password = $database->escape_value($password);
        if ($id != '' && $password != '') {
            $sql = "SELECT * FROM breathfree_manpower ";
            $sql .= "WHERE BM_Emp_Id = '{$id}' ";
            $sql .= " AND  BM_Password = '{$password}' ";
            $sql .= " AND  status='Active'  ";

            $sql .= " LIMIT 1";
            //echo $sql;
            $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
        }
    }


    public static function bmViewStatus($conditions = array()) {
        $sql = "SELECT SUM(regular_clinic) as regular_clinic,SUM(regular_activation) AS regular_activation , SUM(Rotahaler) AS Rotahaler,rm.`BM_Emp_Id`,rm.`SM_Emp_Id`,rm.`BM_Name`,rm.`Zone`,rm.`Territory` FROM breathfree_manpower rm INNER JOIN breathfree_activity act ON rm.BM_EMP_ID = act.BM_EMP_ID ";
        if (!empty($conditions)) {
            $sql .= join(" ", $conditions);
        }
        //echo $sql;
        return Query::executeQuery($sql);
    }
    public static function Activity_list($conditions) {
        $sql = "SELECT * FROM respi2_manpower rm
                INNER JOIN respi2_activity ra
                ON rm.`BM_Emp_Id`=ra.`BM_Emp_Id`
                WHERE ra.`BM_Emp_Id`=$conditions ";
        
        return Query::executeQuery($sql);
    }

}
