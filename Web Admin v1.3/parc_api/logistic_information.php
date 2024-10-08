<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid = $data['uid'];
	$order_id = $data['order_id'];
	$pol= array();
	$pols = array();
	$olist = $lundry->query("select * from tbl_logistics where uid=".$uid." and id=".$order_id."")->fetch_assoc();
	
$pol['package_number'] = 'MOVERS#'.$olist['id'];
$pol['orderid'] = $olist['id'];
$pol['pick_address'] = $olist['pickup_address'];
$pol['pick_lat'] = $olist['pick_lat'];
$pol['pick_lng'] = $olist['pick_long'];
$pol['drop_address'] = $olist['drop_address'];
$pol['drop_lat'] = $olist['drop_lat'];
$pol['drop_long'] = $olist['drop_long'];
$pol['pick_has_lift'] = $olist['pick_has_lift'];
$pol['drop_has_lift'] = $olist['drop_has_lift'];
$pol['pick_floor_no'] = $olist['pick_floor_no'];
$pol['drop_floor_no'] = $olist['drop_floor_no'];
$pol['logistic_date'] = $olist['logistic_date'];
$pol['total'] = $olist['total'];
$pol['transaction_id'] = $olist['transaction_id'];
$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
$pol['p_method_name'] = $pname['title'];
$pol['p_method_img'] = $pname['img'];
$pol['status'] = $olist['status'];
$pol['transaction_id'] = $olist['transaction_id'];
if($olist['rid'] == 0)
	{
		$pol['rider_name'] = '';
		$pol['rider_img'] = '';
	}
	else 
	{
	$riderdata = $lundry->query("select * from tbl_rider where id=".$olist['rid']."")->fetch_assoc();
	$pol['rider_name'] = $riderdata['title'];
	$pol['rider_img'] = $riderdata['rimg'];
	
	}	
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