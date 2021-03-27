<?php
if(isset($_GET['lastdevice'])){
    $myfile = fopen("devjoin.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("devjoin.txt"));
    fclose($myfile);
}else{
    $myfile = fopen("devjoin.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $_GET['id']);
    fclose($myfile);
}
?>