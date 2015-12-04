<?php
class sm extends Table {

    protected $table_name = "respi2_manpower";

    public static function authenticate($id = "", $password = "") {
        global $database;
        $id = $database->escape_value($id);
        $password = $database->escape_value($password);
        if ($id != '' && $password != '') {
            $sql = "SELECT * FROM respi2_manpower ";
            $sql .= "WHERE SM_Emp_Id = '{$id}' ";
            $sql .= " AND  SM_Password = '{$password}' ";
            $sql .= " LIMIT 1";
            //echo $sql;
            $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
        }
    }
    
    public static function list_rx($date,$date1,$bdm){
        $sql="
SELECT mydate, rx_count
FROM
  (
    SELECT a.Date AS mydate
    FROM (
           SELECT DATE('$date1') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS DATE
           FROM (SELECT 0 AS a
                 UNION ALL SELECT 1
                 UNION ALL SELECT 2
                 UNION ALL SELECT 3
                 UNION ALL SELECT 4
                 UNION ALL SELECT 5
                 UNION ALL SELECT 6
                 UNION ALL SELECT 7
                 UNION ALL SELECT 8
                 UNION ALL SELECT 9) AS a
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS b
             CROSS JOIN (SELECT 0 AS a
                         UNION ALL SELECT 1
                         UNION ALL SELECT 2
                         UNION ALL SELECT 3
                         UNION ALL SELECT 4
                         UNION ALL SELECT 5
                         UNION ALL SELECT 6
                         UNION ALL SELECT 7
                         UNION ALL SELECT 8
                         UNION ALL SELECT 9) AS c
         ) a
    WHERE a.Date BETWEEN '$date' AND '$date1'
  ) dates
  LEFT JOIN
  (
    SELECT *,SUM(rx) AS rx_count
    FROM
      `rx_save` WHERE bdm_id = '$bdm' GROUP BY `created_at`
  ) DATA
    ON DATE_FORMAT(dates.mydate, '%Y%m%d') = DATE_FORMAT(DATA.created_at, '%Y%m%d') GROUP BY dates.mydate ";
         
        return Query::executeQuery($sql);
    }
}
