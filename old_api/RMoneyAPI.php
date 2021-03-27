<?php
$transaction_id = $_GET['transaction_id'];
$password = $_GET['password'];
$amount = $_GET['real_amount'];
$status = $_GET['status'];

$conn = mysqli_connect("localhost","pwisetthon_pwmcsvdonate","Team1556th","pwisetthon_pwmcsvdonate");

if( $status == 1 )
    {
        $sql = "INSERT INTO pwmcsvdonate (Name,tran_id_tmpay, money, status, tmcode, payfrom, datetime)  VALUES ('". $_GET['nig'] ."','". $transaction_id ."', ". $amount .", ". $status .", ". $password .",1,'". date('Y-m-d H:i:s') ."')";
        //$result = mysqli_query($conn, $sql);
        $file_name='txt.txt';
        $edit_file = fopen($file_name, 'w');
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            fwrite($edit_file, $status.",".$password.",".$amount.",".$transaction_id."\n".mysqli_error($conn));
            fclose($edit_file);
        }
    /*die('SUCCEED|TOPPED_UP_THB_' . $amount . '_TO_' . $user_id_refill);*/
    }
else
    {
        $sql = "INSERT INTO pwmcsvdonate (Name,tran_id_tmpay, money, status, tmcode, payfrom, datetime)  VALUES ('". $_GET['nig'] ."','". $transaction_id ."', ". $amount .", ". $status .", ". $password .",1,'". date('Y-m-d H:i:s') ."')";
        //$result = mysqli_query($conn, $sql);
        $file_name='txt.txt';
        $edit_file = fopen($file_name, 'w');
        
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            fwrite($edit_file, $status.",".$password.",".$amount.",".$transaction_id."\n".mysqli_error($conn));
            fclose($edit_file);
        }
    /* ไม่สามารถเติมเงินได ้ */
    /*die('ERROR|ANY_REASONS');*/
    }
mysqli_close($conn);
?>