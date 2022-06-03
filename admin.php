<?php session_start();
require 'programming/config/config.php';
require 'programming/class/database.php';
require 'programming/config/config.php';
require 'programming/class/store_excel_data.php';
				 	


$db=new database($config);
if(!$_SESSION['login']==$db->selectStar("user")[0]['field1']){// if admin is not login 
	header('location:index.php'); //then go to the index page
	die();
}
$msg="";
if(isset($_GET['msg'])){
$msg=$_GET['msg'];	
}

$selectStarArr=array();
$data=$db->selectStar('year order by id desc');
foreach ($data as $key => $value) {
	array_push($selectStarArr, $value['year']);	
}
$selectResult="<option name=''>Please Select</option>";
foreach ($selectStarArr as $key => $value) {
	$selectResult.="<option name='$value'>$value</option>";
	
}
if($selectResult=="<option name=''>Please Select</option>"){
	$selectResult="<option >Nothing On Database</option>";

}
$selectYear="<option name=''>Please Select</option>";
$currYear=date('Y')+1;
for ($i=0; $i < 6; $i++) { 
	$year=$currYear;
	$year2=$year-1;
	$str="$year2-$year";
	$selectYear.= "<option name='$str'>$str</option>";	
	$currYear--;
}

$checkboxs="";
foreach ($config['class'] as $key => $value) {
	$checkboxs.="<input type='checkbox' name='$key'>$key</input>";
}
$delMsg="";
$postMsg="<ul>";
if($_SERVER["REQUEST_METHOD"]==="POST"){
	if(@$_POST['delete']){//if admin want to delete Result
		if(base64_decode($db->selectStar("user")[0]['field2'])==trim($_POST['delPasscode'])){
			if($_POST['selectResult']!="Please Select"){
				$delResult=$_POST['selectResult'];
				$data=$db->get('year',"year='$delResult'");
				$teamDb=$data[0]['id']."team";
				$allTables=$db->selectStar($teamDb);
				
				foreach ($allTables as $key => $value) {

					$db->query("drop table ".$value['tablesName']);

				 }
				 $db->query("drop table $teamDb");
				 $db->delete('year',"year='$delResult'");
				 $data=$db->selectStar("year");
				 $id=end($data)['id'];
				 $db->update('year',"lastest='true'","id='$id'");

				header("location:logout.php");

			}else{
				$delMsg="Please Select A Result";
			}
			

		}else{
			$delMsg="Your Passcode is Incorrect";
		}
				
	}
	$id="100";

	if(@$_POST['post']){ //if admin want to post result
		if(base64_decode($db->selectStar("user")[0]['field2'])==trim($_POST['password'])){
			if($_POST['year']=="Please Select" or $_POST['period']=="Please Choice"){
				$postMsg.="<li>Please Complete Require Informations</li>";
			}else{
				 //get new id value if there is datas //else default is 100
				 	if(is_array($db->selectStar("year")[0])){
				 		$data=$db->selectStar("year");
						$id=end($data)['id']+1;
				 	}
				 	
				
				

				$selectedBoxArr=array(); //getting all checked boxs values;
				foreach ($_POST as $key => $value) {
					if($value=="on"){
						array_push($selectedBoxArr,$key);

					}
				}
				if(count($selectedBoxArr)==0){
					$postMsg.="<li>No Check box Selected</li>";
				}else{
					if($_FILES['excel']['name']!=""){
						$type=$_FILES['excel']['type'];
						
						if($type=="application/vnd.ms-excel"){
							if($_FILES['excel']['error']==""){
								// Now Every Thing Is Correct Run Script Here
								$strData=$_POST['year']."|".$_POST['period'];
				// final thing	
								move_uploaded_file($_FILES['excel']['tmp_name'],"file/".$_FILES['excel']['name']);			
								$admin=new storeExcelData("file/".$_FILES['excel']['name'],$id,$db);
								
								$admin->getsheetsInArray(); //get All Excel Sheets
								if($admin->checkSheetName($selectedBoxArr)){
									$isTrue=$admin->storeSheetsToDatabase();
									unlink("file/".$_FILES['excel']['name']);
									if($isTrue){ //everything is perfect Then Store in year table
										if(isset($_POST['lastest'])){ //with lastest is  check
											if(is_array($db->get("year","lastest='true'")[0])){ 
												$db->update('year',"lastest='false'","lastest='true'");
										}	
										$db->insert('year',"'$id','$strData','true'");
										header("location:logout.php");
										}else{
											if(is_array($db->get("year","lastest='true'")[0])){ 
												$db->insert('year',"'$id','$strData','false'");
												header("location:logout.php");

											}else{
												$db->insert('year',"'$id','$strData','true'");
												header("location:logout.php");

											}
											
											
										}
													

									}else{
										$postMsg.="<li>Error in Store Data To Database </li>";
									}

								}else{
									$postMsg.="<li> Your Excel Sheets Name and Check Boxes Doesn't match</li>";
								}

							}else{
								$postMsg.="<li>Error In Uploading File :Try Again</li>";
							}




						}else{
							$postMsg.="<li>Please Select Microsoft Excel 97-2003 File (.xls)</li>";
						}

					}else{
						$postMsg.="<li>No Excel File Selected</li>";
					}
				}
				// var_dump($selectedBoxArr); is correct

			}//end else
			
			


		}else{
			$postMsg.="<li>Your Passcode is Incorrect</li>";
		}

	}
	

}
$postMsg.="</ul>";


require 'view/admin.view.php';

?>
