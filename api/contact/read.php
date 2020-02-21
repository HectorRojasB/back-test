<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database and object files
include_once '../config/database.php';
include_once '../objects/contact.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$contact = new Contact($db);

$stmt = $contact->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
   $users = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    if(!isset($users[$id])){ 
        $users[$id] = [
            "id" => $id,
            "first_name" => $first_name,
            "surnames" => $surnames,
            "phones" => [],
            "emails" => [],
        ];

        $phones[$id] = [];
        $emails[$id] = [];
    }

    //check if already exist the value in the array

    if(!in_array($phone, $users[$id]["phones"]))
        $users[$id]["phones"][] = $phone;

    if(!in_array($email, $users[$id]["emails"]))
        $users[$id]["emails"][] = $email;
}

$contact_arr["results"]  = array_values($users);

    // set response code - 200 OK
    http_response_code(200);
 
    // showing all contacts
    echo json_encode($contact_arr);
}
else{
 
    //404 Not found
    http_response_code(404);
 
    // tell the user no contacts were found
    echo json_encode(
        array("message" => "No contacts found.")
    );
}

?>
