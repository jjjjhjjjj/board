<?php

$file_id = $_GET['file_id'];



$mysqli = mysqli_connect("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$fquery = "select file from file where file_id = '$file_id'";

$fresult = $mysqli->query($fquery);
$frow = $fresult->fetch_assoc();

$file = $frow['file'];
$filename = $file_id;
$real_filename = urldecode($filename);
$file_dir = "data/" . $real_filename;

header('Content-Type: application/x-octetstream');
header('Content-Length: ' . filesize($file_dir));
header('Content-Disposition: attachment; filename=' . iconv('utf-8', 'euc-kr', $file));
header('Content-Transfer-Encoding: binary');

$fp = fopen($file_dir, "r");
fpassthru($fp);
fclose($fp);

?>
