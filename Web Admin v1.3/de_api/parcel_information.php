<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$rid = $data['rid'];
	$order_id = $data['order_id'];
	$pol= array();
	$pols = array();

	
	$olists = $lundry->query("select * from tbl_parcel where  id=".$order_id."")->fetch_assoc();
	if($olists['rid'] != 0)
	{
		
	$olist = $lundry->query("select * from tbl_parcel where  id=".$order_id." and rid=".$rid."")->fetch_assoc();	
	}
	else 
	{
		
		$olist = $lundry->query("select * from tbl_parcel where  id=".$order_id."")->fetch_assoc();
	}
	$udata =  $lundry->query("select ccode,mobile,name from tbl_user where id=".$olist['uid']."")->fetch_assoc();
$pol['package_number'] = 'PARCEL#'.$olist['id'];
$pol['orderid'] = $olist['id'];
$pol['pick_address'] = $olist['pickup_address'];
$pol['pick_lat'] = $olist['pick_lat'];
$pol['pick_lng'] = $olist['pick_long'];
$pol['pick_name'] = $udata["name"];
$pol['pick_mobile'] = $udata["ccode"].$udata["mobile"];
$pol['drop_address'] = $olist['drop_address'];
$pol['drop_lat'] = $olist['drop_lat'];
$pol['drop_long'] = $olist['drop_long'];
$pol['pick_pincode'] = $olist['pick_pincode'];
$pol['drop_pincode'] = $olist['drop_pincode'];
$pol['parcel_weight'] = $olist['parcel_weight'];
$pol['parcel_dimension'] = explode('x',$olist['parcel_dimension']);
$pol['logistic_date'] = $olist['order_date'];
$pol['total'] = $olist['total'];
$pol['transaction_id'] = $olist['transaction_id'];
$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
$pol['p_method_name'] = $pname['title'];
$pol['p_method_img'] = $pname['img'];
$pol['status'] = $olist['status'];
$pol['transaction_id'] = $olist['transaction_id'];
	
	
	
	
	$returnArr = array("LogisticInfo"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logistic Order Information  Get Successfully!!!");
}
echo json_encode($returnArr);
?>