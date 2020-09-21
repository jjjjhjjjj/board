<?php
session_start();

$sid = $_SESSION['id'];

$realid = $_POST['realid'];

$hp1 = $_POST['hp1'];
$hp2 = $_POST['hp2'];
$hp3 = $_POST['hp3'];
$hp = $hp1 . "-" . $hp2 . "-" . $hp3;

$plainText = $_POST['userpass'];
$password = 'password string';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$enpass = base64_encode(openssl_encrypt($plainText, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

$name = $_POST['username'];
$nick = $_POST['usernick'];


$addr = $_POST['sample4_postcode']; // 우편주소
$roadaddr = $_POST['sample4_roadAddress'];
$jibunaddr = $_POST['sample4_jibunAddress'];
$plusaddr = $_POST['sample4_detailAddress'];

$regist_day = date("Y-m-d h:i:s");

$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$sql = "update member set pass= '$enpass',name='$name',nick='$nick',hp='$hp',addr='$addr',roadaddr='$roadaddr',jibunaddr='$jibunaddr',plusaddr='$plusaddr',day='$regist_day' where id = '$realid'";
$result = $mysqli->query($sql);

$mysqli->autocommit(false);

$nsql = "select num from member where id = '$realid'";
$nresult = $mysqli->query($nsql);
$nrow = $nresult->fetch_assoc();

$pnumber = $nrow['num'];

if ($nrow) {
    $mysqli->commit();
} else
    $mysqli->rollback();

$mysqli->close();

if ($sid == 'admin') {
    echo "
  <script>
  location.href = 'admin_member.php?num=$pnumber';
  </script>
  ";
} else {

    echo "
  <script>
  location.href = 'main.php';
  </script>
  ";
}

?>