<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
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
	$olists = $lundry->query("select * from tbl_logistics where  id=".$order_id."")->fetch_assoc();
	if($olists['rid'] != 0)
	{
		
	$olist = $lundry->query("select * from tbl_logistics where  id=".$order_id." and rid=".$rid."")->fetch_assoc();	
	}
	else 
	{
		
		$olist = $lundry->query("select * from tbl_logistics where  id=".$order_id."")->fetch_assoc();
	}
	
	$udata =  $lundry->query("select ccode,mobile,name from tbl_user where id=".$olist['uid']."")->fetch_assoc();
$pol['package_number'] = 'MOVERS#'.$olist['id'];
$pol['orderid'] = $olist['id'];
$pol['pick_address'] = $olist['pickup_address'];
$pol['pick_lat'] = $olist['pick_lat'];
$pol['pick_lng'] = $olist['pick_long'];
$pol['pick_name'] = $udata["name"];
$pol['pick_mobile'] = $udata["ccode"].$udata["mobile"];
$pol['drop_address'] = $olist['drop_address'];
$pol['drop_lat'] = $olist['drop_lat'];
$pol['drop_long'] = $olist['drop_long'];
$pol['pick_has_lift'] = $olist['pick_has_lift'];
$pol['drop_has_lift'] = $olist['drop_has_lift'];
$pol['pick_floor_no'] = $olist['pick_floor_no'];
$pol['drop_floor_no'] = $olist['drop_floor_no'];
$pol['logistic_date'] = $olist['logistic_date'];
$pol['total'] = $olist['total'];
$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
$pol['p_method_name'] = $pname['title'];
$pol['p_method_img'] = $pname['img'];
$pol['status'] = $olist['status'];
$pol['transaction_id'] = $olist['transaction_id'];
	$res = array();
	$result = array();
	$query = $lundry->query("select * from tbl_logistics_product where oid=".$olist['id']."");
	while($row = $query->fetch_assoc())
	{
		$res['id'] = $row['id'];
		$res['product_name'] = $row['product_name'];
		$res['quantity'] = $row['quantity'];
		$res['price'] = $row['price'];
		$res['total'] = $row['total'];
		$result[] = $res;
	}
	$pol['productdata'] = $result;
	
	
	
	$returnArr = array("LogisticInfo"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logistic Order Information  Get Successfully!!!");
}
echo json_encode($returnArr);
?>