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
<?php if($_GET['status']=='del'){
	 $user_id=$_GET['id'];
	 $username=$_GET['username'];
	 $group=$_GET['group'];
	$delet=mysql_query("delete from $group where username='$username' and user_id='$user_id'") or die (mysql_error());
	if ($delet){echo '<div class="alert alert-success">User is Removed from this Group</div>';}
}

?>
                            <!-- Form Validation Example Block -->
                            <div class="block">
                                <!-- Form Validation Example Title -->
                                <div class="block-title">
                                    <h2><strong>List of All Approvers</strong> </h2>
									
									<p> <!-- END Form Validation Example Title --> 
			<form action="dept_detail" method="get">
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
                                        </div>
			</form></p>
                                </div>
                               <div class="clearfix"></div><br>

                                <!-- Form Validation Example Content -->
                             <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Approvers Group - 
								<a onclick="return popitup('add_group_user?id=approvers&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=approvers&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from approvers where dept='$deptt'");
						 
						  }
						  
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=approvers&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Director Group - 
								<a onclick="return popitup('add_group_user?id=group_directors&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=group_directors&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from group_directors where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=group_directors&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Accountant Group - 
								<a onclick="return popitup('add_group_user?id=accountants&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=accountants&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from accountants where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=accountants&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Sr Accountant Group - 
								<a onclick="return popitup('add_group_user?id=sr_accountant&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=sr_accountant&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from sr_accountant where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=sr_accountant&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Cheif Accountant Group - 
								<a onclick="return popitup('add_group_user?id=ca&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=ca&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from ca where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=ca&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Teller Group - 
								<a onclick="return popitup('add_group_user?id=teller&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=teller&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from teller where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=teller&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
							
							<!--  *---------------------------------------->
							<div class="col-sm-12" style="margin-top:15px; margin-bottom:15px;"><div align="center"><i class="hi hi-arrow-down fa-4x" style="color:#394263;"></i></div></div>
							 <form action="dept_detail?deptt=$_GET['deptt']" method="post">   
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
								<tr><td colspan="4"><h4><b>Book Keeper Group - 
								<a onclick="return popitup('add_group_user?id=bk&deptt1=<?php echo $_GET['deptt'];?>')" href="add_group_user?id=bk&deptt1=<?php echo $_GET['deptt'];?>"> <i class="gi gi-user_add"></i></a></td>
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
							  
						 $getu=mysql_query("select * from bk where dept='$deptt'");
						 
						  }
						  }
						  while($row=mysql_fetch_array($getu)){
							
						  ?>
                                    <tr class="tr1">
                                      
                                        <td class="text-center"><?php echo $row['user_id'];?></td>
                                        <td class="text-center"><?php echo $row['username'];?>
										
										</td>
                                        <td class="text-center"><?php echo $row['dept'];?></td>
						  <td class="text-center">
						  
						  <a href="edit_user?id=<?php echo $row['user_id'];?>" class="btn btn-primary btn-xs"><i class="gi gi-pencil"></i></a>
						<a href="dept_detail?id=<?php echo $row['user_id'];?>&status=del&username=<?php echo $row['username'];?>&group=bk&deptt=<?php echo $deptt;?>" class="btn btn-danger btn-xs"><i class="hi hi-remove"></i></a>			
										
										</td>
                                        
                                   
                                        
                                    </tr>


                                    <?php }?>
									
									
									
									
									
									
                                </tbody>
                            </table>
							<br>
							<input type="hidden" name="posted">
							</form>
						  <?php } ?>
							
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
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=700,width=700,left=600,top=150');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
<?php include 'footer.php';?>
<script src="js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>