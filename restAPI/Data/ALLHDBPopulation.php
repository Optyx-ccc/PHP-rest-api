<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/HDBPopulation.php';
 
// instantiate database and HDBPopulation object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$HDBPopulation = new HDBPopulation($db);
 
// get keywords

 
// query HDBPopulations
$stmt = $HDBPopulation->displayALL();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // HDBPopulations array
    $HDB_arr=array();
    $HDB_arr["HDBPopulation"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $HDB_item=array(
            "region" => $region,
            "total" => $total,
            "studio" => $studio,
            "threeroom" => $threeroom,
            "fourroom" => $fourroom,
            "fiveroom" => $fiveroom
        );
 
        array_push($HDB_arr["HDBPopulation"], $HDB_item);
    }
 
    echo json_encode($HDB_arr);
}
 
else{
    echo json_encode(
        array("message" => "No HDBPopulations found.")
    );
}
?>