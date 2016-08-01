<?php

require_once("./includes/initialize.php");

$date = date('Y-m-d');
$sql = "SELECT 
  GROUP_CONCAT(DISTINCT(BM_Name)) AS BM_Name,
  `SM_Emp_Id`,
  `SM_Name`,
  `SM_Mobile` 
FROM
  `respi2_manpower` 
WHERE BM_Emp_Id NOT IN 
  (
  SELECT DISTINCT 
    (BM_Emp_ID) 
  FROM
    `respi2_activity` 
  WHERE DATE_FORMAT(created, '%Y-%m-%d') = '$date') GROUP BY `SM_Emp_Id` ";

$result = Query::executeQuery($sql);

foreach ($result as $value) {
    $message = "Dear " . $value->SM_Name . "," . PHP_EOL;
    $message .= "Following BMs have not reported today : " . $value->BM_Name ;
    $sendSMS = new SMS();
    //echo $message.'<br/>';
    $sendSMS->sendSMS($value->SM_Mobile, $message);
}
