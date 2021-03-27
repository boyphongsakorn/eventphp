<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

if(!isset($_SESSION["adminname"]))
{
    header("location: https://event.teamquadb.in.th" );
    exit(0);
}

$sql = "UPDATE event_user SET dev_id='".$_POST['devid']."' WHERE euse_id='".$_POST['userid']."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
    Swal.fire(
        'เรียบร้อย!',
        'ลิงค์อุปกรณ์เรียบร้อยแล้ว',
        'succes'
    ).then((result) => {
        window.location.replace("userlist.php");
    })
    </script>
    <?php
} else {
    echo "Error updating record: " . $conn->error;
}
  
  $conn->close();
?>