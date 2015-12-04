<?php

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function output_message($message = "") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function sendsms($mobile, $messages, $medical_id = 0) {
    $authKey = "78106A1u8VLmCC054cb666b";
    $mobileNumber = $mobile;
    $senderId = "PKTDRG";
    $message = $messages;
    $finalmessage = rawurlencode($message);
    $smsUser = 'manish';
    $smsPassword = '123456';
//Define route 
    $route = "4";
//Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $finalmessage,
        'sender' => $senderId,
        'route' => $route
    );
//API URL
    $url = "https://control.msg91.com/sendhttp.php";
// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
//,CURLOPT_FOLLOWLOCATION => true
    ));
//Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//get response
    $output = curl_exec($ch);
//Print error if any
    if (curl_errno($ch)) {
        echo 'error:' . curl_error($ch);
    }
    curl_close($ch);
//echo $output;
    countSMS($messages, $mobile, $medical_id);
    return $output;
}

function countSMS($message, $mobile, $medical_id = 0) {
    $finalMessage = $message;
    $msg_count = 0;
    if (strlen($finalMessage) > 0 && strlen($finalMessage) < 161) {
        $msg_count = 1;
    } elseif (strlen($finalMessage) > 161 && strlen($finalMessage) < 307) {
        $msg_count = 2;
    } elseif (strlen($finalMessage) > 307) {
        $msg_count = 3;
    } else {
        echo 'msg not sent';
    }
    $mobileNoCount = count(explode(",", $mobile));

    $field_array = array('medical_id' => $medical_id, 'created' => date("Y-m-d H:i:s", time()), 'mobile' => $mobile, 'message' => $message, 'count' => ($msg_count * $mobileNoCount));
    $medical_sms = new medical_sms;
    $medical_sms->create($field_array);
//    $smsCount->create();
}

function flashMessage($message, $type) {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (ucfirst($type) == 'Error') {

        $_SESSION['message'] = '<div class = "row"><div class = "col-lg-12 col-md-12"><div class="alert alert-danger"> '
                . '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                . '<strong>' . $message . '</strong></div></div></div>';
    }
    if (ucfirst($type) == 'Success') {
        $_SESSION['message'] = '<div class = "row"><div class = "col-lg-12 col-md-12"><div class="alert alert-success"> '
                . '<a href="#" class="close" data-dismiss="alert">&times;</a>'
                . '<strong>Success!! </strong>' . $message . '</div></div></div>';
    }
}

function pageHeading($heading, $smallHeading = '') {
    return '<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">' . $heading . '<small> ' . $smallHeading . '</small></h1>
                </div>      <!-- /.col-lg-12 -->
            </div>';
}

/* * ******************** Hours Array  *********************** */

function halfHourTimes() {
    $formatter = format($time);
    $halfHourSteps = range(0, 47 * 1800, 1800);
    return array_map($formatter, $halfHourSteps);
}

function format($time) {
    if ($time % 3600 == 0) {
        return date('Ga', $time);
    } else {
        return date('G:ia', $time);
    }
}

/* * *************** */

function hoursRange($lower = 0, $upper = 23, $step = 1, $format = NULL) {
    $hours = array();
    $start = "00:00";
    $end = "23:00";

    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;

    while ($tNow <= $tEnd) {
        $date = date("H:i", $tNow);
        array_push($hours, $date);
        $tNow = strtotime('+30 minutes', $tNow);
    }
    return $hours;
}

function _footer($position = '') {
    if ($position == 'fixed') {
        $position = 'position: fixed;';
    } else {
        $position = 'position: relative;';
    }
    $url = $GLOBALS['site_root'] . '/images/footer.png';
    echo '<div class="navbar navbar-inverse navbar-fixed-bottom footer" style="background: url(' . $url . ');border: 0;padding-top: 10px;margin-top:10px;cursor: pointer;' . $position . ' >
            <div class="container">
                <div class="col-lg-9">   
                    <a>About |</a>
                    <a>Career |</a>
                    <a>Media |</a>
                    <a>T&C |</a>
                    <a>Privacy Policy |</a>
                    <a>FAQ |</a>
                    <a>Blog</a>
                </div>
                <div class="col-lg-3">
                    Follow Us On : 
                    <a style="padding: 2px 6px 2px 7px;background-color: #DD4B39;color: white;border-radius: 5px;" href="#"><i class="fa fa-google-plus"> </i></a>
                    <a style="padding: 2px 6px 2px 7px;background-color: #3B5998;color: white;border-radius: 5px;" href="http://www.facebook.com/pocketdrugs/"><i class="fa fa-facebook"></i></a> 
                    <a style="padding: 2px 6px 2px 7px;background-color: #1AB7EA;color: white;border-radius: 5px;" href="#"> <i class="fa fa-vimeo-square"> </i></a>
                </div>   
            </div>
        </div>  ';
}

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

//function hex2bin($hexstr) {
//    $n = strlen($hexstr);
//    $sbin = "";
//    $i = 0;
//    while ($i < $n) {
//        $a = substr($hexstr, $i, 2);
//        $c = pack("H*", $a);
//        if ($i == 0) {
//            $sbin = $c;
//        } else {
//            $sbin.=$c;
//        }
//        $i+=2;
//    }
//    return $sbin;
//}
