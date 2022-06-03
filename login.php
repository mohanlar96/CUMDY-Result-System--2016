<?php session_start();

require 'programming/class/database.php';
require 'programming/config/config.php';
$db=new Database($config);


$login="";
if(isset($_SESSION['login'])){
	$login=$_SESSION['login'];
}

if($login==$db->selectStar("user")[0]['field1']){// if admin is not login 
	header('location:index.php'); //then go to the index page
	die();
}


$msg=" ";
if($_SERVER["REQUEST_METHOD"]==="POST"){
	$username=$_POST['username'];
	$password=$_POST['password'];

	$data=$db->selectStar("user");
	$dbUsername=base64_decode($data[0]['field1']);
	$dbPasscode=base64_decode($data[0]['field2']);
	
	
	if($dbUsername==$username&&$dbPasscode==$password){
		$login=$data[0]['field1']; //if($_SESSION['login']==$db->selectStar("user")[0]['field1']) then user is logLin ..
		$_SESSION['login']= $db->selectStar("user")[0]['field1'];
		header("Location:admin.php");

	}else{
		$msg="Incorrect Information ...";
	}
	
}


require 'view/login.view.php';
 ?>





