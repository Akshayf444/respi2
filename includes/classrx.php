<?php
class rx extends Table {
    protected $table_name = "rx_save";
    public static function sum_rx($doc_id) {
        $date = date('Y:m:d');
        $sql = "select SUM(rx)as sum from  rx_save  where doc_id='$doc_id' and created_at='$date'";
        $result_array = Query::executeQuery($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }
    public static function live_sum() {
        $sql = "SELECT bdm.zone AS zone,SUM(rx_save.rx) AS sum_rx , COUNT(DISTINCT(rx_save.doc_id)) AS prescriber FROM bdm LEFT JOIN rx_save ON bdm.bdm_id=rx_save.bdm_id 
                    GROUP BY bdm.zone
                    
                UNION ALL
                SELECT 'All India',SUM(rx_save.rx) AS sum_rx , COUNT(DISTINCT(rx_save.doc_id)) AS prescriber FROM bdm LEFT JOIN rx_save ON bdm.bdm_id=rx_save.bdm_id";
        $result_array = Query::executeQuery($sql);
        return $result_array;
    }
    public static function exit_record($doc_id, $bdm_id, $type) {
        $date = date('Y-m-d');
       
        $sql = "select * from  rx_save where created_at='$date'and doc_id='$doc_id' and type='$type' and bdm_id='$bdm_id'";
       
        $result_array = Query::executeQuery($sql);
        return !empty($result_array) ? array_shift($result_array) : FALSE;
    }
}
