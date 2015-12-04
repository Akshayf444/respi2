<?php

class pob extends Table {
protected $table_name = "pob";
public static function total($bdm){
      $sql="select SUM(pob)as sum from  pob where bdm_id='$bdm'  and type='bdm' ";
            $result_array = Query::executeQuery($sql);
        return $result_array;
     
    
}
public static function last($id)
{
 $sql=   "SELECT * FROM pob WHERE bdm_id='$id'  and type='bdm'  ORDER BY pob_id DESC LIMIT 1";
  $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
}

public static function total_till_date($bdm){
    $date=  date('Y:m:d');
      $sql="select SUM(pob)as sum from pob where bdm_id='$bdm' and created_at='$date' and type='bdm' ";
            $result_array = Query::executeQuery($sql);
        return $result_array;
     
    
}
public static function live_pob(){
    $date=  date('Y:m:d');
      $sql="SELECT bdm.zone,SUM(pob.pob) AS s FROM bdm LEFT JOIN pob ON bdm.bdm_id=pob.bdm_id GROUP BY bdm.zone ";
            $result_array = Query::executeQuery($sql);
        return $result_array;
     
    
}
public static function total_tf($tf){
      $sql="select SUM(pob)as sum from pob where bdm_id='$tf' and type='tf' ";
            $result_array = Query::executeQuery($sql);
        return $result_array;
     
    
}
public static function last_tf($id)
{
 $sql=   "SELECT * FROM pob WHERE bdm_id='$id'and type='tf' ORDER BY pob_id DESC LIMIT 1";
  $result_array = Query::executeQuery($sql);
            return !empty($result_array) ? array_shift($result_array) : false;
}
 
  
}