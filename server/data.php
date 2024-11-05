<?php
include("./config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name'])){
    $name = $data['name'];
    $age = $data['age'];
    
    $getInfo = $conn->prepare("
    INSERT INTO `info`(`name`, `age`)
    VALUES ('$name','$age')
    ");
    $info = $getInfo->execute();
    if($info){
        echo json_encode(["status" => "success", "message" => "Data inserted!!"]);
    }else {
        echo json_encode(["status" => "error", "message" => "Data not inserted!!"]);
    }
}
