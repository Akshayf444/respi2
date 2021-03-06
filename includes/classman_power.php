<?php

class man_power extends Table {

    protected $table_name = "respi2_manpower";

    public static function authenticate($id = "", $password = "") {
        global $database;
        $id = $database->escape_value($id);
        $password = $database->escape_value($password);
        if ($id != '' && $password != '') {
            $sql = "SELECT * FROM respi2_manpower ";
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
        $sql = "SELECT SUM(Practicing_Change) as Practicing_Change,SUM(Check_Points) AS Check_Points , SUM(RCP_Drives) as RCP_Drives ,SUM(Rotahaler) AS Rotahaler,rm.`BM_Emp_Id`,rm.`SM_Emp_Id`,rm.`BM_Name`,rm.`Zone`,rm.`Territory`,rm.Region FROM respi2_manpower rm INNER JOIN respi2_activity act ON rm.smsWayid = act.smsWayid ";
        if (!empty($conditions)) {
            $sql .= join(" ", $conditions);
        }
        //echo $sql;
        return Query::executeQuery($sql);
    }
    
    public static function bmViewStatus3($conditions = array()) {
        $sql = "SELECT SUM(doctor_converted) as doctor_converted,SUM(device_clinic) AS device_clinic , SUM(rcp_made) as rcp_made ,SUM(rcp_drive) AS rcp_drive,SUM(rotahaler) AS rotahaler,rm.`BM_Emp_Id`,rm.`SM_Emp_Id`,rm.`BM_Name`,rm.`Zone`,rm.`Territory`,rm.Region FROM respi2_manpower rm INNER JOIN respi_activity2 act ON rm.smsWayid = act.smsWayid ";
        if (!empty($conditions)) {
            $sql .= join(" ", $conditions);
        }
        //echo $sql;
        return Query::executeQuery($sql);
    }

    public static function bmViewStatus2($conditions = array()) {
        $sql = "SELECT SUM(Practicing_Change) as Practicing_Change,SUM(Check_Points) AS Check_Points , SUM(RCP_Drives) as RCP_Drives ,SUM(Rotahaler) AS Rotahaler,rm.`BM_Emp_Id`,rm.`SM_Emp_Id`,rm.`BM_Name`,rm.`Zone`,rm.`Territory`,rm.Region FROM respi2_manpower rm LEFT JOIN respi2_activity act ON rm.smsWayid = act.smsWayid ";
        if (!empty($conditions)) {
            $sql .= join(" ", $conditions);
        }
        //echo $sql;
        return Query::executeQuery($sql);
    }
    
    public static function bmViewStatus4($conditions = array()) {
        $sql = "SELECT SUM(doctor_converted) as doctor_converted,SUM(device_clinic) AS device_clinic , SUM(rcp_made) as rcp_made ,SUM(rcp_drive) AS rcp_drive,SUM(rotahaler) AS rotahaler,rm.`BM_Emp_Id`,rm.`SM_Emp_Id`,rm.`BM_Name`,rm.`Zone`,rm.`Territory`,rm.Region FROM respi2_manpower rm LEFT JOIN respi_activity2 act ON rm.smsWayid = act.smsWayid ";
        if (!empty($conditions)) {
            $sql .= join(" ", $conditions);
        }
        //echo $sql;
        return Query::executeQuery($sql);
    }

    public static function Activity_list($conditions) {
        $sql = "SELECT * FROM respi2_manpower rm
                INNER JOIN respi2_activity ra
                ON rm.`smsWayID`=ra.`smsWayid`
                WHERE ra.`BM_Emp_Id`=$conditions ";

        return Query::executeQuery($sql);
    }


    public static function Activity_list2($conditions) {
        $sql = "SELECT * FROM respi2_manpower rm
                INNER JOIN respi_activity2 ra
                ON rm.`smsWayID`=ra.`smsWayid`
                WHERE ra.`BM_Emp_Id`=$conditions ";

        return Query::executeQuery($sql);
    }

    public static function adminLogin($id = "", $password = "") {
        global $database;
        $id = $database->escape_value($id);
        $password = $database->escape_value($password);
        if ($id != '' && $password != '') {
            $sql = "SELECT * FROM respi2_admin ";
            $sql .= "WHERE username = '{$id}' ";
            $sql .= " AND  password = '{$password}' ";
            $sql .= " LIMIT 1";
            //echo $sql;
            $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
        }
    }

    public static function SMList() {
        $sql = "SELECT DISTINCT(`SM_Emp_Id`) As SM_Emp_Id,`SM_Name` , `SM_Mobile` FROM `respi2_manpower`";
        return Query::executeQuery($sql);
    }

    public static function BMList() {
        $sql = "SELECT DISTINCT(`BM_Emp_Id`) As BM_Emp_Id,`BM_Name` , `BM_Mobile` FROM `respi2_manpower`";
        return Query::executeQuery($sql);
    }

    public static function BMlist2($condition) {
        $sql = "SELECT * FROM `respi2_bm` WHERE id " . $condition;
        return Query::executeQuery($sql);
    }

    public static function SMDropdowm($smid = 0) {
        $output = '<option>Select SM</option>';
        $smlist = self::SMList();
        if (!empty($smlist)) {
            foreach ($smlist as $sm) {
                if ($sm->SM_Emp_Id == $smid) {
                    $output.= "<option value = " . $sm->SM_Emp_Id . " selected >" . $sm->SM_Name . "</option>";
                } else {
                    $output.= "<option value = " . $sm->SM_Emp_Id . " >" . $sm->SM_Name . "</option>";
                }
            }
        }

        return $output;
    }

}
