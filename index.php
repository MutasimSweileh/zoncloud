<?php
function getURL($url,$proxy=null)
{
    $timeout = 30;
    $ch      = curl_init();
    //$timeout = 60; // set to zero for no timeout
    curl_setopt($ch, CURLOPT_URL, $url);
    if($proxy){
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
      //echo $proxy." - ";
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
     $error_msg = curl_error($ch);
     throw new Exception("CURLError: ".$error_msg);
     }
    curl_close($ch);
    return $file_contents;
    return ($file_contents?$file_contents:$error_msg);
}
function isv($is='', $a=false)
{
    if (array_key_exists($is,$_POST) and !$a) {
        return $_POST[$is];
    } elseif (array_key_exists($is,$_GET)) {
        return $_GET[$is];
    } elseif (array_key_exists($is,$_FILES)) {
        return $_FILES[$is];
    }
    return false;
}
function ip()
    {
        $alt_ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] as $ip) {
                if (!preg_match("#^(10|172\.16|192\.168)\.#", $ip)) {
                    $alt_ip = $ip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_FROM'])) {
            $alt_ip = $_SERVER['HTTP_FROM'];
        }
        return $alt_ip;
    }

if(isv("code")){
  $ip_data = getURL("http://www.geoplugin.net/json.gp?ip=".ip());
$ip_data = json_decode($ip_data,true);
echo json_encode($ip_data);
  die();
}
echo "welcome :)";
?>
