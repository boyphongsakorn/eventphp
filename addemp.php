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

        <form method="post" action="empaddsend.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">เลขบัตรประชาชน</span>
                <input type="text" class="form-control" pattern="[0-9]{13}" name="id" placeholder="เลขบัตรประชาชนต้อง 13 หลักเท่านั้น" aria-label="id" aria-describedby="basic-addon1" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">ชื่อ-นามสกุล</span>
                <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon2" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">ชื่อผู้ใช้</span>
                <input type="text" class="form-control" name="username" placeholder="username" aria-label="username" aria-describedby="basic-addon3" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon4">รหัสผ่าน</span>
                <input type="password" class="form-control" name="password" placeholder="password" aria-label="password" aria-describedby="basic-addon4" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon5">ประเภทผู้ใช้</span>
                <select class="form-select" aria-label="Default select example" name="rule">
                    <option value="0">ผู้ดูแลระบบ</option>
                    <option value="1" selected>พนักงาน</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon6">ที่อยู่</span>
                <input type="text" class="form-control" name="address" placeholder="address" aria-label="address" aria-describedby="basic-addon6">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon7">เบอร์โทร</span>
                <input type="tel" class="form-control" name="tel" placeholder="0812345679" pattern="[0-9]{10}" aria-label="tel" aria-describedby="basic-addon7" required>
            </div>
            <input class="btn btn-primary" type="submit" value="ยืนยัน">
            <a class="btn btn-secondary" href="useremp.php" role="button">ยกเลิก</a>
        </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>