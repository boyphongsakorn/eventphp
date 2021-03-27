<?php
session_start();
include 'config.php';

$sql = "SELECT * FROM event_user WHERE euse_id = '".$_GET["euseid"]."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $data = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
  echo json_encode($data);
} else {
  echo "0";
}
$conn->close();
?>