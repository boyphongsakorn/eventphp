<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

//$sql = "INSERT INTO product VALUES ('".$_POST["id"]."','".$_POST["name"]."','".$_POST["price"]."','".$_POST["count"]."','".$_POST["unit"]."')";
$sql = "INSERT INTO product VALUES ('".substr(uniqid(),0,10)."','".$_POST["name"]."','".$_POST["price"]."','".$_POST["count"]."','".$_POST["unit"]."')";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
    Swal.fire(
        'เรียบร้อย!',
        'เพิ่มสินค้าเรียบร้อยแล้ว',
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