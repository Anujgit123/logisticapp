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
					$data = $lundry->query("select * from tbl_product where id=".$_GET['id']."")->fetch_assoc();
					?>
					<h4 class="card-title mb-4">Edit Product </h4>
					<form method="post" enctype="multipart/form-data">
                                       
									   <div class="form-group">
                                            <label>Select Category</label>
                                            <select class="form-control select2-category" name="cat_id" required="" data-placeholder="Select Category">
											<option value="" selected disabled>Select Category</option>
											<?php 
											$cat = $lundry->query("select * from tbl_pcat");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>" <?php if($data['cat_id']==$row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
												<?php 
											}
											?>
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label>Select SubCategory</label>
                                            <select class="form-control select2-category" name="subcat_id" id="subcat_id" required="" data-placeholder="Select SubCategory">
											<option value="" selected disabled>Select Product</option>
											<?php 
											$cat = $lundry->query("select * from tbl_subcat where cat_id=".$data['cat_id']."");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>" <?php if($data['subcat_id']==$row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
												<?php 
											}
											?>
											</select>
                                        </div>
										
									   <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Product Name" value="<?php echo $data['title'];?>" name="cname" required="">
                                        </div>
										
										<div class="form-group">
                                            <label>Product Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Product Price" name="price" value="<?php echo $data['price'];?>" required="">
                                        </div>
                                      
										<div class="form-group">
                                            <label>Product Status</label>
                                            <select name="status" class="form-control" required>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="edit_cat" class="btn btn-primary mb-2">Update Product</button>
                                            </div>
                                    </form>
				<?php } else { ?>
									<h4 class="card-title mb-4">Add Product </h4>
                        <!-- start page title -->
                    <form method="post" enctype="multipart/form-data">
                                       
									   
									    <div class="form-group">
                                            <label>Select Category</label>
                                            <select class="form-control select2-category" name="cat_id" id="cat_id" required="" data-placeholder="Select Category">
											<option value="" selected disabled>Select Category</option>
											<?php 
											$cat = $lundry->query("select * from tbl_pcat");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
												<?php 
											}
											?>
											</select>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Select SubCategory</label>
                                            <select class="form-control select2-category" name="subcat_id" id="subcat_id" required="" data-placeholder="Select SubCategory">
											<option value="" selected disabled>Select SubCategory</option>
											
											</select>
                                        </div>
										
										
									   <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Product Name" name="cname" required="">
                                        </div>
										
										 <div class="form-group">
                                            <label>Product Price</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Product Price" name="price" required="">
                                        </div>
										
                                     
										
										<div class="form-group">
                                            <label>Product Status</label>
                                            <select name="status" class="form-control" required="">
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
										<div class="col-12">
                                                <button type="submit" name="add_cat" class="btn btn-primary mb-2">Add Product</button>
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
		if(isset($_POST['add_cat']))
		{
			
			$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
			$okey = $_POST['status'];
			$cat_id = $_POST['cat_id'];
			$subcat_id = $_POST['subcat_id'];
			$price = $_POST['price'];
			
			
				


  $table="tbl_product";
  $field_values=array("title","status","cat_id","price","subcat_id");
  $data_values=array("$cname","$okey","$cat_id","$price","$subcat_id");
  
$h = new Laundrore();
	  $check = $h->lundryinsertdata($field_values,$data_values,$table);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Product Add Successfully!!',
    message: 'Product Section!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="add_product.php"},3000);
	 </script>
  
<?php 
}

		}
		?>
		
		<?php 
		if(isset($_POST['edit_cat']))
		{
			
			$cname = mysqli_real_escape_string($lundry,$_POST['cname']);
			$okey = $_POST['status'];
			$cat_id = $_POST['cat_id'];
			$subcat_id = $_POST['subcat_id'];
			$price = $_POST['price'];
			
			
		$table="tbl_product";
  $field = array('title'=>$cname,'status'=>$okey,'cat_id'=>$cat_id,'subcat_id'=>$subcat_id,'price'=>$price);
  $where = "where id=".$_GET['id']."";
$h = new Laundrore();
	  $check = $h->lundryupdateData($field,$table,$where);
if($check == 1)
{
?>
<script>
 iziToast.success({
    title: ' Product Section!!',
    message: 'Product Update Successfully!!',
    position: 'topRight'
  });
				 setTimeout(function(){ 
	 window.location.href="list_product.php"},3000);
  
  </script>
  
<?php 
}


	
		}
		?>
    </body>



</html>