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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }

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
        }
    </style>
</head>
<body>
<?php include_once 'menu.php'; ?>

    <?php
    $sql = "SELECT * FROM event_list WHERE eve_id = '".$_GET['eventid']."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
        
    if ($result->num_rows > 0) {
    ?>
    <div class="container-fluid py-5" style="background-image: url(https://www.sinsaehwang.com/wp-content/uploads/2018/03/%E0%B8%AA%E0%B8%B1%E0%B8%A1%E0%B8%A1%E0%B8%99%E0%B8%B2-730x350.jpg);background-size: cover;background-position: center;">
        <div class="container p-0">
            <img src="https://event.teamquadb.in.th/img/event/<?php echo $data["eve_id"] ?>.<?php echo $data["eve_imgtype"] ?>" class="alligator-turtle w-100 h-25">
            <!--img src="https://img.gs/fhcphvsghs/3840x1080,crop=auto/https://event.teamquadb.in.th/img/event/<?php echo $data["eve_id"] ?>.<?php echo $data["eve_imgtype"] ?>" width="100%"-->
        </div>
        <div class="container py-5" style="background: #ffffff">
            <div class="row">
                <div class="col-sm-4">
                    <p style="font-size: 12px"><?php echo date_format(date_create($data["eve_timestart"]),"d/m/Y H:i:s") ?> ถึง <?php echo date_format(date_create($data["eve_timeend"]),"d/m/Y H:i:s") ?><p>
                    <h1 style="margin-top: 10px;">กิจกรรม : <?php echo $data["eve_name"] ?></h1>
                </div>
                <div class="col-sm-8">
                    <table style="width: 100%">
                        <tr>
                            <th style="width: 50%"><i class="fas fa-map-marked-alt"></i> สถานที่จัดงาน :</th>
                            <td style="width: 50%"><?php echo $data["eve_address"]; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%"><i class="fas fa-user-tie"></i> ธีมของงาน :</th>
                            <td style="width: 50%"><?php echo $data["eve_theme"]; ?></td>
                        </tr>
                        <tr>
                            <th style="width: 50%"><i class="fas fa-users"></i> จำนวนที่สามารถรับได้สูงสุด :</th>
                            <td style="width: 50%"><?php echo $data["eve_limit"]; ?> คน</td>
                        </tr>
                        <tr>
                            <th style="width: 50%"><i class="fas fa-money-bill-alt"></i> ค่าสมัครเข้างาน :</th>
                            <td style="width: 50%"><?php echo $data["eve_price"]; ?> บาท</td>
                        </tr>
                        <tr>
                            <th style="width: 50%"><i class="fas fa-sign-in-alt"></i> ผู้เข้าร่วมงานตอนนี้ :</th>
                            <td style="width: 50%"><?php echo $conn->query("SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$data["eve_id"]."'")->fetch_assoc()["COUNT(eve_id)"];?> คน</td>
                        </tr>
                    </table>
                    <!--div class="row">
                        <div class="col-sm-6">
                            <i class="fas fa-map-marked-alt"></i> สถานที่จัดงาน :<br>
                            <i class="fas fa-user-tie"></i> ธีมของงาน :<br>
                            <i class="fas fa-users"></i> จำนวนที่สามารถรับได้สูงสุด :<br>
                            <i class="fas fa-money-bill-alt"></i> ค่าสมัครเข้างาน :<br>
                            <i class="fas fa-sign-in-alt"></i> ผู้เข้าร่วมงานตอนนี้ :<br>
                        </div>
                        <div class="col-sm-6">
                            <?php echo $data["eve_address"]; ?><br>
                            <?php echo $data["eve_theme"]; ?><br>
                            <?php echo $data["eve_limit"]; ?> คน<br>
                            <?php echo $data["eve_price"]; ?> บาท<br>
                            <?php echo $conn->query("SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$data["eve_id"]."'")->fetch_assoc()["COUNT(eve_id)"];?> คน
                        </div>
                    </div-->
                    <!--i class="fas fa-map-marked-alt"></i> สถานที่จัดงาน : <?php echo $data["eve_address"]; ?><br>
                    <i class="fas fa-user-tie"></i> ธีมของงาน : <?php echo $data["eve_theme"]; ?><br>
                    <i class="fas fa-users"></i> จำนวนที่สามารถรับได้สูงสุด : <?php echo $data["eve_limit"]; ?> คน<br>
                    <i class="fas fa-money-bill-alt"></i> ค่าสมัครเข้างาน : <?php echo $data["eve_price"]; ?><br>
                    <i class="fas fa-sign-in-alt"></i> ผู้เข้าร่วมงานตอนนี้ : <?php
                    $scount = "SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$data["eve_id"]."'";
                    echo $conn->query($scount)->fetch_assoc()["COUNT(eve_id)"];
                    ?> คน <-->
                    <?php
                    if (isset($_SESSION["loginemail"])) {
                        $sqlwow = "SELECT reg_id,reg_payin FROM register WHERE euse_id = '".$_SESSION["loginid"]."' AND eve_id = '".$_GET['eventid']."'";
                        $sql = "SELECT * FROM payment WHERE euse_id = '".$_SESSION["loginid"]."' AND pay_id = '".$conn->query($sqlwow)->fetch_assoc()["reg_id"]."'";
                        if ($conn->query($sqlwow)->num_rows > 0) {
                            if ($conn->query($sql)->num_rows > 0 && $conn->query($sqlwow)->fetch_assoc()["reg_payin"] == 0){
                            //if ($conn->query($sql)->fetch_assoc()["reg_payin"] == 0){
                            ?>
                                <button class="btn btn-warning"><i class="fas fa-circle-notch fa-spin"></i> รอผู้ดูแล หรือ ผู้จัดสัมมนายืนยัน</button>
                                <!--a class="btn btn-warning" href="https://event.teamquadb.in.th/payevent.php?price=<? echo $data["eve_price"] ?>&id=<? echo $conn->query($sql)->fetch_assoc()["reg_id"] ?>" role="button"><i class="fas fa-exclamation-circle"></i> ชำระค่าสมัคร</a-->
                            <?
                            } else if ($conn->query($sql)->num_rows == 0 && $conn->query($sqlwow)->fetch_assoc()["reg_payin"] == 0) {
                            ?>
                                <a class="btn btn-warning" href="https://event.teamquadb.in.th/payevent.php?price=<? echo $data["eve_price"] ?>&id=<? echo $conn->query($sql)->fetch_assoc()["reg_id"] ?>" role="button"><i class="fas fa-exclamation-circle"></i> ชำระค่าสมัคร</a>
                            <?
                            }else{
                            ?>
                                <button class="btn btn-light"><i class="fas fa-check-circle"></i> เข้าร่วมสัมมนานี้แล้ว</button>
                            <?
                            }
                        }else{
                            if ($conn->query("SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$data["eve_id"]."'")->fetch_assoc()["COUNT(eve_id)"] == $data["eve_limit"]) {
                            ?>
                                <button type="button" class="btn btn-danger"><i class="fas fa-times-circle"></i> เต็มจำนวนแล้ว</button>
                            <?
                            }else{
                            ?>
                                <button onclick="joinevent('<?php echo $data['eve_id'] ?>','<?php echo $data['eve_name'] ?>','<?php echo $data['eve_theme'] ?>','<?php echo $data['eve_price'] ?>')" class="btn btn-primary">เข้าร่วมสัมมนา</button>
                            <?
                            }
                        }
                    }else{
                        if ($conn->query("SELECT COUNT(eve_id) FROM register WHERE eve_id = '".$data["eve_id"]."'")->fetch_assoc()["COUNT(eve_id)"] == $data["eve_limit"]) {
                        ?>
                            <button type="button" class="btn btn-danger"><i class="fas fa-times-circle"></i> เต็มจำนวนแล้ว</button>
                        <?
                        }else{
                        ?>
                            <button data-toggle="modal" data-target="#logModal" class="btn btn-primary">เข้าร่วมสัมมนา</button>
                        <?
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }else{
        echo '<script language="javascript">';
        echo 'alert("ไม่มีกิจกรรมนี้อยู่")';
        echo '</script>';
    }
    ?>

    <?php include_once 'larmod.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    function joinevent(idevent,eventname,eventtheme,price) {
        Swal.fire({
            title: 'คุณต้องการที่จะเข้างานสัมมนานี้ใช่หรือไม่?',
            html: 'ชื่อสัมนนา : '+ eventname +' <br> ธีมงาน : '+ eventtheme +' <br> ค่าสมัครเข้างาน : '+ price +' <br> ผู้เข้าร่วมงานตอนนี้ : 0 คน',
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