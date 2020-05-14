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
include 'ajax.php';
?>
<?php include 'header.php';?>

                <!-- Page content -->
                <div id="page-content">
                    <!-- Datatables Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="fa fa-table"></i>Approvals<br><small>Requests Need to Approve by You</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Dashboard</a></li>
                        <li>Approvals</li>
                    </ul>
                    <!-- END Datatables Header -->
                                
								<?php 
								
								 $approvrget=approver($user_name);
							 $approvr=$approvrget['approver'];
							 $req_dept=$approvrget['dept'];
							 
							 
								?>

                            
                    <!-- Datatables Content -->
                    <div class="block full">
                        <div class="block-title">
                            <h2><strong>Requests</strong> Pending for Approvals</h2>

                        </div>
						<form action="search" method="get" >
                       <div class="col-sm-1"><input type="text" name="refno" placeholder="Ref #" class="form-control" value="<?php echo $_GET['refno'];?>" /></div>
					   
					   <div class="col-sm-1">
					   <select id="val_skill" name="dept" class="form-control" onchange="showUser1(this.value)">
                                                    <option value="">Please select</option>
                                                   <?php 
												   
												   $getdept=mysql_query("select distinct dept from users where status=0 and dept<>''") or dier (mysql_error());
												   while($appl=mysql_fetch_array($getdept)){?>
												<option value="<?php echo $appl['dept'];?>" <?php if($appl['dept']==$_GET['dept']){echo 'selected="selected"';} ;?>><?php echo $appl['dept'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>
					   </div>
					   
					   
                       <div class="col-sm-1"><div id="txtHint1"><select id="val_skill" name="user" class="form-control">
                                                    <option value="">Please select</option>
                                                   <?php 
												   if(!empty($_GET['dept'])){
													   $dept=$_GET['dept'];
												   $getdept=mysql_query("select * from users where status=0 and dept='$dept'") or dier (mysql_error());
												   while($appl=mysql_fetch_array($getdept)){?>
												<option value="<?php echo $appl['user_id'];?>" <?php if($appl['user_id']==$_GET['user']){echo 'selected="selected"';} ;?>><?php echo $appl['username'];?></option>
												<?php 	   
												   }
												   }
												   ?>
                                                   
                                                </select></div></div>
					   
					   
                                  
  
  
                        <div class="col-sm-2">
  <select name="searchstatus" id="select" class="form-control" class="form-control">
  <option value="all">Status</option>
  <option <?php if($_GET['searchstatus']=='Requested') {echo "selected=='selected'";}?>>Requested</option>
    <option <?php if($_GET['searchstatus']=='Approved') {echo "selected='selected'";}?>>Approved</option>
    <option value="return_back" <?php if($_GET['searchstatus']=='return_back') {echo "selected='selected'";}?>>Return Back</option>
    <option <?php if($_GET['searchstatus']=='On-Hold') {echo "selected=='selected'";}?>>On-Hold</option>
    <option <?php if($_GET['searchstatus']=='Rejected') {echo "selected=='selected'";}?>>Rejected</option>
  </select>
  </div>
                        
                        <div class="col-sm-2"><input type="date" name="fdate" class="form-control" value="<?php echo $_GET['fdate'];?>" />  </div>
                        <div class="col-sm-2"><input type="date" name="tdate" class="form-control" value="<?php echo $_GET['tdate'];?>"/></div>
						<input type="hidden" name="search">
                        <div class="col-sm-1"><button class="btn btn-default"><i class="fa fa-search"></i></button></div>
             <div class="clearfix"></div>           
               </form>         
  <br />
  
  
  <div class="table-responsive">
                        
  
                        <form action="approv" method="post">
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                      <th width="20" class="text-center"><input type="checkbox"></th>
                                        <th width="20" class="text-center">Ref #</th>
                                        <th width="10">Requested User</th>
                                        <th width="80">Descriptions</th>
                                        <th width="30">Form Name</th>
                                        
                                        <th width="20" class="text-center">Last Activity</th>
                                        <th width="20">Status</th>
                                          <th width="20" class="text-center">Last Actvity Date</th>
                                        <th width="170" class="text-center">Last Note</th>
                                        <th width="10" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
								if(isset($_GET['search'])){
									$s_ref=$_GET['refno'];
								
									$s_formn=$_POST['formname'];
									$s_searchstatus=$_GET['searchstatus'];
									$s_fdate=$_GET['fdate'];
									$s_tdate=$_GET['tdate'];
									$s_user=$_GET['user'];
									$s_dept=$_GET['dept'];
									$get_name=get_username($s_user);
									
									
									if(!empty($s_ref)){
										
									$refno=" and ref=".$s_ref;
									}
									
									if(!empty($s_fdate)){
										
									$fdate=" and entry_date>='".$s_fdate."'";
									$fdate1= " and last_activity_date>='".$s_fdate."'";
									}
									
									if(!empty($s_tdate)){
										
									$tdate=" and entry_date<='".$s_tdate."'";
									$tdate1= " and last_activity_date<='".$s_tdate."'";
									}
									
									if(!empty($s_fdate) and !empty($s_tdate)){
										
									$bdate1=" and entry_date between '".$s_fdate."' and '".$s_tdate."'";
									 $bdate2= " and last_activity_date between '".$s_fdate."' and '".$s_tdate."'";
									}
									
									if(!empty($s_user))
									{
										$username=" and username='".$get_name."'";
										$username1=" and requester='".$get_name."'";
										$username2=" and requester='".$get_name."' or approver='".$get_name."' or last_activity_user='".$get_name."'";
									}				

									if(!empty($s_dept)){
										
										$sdept=" and dept='".$_GET['dept']."'";
										$sdept1=" and req_dept='".$_GET['dept']."'";
									}
									
									if(!empty($s_searchstatus)){
									
									if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select * from approves where a_status=0 $sdept $username $refno $fdate $tdate $bdate1 group by ref") or die (mysql_error());
									}
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select * from sent_back where s_status=0 $sdept $username $refno $fdate $tdate $bdate1 group by ref") or die (mysql_error());
									}
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select * from on_hold where h_status=0 $sdept $username $refno $fdate $tdate $bdate1 group by ref") or die (mysql_error());
									}
									
									if($s_searchstatus=='Requested'){
									$ret_list=mysql_query("select * from transactions where t_status<>'' $sdept1 $username1 $refno $fdate1 $tdate1 $bdate2") or die (mysql_error());
									}
									
									if($s_searchstatus=='all'){
									$ret_list=mysql_query("select * from transactions where t_status<>'3' $sdept1 $username2 $refno $fdate1 $tdate1 $bdate2") or die (mysql_error());
									}
									
									
									}
									
									
									
									//echo "select * from transactions where t_status<>'' $sdept1 $username2 $refno $fdate1 $tdate1 $bdate2";

										$num=mysql_num_rows($ret_list);
                                while($approv_r=mysql_fetch_array($ret_list)){
                                    $ref=$approv_r['ref'];
                                    $reqr=$approv_r['requester'];
                                    $r_formd=getform_data($ref);
                                    $last_act=last_activity($ref);
									$l_note=last_notes($ref);
                                    $napp=$last_act['next_approver'];
									$napp_s=$last_act['next_approver_status'];
                                ?>
                                    <tr>
                                      <td class="text-center"><?php if($last_act['status']=='Requested' or $last_act['accountant']==$user_name or $napp==$user_name and $napp_s<>1){?><input type="checkbox" id="select" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" /><?php } else {?><input type="checkbox" id="select" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" disabled="disabled"/><?php }?></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $ref;?></a></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $last_act['requester'];?></a></td>
                                        <td><?php echo custom_echo($r_formd['description'],200);?></td>
                                        <td><?php echo $r_formd['form_name'];?></td>
                                                                             
                                        <td class="text-center"><?php echo $last_act['last_activity_user'];?></td>
                                        <td class="text-center"><?php 
                                        if($last_act['status']=='Requested'){echo '<i class="fa fa-hand-o-up fa-2x text-primary"></i>';}
                                        if($last_act['status']=='approved'){echo '<i class="fa fa-check fa-2x text-success"></i>';}
                                        if($last_act['status']=='on-hold'){echo '<i class="fa fa-pause fa-2x text-info"></i>';}
                                        if($last_act['status']=='reject'){echo '<i class="fa fa-times fa-2x text-danger"></i>';}
                                        if ($last_act['status']=='return_back'){echo '<i class="fa fa-reply fa-2x text-warning"></i>';}     
                                        
                                        ;?></td>
                                        <td class="text-center"><?php echo $last_act['last_activity_date'].' - '.$last_act['last_activity_time'];?></td>
                                        <td class="text-center"><?php echo custom_echo($l_note['notes'],100);?><br>
										<?php $geta=last_attachments($ref);
											echo 'Attachment: <a href="uploads/'.$geta['filename'].'">'.$geta['filename'].'</a>';
											
										?>
										</td>
                                        <td class="text-center">
                                                    <?php 
													if (!empty($last_act['status'])){
                                                
                                             if($last_act['status']=='approved' and $last_act['final_status']=='Resubmit' ){
								
										echo '<a href="javascript:void(0)"  class="btn btn-xs btn-success"><i class="fa fa-check-square-o"></i>'.$last_act['last_activity_user'].' '.$last_act['final_status'].' </a><div class="clearfix"></div>';}else{
											
										echo '<a href="javascript:void(0)"  class="btn btn-xs btn-success"><i class="fa fa-check-square-o"></i>'.$last_act['last_activity_user'].' '.$last_act['status'].'</a><div class="clearfix"></div>';}
													}
													?>               
                                          </td>
                                    </tr>
								<?php }} ?>
                                </tbody>
                            </table>
                           
</form>
								
							</div>			
  
                        
						</div>
									
						
                      
                    <!-- END Datatables Content -->
                </div>
                <!-- END Page Content -->


            <?php include 'footer.php';?>
