<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "UPDATE device SET dev_name='".$_POST['name']."' WHERE dev_id='".$_POST['id']."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'แก้ไขเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("devid.php");
      })
    </script>
    <?php
} else {
    echo "Error updating record: " . $conn->error;
}
  
$conn->close();
?>