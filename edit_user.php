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



 <div id="page-content">
                    <!-- Validation Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="gi gi-warning_sign"></i>Add Users<br /><small>Add New Users</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Add</li>
                        <li><a href="">Users</a></li>
                    </ul>

<div class="col-md-12">
                            <!-- Form Validation Example Block -->
                            <div class="block">
                                <!-- Form Validation Example Title -->
                                <div class="block-title">
                                    <h2><strong>Add New User</strong> </h2>
                                </div>
                                <!-- END Form Validation Example Title -->
<?php 
$userid=$_GET['id'];
$getdata=mysql_query("select * from users where user_id=$userid");
$row=mysql_fetch_array($getdata);


if(isset($_POST['addusers'])){
	
	$userid=$_POST['userid'];
	$username=$_POST['val_username'];
	$email=$_POST['val_email'];
	$pass1=$_POST['val_password'];
	$pass2=$_POST['val_confirm_password'];
	$dept=$_POST['dept'];
	$desig=$_POST['desig'];
	$type=$_POST['type'];
	$status=0;
	$appr=$_POST['appr'];
	$admin=$_POST['admin'];
	
	$insert=mysql_query("update users set username='$username',desig='$desig',dept='$dept',email='$email',approver='$appr',status=0,type='$type', admin='$admin' where user_id=$userid") or die (mysql_error());

		
	if($insert){echo '<div class="alert alert-success"> User Information Succefully Updated</div>';}
	
	//echo '<meta HTTP-EQUIV="REFRESH" content="1; url=users_list">';
	
	
}

?>
                                <!-- Form Validation Example Content -->
                                <form id="form-validation" action="edit_user?id=<?php echo $userid;?>" method="post" class="form-horizontal form-bordered">
                                    <fieldset>
                                        <legend><i class="fa fa-angle-right"></i> Basic Info</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_username">User ID <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_username" name="userid" class="form-control" placeholder="User ID" value="<?php echo $row['user_id'];?>" readonly="readonly" required>
                                                    <span class="input-group-addon"><i class="fa fa-gear"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_username">Username <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" value="<?php echo $row['username'];?>" id="val_username" name="val_username" class="form-control" placeholder="Your username..">
                                                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_email">Email <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" value="<?php echo $row['email'];?>" id="val_email" name="val_email" class="form-control" placeholder="test@example.com">
                                                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                                </div>
                                            </div>
                                        </div>
										
										
                                        
                                    </fieldset>
                                    <fieldset>
                                        <legend><i class="fa fa-angle-right"></i> Work Information </legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_skill">Department <span class="text-danger"></span></label>
                                            <div class="col-md-6">
                                                <select id="val_skill" name="dept" class="form-control">
                                                    <option value="">Please select</option>
													<option value="Legal" <?php if($row['dept']=='Legal'){echo 'selected=selected';}?>>Legal</option>
													<option value="IT" <?php if($row['dept']=='IT'){echo 'selected=selected';}?>>IT</option>
                                                    <option value="Finance" <?php if($row['dept']=='Finance'){echo 'selected=selected';}?>>Finance</option>
                                                    <option value="IPS" <?php if($row['dept']=='IPS'){echo 'selected="selected"';}?>>IPS</option>
													<option value="Engineering" <?php if($row['dept']=='Engineering'){echo 'selected="selected"';}?>>Engineering</option>
													<option value="Drexel" <?php if($row['dept']=='Drexel'){echo 'selected="selected"';}?>>Drexel</option>
													<option value="Giffin" <?php if($row['dept']=='Giffin'){echo 'selected="selected"';}?>>Giffin</option>
													<option value="Civic" <?php if($row['dept']=='Civic'){echo 'selected="selected"';}?>>Civic</option>
                                                    <option value="HR" <?php if($row['dept']=='HR'){echo 'selected="selected"';}?>>HR</option>
                                                    <option value="Administration" <?php if($row['dept']=='Administration'){echo 'selected="selected"';}?>>Administration</option>
                                                    <option value="Procurment" <?php if($row['dept']=='Procurment'){echo 'selected="selected"';}?>>Procurment</option>
													<option value="Office_Management" <?php if($row['dept']=='Office_Management'){echo 'selected="selected"';}?>>Office Management</option>
													<option value="Family" <?php if($row['dept']=='Family'){echo 'selected="selected"';}?>>Family</option>
													
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_website">Designation <span class="text-danger"></span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_website" name="desig" class="form-control" value="<?php echo $row['desig'];?>">
                                                    <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        
										
										
										
										
										<div class="form-group">
                                            <label class="col-md-4 control-label" for="val_credit_card">Admin Status <span class="text-danger"></span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                           <label class="switch switch-primary"><input type="checkbox" name="admin" value="1" <?php  if($row['admin']==1){echo 'checked=checked';} ?>><span></span></label>
                                                    
                                                </div>
                                            </div>
                                        </div>
										
										
										
                                    </fieldset>
                                    
                                    <div class="form-group form-actions">
                                        <div class="col-md-8 col-md-offset-4">
                                        <input type="hidden" name="addusers" />
                                            <button  type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Update User</button>
                                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                        </div>
                                    </div>
                                </form>
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