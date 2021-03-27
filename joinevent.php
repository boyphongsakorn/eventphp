<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

//$sql = "INSERT INTO event_list VALUES ('".substr(uniqid(),0,10)."','".$_POST['eventname']."', '".$_POST['eventaddress']."', '".$_POST['eventtheme']."', '".$_POST['eventmax']."', '".$_POST['eventprice']."', '".$_POST['eventstarttime']."', '".$_POST['eventendtime']."', '".$_SESSION["adminid"]."', '".$_SESSION["adminid"]."')";
$sql = "INSERT INTO joinevent() VALUES ('".substr(uniqid(),0,13)."','1400300058696','5fc9bb8ba3',NOW(),NOW())";

if ($conn->query($sql) === TRUE) {
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