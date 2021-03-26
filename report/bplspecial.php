<?php
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script-->
    <style>

        body {
            background: rgb(204,204,204); 
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }

        page[size="A4"] {  
            width: 21cm;
            height: 29.7cm; 
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 120%;  
        }

        page[size="A3"] {
            width: 29.7cm;
            height: 42cm;
        }

        page[size="A3"][layout="landscape"] {
            width: 42cm;
            height: 29.7cm;  
        }

        page[size="A5"] {
            width: 14.8cm;
            height: 21cm;
        }

        page[size="A5"][layout="landscape"] {
            width: 21cm;
            height: 14.8cm;  
        }

        @media print {
            body, page {
                margin: 0;
                box-shadow: 0 0 0cm rgba(0,0,0,0);
            }
        }

    </style>
</head>
<body>
    <page size="A4" layout="landscape" style="font-family: 'Sarabun', sans-serif;">
            <p style="padding-left: 5%;padding-top: 2%;">ปริ้นวันที่ <?php echo date('d/m'); ?>/<?php echo (date('Y')+543)?></p>

            <center><div style="padding-top: 2%;">
            <img src="/img/agency/<? echo $conn->query("SELECT age_id FROM agency")->fetch_assoc()['age_id']; ?>.<? echo $conn->query("SELECT age_imgtype FROM agency")->fetch_assoc()['age_imgtype']; ?>" width="50">
            <h2 style="margin-top: 0px;"><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?></h2>
            ที่อยู่ : <? echo $conn->query("SELECT age_address FROM agency")->fetch_assoc()['age_address']; ?><br> 

            เบอร์ : <? echo $conn->query("SELECT age_tel FROM agency")->fetch_assoc()['age_tel']; ?><br> 
            รายงานซื้อสินค้า<br>
            <? if(isset($_GET['start']) && !isset($_GET['end'])) { ?>
                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['start'] ?>
            <? }else if(isset($_GET['start']) && isset($_GET['end'])) { ?>
                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['end'] ?>
            <? }else{ ?>
                ทั้งหมด 
            <? } ?>
            </div></center>
            <?php
            if(isset($_GET['start']) && !isset($_GET['end'])){
                $sql = "SELECT * , date(buy_datetime) AS dateonly FROM buy_product INNER JOIN joinevent ON joinevent.dev_id = buy_product.dev_id INNER JOIN event_user ON event_user.euse_id = joinevent.euse_id WHERE buy_datetime BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['start']." 23:59:59'";
            }else if(isset($_GET['start']) && isset($_GET['end'])) {
                $sql = "SELECT * , date(buy_datetime) AS dateonly FROM buy_product INNER JOIN joinevent ON joinevent.dev_id = buy_product.dev_id INNER JOIN event_user ON event_user.euse_id = joinevent.euse_id WHERE buy_datetime BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['end']." 23:59:59'";
            }else{
                $sql = "SELECT * , date(buy_datetime) AS dateonly FROM buy_product INNER JOIN joinevent ON joinevent.dev_id = buy_product.dev_id INNER JOIN event_user ON event_user.euse_id = joinevent.euse_id ORDER BY dateonly";
            }
            $allcount = 0;
            $count= 1;
            $sum=0;
            $allsum=0;
            $oldday = "0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //echo "<br> id: ". $row["eve_name"]. " - Name: ". $row["eve_address"]. " " . $row["eve_theme"] . "<br>";
                    ?>
                    <?
                    if ($oldday != $row["dateonly"]){
                        ?>
                        <? if($allcount != 0) { ?>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        </table>
                            <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมราคาทั้งหมด <? echo $sum ?> บาท<br>รวมทั้งหมด <? echo $count ?> รายการ</h3>
                            <!--h3 style="float: right;padding-left: 5%;padding-right: 5%;">รวมราคาทั้งหมด <? echo $sum ?> บาท</h3><br>
                            <h3 style="float: right;padding-left: 5%;padding-right: 5%;">รวมทั้งหมด <? echo $count ?> รายการ</h3-->
                        <? } ?>
                        <? $sum=0; /*echo $count;*/ $count= 1; ?>
                        <table style="text-align: center;width:100%;padding-left: 5%;padding-right: 5%;">
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <tr>
                            <th>วันที่ <?php echo $row["dateonly"] ?></th>
                        </tr>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <tr>
                            <!--th><?php echo $row["dateonly"] ?></th-->
                            <!--th>ไอดีซื้อ</th-->
                            <!--th>รหัสอุปกรณ์</th-->
                            <th>ชื่อลูกค้า</th>
                            <th>ราคา</th>
                            <th>เวลา</th>
                            <th></th>
                        </tr>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <?
                        }else{
                            $count++;
                        }
                        $oldday = $row["dateonly"];
                        ?>
                        <tr>
                            <!--td><? echo $row["buy_id"] ?></td-->
                            <td><? echo $row["euse_name"] ?></td>
                            <!--td><? echo $row["dev_id"] ?></td-->
                            <td><? echo $row["buy_sum"] ?> บาท</td>
                            <td><? echo str_replace($oldday,"",$row["buy_datetime"]) ?></td>
                            <td><a href="bplist.php?lid=<? echo $row["buy_id"] ?>" target="_blank">แสดงรายการซื้อ</a></td>
                            <!--td><? //echo $row["buy_datetime"] ?> <?php //echo $count ?></td-->
                        </tr>
                    <?
                    $sum+=$row["buy_sum"];
                    //$oldday = $row["dateonly"];
                    $allcount++;
                    $allsum+=$row["buy_sum"];
                    if($allcount == $result->num_rows){
                        ?>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        </table>
                        <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมราคาทั้งหมด <? echo $sum ?> บาท<br>รวมทั้งหมด <? echo $count ?> รายการ</h3>
                        <!--h3 style="float: right;padding-left: 5%;padding-right: 5%;">รวมราคาทั้งหมด <? echo $sum ?> บาท</h3><br>
                        <h3 style="float: right;padding-left: 5%;padding-right: 5%;">รวมทั้งหมด <? echo $count ?> รายการ</h3-->
                        <?
                    }
                }
                ?>
                <br>
                <br>
                <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมราคาทุกวันทั้งหมด <? echo $allsum ?> บาท<br>รวมรายการทั้งหมด <? echo $allcount ?> รายการ</h3>
                <?
            } else {
                echo "0 results";
            }
            ?>
    </page>
    <!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script-->
</body>
</html>