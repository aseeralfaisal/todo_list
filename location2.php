<?php

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}
$ip_address = file_get_contents('http://checkip.dyndns.com/');
echo '<br><br>';
// echo $ip_address;
echo '<br><br>';
$PublicIP = str_replace("Current IP Address: ", "", $ip_address);
// $json     = file_get_contents("http://ipinfo.io/$PublicIP/geo");
$json = file_get_contents("http://ip-api.com/json");
$json = json_decode($json, true);
?>
<!DOCTYPE>
<html>

<head>
    <title>Get Visitor's Current Location</title>
</head>

<body>
    <div>
        <?php print_r($json['timezone']); ?>
    </div>
</body>

</html>