<?php
session_start();
include 'config.php';
if(isset($_SESSION["adminusername"])){
  header("Location: dashboard.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <form action="checklogin.php" method="post">
            <div class="form-group">
                <label for="usernameadmin">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="usernameadmin" name="usernameadmin" required>
            </div>
            <div class="form-group">
                <label for="passwordadmin">รหัสผ่าน</label>
                <input type="password" class="form-control" id="passwordadmin" name="passwordadmin" required>
            </div>
            <input type="hidden" name="class" value="admin">
            <button type="submit" class="btn btn-primary">ล็อกอิน</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>