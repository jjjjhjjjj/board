<?php
session_start();
$num = $_GET['num'];

$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from member where num = $num";

$result = $mysqli->query($query);

$row = $result->fetch_assoc();

$id = $row['id'];

?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="allcss/allcss.css">
<script type="text/javascript">
function delete_click()
{
var check = confirm("삭제하시겠습니까");
if(!check) {
	return false;
}

}

function modify_click()
{
var check = confirm("수정하시겠습니까");
if(!check)
{return false;
	}
}


</script>
</head>
<body>
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>
		<div class="title2">ID : <?php echo $id; ?></div>
		<div class="meno4">
			<div class="id">[회원정보]</div>
			<TABLE style="width: 750px;">
				<TR>
					<TD></TD>
				</TR>
				<TR bgcolor='cccccc' style="text-align: center; font-size: 11px;">

					<TD><font size=2> <b>번호</b></font></TD>
					<TD><font size=2> <b>id</b></font></TD>
					<TD><font size=2> <b>name</b></font></TD>
					<TD><font size=2> <b>nick</b></font></TD>
					<TD><font size=2> <b>hp</b></font></TD>
					<TD><font size=2> <b>addr</b></font></TD>
					<TD><font size=2> <b>roadaddr</b></font></TD>
					<TD><font size=2> <b>jibunaddr</b></font></TD>
					<TD><font size=2> <b>plusaddr</b></font></TD>
					<TD><font size=2> <b>day</b></font></TD>
	

				</TR>


				<TR bgcolor='ededed'>

					<TD align=center><font size=1 color='black'><?php echo $row['num'];?></font></TD>

					<TD align=center><a
						href="admin_member.php?num=<?php echo $row['num'];?>"><font size=1
							color="black"><?php echo $row['id'];?></font></a></TD>
					<TD align=center><font size=1 color="black"><?php echo $row['name'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['nick'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['hp'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['addr'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['roadaddr'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['jibunaddr'];?></font>
					</TD>
					<TD align=center><font size=1 color="black"><?php echo $row['plusaddr'];?></font>
					</TD>


					<TD align=center><font size=2><?php echo $row['day'];?></font></TD>

				</TR>

			</table>
			<div class="adminbtn">


				<div class="adminbtn_l">
					<form method="post" action="member_modi.php">
						<input type=hidden name='id' value=<?php echo $id;?>> <input
							type="submit" value="수정" onclick="return modify_click(); ">
					</form>
				</div>


				<div class="adminbtn_r">
					<form method="post" action="member_del.php">
						<input type=hidden name='id' value=<?php echo $id;?>> <input
							type="submit" value="삭제" onclick="return delete_click(); ">

					</form>

				</div>

			</div>

			<div class="id2">[글 목록]</div>



			<TABLE style="width: 750px;">
				<TR>
					<TD></TD>
				</TR>
				<TR bgcolor='cccccc' style="text-align: center;">
					<TD width="50px;"><font size=2> <b>번호</b>
					</font></TD>
					<TD width="300px;"><font size=2> <b>제목</b>
					</font></TD>
					<TD width="100px;"><font size=2> <b>작성자</b>
					</font></TD>
					<TD width="200px;"><font size=2> <b>작성일</b>
					</font></TD>
					<TD width="50px;"><font size=2> <b>조회수</b>
					</font></TD>

				</TR>

<?php

$rquery = "select * from board where id = '$id'";

$rresult = $mysqli->query($rquery);

while ($rrow = $rresult->fetch_assoc()) {

    $n = (int) $rrow['num'];
    $plquery = "select * from plus_id where list_num=$n";
    $pldata = mysqli_query($mysqli, $plquery);
    $pltotal_rows = mysqli_num_rows($pldata);

    $fquery = "select * from file where list_num=$n";
    $fdata = mysqli_query($mysqli, $fquery);
    $ftotal_rows = mysqli_num_rows($fdata);

    if ($pltotal_rows != 0) {
        ?>


      <TR bgcolor='ededed'>

					<TD align=center><font size=2 color='black'><?php echo $rrow['num'];?></font></TD>

					<TD align=center><a href="view.php?num=<?php echo $rrow['num'];?>"><font
							size=2 color="black"><?php echo $rrow['title'];?><?php

        if ($ftotal_rows != 0) {
            ?>&nbsp;<img src='img/save.png'><?php } ?> [<?php echo $pltotal_rows;?>]</font></a></TD>
					<TD align=center><font size=2 color="black"><?php echo $rrow['id'];?></font>
					</TD>
					<TD align=center><font size=2><?php echo $rrow['date'];?></font></TD>
					<td align=center><font size=2><?php echo $rrow['hit'];?></font></td>

				</TR>
		
<?php
    } else {

        ?>
 <TR bgcolor='ededed'>

					<TD align=center><font size=2 color='black'><?php echo $rrow['num'];?></font></TD>

					<TD align=center><a href="view.php?num=<?php echo $rrow['num'];?>"><font
							size=2 color="black"><?php echo $rrow['title'];?><?php if($ftotal_rows !=0){?>&nbsp;<img
								src='img/save.png'><?php } ?></font></a></TD>
					<TD align=center><font size=2 color="black"><?php echo $rrow['id'];?></font>
					</TD>
					<TD align=center><font size=2><?php echo $rrow['date'];?></font></TD>
					<td align=center><font size=2><?php echo $rrow['hit'];?></font></td>
				</TR>

<?php
    }
}
?>
</table>

			<div class="id2">[댓글 목록]</div>


			<TABLE>
			
			<?php

$ppquery = "select * from plus_id where id = '$id' order by num desc";

$ppresult = $mysqli->query($ppquery);

while ($pprow = $ppresult->fetch_assoc()) {

    ?>

			 <TR bgcolor='ededed'>

					<TD align=center width='100px'><font size=2 color="black"><?php echo $pprow['name'];?></font></TD>
					<TD align=center width='300px'><font size=2 color="black"><?php echo $pprow['comment'];?></font></TD>
					<TD align=center width='150px'><font size=2><?php echo $pprow['day'];?></font></TD>

					<?php if($id == $pprow['id']){?>
					
						<TD width=><input type="button" value="x"
						onclick="location.href='plus_delete.php?num=<?php echo $pprow['num']?>&adminpage=<?php echo $num?>'"></TD>


				</TR>
				<?php
    }
}

$result->free();
$mysqli->close();

?>


</TABLE>

		</div>
	</div>

</body>
</html>




