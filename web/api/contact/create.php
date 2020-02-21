<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/contact.php';
 
$database = new Database();
$db = $database->getConnection();
 
$contact = new Contact($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->first_name) &&
    !empty($data->surnames) 
){

    $contact->first_name = $data->first_name;
    $contact->surnames = $data->surnames;
 
    if($contact->create()){

        http_response_code(201);
        echo json_encode(array("message" => "contact was created."));
    }
 
    else{
 
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create contact."));
    }
}
 
else{

    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>