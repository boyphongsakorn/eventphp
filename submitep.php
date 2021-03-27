<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "UPDATE event_user SET euse_username='".$_POST["username"]."',euse_password='".$_POST["password"]."',euse_name='".$_POST["name"]."',euse_email='".$_POST["email"]."',euse_address='".$_POST["address"]."' WHERE euse_id='".$_SESSION["loginid"]."' AND euse_password='".md5($_POST["passconfirm"])."'";

if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย',
        'แก้ไขโปรไฟล์เรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("editprofile.php");
      })
    </script>
    <?php
  } else {
    ?>
    <script>
      Swal.fire(
        'เกิดปัญหา',
        'ไม่มีการแก้ไขหรือรหัสผ่านยืนยันไม่ถูกต้อง',
        'warning'
      ).then((result) => {
        window.location.replace("editprofile.php");
      })
    </script>
    <?
  }
  
  $conn->close();
?>