<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>

    <?php
    $sql = "SELECT * FROM device WHERE dev_id='".$_GET['devid']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
        
    if ($result->num_rows > 0) {
    ?>

        <form method="post" action="deveditsend.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">ไอดีอุปกรณ์</span>
                <input type="text" class="form-control" name="id" placeholder="id" aria-label="id" aria-describedby="basic-addon1" value="<?php echo $data["dev_id"];?>" readonly>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">ชื่ออุปกรณ์</span>
                <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon2" value="<?php echo $data["dev_name"];?>">
            </div>
            <input class="btn btn-primary" type="submit" value="ยืนยัน">
            <a class="btn btn-secondary" href="devid.php" role="button">ยกเลิก</a>
        </form>

    <?
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>