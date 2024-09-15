 <?php 

if(isset($_SESSION['login_session']))
	{
		if($_SESSION['login_session'] == 'admin')
		{
		?>
 <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Analytics</li>

                            
							
							<li>
                                <a href="dashboard.php" class="waves-effect">
                                    <i class="fa fa-home"></i>
                                    <span key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
							
							
	<li class="menu-title" key="t-menu">Order Section</li>
	<li>
                               
                                    <li><a href="pending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="process.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="onroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="complete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="cancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							
							
							
							
							<li class="menu-title" key="t-menu">PACKER & MOVERS  Section</li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa fa-list"></i>
                                    <span key="t-Delivery">Category</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_pcat.php" key="t-add_pcat">Add Category</a></li>
                                    <li><a href="list_pcat.php" key="t-list_pcat">List Category</a></li>
                                    
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa fa-list"></i>
                                    <span key="t-Delivery">Sub Category</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_subcat.php" key="t-add_subcat">Add Sub Category</a></li>
                                    <li><a href="list_subcat.php" key="t-list_subcat">List Sub Category</a></li>
                                    
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa fa-list"></i>
                                    <span key="t-Delivery">Product</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_product.php" key="t-add_product">Add Product</a></li>
                                    <li><a href="list_product.php" key="t-list_product">List Product</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="menu-title" key="t-menu">Order Flow Section</li>
	<li>
                               
                                    <li><a href="logpending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="logprocess.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="logonroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="logcomplete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="logcancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu">Parcel Order Section</li>
	<li>
                               
                                    <li><a href="parcpending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="parcprocess.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="parconroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="parccomplete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="parccancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu">Delivery Zone</li>

<li>
                                
                                
                                    <li><a href="add_zone.php" key="t-add_banner" class="waves-effect"><i class="fa fa-motorcycle"></i> <span key="t-userlist">Add Delivery Zone</span></a></li>
                                    <li><a href="list_zone.php" key="t-list_banner" class="waves-effect"><i class="fa fa-motorcycle"></i> <span key="t-userlist">List Delivery Zone</span></a></li>
                                    
                                
                            </li>
							
							
							<li class="menu-title" key="t-menu">Delivery Zone Manager</li>

<li>
                                
                                
                                    <li><a href="add_manager.php" key="t-add_banner" class="waves-effect"><i class="fa fa-users"></i> <span key="t-userlist">Add Zone Manager</span></a></li>
                                    <li><a href="list_manager.php" key="t-list_banner" class="waves-effect"><i class="fa fa-users"></i> <span key="t-userlist">List Zone Manager</span></a></li>
                                    
                                
                            </li>
							
                           
						   <li class="menu-title" key="t-menu"> Banner</li>
							<li>
                                
                                
                                    <li><a href="add_banner.php" key="t-add_banner" class="waves-effect"> <i class="fa fa-image"></i> <span key="t-userlist">Add Banner</span></a></li>
                                    <li><a href="list_banner.php" key="t-list_banner" class="waves-effect"><i class="fa fa-image"></i> <span key="t-userlist">List Banner</span></a></li>
                                    
                                
                            </li>
							
							
							<li class="menu-title" key="t-menu"> Category</li>
							<li>
                                
                                
                                    <li><a href="add_cat.php" key="t-add_coupon" class="waves-effect"> <i class="fa fa-list"></i> <span key="t-userlist">Add Category</span></a></li>
                                    <li><a href="list_cat.php" key="t-list_coupon" class="waves-effect"><i class="fa fa-list"></i> <span key="t-userlist">List Category</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu"> Offer</li>
							<li>
                                
                                    <li><a href="add_coupon.php" key="t-add_coupon" class="waves-effect"> <i class="fa fa-percent"></i> <span key="t-userlist">Add Coupon</span></a></li>
                                    <li><a href="list_coupon.php" key="t-list_coupon" class="waves-effect"> <i class="fa fa-percent"></i> <span key="t-userlist">List Coupon</span></a></li>
                                    
                                
                            </li>
							
							
							
							<li class="menu-title" key="t-menu">Country Code</li>
							
							<li>
                                
                                    <li><a href="add_code.php" key="t-add_code" class="waves-effect"> <i class="fa fa-flag"></i> <span key="t-userlist">Add Country Code</span></a></li>
                                    <li><a href="list_code.php" key="t-list_code" class="waves-effect"><i class="fa fa-flag"></i> <span key="t-userlist">List Country Code</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu">Page</li>
							<li>
                                
                                    <li><a href="add_page.php" key="t-add_page" class="waves-effect"><i class="fa fa-plus"></i> <span key="t-userlist">Add Page</span></a></li>
                                    <li><a href="list_page.php" key="t-list_page" class="waves-effect"><i class="fa fa-plus"></i> <span key="t-userlist">List Page</span></a></li>
                                    
                                
                            </li>
							
							
							
							
							
							<li class="menu-title" key="t-menu">Vehicle Type</li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa fa-motorcycle"></i>
                                    <span key="t-Delivery">Vehicle</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_vehi.php" key="t-add_rider">Add Vehicle Type</a></li>
                                    <li><a href="list_vehi.php" key="t-list_rider">List Vehicle Type</a></li>
                                    
                                </ul>
                            </li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa fa-motorcycle"></i>
                                    <span key="t-Delivery">Delivery Boy</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="add_rider.php" key="t-add_rider">Add Delivery Boy</a></li>
                                    <li><a href="list_rider.php" key="t-list_rider">List Delivery Boy</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="menu-title" key="t-menu">Payment & User </li>
							
							<li>
                                <a href="paymentlist.php" class="waves-effect">
                                    <i class="fas fa-bullseye"></i>
                                    <span key="t-paymentlist">Payment List </span>
                                </a>
                            </li>
							
							<li>
                                <a href="userlist.php" class="waves-effect">
                                    <i class="fas fa-users"></i>
                                    <span key="t-userlist">User List</span>
                                </a>
                            </li>
							
							<li class="menu-title" key="t-menu">Payout Delivery Boy </li>
							
							<li>
                                <a href="payoutlist.php" class="waves-effect">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span key="t-userlist">Payout List</span>
                                </a>
                            </li>
                           

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
	<?php } else {?>
	
	<div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                           
							<li class="menu-title" key="t-menu">Analytics</li>

                            
							
							<li>
                                <a href="dashboard.php" class="waves-effect">
                                    <i class="fa fa-home"></i>
                                    <span key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
							
	<li class="menu-title" key="t-menu">Order Section</li>
	<li>
                               
                                    <li><a href="pending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="process.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="onroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="complete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="cancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu">PACKER & MOVERS Order Section</li>
	<li>
                               
                                    <li><a href="logpending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="logprocess.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="logonroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="logcomplete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="logcancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							<li class="menu-title" key="t-menu">Parcel Order Section</li>
	<li>
                               
                                    <li><a href="parcpending.php" key="t-add_rider" class="waves-effect"><i class="fas fa-shopping-cart"></i> <span key="t-dashboard">Pending Order List</span></a></li>
									<li><a href="parcprocess.php" key="t-list_rider" class="waves-effect"><i class="fas fa-cart-arrow-down"></i> <span key="t-dashboard">Process Order List</span></a></li>
									<li><a href="parconroute.php" key="t-list_rider" class="waves-effect"><i class="fas fa-route"></i> <span key="t-dashboard">On Route Order List</span></a></li>
									<li><a href="parccomplete.php" key="t-list_rider" class="waves-effect"><i class="fas fa-check"></i> <span key="t-dashboard">Complete Order List</span></a></li>
                                    <li><a href="parccancle.php" key="t-list_rider" class="waves-effect"><i class="fa fa-times"></i> <span key="t-dashboard">Cancelled Order List</span></a></li>
                                    
                                
                            </li>
							
							
                           

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
	<?php 
	} }?>