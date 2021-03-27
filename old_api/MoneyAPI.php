<?php
tmn_refill($_POST['tmcode']);
function tmn_refill ($truemoney_password)
    {
        if(function_exists('curl_init'))
            {
                $curl=curl_init('https://www.tmpay.net/TPG/backend.php?merchant_id=KC19082710&password=' . $truemoney_password . '&resp_url=https://pwisetthon.com/mcsv/donate/api/RMoneyAPI.php?nig='. $_POST['name']);
                curl_setopt($curl, CURLOPT_TIMEOUT, 10);
                curl_setopt($curl, CURLOPT_HEADER, FALSE);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                $curl_content = curl_exec($curl);
                echo $curl_content;
                curl_close($curl);
            }
        else
            {
                $curl_content = file_get_contents('http://www.tmpay.net/TPG/backend.php?merchant_id=KC19082710&password=' . $truemoney_password . '&resp_url=https://pwisetthon.com/mcsv/donate/api/RMoneyAPI.php?nig='. $_POST['name']);
            }
        if(strpos($curl_content,'SUCCEED') !== FALSE)
            {
                $message = "ระบบรับรหัสบัตรเรียบร้อยแล้ว สามารถติดตามผลได้ที่หน้า ปุ่ม True Money ในหน้า Donate";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script type='text/javascript'>window.location.replace('https://pwisetthon.com/mcsv/donate/');</script>";
                return true;
            }
        else
            {
                $message = "ระบบรับรหัสบัตรเรียบร้อยแล้ว แต่รหัสบัตรไม่ถูกต้อง ไม่สามารถทำรายการได้";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script type='text/javascript'>history.go(-1);</script>";
                return false;
            }
    }

?>