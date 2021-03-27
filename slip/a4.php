<?php
session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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
            height: 21cm;  
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
                box-shadow: 0;
            }
        }
    </style>
</head>
<body>
    <page size="A4" style="font-family: 'Sarabun', sans-serif;">
            <center><div style="padding-top: 5%;">ใบเสร็จ</div><br>
            <img src="../img/agency/<? echo $conn->query("SELECT age_id FROM agency")->fetch_assoc()['age_id']; ?>.<? echo $conn->query("SELECT age_imgtype FROM agency")->fetch_assoc()['age_imgtype']; ?>" height="100">
            <br><? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?><br>
            <p style="margin-top: 10px;">ที่อยู่ <? echo $conn->query("SELECT age_address FROM agency")->fetch_assoc()['age_address']; ?></p>
            <table style="width: 80%;">
                <tr>
                    <td>ชื่อลูกค้า : <? echo $conn->query("SELECT euse_name FROM event_user WHERE euse_id = '".$_GET['userid']."'")->fetch_assoc()['euse_name']; ?></td>
                    <td>วันที่ชำระ : <? echo $conn->query("SELECT pay_datetime FROM payment WHERE pay_id = '".$_GET['regid']."'")->fetch_assoc()['pay_datetime']; ?></td>
                </tr>
            </table>
            <table style="width: 80%;border: 1px solid black;margin-top: 10px;">
                <tr>
                    <th>ชื่อสัมมนา</th>
                    <th>วันที่เริ่มงาน</th>
                    <th>วันสิ้นสุดงาน</th>
                    <th>ราคา</th>
                </tr>
                <tr>
                    <td align="center"><? echo $conn->query("SELECT eve_name FROM register INNER JOIN event_list ON register.eve_id = event_list.eve_id WHERE reg_id = '".$_GET['regid']."'")->fetch_assoc()['eve_name']; ?></td>
                    <td align="center"><? echo $conn->query("SELECT eve_timestart FROM register INNER JOIN event_list ON register.eve_id = event_list.eve_id WHERE reg_id = '".$_GET['regid']."'")->fetch_assoc()['eve_timestart']; ?></td>
                    <td align="center"><? echo $conn->query("SELECT eve_timeend FROM register INNER JOIN event_list ON register.eve_id = event_list.eve_id WHERE reg_id = '".$_GET['regid']."'")->fetch_assoc()['eve_timeend']; ?></td>
                    <td align="center"><? echo $conn->query("SELECT pay_money FROM payment WHERE pay_id = '".$_GET['regid']."'")->fetch_assoc()['pay_money']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-bottom: 5%;padding-top: 5%;"></td>
                </tr>
                <tr>
                    <td colspan="4" align="right">รวม <? echo $conn->query("SELECT pay_money FROM payment WHERE pay_id = '".$_GET['regid']."'")->fetch_assoc()['pay_money']; ?> บาท</td>
                </tr>
            </table>
            </center>
    </page>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>