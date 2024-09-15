<?php
require dirname(dirname(__FILE__)) . '/include/lanconfig.php';
header('Content-type: application/json');

$stmt = $lundry->prepare("SELECT ukms, uprice, aprice FROM tbl_vehicle WHERE id = ?");
$stmt->bind_param("i", $set['couvid']);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$response_arr = [
    "MAXLIMIT" => $set['kglimit'],
	"KGPRICE"=> $set['kgprice'],
	"vehicle_Data"=>$result,
    "ResponseCode" => 200,
    "Result" => true,
    "ResponseMsg" => "Data Get Successfully!"
];

echo json_encode($response_arr);