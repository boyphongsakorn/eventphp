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

        th {

            /*border-top: 1px solid black;

            border-bottom: 1px solid black;*/

        }

        table {

            /*border-bottom: 1px solid black;*/

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

            รายงานการเติมเงิน<br>

            <? if(isset($_GET['start']) && !isset($_GET['end'])) { ?>

                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['start'] ?>

            <? }else if(isset($_GET['start']) && isset($_GET['end'])) { ?>

                ระหว่าง <? echo $_GET['start'] ?> ถึง <? echo $_GET['end'] ?>

            <? }else{ ?>

                ทั้งหมด 

            <? } ?>

            <? if(isset($_GET['eveid'])) { ?>

            <br>ของสัมมนาชื่อ <? echo $conn->query("SELECT eve_name FROM event_list WHERE eve_id='".$_GET['eveid']."'")->fetch_assoc()['eve_name']; ?>

            <? } ?>

            </div></center>

            <table style="text-align: center;width:100%;padding-left: 5%;padding-right: 5%;">

                <tr><td colspan="5"><hr style="width: 100%"></td></tr>
                <tr>

                    <!--th>ไอดีอุปกรณ์</th-->
                    <th>วันที่ทำการเติม</th>
                    <th>ชื่อลูกค้า</th>

                    <th>จำนวนที่เติม</th>
                    <!--th>สัมมนาที่เติม</th-->

                    <!--th>วันที่ทำการเติม</th>

                    <th>พนักงานที่ทำการเติม</th-->

                </tr>
                <tr><td colspan="5"><hr style="width: 100%"></td></tr>

            <?php

            if(isset($_GET['start']) && !isset($_GET['end'])){

                $sql = "SELECT * FROM topup INNER JOIN employees ON topup.emp_id = employees.emp_id INNER JOIN joinevent ON topup.dev_id = joinevent.dev_id INNER JOIN event_list ON joinevent.eve_id = event_list.eve_id INNER JOIN event_user ON joinevent.euse_id = event_user.euse_id WHERE top_datetime BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['start']." 23:59:59'";

                if(isset($_GET['eveid'])){
                    $sql .= " AND joinevent.eve_id = '".$_GET['eveid']."'";
                }
            }else if(isset($_GET['start']) && isset($_GET['end'])) {

                $sql = "SELECT * FROM topup INNER JOIN employees ON topup.emp_id = employees.emp_id INNER JOIN joinevent ON topup.dev_id = joinevent.dev_id INNER JOIN event_list ON joinevent.eve_id = event_list.eve_id INNER JOIN event_user ON joinevent.euse_id = event_user.euse_id WHERE top_datetime BETWEEN '".$_GET['start']." 00:00:00' AND '".$_GET['end']." 23:59:59'";

                if(isset($_GET['eveid'])){
                    $sql .= " AND joinevent.eve_id = '".$_GET['eveid']."'";
                }
            }else{

                $sql = "SELECT * FROM topup INNER JOIN employees ON topup.emp_id = employees.emp_id INNER JOIN joinevent ON topup.dev_id = joinevent.dev_id INNER JOIN event_list ON joinevent.eve_id = event_list.eve_id INNER JOIN event_user ON joinevent.euse_id = event_user.euse_id";

                if(isset($_GET['eveid'])){
                    $sql .= " WHERE joinevent.eve_id = '".$_GET['eveid']."'";
                }

            }

            //echo $sql;

            $result = $conn->query($sql);

            $allsum=0;

            if ($result->num_rows > 0) {

                // output data of each row

                while($row = $result->fetch_assoc()) {

                    //echo "<br> id: ". $row["eve_name"]. " - Name: ". $row["eve_address"]. " " . $row["eve_theme"] . "<br>";

                    ?>

                    <tr>

                        <!--td><? echo $row["dev_id"] ?></td-->
                        <td><? echo $row["top_datetime"] ?></td>
                        <td><? echo $row["euse_name"] ?></td>

                        <td><? echo $row["top_price"] ?></td>
                        <!--td><? echo $row["eve_name"] ?></td-->

                        <!--td><? echo $row["emp_name"] ?></td-->

                    </tr>

                    <?
                    $allsum+=$row["top_price"];
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
            <tr><td colspan="5"><hr style="width: 100%"></td></tr>
            </table>

            <h3 style="text-align: right;padding-left: 5%;padding-right: 5%;">รวมทั้งหมด <? echo $result->num_rows ?> รายการ<br>รวมราคาทั้งหมด <? echo $allsum ?> บาท</h3>


    </page>



    <!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script-->

</body>

</html>