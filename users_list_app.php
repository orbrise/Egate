<? ob_start();//Start buffer output ?>
<?php
error_reporting(0);
session_start();
$user_name=$_SESSION['user'];
if (!$_SESSION['user']) {
        header('Location:index.php');
}
include 'connection.php';
include 'functions.php';
?>
<?php include 'header.php';?>

<style>
.tr1:hover{background-color:#F2F2F2;}
</style>

 <div id="page-content">
                    <!-- Validation Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="fa fa-users"></i>All Users<br /><small>List of All Users</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Users</li>
                        <li><a href="">List</a></li>
                    </ul>

<div class="col-md-12">
                            <!-- Form Validation Example Block -->
                            <div class="block">
                                <!-- Form Validation Example Title -->
                                <div class="block-title">
                                    <h2><strong>List of All Users</strong> </h2>
                                </div>
                                <!-- END Form Validation Example Title --> 
<?php 
if (isset($_POST['delete'])){
	
	$userid=$_POST['delete'];
	
	
	$del = mysql_query("update users set status=1 where user_id=$userid");
	
	if($del){echo '<div class="alert alert-success">User Has Been Deleted</div>';}
	
	
}
?>

                                <!-- Form Validation Example Content -->
                                
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                      
                                        <th width="20" class="text-center">User ID</th>
                                        <th width="10">User Name</th>
                                        <th width="80">Email</th>
                                        <th width="30">Department</th>
                                        
                                        <th width="20" class="text-center">Designation</th>
                                        <th width="20">Approver</th>
                                          <th width="20" class="text-center">Status</th>
                                        <th width="20" class="text-center">Type</th>
                                        <th width="170" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                          <?php 
						  $getu=mysql_query("select * from users where type='Approver' and status=0");
						  while($row=mysql_fetch_array($getu)){
							  
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['dept'];?></td>
                                                                             
                                        <td class="text-center"><?php echo $row['desig'];?></td>
                                        <td class="text-center"><?php echo $row['approver'];?></td>
                                        <td class="text-center"><?php if($row['status']==0){echo 'Active';}else {echo 'De-Activate';}?></td>
                                        <td class="text-center"><?php echo $row['type'];?></td>
                                        <td class="text-center">
										<form action="users_list" method="post">
                                                <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a> 
												<button type="submit" value="<?php echo $row['user_id'];?>" name="delete" class="btn btn-danger" onclick="return confirm(&quot;You're really sure want to delete this User ?&quot;)"><i class="fa fa-times"></i> Delete</button>												
                                          </form>
										  </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <div class="text-center">
                            <br />
</div>

                                <!-- END Form Validation Example Content -->

                                <!-- Terms Modal -->
                                
                                <!-- END Terms Modal -->
                            </div>
                            <!-- END Validation Block -->
                        </div>

<div class="clearfix"></div>




</div>



<?php include 'footer.php';?>
<script src="js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>