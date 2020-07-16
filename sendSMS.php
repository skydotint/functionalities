<?php

function sendSMS($receiver, $message)
    {
        
         $receivers = explode(',',$receiver);

        $rand = random_code();
        $smscontent = urlencode($message);
        $user = 'rflus';
        $pass ='18d=5P45';
        $sid = 'RfLusEng';
        $url="http://sms.sslwireless.com/pushapi/dynamic/server.php";

        $param = "user=$user&pass=$pass";
        $i = 0;
        foreach ($receivers as $receiver){

            $param .=    "&sms[".$i."][0]= ".$receiver." &sms[".$i."][1]=". $smscontent."&sms[".$i."][2]=".$rand;
            ++$i;
        }
        $param .=   "&sid=$sid";
        //dd($param);

        $crl = curl_init();
        curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($crl,CURLOPT_URL,$url);
        curl_setopt($crl,CURLOPT_HEADER,0);
        curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($crl,CURLOPT_POST,1);
        curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
        $response = curl_exec($crl);
        curl_close($crl);
    }
