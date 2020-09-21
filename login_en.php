<?php
$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

$id = $_POST['userid'];
$userpass = $_POST['userpass'];

$id = base64_encode(openssl_encrypt($id, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$userpass = base64_encode(openssl_encrypt($userpass, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

?>

<html>
<head>


<body onload='document.form1.submit();'>

	<form name='form1' method='post' action='login_check.php'>

		<input type='hidden' name='id' value='<?php echo $id?>'> <input
			type='hidden' name='userpass' value='<?php echo $userpass?>'>

	</form>

</body>

</head>
</html>