<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>CU(Mdy) | Change Passcode</title>
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<section id="topbar">
			<h3>Please Change Password </h3>	
			<a href="admin.php">		
			<div id="adminBtn">Admin</div>	
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
					<form name="login" action="change_pwd.php"  method="post" id="login">
					<tr>
					<td><label for="pwd">Current Passcode :</label><td><input type="password" name="pwd"  id="pwd" >
					</tr>
					<tr>
					<td><label for="password">New Password :</label><td><input type="password" name="password" id="password">
					</tr>
					<tr>
					<td><label for="rePassword">Again Password :</label><td><input type="password" name="rePassword" id="rePassword">
					</tr>
					<tr>
					<td colspan="2" ><input type="submit" name="change" value="Change">
					</tr>
					</form>
				</table>
				
				<label id="message"><?=$msg ?> </label><br>	
				<label id="link"><a href="admin.php">Back</a> </label>			
			</div>
			

		</main>
		
		
			


			<?php require 'view/footer.view.php' ?>


</body>



</html>