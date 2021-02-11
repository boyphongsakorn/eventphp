<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/img/agency/<? echo $conn->query("SELECT age_id FROM agency")->fetch_assoc()['age_id']; ?>.<? echo $conn->query("SELECT age_imgtype FROM agency")->fetch_assoc()['age_imgtype']; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    <? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?>
  </a>
  <!--a class="navbar-brand" href="#"><? //echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?></a-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <!--li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li-->
    </ul>
    <ul class="navbar-nav">
        <?php if (isset($_SESSION["loginemail"])) {?>
        <li class="nav-item">
          <!--a class="nav-link" href="#">เติมเงิน</a-->
        </li>
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["loginname"]?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="editprofile.php">แก้ไขโปรไฟล์</a>
              <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
            </div>
        </li>
        <?php
        }else if(isset($_SESSION["adminid"])){ ?>
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ตอนนี้อยู่ในสถานะแอดมิน
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="dashboard.php">เข้าหลังบ้าน</a>
              <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
            </div>
        </li>
        <?php
        }else{ ?>
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              สมาชิก
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#logModal">เข้าสู่ระบบ</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#regModal">สมัครสมาชิก</a>
                <!--div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a-->
            </div>
        </li>
        <?php } ?>
    </ul>
  </div>
</nav>