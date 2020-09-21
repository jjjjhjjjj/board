<?php
session_start();
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

if (isset($_GET['num']))
    $number = $_GET['num'];

$ffquery = "select file_id from file where list_num=$number";
$ffdata = $mysqli->query($ffquery);

while ($frow = $ffdata->fetch_assoc()) {

    $delfile = $frow['file_id'];

    if ($delfile != NULL)
        unlink("data/" . $delfile);
}

$mysqli->autocommit(false);

$query = "delete from  board where num = $number";

$result = $mysqli->query($query);

$nquery = "update  board set num = num-1 where num>$number";
$rr = $mysqli->query($nquery);

$pquery = "delete from plus_id where list_num = $number";

$pp = $mysqli->query($pquery);

$puquery = "update plus_id set num = num-1 where num>$number";
$pu = $mysqli->query($puquery);

$fdquery = "delete from file where list_num = $number";

$fdp = $mysqli->query($fdquery);

$fuquery = "update  file set num = num-1 where num>$number";
$fu = $mysqli->query($fuquery);

if ($result && $rr && $pp && $pu && $fdp && $fu) {
    $mysqli->commit();
} else
    $mysqli->rollback();

$mysqli->close();

echo "
	   <script>
	    location.href = 'main.php';
	   </script>
	";

?>
