<?php
session_start();
include 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <center><h1>ลิงค์อุปกรณ์กับบัญชีของ <?php echo $_GET["name"] ?></h1></center>
    
    <form method="post" action="ldsend.php">
    <input type="hidden" name="userid" value="<?php echo $_GET["userid"] ?>">
    <select class="form-select" aria-label="Default select example" name="devid">
        <?
        $sql = "SELECT dev_id FROM event_user WHERE dev_id <> 'NULL'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $athing = "WHERE dev_id <> '".$row['dev_id']."'";
              if ($result->num_rows > 1) {
                $athing .= "AND ";
              }
            }
            if ($result->num_rows > 1) {
                $athing = substr($athing, 0, -3);
            }
        }else{
            $athing = "";
        }

        $sql = "SELECT * FROM device ".$athing;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
                <option selected value="<?php echo $row['dev_id']; ?>">อุปกรณ์ : <?php echo $row['dev_id']; ?> ชื่ออุปกรณ์ : <?php echo $row['dev_name']; ?> </option>
        <?php
            }
        } else {
        ?>
            <option selected>ยังไม่มีอุปกรณ์</option>
        <?
        }
        ?>
    </select>
    <button type="submit" class="btn btn-primary">ลิงค์อุปกรณ์</button>
    <a class="btn btn-secondary" href="userlist.php" role="button">ยกเลิก</a>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>