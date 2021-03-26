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
    <style>
    /*html, 
    body {
        height: 100%;
    }*/
    </style>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?> (ระบบหลังบ้าน)</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">หน้าจัดการ</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link"  href="mainreport.php">รายงาน <span class="sr-only">(current)</span></a>
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

    <center>
    <h1>รายงาน</h1>
    <a href="view/regevent.php" role="button" class="btn btn-primary btn-lg">ลงทะเบียนเข้างาน</a>
    <a href="view/bpl.php" role="button" class="btn btn-primary btn-lg">ขายสินค้า</a>
    <a href="view/jeevent.php" role="button" class="btn btn-primary btn-lg">เข้า-ออกสัมมนา</a>
    <a href="view/topup.php" role="button" class="btn btn-primary btn-lg">เติมเงิน</a>
    </center>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script>
        //function changeclassreport(values) {
        //    if(values == "eventlist" || values == "buyproduct" || values == "joinevent" || values == "payment" || values == "regevent" || values == "topup"){
                //document.getElementById('startdate').style.display = "block";
                //document.getElementById('enddate').style.display = "block";
        //        document.getElementById('dateselect').style.display = "block";
        //    }else{
                //document.getElementById('startdate').style.display = "none";
                //document.getElementById('enddate').style.display = "none";
        //        document.getElementById('dateselect').style.display = "none";
        //    }
        //}
        /*function send() {
            if(document.getElementById('startdate').value != "" && document.getElementById('enddate').value == ""){
                document.getElementById('iframewow').src = 'https://event.teamquadb.in.th/report/' + document.getElementById('classreport').value + '.php?start=' + document.getElementById('startdate').value;
            }else if(document.getElementById('startdate').value != "" && document.getElementById('enddate').value != ""){
                document.getElementById('iframewow').src = 'https://event.teamquadb.in.th/report/' + document.getElementById('classreport').value + '.php?start=' + document.getElementById('startdate').value + '&end=' + document.getElementById('enddate').value ;
            }else{
                document.getElementById('iframewow').src = 'https://event.teamquadb.in.th/report/' + document.getElementById('classreport').value + '.php';
            }
        }*/
        //if(document.getElementById('classreport').value)
    </script>
  </body>
</html>