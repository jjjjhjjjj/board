<?php
$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);



$hp1 = $_POST['hp1'];
$hp2 = $_POST['hp2'];
$hp3 = $_POST['hp3'];
$hp = $hp1 . "-" . $hp2 . "-" . $hp3;
$id = $_POST['userid'];


$userpass = $_POST['userpass'];
$name = $_POST['username'];
$nick = $_POST['usernick'];
$addr = $_POST['sample4_postcode']; // 우편주소
$roadaddr = $_POST['sample4_roadAddress'];
$jibunaddr = $_POST['sample4_jibunAddress'];
$plusaddr = $_POST['sample4_detailAddress'];



$hp = base64_encode(openssl_encrypt($hp, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$id = base64_encode(openssl_encrypt($id, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$userpass = base64_encode(openssl_encrypt($userpass, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$name = base64_encode(openssl_encrypt($name, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$nick = base64_encode(openssl_encrypt($nick, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$addr = base64_encode(openssl_encrypt($addr, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$roadaddr = base64_encode(openssl_encrypt($roadaddr, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$jibunaddr = base64_encode(openssl_encrypt($jibunaddr, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$plusaddr = base64_encode(openssl_encrypt($plusaddr, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));



?>


<html><head>

<body onload='document.form1.submit();'>
<form name='form1' method='post' action='finish.php'>

<input type='hidden' name = 'hp' value ='<?php echo $hp?>'>
<input type='hidden' name = 'id' value ='<?php echo $id?>'>
<input type='hidden' name = 'userpass' value ='<?php echo $userpass?>'>
<input type='hidden' name = 'name' value ='<?php echo $name?>'>
<input type='hidden' name = 'nick' value ='<?php echo $nick?>'>
<input type='hidden' name = 'addr' value ='<?php echo $addr?>'>
<input type='hidden' name = 'roadaddr' value ='<?php echo $roadaddr?>'>
<input type='hidden' name = 'plusaddr' value ='<?php echo $plusaddr?>'>
<input type='hidden' name = 'jibunaddr' value ='<?php echo $jibunaddr?>'>


</form>

</body>


</head></html>