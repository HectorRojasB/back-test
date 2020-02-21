<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/contact.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$contact = new Contact($db);
$data = json_decode(file_get_contents("php://input"));
$contact->id = $data->id;
$contact->email = $data->email;

if($contact->updateEmail()){
 
    http_response_code(200);
    echo json_encode(array("message" => "email was updated."));
}
 
else{
 
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update email."));
}
?>