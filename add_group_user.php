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
                                <i class="fa fa-users"></i>Add User in a Group<br /><small>List of All Users</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Users</li>
                        <li><a href="">List</a></li>
                    </ul>
<?php
if($_GET['status']=='sub'){
	 $deptt=$_GET['deptt'];
     $deptt1=$_GET['deptt1'];
	 $user_id=$_GET['user_id'];
	 $group=$_GET['id'];
	 $username=$_GET['username'];

$check=mysql_query("select * from $group where username='$username' and dept='$deptt1'");	 
	 $num=mysql_num_rows($check);
	 if ($num>=1){echo '<script>alert ("User Alaready in the Group");</script>';}else {
$ins=mysql_query("insert into $group (user_id,username,dept) values ('$user_id','$username','$deptt1')") or die (mysql_error());
if ($ins){echo '<div class="alert alert-success">User has been added</div>';}	
	}

}

?>
<div class="col-md-12">
                            <!-- Form Validation Example Block -->
                            <div class="block">
                                <!-- Form Validation Example Title -->
                                <div class="block-title">
                                    <h2><strong>List of All Users</strong> </h2>
									
									<p> <!-- END Form Validation Example Title --> 
			<form action="add_group_user" method="get">
			<div class="form-group">
                                            
                                            <div class="col-sm-3">
                                                <div class="input-group"><br>
                                                    <select id="val_skill" name="deptt" class="form-control" onChange="this.form.submit();">
                                                    <option value="">Please select</option>
													<option value="all">All</option>
                                                   <?php 
												   $getapp=mysql_query("select distinct dept from users where admin<>1");
												   while($appl=mysql_fetch_array($getapp)){?>
												<option value="<?php echo $appl['dept'];?>" <?php if($_GET['deptt']==$appl['dept']){echo 'selected=selected';}?>><?php echo $appl['dept'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>
                                                    
                                                </div>
                                            </div>
                                      <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">	
										<input type="hidden" name="deptt1" value="<?php echo $_GET['deptt1'];?>">										  
										  </div>
			</form></p>
                                </div>
                               <div class="clearfix"></div><br>

                                <!-- Form Validation Example Content -->
                             <form id="ss" action="" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>All Requesters</td>
								</tr>
                                    <tr>
                                        <th width="20" class="text-center">User ID</th>
                                        <th width="10">User Name</th>
                                        <th width="30">Department</th>
                                        <th width="20">Action</th>
                                         
                                        
                                    </tr>
                                </thead>
                                <tbody>
                          <?php 
						  if(isset($_GET['deptt'])){
						  $deptt=$_GET['deptt'];
						  if($deptt=='all'){echo '';}else {
							  
						 $getu=mysql_query("select * from users where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
										<input type="hidden" name="posted">
										<input type="hidden" name="deptt" value="<?php echo $_GET['deptt'];?>">
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
										
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center"><a href="add_group_user?user_id=<?php echo $row['user_id'];?>&id=<?php echo $_GET['id'];?>&deptt=<?php echo $_GET['deptt'];?>&status=sub&username=<?php echo $row['username'];?>&deptt1=<?php echo $_GET['deptt1'];?>" class="btn btn-success btn-xs"><i class="gi gi-plus"></i></a>
							
							</form>
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
                                </tbody>
                            </table>
							<br>
							
							
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


<div id="adduser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                            <fieldset>
                                <legend>Vital Info</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Username</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static"><?php echo $user_name ;?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" id="user-settings-email" name="uemail" class="form-control" value="<?php echo $data['email'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                                    <div class="col-md-8">
                                        <label class="switch switch-primary">
                                            <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
								
								
                            </fieldset>
                            <fieldset>
                                <legend>Password Update</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-password" name="upassword" class="form-control" value="<?php echo $data['password'];?>" placeholder="Please choose a complex one..">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                                    <div class="col-md-8">
                                        <input type="password" id="user-settings-repassword" name="cpassword" class="form-control" value="<?php echo $data['password'];?>" placeholder="..and confirm it!">
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group form-actions">
                                <div class="col-xs-12 text-right">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
									<input type="hidden" name="profile" />
                                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
        </div>
<?php include 'footer.php';?>
<script src="js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>