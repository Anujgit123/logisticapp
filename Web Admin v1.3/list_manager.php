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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
									<table id="datatable" class="table  dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
												<th>Zone Manager Name</th>
                                                <th>Zone Manager Image</th>
												  <th>Assign Zone Manager</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
										$city = $lundry->query("select * from tbl_manager");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="align-middle">
                                                   <?php echo $row['name']; ?>
                                                </td>
												
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="60" />
                                                </td>
                                                <td class="align-middle">
                                                   <?php $zonedata = $lundry->query("select title from zones where id=".$row['zone_id']."")->fetch_assoc(); echo $zonedata['title']; ?>
                                                </td>
                                               
				 
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge rounded-pill bg-success font-size-12">Current Active</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge rounded-pill bg-danger font-size-12">Current Deactive</span></td>
												<?php } ?>
												
                                                <td><a href="add_manager.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-edit"></i></a>
												
												</td>
												
												</td>
                                                </tr>
											<?php 
										}
										?>
                                            </tbody>
                                        
                                    </table>
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
	   
	  
	
    </body>



</html>