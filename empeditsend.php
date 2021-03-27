<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "UPDATE employees SET emp_name='".$_POST["name"]."',emp_username='".$_POST["username"]."',emp_password='".md5($_POST["password"])."',emp_rule='".$_POST["rule"]."',emp_address='".$_POST["address"]."',emp_tel='".$_POST["tel"]."' WHERE emp_id='".$_POST["id"]."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'แก้ไขเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("useremp.php");
      })
    </script>
    <?php
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();
?>