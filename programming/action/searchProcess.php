<?php session_start(); 
require '../config/config.php'; 
require '../class/database.php';
require '../function/functions.php';
$id=$_SESSION['id'];

$search=$_POST['search'];
$db=new Database($config);

	
	if(trim(explode('-', $search)[0])){
		$str=trim(explode('-', $search)[0]);

	}elseif(trim(explode('_', $search)[0])){
		$str=trim(explode('_', $search)[0]);
	
	}elseif (trim(explode(' ', $search)[0])) {
		$str=trim(explode(' ', $search)[0]);
		
	}

	$tableName=$id."_".$str;

	if (trim(end(explode('-', $search)))) {
		$no=trim(end(explode('-', $search)));

	}elseif(trim(end(explode('_',$search)))) {
		$no=trim(end(explode('_',$search)));
	}elseif(trim(end(explode(' ',$search)))) {
		$no=trim(end(explode(' ',$search)));
	}


	
	
	$queryStr=$str.'-'.$no;
	$queryStr="Rollno LIKE '$queryStr%'";
	
	$data=$db->getLike($tableName,$queryStr);

	echo @ displayTable($data);

?>