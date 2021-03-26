<?php
session_start();
include 'config.php';

$sql = "SELECT * FROM joinevent INNER JOIN event_list ON joinevent.eve_id = event_list.eve_id WHERE dev_id = '".$_GET['devid']."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //$whois = "WHERE";
  //while($row = $result->fetch_assoc()) {
  //  $whois .= " euse_id='".$row["euse_id"]."' AND";
  //}
  //$whois = substr($whois, 0, -3);
  // output data of each row
  echo json_encode($result->fetch_all(MYSQLI_ASSOC));
  //$data = $conn->query("SELECT euse_id,euse_name FROM event_user ".$whois)->fetch_all(MYSQLI_ASSOC);
  //echo json_encode($data);
} else {
  echo "0";
}
$conn->close();
?>