<?php

session_start();

include 'config.php';

?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



    <title>Hello, world!</title>

</head>

<body>

<table class="table">

<thead>

    <tr>

      <th scope="col">รหัส</th>

      <th scope="col">ชื่อ</th>
      <? if (!isset($_GET['notpay'])) { ?>
      <th scope="col">จ่ายค่าสัมมนาหรือยัง?</th>
      <? } ?>
      <th scope="col">เข้างานหรือยัง?</th>

    </tr>

</thead>

<tbody>

    <?

    $sql = "SELECT * FROM register WHERE eve_id = '".$_GET["eventid"]."'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

    ?>

    <tr>

        <th scope="row"><?php echo $row["euse_id"] ?></th>

        <td><?php echo $conn->query("SELECT euse_name FROM event_user WHERE euse_id = '".$row["euse_id"]."'")->fetch_assoc()["euse_name"]?></td>
        <? if (!isset($_GET['notpay'])) { ?>
        <td><?php if($row["reg_payin"] == '1' && $conn->query("SELECT * FROM payment WHERE pay_id = '".$row["reg_id"]."' AND euse_id = '".$row["euse_id"]."'")->num_rows>0){echo 'จ่ายแล้ว';}else if($row["reg_payin"] == '0' && $conn->query("SELECT * FROM payment WHERE pay_id = '".$row["reg_id"]."' AND euse_id = '".$row["euse_id"]."'")->num_rows>0){echo 'จ่ายแล้ว แต่ยังไม่ยืนยันการชำระ';}else{echo 'ยังไม่จ่าย';} ?></th>
        <? } ?>
        <td><?php if($conn->query("SELECT * FROM joinevent WHERE eve_id = '".$_GET["eventid"]."' AND euse_id = '".$row["euse_id"]."'")->num_rows>0){echo "เข้าร่วมงานแล้ว";}else{echo "ยังไม่เข้าร่วมงาน";} ?></td>

    </tr>

    <?

        }

    } else {

        echo "0 results";

    }

    ?>

</tbody>

</table>



    <!-- Optional JavaScript; choose one of the two! -->



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>