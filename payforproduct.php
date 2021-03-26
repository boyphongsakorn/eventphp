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

      <li class="nav-item">

        <a class="nav-link" href="topup.php">เติมเงิน</a>

      </li>

      <li class="nav-item active">

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

    <center><h1>จ่ายเงินซื้อสินค้า</h1></center>

    <div class="row">

        <div class="col-sm">

            สแกนอุปกรณ์ที่จะให้ลูกค้า : <input type="text" class="form-control" id="devid" placeholder="" readonly>

        </div>

        <div class="col-sm">

            <div id="userjoindetail">

            </div>

        </div>

    </div>

    <div class="row">

      <div class="col-sm">

        เลือกสินค้าที่ต้องการซื้อ

        <!--select class="custom-select" multiple id="selectID" size="7">

        <?php

        $sql = "SELECT * FROM product WHERE pro_count <> 0";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

        ?>

            <option value="<?php echo $row['pro_id']; ?>"><?php echo $row['pro_name']; ?> <?php echo $row['pro_price']; ?> บาท (จำนวนคงเหลือ <?php echo $row['pro_count'] ?> <?php echo $row['pro_unit'] ?>)</option>

        <?php

          }

        } else {

        ?>

          <option selected>ไม่มีสินค้าในระบบ หรือ สินค้าหมด</option>

        <?

        }

        ?>

        </select-->

        <select class="custom-select" id="select">

        <?php

        $sql = "SELECT * FROM product WHERE pro_count <> 0";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {

        ?>

            <option value="<?php echo $row['pro_id']; ?>"><?php echo $row['pro_name']; ?> <?php echo $row['pro_price']; ?> บาท (จำนวนคงเหลือ <?php echo $row['pro_count'] ?> <?php echo $row['pro_unit'] ?>)</option>

        <?php

          }

        } else {

        ?>

          <option selected>ไม่มีสินค้าในระบบ หรือ สินค้าหมด</option>

        <?

        }

        ?>

        </select>

        จำนวนที่ต้องการจะซื้อ

        <input type="number" class="form-control" id="selectcount" min="1">

        <button type="button" class="btn btn-primary" onclick="addtocart()">เพิ่มสินค้าเข้ารายการซื้อ</button>

      </div>

      <div class="col-sm">

        สินค้าที่เลือก

        <select class="custom-select" multiple id="payID" size="7">

        </select>

        <h2>ราคาทั้งหมด : <span id="paysum" class="count"></span></h2>

      </div>

    </div>

    <button type="button" class="btn btn-primary" onclick="sendpay()">ยืนยันการซื้อ</button> <a class="btn btn-secondary" href="topup.php" role="button">เติมเงิน</a>

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



    var product = []

    var price = 0



    function addtocart(){

        var i;

        for (i = 0; i < parseInt(document.getElementById("selectcount").value); i++) {

            var x = document.getElementById("payID");

            var option = document.createElement("option");

            option.text = document.getElementById("select")[document.getElementById("select").selectedIndex].text;

            option.value = document.getElementById("select").value;

            getprice(document.getElementById("select").value,'min')

            product.push(document.getElementById("select").value)

            x.add(option);

        }

    }



    //document.getElementById('selectID').ondblclick = function(){

      //alert(this.selectedIndex);

    //  var x = document.getElementById("payID");

    //  var option = document.createElement("option");

    //  option.text = this.options[this.selectedIndex].text;

    //  option.value = this.options[this.selectedIndex].value;

      //option.text = "Kiwi";

      //option.value = "5";

      //price = price + getprice(this.options[this.selectedIndex].value)

      //price = price + this.options[this.selectedIndex].price

    //  getprice(this.options[this.selectedIndex].value,'min')

    //  product.push(this.options[this.selectedIndex].value)

    //  x.add(option);

      //or alert(this.options[this.selectedIndex].value);

      //alert(this.options[this.selectedIndex].text);

    //};



    document.getElementById('payID').ondblclick = function(){

      //var x = document.getElementById("payID");

      //price = price - parseInt(getprice(this.options[this.selectedIndex].value))

      getprice(this.options[this.selectedIndex].value,'div')

      product.splice(product.indexOf(this.options[this.selectedIndex].value), 1);

      this.remove(this.selectedIndex);

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

        seluse(data[0].euse_id)

      })

    }



    function seluse(value){

      $.getJSON("https://event.teamquadb.in.th/getuserjson.php?euseid="+value, function(dataone){

        if(dataone != '0'){

          $.getJSON("https://event.teamquadb.in.th/gcmje.php?devid="+document.getElementById("devid").value, function(data){

            document.getElementById('userjoindetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">รหัสบัตรประชาชนชื่อ :</td><td>"+dataone[0].euse_id+"</td></tr><tr><td style=\"text-align: center;\">ชื่อ :</td><td>"+dataone[0].euse_name+"</td></tr><tr><td style=\"text-align: center;\">ชื่อผู้ใช้ :</td><td>"+dataone[0].euse_username+"</td></tr><!--tr><td style=\"text-align: center;\">อีเมล :</td><td>"+dataone[0].euse_email+"</td></tr><tr><td style=\"text-align: center;\">ที่อยู่ :</td><td>"+dataone[0].euse_address+"</td></tr--><tr><td style=\"text-align: center;\">จำนวนเงินคงเหลือตอนนี้ :</td><td>"+data[0].joe_money+" บาท</td></tr><!--tr><td style=\"text-align: center;\">สัมมนา :</td><td>"+data[0].eve_name+"</td></tr--></table>"

          })

        }

      })

    }



    function getprice(value,who){

      $.getJSON("https://event.teamquadb.in.th/gpfpjson.php?proid="+value, function(data){

        if(who == 'min'){

          price = price + parseInt(data[0].pro_price)

          document.getElementById("paysum").innerText = price + " บาท"

        }else{

          price = price - parseInt(data[0].pro_price)

          document.getElementById("paysum").innerText = price + " บาท"

        }

        //return data[0].pro_price

      })

    }



    //function seleve(value){

    //  $.getJSON("https://event.teamquadb.in.th/guiejson.php?devid="+value, function(data){

        //console.log(data);

        //document.getElementById('userjoin').innerHTML = "<option selected>เลือกลูกค้า</option>"

        //document.getElementById('userjoindetail').innerHTML = ""

        //$.each(data, function(k, v) {

        //  document.getElementById('userjoin').innerHTML += "<option value=\""+v.euse_id+"\">"+v.euse_name+"</option>"

        //});

    //    seluse(data[0].euse_id)

    //  })

      //$.getJSON("https://event.teamquadb.in.th/geteventjson.php?eveid="+value, function(data){

      //  document.getElementById('eventdetail').innerHTML = ""

      //  if(data != '0'){

          //document.getElementById('eventdetail').innerHTML = "ชื่อสัมมนา : "+data[0].eve_name+" <br> สถานที่จัด : "+data[0].eve_address+" <br> ธีม/ชุดเข้าร่วมงาน : "+data[0].eve_theme+" <br> เวลาเริ่ม : "+data[0].eve_timestart+" <br> เวลาจบ : "+data[0].eve_timeend+" <br>"

      //    document.getElementById('eventdetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">ชื่อสัมมนา :</td><td>"+data[0].eve_name+"</td></tr><tr><td style=\"text-align: center;\">สถานที่จัด :</td><td>"+data[0].eve_address+"</td></tr><tr><td style=\"text-align: center;\">ธีม/ชุดเข้าร่วมงาน :</td><td>"+data[0].eve_theme+"</td></tr><tr><td style=\"text-align: center;\">เวลาเริ่ม :</td><td>"+data[0].eve_timestart+"</td></tr><tr><td style=\"text-align: center;\">เวลาจบ :</td><td>"+data[0].eve_timeend+"</td></tr></table>"

      //  }

      //})

    //}



    //function seluse(value){

    //  $.getJSON("https://event.teamquadb.in.th/getuserjson.php?euseid="+value, function(data){

    //    if(data != '0'){

          //document.getElementById('userjoindetail').innerHTML = "รหัสบัตรประชาชนชื่อ : "+data[0].euse_id+" <br> ชื่อ : "+data[0].euse_name+" <br> ชื่อผู้ใช้ : "+data[0].euse_username+" <br> อีเมล : "+data[0].euse_email+" <br> ที่อยู่ : "+data[0].euse_address+" <br>"

          //document.getElementById('userjoindetail').innerHTML = "<div class=\"row\"><div class=\"col-sm\">รหัสบัตรประชาชนชื่อ :<br>ชื่อ :<br>ชื่อผู้ใช้ :<br> อีเมล :<br> ที่อยู่ :</div><div class=\"col-sm\">"+data[0].euse_id+"<br>"+data[0].euse_name+"<br>"+data[0].euse_username+"<br>"+data[0].euse_email+"<br>"+data[0].euse_address+"</div></div>"

    //      document.getElementById('userjoindetail').innerHTML = "<table style=\"width:100%\"><tr><td style=\"text-align: center;\">รหัสบัตรประชาชนชื่อ :</td><td>"+data[0].euse_id+"</td></tr><tr><td style=\"text-align: center;\">ชื่อ :</td><td>"+data[0].euse_name+"</td></tr><tr><td style=\"text-align: center;\">ชื่อผู้ใช้ :</td><td>"+data[0].euse_username+"</td></tr><tr><td style=\"text-align: center;\">อีเมล :</td><td>"+data[0].euse_email+"</td></tr><tr><td style=\"text-align: center;\">ที่อยู่ :</td><td>"+data[0].euse_address+"</td></tr></table>"

    //    }

    //  })

    //}



    function sendpay(){

      if(document.getElementById("payID").length != 0){

        $.post("cpp.php",

        {

          devid: document.getElementById('devid').value,

          sumprice: price,

          allpro: JSON.stringify(product)

          //eventuser: document.getElementById('userjoin').value,

          //devid: document.getElementById('devid').value

        },

        function(data, status){

          if(data == '0.1'){

            toastr["error"]("มีปัญหาในการซื้อสินค้า", "ผิดพลาด")

          }else if(data == '0.2'){

            toastr["error"]("ขออภัยเงินของลูกค้าไม่พอกรุณาเติมเงิน", "ผิดพลาด")

          }else if(data == '0.3'){

            toastr["error"]("ไม่สามารถเพิ่มรายการสินค้าที่ซื้อได้", "ผิดพลาด")

          }else if(data == '0.4'){

            toastr["error"]("หักเงินไม่สำเร็จ", "ผิดพลาด")

          }else if(data.split(",")[0] == '0.5'){

            toastr["error"]("สินค้า "+ data.split(",")[1] +" ไม่พอต่อความต้องการของลูกค้า", "ผิดพลาด")

          }else{

            toastr["success"]("ซื้อสินค้าและหักตังในระบบเรียบร้อยแล้ว", "เรียบร้อย")

          }

          //if(data == '0.2'){

          //  alert('ลูกค้าเข้าสัมมนางานนี้แล้ว')

          //}

          //if(data == '0.3'){

          //  alert('ไม่มีอุปกรณ์นี้อยู่ในระบบ')

          //}

          console.log(data)

          //alert("Data: " + data + "\nStatus: " + status);

        });

      }else{

        toastr["error"]("กรุณาสแกนแท๊ก RFID หรือ เลือกสินค้าที่ต้องการจะซื้อ", "ผิดพลาด")

        //alert("กรุณาสแกนแท๊ก RFID หรือ ป้อนจำนวนเงินที่ต้องการจะเติม")

      }

    }

    </script>

</body>

</html>