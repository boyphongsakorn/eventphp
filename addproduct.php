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

        <form method="post" action="productaddsend.php">
            <!--div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">รหัสสินค้า</span>
                <input type="text" class="form-control" name="id" placeholder="id" aria-label="id" aria-describedby="basic-addon1">
            </div-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">ชื่อสินค้า</span>
                <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">ราคา</span>
                <input type="number" class="form-control" name="price" min="0" placeholder="price" aria-label="price" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon4">จำนวน</span>
                <input type="number" class="form-control" name="count" min="0" placeholder="count" aria-label="count" aria-describedby="basic-addon4">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon5">หน่วยนับ</span>
                <input type="text" class="form-control" name="unit" placeholder="unit" aria-label="unit" aria-describedby="basic-addon5">
            </div>
            <input class="btn btn-primary" type="submit" value="ยืนยัน">
            <a class="btn btn-secondary" href="fillproduct.php" role="button">ยกเลิก</a>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>