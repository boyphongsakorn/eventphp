<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "UPDATE register SET reg_payin='1' WHERE reg_id='".$_GET["regid"]."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'ยืนยันการชำระเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("paylist.php?eventid=<? echo $_GET["eventid"] ?>");
      })
    </script>
    <?php
} else {
    echo "Error updating record: " . $conn->error;
}
  
$conn->close();
?>