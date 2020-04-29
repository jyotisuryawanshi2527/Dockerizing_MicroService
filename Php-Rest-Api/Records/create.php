<?php
// required headers
header("Access-Control-Allow-Origin:  *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection


include_once '../config/Database.php';
include_once '../Class/Items.php';
  
$database = new Database();
$db = $database->getConnection();

//create object for items
  
$items = new Items($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
 if(!empty($data->id) && !empty($data->name) && !empty($data->age) &&
    !empty($data->department) && !empty($data->subject)){
  
	    $items->id = $data->id;
            $items->name = $data->name;
    	    $items->age = $data->age;
            $items->department = $data->department;
    	    $items->subject = $data->subject;
    
  
    // create the product
 
  		 if($items->create()){
  
        // set response code - 201 created

       			 http_response_code(201);
  
        // tell the user
       			 echo json_encode(array("message" => "record was created."));
    } else{
      	  http_response_code(503);   // set response code - 503 service unavailable

    	  echo json_encode(array("message" => "Unable to create record."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>
