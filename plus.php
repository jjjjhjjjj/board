
<?php
session_start();
$sid = $_SESSION['id'];
$regist_day = date("Y-m-d H:i:s");
$name = $_POST['username'];

$sub = $_POST['subject'];
$number = $_POST['number']; // list_num

$mysqli = mysqli_connect("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$rquery = "select * from plus_id";
$data = mysqli_query($mysqli, $rquery);
$total_rows = mysqli_num_rows($data);

$total_rows = $total_rows + 1;

$sql = "insert into plus_id (num,name,comment,id,day,list_num) values ($total_rows,'$name','$sub','$sid','$regist_day',$number)";
$result = $mysqli->query($sql);

$mysqli->close();

echo "
	   <script>
	    location.href = 'view.php?num=$number';
	   </script>
	";

?>