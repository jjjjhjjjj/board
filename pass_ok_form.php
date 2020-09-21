<?php
session_start();
$admincheck = $_SESSION['id'];

if (isset($_POST['number'])) {
    $number = $_POST['number'];
} else {
    
    $number = $_GET['number'];
}

if($admincheck =='admin'){
    echo "
	   <script>
	    location.href = 'delete.php?num=$number';
	   </script>
	";
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>realboard</title>
<link rel="stylesheet" href="allcss/allcss.css">

</head>
<body>
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>
		<div class="title2">비밀번호 확인</div>
		<div class="table4">

		
		<form id="decheck" method="post" action="delete_pw_en.php">
				<input type=hidden name='number' value=<?php echo $number;?>>
				<div class="passok">

					<table>
						<tr>
							<TD width="80px;" bgcolor='cccccc'><font size=2><center>
										<b>비밀번호</b>
									</center></font></TD>
							<TD><font size=2><center>
										<input type='password' name='userpass' size=15></font></TD>
							</center>
							<td><input type="submit" value="확인"
								style="font-size: 15px; height: 30px;"></td>

						</tr>

					</table>

				</div>
			</form>

		</div>

	</div>

</body>
</html>
