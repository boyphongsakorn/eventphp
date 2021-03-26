<?php
session_start();
include 'config.php';

$sql = "UPDATE joinevent SET joe_money=joe_money+".$_POST['price']." WHERE dev_id = '".$_POST['devid']."'";
$result = $conn->query($sql);

if ($conn->affected_rows > 0) {
    $sql = "INSERT INTO topup VALUES ('".uniqid()."','".$_POST['devid']."',".$_POST['price'].",NOW(),'".$_POST['empid']."')";
    $result = $conn->query($sql);

    if ($conn->affected_rows > 0) {
        echo "1";
        echo $conn -> error;
    } else {
        echo "0.2";
    }
} else {
    echo "0.1";
}
?>