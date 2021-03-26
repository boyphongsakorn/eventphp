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
    <style>
    #yourdiv{
        top: 0px;
        right: 0px;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        transform: rotate(45deg);
        filter: progid:DXImageTransform.Microsoft.Matrix(M11='0.7071067811865476', M12='-0.7071067811865475', M21='0.7071067811865475', M22='0.7071067811865476', sizingMethod='auto expand');
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
  <a class="navbar-brand" href="#"><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?> (ระบบหลังบ้าน)</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">หน้าจัดการ <span class="sr-only">(current)</span></a>
      </li>
      <!--li class="nav-item active">
        <a class="nav-link" href="devscan.php">สแกนอุปกรณ์</a>
      </li-->
      <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        สแกนอุปกรณ์
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="devscan.php">เข้างาน</a>
          <a class="dropdown-item" href="devee.php">ออกจากงาน</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="topup.php">เติมเงิน</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="payforproduct.php">สแกนซื้อสินค้า</a>
      </li>
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

<div class="container">
    <center><!--div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary">สแกนเพิ่มอุปกรณ์</button>
        <button type="button" class="btn btn-secondary" onclick="document.documentElement.requestFullscreen();document.getElementById('navbar').style.display = 'none'">สแกนเข้างาน</button>
    </div></center>
    <div class="float-xl-right fixed-top d-none"><button type="button" class="btn btn-primary">ออกจากหน้า</button></div>
    <div style="position: absolute;top: 50%;left: 45%;margin-top: -50px;margin-left: -50px;width: 300px;height: 300px;"-->
      <h1>ลงทะเบียนเข้าร่วมงาน</h1>
      <div class="row">
        <div class="col-sm">
          Event : <select class="custom-select" id="eventjoin" onchange="seleve(this.value)">
            <option selected>เลือกงานสัมมนาที่คุณต้องการ</option>
            <?php
            $sql = "SELECT eve_id,eve_name FROM event_list WHERE eve_timeend > NOW() ORDER BY eve_timestart DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
            ?>
              <option value="<?php echo $row["eve_id"] ?>"><?php echo $row["eve_name"] ?></option>
            <?
              }
            }
            ?>
          </select>
        </div>
        <div class="col-sm">
          <div id="eventdetail">

          </div>
        </div>
      </div>
      <div class="row my-2">
        <div class="col-sm">
          เลือกลูกค้า : <select class="custom-select" id="userjoin" onchange="seluse(this.value)">
            <option selected>เลือกลูกค้า</option>
          </select>
        </div>
        <div class="col-sm">
          <div id="userjoindetail">

          </div>
        </div>
      </div>
      สแกนอุปกรณ์ที่จะให้ลูกค้า : <input type="text" class="form-control" id="devid" placeholder="" readonly>
      <button type="button" class="btn btn-primary" onclick="sendjoin()">ยืนยัน</button>

      <!--table class="table table-striped mt-2">
        <thead>
          <tr>
            <th scope="col">รหัส</th>
            <th scope="col">ชื่อ</th>
            <th scope="col">รหัสอุปกรณ์</th>
            <th scope="col">เวลาเข้า</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
        </tbody>
      </table-->
    <!--/div-->
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
    setInterval(
        function(){ 
            $.get("https://event.teamquadb.in.th/devjoin.php?lastdevice", function(data, status){
                document.getElementById("devid").value = data;
                /*$.get("https://event.teamquadb.in.th/devjoin.php?lastdevice", function(data, status){
                  document.getElementById("devid").value = data;
                })*/
            })
        }
    ,1000)

    function seleve(value){
      $.getJSON("https://event.teamquadb.in.th/gujejson.php?eveid="+value, function(data){
        console.log(data);
        document.getElementById('userjoin').innerHTML = "<option selected>เลือกลูกค้า</option>"
        document.getElementById('userjoindetail').innerHTML = ""
        $.each(data, function(k, v) {
          document.getElementById('userjoin').innerHTML += "<option value=\""+v.euse_id+"\">"+v.euse_name+"</option>"
        });
      })
      $.getJSON("https://event.teamquadb.in.th/geteventjson.php?eveid="+value, function(data){
        document.getElementById('eventdetail').innerHTML = ""
        if(data != '0'){
          //document.getElementById('eventdetail').innerHTML = "ชื่อสัมมนา : "+data[0].eve_name+" <br> สถานที่จัด : "+data[0].eve_address+" <br> ธีม/ชุดเข้าร่วมงาน : "+data[0].eve_theme+" <br> เวลาเริ่ม : "+data[0].eve_timestart+" <br> เวลาจบ : "+data[0].eve_timeend+" <br>"
          document.getElementById('eventdetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">ชื่อสัมมนา :</td><td>"+data[0].eve_name+"</td></tr><tr><td style=\"text-align: center;\">สถานที่จัด :</td><td>"+data[0].eve_address+"</td></tr><tr><td style=\"text-align: center;\">ธีม/ชุดเข้าร่วมงาน :</td><td>"+data[0].eve_theme+"</td></tr><tr><td style=\"text-align: center;\">เวลาเริ่ม :</td><td>"+data[0].eve_timestart+"</td></tr><tr><td style=\"text-align: center;\">เวลาจบ :</td><td>"+data[0].eve_timeend+"</td></tr></table>"
        }
      })
    }

    function seluse(value){
      $.getJSON("https://event.teamquadb.in.th/getuserjson.php?euseid="+value, function(data){
        if(data != '0'){
          //document.getElementById('userjoindetail').innerHTML = "รหัสบัตรประชาชนชื่อ : "+data[0].euse_id+" <br> ชื่อ : "+data[0].euse_name+" <br> ชื่อผู้ใช้ : "+data[0].euse_username+" <br> อีเมล : "+data[0].euse_email+" <br> ที่อยู่ : "+data[0].euse_address+" <br>"
          //document.getElementById('userjoindetail').innerHTML = "<div class=\"row\"><div class=\"col-sm\">รหัสบัตรประชาชนชื่อ :<br>ชื่อ :<br>ชื่อผู้ใช้ :<br> อีเมล :<br> ที่อยู่ :</div><div class=\"col-sm\">"+data[0].euse_id+"<br>"+data[0].euse_name+"<br>"+data[0].euse_username+"<br>"+data[0].euse_email+"<br>"+data[0].euse_address+"</div></div>"
          document.getElementById('userjoindetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">รหัสบัตรประชาชนชื่อ :</td><td>"+data[0].euse_id+"</td></tr><tr><td style=\"text-align: center;\">ชื่อ :</td><td>"+data[0].euse_name+"</td></tr><tr><td style=\"text-align: center;\">ชื่อผู้ใช้ :</td><td>"+data[0].euse_username+"</td></tr><tr><td style=\"text-align: center;\">อีเมล :</td><td>"+data[0].euse_email+"</td></tr><tr><td style=\"text-align: center;\">ที่อยู่ :</td><td>"+data[0].euse_address+"</td></tr></table>"
        }
      })
    }

    function sendjoin(){
      if(document.getElementById('eventjoin').value != "เลือกงานสัมมนาที่คุณต้องการ" && document.getElementById('userjoin').value != "เลือกลูกค้า"){
        $.post("wte.php",
        {
          eventid: document.getElementById('eventjoin').value,
          eventuser: document.getElementById('userjoin').value,
          devid: document.getElementById('devid').value
        },
        function(data, status){
          if(data == '0.1'){
            alert('อุปกรณ์นี้ได้ทำการลงทะเบียนเช็คร่วมงานแล้ว')
          }
          if(data == '0.2'){
            alert('ลูกค้าเข้าสัมมนางานนี้แล้ว')
          }
          if(data == '0.3'){
            alert('ไม่มีอุปกรณ์นี้อยู่ในระบบ')
          }
          if(data == '1'){
            alert('เช็คเข้าร่วมงานเรียบร้อยแล้ว')
          }
          alert("Data: " + data + "\nStatus: " + status);
        });
      }else{
        alert("กรุณาเลือกสัมมนาและลูกค้าก่อนกดยืนยัน")
      }
      
    }

    </script>

</body>
</html>