<?php
session_start();
$sid = $_SESSION['id'];

$inputpass = $_POST['userpass'];

$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');



$pquery = "select pass from member where id = '$sid'";

$presult = $mysqli->query($pquery);
$prow = $presult->fetch_assoc();

$password = 'password string';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$depass = openssl_decrypt(base64_decode($prow['pass']), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);

if ($inputpass == $depass) {
    echo "
	   <script>
	    location.href = 'member_modi.php?id=$sid';
	   </script>
	";
} else if ($inputpass == NULL) {
    echo "
	   <script>
	    alert ('비밀번호를 입력해주세요.');
        location.href = 'member_modi_check_form.php';
	   </script>
	";
} else {
    
    echo "
	   <script>
	    alert ('비밀번호가 틀렸습니다.');
        location.href = 'member_modi_check_form.php';
	   </script>
	";
}

$mysqli->close();

?>