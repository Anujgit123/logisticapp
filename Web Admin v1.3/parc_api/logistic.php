<?php 
require dirname( dirname(__FILE__) ).'/include/lanconfig.php';
require dirname( dirname(__FILE__) ).'/include/laundrore.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['pickup_address'] == ''  or $data['pick_lat'] == '' or $data['pick_long'] == '' or $data['drop_address'] == '' or $data['drop_lat'] == '' or $data['drop_long'] == '' or $data['pick_has_lift'] == '' or $data['drop_has_lift'] == '' or $data['pick_floor_no'] == '' or $data['drop_floor_no'] == '' or $data['logistic_date'] == '' or $data['total'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $pickup_address = strip_tags(mysqli_real_escape_string($lundry,$data['pickup_address']));
    $pick_lat = strip_tags(mysqli_real_escape_string($lundry,$data['pick_lat']));
	$pick_long = strip_tags(mysqli_real_escape_string($lundry,$data['pick_long']));
	$drop_address = strip_tags(mysqli_real_escape_string($lundry,$data['drop_address']));
	$drop_lat = strip_tags(mysqli_real_escape_string($lundry,$data['drop_lat']));
	$drop_long = strip_tags(mysqli_real_escape_string($lundry,$data['drop_long']));
	$pick_has_lift = strip_tags(mysqli_real_escape_string($lundry,$data['pick_has_lift']));
	$drop_has_lift = strip_tags(mysqli_real_escape_string($lundry,$data['drop_has_lift']));
	$pick_floor_no = strip_tags(mysqli_real_escape_string($lundry,$data['pick_floor_no']));
	$drop_floor_no = strip_tags(mysqli_real_escape_string($lundry,$data['drop_floor_no']));
	$logistic_date = strip_tags(mysqli_real_escape_string($lundry,$data['logistic_date']));
	$total = strip_tags(mysqli_real_escape_string($lundry,$data['total']));
	$uid = $data["uid"];
	$vid = $set["vehiid"];
	$transaction_id = $data["transaction_id"];
	$p_method_id = $data["p_method_id"];
	$getzoneid = $lundry->query("select id FROM zones where ST_Contains(coordinates,ST_GeomFromText('POINT(".$pick_long." ".$pick_lat.")'))")->fetch_assoc();
$zoneid = $getzoneid['id'];

	$table="tbl_logistics";
  $field_values=array("vehicleid","pickup_address","pick_lat","pick_long","drop_address","drop_lat","drop_long","pick_has_lift","drop_has_lift","pick_floor_no","drop_floor_no","logistic_date","total","p_method_id","transaction_id","uid","dzone");
  $data_values=array("$vid","$pickup_address","$pick_lat","$pick_long","$drop_address","$drop_lat","$drop_long","$pick_has_lift","$drop_has_lift","$pick_floor_no","$drop_floor_no","$logistic_date","$total","$p_method_id","$transaction_id","$uid","$zoneid");
  
      $h = new Laundrore();
	  $oid = $h->lundryinsertdata_Api_Id($field_values,$data_values,$table);
	  
	 $ParcelData = $data['ProductData']; 
	 
	 for($i=0;$i<count($ParcelData);$i++)
{

$product_name = mysqli_real_escape_string($lundry,$ParcelData[$i]['product_name']);
$quantity = $ParcelData[$i]['quantity'];
$price = $ParcelData[$i]['price'];
$total = $ParcelData[$i]['total'];
$table="tbl_logistics_product";
  $field_values=array("oid","product_name","quantity","price","total");
  $data_values=array("$oid","$product_name","$quantity","$price","$total");
  
      $h = new Laundrore();
	   $h->lundryinsertdata_Api($field_values,$data_values,$table);
}

$content = array(
       "en" => 'New Logisitics Arrival!!'
   );
$heading = array(
   "en" => "Check Logisitics Order And Accept!!"
);
$fields = array(
'app_id' => $set['d_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'vehicleid', 'relation' => '=', 'value' => $vid),array("operator" => "and"),array('field' => 'tag', 'key' => 'dzoneid', 'relation' => '=', 'value' => $zoneid)),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['d_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Logisitics Order Placed Successfully!!!","order_id" =>$oid);
}
echo json_encode($returnArr);