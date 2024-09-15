<?php 
require 'include/lanconfig.php';
$cat_id = $_POST['cat_id'];
?>
<option value="" selected disabled>Select Sub Category</option>
<?php 
											$cat = $lundry->query("select * from tbl_subcat where cat_id=".$cat_id."");
											while($row = $cat->fetch_assoc())
											{
												?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
												<?php 
											}
											?>