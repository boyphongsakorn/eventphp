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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<!-- True Wallet Modal -->
    <div class="modal fade" id="TWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Donate</h5>
                    <a class="close" href="/" role="button">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button-->
                </div>
                <div class="modal-body">
                    <img src="https://boyphongsakorn.github.io/img/qrcode_tmw.jpg" width="100%">
                    <form action="api/checkrep.php" method="POST" enctype="multipart/form-data">
                    <!--form action="api/CheckTW.php" method="POST" enctype="multipart/form-data"-->
                    <input type="hidden" name="regid" value="<?php echo $_GET["id"] ?>">
                    อีเมล : <input type="text" class="form-control"name="email" value="<?php echo $_SESSION["loginemail"] ?>" readonly>
                    เวลา (ตัวอย่าง เช่น 01/10/19 13:10) : <input type="text" class="form-control" name="time" placeholder="เวลาที่ทำการโอน เช่น 01/10/19 13:10" required>
                    ธนาคาร : <select class="custom-select" name="bank">
                        <option value="1" selected>ธนาคารกรุงเทพ</option>
                        <option value="2">ธนาคารกสิกรไทย</option>
                        <option value="3">ธนาคารกรุงไทย</option>
                        <option value="4">ธนาคารทหารไทย</option>
                        <option value="5">ธนาคารไทยพาณิชย์</option>
                        <option value="6">ธนาคารกรุงศรีอยุธยา</option>
                        <option value="7">ธนาคารเกียรตินาคินภัทร</option>
                        <option value="8">ธนาคารซีไอเอ็มบีไทย</option>
                        <option value="9">ธนาคารทิสโก้</option>
                        <option value="10">ธนาคารธนชาต</option>
                        <option value="11">ธนาคารยูโอบี</option>
                        <option value="12">ธนาคารไทยเครดิตเพื่อรายย่อย</option>
                        <option value="13">ธนาคารแลนด์แอนด์เฮ้าส์</option>
                        <option value="14">ธนาคารไอซีบีซี</option>
                        <option value="15">ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย</option>
                        <option value="16">ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร</option>
                        <option value="17">ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย</option>
                        <option value="18">ธนาคารออมสิน</option>
                        <option value="19">ธนาคารอาคารสงเคราะห์</option>
                        <option value="20">ธนาคารอิสลามแห่งประเทศไทย</option>
                    </select>
                    จำนวนเงินที่โอน : <input type="number" class="form-control" name="money" min="<?php echo $_GET["price"] ?>">
                    แนบหลับฐาน : 
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="repimage" name="repimage" accept="image/x-png,image/gif,image/jpeg" required>
                        <label class="custom-file-label" for="repimage">Choose file</label>
                    </div>
                    <input type="submit" class="form-control" value="ส่งตรวจ">
                    </form>
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

    //$('#myModal').on('shown.bs.modal', function () {
    //    $('#myInput').trigger('focus')
    //})

    $(document).ready(function(){
        $("#TWModal").modal('show');
    });

    //$('#TWModal').on('hidden.bs.modal', function () {
    //    $('body').on('click', function(e) {
            //location.replace("https://event.teamquadb.in.th/")+
    //        e.stopPropagation()
    //    });
    //})

    $('#TWModal').on('hidden.bs.modal', function (event) {
        location.replace("https://event.teamquadb.in.th/")
    })
    </script>


</body>
</html>