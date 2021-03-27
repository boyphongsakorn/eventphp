<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$id = substr(uniqid(),0,10);

if(isset($_FILES["eventimage"])){
  $hasimg = '1';
  $imgtype = pathinfo($_FILES["eventimage"]["name"], PATHINFO_EXTENSION);
} else {
  $hasimg = '0';
  $imgtype = "";
}

$sql = "INSERT INTO event_list VALUES ('".$id."','".$_POST['eventname']."', '".$_POST['eventaddress']."', '".$_POST['eventtheme']."', '".$_POST['eventmax']."', '".$_POST['eventprice']."', '".$hasimg."', '".$imgtype."', '".$_POST['eventstarttime']."', '".$_POST['eventendtime']."', '".$_SESSION["adminid"]."', '".$_SESSION["adminid"]."')";

if ($conn->query($sql) === TRUE) {

    move_uploaded_file($_FILES["eventimage"]["tmp_name"], "img/event/".$id.".".pathinfo($_FILES["eventimage"]["name"], PATHINFO_EXTENSION));
    ?>
    <script>
    Swal.fire(
      'เรียบร้อย',
      'เพิ่มสัมมนาเรียบร้อยแล้ว',
      'succes'
    ).then((result) => {
      window.location.replace("dashboard.php");
    })
    </script>
    <?
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>