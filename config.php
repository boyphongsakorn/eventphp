<?php
date_default_timezone_set("Asia/Bangkok");

$conn = mysqli_connect("localhost","teamquadbi_event","team1556th","teamquadbi_event");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$conn -> set_charset("utf8");
?>