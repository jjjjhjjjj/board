<?php
session_start();
if (! isset($_SESSION['id'])) {
    echo ("
           <script>
             window.alert('로그인이 필요합니다.')
             history.go(-1)
           </script>
         ");
} else {
    $sid = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>realboard</title>
<link rel="stylesheet" href="allcss/allcss.css">

<script type="text/javascript" language="javascript">
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
		<div class="title2">글 보기</div>
		
<?php
$number = $_GET['num'];
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from board where num = $number";

$result = $mysqli->query($query);

$hquery = "update board set hit=hit+1 where num=$number";
$hresult = $mysqli->query($hquery);

$fquery = "select * from file where list_num=$number";
$fdata = mysqli_query($mysqli, $fquery);
$ftotal_rows = mysqli_num_rows($fdata);

while ($row = $result->fetch_assoc()) {

    ?>

 <div class="table2">
			<div class="menoform">
				<TABLE border='0' width='600'>
					<TR>
						<TD align='left'><font size='2'> 작성자 : <?php echo $row['id'];?></font></TD>

						<TD align=right><font size='2'>작성일 : <?php echo  $row['date'];?></font></TD>
					</TR>
					<tr>
						<td><font size='2'>조회수 : <?php echo $row['hit'];?></font></td>
					</tr>
				</TABLE>

				<TABLE border='0' cellspacing=3 cellpadding=3 width='600'>
					<TR bgcolor='cccccc'>
						<TD align='center'><font size='3'><b><?php echo $row['title'];?></font></TD>
					</TR>
				</TABLE>


<?php
    // if 첨부파일 존재

    if ($ftotal_rows != 0) {

        //
        $ffquery = "select * from file where list_num=$number";
        $ffdata = $mysqli->query($ffquery);

        while ($frow = $ffdata->fetch_assoc()) {

            ?>


	<TABLE border='0' cellspacing=3 cellpadding=3 width='600'>
					<TR bgcolor='cccccc'>
						<TD><font size='2'>첨부파일 : &nbsp;<a
								href='filedownload.php?file_id=<?php echo $frow['file_id'] ;?>'><?php echo $frow['file'];?></a></font></TD>
					</TR>
				</TABLE>

<?php
        }
    }

    ?>
				<TABLE border='0' cellspacing=5 cellpadding=10 width='600'
					height='210'>
					<TR bgcolor='ededed'>
						<TD><font size='2' color=''><?php echo $row['contents'];?></font></TD>
					</TR>
				</TABLE>

			</div>

		</div>

		<div class="allbutton">


			<form method="post" action="pass_ok_form.php">
				<input type=hidden name='number' value=<?php echo $number;?>>


				<div class="modifybutton">
						<?php if($sid == $row['id'] || $sid =='admin') { ?>
					<input type="submit" value="삭제"
						style="font-size: 15px; width: 90px; height: 30px;"
						onclick="return delete_click(); ">
						<?php } ?>
				</div>


			</form>


			<div class="rightbutton">
				<input type="submit" value="목록"
					style="font-size: 15px; width: 90px; height: 30px;"
					onclick="location.href='main.php'">
			</div>


			<form method="post" action="modi_pw_form.php">
				<input type=hidden name='number' value=<?php echo $number;?>>
				<div class="rightbutton">
				
						<?php if($sid == $row['id'] || $sid =='admin') { ?>
					<input type="submit" value="수정"
						style="font-size: 15px; width: 90px; height: 30px; margin-right: 10px;"
						onclick="return modify_click();">
						
						<?php } ?>
				</div>

			</form>			
<?php
}
?>
		<div class="title3">

				<form name="comokform" method="post" action="plus.php">
					<TABLE border='0' width='650'>
						<input type=hidden name='number' value=<?php echo $number;?>>

						<TR>
							<TD width="50px;" bgcolor='cccccc'><font size=2><center>
										<b>작성자</b>
									</center></font></TD>


							<TD width="200px;" bgcolor='cccccc'><font size=2><center>
										<b>댓글</b>
									</center></font></TD>
							<TD width="50px;"><font size=2><center></center></font></TD>

						</TR>

						<TR>

							<TD><font size=2><center>
										<input type='text' name='username' size=10></font></TD>
							</center>

							<TD><font size=2>
									<center>
										<input type='text' name='subject' size='50'>
							
							</font></TD>
							</center>

							<TD width="50px;"><font size=2><center>
										<input type="submit" value="입력" onclick="return login();" />
									</center></font></TD>
						</TR>
					</TABLE>
				</form>

				<TABLE border='0' cellspacing=1 cellpadding=2>
			
			<?php

$pquery = "select * from plus_id where list_num = $number order by num desc";

$result = $mysqli->query($pquery);

while ($row = $result->fetch_assoc()) {

    ?>

	 <TR bgcolor='ededed'>

						<TD align=center width='100px'><font size=2 color="black"><?php echo $row['name'];?></font></TD>
						<TD align=center width='300px'><font size=2 color="black"><?php echo $row['comment'];?></font></TD>
						<TD align=center width='150px'><font size=2><?php echo $row['day'];?></font></TD>

					<?php if($sid == $row['id']){?>
					
						<TD width=><input type="button" value="x"
							onclick="location.href='plus_delete.php?num=<?php echo $row['num']?>&gopage=<?php echo $number?>'"></TD>


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
	</div>
	</div>

</body>
</html>
