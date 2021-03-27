<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
include 'config.php';

if ($_POST['password'] == $_POST['recheckpassword']){

    $sql = "INSERT INTO event_user (euse_id, euse_name, euse_password, euse_email, euse_address, euse_username) VALUES ('".$_POST['id']."', '".$_POST['name']."', '".md5($_POST['password'])."', '".$_POST['email']."', '".$_POST['address']."', '".$_POST['username']."')";

    if($conn->query("SELECT * FROM event_user WHERE euse_username = '".$_POST['username']."'")->num_rows == 0 && $conn->query("SELECT * FROM event_user WHERE euse_email = '".$_POST['email']."'")->num_rows == 0) {
        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
            Swal.fire(
                'เรียบร้อย',
                'สมัครสำเร็จแล้ว',
                'succes'
            ).then((result) => {
                location.replace("https://event.teamquadb.in.th/");
            })
            </script>
            <?
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            ?>
            <script>
            Swal.fire(
                'เกิดข้อผิดพลาด',
                'มี เลขบัตรประชาชน นี้อยู่แล้ว',
                'error'
            ).then((result) => {
                window.history.back();
            })
        </script>
            <?
        }
    }else{
        ?>
        <script>
        Swal.fire(
            'เกิดข้อผิดพลาด',
            'มี Username หรือ Email นี้อยู่แล้ว',
            'error'
        ).then((result) => {
            window.history.back();
        })
        </script>
        <?
    }
    

} else {
    echo "รหัสไม่ตรงกัน";
    ?>
    <script>
        Swal.fire(
            'เกิดข้อผิดพลาด',
            'คุณใส่รหัสผ่านไม่ตรงกัน',
            'error'
        ).then((result) => {
            window.history.back();
        })
    </script>
    <?php
}

$conn->close();

?>