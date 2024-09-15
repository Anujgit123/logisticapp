<!doctype html>
<html lang="en">

    

<?php include 'include/head.php';?>

    <body>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php include 'include/inside.php';?>

            <!-- ========== Left Sidebar Start ========== -->
           <?php include 'include/sidebar.php';?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
									<?php 
				if(isset($_GET['id']))
				{
					$data = $lundry->query("select * from tbl_manager where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Country Code </h4>
					   <h5 class="h5_set"><i class="fa fa-motorcycle"></i>  Zone Manager  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-3">
                                            <label><span class="text-danger">*</span> Zone Manager Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Zone Manager Name" value="<?php echo $data['name'];?>" name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-3" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> Zone Manager Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Zone Manager Image</label>
												<br>
												<img src="<?php echo $data['img'];?>" width="100" height="100"/>
                                            </div>
                                        </div>
										
										<div class="form-group col-3">
                                            <label> <span class="text-danger">*</span> Zone Manager Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										
										
										
										<div class="form-group col-3">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  value="<?php echo $data['mobile'];?>" name="mobile" required="">
                                        </div>
										
										
										
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-sign-in-alt"></i> Zone Manager  Login Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address"  value="<?php echo $data['email'];?>" name="email" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password"  value="<?php echo $data['password'];?>" name="password" required="">
                                        </div>
	
										
										
										
										
										
										
										


										
									
										
										
										
										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-map-pin"></i> Zone Manager  Zone </h5>
										</div>
										
										<div class="form-group col-12">
                                            <label id="no2" style=""><span class="text-danger">*</span> Select  Zone</label>
                                            <select name="dzone" class="form-control" required>
											<option value="">Select  Zone</option>
											<?php 
											$zone = $lundry->query("select * from zones where status=1");
											while($row = $zone->fetch_assoc())
											{
											    
											?>
											<option value="<?php echo $row['id'];?>" <?php if($data['zone_id'] == $row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
											<?php }?>
											</select>
                                        </div>
										
										
										
										
										<div class="col-12">
                                                <button type="submit" name="edit_dboy" class="btn btn-primary mb-2">Edit Zone Manager</button>
                                            </div>
											</div>
                                    </form>  
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Zone Manager</h4>
                        <!-- start page title -->
                    <h5 class="h5_set"><i class="fa fa-motorcycle"></i>  Zone Manager  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group col-3">
                                            <label><span class="text-danger">*</span> Zone Manager Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Zone Manager Name"  name="cname" required="">
                                        </div>
										
                                      <div class="form-group col-3">
                                            <label><span class="text-danger">*</span> Zone Manager Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="cat_img" class="custom-file-input form-control" required>
                                                <label class="custom-file-label">Choose Zone Manager Image</label>
                                            </div>
                                        </div>
										
										<div class="form-group col-3">
                                            <label> <span class="text-danger">*</span> Zone Manager Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										
										
										
										<div class="form-group col-3">
                                            <label><span class="text-danger">*</span> Mobile number(With country code + sign)</label>
                                            <input type="text" class="form-control mobile" placeholder="Enter Mobile number"  name="mobile" required="">
                                        </div>
										
										
										
										
	
	<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-sign-in-alt"></i> Zone Manager  Login Information</h5>
										</div>
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Email Address</label>
                                            <input type="email" class="form-control " placeholder="Enter Email Address"  name="email" required="">
                                        </div>
										
										<div class="form-group col-6">
                                            <label><span class="text-danger">*</span>Password</label>
                                            <input type="text" class="form-control " placeholder="Enter Password"  name="password" required="">
                                        </div>

										<div class="form-group col-12">
										<h5 class="h5_set"><i class="fas fa-map-pin"></i> Zone Manager  Zone </h5>
										</div>
										
										<div class="form-group col-12">
                                            <label id="no2" style=""><span class="text-danger">*</span> Select  Zone</label>
                                            <select name="dzone" class="form-control" required>
											<option value="">Select  Zones</option>
											<?php 
											$zone = $lundry->query("select * from zones where status=1");
											while($row = $zone->fetch_assoc())
											{
												$count = $lundry->query("select * from tbl_manager where zone_id=".$row['id']."")->num_rows;
												if($count != 0)
												{
												}
												else 
												{
											?>
											<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
											<?php } }?>
											</select>
                                        </div>
										
										
										
										
										<div class="col-12">
                                                <button type="submit" name="add_rider" class="btn btn-primary mb-2">Add Zone Manager</button>
                                            </div>
											</div>
                                    </form>
				<?php } ?>
										</div>
										</div>
										</div>
										</div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Transaction Modal -->
              
                
               
            </div>
            <!-- end main content-->

        </div>
        
        

       <?php include 'include/lundryfoot.php';?>
	   
	   	<?php 
	if(isset($_POST['edit_dboy']))
	{
		$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
			$status = $_POST['status'];
			$mobile = $_POST['mobile'];
			$dzone = $_POST['dzone'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$rid = $_GET['id'];
			$target_dir = "images/manager/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
$count = $lundry->query("select * from tbl_manager where zone_id=".$dzone." and id!=".$rid."")->num_rows;
												
												
$check_details = $lundry->query("select email from tbl_manager where email='".$email."' and id!=".$rid."")->num_rows;
			if($check_details != 0)
			{
				?>
				<script>
 iziToast.error({
    title: 'Zone Manager Section!!',
    message: 'Zone Manager Email Already Used!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="add_manager.php?id="+<?php echo $_GET['id'];?>},3000);
  
  </script>
  
				
				<?php 
			}
			else if($count != 0)
			{
				?>
				<script>
 iziToast.error({
    title: 'Zone Manager Section!!',
    message: 'Zone Manager Already Assigned To Selected Zone!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="add_manager.php?id="+<?php echo $_GET['id'];?>},3000);
  
  </script>
  
				
				<?php 
			}
			else 
			{
			if($_FILES["cat_img"]["name"] != '')
	{
		
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		$table="tbl_manager";
  $field = array('zone_id'=>$dzone,'status'=>$status,'img'=>$target_file,'name'=>$cname,'email'=>$email,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$rid."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: 'Zone Manager Section!!',
    message: 'Zone Manager Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_manager.php"},3000);
  </script>
<?php 
}

	}
else 
{
	$table="tbl_manager";
  $field = array('zone_id'=>$dzone,'status'=>$status,'name'=>$cname,'email'=>$email,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$rid."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: 'Zone Manager Section!!',
    message: 'Zone Manager Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_manager.php"},3000);
  </script>
  

  
<?php 
}

}	
			}
	}
		if(isset($_POST['add_rider']))
		{
			
			$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
			$status = $_POST['status'];
			$mobile = $_POST['mobile'];
			$dzone = $_POST['dzone'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$target_dir = "images/manager/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   $check_details = $lundry->query("select email from tbl_manager where email='".$email."'")->num_rows;
			if($check_details != 0)
			{
				?>
				<script>
 iziToast.error({
    title: 'Zone Manager Section',
    message: 'Zone Manager Email Already Used!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="add_manager.php"},3000);
  
  </script>
  
				
				<?php 
			}
			else 
			{
				
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		
$table="tbl_manager";
  $field_values=array("zone_id","img","status","name","email","password","mobile");
  $data_values=array("$dzone","$target_file","$status","$cname","$email","$password","$mobile");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: 'Zone Manager Section!!',
    message: 'Zone Manager Add Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="add_manager.php"},3000);
  
  </script>
  

<?php 
}

			}
		}
		?>
    </body>



</html>