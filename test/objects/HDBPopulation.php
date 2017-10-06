<?php
class HDBPopulation{
 
    // database connection and table name
    private $conn;
    private $table_name = "HDBPopulation";
 
    // object properties

    public $region;
	public $total;
	public $studio;
	public $threeroom;
	public $fourroom;
	public $fiveroom;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	
	function displayHDB($region, $year){
 
    // select all query
    $query = "SELECT * FROM " . $this->table_name . " where region=upper('" . $region . "') AND year =" . $year ;
	echo $query;
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;

	}
	
	
}