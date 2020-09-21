
<?php
session_start();

$password = 'qlalfqlalfqjsgh';
$password = substr(hash('sha256', $password, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);



$id = $_POST['id'];
$pass = $_POST['userpass'];



$id = openssl_decrypt(base64_decode($id), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);
$pass = openssl_decrypt(base64_decode($pass), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);


$mysqli = mysqli_connect("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from member where  id = '$id'";
$data = mysqli_query($mysqli, $query);
$exist_id = mysqli_num_rows($data);

$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    
    
    
   $plainText = $row['pass'];
 
   
}

$password2 = 'password string';
$password2 = substr(hash('sha256', $password2, true), 0, 32);
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
$decrypted = openssl_decrypt(base64_decode($plainText), 'aes-256-cbc', $password2, OPENSSL_RAW_DATA, $iv);




if (! $exist_id) {
    echo ("
           <script>
             window.alert('아이디가 존재하지 않습니다.')
             history.go(-1)
           </script>
         ");
    exit();
} else if ($pass == $decrypted) {
   
    
  
    $_SESSION['id'] = $id;
    
    echo "
  <script>
  location.href = 'main.php';
  </script>
  ";

    
    
} else {
    
   
    echo ("
           <script>
             window.alert('비밀번호가 일치하지 않습니다.')
             history.go(-1)
           </script>
         ");
         
         
    exit();
  

}

$mysqli->close();

?>