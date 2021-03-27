<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "INSERT INTO employees VALUES ('".$_POST["id"]."','".$_POST["name"]."','".$_POST["username"]."','".md5($_POST["password"])."','".$_POST["rule"]."','".$_POST["address"]."','".$_POST["tel"]."')";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'เพิ่มบัญชีเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("useremp.php");
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
        window.location.replace("useremp.php");
      })
    </script>
    <?
  }
  
  $conn->close();
?>