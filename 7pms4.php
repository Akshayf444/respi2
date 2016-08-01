<?php

require_once("./includes/initialize.php");
$bmlist = man_power::BMlist2(' > 100');

foreach ($bmlist as $BM) {
    $message = "Dear " . $BM->BM_Name . "," . PHP_EOL;
    $message .= "The Mebapp reporting system will be active only for today.Login now to share your team's performance for Go-Make A Difference." . PHP_EOL . "Regards" . PHP_EOL . "Cipla Respiratory";
    $sendSMS = new SMS();
    $sendSMS->sendSMS($BM->BM_Mobile, $message);
}
?>