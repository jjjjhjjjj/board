<?php
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    if ($id != 'admin') {
        echo ("
           <script>
             window.alert('권한이 없습니다.')
             location.href ='main.php'
           </script>
         ");
    }
} else {
    echo ("
           <script>
             window.alert('권한이 없습니다.')
             location.href ='main.php'
           </script>
         ");
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="allcss/allcss.css">

</head>
<body>
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>
		<div class="title2-1" onclick="location.href='admin.php'">회원관리</div>
		<div class="meno4">

			<div class="leftbutton3">
				<TABLE>
					<TR>
						<TD align='center'>

							<FORM Name='Form' Method='get' Action='admin.php?'>
								<TABLE>

									<TR>
										<td>
											<div>
												<input type='hidden' name='find' value='1'>
											</div>
										</td>
										<TD align='right'><select name='find'
											style="background-color: cccccc;">
												<option value='id' selected>아이디</option>
												<option value='name'>이름</option>
												<option value='nick'>닉네임</option>
										</select></TD>
										<TD align='left'><input type='text' name='search' size='20'
											maxlength='30'> <input type='submit' value='검색'
											onclick='return check_input();'></td>
									</TR>
								</TABLE>
							</FORM>

						</TD>

					</TR>
				</TABLE>

			</div>


			<TABLE style="width: 750px; text-align: center;">
				<TR>
					<TD></TD>
				</TR>
				<TR bgcolor='cccccc'>
					<TD><font size=2> <b>번호</b>
					</font></TD>
					<TD><font size=2> <b>id</b>
					</font></TD>
					
					<TD><font size=2> <b>name</b>
					</font></TD>
					<TD><font size=2> <b>nick</b>
					</font></TD>
					<TD><font size=2> <b>hp</b>
					</font></TD>
					<TD><font size=2> <b>addr</b>
					</font></TD>
					<TD><font size=2> <b>roadaddr</b>
					</font></TD>
					<TD><font size=2> <b>jibunaddr</b>
					</font></TD>
					<TD><font size=2> <b>plusaddr</b>
					</font></TD>
					<TD><font size=2> <b>day</b>
					</font></TD>

				</TR>
				<?php

    // mysql

    $mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $mysqli->set_charset('utf-8');

    $rquery = "select * from member";
    $data = mysqli_query($mysqli, $rquery);
    $total_rows = mysqli_num_rows($data);

    if ($total_rows % 10 == 0) {
        $allpage = $total_rows / 10;
    } else {
        $allpage = $total_rows / 10 + 1;
        $allpage = (int) $allpage;
    }
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {

        $page = 1;
    }

    $page = $allpage - $page + 1;
    $s = $page * 10;
    $ss = $total_rows % 10;
    $ss = (int) $ss;
    if ($ss != 0) {
        $ss = 10 - $ss;
    }
    
    $start = $s - $ss;
    
    $last = $start - 10;

    if (! isset($_GET['find'])) {

        $t = "x";
    } else {
        $t = "o";
    }

    if ($t == 'x')
        $query = "select * from member where num>$last and num<=$start order by num desc";
    else {
        $find = $_GET['find'];
        $search = $_GET['search'];

        $query = "select * from member where $find like '%$search%' ";
    }

    $result = $mysqli->query($query);

    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {

        ?>
				
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


<?php
    }

    ?>
			</table>



		</div>


		<div class="allbutton">
			<div class="page3">
<?php

if ($total_rows % 10 == 0) {
    $total_rows = $total_rows / 10;
    for ($i = 1; $i <= $total_rows; $i ++) {

        echo "<a href = admin.php?page=$i>$i&nbsp;&nbsp";
    }
} else {
    $total_rows = $total_rows / 10 + 1;
    $total_rows = (int) $total_rows;
    for ($i = 1; $i <= $total_rows; $i ++) {
        echo "<a href = admin.php?page=$i>$i&nbsp;&nbsp";
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




