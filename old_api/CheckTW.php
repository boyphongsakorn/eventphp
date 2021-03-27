<?php
session_start();
include '../config.php';

$phone = '0801643864';
$password = 'team1556th';
$otp_code = '061879';
$otp_ref = 'RHVV';
$access_token = 'e77fac71-1ee6-4760-b9ca-98f5c0e95667';

require "Truewallet.php";
$tw = new TrueWalletClass($phone, $password);

print_r($tw->RequestLoginOTP());
//print_r($tw->SubmitLoginOTP($otp_code, $phone, $otp_ref));

$tw->setAccessToken($access_token);
$data = $tw->GetTransaction();
/*
foreach ($data["data"]["activities"] as $transfer) {
    $values = $tw->GetTransactionReport($transfer["report_id"]);
    print_r($values);
}

$transactions = $tw->getTransaction(50);
foreach($transactions['data']['activities'] as $report) {
    print_r($allwallet);
}


require_once("TrueWallet.class.php");

$username='boy1556@hotmail.com';
$password='team1556th';
$otp_code='946420';
$mobile_number='0801643864';
$otp_reference='ZMQV';
$reference_token='92f55e7a98b73367c2bd69057d1d7198';

$tw = new TrueWallet($username, $password);
print_r($tw->RequestLoginOTP());
print_r($tw->SubmitLoginOTP($otp_code, $mobile_number, $otp_reference));
print_r($tw->access_token); // Access Token
print_r($tw->reference_token); // Reference Token*/

// Login with Credentials and Reference Token.
//$tw = new TrueWallet($username, $password, $reference_token);
//$tw->Login();
//$tw->access_token; // Access Token

//$access_token='f103f974-247f-4a67-8e6d-99a1e3f9ffc7';
// Login with Access Token.
//$tw = new TrueWallet($access_token);

// Example Usage with Transaction History.
$transactions = $tw->getTransaction(50); // Fetch last 50 transactions. (within the last 30 days)
$status=0;
foreach($transactions['data']['activities'] as $report) {
    // Fetch transaction details.
    $allwallet = $tw->GetTransactionReport($report["report_id"]);
    if ($allwallet["code"]!="UPC-400"&&$allwallet["data"]["section1"]["title"]=="รับเงินจาก"&&$status!=1) {
        print_r($allwallet);
        //echo "<br><hr>";
        //echo $allwallet["data"]["section4"]["column2"]["cell1"]["value"];
        //echo ",";
        //echo $allwallet["data"]["ref1"];
        //echo ",";
        //echo $allwallet['data']['amount'];
        //echo "<br>";
        $date = explode('/', substr($allwallet["data"]["section4"]["column1"]["cell1"]["value"],0,8));
        $day = $date[0];
        $month = $date[1];
        $year = $date[2];
        if($allwallet['data']['amount']==$_POST["money"]&&$allwallet["data"]["section4"]["column1"]["cell1"]["value"]==$_POST["time"]){
            //$conn = mysqli_connect("localhost","pwisetthon_pwmcsvdonate","Team1556th","pwisetthon_pwmcsvdonate");
            $sql = "INSERT INTO payment VALUES ('".substr(uniqid(),0,10)."', '". $_SESSION["loginid"] ."', ".$allwallet['data']['amount'].", '". $year . "-" . $month . "-" . $day ." ". substr($allwallet["data"]["section4"]["column1"]["cell1"]["value"],9) ."')";
            $sql2 = "UPDATE register SET reg_payin='1' WHERE reg_id='".$_POST["regid"]."'";
            echo $_POST["regid"];
            if (mysqli_query($conn, $sql)&&mysqli_query($conn, $sql2)) {
                $status=1;
                echo "New record created successfully";
                $statustext='<script>alert("คุณ '. $allwallet["data"]["section2"]["column1"]["cell2"]["value"] .' ได้จ่ายค่าสัมมนาจำนวน '. $allwallet['data']['amount'] .'บาท");</script>';
                break;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        } else {
            $status=0;
        }
    }
}
if($status==1){
    echo $statustext;
    echo '<script>alert("คุณจ่ายค่าสัมมนาเรียบร้อยแล้ว")</script>';
    echo "<script type='text/javascript'>window.location.replace('https://event.teamquadb.in.th');</script>";
} else {
    echo '<script>alert("ข้อมูลไม่ตรงกัน")</script>';
    //echo "<script type='text/javascript'>history.go(-1);</script>";
}
?>