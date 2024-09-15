<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);


$rid = $data['rid'];
if ($rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pok = array();
	$p =0 ;
	$riderdata = $lundry->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$pok['total_complete_order'] = $riderdata['complete'];
	$pok['total_receive_order'] = $lundry->query("select * from tbl_order where rid=".$riderdata['id']."")->num_rows;
	$pok['total_reject_order'] = $riderdata['reject'];
	$sale = $lundry->query("select sum(o_total) as total_earn from tbl_order where rid=".$rid." and o_status='Completed'")->fetch_assoc();
	$sales = $lundry->query("select sum(total) as total_earn from tbl_logistics where rid=".$rid." and status='Completed'")->fetch_assoc();
	$saless = $lundry->query("select sum(total) as total_earn from tbl_parcel where rid=".$rid." and status='Completed'")->fetch_assoc();
     
	 $tbl_order = empty($sale['total_earn']) ? $p : $sale['total_earn'];
	 $tbl_logistics = empty($sales['total_earn']) ? $p : $sales['total_earn'];
     $tbl_parcel = empty($saless['total_earn']) ? $p : $saless['total_earn'];
		$p = number_format((float)$tbl_order + $tbl_logistics + $tbl_parcel, 2, '.', '');
	 
	 $pok['total_sale'] = $p;
	 
	 $salev = $lundry->query("select sum(o_total - (o_total * dcommission/100)) as total_earn from tbl_order where rid=".$rid." and o_status='completed'")->fetch_assoc();
	 $salesv = $lundry->query("select sum(total - (total * dcommission/100)) as total_earn from tbl_logistics where rid=".$rid." and status='Completed'")->fetch_assoc();
	$salessv = $lundry->query("select sum(total - (total * dcommission/100)) as total_earn from tbl_parcel where rid=".$rid." and status='Completed'")->fetch_assoc();
	$z=0;
     
	 $tbl_orderv = empty($salev['total_earn']) ? $z : $salev['total_earn'];
	 $tbl_logisticsv = empty($salesv['total_earn']) ? $z : $salesv['total_earn'];
     $tbl_parcelv = empty($salessv['total_earn']) ? $z : $salessv['total_earn'];
	 
		$z = number_format((float)$tbl_orderv + $tbl_logisticsv + $tbl_parcelv, 2, '.', '');
	 
	 $pok['total_eaning'] = $z;
	 
	 
	 $payout =   $lundry->query("select sum(amt) as full_payouts from tbl_cash where rid=".$rid."")->fetch_assoc();
	$vp = 0 ;
	$pyout = empty($payout['full_payouts']) ? $vp : $payout['full_payouts'];
		$vp = number_format((float)($z) - $pyout, 2, '.', '');  
	 
	 $pok['cash_on_hand'] = $vp;
	 
	
    $main_data = $lundry->query("select pdboy from tbl_setting")->fetch_assoc();
	$limit = $main_data['pdboy'];
	
	
	 
	 $returnArr = array("order_data"=>$pok,"dboydata"=>$riderdata,"payoutlimit"=>$limit,"walletbalance"=>$z,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($lundry);
?>
