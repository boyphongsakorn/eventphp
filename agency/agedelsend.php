<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?
session_start();
include '../config.php';

$sql = "DELETE FROM agency WHERE age_id='".$_GET["ageid"]."'";

if ($conn->query($sql) === TRUE) {
  ?>
    <script>
        Swal.fire(
            'เรียบร้อย!',
            'ลบหน่วยงานเรียบร้อยแล้ว',
            'succes'
        ).then((result) => {
            window.location.replace("agelist.php")
        })
    </script>
  <?
} else {
    ?>
    <script>
        Swal.fire(
            'ไม่สำเร็จ!',
            'ลบไม่ได้เนี่องจากไม่มีหน่วยงานนี้แล้วหรือมีข้อผิดพลาด',
            'error'
        ).then((result) => {
            window.location.replace("agelist.php")
        })
    </script>
    <?
}
?>