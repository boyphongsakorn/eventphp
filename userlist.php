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

      <th scope="col">เลขบัตรประจำตัวประชาชน</th>

      <th>ชื่อ-นามสกุล</th>

      <th>ชื่อผู้ใช้</th>

      <th>รหัสผ่าน</th>

      <th>อีเมล</th>

      <th>ที่อยู่</th>

      <!--th>เงินที่มีอยู่ในระบบ</th>

      <th>อุปกรณ์ RFID</th-->

    </tr>

  </thead>

  <tbody>

    <?php

    $sql = "SELECT * FROM event_user";

    $result = $conn->query($sql);

        

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

    ?>

    <tr>

      <th scope="row"><?php echo $row['euse_id']; ?></th>

      <td><?php echo $row['euse_name']; ?></td>

      <td><?php echo $row['euse_username']; ?></td>

      <td>*********</td>

      <td><?php echo $row['euse_email']; ?></td>

      <td><?php echo $row['euse_address']; ?></td>

      <!--td><?php echo $row['euse_money']; ?></td>

      <td><?php if($row['dev_id'] == NULL) {echo 'ยังไม่มี';}else{ echo $row['dev_id'];} ?></td>

      <td><a href="linkdevice.php?userid=<?php echo $row['euse_id']; ?>&name=<?php echo $row['euse_name']; ?>"><i class="fas fa-link" data-toggle="tooltip" data-placement="bottom" title="ลิงค์อุปกรณ์ RFID"></i></a></td-->

      <td><a href="edituser.php?userid=<?php echo $row['euse_id']; ?>"><i class="fas fa-user-edit"></i></a></td>

      <td><i class="fas fa-trash-alt" onclick="deleteuser('<?php echo $row['euse_id']; ?>')"></i></td>

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



    $(function () {

        $('[data-toggle="tooltip"]').tooltip()

    })



    function deleteuser(userid) {

    Swal.fire({

        title: 'ต้องการที่จะลบผู้ใช้นี้ใช่ไหม?',

        showDenyButton: false,

        showCancelButton: true,

        confirmButtonText: 'ใช่',

        cancelButtonText: 'ไม่',

    }).then((result) => {

        if (result.isConfirmed) {

            window.location.replace("userdelsend.php?userid="+userid)

        }

    })

    }

    </script>

  </body>

</html>