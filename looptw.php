<?php

require "api/Truewallet.php";

$phone = '0801643864';
$password = 'team1556th';
$access_token = 'e77fac71-1ee6-4760-b9ca-98f5c0e95667';

$tw = new TrueWalletClass($phone, $password);
$tw->setAccessToken($access_token);
$data = $tw->GetProfile();
print($data["code"]);
?>