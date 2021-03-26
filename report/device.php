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

            <center><div style="padding-top: 5%;">

            <? echo $conn->query("SELECT age_name FROM agency")->fetch_assoc()['age_name']; ?><br> 

            ที่อยู่ <br> 

            เบอร์<br> 

            รายงานอุปกรณ์<br>

            ทั้งหมด

            </div></center>

            <table style="width:100%;padding-left: 1%;padding-right: 1%;">

                <tr>

                    <th>ไอดีอุปกรณ์</th>

                    <th>ชื่ออุปกรณ์</th>

                </tr>

            <?php

            $sql = "SELECT * FROM device";

            $result = $conn->query($sql);

            

            if ($result->num_rows > 0) {

                // output data of each row

                while($row = $result->fetch_assoc()) {

                    //echo "<br> id: ". $row["eve_name"]. " - Name: ". $row["eve_address"]. " " . $row["eve_theme"] . "<br>";

                    ?>

                    <tr>

                        <td><? echo $row["dev_id"] ?></td>

                        <td><? echo $row["dev_name"] ?></td>

                    </tr>

                    <?

                }

            } else {

                echo "0 results";

            }

            ?>

            </table>

            <h3 style="float: right;padding-left: 1%;padding-right: 1%;">รวมทั้งหมด <? echo $result->num_rows ?> รายการ</h3>

    </page>



    <!--script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script-->

</body>

</html>