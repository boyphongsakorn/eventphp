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
      <th scope="col">รหัสสินค้า</th>
      <th scope="col">ชื่อสินค้า</th>
      <th scope="col">ราคาสินค้า</th>
      <th scope="col">จำนวนคงเหลือ</th>
      <th scope="col">หน่วยนับ</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <th scope="row"><?php echo $row['pro_id']; ?></th>
      <td><?php echo $row['pro_name']; ?></td>
      <td><?php echo $row['pro_price']; ?></td>
      <td><?php echo $row['pro_count']; ?></td>
      <td><?php echo $row['pro_unit']; ?></td>
      <td><a href="editproduct.php?proid=<?php echo $row['pro_id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td><i class="fas fa-trash-alt" onclick="deletepro('<?php echo $row['pro_id']; ?>')"></i></td>
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
    function deletepro(proid) {
      Swal.fire({
        title: 'ต้องการที่จะลบสินค้านี้ใช่ไหม?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.replace("productdelsend.php?proid="+proid)
        }
      })
    }
    </script>
  </body>
</html>