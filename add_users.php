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
<?php include 'header.php';
$maxid1=mysql_query("select max(user_id) as max from users");
$mr=mysql_fetch_array($maxid1);
$maxid=$mr['max']+1;
?>



 <div id="page-content">
                    <!-- Validation Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                               <i class="fa fa-user"></i> Add Users<br /><small>Add New Users</small>
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
	$selectu=mysql_query("select * from users where user_id='$userid'");
	if(mysql_num_rows($selectu)>=1){
		
		echo '<div class="alert alert-danger">User ID is Already Exists, Try Different Username</div>';
	}
	else{
	$insert=mysql_query("insert into users (id,user_id,username,password,desig,dept,email,approver,status,type,admin) values
	('','$userid','$username','$pass1','$desig','$dept','$email','$appr','0','$type','$admin')
	");
	
	$insert1=mysql_query("insert into $dept (id,user_id,username,password,desig,dept,email,approver,status,type,admin) values
											('','$userid','$username','$pass1','$desig','$dept','$email','$appr','0','$type','$admin')
	");
	
	if($insert){echo '<div class="alert alert-success">New User Succefully Created</div>';}
	
	}
	
	
}

?>
                                <!-- Form Validation Example Content -->
                                <form id="form-validation" action="add_users" method="post" class="form-horizontal form-bordered">
                                    <fieldset>
                                        <legend><i class="fa fa-angle-right"></i> Basic Info</legend>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_username">User ID <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_username" name="userid" class="form-control" placeholder="User ID" value="<?php echo $maxid;?>" readonly>
                                                    <span class="input-group-addon"><i class="fa fa-gear"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_username">Username <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_username" name="val_username" class="form-control" placeholder="Your username..">
                                                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_email">Email <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_email" name="val_email" class="form-control" placeholder="test@example.com">
                                                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_password">Password <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="password" id="val_password" name="val_password" class="form-control" placeholder="Choose a crazy one..">
                                                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="password" id="val_confirm_password" name="val_confirm_password" class="form-control" placeholder="..and confirm it!">
                                                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
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
                                                    <option value="Legal">Legal</option>
                                                    <option value="IT">IT</option>
                                                    <option value="Finance">Finance</option>
                                                    <option value="IPS">IPS</option>
                                                    <option value="Engineering">Engineering</option>
													<option value="Drexel">Drexel</option>
													<option value="Giffin">Giffin</option>
													<option value="Civic">Civic</option>
													<option value="HR">HR</option>
													<option value="Administration">Administration</option>
													<option value="Procurment">Procurment</option>
													<option value="HR">HR</option>
													<option value="Office_Management">Office Management</option>
													<option value="Family">Family</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="val_website">Designation <span class="text-danger"></span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="val_website" name="desig" class="form-control" value="">
                                                    <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                       
										
										
										
										
										
					
										
										
										
										
										<div class="form-group">
                                            <label class="col-md-4 control-label" for="val_credit_card">Admin Status <span class="text-danger"></span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                           <label class="switch switch-primary"><input type="checkbox" name="admin" value="1"><span></span></label>
                                                    
                                                </div>
                                            </div>
                                        </div>
										
                                    </fieldset>
                                    
                                    <div class="form-group form-actions">
                                        <div class="col-md-8 col-md-offset-4">
                                        <input type="hidden" name="addusers" />
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Add User</button>
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

