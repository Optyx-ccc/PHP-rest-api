<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/dengue.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$dengue = new Dengue($db);
 
// get keywords
 
// query products
$stmt = $dengue->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $dengue_arr=array();
    $dengue_arr["dengue"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $dengue_item=array(
			"region" => $region,
            "address" => $address,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "hitrate" => $hitrate
        );
 
        array_push($dengue_arr["dengue"], $dengue_item);
    }
 
    echo json_encode($dengue_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>