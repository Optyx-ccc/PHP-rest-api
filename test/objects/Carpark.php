<?php
class Carpark{
 
    // database connection and table name
    private $conn;
    private $table_name = "Carpark";
 
    // object properties
	public name;
    public $region;
	public $address;
	public $latitude;
	public $longitude;
    public $ratetype;
    public $rate;
 
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
	function search($lat, $lon, $rad){
	//Done
	//calculate the area
	//return all cafe data in area
    $rad = 0.5; // radius of bounding circle in kilometers
    $R = 6371;  // earth's mean radius, km
	
    // first-cut bounding box (in degrees)
    $maxLat = $lat + rad2deg($rad/$R);
    $minLat = $lat - rad2deg($rad/$R);
    $maxLon = $lon + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
    $minLon = $lon - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
	
	
	if(($maxLat > $minLat) && ($maxLon > $minLon)){
			$query = "SELECT * FROM "   . $this->table_name . 
			" Where latitude Between " . $minLat . " And " . $maxLat . "
			And longitude Between " . $minLon . " And " . $maxLon . "";
		  }
		  else if(($minLat > $maxLat) && ($maxLon > $minLon)){
			$query = "SELECT * FROM "   . $this->table_name . 
			" Where latitude Between " . $maxLat . " And " . $minLat . "
			And longitude Between " . $minLon . " And " . $maxLon . "";
	}
		  else if(($maxLat > $minLat) && ($minLon > $maxLon)){
			$query = "SELECT * FROM "   . $this->table_name . 
			" Where latitude Between " . $minLat . " And " . $maxLat . "
			And longitude Between " . $maxLon . " And " . $minLon . "";
	}else{
			$query = "SELECT * FROM "   . $this->table_name . 
			" Where latitude Between " . $maxLat . " And " . $minLat . "
			And longitude Between " . $maxLon . " And " . $minLon . "";

			
	}
		
    // select all query
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}


	
	
	
}