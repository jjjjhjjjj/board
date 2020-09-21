<?php
session_start();
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');
$number = $_GET['num'];

if (isset($_GET['gopage']))
    $gopage = $_GET['gopage'];

if (isset($_GET['adminpage']))
    $adminpage = $_GET['adminpage'];

    
$query = "delete from plus_id where num = $number";

$result = $mysqli->query($query);

$nquery = "update plus_id set num = num-1 where num>$number";
$rr = $mysqli->query($nquery);

$mysqli->close();

$sid = $_SESSION['id'];

if ($sid == 'admin') {

    echo "
<script>
    location.href = 'admin_member.php?num=$adminpage';
</script>
";
} else {

    echo "
<script>
    location.href = 'view.php?num=$gopage';
</script>
";
}

?>
