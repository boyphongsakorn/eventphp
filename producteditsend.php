<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "UPDATE product SET pro_name='".$_POST['name']."',pro_price='".$_POST['price']."',pro_count='".$_POST['count']."',pro_unit='".$_POST['unit']."' WHERE pro_id='".$_POST['id']."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'แก้ไขเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("fillproduct.php");
      })
    </script>
    <?php
} else {
    echo "Error updating record: " . $conn->error;
}
  
$conn->close();
?>