<?php
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');
$number = $_GET['num'];

$query = "delete from plus_id where num = $number";

$result = $mysqli->query($query);

$nquery = "update plus_id set num = num-1 where num>$number";
$rr = $mysqli->query($nquery);

$mysqli->close();

echo "
<script>
    location.href = 'admin_member.php?num=$gopage';
</script>
";


?>
