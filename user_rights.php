<? ob_start();//Start buffer output ?>
<?php

session_start();
$user_name=$_SESSION['user'];
if (!$_SESSION['user']) {
        header('Location:index.php');
}
include 'connection.php';
include 'functions.php';
include 'ajax.php';
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
                                <i class="fa fa-users"></i>User Rights<br /><small>Your Can Assign Rights to the Users</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li>User</li>
                        <li><a href="">Rights</a></li>
                    </ul>

<div class="col-md-12">
                            <!-- Form Validation Example Block -->
                            <div class="block">
                                <!-- Form Validation Example Title -->
                                <div class="block-title">
                                    <h2><strong>Users Rights</strong> </h2>
									
                                </div>
                               <div class="clearfix"></div><br>
<?php 
if (isset($_POST['posted'])){
	
	$userid=$_POST['user'];
	$search=$_POST['search'];
	$report=$_POST['report'];
	
	$del = mysql_query("update users set search='$search', reports='$report' where username='$userid'") or die (mysql_error());
	
	if($del){echo '<div class="alert alert-success">User Rights have been updated</div>';}
	
	
}

?>

                                <!-- Form Validation Example Content -->
	<form action="user_rights" method="post">
	<div class="col-sm-2">
<select name="type"  onchange="showUser(this.value)" class="form-control">
<option value="">Select</option>
<?php $deptss=mysql_query("select distinct dept from users ");
while ($deptr=mysql_fetch_array($deptss)){
?>
  
  <option value="<?php echo $deptr['dept'];?>"><?php echo $deptr['dept'];?></option>
<?php }?>

  </select>
  </div>
                    <div class="col-sm-2"><div id="txtHint"></div></div>
					<div class="col-sm-2"><div id="txtHint1"></div></div>
					<div class="clearfix"></div><br>
					<div class="col-sm-2"><div id="txtHint2"></div></div>
					<div class="clearfix"></div>
					<br>
					<input type="hidden" name="posted" />
					<input type="submit" name="submit" class="btn btn-primary">
					
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