<?php
session_start();
include '../config.php';
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

        <form method="post" action="ageaddsend.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">ชื่อหน่วยงาน</span>
                <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon2" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">ที่อยู่</span>
                <input type="text" class="form-control" name="address" placeholder="address" aria-label="address" aria-describedby="basic-addon3" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon4">เบอร์โทร</span>
                <input type="tel" class="form-control" name="tel" pattern="[0-9]{10}" placeholder="tel" aria-label="tel" title="เบอร์โทรศัพท์ต้องมีสิบหลัก" aria-describedby="basic-addon4" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon6">อีเมล</span>
                <input type="mail" class="form-control" name="email" placeholder="email" aria-label="email" aria-describedby="basic-addon6">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon5">ประเภทผู้ใช้</span>
                <select class="form-select" aria-label="Default select example" name="type">
                    <option value="0">รัฐบาล</option>
                    <option value="1" selected>เอกชน</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="ยืนยัน">
            <a class="btn btn-secondary" href="agelist.php" role="button">ยกเลิก</a>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>