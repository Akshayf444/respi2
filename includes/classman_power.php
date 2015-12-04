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
     
    public static function find() {
        $sql= "select bdm.*,asm.*,zsm.* from bdm left join asm on bdm.asm_id=asm.asm_id left join zsm on asm.zsm_id=zsm.zsm_id where bdm.status='Active'  ";
        return Query:: executeQuery($sql);
    }
       
    public static function top_bdm() {
       $date=  date('Y-m-d');
        $sql=  "SELECT (CASE WHEN bdm.`bdm_name` IS NOT NULL THEN bdm.`bdm_name` ELSE tf.name END) AS NAMES,SUM(`rx_save`.`rx`) AS rx_count,
(CASE WHEN bdm.`HQ` IS NOT NULL THEN bdm.`HQ` ELSE tf.hq END) AS HQ,rx_save.`type`
 FROM rx_save
LEFT JOIN bdm ON bdm.bdm_id=rx_save.bdm_id AND `rx_save`.`type`='bdm' 
LEFT JOIN `task_force` tf ON tf.tfid = `rx_save`.`bdm_id` AND `rx_save`.`type` = 'tf' WHERE `rx_save`.`created_at` = ' $date' GROUP BY `rx_save`.`bdm_id` ORDER BY rx_count DESC LIMIT 5
";
        return Query:: executeQuery($sql);
    }
  public static function top_asm() {
       $date=  date('Y-m-d');
        $sql=  "SELECT SUM( CASE WHEN rx_save.`created_at`='$date' THEN `rx_save`.`rx` ELSE 0   END ) AS currentsum,  SUM(rx_save.`rx`) AS totalsum ,asm.`asm_name`,asm.`HQ` FROM asm
LEFT JOIN  bdm ON asm.asm_id=bdm.asm_id
 LEFT JOIN rx_save ON bdm.bdm_id=rx_save.bdm_id 
 where bdm.status='Active' 
GROUP BY asm.asm_id ORDER BY currentsum DESC LIMIT 5";
        return Query:: executeQuery($sql);
    }
    public static function top_zsm() {
       $date=  date('Y-m-d');
        $sql=  "SELECT SUM(rx_save.rx) AS SUM,zsm.`zsm_name`,zsm.`HQ` FROM zsm
LEFT JOIN  asm ON asm.zsm_id=zsm.zsm_id
LEFT JOIN  bdm ON asm.asm_id=bdm.asm_id
 LEFT JOIN rx_save ON bdm.bdm_id=rx_save.bdm_id 
WHERE rx_save.created_at='$date' and bdm.status='Active' 
GROUP BY zsm.zsm_id ORDER BY SUM DESC LIMIT 1";
         $result_array = Query::executeQuery($sql);
                   return !empty($result_array) ? array_shift($result_array) : false;

    }
     public static function zone() {
        $sql= " SELECT DISTINCT(zone) FROM  bdm ";
           return Query::executeQuery($sql);
    }
       
     public static function hq($HQ) {
        $sql= "SELECT  DISTINCT(hq) as HQ FROM  bdm  WHERE zone='$HQ' and bdm.status='Active'  ";
           return Query::executeQuery($sql);
    }
      public static function  list_bdm ($hq) {
        $sql= "    SELECT bdm_name, bdm_id FROM bdm WHERE HQ='$hq' and bdm.status='Active' ";
       
           return Query::executeQuery($sql);
    }
     public static  function last_enteries(){
         $sql="SELECT d.*,r.rx,r.created_at,r.rx,(CASE WHEN b.`bdm_name` IS NOT NULL THEN b.`bdm_name` ELSE tf.name END) AS NAME, 
             (CASE WHEN b.`HQ` IS NOT NULL THEN b.`HQ` ELSE tf.HQ END) AS HQ ,r.bdm_id FROM `rx_save` r 
             LEFT JOIN `doctor` d ON r.`doc_id` = d.`doc_id` LEFT JOIN `bdm` b ON r.`bdm_id` = b.`bdm_id` AND r.type='bdm' 
             LEFT JOIN `task_force` tf ON r.`bdm_id` = tf.`tfid` AND r.type='tf' ORDER BY r.`id` DESC LIMIT 15
  ";
          return Query::executeQuery($sql);
     }
   
}
