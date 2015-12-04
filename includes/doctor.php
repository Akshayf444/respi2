<?php
class doctor extends Table {

    protected $table_name = "doctor";

public static function  find_by_bdm($bdm_id){
         $sql="SELECT doctor.*,SUM(rx_save .rx) AS rx_sum FROM doctor LEFT JOIN rx_save ON doctor.doc_id=rx_save.doc_id AND rx_save.type='bdm' 
 WHERE doctor.bdm_id='$bdm_id' GROUP BY doctor.`doc_id`";
 
          return Query::executeQuery($sql);
     }
      public static function find_by_doc_id($id){
              $sql="select * from  doctor where doc_id='$id' ";
            $result_array = Query::executeQuery($sql);
        return $result_array;
     }
     public static function  find_by_date($bdm_id){
         $date=  date('Y:m:d');
         $sql="select doctor.*,SUM(rx_save .rx) as sum from doctor left join rx_save on doctor.doc_id=rx_save.doc_id where doctor.bdm_id='$bdm_id'  and rx_save.created_at='$date'group by doctor.doc_id";
          return Query::executeQuery($sql);
     }
    
//public static function  find_by_bdm($bdm_id){
//         $sql="select doctor.*,rx_save.rx  from doctor left join rx_save on doctor.doc_id=rx_save.doc_id where doctor.bdm_id='$bdm_id' and doctor.status='0'group by doctor.doc_id ORDER BY rx_save .rx DESC LIMIT 10";
//          return Query::executeQuery($sql);
//     }
     
     public static function  find_to_ho($bdm_id){
         $sql="select doctor.*,SUM(rx_save .rx) as sum from doctor left join rx_save on doctor.doc_id=rx_save.doc_id where doctor.created_at='$date'between doctor.created_at='$date2' group by doctor.created_at";
          return Query::executeQuery($sql);
     }
     
     public static function  find_by_rx($bdm_id){
         $sql="SELECT d.*,r.rx,r.created_at FROM `rx_save` r INNER JOIN `doctor` d ON r.`doc_id` = d.`doc_id` WHERE r.bdm_id = '$bdm_id'and r.type='bdm' ORDER BY r.`id` DESC LIMIT 10";
          return Query::executeQuery($sql);
     }
      public static function  list_doctor ($bdm_id) {
        $sql= "SELECT * FROM  doctor WHERE bdm_id='$bdm_id'  ";
        
           return Query::executeQuery($sql);
    }
    public static function  find_by_tf($tf_id){
         $sql="SELECT d.*,r.rx,r.created_at FROM `rx_save` r INNER JOIN `doctor` d ON r.`doc_id` = d.`doc_id` WHERE r.bdm_id = '$tf_id' and r.type='tf'  ORDER BY r.`id` DESC LIMIT 10";
          return Query::executeQuery($sql);
}
}