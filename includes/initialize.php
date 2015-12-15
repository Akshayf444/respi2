<?php

date_default_timezone_set("Asia/Kolkata");
if ($_SERVER['HTTP_HOST'] == 'jardiance.com') {
    $GLOBALS['site_root'] = 'http://' . $_SERVER['HTTP_HOST'];
} else {
    $GLOBALS['site_root'] = 'http://' . $_SERVER['HTTP_HOST'] . '/jardiance';
}
require_once('Autopaginate.php');
require_once('functions.php');
require_once('database.php');
require_once('Table.php');
require_once('classman_power.php');
require_once ('query.php');
require_once ('sm.php');
require_once ('Activity.php');
require_once ('SMS.php');
///require_once ('c:/wamp/www/jardiance/Classes/PHPExcel.php');
