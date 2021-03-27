<?php
session_start();
include 'config.php';
if(!isset($_SESSION["adminname"]))
{
    header("location: https://event.teamquadb.in.th" );
    exit(0);
}
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
    $sql = "SELECT * FROM event_user WHERE euse_id='".$_GET['userid']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
        
    if ($result->num_rows > 0) {
        ?>
        <form method="post" action="usereditsend.php">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">ไอดี/เลขบัตรประชาชน</span>
                <input type="text" class="form-control" name="id" placeholder="id" aria-label="id" aria-describedby="basic-addon1" value="<?php echo $data['euse_id'];?>" readonly>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">ชื่อ-นามสกุล</span>
                <input type="text" class="form-control" name="name" placeholder="name" aria-label="name" aria-describedby="basic-addon2" value="<?php echo $data['euse_name'];?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">ชื่อผู้ใช้</span>
                <input type="text" class="form-control" name="username" placeholder="username" aria-label="username" aria-describedby="basic-addon3" value="<?php echo $data['euse_username'];?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon4">รหัสผ่าน</span>
                <input type="password" class="form-control" name="password" placeholder="password" aria-label="password" aria-describedby="basic-addon4" value="<?php echo $data['euse_password'];?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon5">อีเมล</span>
                <input type="email" class="form-control" name="email" placeholder="email" aria-label="email" aria-describedby="basic-addon5" value="<?php echo $data['euse_email'];?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon6">ที่อยู่</span>
                <input type="text" class="form-control" name="address" placeholder="address" aria-label="address" aria-describedby="basic-addon6" value="<?php echo $data['euse_address'];?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon7">เงินในระบบ</span>
                <input type="number" class="form-control" name="money" placeholder="money" aria-label="money" aria-describedby="basic-addon7" value="<?php echo $data['euse_money'];?>">
            </div>
            <input class="btn btn-primary" type="submit" value="ยืนยัน">
            <a class="btn btn-secondary" href="userlist.php" role="button">ยกเลิก</a>
        </form>
        <?
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>