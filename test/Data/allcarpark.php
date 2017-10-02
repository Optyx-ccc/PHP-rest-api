<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Carpark.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$carpark = new Carpark($db);
 
// get keywords
 
// query products
$stmt = $carpark->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $carpark_arr=array();
    $carpark_arr["carpark"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $carpark_item=array(
			"name" => $name,
            "region" => $region,
            "address" => $address,
            "latitude" => $latitude,
            "longitude" => $longitude, 
            "ratetype" => $ratetype ,
            "rate" => $rate 
        );
 
        array_push($carpark_arr["carpark"], $carpark_item);
    }
 
    echo json_encode($carpark_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>