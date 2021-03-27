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

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e46a42ada8.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">รหัสการจ่าย</th>
      <th scope="col">ผู้จ่าย</th>
      <th scope="col">ธนาคารที่โอน</th>
      <th scope="col">จำนวนที่จ่าย</th>
      <th scope="col">รูปภาพ</th>
      <th scope="col">วันที่</th>
      <th scope="col">การยืนยันการชำระ</th>
    </tr>
  </thead>
  <tbody>
    <?
    $sql = "SELECT reg_id,reg_payin FROM register WHERE eve_id = '".$_GET["eventid"]."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        //echo '<script>alert(\''.$row["reg_id"].'\');</script>';
        $sqltext = "SELECT * FROM payment WHERE pay_id = '".$row["reg_id"]."'";
        $resulttext = $conn->query($sqltext);
        if ($resulttext->num_rows > 0) {
            while($damnrow = $resulttext->fetch_assoc()) {
                ?>
                <tr>
                    <th scope="row"><? echo $damnrow["pay_id"] ?></th>
                    <?
                    $json = file_get_contents('https://event.teamquadb.in.th/getuserjson.php?euseid='.$damnrow["euse_id"]);
                    $obj = json_decode($json,true);
                    ?>
                    <td><? echo $obj[0]["euse_name"] ?></td>
                    <td><? echo $damnrow["pay_bank"] ?></td>
                    <td><? echo $damnrow["pay_money"] ?></td>
                    <td><a href="img/receipt/<? echo $damnrow["pay_id"] ?>.<? echo $damnrow["pay_typeimg"] ?>" target="_blank">ดูรูป</a></td>
                    <td><? echo $damnrow["pay_datetime"] ?></td>
                    <td><? if($row["reg_payin"]=="1") {echo "<i class=\"fas fa-check-circle\"></i>";}else{echo "<i class=\"fas fa-times-circle\"></i>";} ?></td>
                    <td <? if($row["reg_payin"]=="1") {?> style="display: none" <?php } ?>><a href="cfpay.php?regid=<? echo $damnrow["pay_id"] ?>&eventid=<?php echo $_GET["eventid"] ?>" data-toggle="tooltip" data-placement="left" title="ยืนยันการชำระ?"><i class="fas fa-paper-plane"></i></a></td>
                </tr>
                <?
            }
        }
        ?>
        
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->

    <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
  </body>
</html>