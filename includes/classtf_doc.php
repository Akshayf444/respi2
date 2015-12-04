<?php

class tf_doc extends Table {

    protected $table_name = "tf_doc";

    public static function find_by_id($doc_id, $tf_id) {
        $sql = " select * from tf_doc where doc_id='$doc_id' and tf_id='$tf_id'";
//               return Query::executeQuery($sql);
         $result_array=Query::executeQuery($sql);
         return !empty($result_array)? array_shift($result_array):FALSE;
    }
    public static function  list_doctor($tf_id){
        $sql="  SELECT `doctor`.*,SUM(rx_save.rx)as rx_sum FROM `task_force` tf 
INNER JOIN `tf_doc` ON `tf_doc`.`tf_id` = tf.tfid
INNER JOIN `doctor` ON `tf_doc`.`doc_id` = `doctor`.`doc_id`
LEFT JOIN `rx_save` ON `rx_save`.`doc_id` = `doctor`.`doc_id` AND rx_save.`type` = 'tf'
WHERE tf.tfid= '$tf_id' GROUP BY tf_doc.doc_id
  ";
//        $sql="SELECT doctor.* FROM tf_doc INNER JOIN doctor ON  tf_doc.doc_id=doctor.doc_id WHERE tf_doc.tf_id='$tf_id' ";
        return Query::executeQuery($sql);
        
    }
}
