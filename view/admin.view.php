<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>CU(Mdy) | Exam Result</title>
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
	
		<link rel="stylesheet" type="text/css" href="css/admin.css"/>

</head>
<body>
	<section id="topbar">
			<h3>Admin Page ! Be Aware </h3>	
			<a href="change_pwd.php">		
			<div id="adminBtn">Password</div>	
			</a>	
			<a href="logout.php">		
			<div id="adminBtn">LogOut</div>	
			</a>			
	</section>
	<section id="container">		
		<header>		
			<figure id="logo">
				<img src="img/logo1.png" alt="Computer University (Mandalay)">
			</figure>
		</header>
		<div class="msg">
			<h3 style="color: red;"><?= $msg ?></h3>		
		</div>			
		<main>
		<form action="" method="post" id="delete" name="delete">
			<div class="delete">
				<h3 class="deletePost">Delete A Result</h3>
				<section class="deletePost">			
					<fieldset >	
							<legend>Selete Result</legend>
							<select id="year" class="year" name="selectResult">
								<?=$selectResult?>
								
							</select>					
					</fieldset>
					<fieldset>	
							<legend>Password</legend>
							<input type="password" id="delPasscode"	 name="delPasscode" >
							<input type="submit" name="delete" id='delSubmit'value="Delete"/>				
					</fieldset>									
				</section>

				<div class="delMsg"><?=$delMsg?> </div>
			</div>
		</form>
		<form action="#" enctype="multipart/form-data" method="post" name="create" id="create">
			<div class="create">
				<h3 class="createPost">Post A new Result</h3>
				<section class="createPost">
					<div id="flex">
						<fieldset >	
							<legend>Choice Year</legend>
							<select class="year" name="year">
							   <?= $selectYear ?>
							</select>					
						</fieldset>
						<fieldset>	
							<legend>Choice Period</legend>
							<select class="period" name="period" >	
								<option name="">Please Choice</option>
								<option name="First Semester">First Semester</option>	
								<option name="Second Semester">Second Semester</option>				
							</select>	
						</fieldset>
					</div>
					<div id="flex">
						<fieldset>
							<legend>Sort Excel Sheets as Order Lists and check</legend>
								<?=$checkboxs?>
						</fieldset>
					</div>
					<div id="flex">
						<fieldset>
							<legend>Do You Want To Display Default ?</legend>
							<input type="checkbox" name="lastest" value="true"> I Want Display Default When User Visit Our Page.
						</fieldset>
					</div>
					<div id="flex">
						<fieldset>
							<legend>Excel 97-2003 File (.xls)</legend>
								<input type="file" name="excel">
						</fieldset>
						<fieldset>
							<legend>Password</legend>
							<input type="password" name="password" >
							<input id="submit" type="submit" name="post" value="POST"/>						
						</fieldset>
					</div>
				</section>
				<div class="createMsg"><?= $postMsg ?></div>
			</div>
		</form>

		   
			
		</main>
		
		
			


			<?php 
			require 'view/footer.view.php' ?>
	


</body>
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
</html>