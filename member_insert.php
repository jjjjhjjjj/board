<?php
$hp1 = $_POST['hp1'];
$hp2 = $_POST['hp2'];
$hp3 = $_POST['hp3'];
$hp = $hp1 . "-" . $hp2 . "-" . $hp3;
$id = $_POST['userid'];

////////////////////////
$plainText = $_POST['userpass'];
$password = 'password string';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$encrypted = base64_encode(openssl_encrypt($plainText, 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv));

$name = $_POST['username'];
$nick = $_POST['usernick'];
$addr = $_POST['sample4_postcode']; // 우편주소
$roadaddr = $_POST['sample4_roadAddress'];
$jibunaddr = $_POST['sample4_jibunAddress'];
$plusaddr = $_POST['sample4_detailAddress'];

$regist_day = date("Y-m-d h:i:s");

echo $id;


/*
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

    $total_rows = $total_rows ;

    $sql = "insert into member (num,id,pass,name,nick,hp,addr,roadaddr,jibunaddr,plusaddr,day) values ($total_rows,'$id','$encrypted','$name','$nick','$hp','$addr','$roadaddr','$jibunaddr','$plusaddr','$regist_day')";
    $result = $mysqli->query($sql);

    $mysqli->close();

    echo "
  <script>
  location.href = 'main.php';
  </script>
  ";
}
*/
?>