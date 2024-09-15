<?php 
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
$getkey = $lundry->query("select * from tbl_setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$status = $data['status'];
$rid = $data['rid'];

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if ($oid =='' or $status =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $oid = strip_tags(mysqli_real_escape_string($lundry,$oid));
	$rid = strip_tags(mysqli_real_escape_string($lundry,$rid));
    $status = strip_tags(mysqli_real_escape_string($lundry,$status));
	
	$checks = $lundry->query("select * from tbl_logistics where id=".$oid."")->fetch_assoc();
	
            $udata = $lundry->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];			
		
		$uid = $checks['uid'];
		
	
if($status == 'accept')
{
	if($checks['rid'] != 0)
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Other Rider Already Accepted Order!");
	}
	else 
	{
	$lats = $data['lats'];
	$longs = $data['longs'];
	$riderdata = $lundry->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$accept = $riderdata['accept'] + 1;
	$table="tbl_logistics";
  $field = array('status'=>'Processing','rlats'=>$lats,'rlongs'=>$longs,"dcommission"=>$riderdata['commission'],"rid"=>$rid);
  $where = "where id=".$oid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	  $table="tbl_rider";
  $field = array('accept'=>$accept);
  $where = "where id=".$rid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	   
	   

$content = array(
       "en" => $name.', Your Logistics Order #'.$oid.' Has Been Processed.'
   );
$heading = array(
   "en" => "Logistics Order Processed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/parcel/order_process_img/process.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);


	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logistics Order Accepted Successfully!!!!!","Next_step"=>"pickup");    
	}
}
else if($status == 'pickup')
{
	
	$lats = $data['lats'];
	$longs = $data['longs'];
	
	$table="tbl_logistics";
  $field = array('status'=>'On Route','rlats'=>$lats,'rlongs'=>$longs);
  $where = "where id=".$oid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	
	
	
	
	$content = array(
       "en" => $name.', Your Logistics Order #'.$oid.' Out For Delivery.'
   );
$heading = array(
   "en" => "Logistics Order On Route!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/parcel/order_process_img/onroute.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch); 






	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logistics Order Pickup Successfully!!!!!","Next_step"=>"Deliverey");    
	
}
else if($status == 'reject')
{
	
	$riderdata = $lundry->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$reject = $riderdata['reject'] + 1;
	$table="tbl_logistics";
  $field = array('rid'=>"0");
  $where = "where id=".$oid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	   $table="tbl_rider";
  $field = array('reject'=>$reject);
  $where = "where id=".$rid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	


	   
	  
	$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Logistics Order Rejected Successfully!!!!!");    
}
else if($status == 'complete')
{
	
	  
	$riderdata = $lundry->query("select * from tbl_rider where id=".$rid."")->fetch_assoc();
	$complete = $riderdata['complete'] + 1;
	
	
	
	
	$timestamp = date("Y-m-d H:i:s");
	
	$table="tbl_logistics";
  $field = array('status'=>'Completed','delivertime'=>$timestamp);
  $where = "where id=".$oid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	
	  $table="tbl_rider";
  $field = array('complete'=>$complete);
  $where = "where id=".$rid."";
$h = new Laundrore();
	  $h->lundryupdateData_Api($field,$table,$where);
	  
	  
	   
	   
	   
	 $content = array(
       "en" => $name.', Your Logistics Order #'.$oid.' Has Been Delivered.'
   );
$heading = array(
   "en" => "Logistics Order Delivered!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/eatggy/order_process_img/complete.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch); 
	
	
	   
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logistics Order Delivered Successfully!!!!!","Next_step"=>"Done");    
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
	
}
echo json_encode($returnArr);
mysqli_close($lundry);
?>