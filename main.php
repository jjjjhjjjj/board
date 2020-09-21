<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>realboard</title>
<link rel="stylesheet" href="allcss/allcss.css">
<script>
function check_input()
{

  
if (document.Form.search.value.length<2)
{
    alert("2글자 이상 검색해주세요.");    
    document.Form.search.focus();
    return false;
}

}
</script>
</head>
<body>
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>

		<div class="title2">



<?php if(isset($_SESSION['id'])){  ?>

			<div class="title4" onclick="location.href='logout.php'">로그아웃</div>
			
			<?php
} else {
    ?>

			<div class="title4" onclick="location.href='login.php'">로그인</div>
			<?php
}
?>
			<div class="title5" onclick="location.href='main.php'">게시판</div>
		</div>
		<div class="table3">

			<div class="leftbutton2">
				<TABLE border=0>
					<TR>
						<TD align='center'>
							<TABLE border='0' cellpadding='0' cellspacing='0'>
								<FORM Name='Form' Method='get' Action='main.php'>
									<input type='hidden' name='find' value='1'>
									<TR>
										<TD align='right'><select name='find'
											style="background-color: cccccc;">
												<option value='title' selected><font size='2'> 제목 </font></option>
												<option value='contents'><font size='2'> 내용</font></option>
												<option value='id'><font size='2'> 작성자</font></option>
										</select></TD>
										<TD align='left'><input type='text' name='search' size='20'
											maxlength='30'> <input type='submit' value='검색'
											onclick='return check_input();'></td>
									</TR>
								</FORM>
							</TABLE>
						</TD>

					</TR>
				</TABLE>

			</div>

			<div class="leftbutton">
			
			<?php

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($id == 'admin') {
        ?>
			<input type="button" value="관리자"
					style="font-size: 15px; width: 90px; height: 30px;"
					onclick="location.href='admin.php'">
					<?php
    } else {
        ?>
        
        
        <input type="button" value="정보수정"
					style="font-size: 15px; width: 90px; height: 30px;"
					onclick="location.href='member_modi_check_form.php'">
        
        <?php
    }
}
?>
				<input type="button" value="글 작성"
					style="font-size: 15px; width: 90px; height: 30px;"
					onclick="location.href='editor.php'">
			</div>

			<TABLE border='0' cellspacing=1 cellpadding=2 width='750'>
				<TR>
					<TD></TD>
				</TR>
				<TR bgcolor='cccccc'>
					<TD width="50px;"><font size=2><center>
								<b>번호</b>
							</center></font></TD>
					<TD width="300px;"><font size=2><center>
								<b>제목</b>
							</center></font></TD>
					<TD width="100px;"><font size=2><center>
								<b>작성자</b>
							</center></font></TD>
					<TD width="200px;"><font size=2><center>
								<b>작성일</b>
							</center></font></TD>
					<TD width="50px;"><font size=2><center>
								<b>조회수</b>
							</center></font></TD>

				</TR>

<?php
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');



$rquery = "select * from board";
$data = mysqli_query($mysqli, $rquery);
$total_rows = mysqli_num_rows($data);

if ($total_rows % 5 == 0) {
    $allpage = $total_rows / 5;
} else {
    $allpage = $total_rows / 5 + 1;
    $allpage = (int) $allpage;
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {

    $page = 1;
}

$page = $allpage - $page + 1;
$s = $page * 5;
$ss = $total_rows % 5;
$ss = (int) $ss;
if ($ss != 0) {
    $ss = 5 - $ss;
}

$start = $s - $ss;

$last = $start - 5;
if (! isset($_GET['find'])) {

    $t = "x";
} else {
    $t = "o";
}

if ($t == 'x')
    $query = "select * from board where num>$last and num<=$start order by num desc";
else {
    $find = $_GET['find'];
    $search = $_GET['search'];

    $query = "select * from board where $find like '%$search%' order by num desc";
}

$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    $n = (int) $row['num'];
    $plquery = "select * from plus_id where list_num=$n";
    $pldata = mysqli_query($mysqli, $plquery);
    $pltotal_rows = mysqli_num_rows($pldata);

    $fquery = "select * from file where list_num=$n";
    $fdata = mysqli_query($mysqli, $fquery);
    $ftotal_rows = mysqli_num_rows($fdata);
    
    
    
    if ($pltotal_rows != 0) {

        ?>

      <TR bgcolor='ededed'>

					<TD align=center><font size=2 color='black'><?php echo $row['num'];?></font></TD>

					<TD align=center><a href="view.php?num=<?php echo $row['num'];?>"><font
							size=2 color="black"><?php echo $row['title'];?><?php

        if ($ftotal_rows != 0) {
            ?>&nbsp;<img src='img/save.png'><?php } ?> [<?php echo $pltotal_rows;?>]</font></a></TD>
					<TD align=center><font size=2 color="black"><?php echo $row['id'];?></font>
					</TD>
					<TD align=center><font size=2><?php echo $row['date'];?></font></TD>
					<td align=center><font size=2><?php echo $row['hit'];?></font></td>

				</TR>

<?php
    } else {

        ?>
        
 <TR bgcolor='ededed'>

					<TD align=center><font size=2 color='black'><?php echo $row['num'];?></font></TD>

					<TD align=center><a href="view.php?num=<?php echo $row['num'];?>"><font
							size=2 color="black"><?php echo $row['title'];?><?php if($ftotal_rows !=0){?>&nbsp;<img
								src='img/save.png'><?php } ?></font></a></TD>
					<TD align=center><font size=2 color="black"><?php echo $row['id'];?></font>
					</TD>
					<TD align=center><font size=2><?php echo $row['date'];?></font></TD>
					<td align=center><font size=2><?php echo $row['hit'];?></font></td>

				</TR>

<?php
    }
}
?>
</table>

		</div>

		<div class="allbutton">
			<div class="page3">
<?php

if ($total_rows % 5 == 0) {
    $total_rows = $total_rows / 5;
    for ($i = 1; $i <= $total_rows; $i ++) {

        echo "<a href = main.php?page=$i>$i&nbsp;&nbsp";
    }
    
    
    
    
} else {
    $total_rows = $total_rows / 5 + 1;
    $total_rows = (int) $total_rows;
    for ($i = 1; $i <= $total_rows; $i ++) {
        echo "<a href = main.php?page=$i>$i&nbsp;&nbsp";
        
        

    }
}

$mysqli->close();

?>

	</div>
			<div class="page2"></div>
		</div>
	</div>
</body>
</html>
