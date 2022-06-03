<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>CU(Mdy) | Log In</title>
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<section id="topbar">
			<h3>Please Log In </h3>	
			<a href="index.php">		
			<div id="adminBtn">Back</div>	
			</a>				
	</section>
	<section id="container">		
		<header>		
			<figure id="logo">
				<img src="img/logo1.png" alt="Computer University (Mandalay)">
			</figure>
		</header>
		<main>
			<div class="login">
				<table>
					<form name="login" action="login.php" id="login" method="post">
					<tr>
					<td><label for="username">Username :</label><td><input type="text" name="username"  id="username" placeholder="someone@someone.com">
					</tr>
					<tr>
					<td><label for="password">Password :</label><td><input type="password" name="password" id="password">
					</tr>
					<tr>
					<td colspan="2" ><input type="submit" name="login" value="Login"/>
					</tr>
					</form>
				</table>
				
				<label id="message"><?=$msg ?> </label><br>	
				<label id="link"><a href="index.php">Back</a> </label>			
			</div>
			

		</main>
		
		
			


			<?php require 'view/footer.view.php' ?>


</body>



</html>