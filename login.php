<?php
session_start();
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


		<div class="table6">

			<div class="title6">LOGIN</div>
			<form id="loginForm" name="loginForm" method="post"
				action="login_en.php" enctype="multipart/form-data">

				<div class="t">
					<TABLE border='0' width='650' cellpadding='2' cellspacing='2'>
						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>ID</b>
									</center></font></TD>
							<TD><input type='text' size='12' name='userid'></TD>
						</TR>

						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>PASS</b>
									</center></font></TD>
							<TD><input type='password' size='12' name='userpass'></TD>
						</TR>
					</TABLE>
					<div class="bb">
						<center>

							<input type="button" value="회원가입"
								onclick="location.href='member.php'"> <input type="submit"
								value="로그인">
						</center>
					</div>

				</div>
				<div class="b"></div>
			</form>

		</div>
		<div class="title2"></div>

	</div>

</body>
</html>
