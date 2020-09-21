<?php
session_start();
$sid = $_SESSION['id'];
$number = $_POST['number'];
$inputpass = $_POST['userpass'];

$password2 = 'qlalfqlalfqjsgh';
$password2 = substr(hash('sha256', $password2, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

$inputpass = openssl_decrypt(base64_decode($inputpass), 'aes-256-cbc', $password2, OPENSSL_RAW_DATA, $iv);



$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select id from board where num = $number";

$result = $mysqli->query($query);
$row = $result->fetch_assoc();

$id = $row['id'];

 if($sid != $id){
    echo "
	 <script>
	    alert ('작성자가 일치하지 않습니다.');
        location.href = 'view.php?num=$number';
	   </script>
	";
}

$pquery = "select pass from member where id = '$id'";

$presult = $mysqli->query($pquery);
$prow = $presult->fetch_assoc();


$password = 'password string';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$depass = openssl_decrypt(base64_decode($prow['pass']), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);


if ($inputpass == $depass) {
    echo "
	   <script>
	    location.href = 'modify_form.php?number=$number';
	   </script>
	";
} else if ($inputpass == NULL) {
    echo "
	   <script>
	    alert ('비밀번호를 입력해주세요.');
        location.href = 'modi_pw_form.php?number=$number';
	   </script>
	";
} else {

    echo "
	   <script>
	    alert ('비밀번호가 틀렸습니다.');
        location.href = 'view.php?num=$number';
	   </script>
	";
}

$mysqli->close();

?>