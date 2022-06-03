<?php
// function displayTable($table){ //get a database table
// 	$display="<table><tr>";
// 	// var_dump($table);
// 	$titleArr=array();
// 	foreach ($table as $rowNum => $arr) { 	
// 		foreach ($arr as $title => $value) {
// 				$display.="<th>$title</th>";
// 				array_push($titleArr, $title);// get Titles of table	
// 				}	
// 				break;
// 	}
// 	$display.="</tr>";
// 	foreach ($table as $rowNum => $arr) { 	
// 		$display.="<tr>";
// 		foreach ($arr as $title => $value) {
// 				$display.="<td>$value</td>";
					
// 				}	
// 		$display.="</tr>";
				
// 	}
// 	$display.="</table>";
// 	 echo "$display <br>";
// }
function displayTable($table){ //get a database table

	$display="<div class='table'>
		<div class='header'>";
	// var_dump($table);
	$titleArr=array();

	foreach ( @ $table as $rowNum => $arr) { 	
		foreach (@ $arr as $title => $value) {
				$display.="<span>$title</span>";
				array_push($titleArr, $title);// get Titles of table	
				}	
				break;
	}
	$display.="</div><div class='scroll'>
			";
	foreach ( @ $table as $rowNum => $arr) { 	
		$display.="<div class='cell'>";
		foreach (@ $arr as $title => $value) {
				$display.="<span>$value</span>";
					
				}	
		$display.="</div>";
				
	}
	$display.="</div></div>";
	return $display;
}

function getDisplayTablesStr ($yearTableData,$db){//$yearTableData=$db->getStar() from $id_Team
	//this function is used in index.view.php to get all result tables from database Only
	//Using displayTable() function to display it... 
			$str="<section id='searchTable' style='display: none;'></section>";
			$allTablesData=array(); //7tables data
			if(is_array($yearTableData)){


			foreach ($yearTableData as $key=>$value) { 
	   	  		$allTablesData[$key]=$db->selectStar($value["tablesName"]);
			}

			foreach ($allTablesData as $key => $value) {
				$tableClass=end(explode('_', $yearTableData[$key]['tablesName']));

			if($key=="0"){
				$str.= "<section style='display:block;' id='currTable' class=\"$tableClass table$key\" />";
				$str.=displayTable($allTablesData[$key]);
				$str.= "</section>";	
			}else{
				$str.= "<section style='display:none;' class=\"$tableClass table$key\" />";
				$str.=displayTable($allTablesData[$key]);
				$str.="</section>";				
				}
			}
			return $str;
		} //end isArray
	}//end function
?>