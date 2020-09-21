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
		<div class="title" onclick="location.href='index.php'">LISTBOARD</div>
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
		<div class="table5"></div>
	</div>
	</div>
</body>
</html>
