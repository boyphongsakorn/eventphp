<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

if(!isset($_SESSION["adminname"]))
{
    header("location: https://event.teamquadb.in.th" );
    exit(0);
}

$sql = "UPDATE event_user SET euse_username='".$_POST['username']."',euse_password='".$_POST['password']."',euse_name='".$_POST['name']."',euse_email='".$_POST['email']."',euse_money='".$_POST['money']."',euse_address='".$_POST['address']."' WHERE euse_id='".$_POST['id']."'";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'แก้ไขเรียบร้อยแล้ว',
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