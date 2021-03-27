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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>
<body>

<?php include_once 'menu.php'; ?>

    <?php
    $sql = "SELECT * FROM event_user WHERE euse_id = '".$_SESSION["loginid"]."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    <div class="container">
        <center class="mt-1"><h1>แก้ไขโปรไฟล์</h1></center>
        <form action="submitep.php" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">เลขบัตรประจำตัวประชาชน</span>
            <input type="text" class="form-control" placeholder="idpp" aria-label="idpp" aria-describedby="basic-addon1" value="<?php echo $data["euse_id"] ?>" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">ชื่อ-นามสกุล</span>
            <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon1" value="<?php echo $data["euse_name"] ?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">ชื่อผู้ใช้</span>
            <input type="text" class="form-control" name="username" placeholder="username" aria-label="username" aria-describedby="basic-addon2" value="<?php echo $data["euse_username"] ?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">รหัสผ่าน</span>
            <input type="password" class="form-control" name="password" placeholder="password" aria-label="password" aria-describedby="basic-addon3" value="<?php echo $data["euse_password"] ?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon4">อีเมล</span>
            <input type="email" class="form-control" name="email" placeholder="email" aria-label="email" aria-describedby="basic-addon4" value="<?php echo $data["euse_email"] ?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon5">ที่อยู่</span>
            <input type="text" class="form-control" name="address" placeholder="address" aria-label="address" aria-describedby="basic-addon5" value="<?php echo $data["euse_address"] ?>" required>
        </div>
        <div style="display: -webkit-inline-box;text-align: center;"><p class="mt-1">ยืนยันรหัสก่อนการแก้ไข</p> <input type="password" class="form-control" name="passconfirm" id="passconfirm" onkeyup="confirm()"><button class="btn btn-primary" type="submit" id="busu" disabled>ยืนยัน</button></div>
        </form>
    </div>
        
<?php include_once 'larmod.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
    function confirm() {
        if(document.getElementById('passconfirm').value.length != 0) {
            document.getElementById('busu').disabled = false
        }else{
            document.getElementById('busu').disabled = true
        }
    }
    </script>
</body>
</html>