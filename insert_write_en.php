
<?php
session_start();

$sub = $_POST['subject'];
$con = $_POST['contents'];

foreach ($_FILES['upfile']['name'] as $f => $name) {

    $file_name = $_FILES['upfile']['name'][$f]; // 업로드한 파일명
    if ($file_name != NULL) {
        $file_tmp_name = $_FILES['upfile']['tmp_name'][$f]; // 임시 디렉토리에 저장된 파일명
    }
}

$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

$sub = base64_encode(openssl_encrypt($sub, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));
$con = base64_encode(openssl_encrypt($con, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

?>


<html>
<head>


<body onload='document.form1.submit();'>

	<form name='form1' method='post' action='insert_write.php'>

		<input type='hidden' name='subject' value='<?php echo $sub?>'> <input
			type='hidden' name='contents' value='<?php echo $con?>'> <input
			type="file" name="upfile[]" id="upfile" multiple='multiple'
			value='<?php echo $_FILES['upfile']?>'>

	</form>

</body>

</head>
</html>