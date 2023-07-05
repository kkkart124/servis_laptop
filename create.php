<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/database.php';
include_once '../../models/employee.php';
$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);
$data = json_decode(file_get_contents("php://input"));
$item->nama = $data->nama;
$item->tipe_laptop = $data->tipe_laptop;
$item->pw_laptop = $data->pw_laptop;
$item->no_hp = $data->no_hp;
$item->kerusakan = $data->kerusakan;
$item->created = date('Y-m-d H:i:s');
if($item->createEmployee()){
echo json_encode(['message'=>'emloyee created successfully']);
} else{
echo json_encode(['message'=>'emloyee could not be created']);
}
?>