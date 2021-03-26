<?php
session_start();
include 'config.php';

$sqlcheckmoney = "SELECT joe_money FROM joinevent WHERE dev_id = '".$_POST['devid']."'";
//$result = $conn->query($sqlcheckmoney);

if ($conn->query($sqlcheckmoney)->num_rows > 0) {
    if($conn->query($sqlcheckmoney)->fetch_assoc()['joe_money'] == 0 || $conn->query($sqlcheckmoney)->fetch_assoc()['joe_money'] < $_POST['sumprice']){
        echo "0.2";
        exit();
    }
}

$lpb = json_decode($_POST['allpro'], true);

foreach (array_keys(array_count_values($lpb)) as $value){
    $sqlcpc = "SELECT pro_name,pro_count FROM product WHERE pro_id = '".$value."'";
    //$result = $conn->query($sqlcheckmoney);

    if ($conn->query($sqlcpc)->num_rows > 0) {
        if($conn->query($sqlcpc)->fetch_assoc()['pro_count'] < array_count_values($lpb)[$value]){
            echo "0.5,".$conn->query($sqlcpc)->fetch_assoc()['pro_name'].",".$conn->query($sqlcpc)->fetch_assoc()['pro_count'];
            exit();
        }
    }else{
        echo "0.1";
    }
}

$id = substr(md5(microtime()*rand(0,9999)),0,20);

$sql = "INSERT INTO buy_product VALUES ('".$id."','".$_POST['devid']."','".$_POST['sumprice']."',NOW())";
$result = $conn->query($sql);

if ($conn->affected_rows > 0){
//if ($conn->query($sql) === TRUE) {
    $testtest = 0 ;
    //echo "1";
    /*foreach (array_count_values(json_decode($_POST['allpro'], true)) as $value) {
        echo "$value <br>";
        $sqlpd = "INSERT INTO bp_list VALUES ('".$id."','".$_POST['devid']."','".$_POST['sumprice']."',NOW())";
        $resultpd = $conn->query($sqlpd);
    }*/
    foreach (array_keys(array_count_values($lpb)) as $value){
        //echo array_count_values($lpb)[$value];
        //echo "$value <br>";
        $sqlpd = "INSERT INTO bp_list VALUES ('".$id."','".$value."','".array_count_values($lpb)[$value]."')";
        $resultpd = $conn->query($sqlpd);
        if ($conn->affected_rows > 0){
            //$testtest = 1;
            $sqlup = "UPDATE product SET pro_count=pro_count-".array_count_values($lpb)[$value]." WHERE pro_id = '".$value."'";
            $resultup = $conn->query($sqlup);
            if ($conn->affected_rows > 0){
                $testtest = 1;
            }else{
                $testtest = 0;
                echo "0.3";
                exit();
            }
        }else{
            $testtest = 0;
            echo "0.3";
            exit();
        }
        //foreach (array_count_values($lpb) as $countvalue){
        //    echo $countvalue[$value];
        //}
    }
    if($testtest == 1){
        $sqldm = "UPDATE joinevent SET joe_money=joe_money-".$_POST['sumprice']." WHERE dev_id = '".$_POST['devid']."'";
        $resultdm = $conn->query($sqldm);
        if ($conn->affected_rows > 0){
            echo "1";
        }else{
            echo "0.4";
        }
    }
    //print_r(array_count_values(json_decode($_POST['allpro'], true)));
} else {
    echo "0.1";
    //echo $conn -> error;
}
?>