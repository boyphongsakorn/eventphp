<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "SELECT eve_imgtype FROM event_list WHERE eve_id='".$_GET["eventid"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $typeimg = $row["eve_imgtype"];
    }
} else {
    $typeimg = "";
}

// sql to delete a record
$sql = "DELETE FROM event_list WHERE eve_id='".$_GET["eventid"]."'";

if ($conn->query($sql) === TRUE) {
    if($typeimg != ""){
        unlink("img/event/".$_GET["eventid"].".".$typeimg);
    }
  ?>
    <script>
        Swal.fire(
            'เรียบร้อย!',
            'ได้ลบสัมมนานี้เรียบร้อยแล้ว',
            'succes'
        ).then((result) => {
            window.location.replace("dashboard.php")
        })
    </script>
  <?
} else {
    ?>
    <script>
        Swal.fire(
            'ไม่สำเร็จ!',
            'สัมมนานี้ไม่สามารถลบได้ เนี่องจากมีผู้ลงทะเบียนแล้ว',
            'error'
        ).then((result) => {
            window.location.replace("dashboard.php")
        })
    </script>
    <?
}

?>