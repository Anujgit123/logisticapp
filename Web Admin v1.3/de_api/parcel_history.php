<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$rid = $data['rid'];
	
	$pol= array();
	$pols = array();
	$vid = $data["vid"];
	$selvid = $set["couvid"];
	 $status = $data['status'];
	 
	 if($selvid != $vid)
	 {
		$returnArr = array("LogisticHistory"=>[],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Parcel Order Information  Get Successfully!!!"); 
	 }
	 else 
	 {
 if($status == 'New')
 {
  $sel = $lundry->query("select * from tbl_parcel where rid=0 and status ='Pending' and vehicleid=".$selvid." and dzone=".$data['dzone']." order by id desc");
 }
 else if($status == 'Ongoing')
 {
	 $sel = $lundry->query("select * from tbl_parcel where rid=".$rid." and (status ='Processing' or status ='On Route') and vehicleid=".$selvid." and dzone=".$data['dzone']."  order by id desc");
 }
 else 
 {
	 $sel = $lundry->query("select * from tbl_parcel where rid=".$rid." and status ='Completed' and vehicleid=".$selvid." and dzone=".$data['dzone']." order by id desc");
 }
 
	while($olist = $sel->fetch_assoc())
	{
$pol['package_number'] = 'PARCEL#'.$olist['id'];
$pol['orderid'] = $olist['id'];
$pol['pick_address'] = $olist['pickup_address'];
$pol['drop_address'] = $olist['drop_address'];
$pol['logistic_date'] = $olist['order_date'];
$pol['total'] = $olist['total'];
$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
$pol['p_method_name'] = $pname['title'];
$pol['p_method_img'] = $pname['img'];
$pol['status'] = $olist['status'];
	$pols[] = $pol;
	}
	
	$returnArr = array("LogisticHistory"=>$pols,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Parcel Order Information  Get Successfully!!!");
}
}
echo json_encode($returnArr);
?>