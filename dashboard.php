<?php
session_start();
include 'config.php';
if(!isset($_SESSION["adminname"]))
{
    header("location: https://event.teamquadb.in.th" );
    exit(0);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Hello, world!</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?> (ระบบหลังบ้าน)</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">หน้าจัดการ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#employees">บัญชีพนักงาน</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <? if($_SESSION["ruletype"] == '1') { echo "disabled"; } ?>" data-toggle="modal" data-target="#userlist">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#product">สินค้า</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#devview">อุปกรณ์</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="devscan.php">สแกนอุปกรณ์เข้างาน</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#ageview">ตั้งค่าระบบ</a>
      </li>
      <!--li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          อื่นๆ
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" data-toggle="modal" data-target="#product">สินค้า</a>
          <a class="dropdown-item" href="devscan.php">สแกนอุปกรณ์</a>
          <a class="dropdown-item" data-toggle="modal" data-target="#devview">อุปกรณ์</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li-->
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["adminname"] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                <!--div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a-->
            </div>
        </li>
    </ul>
  </div>
</nav>

    <div class="container pt-2">
        <center><h4>งานสัมมนาทั้งหมด <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addevent">เพิ่มสัมมนา</button> </h4></center>
        <?php
        $sql = "SELECT * FROM event_list ORDER BY eve_timestart DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row["eve_name"] ?></h5>
                <p class="card-text">
                <i class="fas fa-map-marker-alt"></i> <?php echo $row["eve_address"] ?> <br>
                <i class="fas fa-vest"></i> <?php echo $row["eve_theme"] ?> <br>
                <i class="fas fa-users"></i> <?php echo $row["eve_limit"] ?> คน <br>
                <i class="fas fa-money-bill-alt"></i> <?php echo $row["eve_price"] ?> บาท <br>
                <i class="fas fa-clock"></i> <?php echo date_format(date_create($row["eve_timestart"]),"d/m/Y H:i:s") ?> ถึง <?php echo date_format(date_create($row["eve_timeend"]),"d/m/Y H:i:s") ?> <br>
                <i class="fas fa-sign-in-alt"></i> <?php
                $scount = "SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$row["eve_id"]."'";
                $sresult = $conn->query($scount)->fetch_assoc();
                echo $sresult["COUNT(eve_id)"];
                ?> คน <br>
                </p>
                <? if($row["eve_price"] > 0) {?>
                  <button <? if($_SESSION["ruletype"] == '1' && $_SESSION["adminid"] != $row["emp_create"]) { echo "style=\"display:none;\""; } ?> type="button" class="btn btn-info" onclick="$('#paylist').modal('show');document.getElementById('paylistframe').src = 'paylist.php?eventid=<?php echo $row["eve_id"] ?>'">ข้อมูลชำระ</button>
                <? } ?>
                <button type="button" class="btn btn-success" onclick="$('#peoplelist').modal('show');document.getElementById('peoplelistframe').src = 'peoplelist.php?eventid=<?php echo $row["eve_id"] ?>&<? if($row["eve_price"] == '0'){echo 'notpay';} ?>'">ผู้เข้าร่วมงาน</button>
                <a <? if($_SESSION["ruletype"] == '1' && $_SESSION["adminid"] != $row["emp_create"]) { echo "style=\"display:none;\""; } ?> data-toggle="modal" data-target="#editevent" class="btn btn-primary" onclick="editevent('<?php echo $row["eve_id"] ?>','<?php echo $row["eve_name"] ?>','<?php echo $row["eve_address"] ?>','<?php echo $row["eve_theme"] ?>','<?php echo $row["eve_limit"] ?>','<?php echo $row["eve_price"] ?>','<?php echo date("Y-m-d\TH:i:s", strtotime($row["eve_timestart"])) ?>','<?php echo date("Y-m-d\TH:i:s", strtotime($row["eve_timeend"])) ?>')">แก้ไข</a>
                <a <? if($_SESSION["ruletype"] == '1' && $_SESSION["adminid"] != $row["emp_create"]) { echo "style=\"display:none;\""; } ?> onclick="deleteevent('<?php echo $row["eve_id"] ?>')" class="btn btn-primary">ลบ</a>
              </div>
            </div>
            <?php
          }
        } else {
          echo "0 results";
        }
        ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addevent" tabindex="-1" aria-labelledby="addeventLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addeventLabel">เพิ่มสัมมนา</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="addevent.php" method="post" enctype="multipart/form-data">
            ชื่องานสัมมนา
            <input class="form-control" type="text" name="eventname" required>
            สถานที่
            <input class="form-control" type="text" name="eventaddress" required>
            ธีม
            <input class="form-control" type="text" name="eventtheme" required>
            จำนวนรับสมัคร
            <input class="form-control" type="number" min="1" max="9999999" name="eventmax" required>
            ราคาเข้างาน
            <input class="form-control" type="number" min="0" max="9999999" name="eventprice" required>
            วันเริ่มสัมมนา
            <input class="form-control" type="datetime-local" id="eventstarttime" name="eventstarttime" onclick="this.min = new Date().getFullYear() + '-' + String(new Date().getMonth() + 1).padStart(2, '0') + '-' + String(new Date().getDate()).padStart(2, '0') + 'T00:00'" required>
            วันสิ้นสุดสัมมนา
            <input class="form-control" type="datetime-local" name="eventendtime" onclick="this.min = document.getElementById('eventstarttime').value" required>
            รูปภาพปกสัมมนา
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="eventimage" name="eventimage" accept="image/x-png,image/gif,image/jpeg">
                <label class="custom-file-label" for="eventimage">Choose file</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editevent" tabindex="-1" aria-labelledby="editeventLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editeventLabel">cd</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form action="editevent.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="eventid" id="editeventid">
            ชื่องานสัมมนา
            <input class="form-control" type="text" name="eventname" id="editeventname" required>
            สถานที่
            <input class="form-control" type="text" name="eventaddress" id="editeventaddress" required>
            ธีม
            <input class="form-control" type="text" name="eventtheme" id="editeventtheme" required>
            จำนวนรับสมัคร
            <input class="form-control" type="number" max="9999999" name="eventmax" id="editeventmax" required>
            ราคาเข้างาน
            <input class="form-control" type="number" min="0" max="9999999" name="eventprice" id="editeventprice" required>
            วันเริ่มสัมมนา
            <input class="form-control" type="datetime-local" name="eventstarttime" id="editeventstarttime" onclick="this.min = new Date().getFullYear() + '-' + String(new Date().getMonth() + 1).padStart(2, '0') + '-' + String(new Date().getDate()).padStart(2, '0') + 'T00:00'" required>
            วันสิ้นสุดสัมมนา
            <input class="form-control" type="datetime-local" name="eventendtime" id="editeventendtime" onclick="this.min = document.getElementById('editeventstarttime').value" required>
            รูปภาพปกสัมมนา
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="editeventimage" name="editeventimage" accept="image/x-png,image/gif,image/jpeg">
                <label class="custom-file-label" for="editeventimage">Choose file</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="product" tabindex="-1" aria-labelledby="editeventLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editeventLabel">สินค้า <button type="button" class="btn btn-info" onclick="document.getElementById('productframe').src = 'addproduct.php'">เพิ่มสินค้า</button></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="fillproduct.php" width="100%" height="500" id="productframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="devview" tabindex="-1" aria-labelledby="devviewLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="devviewLabel">อุปกรณ์</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="devid.php" width="100%" height="500"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="employees" tabindex="-1" aria-labelledby="employeesLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="employeesLabel">บัญชีพนักงาน <button type="button" class="btn btn-info" onclick="document.getElementById('employeesframe').src = 'addemp.php'">เพิ่มบัญชีพนักงาน</button></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="useremp.php" width="100%" height="500" id="employeesframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userlist" tabindex="-1" aria-labelledby="userlistLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="userlistLabel">บัญชีผู้ใช้</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="userlist.php" width="100%" height="500" id="userlistframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="peoplelist" tabindex="-1" aria-labelledby="peoplelistLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="peoplelistLabel">ผู้เข้าร่วมงาน </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="peoplelist.php?eventid=" width="100%" height="500" id="peoplelistframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paylist" tabindex="-1" aria-labelledby="paylistLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="paylistLabel">ข้อมูลชำระ </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="paylist.php?eventid=" width="100%" height="500" id="paylistframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ageview" tabindex="-1" aria-labelledby="ageviewLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ageviewLabel">ข้อมูลระบบ <!--button type="button" class="btn btn-info" onclick="document.getElementById('ageviewframe').src = 'agency/addage.php'">เพิ่มหน่วยงาน</button--></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <iframe src="agency/agelist.php" width="100%" height="500" id="ageviewframe"></iframe>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        })

      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })

      function editevent(eventid,eventname,eventaddress,eventtheme,eventmax,eventprice,eventstarttime,eventendtime) {
        document.getElementById('editeventLabel').value = 'แก้สัมมนา' + eventname;
        document.getElementById('editeventid').value = eventid;
        document.getElementById('editeventname').value = eventname;
        document.getElementById('editeventaddress').value = eventaddress;
        document.getElementById('editeventtheme').value = eventtheme;
        document.getElementById('editeventmax').value = eventmax;
        document.getElementById('editeventstarttime').value = eventstarttime;
        document.getElementById('editeventendtime').value = eventendtime;
        document.getElementById('editeventprice').value = eventprice;
      }

      function deleteevent(idevent) {
        Swal.fire({
            title: 'ต้องการที่จะลบงานสัมมนานี้ใช่หรือไม่?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ไม่',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.replace("delconf.php?eventid="+idevent)
            }
        })
      }
    </script>
  </body>
</html>