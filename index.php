<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?></title>
  <link rel="icon" href="/img/agency/<? echo $conn->query("SELECT age_id FROM agency")->fetch_assoc()['age_id']; ?>.<? echo $conn->query("SELECT age_imgtype FROM agency")->fetch_assoc()['age_imgtype']; ?>"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }   
    /* clears the ‘X’ from Internet Explorer */
    input[type=search]::-ms-clear { display: none; width : 0; height: 0; }
    input[type=search]::-ms-reveal { display: none; width : 0; height: 0; }
    
    /* clears the ‘X’ from Chrome */
    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-cancel-button,
    input[type="search"]::-webkit-search-results-button,
    input[type="search"]::-webkit-search-results-decoration { display: none; }

    .alligator-turtle {
        object-fit: cover;
        object-position: 50% 50%;

        height: 40%;
    }
  </style>
</head>
<body>
<?php include_once 'menu.php'; ?>

<div class="container">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://www.sinsaehwang.com/wp-content/uploads/2018/03/%E0%B8%AA%E0%B8%B1%E0%B8%A1%E0%B8%A1%E0%B8%99%E0%B8%B2-730x350.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.sinsaehwang.com/wp-content/uploads/2018/03/%E0%B8%AA%E0%B8%B1%E0%B8%A1%E0%B8%A1%E0%B8%99%E0%B8%B2-730x350.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://www.sinsaehwang.com/wp-content/uploads/2018/03/%E0%B8%AA%E0%B8%B1%E0%B8%A1%E0%B8%A1%E0%B8%99%E0%B8%B2-730x350.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <h1 class="mt-1"><i class="fab fa-elementor"></i> สัมมนาที่จะถึง</h1>
  <div class="row row-cols-1 row-cols-md-3">
    <?php
    //$sql = "SELECT * FROM event_list";
    $sql = "SELECT * FROM event_list WHERE eve_timestart > NOW()";
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      ?>
        <div class="col mb-4">
          <div class="card h-100">
            <? if($row["eve_hasimg"] == '1') {?>
                <img src="https://event.teamquadb.in.th/img/event/<?php echo $row["eve_id"] ?>.<?php echo $row["eve_imgtype"] ?>" class="card-img-top alligator-turtle w-100">
            <!--img src="https://img.gs/fhcphvsghs/2560x1080,crop=auto/https://event.teamquadb.in.th/img/event/<?php echo $row["eve_id"] ?>.<?php echo $row["eve_imgtype"] ?>" class="card-img-top"-->
            <? } ?>
            <div class="card-body">
            <h5 class="card-title"><?php echo $row["eve_name"] ?> 
            <?php 
            if (isset($_SESSION["loginemail"])) {
              $sql = "SELECT reg_payin FROM register WHERE euse_id = '".$_SESSION["loginid"]."' AND eve_id = '".$row["eve_id"]."'";
              $wow = $conn->query($sql);
              if ($wow->num_rows > 0) {
                if ($wow->fetch_assoc()["reg_payin"] == 0){
                ?>
                  <i class="fas fa-exclamation-circle"></i>
                <?
                } else {
                ?>
                  <i class="fas fa-check-circle"></i>
                <?php
                }
              }
            }
            ?></h5>
              <p class="card-text">
              <i class="fas fa-map-marker-alt"></i> <?php echo $row["eve_address"] ?>
              <i class="fas fa-vest"></i> <?php echo $row["eve_theme"] ?>
              <i class="fas fa-users"></i> <?php echo $row["eve_limit"] ?>
              <i class="fas fa-money-bill-alt"></i> <?php echo $row["eve_price"] ?><br>
              <i class="fas fa-clock"></i> <?php echo date('d/m/Y', strtotime("+543 years",strtotime($row["eve_timestart"]))) ?>
              </p>
              <? if ($conn->query("SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$row["eve_id"]."'")->fetch_assoc()["COUNT(eve_id)"] == $row["eve_limit"] AND $wow->num_rows == 0) {?><button type="button" class="btn btn-danger"><i class="fas fa-times-circle"></i> เต็มจำนวนแล้ว</button>
              <?} else { ?><a <?php if (isset($_SESSION["loginemail"])) { if ($wow->num_rows > 0) { ?> class="btn btn-primary invisible d-none" <?php }else{ ?> class="btn btn-primary visible" href="viewevent.php?eventid=<?php echo $row["eve_id"] ?>" onclick="//joinevent('<?php echo $row["eve_id"] ?>','<?php echo $row["eve_name"] ?> ','<?php echo $row["eve_price"] ?>')" <?php }}else{ ?> class="btn btn-primary visible" href="viewevent.php?eventid=<?php echo $row["eve_id"] ?>" <?php } ?>>เข้าร่วมสัมมนา</a> <!-- data-toggle="modal" data-target="#logModal" -->
              <? } ?>
              <? if ($wow->num_rows > 0) { ?><a class="btn btn-light" href="viewevent.php?eventid=<?php echo $row["eve_id"] ?>" role="button">รายละเอียด</a> <? } ?>
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      echo "ยังไม่มีงานสัมมนาในขณะนี้";
    }
    ?>
  </div>
</div>

<?php include_once 'larmod.php'; ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })

  function joinevent(idevent,eventname,price) {
    Swal.fire({
      title: 'คุณต้องการที่จะเข้างานสัมมนานี้ใช่หรือไม่?',
      html: 'ชื่อสัมนนา : '+ eventname +' <br> ธีมงาน : <br> ค่าสมัครเข้างาน : '+ price +' <br> ผู้เข้าร่วมงานตอนนี้ : 0 คน',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'ใช่',
      cancelButtonText: 'ไม่',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.location.replace("regevent.php?eventid="+idevent+"&price="+price)
      }
    })
  }
</script>
</body>
</html>