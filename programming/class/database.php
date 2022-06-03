<?php 
class Database{
	private $con;
	function __construct($config){
		try{
			$this->con=new PDO("mysql:host=".$config['host'].";dbname=".$config['dbname'],$config['username'],$config['password']);
			$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(Expection $e){
			echo "Cannot connect to the database $e <BR>";
		}//end catch


	} // end __construct

	function selectStar($dbname){

	try {
			$stat=$this->con->query("select * from $dbname");
		return $stat->fetchAll(PDO::FETCH_ASSOC); //return array type
		
		
	} catch (Exception $e) {
		echo "Error in Database $dbname : $e <BR>";
		
		}//end catch		
	}
	function get($tableName,$str){
			try {
	$stat=$this->con->query("select * from $tableName where $str");
	return $stat->fetchAll(PDO::FETCH_ASSOC); //return array type
		
	} catch (Exception $e) {
		echo "Error in Database : $e <BR>";
		
		}//end catch			
	}
	function getLike($tableName,$str){
			try {
	$stat=$this->con->query("select * from $tableName where $str");
	return $stat->fetchAll(PDO::FETCH_ASSOC); //return array type
		
	} catch (Exception $e) {
		return false;	
		
		}//end catch			
	}
	function delete($tableName,$eq){
		try {
		$stat=$this->con->query("delete from $tableName where $eq;");
		$stat->execute();
		
	} catch (Exception $e) {
		echo "Error in Database : $e <BR>";
		
		}//end catch	
	}
	function query($str){
		try {

		$this->con->query("$str");
				
	} catch (Exception $e) {
		
		echo "Error in Database QUERY : $e <BR>";

		
		}//end catch			

	}//end function
	function insert($tableName,$values){
		try {
		$this->con->query("insert into $tableName values($values)");
				
		
	} catch (Exception $e) {
		echo "Error in Database insert into $tableName values($values) : $e <BR>";
		
		}//end catch			

	}//end function
	function is_exist($tableName){
		try {
			$stat=$this->con->query("describe $tableName ");
			return true;
			
		} catch (Exception $e) {
			return false;	
		}
	}
	function is_data($query){
		try {
			$stat=$this->con->query("$query");
			$stat->execute();
			return true;
			
		} catch (Exception $e) {

			return false;	
		}
	}
	function update($tableName,$set, $where){
		try {
		$stat=$this->con->query("update $tableName set $set where $where");
		$stat->execute();
		
	} catch (Exception $e) {
		echo "Error in Database UPDATE update $tableName set $set where $where : $e <BR>";
		
		}//end catch			

	}//end function


}

?>