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
<style>
.h:hover{background-color:#EAEDF1;}
</style>
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
							 
						
								
                            $date=date('Y-m-d');
                            $time=date('h:i:s');
							$t=time();
$r=rand();
$filecode=$t.$r;
$acc_n=$user_name.' Approved this request';
$acc_s='Approved';
$return_n=$user_name. ' Returned Back to Requester ';
$return_s='Returned Back';
$hold_n=$user_name. ' HOLD This Request ';
$hold_s='Hold On';
 $reject_n=$user_name. ' Rejected This Request ';
$reject_s='Rejected';   


                                
                                //=======================================
                            if (isset($_POST['approved1'])){
                                
                            $checked = $_POST['checkbox'];
                            foreach ($checked as $key){
                               $lac=last_activity($key);
								$req=$lac['requester'];
								$dept=$lac['req_dept'];
								$css=$lac['current_status'];
								$formname=$lac['formname'];
								
								
								
								if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								$acc_s1='Approved - '.$css1;
								
								$lnote=last_notes($key);
							   $inv=$lnote['invoice_no'];
							   $cancel_status=$lnote['cancel_status'];
							   
								if ($lac['approver_status']==0 and $lac['gd_status']==0){
								$uapp=mysql_query("select * from group_directors where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status) values
	                                ('','$key','$req','$rqid','$dept','$gd_name','$apr','approved','Approved','$user_name','$date','$time','gd',1)") or die (mysql_error());
						$del=mysql_query("delete from transactions where ref=$key and approver_status=0 and gd_status=0");
								}
									
						
								}
								
								if ($lac['approver_status']==1 and $lac['gd_status']==0){
								$uapp=mysql_query("select * from accountants where dept='$dept'");
								
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant) values
	                                ('','$key','$req','$rqid','$dept','$gd_name','$apr','approved','Approved','$user_name','$date','$time','accountant',1,1,'$gd_name')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and approver_status=1 and gd_status=0");
						}
						
								}
							
							
							
                            $insertapp=mysql_query("insert into approves (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                                                                        ('','$key','$req','$user_name','$date','$time','approved','$dept','$formname')
                                ");
								
$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                        ('','$key','$user_name','$acc_n','$acc_s1','$filecode','$date','$time','$cancel_status','$inv')
                                ");
                                    }  
                                    ?>
                                      <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                             <div class="alert alert-success">Your Requests Have Been Approved </div>
                             </div>
                                <?php 
                            }
                            
                            //=======================================
                            
                               if (isset($_POST['on-hold1'])){
                            $checked = $_POST['checkbox'];
                            foreach ($checked as $key){
                     $lac=last_activity($key);
								$req=$lac['requester'];
								$req_dept=$lac['req_dept'];
								$cs=$lac['current_status'];
								$css=$lac['current_status'];
								
								$lnote=last_notes($key);
							   $inv=$lnote['invoice_no'];
							   $cancel_status=$lnote['cancel_status'];
								
								if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								$hold_s1='Hold On - as '.$css1;
								
                             $insert=mysql_query("update transactions set status='on-hold',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time'
								where ref=$key ");
                                
                                
                                  $inserthold=mysql_query("insert into on_hold (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$key','$req','$user_name','$date','$time',status,'$req_dept')
                                ");
if ($cs=='bk' or $cs=='ca' or $cs=='sa' or $cs=='accountant' or  $cs=='teller'){
								if ($cs=='bk'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,1,'$cancel_status','$inv')
                                "); }
								
								if ($cs=='ca'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,'$cancel_status','$inv')
                                "); }
								
								
								if ($cs=='accountant'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values 
								('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv') ") or die (mysql_error());
								}
								
								if ($cs=='sa'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,'$cancel_status','$inv')
                                ");
								}
								
								if ($cs=='teller'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,'$cancel_status','$inv')
                                ");
								}
								
								
								
								}else {
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                        ('','$key','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv')
                                ");
								
								}
                                    }  
                                    ?>
                                      <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                             <div class="alert alert-info">Your Requests Have Been Hold-On </div>
                             </div>
                                <?php 
                            }
                            
                            
                            
                              //=======================================
                              
                              
                               if (isset($_POST['reject1'])){
                            $checked = $_POST['checkbox'];
                        
                            foreach ($checked as $key){
                                $lac=last_activity($key);
								$req=$lac['requester'];
								$css=$lac['current_status'];
								$req_dept=$lac['req_dept'];
								if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$reject_s1='Rejected as - '.$css1; 
                            $insert=mysql_query("update transactions set status='reject',final_status='Rejected',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',last_user='$user_name',t_status=1
								 where ref=$key
                                ");
                                
                                  $inserthold=mysql_query("insert into reject (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$key','$req','$user_name','$date','$time','regected','$req_dept')
                                ");
$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                        ('','$key','$user_name','$reject_n','$reject_s1','$filecode','$date','$time')
                                ");
                                    }  
                                    ?>
                                      <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                             <div class="alert alert-danger">Your Requests Have Been Rejected </div>
                             </div>
                                <?php 
                            }
                              
                              
                              
                              
                                //=======================================
                                
                                
                                
                                 if (isset($_POST['sentback1'])){
                            $checked = $_POST['checkbox'];
                            foreach ($checked as $key){
                                $get_all=last_activity($key);
								$lastuser=$get_all['last_user'];
								$req=$get_all['requester'];
								$dept=$get_all['req_dept'];
								$css=$get_all['current_status'];
								$reqid=$get_all['requester_id'];
                               $prevu=$get_all['last_activity_user'];
							   
							   $lnote=last_notes($key);
							   $inv=$lnote['invoice_no'];
							   $cancel_status=$lnote['cancel_status'];
							   
							   if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
							   $return_s2='Returned Back - as '.$css1;
								
								
								
									 
									 if($get_all['current_status']=='accountant' or $get_all['current_status']=='approver') {
		
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,
last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
('','$key','$req','$rqid','$dept','$req','$apr','return_back','return_back','$req','$user_name','$date','$time','Requester',0,0)") or die (mysql_error());

			$del=mysql_query("delete from transactions where ref=$key and accountant<>'' ");						
		
		$return_s1=' Returned Back to Requester';
		}
		
								 if($get_all['current_status']=='sa' or $get_all['current_status']=='ca') {
									 
	$uapp=mysql_query("select * from accountants where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
	    ('','$key','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','accountant',1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$key and current_status='sr_accountant' or current_status='ca'");
	}					
								  
								  $return_s1=$user_name.' Returned Back to Accountant';
								 
		}		 
								 
							 if($get_all['current_status']=='teller' or $get_all['current_status']=='bk') {
		$uapp=mysql_query("select * from ca where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,sr_accountant) values
	    ('','$key','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','ca',1,1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$key and current_status='teller' or current_status='bk'");
	}
		
		$return_s1=' Returned Back to Chief Accountant';
		}		 	 
								 
								 if($get_all['current_status']=='gd' ){
			
$uapp=mysql_query("select * from approvers where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	    ('','$key','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$req','$user_name','$date','$time','approver')") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$key and current_status='gd'");
	}					
								  
								  $return_s1=$user_name.' Returned Back to Approver';
								 
								 }
                         
                                
                                
                                  $inserthold=mysql_query("insert into sent_back (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                                                                        ('','$key','$req','$user_name','$date','$time','return back','$dept','$formname')
                                ");
$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                        ('','$key','$user_name','$return_s1','$return_s2','$filecode','$date','$time','$cancel_status','$inv')
                                ");
                                    }  
                                    ?>
                                      <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                             <div class="alert alert-warning">Your requests have been returned back to Requester </div>
                             </div>
                                <?php 
                            }
                                
                            
							
							
							
							if (isset($_POST['archive1'])){
                                $checked = $_POST['checkbox'];
                           
                            foreach ($checked as $key){
                                $get_all=last_activity($key);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
								$subject='Bookkeeper Archived' ;
								
								
								 $insert=mysql_query("update transactions set status='completed',final_status='completed',last_user='$user_name',
								last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',t_status=1
								 where ref=$key");
								 
                                
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$key','$user_name','Bookkeeper Archived','Archived','$filecode','$date','$time')
                                ");
                               
                                    ?>
                                      <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                             <div class="alert alert-sucess">Your Requests Has Been Archived</div>
                             </div>
                                <?php 
                            }
							}
							
							
                                  //=======================================
                                
                            if (isset($_POST['approved'])){
                                $ref1=$_POST['approved'];
								
                         
								
								$lac=last_activity($ref1);
								$req=$lac['requester'];
								 $dept=$lac['req_dept'];
								 $css=$lac['current_status'];
								 $formname=$lac['formname'];
								$lnote=last_notes($ref1);
							   $inv=$lnote['invoice_no'];
								 $cancel_status=$lnote['cancel_status'];
								 
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$acc_s1='Approved - as '.$css1;
									
								
								if ($lac['approver_status']==0 and $lac['gd_status']==0){
									 
								$uapp=mysql_query("select * from group_directors where dept='$dept'") or die (mysql_error());
								while ($newapps=mysql_fetch_array($uapp)){$gd_name[]=$newapps['username'];}
						
					
								
						foreach ($gd_name as $gd) {
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status) values
	                                ('','$ref1','$req','$rqid','$dept','$gd','$apr','approved','Approved','$user_name','$date','$time','gd',1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$ref1 and approver_status=0");
						}
								
								}
								
								if ($lac['approver_status']==1 and $lac['gd_status']==0){
								$uapp=mysql_query("select * from accountants where dept='$dept'");
								
								while ($newapps=mysql_fetch_array($uapp)){$gd_name[]=$newapps['username'];}
						
						
								
								
						foreach ($gd_name as $gd) {
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant) values
	                                ('','$ref1','$req','$rqid','$dept','$gd','$apr','approved','approved','$user_name','$date','$time','accountant',1,1,'$gd')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$ref1 and approver_status=1 and gd_status=0") ;
						}
						
								}
								
                                $insertapp=mysql_query("insert into approves (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                                                                        ('','$ref1','$req','$user_name','$date','$time','approved','$dept','$formname')
                                ") or die (mysql_error());
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$acc_n','$acc_s1','$filecode','$date','$time','$cancel_status','$inv')
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
								$lac=last_activity($ref1);
								$req=$lac['requester'];
								 $cs=$lac['current_status'];
								 $css=$lac['current_status'];
								 $dept=$lac['req_dept'];
								 
								 $lnote=last_notes($ref1);
							   $inv=$lnote['invoice_no'];
							   $cancel_status=$lnote['cancel_status'];
							   
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								 $hold_s1='Hold On - as '.$css1;
								
								
                                $insert=mysql_query("update transactions set status='on-hold',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time'
								where ref=$ref1 ");
                                
                                
                                  $inserthold=mysql_query("insert into on_hold (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref1','$req','$user_name','$date','$time','On Hold','$dept')
                                ");
                                
								if ($cs=='bk' or $cs=='ca' or $cs=='sa' or $cs=='accountant' or  $cs=='teller'){
									
								if ($cs=='bk'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,1,'$cancel_status','$inv')
                                "); }
								
								if ($cs=='ca'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,'$cancel_status','$inv')
                                "); }
								
								
								if ($cs=='accountant'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values 
								('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv') ") or die (mysql_error());
								}
								
								if ($cs=='sa'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,'$cancel_status','$inv')
                                ");
								}
								
								if ($cs=='teller'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,'$cancel_status','$inv')
                                ");
								}
								
								}else {
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv')
                                ");
								
								}
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
                                $approver=$get_all['approver'];
								$requester_id=$get_all['requester_id'];
                                $approver_id=$get_all['approver_id'];
								$css=$get_all['current_status'];
								$dept=$get_all['req_dept'];
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$reject_s1='Rejected as - '.$css1; 
								
								 $insert=mysql_query("update transactions set status='reject',final_status='Rejected',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',last_user='$user_name',t_status=1
								 where ref=$ref1
                                ");
								
                            
                                
                            
                                
								$inserthold=mysql_query("insert into reject (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref1','$requester','$user_name','$date','$time','rejected','$dept')
                                ") or die (mysql_error());
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$reject_n','$reject_s1','$filecode','$date','$time')
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
                            
							
							if (isset($_POST['submitac'])){
                                $ref1=$_POST['submitac'];
                                $get_all=last_activity($ref1);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
								$requester_id=$get_all['requester_id'];
                                $approver_id=$get_all['approver_id'];
								$subject='Accountant Submit the Request REF# '.$ref1.' in Oracle' ;
                                $insert=mysql_query("insert into transactions (id,ref,requester,requester_id,approver,approver_id,status,last_activity_user,last_activity_date,last_activity_time,accountant,accountant_status) values
                                                                                ('','$ref1','$requester','$requester_id','$approver','$approver_id','approved','$user_name','$date','$time','$user_name','1')
                                ");
                                
                               
                                
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','$subject','Submit in Oracle','$filecode','$date','$time')
                                ");
								
								$update=mysql_query("update transactions set final_status='approved' where ref='$ref1'");
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Request# '.$ref1.' Has Been Submited! </div>
                            </div>';}
                            }
                            // return back function starting
                            
                                     if (isset($_POST['sentback'])){
                                $ref1=$_POST['sentback'];
                                $get_all=last_activity($ref1);
								$lastuser=$get_all['last_user'];
								$req=$get_all['requester'];
								$dept=$get_all['req_dept'];
								$css=$get_all['current_status'];
								$formname=$get_all['formname'];
								$reqid=$get_all['requester_id'];
                               $prevu=$get_all['last_activity_user'];
							   
							   
							   $lnote=last_notes($ref1);
							   $inv=$lnote['invoice_no'];
							    $cancel_status=$lnote['cancel_status'];
							   
							    if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$return_s2='Returned Back - as '.$css1;
								
								
								
									 
									 if($get_all['current_status']=='accountant' or $get_all['current_status']=='approver') {
		
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,
last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
('','$ref1','$req','$rqid','$dept','$req','$apr','return_back','return_back','$req','$user_name','$date','$time','Requester',0,0)") or die (mysql_error());

			$del=mysql_query("delete from transactions where ref=$ref1 and accountant<>''")or die (mysql_error());						
		
		$return_s1=' Returned Back to Requester';
		}
		
								 if($get_all['current_status']=='sa' or $get_all['current_status']=='ca') {
									 
	$uapp=mysql_query("select * from accountants where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
	    ('','$ref1','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','accountant',1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref1 and current_status='sr_accountant' or current_status='ca' or current_status='accountant'");
	}					
								  
								  $return_s1=$user_name.' Returned Back to Accountant';
								 
		}		 
								 
							 if($get_all['current_status']=='teller' or $get_all['current_status']=='bk') {
		$uapp=mysql_query("select * from ca where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,sr_accountant) values
	    ('','$ref1','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','ca',1,1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref1 and current_status='teller' or current_status='bk'");
	}
		
		$return_s1=' Returned Back to Cheif Accountant';
		}		 	 
								 
								 if($get_all['current_status']=='gd' ){
			
$uapp=mysql_query("select * from approvers where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	    ('','$ref1','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$apr','$user_name','$date','$time','approver')") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref1 and current_status='gd'");
	}					
								  
								  $return_s1=$user_name.' Returned Back to Approver';
								 
								 }
                                
                                  $inserthold=mysql_query("insert into sent_back (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                                                                        ('','$ref1','$req','$user_name','$date','$time','return back','$dept','$formname')
                                ");
                                
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                        ('','$ref1','$user_name','$return_s1','$return_s2','$filecode','$date','$time','$cancel_status','$inv')
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
                            
                            //============================
							
							
							if (isset($_POST['archive'])){
                                $ref1=$_POST['archive'];
                                $get_all=last_activity($ref1);
								$lastuser=$get_all['last_activity_user'];
								$req=$get_all['requester'];
                                
										 
									 
								 $insert=mysql_query("update transactions set status='completed',final_status='completed',last_user='$user_name',
								last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',t_status=1
								 where ref=$ref1");
								 
                                
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref1','$user_name','Bookkeeper Archived','Archived','$filecode','$date','$time')
                                ");
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Request# '.$ref1.' Has Been Archived </div>
                            </div>';}
                            }
							
							
                            
                            ?>
                            
                            
                            
                            
                            
                            
                            
                            
                    <!-- Datatables Content -->
                    <div class="block full">
                        <div class="block-title">
                            <h2><strong>Requests</strong> Pending for Approvals</h2>

                        </div>
						<form action="approv" method="get" >
                       <div class="col-sm-1"><input type="text" name="refno" placeholder="Ref #" class="form-control" value="<?php echo $_GET['refno'];?>"/></div>
                        
                                 
  
  
                        <div class="col-sm-2">
  <select name="searchstatus" id="select" class="form-control" class="form-control">
  <option value="all">Status</option>
  <option <?php if($_GET['searchstatus']=='Pending') {echo "selected=='selected'";}?>>Pending</option>
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
  <br />
  
                        <div class="table-responsive">
                        
  
                        <form action="approv" method="post">
                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                <thead>
                                    <tr>
                                      <th width="20" class="text-center"><!-- <input type="checkbox" id="submita">--></th>
                                        <th width="20" class="text-center">Ref #</th>
                                        <th width="10">Requested User</th>
                                        <th width="150">Descriptions</th>
                                        <th width="30">Form Name</th>
                                        
                                        <th width="20" class="text-center">Last Activity</th>
                                        <th width="20">Last Status</th>
                                          <th width="20" class="text-center">Last Actvity Date</th>
                                        <th width="100" class="text-center">Last Note</th>
                                        <th width="10" class="text-center">Actions</th>
										<th width="10" class="text-center">Status</th>
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
									/*
									if(!empty($s_fdate)){
										
									$fdate=" and entry_date>=".$s_fdate;
									$fdate1= " and last_activity_date>=".$s_fdate;
									}
									
									if(!empty($s_tdate)){
										
									$tdate=" and entry_date<=".$s_tdate;
									$tdate1= " and last_activity_date<=".$s_tdate;
									}
									*/
									if(!empty($s_fdate) and !empty($s_tdate)){
										
									$bdate1=" and entry_date between '".$s_fdate."' and '".$s_tdate."'";
									 $bdate2= " and last_activity_date between '".$s_fdate."' and '".$s_tdate."'";
									}
										
									
									if(!empty($s_searchstatus)){
									
									if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select * from approves where username='$user_name' and status='approved'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select * from transactions where approver='$user_name' and status='return_back' $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select * from transactions where approver='$user_name' and status='on-hold' $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='Rejected'){
									$ret_list=mysql_query("select * from transactions where approver='$user_name' and status='reject'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									if($s_searchstatus=='Pending'){
									$ret_list=mysql_query("select * from transactions where approver='$user_name' and status='Requested'  $refno $fdate $tdate $bdate1 group by ref order by ref desc") or die (mysql_error());
									}
									
									
									if($s_searchstatus=='all'){
									$ret_list=mysql_query("select * from transactions where t_status<>3 $refno  $bdate2 group by ref order by ref desc") or die (mysql_error());
									}
									
									
									}
									
									
									
									

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
                                  <tr class="h">
                                      <td class="text-center">
<?php if( $approv_r['username']==$user_name){
										
										if($last_act['status']=='on-hold'){
					echo '<input type="checkbox" id="submita" name="checkbox[]" value="'.$approv_r['ref'].'" />';}
					
										else {
									?><input type="checkbox" id="select" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" disabled="disabled"/>
									<?php }}
									
									else {?><input type="checkbox" id="submita" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" />
									<?php }?>									 
									 </td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $ref;?></a></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $reqr.$approv_r['req'];?></a></td>
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
                                            <div class="btn-group">
											<div align="center">
                                            <?php 
                                            
                                            if (!empty($last_act['status'])){
                                                
                                             
										
										if ($last_act['status']=='return_back' and $approv_r['username']!=$user_name){
											
											if($last_act['last_activity_user']==$user_name and $last_act['status']=='on-hold'){?>	
						
                        <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
										
											
											<?php }else {
											
											?>
		<button onclick="return confirm('Are you sure to continue?');" type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></button>

		<button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> </button>  
        <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> </button> 
        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i></button>											
											<?php 
										}}
											
											
										
                                            
											
											else{
												
												if ($utype=='BK'){?>
													
													
 <button type="submit" name="archive" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Archive" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i></button>
 <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> </button>													
													
													<?php 
												}
												
												
 
						elseif($approv_r['username']==$user_name and $last_act['status']!='on-hold' or $last_act['approver_status']==1 ){?>
												
						<a href="javascript:void(0)"  class="btn btn-xs btn-success"><i class="fa fa-check-square-o"></i><?php echo $last_act['last_activity_user'].' '.$last_act['final_status'];?> </a><div class="clearfix"></div>
												
												
											<?php 	
											}
						elseif($last_act['status']=='on-hold'){?>	
						
						<button onclick="return confirm('Are you sure to continue?');" type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></button>
                        <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
																	
											
						<?php }
											else {	 
												 ?>
											 
											 <div classc="clearfix"></div>
                                             <form action="approv" method="post">
											 <?php if ($last_act['status']=='reject'){}else{?>
                                                <button onclick="return confirm('Are you sure to continue?');" type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></button>
                                                <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                                                <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn  btn-info"><i class="fa fa-pause"></i></button> 
                                                <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
												<?php }?>
                                                </form>
											<?php }}}?>                           
                                         </div>                                       
                                          </td>
										  
										  <td class="text-center"><?php 
	
	
	if ($approv_r['username']!=$user_name){
		
	echo	'<i class="fa fa-hand-o-up fa-2x text-primary"></i>';
	}
	else {
		
		echo '<i class="fa fa-check fa-2x text-success"></i>';
	}
	
										  ?></td>
										  
                                    </tr>
											<?php }?>
                                </tbody>
                            </table>
                            <div class="text-center">
                            <br />
							<?php 
							if ($last_act['status']=='return_back'){
								if($last_act['last_activity_user']==$user_name and $last_act['status']=='on-hold'){?>	
						
                        <button id="submit" onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button id="submit2" onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
										
											
											<?php }else {
											
											?>
							<button id="submit" onclick="return confirm('Are you sure to continue?');" name="sentback1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back </button>  
                                                <button onclick="return confirm('Are you sure to continue?');" id="submit1" name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 
                                                <button onclick="return confirm('Are you sure to continue?');" id="submit2" name="reject1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject </button>
								
								<?php 
							} }
						
						
						
						else {
							
							if ($utype=='BK'){?>
													
													
 <button id="submit1" type="submit" name="archive1" onclick="return confirm('Are you sure to continue?');" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Archive" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i> Archive</button> 
<button  id="submit3" onclick="return confirm('Are you sure to continue?');"  name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 		
													
													<?php 
												}
												
												
							?>
							
						<?php if ($approv_r['username']!=$user_name){} else{?>
						
                             <button  id="submit" onclick="return confirm('Are you sure to continue?');" name="approved1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i> Approve </button>
                             <button  id="submit1" onclick="return confirm('Are you sure to continue?');" name="sentback1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back </button>  
                             <button  id="submit2" onclick="return confirm('Are you sure to continue?');"  name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 
                             <button  id="submit3" onclick="return confirm('Are you sure to continue?');" name="reject1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject </button>
						
</div>
</form>
<?php 
						}}}
										
						
										
								 else{
								
								$ret_list=approval_list($user_name);
		
								$num=mysql_num_rows($ret_list);
                                while($approv_r=mysql_fetch_array($ret_list)){
                                    $ref=$approv_r['ref'];
                                    $reqr=$approv_r['requester'];
                                    $r_formd=getform_data($ref);
                                    $last_act=last_activity($ref);
									$l_note=last_notes($ref);
                                    $napp=$last_act['next_approver'];
									 $cs=$last_act['current_status'];
$dept=$last_act['req_dept'];
$ap=get_ap($user_name,$dept) ;									
$gd=get_gd($user_name,$dept) ;                     
$ac=get_ac($user_name,$dept) ;
$sa=get_sa($user_name,$dept) ;
$ca=get_ca($user_name,$dept) ;
$teller=get_teller($user_name,$dept) ;
$bk=get_bk($user_name,$dept) ;

if($cs=='approver' and $ap>=1){
	
	$btn=1;
}

if($cs=='gd' and $gd>=1){
	
	$btn=1;
}

if($cs=='accountant' and $ac>=1){
	
	$btn=1;
}

if($cs=='sa' and $sa>=1){
	
	$btn=1;
}

if($cs=='ca' and $ca>=1){
	
	$btn=1;
}

if($cs=='teller' and $teller>=1){
	
	$btn=1;
}
 
 
 if($cs=='bk' and $bk>=1){
	
	$btn=1;
}
 
                                ?>
                                    <tr class="h">
                                      <td class="text-center">
<?php if( $last_act['last_activity_user']==$user_name){
										
										if($last_act['status']=='on-hold'){
					echo '<input type="checkbox" id="submita" name="checkbox[]" value="'.$approv_r['ref'].'" />';}
					
										else {
									?><input type="checkbox" id="select" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" disabled="disabled"/>
									<?php }}
									
									else {?><input type="checkbox" id="submita" name="checkbox[]" value="<?php echo $approv_r['ref'];?>" />
									<?php }?>									 
									 </td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $ref;?></a></td>
                                        <td class="text-center"><a href="view?ref=<?php echo $ref;?>"><?php echo $approv_r['requester'];?></a></td>
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
                                            <div class="btn-group">
											<div align="center">
                                            <?php 
                                            
                                            if (!empty($last_act['status'])){
                                                
												
												if($last_act['current_status']=='accountant'){
												
												if($last_act['last_activity_user']==$user_name and $last_act['status']=='on-hold'){?>	
						
                        <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
										
											
											<?php }else {
											
											?>
												<button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> </button>  
                                                <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> </button> 
                                                <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i></button>											
											<?php 
										}}
										
										
										
										
                                             
										
										elseif ($last_act['current_status']=='sa' or $last_act['current_status']=='ca' or $last_act['current_status']=='teller'){
											
											if($last_act['last_activity_user']==$user_name and $last_act['status']=='on-hold'){?>	
						
                        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
										
											
											<?php }else {
											
											?>
                                                <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> </button> 
                                                <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i></button>											
											<?php 
										}}
											
											
										
                                            
											
											else{
												
												if ($last_act['current_status']=='bk'){
												if($last_act['status']=='on-hold'){
												?>
													 <button type="submit" name="archive" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Archive" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i></button>
<?php } else {?>
													
 <button type="submit" name="archive" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Archive" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i></button>
 <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> </button>													
													
													<?php 
											}	}
												
												
 
						elseif($last_act['last_activity_user']==$user_name and $last_act['status']!='on-hold' and $last_act['status']!='Requester' and $btn!=1){?>
												
						<a href="javascript:void(0)"  class="btn btn-xs btn-success"><i class="fa fa-check-square-o"></i><?php echo $last_act['last_activity_user'].' '.$last_act['final_status'];?> </a><div class="clearfix"></div>
												
												
											<?php 	
											}
						elseif( $last_act['status']=='on-hold'){?>	
						
						<button onclick="return confirm('Are you sure to continue?');" type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></button>
                        <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
																	
											
						<?php }
											else {	 
												 ?>
											 
											 <div classc="clearfix"></div>
                                             <form action="approv" method="post">
                                                <button onclick="return confirm('Are you sure to continue?');" type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></button>
                                                <button onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                                                <button onclick="return confirm('Are you sure to continue?');" name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn  btn-info"><i class="fa fa-pause"></i></button> 
                                                <button onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
												
                                                </form>
											<?php }}}?>                           
                                         </div>                                       
                                          </td>
										  
										  <td class="text-center"><?php 
	
	
	if ($approv_r['approver']==$user_name and $last_act['approver_status']<>1 or $last_act['gd_status']<>1 or $last_act['accountant_status']<>1 or $last_act['sr_accountant']<>1 or $last_act['chif_accountant']<>1){
		
	echo	'<i class="fa fa-hand-o-up fa-2x text-primary"></i>';
	}
	else {
		
		echo '<i class="fa fa-check fa-2x text-success"></i>';
	}
	
										  ?></td>
										  
                                    </tr>
											<?php }?>
                                </tbody>
                            </table>
                            <div class="text-center">
                            <br />
							<?php 
							if ($approv_r['current_status']=='accountant' or $approv_r['current_status']=='sa' or $approv_r['current_status']=='ca' or $approv_r['current_status']=='teller'){
								if($approv_r['last_activity_user']==$user_name and $approv_r['status']=='on-hold'){?>	
						
                        <button id="submit" onclick="return confirm('Are you sure to continue?');" name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn  btn-warning"><i class="fa fa-reply"></i></button>  
                        <button id="submit2" onclick="return confirm('Are you sure to continue?');" name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> </button>
										
											
											<?php }else {
											
											?>
							<button id="submit" onclick="return confirm('Are you sure to continue?');" name="sentback1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back </button>  
                                                <button onclick="return confirm('Are you sure to continue?');" id="submit1" name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 
                                                <button onclick="return confirm('Are you sure to continue?');" id="submit2" name="reject1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject </button>
								
								<?php 
							} }
						
						
						
						else {
							
							if ($approv_r['current_status']=='bk'){
							
							?>
													
													
 <button id="submit1" type="submit" name="archive1" onclick="return confirm('Are you sure to continue?');" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Archive" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i> Archive</button> 
<button  id="submit3" onclick="return confirm('Are you sure to continue?');"  name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 		
													
							<?php } else {?>
								
								
						
      <button  id="submit" onclick="return confirm('Are you sure to continue?');" name="approved1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i> Approve </button>
      <button  id="submit1" onclick="return confirm('Are you sure to continue?');" name="sentback1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back </button>  
      <button  id="submit2" onclick="return confirm('Are you sure to continue?');"  name="on-hold1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i> Hold-On </button> 
      <button  id="submit3" onclick="return confirm('Are you sure to continue?');" name="reject1" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject </button>
						
</div>
</form>
<?php 
								}}}?>
                     </div> </div>  </div>
                    </div>
                    <!-- END Datatables Content -->
                </div>
                <!-- END Page Content -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
  $(document).ready(function() {
    
        var $submit = $("#submit").hide(),
            $cbs = $('input[id="submita"]').click(function() {
                $submit.toggle( $cbs.is(":checked") );
            });
			var $submit1 = $("#submit1").hide(),
            $cbs = $('input[id="submita"]').click(function() {
                $submit1.toggle( $cbs.is(":checked") );
            });
    var $submit2 = $("#submit2").hide(),
            $cbs = $('input[id="submita"]').click(function() {
                $submit2.toggle( $cbs.is(":checked") );
            });
			
			var $submit3 = $("#submit3").hide(),
            $cbs = $('input[id="submita"]').click(function() {
                $submit3.toggle( $cbs.is(":checked") );
            });
			
			
    });
</script>

            <?php include 'footer.php';?>

