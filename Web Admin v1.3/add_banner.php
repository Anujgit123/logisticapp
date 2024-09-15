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
					$data = $lundry->query("select * from tbl_banner where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Banner </h4>
					<form method="post" enctype="multipart/form-data">
                                       
									   
										
                                      <div class="form-group">
                                             <label>Banner Image</label>
                                            
                                                <input type="file" name="cat_img" class="form-control">
                                                
											<br>
											
                                        </div>
										<div class="form-group">
										<img src="<?php echo $data['img'];?>" width="100px"/>
										</div>
										<div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_banner" class="btn btn-primary mb-2">Update Banner</button>
                                            </div>
                                    </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Banner </h4>
                        <!-- start page title -->
                    <form method="post" enctype="multipart/form-data">
                                       
									  
										
                                      <div class="form-group">
                                            
                                               <label>Banner Image</label>
                                            
                                                <input type="file" name="cat_img" class="form-control"  required="">
                                                
                                        </div>
										
										<div class="form-group">
                                            <label>Banner Status</label>
                                            <select name="status" class="form-control" required="">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_banner" class="btn btn-primary mb-2">Add Banner</button>
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
		if(isset($_POST['add_banner']))
		{
			
			
			$okey = $_POST['status'];
			
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
			
   
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				


  $table="tbl_banner";
  $field_values=array("img","status");
  $data_values=array("$target_file","$okey");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Banner Add Successfully!!',
    message: ' Banner Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="add_banner.php"},3000);
	 </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_banner']))
		{
			
			
			$okey = $_POST['status'];
			$target_dir = "images/banner/";
			$temp = explode(".", $_FILES["cat_img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . basename($newfilename);
			
	if($_FILES["cat_img"]["name"] != '')
	{		
    
			
		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
				 
$table="tbl_banner";
  $field = array('status'=>$okey,'img'=>$target_file);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
	  
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Banner Section!!',
    message: ' Banner Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_banner.php"},3000);
  
  </script>
  
  
<?php 
}

	}
	else 
	{
		
		$table="tbl_banner";
  $field = array('cat_status'=>$okey);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Banner Section!!',
    message: ' Banner Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_banner.php"},3000);
  
  </script>
  
<?php 
}


	}
		}
		?>
    </body>



</html>