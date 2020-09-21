
<?php
session_start();
$id = $_SESSION['id'];
$regist_day = date("Y-m-d h:i:s");
$sub = $_POST['subject'];
$con = $_POST['contents'];

// 확장자 체크
$allowed_ext = array(
    'jpg',
    'jpeg',
    'png',
    'gif',
    'pdf',
    'hwp',
    'zip',
    'xlsx',
    'xls',
    'xlsm'
);

$mysqli = mysqli_connect("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$rquery = "select * from board";
$data = mysqli_query($mysqli, $rquery);
$total_rows = mysqli_num_rows($data);

$total_rows = $total_rows + 1;

$fresult = TRUE;
$mysqli->autocommit(false);

$check = true;
$i = 0;
while (! empty($_FILES['upfile']['name'][$i])) {

    $file_name = $_FILES['upfile']['name'][$i]; // 업로드한 파일명
    $ext = explode('.', $file_name);

    if (! in_array($ext[1], $allowed_ext)) {
        $check = false;
        break;
    }
    $i ++;
}

foreach ($_FILES['upfile']['name'] as $f => $name) {

    if ($check == FALSE) {
        echo "
                <script>
                alert('허용되지 않는 확장자입니다.');
                history.back();
                 </script>
                 ";

        exit();
    }

    $file_name = $_FILES['upfile']['name'][$f]; // 업로드한 파일명
    if ($file_name != NULL) {

        $file_tmp_name = $_FILES['upfile']['tmp_name'][$f]; // 임시 디렉토리에 저장된 파일명

        $save_dir = 'data/';

        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        $file_id = md5(uniqid(rand(), true)) . "." . $ext;

        $dest_url = $save_dir . $file_id;
        move_uploaded_file($file_tmp_name, $dest_url);

        $fquery = "select * from file";
        $fdata = mysqli_query($mysqli, $fquery);
        $ftotal_rows = mysqli_num_rows($fdata);

        $ftotal_rows = $ftotal_rows + 1;

        $fsql = "insert into file (num,file,file_id,id,day,list_num) values ($ftotal_rows,'$file_name','$file_id','$id','$regist_day',$total_rows)";

        $fresult = $mysqli->query($fsql);
    }
}

if ($fresult) {

    $mysqli->commit();
} else
    $mysqli->rollback();

$sql = "insert into board (num,id,title,contents,date) values ($total_rows,'$id','$sub','$con','$regist_day')";

$result = $mysqli->query($sql);

if ($result) {
    $mysqli->commit();
} else
    $mysqli->rollback();

echo "
  <script>
  location.href = 'main.php';
  </script>
  ";

?>