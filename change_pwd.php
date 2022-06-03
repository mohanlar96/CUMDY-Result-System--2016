<?php session_start();
require 'programming/config/config.php';
require 'programming/class/database.php';
$db=new database($config);

if(!$_SESSION['login']==$db->selectStar("user")[0]['field1']){// if admin is not login 
	header('location:index.php'); //then go to the index page
	die();
}
$msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
		$oldPwd=base64_decode(trim($db->selectStar("user")[0]['field2']));
	if(trim($_POST['password'])==trim($_POST['rePassword'])){
		if($oldPwd==trim($_POST['pwd'])){
			$newPwd=base64_encode($_POST['password']);
			$oldPwdDb=$db->selectStar("user")[0]['field2'];
			$set="field2='$newPwd'";
			$where="field2='$oldPwdDb'";
			$db->update('user',"$set","$where");
			header("location:admin.php?msg=Your password has been change");
		}else{
			$msg="Your Old Password Doesn't match";
		}

	}else {
		$msg="Your New Password Doesn't match";
	}

}







require 'view/change_pwd.view.php';
 ?>





