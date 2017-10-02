<?php
class House{
 
    // database connection and table name
    private $conn;
    private $table_name = "House";
 
    // object properties
	public $name;
    public $region;
    public $address;
	public $latitude;
	public $longitude;
    public $type;
    public $price;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
		function read(){
 
    // select all query
    $query = "SELECT * FROM " . $this->table_name ;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;

	}
	function search($lat, $lon){
	//Done
	//calculate the area
	//return all cafe data in area
    $rad = 0.5; // radius of bounding circle in kilometers
    $R = 6371;  // earth's mean radius, km
	
    // first-cut bounding box (in degrees)
 
	
			$query = "SELECT * FROM "   . $this->table_name . 
			" Where latitude=" . $lat . "
			And longitude=" . $lon ;

	
		
    // select all query
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


}