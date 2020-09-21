<?php
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$id = $_POST['id'];

$query = "select * from board where id = '$id'";

$result = $mysqli->query($query);
$total_rows_board = mysqli_num_rows($result);

if ($total_rows_board != 0) {
    while ($row = $result->fetch_assoc()) {
        $num = $row['num'];

        $dquery = "delete from  board where num = $num";
        $dd = $mysqli->query($dquery);
        // $nquery = "update board set num = num-1 where num>$num";
        // $rr = $mysqli->query($nquery);

        $mpquery = "delete from plus_id where list_num = $num";

        $mpp = $mysqli->query($mpquery);

        // $mpuquery = "update plus_id set num = num-1 where list_num>$num";
        // $mpu = $mysqli->query($mpuquery);
    }
}

$plquery = "select * from plus_id where id = '$id'";

$plresult = $mysqli->query($plquery);

$total_rows_plus = mysqli_num_rows($plresult);

if ($total_rows_plus != 0) {

    while ($plrow = $plresult->fetch_assoc()) {
        $pnum = $plrow['list_num'];
        $pquery = "delete from plus_id where list_num = $pnum";

        $pp = $mysqli->query($pquery);

        // $puquery = "update plus_id set num = num-1 where num>$pnum";
        // $pu = $mysqli->query($puquery);
    }
}

$fplquery = "select * from file where id = '$id'";

$fplresult = $mysqli->query($fplquery);

$total_rows_file = mysqli_num_rows($fplresult);

if ($total_rows_file != 0) {

    while ($fplrow = $fplresult->fetch_assoc()) {
        $fpnum = $fplrow['list_num'];
        $delfile = $fplrow['file_id'];
        unlink("data/" . $delfile);
        $fdquery = "delete from file where list_num = $fpnum";

        $fdp = $mysqli->query($fdquery);

        $fuquery = "update  file set num = num-1 where num>$fpnum";
        $fu = $mysqli->query($fuquery);
    }
}
// member

$mfplquery = "select * from member where id = '$id'";

$mfplresult = $mysqli->query($mfplquery);

$mfplrow = $mfplresult->fetch_assoc();
$mfpnum = $mfplrow['num'];
$mfdquery = "delete from member where num = $mfpnum";

$mfdp = $mysqli->query($mfdquery);

$mfuquery = "update member set num = num-1 where num>$mfpnum";
$mfu = $mysqli->query($mfuquery);

// update

$seboard = "select * from board order by num asc";

$result_board = $mysqli->query($seboard);
$i = 0;

while ($row_board = $result_board->fetch_assoc()) {
    $number = $row_board['num'];
    $i = $i + 1;
    $nquery = "update  board set num = $i where num = $number ";
    $rr = $mysqli->query($nquery);
}

$plboard = "select * from plus_id order by num asc";

$result_pl = $mysqli->query($plboard);
$j = 0;


while ($row_pl = $result_pl->fetch_assoc()) {
    $j ++;
    $number = $row_pl['num'];
    $nquery = "update  plus_id set num = $j where num = $number";
    $rr = $mysqli->query($nquery);
}


$fileboard = "select * from file order by num asc";

$result_file = $mysqli->query($fileboard);
$k = 0;


while ($row_file = $result_file->fetch_assoc()) {
    $k ++;
    $number = $row_file['num'];
    $nquery = "update  file set num = $k where num = $number";
    $rr = $mysqli->query($nquery);
}


$mysqli->close();

echo "
  <script>
  location.href = 'admin.php';
  </script>
  ";

?>
