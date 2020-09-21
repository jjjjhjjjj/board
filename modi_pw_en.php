<?php
session_start();

$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

$inputpass = $_POST['userpass'];

$userpass = base64_encode(openssl_encrypt($inputpass, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

$number = $_POST['number'];
?>

<html>
<head>


<body onload='document.form1.submit();'>

	<form name='form1' method='post' action='modi_pw_check.php'>

		<input type='hidden' name='number' value='<?php echo $number?>'> <input
			type='hidden' name='userpass' value='<?php echo $userpass?>'>

	</form>

</body>

</head>
</html>