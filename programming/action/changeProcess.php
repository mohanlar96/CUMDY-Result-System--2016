<?php session_start();
require '../config/config.php'; 
require '../class/database.php';
require '../function/functions.php';
require '../config/config.php';
$db=new Database($config);
$str=$_POST['year'].'|'.$_POST['period'];
$data=$db->get("year","year='$str'");
$id=$data[0]['id'];
$_SESSION['id']=$id;
$tableName=$id."team";
$data=$db->selectStar($tableName);
echo getDisplayTablesStr($data,$db);

// Start for Menu changed  First year |Second Year
$tables=$db->selectStar($id.'team');
$year= array();
foreach ($tables as $key => $value) {
array_push($year, trim(end(explode('_', $value["tablesName"]))));
}
$class=array_unique($year);
$menuTitleArr=array(); //for First Year, Second Year
foreach ($config["class"] as $key1 => $value1) { // $config["class"] is from config.php
	foreach ($class as $key => $value) {
		if($key1==$value){
			array_push($menuTitleArr, $value1);
		}
	}
	
}
$menuTitleArr=array_unique($menuTitleArr);
// var_dump($menuTitleArr);
$menuTitleList="";
if($menuTitleArr[0]!=""){
	$menuTitleList.="<li data-no='1' id='$menuTitleArr[0]' class='clicked' calss='menuHover'>$menuTitleArr[0]</li>";
	array_shift($menuTitleArr); //delete index 0
	foreach ($menuTitleArr as $key=>$value) {
		$key+=2;
	$menuTitleList.="<li id='$value' data-no='$key' class='menuHover'>$value</li>";
}

}else{
	$menuTitleList="<li>I Can't Find Data On Database</li>";
}
echo "MOHANWaglu".$menuTitleList;
// End for Menu changed  First year |Second Year




	
	
	


?>