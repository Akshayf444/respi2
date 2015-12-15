<?php

class SMS extends Table {

    protected $table_name = 'respi2_sms';

    function sendSMS($mobile, $messages) {
        //echo $mobile."-".$messages."<br/>";
        $authKey = "78106A1u8VLmCC054cb666b";
        $mobileNumber = $mobile;
        $senderId = "GMADIF";
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
        $this->countSMS2($messages, $mobile);
        //return $output;
    }

    function countSMS2($message, $mobile) {
        $finalMessage = $message;
        $msg_count = 0;
        if (strlen($finalMessage) > 0 && strlen($finalMessage) <= 161) {
            $msg_count = 1;
        } elseif (strlen($finalMessage) > 161 && strlen($finalMessage) <= 307) {
            $msg_count = 2;
        } elseif (strlen($finalMessage) > 307) {
            $msg_count = 3;
        } else {
            echo 'msg not sent';
        }
        $mobileNoCount = count(explode(",", $mobile));

        $field_array = array('created' => date("Y-m-d H:i:s", time()), 'mobile' => $mobile, 'message' => $message, 'count' => ($msg_count * $mobileNoCount));
        $this->create($field_array);
    }

}
