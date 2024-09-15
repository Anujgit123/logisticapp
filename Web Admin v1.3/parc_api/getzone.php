<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	
	$uid = $data['uid'];
$coordinates = $lundry->query("SELECT ST_AsGeoJSON(`coordinates`),ST_AsText(ST_Centroid(`coordinates`)) as center  FROM `zones` WHERE status=1");
$kl = array();
$js = array();
while($row = $coordinates->fetch_array())
{
$data = json_decode($row[0]);
$rows = $data->coordinates[0];
$datas = array();

foreach ($rows as $row) {
	$datas['lat'] = $row[1];
$datas['lng'] = $row[0];
$js[] = $datas;
}

}
$main_data = $lundry->query("SELECT currency from tbl_setting")->fetch_assoc();

$banner = $lundry->query("select * from tbl_banner where status=1");

$v = array();
while($row = $banner->fetch_assoc())
{
	
	
    $v[] = $row['img'];
}

$pol= array();
	$pols = array();
	$r = $lundry->query("select * from tbl_order where uid=".$uid." order by id limit 1");
	while($olist = $r->fetch_assoc())
	{
	$pol['package_number'] = 'Package'.$olist['id'];
	$pol['orderid'] = $olist['id'];
	$pol['pick_address'] = $olist['pick_address'];
	$pol['pick_lat'] = $olist['pick_lat'];
	$pol['pick_lng'] = $olist['pick_lng'];
	
	$pol['p_total'] = $olist['o_total'];
	$pol['date_time'] = $olist['odate'];
	$pol['order_status'] = $olist['o_status'];
	$pol['transaction_id'] = $olist['trans_id'];
	$pol['wall_amt'] = $olist['wall_amt'];
	$pol['cou_amt'] = $olist['cou_amt'];
	$pol['subtotal'] = $olist['subtotal'];
	$pname = $lundry->query("select * from tbl_payment_list where id=".$olist['p_method_id']."")->fetch_assoc();
		$pol['p_method_name'] = $pname['title'];
	$pol['p_method_img'] = $pname['img'];
		$res = array();
	$result = array();
	$query = $lundry->query("select * from tbl_drop_points where order_id=".$olist['id']." and uid=".$olist['uid']."");
	while($row = $query->fetch_assoc())
	{
		$res['id'] = $row['id'];
		$res['drop_point_address'] = $row['drop_address'];
		$res['drop_point_lat'] = $row['drop_lat'];
		$res['drop_point_lng'] = $row['drop_lng'];
		$res['drop_point_mobile'] = $row['drop_mobile'];
		$result[] = $res;
	}
	$pol['parceldata'] = $result;
	$vname = $lundry->query("select * from tbl_vehicle where id=".$olist['vehicleid']."")->fetch_assoc();
	$pol['v_type'] = $vname['title'];
	$pol['v_img'] = $vname['img'];
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
	 $cname = $lundry->query("select * from tbl_category where id=".$olist['cat_id']."")->fetch_assoc();
	$pol['cat_img'] = $cname['cat_img'];
	$pol['cat_name'] = $cname['cat_name'];
	$pols[] = $pol;
	}
	
$returnArr = array('Zone'=>$js,'Main_data'=>$main_data,'BannerList'=>(empty($v)) ? [] : $v,"Historyinfo"=>(empty($pols)) ? [] : $pols);
}
echo json_encode($returnArr);
