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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  </head>
  <body>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ไอดีอุปกรณ์</th>
      <th scope="col">ชื่ออุปกรณ์</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM device";
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <th scope="row"><?php echo $row['dev_id']; ?></th>
      <td><?php echo $row['dev_name']; ?></td>
      <td><a href="editdev.php?devid=<?php echo $row['dev_id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td><i class="fas fa-trash-alt"></i></td>
    </tr>
    <?php
        }
    } else {
      ?>
      <td>ยังไม่มีอุปกรณ์</td>
      <?
    }
    ?>
  </tbody>
</table>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
  </body>
</html>