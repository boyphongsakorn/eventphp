<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include '../config.php';

if(isset($_FILES["image"])){
  $hasimg = '1';
  $imgtype = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
} else {
  $hasimg = '0';
  $imgtype = "";
}

$sql = "SELECT age_imgtype FROM agency WHERE age_id='".$_POST['id']."' AND age_imgtype <> ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $typeimg = $row["age_imgtype"];
    }
} else {
    $typeimg = "";
}

//$sql = "INSERT INTO agency VALUES ('".substr(uniqid(),0,10)."','".$_POST["name"]."','".$_POST["address"]."','".$_POST["tel"]."','".$_POST["email"]."','".$_POST["type"]."')";
//$sql = "UPDATE agency SET age_name='".$_POST["name"]."',age_address='".$_POST["address"]."',age_tel='".$_POST["tel"]."',age_email='".$_POST["email"]."',age_type='".$_POST["type"]."' WHERE age_id='".$_POST["id"]."'";
$sql = "UPDATE agency SET age_name='".$_POST["name"]."',age_address='".$_POST["address"]."',age_tel='".$_POST["tel"]."',age_email='".$_POST["email"]."',age_imgtype='".$imgtype."' WHERE age_id='".$_POST["id"]."'";

echo $sql;
if ($conn->query($sql) === TRUE) {
    if($hasimg=='1'){
      unlink("../img/agency/".$_POST['id'].".".$typeimg);
      move_uploaded_file($_FILES["image"]["tmp_name"], "../img/agency/".$_POST['id'].".".pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    }else{
    unlink("../img/agency/".$_POST['id'].".".$typeimg);
    }
    ?>
    <script>
      Swal.fire(
        'เรียบร้อย!',
        'แก้ไขหน่วยงานเรียบร้อยแล้ว',
        'succes'
      ).then((result) => {
        window.location.replace("agelist.php");
      })
    </script>
    <?php
  } else {
    ?>
    <script>
      Swal.fire(
        'ล้มเลว',
        'เป็นหยังบุ',
        'error'
      ).then((result) => {
        window.location.replace("agelist.php");
      })
    </script>
    <?
  }
  
  $conn->close();
?>