<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?
session_start();
include 'config.php';

$sql = "DELETE FROM event_user WHERE euse_id='".$_GET['userid']."'";

if ($conn->query($sql) === TRUE) {
  ?>
    <script>
        Swal.fire(
            'เรียบร้อย!',
            'ลบบัญชีผู้ใช้เรียบร้อยแล้ว',
            'succes'
        ).then((result) => {
            window.location.replace("userlist.php")
        })
    </script>
  <?
} else {
    ?>
    <script>
        Swal.fire(
            'ไม่สำเร็จ!',
            'ลบไม่ได้เนี่องจากมีการลบไปแล้วหรือการลงทะเบียนไปยังงานสัมมนาแล้ว',
            'error'
        ).then((result) => {
            window.location.replace("userlist.php")
        })
    </script>
    <?
}
?>