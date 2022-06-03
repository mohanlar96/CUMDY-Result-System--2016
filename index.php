<?php session_start();
require 'programming/config/config.php';
require 'programming/class/database.php';
require 'programming/function/functions.php';
$db=new Database($config); //$config is from config.php
if(!$db->is_exist("user")){//if user tabe is , then create it and insert admin username and password
	$db->query("create table user (field1 varchar(60), field2 varchar(60))");
	$dbField1="bW9oYW5AY3VtZHkuY29t";
	$dbField2="YWRtaW5hZG1pbjEyMw==";
	$db->insert('user',"'$dbField1','$dbField2'");
}if(!$db->is_exist("year")){
	$db->query("create table year (id int, year varchar(35),lastest varchar(10),primary key(id))");	
}









$login="";
if(isset($_SESSION['login'])){
	$login=$_SESSION['login'];
}
if($login==$db->selectStar("user")[0]['field1']){// if admin is login 
	header('location:admin.php?msg=Please! Log-Out First'); //then go to admin page
	die();
}

$data=$db->selectStar("year");
$acedamicYear=array();
$period=array();
foreach ($data as $data) {
	 array_push($acedamicYear,explode("|",$data["year"])[0]);
	 array_push($period,end(explode("|",$data["year"])));  	
 } 
 $acedamicYear=array_unique($acedamicYear);
 $period=array_unique($period);
 // var_dump($acedamicYear[0]);
 // var_dump($period);
 $acedamicYearOptions="<option>No Data </option>"; 
 if(@$acedamicYear[0]!=""){
 	 $acedamicYearOptions="";
 	foreach ($acedamicYear as  $value) { 
 		$acedamicYearOptions .= "<option name='$value'>$value</option>";
 		 		
 	}
 }//end if 
 
 $periodOptions="<option>No Data</option>";
 if(!@$period[0]==""){
 	 $periodOptions="";
 	foreach ($period as $value) { 
 		$periodOptions.="<option name='$value'>$value</option>";
 	}
 }

$data=$db->get("year","lastest='true'"); 
@$selectPeriod=end(explode("|",$data[0]["year"])); // eg: Second Team to determine whether First Team or Second is selected
@$selectYear=explode("|",$data[0]["year"])[0];//eg: 2015-2016 current lastest Year 
$examTitle=""; //eg: 2015-2016 academic year exam result (first team)
$isError="false"; //if true <main> will be display none 
if($selectPeriod!=""||$selectYear!=""){	
	$examTitle= "$selectYear Academic Year Exam Result ($selectPeriod)";
}else{
	$isError="true";
	$examTitle="Exam Result Is not Still Availiable";
}
// start get First year , Second year, Third year, fouth year from db
if (isset($data[0]['id'])) {
	@$id=$data[0]['id'];  //getting display result id eg :100
	$tableName=$id."team";
	$data=$db->selectStar($tableName);//table name is 100team

}
	
unset($tableName);
$class=array(); //add from 1CST,2CS,... from database
if (is_array($data)) {
	foreach ($data as $value) {
	array_push($class,trim(end(explode("_",$value['tablesName']))));
		}
	
}

$class=array_unique($class);
// var_dump($class);
$menuTitleArr=array(); //for First Year, Second Year
foreach ($config["class"] as $key1 => $value1) { // $config["class"] is from config.php
	foreach ($class as $key => $value) {
		if($value==$key1){
			array_push($menuTitleArr, $value1);
		}
	}
	
}
$menuTitleArr=array_unique($menuTitleArr);
// var_dump($menuTitleArr);
$menuTitleList="";
if(@$menuTitleArr[0]!=""){
	$menuTitleList.="<li data-no='1' id='$menuTitleArr[0]' class='clicked' calss='menuHover'>$menuTitleArr[0]</li>";
	array_shift($menuTitleArr); //delete index 0
	foreach ($menuTitleArr as $key=>$value) {
		$key+=2;
	$menuTitleList.="<li id='$value' data-no='$key' class='menuHover'>$value</li>";
}

}else{
	$menuTitleList="<li>Nothing On Database </li>";
}

require 'view/index.view.php'; 	//required view of index
							 	//required view of index
// require 'programming/class/store_excel_data.php';

@$_SESSION['id']=$id;
?>

