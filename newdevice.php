<?
include 'config.php';

$sql = "INSERT INTO device VALUES ('".$_GET['did']."','test')";

if ($conn->query($sql) === TRUE) {
  echo "0";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>