
<?php
$fp = fsockopen("ldv80.ddns.net", 8082, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
#    $out = "GET / HTTP/1.1\r\n";
#    $out .= "Host: www.example.com\r\n";
#    $out .= "Connection: Close\r\n\r\n";
#    fwrite($fp, $out);
    $str = "@";
    while (!feof($fp) or strlen($str) == 0) {
        $str = fgets($fp);
        echo $str;
    }
    fclose($fp);
}
?>
