<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['mobile'] == ''  or $data['password'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $mobile = strip_tags(mysqli_real_escape_string($lundry,$data['mobile']));
    $password = strip_tags(mysqli_real_escape_string($lundry,$data['password']));
    
$chek = $lundry->query("select * from tbl_rider where (mobile='".$mobile."' or email='".$mobile."') and status = 1 and password='".$password."'");
$status = $lundry->query("select * from tbl_rider where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $lundry->query("select * from tbl_rider where  (mobile='".$mobile."' or email='".$mobile."') and status = 1 and password='".$password."'")->fetch_assoc();
 $curr = $lundry->query("select * from tbl_setting")->fetch_assoc();
    $returnArr = array("dboydata"=>$c,"currency"=>$curr['currency'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
}
else
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Invalid Email/Mobile No or Password!!!");
}
}
else  
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Your Status Deactivate!!!");
}
}

echo json_encode($returnArr);