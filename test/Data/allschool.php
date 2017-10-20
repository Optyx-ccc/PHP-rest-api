<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/School.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$School = new School($db);
 
// get keywords
 
// query products
$stmt = $School->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $School_arr=array();
    $School_arr["School"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['title'] to
        // just $title only
        extract($row);
 
        $School_item=array(
            "title" => $title,
            "region" => $region,
            "description" => $description,
            "postalcode" => $postalcode,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "longitude" => $longitude,
            "url_description" => $url_description,
            "telephone" => $telephone,
            "type" => $type
        );
 
        array_push($School_arr["School"], $School_item);
    }
 
    echo json_encode($School_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>