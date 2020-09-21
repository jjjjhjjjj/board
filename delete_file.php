<?php
echo "
	   <script>
	    var check = confirm('파일을 삭제하시겠습니까?');
         if(!check) {
         history.go(-1)
    }
	   </script>
	";
$delfile = $_GET['file_id'];

$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

unlink("data/" . $delfile);

$nquery = "select list_num from file where file_id = '$delfile'";

$nresult = $mysqli->query($nquery);
$nrow = $nresult->fetch_assoc();

$list_num = $nrow['list_num'];

$query = "select num from file where file_id = '$delfile'";

$result = $mysqli->query($query);
$row = $result->fetch_assoc();

$num = $row['num'];

$fdquery = "delete from file where file_id = '$delfile'";

$fdp = $mysqli->query($fdquery);

$fuquery = "update  file set num = num-1 where num>$num";
$fu = $mysqli->query($fuquery);

echo "
	   <script>
	    location.href = 'modify_form.php?number=$list_num';
	   </script>
	";

$mysqli->close();

?>