<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?
session_start();
include 'config.php';

$sql = "DELETE FROM employees WHERE emp_id='".$_GET["empid"]."'";

if ($conn->query($sql) === TRUE) {
  ?>
    <script>
        Swal.fire(
            'เรียบร้อย!',
            'ลบบัญชีพนักงานเรียบร้อยแล้ว',
            'succes'
        ).then((result) => {
            window.location.replace("useremp.php")
        })
    </script>
  <?
} else {
    ?>
    <script>
        Swal.fire(
            'ไม่สำเร็จ!',
            'ลบไม่ได้เนี่องจากไม่มีบัญชีนี้แล้วหรือมีข้อผิดพลาด',
            'error'
        ).then((result) => {
            window.location.replace("useremp.php")
        })
    </script>
    <?
}
?>