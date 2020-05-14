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
									
									<p> <!-- END Form Validation Example Title --> 
			<form action="assign_appr" method="post">
			<div class="form-group">
                                            
                                            <div class="col-sm-3">
                                                <div class="input-group"><br>
                                                    Select Department <select id="val_skill" name="deptt" class="form-control" onChange="this.form.submit();">
                                                    <option value="">Please select</option>
													<option value="all">All</option>
                                                   <?php 
												   $getapp=mysql_query("select * from users where type='Requester' and status=0");
												   while($appl=mysql_fetch_array($getapp)){?>
												<option value="<?php echo $appl['dept'];?>"><?php echo $appl['dept'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
			</form></p>
                                </div>
                               <div class="clearfix"></div><br>
<?php 
if (isset($_POST['delete'])){
	
	$userid=$_POST['delete'];
	
	
	$del = mysql_query("update users set status=1 where user_id=$userid");
	
	if($del){echo '<div class="alert alert-success">User Has Been Deleted</div>';}
	
	
}
if (isset($_POST['checkbox'])) {
	$userid=$_POST['checkbox'];
	$appr=$_POST['appr1'];
	foreach($userid as $id){
		
		$update=mysql_query("update users set approver='$appr' where user_id='$id'");
	}
	echo '<div class="alert alert-success">Approver Assigned Succesfully</div>';
}

?>

                                <!-- Form Validation Example Content -->
                             <form action="assign_appr" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                      <th width="10" class="text-center"><input type="checkbox"></th>
                                        <th width="20" class="text-center">User ID</th>
                                        <th width="10">User Name</th>
                                        <th width="80">Email</th>
                                        <th width="30">Department</th>
                                        
                                        <th width="20" class="text-center">Designation</th>
                                        <th width="20">Approver</th>
                                          <th width="20" class="text-center">Status</th>
                                        <th width="20" class="text-center">Type</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                          <?php 
						  if(isset($_POST['deptt'])){
						  $deptt=$_POST['deptt'];
						  if($deptt=='all'){$getu=mysql_query("select * from users where type='requester' and status=0");}else {
						 $getu=mysql_query("select * from users where dept='$deptt' and type='requester' and status=0");
						  }
						  }
						  else {
						  $getu=mysql_query("select * from users where type='requester' and status=0 ");
						  }
						  while($row=mysql_fetch_array($getu)){
							  
						  ?>
                                    <tr class="tr1">
                                      <td class="text-center">
										<input type="checkbox" id="select" name="checkbox[]" value="<?php echo $row['user_id'];?>">
										  </td>
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['dept'];?></td>
                                                                             
                                        <td class="text-center"><?php echo $row['desig'];?></td>
                                        <td class="text-center"><?php echo $row['approver'];?></td>
                                        <td class="text-center"><?php if($row['status']==0){echo 'Active';}else {echo 'De-Activate';}?></td>
                                        <td class="text-center"><?php echo $row['type'];?></td>
                                        
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
							<br>
							
							
                                                    <select id="val_skill" name="appr1" class="form-control">
                                                    <option value="">Please select</option>
                                                   <?php 
												   $getapp=mysql_query("select * from users where type='approver' and status=0");
												   while($appl=mysql_fetch_array($getapp)){?>
												<option value="<?php echo $appl['username'];?>"><?php echo $appl['username'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>
                                                    <input type="submit" name"assign" value="Assign" class="form-control btn-primary" onclick="return confirm(&quot;You're really sure want to assign Approver to these Users ?&quot;)">
							</form>
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