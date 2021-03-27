<?php
session_start();
include '../config.php';

if(isset($_FILES["repimage"])){
    $hasimg = '1';
    $imgtype = pathinfo($_FILES["repimage"]["name"], PATHINFO_EXTENSION);
} else {
    echo '<script>alert("ไม่เห็นมีการแนบรูปภาพ")</script>';
    echo "<script type='text/javascript'>window.history.back();</script>";
    exit();
}

$norfor = date_create($_POST["time"]);
$var = date_format($norfor,"Y-d-m H:i");
//$var = $_POST["time"];
//$date = str_replace('/', '-', $var);
//echo '<script>alert("'.date('y-m-d', strtotime($date)).'")</script>';

$sql = "INSERT INTO payment VALUES ('".$_POST["regid"]."', '". $_SESSION["loginid"] ."', '".$_POST["bank"]."', ".$_POST["money"].", '".$imgtype."', '".$var."')";
echo $_POST["regid"];
if (mysqli_query($conn, $sql)) {
    $status=1;
    echo "New record created successfully";
    //$statustext='<script>alert("คุณได้จ่ายค่าสัมมนาจำนวน '. $_POST["money"] .'บาท");</script>';
    move_uploaded_file($_FILES["repimage"]["tmp_name"], "../img/receipt/".$_POST["regid"].".".pathinfo($_FILES["repimage"]["name"], PATHINFO_EXTENSION));
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

if($status==1){
    //echo $statustext;
    echo '<script>alert("ได้รับสลิปโอนเรียบร้อยแล้ว")</script>';
    echo "<script>window.open('https://event.teamquadb.in.th/slip/a4.php?userid=".$_SESSION["loginid"]."&regid=".$_POST["regid"]."', '_blank');</script>";
    echo "<script type='text/javascript'>window.location.replace('https://event.teamquadb.in.th');</script>";
} else {
    echo '<script>alert("ข้อมูลไม่ตรงกัน")</script>';
    echo "<script type='text/javascript'>window.history.back();</script>";
}
?>