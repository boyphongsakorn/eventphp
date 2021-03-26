<?php

session_start();

include 'config.php';

$sql = "UPDATE joinevent SET joe_exitevent=NOW() WHERE dev_id='".$_POST['devid']."'";

if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
  $sql = "UPDATE jeeventhis SET jee_exitevent=NOW() WHERE dev_id='".$_POST['devid']."' AND jee_exitevent='0000-00-00 00:00:00'";
  if ($conn->query($sql) === TRUE && $conn->affected_rows > 0) {
    echo "1";
  }
} else {
echo "0.1";
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>