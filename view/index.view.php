<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>CU(Mdy) | Exam Result</title>
	<link rel="stylesheet" type="text/css" href="file/font.css">
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<body>
	<section id="topbar">
			<h3>Welcome Friend! Good Luck</h3>	
			<a href="login.php">		
			<div id="adminBtn">LogIn</div>	
			</a>				
	</section>
	<section id="container">		
		<header>		
			<figure id="logo">
				<img src="img/logo1.png" alt="Computer University (Mandalay)">
			</figure>
		</header>
		<form id="firstForm" name="firstForm" action="programming/action/changeProcess.php" method="post">
			<section id="selectOption">			
				<fieldset >	
						<legend>Academic Year</legend>
						<select class="year" name="year">
							<?= $acedamicYearOptions?>	
						</select>					
				</fieldset>
				<fieldset>	
						<legend>Period</legend>
						<select class="period" name="period" >	
							<?= $periodOptions?>					
						</select>	
				</fieldset>				
			</section>	
		</form>	
		<h2 id="examTitle"><?=$examTitle?></h2>
		<main>
			<ul id="menu">
				<?=$menuTitleList?>
			</ul>
			<form method="post"  action="programming/action/goProcess.php" name="searchForm" id="searchForm">	
				<section id="selectOption">				
					<fieldset id="cst">	
								<legend>Search with CS/CT/CST</legend>
								<input type="radio" class="CST" value="CST" name="CST"/> <span style="color: red;">CST</span>
								<input type="radio" class="CST" value="CS" name="CST"/><span style="color: red; padding-left:5px;">CS</span>
								<input type="radio" class="CST" value="CT" name="CST"/><span style="color: red;padding-left:5px">CT</span>	
					</fieldset>	
					<fieldset id="search">	
								<legend>Search Rollno:</legend>
								<input type="text" placeholder="eg:1CST-100" class="search" name="search"/>
								<input type="submit"  id="searchBtn" name="search" value="Go"/>	
								<input type="button"  id="backBtn" name="search" value="Back"/>
					</fieldset>
				</section>				
			</form>
		<section id="tables">		 
		 <?= getDisplayTablesStr($data,$db);?> <!-- from functions.php -->
		 <label class="error"> No data availiable... </label>
		</section>
		</main>
		<?php require 'view/footer.view.php' ?>
</body>
<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="js/form.js"></script>
<script type="text/javascript" src="js/onChange.js"></script>

</html>