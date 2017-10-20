<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/School.php';
 
// instantiate database and school object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$school = new School($db);
 
// get keywords
$lat = isset($_GET["lat"]) ? $_GET["lat"] : "";
$long = isset($_GET["long"]) ? $_GET["long"] : "";
$rad = isset($_GET["rad"]) ? $_GET["rad"] : "";
 
// query schools
$stmt = $schools->search($lat, $long, $rad);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // schools array
    $schools_arr=array();
    $schools_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['title'] to
        // just $title only
        extract($row);
 
        $school_item=array(
            "title" => $title,
            "region" => $region,
            "description" => $description,
            "postalcode" => $postalcode,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "longitude" => $longitude,
            "url_address" => $url_address,
            "telephone" => $telephone,
            "type" => $type
        );
 
        array_push($schools_arr["School"], $school_item);
    }
 
    echo json_encode($schools_arr);
}
 
else{
    echo json_encode(
        array("message" => "No schools found.")
    );
}
?>