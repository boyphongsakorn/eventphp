<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
include 'config.php';

$sql = "SELECT emp_id,emp_name,emp_password,emp_rule FROM employees WHERE emp_username = '".$_POST['eou']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if($row["emp_password"] == md5($_POST['password'])){
      $_SESSION["adminid"] = $row["emp_id"];
      $_SESSION["adminusername"] = $_POST['usernameadmin'];
      $_SESSION["adminname"] = $row["emp_name"];
      $_SESSION["ruletype"] = $row["emp_rule"];
      header("Location: dashboard.php");
    }else{
      ?>
      <script>
        Swal.fire(
            'เกิดข้อผิดพลาด',
            'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
            'error'
        ).then((result) => {
            window.history.back();
        })
      </script>
      <?php
      //echo md5($_POST['password']);
    }
  }
} else {
  $sql = "SELECT euse_email,euse_id,euse_name,euse_password FROM event_user WHERE euse_email = '".$_POST['eou']."' OR euse_username = '".$_POST['eou']."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($row["euse_password"] == md5($_POST['password'])){
        $_SESSION["loginid"] = $row["euse_id"];
        $_SESSION["loginemail"] = $row["euse_email"];
        $_SESSION["loginname"] = $row["euse_name"];
        header("Location: index.php");
      }else{
        ?>
        <script>
          Swal.fire(
            'เกิดข้อผิดพลาด',
            'รหัสผ่านไม่ถูกต้อง',
            'error'
          ).then((result) => {
            window.history.back();
          })
        </script>
      <?php
        //echo md5($_POST['password']);
      }
    }
  } else {
    //echo "0 results";
    ?>
    <script>
      Swal.fire(
        'เกิดข้อผิดพลาด',
        'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
        'error'
      ).then((result) => {
        window.history.back();
      })
    </script>
    <?
  }
}

/*if(isset($_POST['class'])){
  echo 'เข้าสู่ระบบหลังบ้าน';

  $sql = "SELECT emp_name,emp_password FROM employees WHERE emp_username = '".$_POST['usernameadmin']."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($row["emp_password"] == md5($_POST['passwordadmin'])){
        $_SESSION["adminusername"] = $_POST['usernameadmin'];
        $_SESSION["adminname"] = $row["emp_name"];
        header("Location: dashboard.php");
      }else{
        echo 'รหัสผ่านไม่ตรงกัน';
        echo md5($_POST['passwordadmin']);
      }
    }
  } else {
    echo "0 results";
  }
}else{
  $sql = "SELECT euse_id,euse_name,euse_password FROM event_user WHERE euse_email = '".$_POST['email']."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($row["euse_password"] == md5($_POST['password'])){
        $_SESSION["loginid"] = $row["euse_id"];
        $_SESSION["loginemail"] = $_POST['email'];
        $_SESSION["loginname"] = $row["euse_name"];
        header("Location: index.php");
      }else{
        echo 'รหัสผ่านไม่ตรงกัน';
        echo md5($_POST['password']);
      }
    }
  } else {
    echo "0 results";
  }
}*/

$conn->close();
?>