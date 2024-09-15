<?php 
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '' or $data['amt'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	
	$amt = $data['amt'];
$timestamp = date("Y-m-d H:i:s");
	$rand = uniqid();
$rid = $data['rid'];
 $table="payout_setting";
 $type = $data['type'];
  $field_values=array("amt","status","vid","r_date","rid","type");
  $data_values=array("$amt",'pending',"$rid","$timestamp","$rand","$type");
  
  // Initialize variables
$orderRevenue = 0;
$logisticsRevenue = 0;
$parcelRevenue = 0;
$payoutAmount = 0;
$earnings = 0;

// Perform database queries with error handling
$salesQuery = "SELECT SUM(o_total - (o_total * dcommission/100)) AS full_total FROM tbl_order WHERE o_status='Completed' AND rid=" . $data['rid'];
$salesResult = $lundry->query($salesQuery);
if ($salesResult->num_rows > 0) {
    $salesRow = $salesResult->fetch_assoc();
    $orderRevenue = $salesRow['full_total'];
}

$salessQuery = "SELECT SUM(total - (total * dcommission/100)) AS full_total FROM tbl_logistics WHERE status='Completed' AND rid=" . $data['rid'];
$salessResult = $lundry->query($salessQuery);
if ($salessResult->num_rows > 0) {
    $salessRow = $salessResult->fetch_assoc();
    $logisticsRevenue = $salessRow['full_total'];
}

$salesssQuery = "SELECT SUM(total - (total * dcommission/100)) AS full_total FROM tbl_parcel WHERE status='Completed' AND rid=" . $data['rid'];
$salesssResult = $lundry->query($salesssQuery);
if ($salesssResult->num_rows > 0) {
    $salesssRow = $salesssResult->fetch_assoc();
    $parcelRevenue = $salesssRow['full_total'];
}

$payoutQuery = "SELECT SUM(amt) AS full_payout FROM payout_setting WHERE vid=" . $data['rid'];
$payoutResult = $lundry->query($payoutQuery);
if ($payoutResult->num_rows > 0) {
    $payoutRow = $payoutResult->fetch_assoc();
    $payoutAmount = $payoutRow['full_payout'];
}

// Calculate earnings
$earnings = $orderRevenue + $logisticsRevenue + $parcelRevenue - $payoutAmount;

// Format earnings for display if necessary
$earn = number_format((float)$earnings, 2, '.', '');

    $main_data = $lundry->query("select pdboy from tbl_setting")->fetch_assoc();
	$limit = $main_data['pdboy'];
	
  if($limit > $amt)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Minimum ".$limit.' '.$main_data['currency']." for withdraw amount.");
}
else if($earn < $amt)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You Do Not Have Requested Amount In Wallet.!!");
}
else 
{
$h = new Laundrore();
	  $check = $h->lundryinsertdata_Api($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Submit Successfully!!");
}
}
echo json_encode($returnArr);