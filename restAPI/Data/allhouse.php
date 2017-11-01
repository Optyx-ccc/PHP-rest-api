<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/House.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$House = new House($db);
 
// get keywords
 
// query products
$stmt = $House->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $House_arr=array();
    $House_arr["House"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['title'] to
        // just $title only
        extract($row);
 
        $House_item=array(
            "title" => $title,
            "region" => $region,
            "description" => $description,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "type" => $type,
            "price" => $price
        );
 
        array_push($House_arr["House"], $House_item);
    }
 
    echo json_encode($House_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>