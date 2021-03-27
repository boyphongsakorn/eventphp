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
<?php
//$sql = "SELECT euse_money FROM event_user WHERE euse_email = '".$_SESSION["loginname"]."'";
//$result = $conn->query($sql);

if ($_GET['price'] == 0){

$sql = "INSERT INTO register VALUES ('".substr(uniqid(),0,13)."','".$_SESSION["loginid"]."', '".$_GET['eventid']."', NOW(),1)";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        Swal.fire(
            'ยินดีด้วย',
            'คุณได้เข้าร่วมสัมมนานี้เรียบร้อยแล้ว',
            'succes'
        ).then((result) => {
            window.location.replace("index.php")
        })
    </script>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}else {

$id = substr(uniqid(),0,13);

$check = "DELETE FROM register WHERE euse_id = '".$_SESSION["loginid"]."' AND eve_id = '".$_GET['eventid']."' AND reg_payin = '0'";

if ($conn->query($check) === TRUE && $conn->affected_rows > 0) {
    echo "มีการลงทะเบียนแล้ว แต่ลงอีก ทำไมถึงลงได้นะ ?";
}

$sql = "INSERT INTO register VALUES ('".$id."','".$_SESSION["loginid"]."', '".$_GET['eventid']."', NOW(),0)";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>location.replace("https://event.teamquadb.in.th/payevent.php?price=<? echo $_GET["price"] ?>&id=<? echo $id ?>")</script>
    <!-- True Wallet Modal>
    <div class="modal fade" id="TWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Donate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="https://boyphongsakorn.github.io/img/qrcode_tmw.jpg" width="100%">
                    <form action="api/CheckTW.php" method="POST">
                    <input type="hidden" name="regid" value="<?php echo $id?>">
                    อีเมล : <input type="text" class="form-control"name="email" value="<?php echo $_SESSION["loginemail"] ?>" readonly>
                    จำนวนเงินที่โอน : <input type="text" class="form-control" name="money" value="<?php echo $_GET["price"] ?>" readonly>
                    เวลา (ตัวอย่าง เช่น 01/10/19 13:10) : <input type="text" class="form-control" name="time" placeholder="เวลาที่ทำการโอน เช่น 01/10/19 13:10">
                    <input type="submit" class="form-control" value="ส่งตรวจ">
                    </form>
                </div>
            </div>
        </div>
    </div-->
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();

?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})
$(document).ready(function(){
    $("#TWModal").modal('show');
});
</script>


</body>
</html>