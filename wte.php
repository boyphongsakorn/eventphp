<?php
session_start();
include 'config.php';

$sql = "INSERT INTO device VALUES ('".$_POST['devid']."','test')";

if ($conn->query($sql) === TRUE) {
  //echo "0";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$id = substr(uniqid(),0,13);

$sql = "SELECT joe_id,joe_exitevent FROM joinevent WHERE dev_id = '".$_POST['devid']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if($conn->query($sql)->fetch_assoc()['joe_exitevent'] == '0000-00-00 00:00:00'){
        echo "0.1";
        exit();
    }else{
        $sql = "UPDATE joinevent SET joe_inevent=NOW(),joe_exitevent=0 WHERE dev_id='".$_POST['devid']."'";

        if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
            $sql = "INSERT INTO jeeventhis VALUES ('".$id."','".$_POST['eventuser']."', '".$_POST['eventid']."', NOW(), 0, '".$_POST['devid']."')";
            if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
                echo "1";
            }
        } else {
            echo "0.3";
        }
        exit();
    }
}

$sqltwo = "SELECT joe_id,joe_inevent FROM joinevent WHERE euse_id = '".$_POST['eventuser']."' AND eve_id = '".$_POST['eventid']."' AND joe_inevent < '".date("Y-m-d H:i:s")."'";
$resulttwo = $conn->query($sqltwo);

if ($resulttwo->num_rows > 0) {
    echo "0.2";
    exit();
}

$sql = "INSERT INTO joinevent VALUES ('".$id."','".$_POST['eventuser']."', '".$_POST['eventid']."', NOW(), 0, '".$_POST['devid']."', 0)";

if ($conn->query($sql) === TRUE) {
    $sql = "INSERT INTO jeeventhis VALUES ('".$id."','".$_POST['eventuser']."', '".$_POST['eventid']."', NOW(), 0, '".$_POST['devid']."')";
    if ($conn->query($sql) === TRUE) {
        echo "1";
    }
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    echo "0.3";
}

$conn->close();

?>