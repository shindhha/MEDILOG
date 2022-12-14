<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php  ?>
	<form method="post" action="index.php">
		

		<input type="text" name="login">
		<input type="password" name="password">
		<input type="hidden" name="action" value="connexion">
		<input type="submit" value="Entrer">
	</form>
</body>
</html>