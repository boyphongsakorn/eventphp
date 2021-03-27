<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include '../config.php';

$sql = "INSERT INTO agency VALUES ('".substr(uniqid(),0,10)."','".$_POST["name"]."','".$_POST["address"]."','".$_POST["tel"]."','".$_POST["email"]."','".$_POST["type"]."')";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'เพิ่มหน่วยงานเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("agelist.php");
      })
    </script>
    <?php
  } else {
    ?>
    <script>
      Swal.fire(
        'ล้มเลว',
        'มีเลขประชาชนนี้อยู่แล้ว',
        'error'
      ).then((result) => {
        window.location.replace("agelist.php");
      })
    </script>
    <?
  }
  
  $conn->close();
?>