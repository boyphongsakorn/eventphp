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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" />

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

      <li class="nav-item">

        <a class="nav-link" href="devscan.php">สแกนอุปกรณ์</a>

      </li>

      <li class="nav-item active">

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
    <center><h1>เติมเงิน</h1></center>
    <div class="row">
        <div class="col-sm">
            สแกนอุปกรณ์ที่จะให้ลูกค้า : <input type="text" class="form-control" id="devid" placeholder="" onchange="seleve(this.value)" readonly >
            จำนวนเงินที่ต้องการจะเติม : <input type="number" min="1" class="form-control" id="tpprice" placeholder="เช่น เติม 10 บาท ใส่แค่ 10">
        </div>
        <!--div class="col-sm">
            <div id="userjoindetail">
            </div>
        </div-->
    </div>
    <div id="userjoindetail">
    </div>
    <button type="button" class="btn btn-primary" onclick="sendjoin()">ยืนยัน</button>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }



    setInterval(
        function(){ 
            $.get("https://event.teamquadb.in.th/devjoin.php?lastdevice", function(data, status){
                document.getElementById("devid").value = data;
                /*$.get("https://event.teamquadb.in.th/devjoin.php?lastdevice", function(data, status){
                  document.getElementById("devid").value = data;
                })*/
                seleve(data)
            })
        }
    ,1000)



    function seleve(value){
      $.getJSON("https://event.teamquadb.in.th/guiejson.php?devid="+value, function(data){
        //console.log(data);
        //document.getElementById('userjoin').innerHTML = "<option selected>เลือกลูกค้า</option>"
        //document.getElementById('userjoindetail').innerHTML = ""
        //$.each(data, function(k, v) {
        //  document.getElementById('userjoin').innerHTML += "<option value=\""+v.euse_id+"\">"+v.euse_name+"</option>"
        //});
        seluse(data[0].euse_id)
      })
      //$.getJSON("https://event.teamquadb.in.th/geteventjson.php?eveid="+value, function(data){
      //  document.getElementById('eventdetail').innerHTML = ""
      //  if(data != '0'){
          //document.getElementById('eventdetail').innerHTML = "ชื่อสัมมนา : "+data[0].eve_name+" <br> สถานที่จัด : "+data[0].eve_address+" <br> ธีม/ชุดเข้าร่วมงาน : "+data[0].eve_theme+" <br> เวลาเริ่ม : "+data[0].eve_timestart+" <br> เวลาจบ : "+data[0].eve_timeend+" <br>"
      //    document.getElementById('eventdetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">ชื่อสัมมนา :</td><td>"+data[0].eve_name+"</td></tr><tr><td style=\"text-align: center;\">สถานที่จัด :</td><td>"+data[0].eve_address+"</td></tr><tr><td style=\"text-align: center;\">ธีม/ชุดเข้าร่วมงาน :</td><td>"+data[0].eve_theme+"</td></tr><tr><td style=\"text-align: center;\">เวลาเริ่ม :</td><td>"+data[0].eve_timestart+"</td></tr><tr><td style=\"text-align: center;\">เวลาจบ :</td><td>"+data[0].eve_timeend+"</td></tr></table>"
      //  }
      //})
    }
    function seluse(value){
      $.getJSON("https://event.teamquadb.in.th/getuserjson.php?euseid="+value, function(dataone){
        if(dataone != '0'){
          //document.getElementById('userjoindetail').innerHTML = "รหัสบัตรประชาชนชื่อ : "+data[0].euse_id+" <br> ชื่อ : "+data[0].euse_name+" <br> ชื่อผู้ใช้ : "+data[0].euse_username+" <br> อีเมล : "+data[0].euse_email+" <br> ที่อยู่ : "+data[0].euse_address+" <br>"
          //document.getElementById('userjoindetail').innerHTML = "<div class=\"row\"><div class=\"col-sm\">รหัสบัตรประชาชนชื่อ :<br>ชื่อ :<br>ชื่อผู้ใช้ :<br> อีเมล :<br> ที่อยู่ :</div><div class=\"col-sm\">"+data[0].euse_id+"<br>"+data[0].euse_name+"<br>"+data[0].euse_username+"<br>"+data[0].euse_email+"<br>"+data[0].euse_address+"</div></div>"
          //document.getElementById('userjoindetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">รหัสบัตรประชาชนชื่อ :</td><td>"+data[0].euse_id+"</td></tr><tr><td style=\"text-align: center;\">ชื่อ :</td><td>"+data[0].euse_name+"</td></tr><tr><td style=\"text-align: center;\">ชื่อผู้ใช้ :</td><td>"+data[0].euse_username+"</td></tr><tr><td style=\"text-align: center;\">อีเมล :</td><td>"+data[0].euse_email+"</td></tr><tr><td style=\"text-align: center;\">ที่อยู่ :</td><td>"+data[0].euse_address+"</td></tr>"
          $.getJSON("https://event.teamquadb.in.th/gcmje.php?devid="+document.getElementById("devid").value, function(data){
            document.getElementById('userjoindetail').innerHTML = "<font size=\"6\"><table style=\"width:100%\"><tr><td style=\"text-align: center;\">รหัสบัตรประชาชนชื่อ :</td><td>"+dataone[0].euse_id+"</td></tr><tr><td style=\"text-align: center;\">ชื่อ :</td><td>"+dataone[0].euse_name+"</td></tr><tr><td style=\"text-align: center;\">ชื่อผู้ใช้ :</td><td>"+dataone[0].euse_username+"</td></tr><tr><td style=\"text-align: center;\">อีเมล :</td><td>"+dataone[0].euse_email+"</td></tr><tr><td style=\"text-align: center;\">ที่อยู่ :</td><td>"+dataone[0].euse_address+"</td></tr><tr><td style=\"text-align: center;\">จำนวนเงินคงเหลือ :</td><td>"+data[0].joe_money+" บาท</td></tr><tr><td style=\"text-align: center;\">สัมมนา :</td><td>"+data[0].eve_name+"</td></tr></table></font>"
            //document.getElementById('userjoindetail').innerHTML += "<tr><td style=\"text-align: center;\">จำนวนเงินคงเหลือ :</td><td>"+data[0].joe_money+"</td></tr></table>"
          })
        }
      })
    }



    function sendjoin(){
      if(document.getElementById('devid').value != "" && document.getElementById('tpprice').value != "" && document.getElementById('tpprice').value != "0"){
        $.post("tpm.php",
        {
          devid: document.getElementById('devid').value,
          price: document.getElementById('tpprice').value,
          empid: <? echo $_SESSION["adminid"] ?>
          //eventuser: document.getElementById('userjoin').value,
          //devid: document.getElementById('devid').value
        },

        function(data, status){
          if(data == '0.1'){
            alert('อุปกรณ์นี้ได้ทำการลงทะเบียนเช็คร่วมงานแล้ว')
          }else if (data == '0.1'){
            alert('ไม่สามารถบันทึกข้อมูลการเติมได้')
          }else{
            toastr["success"]("เติมเงินจำนวน " + document.getElementById('tpprice').value + " บาท เข้าสู่ระบบเรียบร้อยแล้ว", "เรียบร้อย")
          }
          //if(data == '0.2'){
          //  alert('ลูกค้าเข้าสัมมนางานนี้แล้ว')
          //}
          //if(data == '0.3'){
          //  alert('ไม่มีอุปกรณ์นี้อยู่ในระบบ')
          //}
          //alert("Data: " + data + "\nStatus: " + status);
          console.log(data);
        });
      }else{
        toastr["error"]("กรุณาสแกนแท๊ก RFID หรือ ป้อนจำนวนเงินที่ต้องการจะเติม", "ผิดพลาด")
        //alert("กรุณาสแกนแท๊ก RFID หรือ ป้อนจำนวนเงินที่ต้องการจะเติม")
      }
    }



    </script>



</body>

</html>