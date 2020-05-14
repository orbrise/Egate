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
$t=time();
$r=rand();
$filecode=$t.$r;
?>
<?php include 'header.php';?>

                <!-- Page content -->
                <div id="page-content">
                    <!-- Datatables Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="fa fa-table"></i>Requests<br><small>Requests Sent by You</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Dashboard</a></li>
                        <li>Approvals</li>
                    </ul>
                    <!-- END Datatables Header -->
                                
                            <?php 
                            
                            $date=date('Y-m-d');
                            $time=date('h:i:s');
							
							
							
							if (isset($_POST['submitag'])){
                                
								$checked = $_POST['checkbox'];
								foreach ($checked as $key){
									
								$lac=last_activity($key);
                               $req_dept=$lac['req_dept'];
							   $req=$lac['requester'];
							   $css=$lac['current_status'];
							   $ss='Resubmit as - '. $css;
							   $notes1=clean($_POST['notes']);
	  
	  $notescount=strlen($notes1);
	  
							   $uapp=mysql_query("select * from approvers where dept='$req_dept'");
						while ($newapps=mysql_fetch_array($uapp)){$apr_name=$newapps['username'];
							   
	

		  
		  $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	                                ('','$key','$user_name','','$req_dept','$apr_name','','Requested','Resubmit','$user_name','$date','$time','approver')") or die (mysql_error());
									$del=mysql_query("delete from transactions where ref=$key and final_status<>'Resubmit'");
									
	  }
                                if($notescount==0){$notes=$user_name.' Resubmit Request Ref# '.$key;}
							
			  else{ $notes=$notes1;}
			  
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                 ('','$key','$user_name','$notes','$ss','$filecode','$date','$time')
			  ");		
			  
								}
			  
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Requests Has Been Submited! </div>
                            </div>';?>
							
						<?php 
	
							}
							}
							
							
							
							
                            if (isset($_POST['approved'])){
                                $ref1=$_POST['approved'];
                                $get_all=last_activity($ref1);
                                $requester=$get_all['requester'];
                                $approver12=$get_all['approver'];
								$dept1=$get_all['dept'];
								$newapp=approver1($user_name,$dept1);
								$approver=$newapp['approver'];
                                $insert=mysql_query("insert into transactions (id,ref,requester,approver,status,last_activity_user,last_activity_date,last_activity_time) values
                                                                                ('','$ref1','$requester','$approver','approved','$user_name','$date','$time')
                                ");
                                $insertapp=mysql_query("insert into approves (id,ref,username,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$date','$time')
                                ");
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Request# '.$ref1.' Has Been Approved </div>
                            </div>';}
                            }
                            // on hold start function
                            
                             if (isset($_POST['on-hold'])){
                                $ref1=$_POST['on-hold'];
                                $get_all=last_activity($ref1);
                                $requester=$get_all['requester'];
                                $approver12=$get_all['approver'];
								$dept1=$get_all['dept'];
								$newapp=approver1($user_name,$dept1);
								$approver=$newapp['approver'];
                                $insert=mysql_query("insert into transactions (id,ref,requester,approver,status,last_activity_user,last_activity_date,last_activity_time) values
                                                                                ('','$ref1','$requester','$approver','on-hold','$user_name','$date','$time')
                                ");
                                
                                
                                  $inserthold=mysql_query("insert into on_hold (id,ref,username,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$date','$time')
                                ");
                                
                                
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-info">Your Request# '.$ref1.' Has Been On-Hold Now! </div>
                            </div>';}
                            }
                            
                            
                            // reject functions start
                            
                             if (isset($_POST['reject'])){
                                $ref1=$_POST['reject'];
                                $get_all=last_activity($ref1);
                                $requester=$get_all['requester'];
                                $approver12=$get_all['approver'];
								$dept1=$get_all['dept'];
								$newapp=approver1($user_name,$dept1);
								$approver=$newapp['approver'];
                                $insert=mysql_query("insert into transactions (id,ref,requester,approver,status,last_activity_user,last_activity_date,last_activity_time) values
                                                                                ('','$ref1','$requester','$approver','reject','$user_name','$date','$time')
                                ");
                                
                                
                                  $inserthold=mysql_query("insert into reject (id,ref,username,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$date','$time')
                                ");
                                
                                
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-danger">Your Request# '.$ref1.' Has Been Rejected! </div>
                            </div>';}
                            }
                            
                            // return back function starting
                            
                                     if (isset($_POST['sentback'])){
                                $ref1=$_POST['sentback'];
                                $get_all=last_activity($ref1);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
                                $insert=mysql_query("insert into transactions (id,ref,requester,approver,status,last_activity_user,last_activity_date,last_activity_time) values
                                                                                ('','$ref1','$requester','$approver','return_back','$user_name','$date','$time')
                                ");
                                
                                
                                  $inserthold=mysql_query("insert into sent_back (id,ref,username,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$date','$time')
                                ");
                                
                                
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-warning">Your Request# '.$ref1.' Has Been returned Back </div>
                            </div>';}
                            }
                            
                            
                            
                            ?>
                            
                            
                            
                            
                            
                            
                            
                            
                    <!-- Datatables Content -->
                    <div class="block full">
                        <div class="block-title">
                            <h2><strong>Requests</strong> Pending for Approvals</h2>

                        </div>
                       <form action="requests" method="get" >                        
                        
                        <div class="col-sm-2">
  <select name="searchstatus" id="select" class="form-control" class="form-control">
  <option value="all">Status</option>
  <option <?php if($_GET['searchstatus']=='Requested') {echo "selected=='selected'";}?>>Requested</option>
    <option <?php if($_GET['searchstatus']=='Approved') {echo "selected=='selected'";}?>>Approved</option>
    <option value="return_back" <?php if($_GET['searchstatus']=='return_back') {echo "selected=='selected'";}?>>Return Back</option>
    <option <?php if($_GET['searchstatus']=='On-Hold') {echo "selected=='selected'";}?>>On-Hold</option>
    <option <?php if($_GET['searchstatus']=='Rejected') {echo "selected=='selected'";}?>>Rejected</option>
	
  </select>
  </div>
                        
                        <div class="col-sm-2"><input type="date" name="fdate" class="form-control" value="<?php echo $_GET['fdate'];?>"/>  </div>
                        <div class="col-sm-2"><input type="date" name="tdate" class="form-control" value="<?php echo $_GET['refno'];?>"/></div>
						<input type="hidden" name="search">
                        <div class="col-sm-1"><button class="btn btn-default"><i class="fa fa-search"></i></button></div>
             <div class="clearfix"></div>           
               </form>         
  
             <div class="clearfix"></div>           
                        
  <br />
  
                        <div class="table-responsive">
                        
  
                        <form action="requests" method="post">
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                      <th width="20" class="text-center"></th>
                                        <th width="20" class="text-center">Ref #</th>
                                        <th width="10">Requested User</th>
                                        <th width="80">Descriptions</th>
                                        <th width="30">Form Name</th>
                                        
                                        <th width="20" class="text-center">Last Activity</th>
                                        <th width="20">Status</th>
                                          <th width="20" class="text-center">Last Actvity Date</th>
                                        <th width="170" class="text-center">Last Note</th>
                                        
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
									
									
									
									if(!empty($s_ref)){
										
									$refno=" and ref=".$s_ref;
									}
									
									if(!empty($s_fdate)){
										
									$fdate=" and entry_date>=".$s_fdate;
									$fdate1= " and last_activity_date>=".$s_fdate;
									}
									
									if(!empty($s_tdate)){
										
									$tdate=" and entry_date<=".$s_tdate;
									$tdate1= " and last_activity_date<=".$s_tdate;
									}
									
									if(!empty($s_fdate) and !empty($s_tdate)){
										
									$bdate1=" and entry_date between '".$s_fdate."' and '".$s_tdate."'";
									 $bdate2= " and last_activity_date between '".$s_fdate."' and '".$s_tdate."'";
									}
										
									
									if(!empty($s_searchstatus)){
									
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name' and status='return_back' $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='Requested'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name' and status='Requested' $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name' and status='on-hold' $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='Rejected'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name' and status='reject'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name' and status='Approved'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='all'){
									$ret_list=mysql_query("select * from transactions where requester='$user_name'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									}
									
									
									while($approv_r=mysql_fetch_array($ret_list)){
                                    $ref=$approv_r['ref'];
                                    $reqr=$approv_r['requester'];
                                    $r_formd=getform_data($ref);
                                    $last_act=last_activity($ref);
								    $l_note=last_notes($ref);
                                    
                                ?>
                                    <tr>
                                      <td class="text-center"><input type="checkbox"  name="checkbox[]" id="submitag" value="<?php echo $ref;?>"
									<?php if($approv_r['status']!='return_back'){echo 'disabled="disabled"';}?>/></td>
                                        <td class="text-center"><?php echo $ref;?></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $approv_r['requester'].$approv_r['req'];?></a></td>
                                        <td><?php echo custom_echo($r_formd['description'], 200);?></td>
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
                                        <td class="text-center"><?php echo $l_note['notes'];?></td>
                                        
                                    </tr>
                                    <?php }
									
									
								}
									else {
                                
                              $all_requests=mysql_query("select * from transactions where  requester='$user_name' group by ref order by id desc");
    
  
                                while($approv_r=mysql_fetch_array($all_requests)){
                                    $ref=$approv_r['ref'];
                                    $reqr=$approv_r['requester'];
                                   $r_formd=getform_data($ref);
                                   $last_act=last_activity($ref);
								   $l_note=last_notes($ref);
                                    
                                ?>
                                    <tr>
                                      <td class="text-center"><input type="checkbox"  name="checkbox[]" id="submitag" value="<?php echo $ref;?>"
									<?php  if($last_act['status']=='return_back'){} else {echo 'disabled="disabled"';}?>/></td>
                                        <td class="text-center"><?php echo $ref;?></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $approv_r['requester'];?></a></td>
                                        <td><?php echo custom_echo($r_formd['description'], 200);?></td>
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
                                        <td class="text-center"><?php echo $l_note['notes'];?></td>
                                        
                                    </tr>
                                    <?php }}?>
							
                                </tbody>
                            </table>
							<br>
							<div align="center">
							
<input type="submit" name="submitag" id="submit" value="submit" class="btn btn-primary btn-lg" onclick="return confirm('Are you sure to continue?');">
</form>
</div>
<script   src="https://code.jquery.com/jquery-1.9.1.min.js"   integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ="   crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    
        var $submit = $("#submit").hide(),
            $cbs = $('input[id="submitag"]').click(function() {
                $submit.toggle( $cbs.is(":checked") );
            });
    
    });
</script>
                        </div>
                    </div>
                    <!-- END Datatables Content -->
                </div>
                <!-- END Page Content -->


            <?php include 'footer.php';?>
