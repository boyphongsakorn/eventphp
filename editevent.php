<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

if(isset($_FILES["editeventimage"])){
  $hasimg = '1';
  $imgtype = pathinfo($_FILES["editeventimage"]["name"], PATHINFO_EXTENSION);
} else {
  $hasimg = '0';
  $imgtype = "";
}

$sql = "SELECT eve_imgtype FROM event_list WHERE eve_id='".$_POST['eventid']."' AND eve_imgtype <> ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $typeimg = $row["eve_imgtype"];
    }
} else {
    $typeimg = "";
}

$sql = "UPDATE event_list SET eve_name='".$_POST['eventname']."',eve_address='".$_POST['eventaddress']."',eve_theme='".$_POST['eventtheme']."',eve_limit=".$_POST['eventmax'].",eve_price=".$_POST['eventprice'].",eve_timestart='".$_POST['eventstarttime']."',eve_timeend='".$_POST['eventendtime']."',emp_lastedit='".$_SESSION["adminid"]."',eve_hasimg='".$hasimg."',eve_imgtype='".$imgtype."' WHERE eve_id='".$_POST['eventid']."'";

if ($conn->query($sql) === TRUE) {
  if($hasimg=='1'){
    unlink("img/event/".$_POST['eventid'].".".$typeimg);
    move_uploaded_file($_FILES["editeventimage"]["tmp_name"], "img/event/".$_POST['eventid'].".".pathinfo($_FILES["editeventimage"]["name"], PATHINFO_EXTENSION));
  }else{
    unlink("img/event/".$_POST['eventid'].".".$typeimg);
  }
  
  ?>
  <script>
    Swal.fire(
      'เรียบร้อย',
      'แก้ไขสัมมนาเรียบร้อยแล้ว',
      'succes'
    ).then((result) => {
      window.location.replace("dashboard.php");
    })
  </script>
  <?php
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

?>