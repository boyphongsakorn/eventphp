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
            รายงานเข้า-ออกสัมมนา<br>
            <? if(isset($_GET['start']) && !isset($_GET['end'])) { ?>
                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['start'] ?>
            <? }else if(isset($_GET['start']) && isset($_GET['end'])) { ?>
                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['end'] ?>
            <? }else{ ?>
                ทั้งหมด 
            <? } ?>
            </div></center>
            <?php
            if(isset($_GET['start'])){
                $sql = "SELECT * , date(jee_inevent) AS dateonly FROM jeeventhis INNER JOIN event_list ON jeeventhis.eve_id = event_list.eve_id WHERE jee_inevent BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['start']." 23:59:59'";
            }else if(isset($_GET['start']) && isset($_GET['end'])) {
                $sql = "SELECT * , date(jee_inevent) AS dateonly FROM jeeventhis INNER JOIN event_list ON jeeventhis.eve_id = event_list.eve_id WHERE jee_inevent BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['end']." 23:59:59'";
            }else{
                $sql = "SELECT * , date(jee_inevent) AS dateonly FROM jeeventhis INNER JOIN event_list ON jeeventhis.eve_id = event_list.eve_id";
            }

            if((isset($_GET['start']) || isset($_GET['end'])) && isset($_GET['eveid'])){
                $sql .= " AND jeeventhis.eve_id = '".$_GET['eveid']."'";

            }else if(isset($_GET['eveid'])){
                $sql .= " WHERE jeeventhis.eve_id = '".$_GET['eveid']."'";
            }

            $sql .= " ORDER BY dateonly";

            //echo $sql;

            $allcount = 0;
            $count= 1;
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
                            <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมทั้งหมด <? echo $count ?> คน</h3>
                        <? } ?>
                        <? /*echo $count;*/ $count= 1; ?>
                    <table style="width:100%;padding-left: 5%;padding-right: 5%;text-align: center;">
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <tr>
                            <th>วันที่ <?php echo $row["dateonly"] ?></th>
                        </tr>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <tr>
                            <th>ไอดีอุปกรณ์</th>
                            <? if(!isset($_GET['eveid'])) {?>
                            <th>ชื่อสัมมนา</th>
                            <? } ?>
                            <th>เวลาเข้า</th>
                            <th>เวลาออก</th>
                        </tr>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        <?
                        }else{
                            $count++;
                        }
                        $oldday = $row["dateonly"];
                        ?>
                        <tr>
                            <td><? echo $row["dev_id"] ?></td>
                            <? if(!isset($_GET['eveid'])) {?>
                            <td><? echo $row["eve_name"] ?></td>
                            <? } ?>
                            <td><? echo str_replace($oldday,"",$row["jee_inevent"]) ?></td>
                            <td style="width:300px"><? if(str_replace($oldday,"",$row["jee_exitevent"])=="0000-00-00 00:00:00"){echo "ยังไม่มีการออกจากสัมมนา";}else{ echo str_replace($oldday,"",$row["jee_exitevent"]); } ?></td>
                            <!--td><? //echo $row["buy_datetime"] ?> <?php //echo $count ?></td-->
                        </tr>
                    <?
                    $allcount++;
                    if($allcount == $result->num_rows){
                        ?>
                        <tr><td colspan="4"><hr style="width: 100%"></td></tr>
                        </table>
                        <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมทั้งหมด <? echo $count ?> คน</h3>
                        <?
                    }
                }
            } else {
                ?>
                <tr>
                <td>
                <?
                echo "ไม่มีข้อมูล";
                ?>
                </td>
                </tr>
                <?
            }
            ?>
    </page>
    <!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script-->
</body>
</html>