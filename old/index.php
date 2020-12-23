<!DOCTYPE html>
<html>
<head>
	<?php include("head.php"); ?>
	<title>登入</title>
</head>
<body class="login">
<div class="text-center box">
	<h1>登入</h1>
	<br>
	<form action="login.php" method="POST">
	<label for="account">帳號:</label>
	<input type="text" name="account" id="account">
	<label for="password">密碼:</label>
	<input type="password" name="password" id="password">
	<br>
	<input type="submit" class="btn" value="登入">
	</form>
</div>
</body>
</html>