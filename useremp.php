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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  <body>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">รหัสพนักงาน</th>
      <th scope="col">ชื่อพนักงาน</th>
      <th scope="col">ชื่อผู้ใช้</th>
      <th scope="col">รหัสผ่าน</th>
      <th scope="col">ประเภทผู้ใช้</th>
      <th scope="col">ที่อยู่</th>
      <th scope="col">เบอร์โทร</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <th scope="row"><?php echo $row['emp_id']; ?></th>
      <td><?php echo $row['emp_name']; ?></td>
      <td><?php echo $row['emp_username']; ?></td>
      <td>*********<?php //echo $row['emp_password']; ?></td>
      <td><?php if($row['emp_rule'] == 0){echo 'ผู้ดูแลระบบ';}else{echo 'พนักงาน';}; ?></td>
      <td><?php echo $row['emp_address']; ?></td>
      <td><?php echo $row['emp_tel']; ?></td>
      <td <? if($_SESSION["ruletype"] == '1' && $_SESSION["adminid"] != $row['emp_id']) { echo "style=\"display:none;\""; } ?>><a href="editemp.php?empid=<?php echo $row['emp_id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td <? if($_SESSION["ruletype"] == '1' && $_SESSION["adminid"] != $row['emp_id']) { echo "style=\"display:none;\""; } ?>><i class="fas fa-trash-alt" onclick="deleteemp('<?php echo $row['emp_id']; ?>')"></i></td>
    </tr>
    <?php
        }
    } else {
      echo "0 results";
    }
    ?>
  </tbody>
</table>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
    function deleteemp(empid) {
      var adminlogin = <?php echo $_SESSION["adminid"] ?>;
      if(empid == adminlogin){
        Swal.fire(
          'ไม่สามารถลบได้',
          'คุณไม่สามารถลบบัญชีของตัวเองได้',
          'error'
        )
      }else{
        Swal.fire({
          title: 'ต้องการที่จะลบพนักงานนี้ใช่ไหม?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ไม่',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.replace("empdelsend.php?empid="+empid)
          }
        })
      }
    }
    </script>
  </body>
</html>