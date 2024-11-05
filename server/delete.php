<?php

include ("./config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$id= $data['itemid'];

$getInfo = $conn->prepare("delete from info where id='$id'");

if($getInfo->execute()){
    echo json_encode(["status" => "success", "message" => "Item Deleted"]);
} else{
    echo json_encode(["status" => "error", "message" => "Data not deleted!!"]);
}