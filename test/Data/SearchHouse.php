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
$lat = isset($_GET["lat"]) ? $_GET["lat"] : "";
$long = isset($_GET["long"]) ? $_GET["long"] : "";
 $rad = isset($_GET["rad"]) ? $_GET["rad"] : "";
 
// query products
$stmt = $product->search($lat, $long, $rad);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['title'] to
        // just $title only
        extract($row);
 
        $product_item=array(
            "title" => $title,
            "region" => $region,
            "description" => $description,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "type" => $type,
            "price" => $price,
        );
 
        array_push($products_arr["records"], $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>