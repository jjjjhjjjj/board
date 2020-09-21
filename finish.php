<?php
$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

$hp = $_POST['hp'];
$id = $_POST['id'];
$userpass = $_POST['userpass'];
$name = $_POST['name'];
$nick = $_POST['nick'];
$addr = $_POST['addr']; // 우편주소
$roadaddr = $_POST['roadaddr'];
$jibunaddr = $_POST['jibunaddr'];
$plusaddr = $_POST['plusaddr'];

$hp = openssl_decrypt(base64_decode($hp), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$id = openssl_decrypt(base64_decode($id), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$userpass = openssl_decrypt(base64_decode($userpass), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$name = openssl_decrypt(base64_decode($name), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$nick = openssl_decrypt(base64_decode($nick), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$addr = openssl_decrypt(base64_decode($addr), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$roadaddr = openssl_decrypt(base64_decode($roadaddr), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$jibunaddr = openssl_decrypt(base64_decode($jibunaddr), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$plusaddr = openssl_decrypt(base64_decode($plusaddr), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);

$regist_day = date("Y-m-d h:i:s");

$plainText = $userpass;
$password2 = 'password string';
$password2 = substr(hash('sha256', $password2, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$encrypted = base64_encode(openssl_encrypt($plainText, 'aes-256-cbc', $password2, OPENSSL_RAW_DATA, $iv));

$mysqli = mysqli_connect("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from member where  id = '$id'";
$data = mysqli_query($mysqli, $query);
$exist_id = mysqli_num_rows($data);

if ($exist_id) {
    echo ("
           <script>
             window.alert('아이디가 존재합니다.')
             history.go(-1)
           </script>
         ");
    exit();
} else {

    $rquery = "select * from member";
    $rdata = mysqli_query($mysqli, $rquery);
    $total_rows = mysqli_num_rows($rdata);

    $total_rows = $total_rows;

    $sql = "insert into member (num,id,pass,name,nick,hp,addr,roadaddr,jibunaddr,plusaddr,day) values ($total_rows,'$id','$encrypted','$name','$nick','$hp','$addr','$roadaddr','$jibunaddr','$plusaddr','$regist_day')";
    $mysqli->query($sql);

    $mysqli->close();

    echo "
  <script>
  location.href = 'main.php';
  </script>
  ";
}

?>