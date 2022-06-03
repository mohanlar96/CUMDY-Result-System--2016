<?php 
/***********Require excel_reader.php***************/
require 'excel_reader.php';

class storeExcelData {
	private $fileName;
	private $id;
	private $db;
	private $excel;
	private $sheetsInArray;
	
   function __construct($fileName,$id,$db){
   	$this->fileName=$fileName;
   	$this->id=$id;   	
   	$this->db= $db;   	
   	$this->excel = new PhpExcelReader;
   	$this->excel->setOutputEncoding('UTF-8');
	$this->excel->read($this->fileName);
	
   }

   function getsheetsInArray(){

		$sheetsInArray=array(); 

		
		$totalSheet=count($this->excel->sheets);
		for ($i=0; $i <$totalSheet ; $i++) {
			array_push($sheetsInArray, trim($this->excel->boundsheets[$i]['name']));

		}
		 $this->sheetsInArray=$sheetsInArray;
		return $sheetsInArray;
	}

	function checkSheetName($checkSheetsArr){

		foreach ($this->sheetsInArray as $key=> $value) {
			if(trim($this->sheetsInArray[$key])!=trim(@$checkSheetsArr[$key])){			
				return false;
				break;

		}		
			}//end foreach
			return true;
	}
	function storeSheetsToDatabase(){
		$isError=0;
		$queryArr=array(); //for getting all create tables... query for create table
		$tableNameArr=array(); //for getting all tables name from excel
		$values=array(); //for getting all data values from excel

		foreach ($this->excel->sheets as $key => $value) { //get first sheets 		
			$sheetName=$this->excel->boundsheets[$key]['name'];//get sheet name
			$rows=$this->excel->sheets[$key]['numRows']; //get first sheets rows
			$cols=$this->excel->sheets[$key]['numCols']; //get first sheets cols
			$tableName="{$this->id}_$sheetName";
			$query="create table $tableName (";
			$isRollno=0;
			for ($i=1 ; $i<=$cols; $i++){	 //for first row (table header)
			$field="";				
			
			if(trim($this->excel->sheets[$key]['cells']['1'][$i])){
				 $field.=trim($this->excel->sheets[$key]['cells']['1'][$i]);	
				 	
				}else{$isError=1;
		$alphabet=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				die("<h4 style='color:red;'><i>Error : Something Wrong in your Excel File! <u>The Data in Cell 1 {$alphabet[$i-1]} cant not catch . Please delete Entire data column about that cell or add some  text data on it. </u> Incorrect table with \" $sheetName\" Sheet.</i></h4>") ; 
				}//end if
				
				
				if(strtolower($field)=="roll no" or strtolower($field)=="roll-no" or   strtolower($field)=="roll_no" or strtolower($field)=="rollno" or strtolower($field)=="roll.no" or strtolower($field)=="roll:no" ) {
					$field="Rollno";	
					$isRollno=1;	
								
				}

				if($cols==$i){//if last loop
					$query.="$field varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci);";
				}else{
					$query.="$field varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,";
				}
				

			}//end for loop
			if(!$isRollno){
				$isError=1;
				die("<h4 style='color:red;'><i>Incorrect table with \" $sheetName\" Sheet (page)<u> Error in excel file :No Roll-no on your table title</u></i>");
			}
			// $db->query($query);
			array_push($tableNameArr, $tableName);
			array_push($queryArr, $query);
			

		}//end for each


		foreach ($this->excel->sheets as $key => $value) { //get first sheets 

			$rows=$this->excel->sheets[$key]['numRows']; //get first sheets rows
			$cols=$this->excel->sheets[$key]['numCols']; //get first sheets cols
			$str="";			
			$x = 2;
			  	while($x <= $rows) {
			    $y = 1;
			    while($y <= $cols) {
			    	if(isset($this->excel->sheets[$key]['cells'][$x][$y])){
			    	 $cell =  $this->excel->sheets[$key]['cells'][$x][$y];

			    	}else{
			    		$cell=" ";
			    	}
			      			      
			      if($cols!=$y){
			      	$str.="\"".$cell."\",";
			      }else{
			      	$str.="\"".$cell."\"";
			      }
			      	
			      $y++;			      
			    }			  			     
			    $j=$x-2; 
			    $values[$key][$j]=$str; 
			    $str=""	;    
				$x++;
			  }
					
		
	}//end foreach



		
		// var_dump($queryArr[]); // all query 

		if(!$isError){//if no error
			$teamTableDb=$this->id."team";
			$this->db->query("create table $teamTableDb (no int, tablesName varchar(15))");
			foreach ($this->sheetsInArray as $key => $teamTable) {
				$no=$key+1;
				$tablesNameDb=$this->id."_".$teamTable;
				$this->db->insert("$teamTableDb","'$no','$tablesNameDb'");

			}
			foreach ($queryArr as $key => $tables) {
				
				$this->db->query("$tables"); //Creating tables on databases		
			
						
			}
		}


		/*starting inserting datas from excel file*/		

		// var_dump($tableNameArr);	// all tables 
		// var_dump($values);       //get all datas from excel
		set_time_limit(300);
		foreach ($tableNameArr as $key => $table) {
			$size=count($values[$key]);
			for($i=0;$i<$size;$i++){
				$this->db->insert($table,$values[$key][$i]);
							


			}
		}
		
	

			
		
		/*ending inserting datas from excel file*/
												
		
	return ($isError)?false:true;
	}



}//end class	
	
	// Admin total 3 process file to store excel file to database

	// $admin=new storeExcelData("test.xls","101",$db);

	// var_dump($admin->getsheetsInArray()); //process one to admin upload

	// echo "<br>".$admin->checkSheetName($admin->getsheetsInArray()) ."<br>"; // porcess 2 to admin upload

	// $admin->storeSheetsToDatabase();//process 3 to upload


		
 
		



	
?>
