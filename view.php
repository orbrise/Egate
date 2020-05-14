<? ob_start();//Start buffer output ?>
<?php
session_start();
$up_id = uniqid(); 
$user_name=$_SESSION['user'];
$user_id=$_SESSION['user_id'];
include 'functions.php';
include 'connection.php';
if (!$_SESSION['user']) {
        header('Location:index.php');
}

?>

<?php include 'header.php'; ?>




<div id="page-content">

<?php 
$ref=trim($_GET['ref']);
$row=getform_data($ref);

$tranc=last_activity($ref);
$t=time();
$r=rand();
$filecode=$t.$r;

$conn=oci_connect('apps','apps','erptest.panafrica.com:1571/RND');


?>
                    <!-- Invoice Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="gi gi-usd"></i><?php echo $row['form_name'];?><br><small>Detailed View</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Requests</li>
                        <li><a href="">View</a></li>
                    </ul>
                    <!-- END Invoice Header -->

<?php
        $approvr1=approver($user_name);
		$approvr12=$approvr1['approver'];
		
		
		$dept=$approvr1['dept'];
		$newapp=approver1($user_name,$dept);
		$approvr=$newapp['approver'];
		
		$bk=$approvr1['type'];
		$utype=$approvr1['type'];
		
		$last_act=last_activity($ref);
		$req=$last_act['requester'];
		 $dept=$last_act['req_dept'];
		 $cs=$last_act['current_status'];
		 
		 $data=mysql_query("select * from transactions where ref='$ref'");
	while ($datar=mysql_fetch_array($data)){
		
		$backs[]=$datar['back_status'];
	}

$hold_n=$user_name. ' Hold This Request ';
$hold_s='Hold On';
$all=all_approver($ref);	
                            $date=date('Y-m-d');
                            $time=date('h:i:s');

$ap=get_ap($user_name,$dept) ;									
$gd=get_gd($user_name,$dept) ;                     
$ac=get_ac($user_name,$dept) ;
$sa=get_sa($user_name,$dept) ;
$ca=get_ca($user_name,$dept) ;
$teller=get_teller($user_name,$dept) ;
$bk=get_bk($user_name,$dept) ;

if($cs=='approver' and $ap>=1){
	
	$btn==1;
}

if($cs=='gd' and $gd>=1){
	
	$btn=1;
}

if($cs=='accountant' and $ac>=1){
	
	$btn==1;
}

if($cs=='sa' and $sa>=1){
	
	$btn==1;
}

if($cs=='ca' and $ca>=1){
	
	$btn=1;
}

if($cs=='teller' and $teller>=1){
	
	$btn==1;
}
 
 
 if($cs=='bk' and $bk>=1){
	
	$btn==1;
}							
									
							
							
              if (isset($_POST['approved'])){	  
	  $notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  $lac=last_activity($ref);
								$req=$lac['requester'];
								 $dept=$lac['req_dept'];
								 $formname=$lac['formname'];
								 $css=$lac['current_status'];
								 $lnote=last_notes($ref);
							   $inv=$lnote['invoice_no'];
							    $cancel_status=$lnote['cancel_status'];
								 
								  if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$acc_s1='Approved - '.$css1;
								
								if ($lac['approver_status']==0 and $lac['gd_status']==0){
									 
								$uapp=mysql_query("select * from group_directors where dept='$dept'") or die (mysql_error());
								while ($newapps=mysql_fetch_array($uapp)){$gd_name[]=$newapps['username'];}
						
					
								
						foreach ($gd_name as $gd) {
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status) values
	                                ('','$ref','$req','$rqid','$dept','$gd','$apr','approved','Approved','$user_name','$date','$time','gd',1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$ref and approver_status=0");
						}
								
								}
								
								if ($lac['approver_status']==1 and $lac['gd_status']==0){
								$uapp=mysql_query("select * from accountants where dept='$dept'");
								
								while ($newapps=mysql_fetch_array($uapp)){$gd_name[]=$newapps['username'];}
						
						
								
								
						foreach ($gd_name as $gd) {
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant) values
	                                ('','$ref','$req','$rqid','$dept','$gd','$apr','approved','approved','$user_name','$date','$time','accountant',1,1,'$gd')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$ref and approver_status=1 and gd_status=0") ;
						}
						
								}
	  
	  
     $insertapp=mysql_query("insert into approves (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                 ('','$ref','$req','$user_name','$date','$time','approved','$dept','$formname')
                                ");
								
							if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                 ('','$ref','$user_name','$notes','$acc_s1','$filecode','$date','$time','$cancel_status','$inv')
			  ");				
								
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Request# '.$ref.' Has Been Approved </div>
                            </div>';}
							?><meta http-equiv="refresh" content="1; URL='approv'" /><?php
											///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("");

	$file_count = count($_FILES["item_file"]['name']);
	

    
	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$t.$ref.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$t.$ref.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					//echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                    ('','$ref','$user_name','$notes','$file_name','$filecode','$date','$time','$cancel_status','$inv')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
                            }

// on hold start function
                            
                             if (isset($_POST['on-hold'])){
             $lnote=last_notes($ref);
							   $inv=$lnote['invoice_no'];
							   $cancel_status=$lnote['cancel_status'];
							   
							   
	  $notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	   $lac=last_activity($ref);
								$req=$lac['requester'];
								$cs=$lac['current_status'];
								$css=$lac['current_status'];
								
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$hold_s1='Hold On - as '.$css1;
								
                                $insert=mysql_query("update transactions set status='on-hold',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time'
								where ref=$ref ");
                                
                                
                                  $inserthold=mysql_query("insert into on_hold (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref','$req','$user_name','$date','$time','On Hold','$req_dept')
                                ");
                                
								if ($cs=='bk' or $cs=='ca' or $cs=='sa' or $cs=='accountant' or  $cs=='teller'){
								if ($cs=='bk'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,cancel_status,invoice_no) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,1,'$cancel_status','$inv')
                                "); }
								
								if ($cs=='ca'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,cancel_status,invoice_no) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,'$cancel_status','$inv')
                                "); }
								
								
								if ($cs=='accountant'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values 
								('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv') ") or die (mysql_error());
								}
								
								if ($cs=='sa'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,cancel_status,invoice_no) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,'$cancel_status','$inv')
                                ");
								}
								
								if ($cs=='teller'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cancel_status,invoice_no) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time',1,1,1,'$cancel_status','$inv')
                                ");
								}
								
								
								}else {
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s1','$filecode','$date','$time','$cancel_status','$inv')
                                ");
								
								}
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-info">Your Request# '.$ref.' Has Been On-Hold Now! </div>
                            </div>';}
							?><meta http-equiv="refresh" content="1; URL='approv'" /><?php
							
											///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("Error: no files uploaded!");

	$file_count = count($_FILES["item_file"]['name']);
	

    
	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$t.$ref.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$t.$ref.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					//echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                    ('','$ref','$user_name','$notes','$file_name','$filecode','$date','$time','$cancel_status','$inv')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
                            }

// reject functions start
                            
                             if (isset($_POST['reject'])){
                                
                                $get_all=last_activity($ref);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
								$requester_id=$get_all['requester_id'];
								$css=$get_all['current_status'];
								
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								
								$reject_s1='Rejected as - '.$css1; 
								
								
      $approver_id=$get_all['approver_id'];
								$notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  
	  $insert=mysql_query("update transactions set status='reject',last_user='$user_name',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',t_status=1
								 where ref=$ref
                                ");
                                
                                
                                  $inserthold=mysql_query("insert into reject (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref','$req','$user_name','$date','$time','rejected','$dept')
                                ");
                                
                                if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                 ('','$ref','$user_name','$notes','$reject_s1','$filecode','$date','$time')
			  ");				
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-danger">Your Request# '.$ref.' Has Been Rejected! </div>
                            </div>'; }
							?><meta http-equiv="refresh" content="1; URL='approv'" /><?php
				///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("Error: no files uploaded!");

	$file_count = count($_FILES["item_file"]['name']);
	

    
	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$t.$ref.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$t.$ref.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					//echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time) values
                                                                    ('','$ref','$user_name','$notes','$file_name','$filecode','$date','$time')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
                            }

							if (isset($_POST['sentback'])){
                                
    $approver_id=$get_all['approver_id'];
	$notes1=clean($_POST['notes']);
	$notescount=strlen($notes1);
	$get_all=last_activity($ref);
								$lastuser=$get_all['last_user'];
								$req=$get_all['requester'];
								$dept=$get_all['req_dept'];
								$formname=$get_all['formname'];
								$reqid=$get_all['requester_id'];
								$css=$get_all['current_status'];
								
								 if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
								$return_s2='Return Back - as '.$css1;
                               $prevu=$get_all['last_activity_user'];
								
							
								 $lnote=last_notes($ref);
							   $inv=$lnote['invoice_no'];
								$cancel_status=$lnote['cancel_status'];
									 
									 if($get_all['current_status']=='accountant' or $get_all['current_status']=='approver') {
		
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,
last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
('','$ref','$req','$rqid','$dept','$req','$apr','return_back','return_back','$req','$user_name','$date','$time','Requester',0,0)") or die (mysql_error());

			$del=mysql_query("delete from transactions where ref=$ref and accountant<>'' ");						
		
		$return_s1=' Return Back to Requester';
		}
		
								 if($get_all['current_status']=='sa' or $get_all['current_status']=='ca') {
									 
	$uapp=mysql_query("select * from accountants where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
	    ('','$ref','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','accountant',1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref and current_status='sr_accountant' or current_status='ca'");
	}					
								  
								  $return_s1=$user_name.' Return Back to Accountant';
								 
		}		 
								 
							 if($get_all['current_status']=='teller' or $get_all['current_status']=='bk') {
		$uapp=mysql_query("select * from ca where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,sr_accountant) values
	    ('','$ref','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','ca',1,1,1)") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref and current_status='teller' or current_status='bk'");
	}
		
		$return_s1=' Return Back to Cheif Accountant';
		}		 	 
								 
								 if($get_all['current_status']=='gd' ){
			
$uapp=mysql_query("select * from approvers where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}

	foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	    ('','$ref','$req','$rqid','$dept','$aprs','$apr','return_back','return_back','$aprs','$user_name','$date','$time','approver')") or die (mysql_error());
	$del=mysql_query("delete from transactions where ref=$ref and current_status='gd'");
	}					
								  
								  $return_s1=$user_name.' Return Back to Approver';
								 
								 }
                                
                                  $inserthold=mysql_query("insert into sent_back (id,ref,req,username,entry_date,entry_time,status,dept,formname) values
                                                                        ('','$ref','$req','$user_name','$date','$time','return back','$req_dept','$formname')
                                ");
                                
                               if($notescount==0){$notes=$return_s1;}
							
			  else{ $notes=$notes1;}
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                 ('','$ref','$user_name','$notes','$return_s2','$filecode','$date','$time','$cancel_status','$inv')
			  ");				
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-warning">Your Request# '.$ref.' Has Been returned Back </div>
                            </div>';}
							?><meta http-equiv="refresh" content="1; URL='approv'" /><?php
							
											///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("");

	$file_count = count($_FILES["item_file"]['name']);
	

    
	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$t.$ref.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$t.$ref.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					//echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                    ('','$ref','$user_name','$notes','$file_name','$filecode','$date','$time','$cancel_status','$inv')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
                            }
							
							
							
							if (isset($_POST['submitag'])){
                                $lnote=last_notes($ref);
							   $inv=$lnote['invoice_no'];
								$cancel_status=$lnote['cancel_status'];
								$notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  
	 
$lac=last_activity($ref);
                               $req_dept=$lac['req_dept'];
							   $req=$lac['requester'];
							   $css=$lac['current_status'];
							   $invn=$lac['invoice_no'];
							   $lnote=last_notes($ref);
							   $inv=$lnote['invoice_no'];
							   
							    if ($css=='approver'){$css1='Approver';}
								if ($css=='gd'){$css1='Group Director';}
								if ($css=='accountant'){$css1='Accountant';}
								if ($css=='sa'){$css1='Sr Accountant';}
								if ($css=='ca'){$css1='Chief Accountant';}
								if ($css=='teller'){$css1='Teller';}
								if ($css=='bk'){$css1='Book Keeper';}
								
							   $subag='Resubmitted Request - as '.$css;
							   $uapp=mysql_query("select * from approvers where dept='$req_dept'");
						while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}
							   

	  foreach($apr_name as $aprs){
		  
		  $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	                                ('','$ref','$user_name','','$req_dept','$aprs','','Requested','Resubmit','$user_name','$date','$time','approver')") or die (mysql_error());
									$del=mysql_query("delete from transactions where ref=$ref and final_status<>'Resubmit'");
									
	  }
	  
                                if($notescount==0){$notes=$user_name.' Resubmitted Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
			  
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
                 ('','$ref','$user_name','$notes','$subag','$filecode','$date','$time','$cancel_status','$inv')
			  ");		
			  
			  
			  
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                            </div>
                            
                            <?php 
                                
                                if ($instra) {echo '<div class="alert alert-success">Your Request# '.$ref.' Has Been Submited! </div>
                            </div>';?>
							
							<meta http-equiv="refresh" content="1; URL='finance'" />
						<?php 
	
							}
				///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("Error: no files uploaded!");

	$file_count = count($_FILES["item_file"]['name']);
	

    
	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$t.$ref.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$t.$ref.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					//echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time,cancel_status,invoice_no) values
                                                                    ('','$ref','$user_name','$notes','$file_name','$filecode','$date','$time','$cancel_status','$inv')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
                            }
							
							
						
						if (isset($_POST['submitac'])){
                                
                                $get_all=last_activity($ref);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
								$requester_id=$get_all['requester_id'];
                                $approver_id=$get_all['approver_id'];
								$subject='Accountant Submit the Request REF# '.$ref.' in Oracle' ;
                                $insert=mysql_query("insert into transactions (id,ref,requester,requester_id,approver,approver_id,status,last_activity_user,last_activity_date,last_activity_time,accountant,accountant_status) values
                                                                                ('','$ref','$requester','$requester_id','$approver','$approver_id','approved','$user_name','$date','$time','$user_name','1')
                                ");
                                
                               $notes1=clean($_POST['notes']);
								$notescount=strlen($notes1);
								
                                if($notescount==0){$notes='Accountant Submit Request Ref# '.$ref;}
							
								else{ $notes=$notes1;}
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref','$user_name','$subject','$notes','$filecode','$date','$time')
                                ");
								
								$update=mysql_query("update transactions set final_status='approved' where ref='$ref'");
                                 ?>
                                
                                <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
									
                            </div>
                            
                            <?php 
                                
                                if ($insert) {echo '<div class="alert alert-success">Your Request# '.$ref.' Has Been Submited! </div>
                            </div>';
							?><meta http-equiv="refresh" content="1; URL='approv'" /><?php
							}
                            }	
							
				
							if (isset($_POST['archive'])){
                               
                                $get_all=last_activity($ref);
								$lastuser=$get_all['last_activity_user'];
								$req=$get_all['requester'];
                                
										 
									 
								 $insert=mysql_query("update transactions set status='completed',final_status='completed',last_user='$user_name',
								last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time',t_status=1
								 where ref=$ref");
								 
                                
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref','$user_name','Bookkeeper Archived','Archived','$filecode','$date','$time')
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









                    <!-- Invoice Block -->
                    <div class="block full">
                        <!-- Invoice Title -->
                        <div class="block-title">
                            <div class="block-options pull-right">
                          
                            </div>
                            <h2><strong>REF</strong> #<?php echo $ref;?></h2>
                        </div>
                        <!-- END Invoice Title -->

                        <!-- Invoice Content -->
                        <!-- 2 Column grid -->
                        <div class="row block-section">
                            <!-- Company Info -->
                            <div class="col-sm-6">
                                <!--- <img src="users_pics/<?php echo $tranc['requester_id'];?>.jpg" width="64" height="64" alt="photo" class="img-circle"> -->
                                <hr>
                                <h2><strong>Requester Information</strong></h2>
                                <address>
                                    <?php echo $tranc['requester'];?><br>
                                    Designation<br>
                                    <b><?php echo $tranc['req_dept'];?></b><br>
                                    <i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $approvr1['email'];?>"><?php echo $approvr1['email'];?></a>
                                </address>
                            </div>
                            <!-- END Company Info -->

                            <!-- Client Info -->
                            <div class="col-sm-6 text-right">
                               <!-- <img src="users_pics/<?php echo $tranc['approver_id'];?>.jpg" alt="photo" width="64" height="64" class="img-circle"> -->
                                <hr>
                                <h2><strong>Approver Information</strong></h2>
                                <address>
                                    <?php echo $app=$tranc['approver']; $appr=approver($app); ?><br>
                                    Designation<br>
                                     <?php echo $appr['dept'];?><br>
                                    <a href="mailto: <?php echo $appr['email'];?>"> <?php echo $appr['email'];?></a> <i class="fa fa-envelope-o"></i>
                                </address>
                            </div>
                            <!-- END Client Info -->
                        </div>
                        <!-- END 2 Column grid -->

                        <hr>

                        <!-- Table -->
                        

<div class="col-sm-12 text-right" style="margin-bottom: -20px;">
                                
                                
                                
                                  
                                <b>REF#: <?php echo $ref;?></b> <br>
                                <b>Date: <?php echo date('m/d/Y',strtotime($row['created_date']));?></b><br><br>
                                <br><br>
								<div class="clearfix"></div>
                            </div>

                        <?php include 'tables.php';?>
<div class="clearfix"></div><br>
<div class="col-md-12">
                            <!-- Timeline Widget -->
                            <div class="widget">
                                <div class="widget-extra themed-background-dark">
                                    
                                    <h3 class="widget-content-light">
                                        Latest <strong>Activities</strong>
                                        <small><strong>Complete History</strong></small>
                                    </h3>
					
                                </div>
                                <div class="widget-extra"><br />
                      <div class="col-sm-6">          
<div class="timeline">
                                        <ul class="timeline-list">
                                            
                                            <?php 
											$sql=mysql_query("select * from notes where ref='$ref' group by code order by id desc");
											while ($row=mysql_fetch_array($sql)) {
											 $username=$row['username'];
											 $code=$row['code'];
											 
											 
											?>
                                            <li class="active">
                                                <div class="timeline-icon"><i class="fa fa-pencil"></i></div>
                                                <div class="timeline-time"><small><?php echo $row['entry_date'].' '.$row['entry_time'];?></small></div>
                                                <div class="timeline-content">
                                                    <p class="push-bit"><strong><span style="color:#1BC4EA;"><?php echo $row['username'].' - '. $row['status'];?></span></strong></p>
                                                    <p class="push-bit">
													<?php if(strlen($row['notes'])==0) {echo 'No Notes Available';}else {echo $row['notes'];} ?><hr>
													Attachments:<br>
													<?php   $c=$row['code'];
													$filesn=mysql_query("select * from notes where username='$username' and  code=$c");
													while($fr=mysql_fetch_array($filesn)){
														
										
														$files= $fr['filename'];
														
														echo '<a href="uploads/'.$files.'" target="_blank" download>'.$files.'</a><br>';
														
												 
													}
														?>
												</div>
                                            </li> 
											<?php }?>
                                        </ul>
                                    </div>
									</div>
									
											<?php $ociup=oci_parse($conn, "select * from ap_invoices_all where attribute4='$ref'") or die (oci_error());
oci_execute ($ociup);

while($rr=oci_fetch_array($ociup, OCI_ASSOC+OCI_RETURN_NULLS)){ $inss[]=$rr['INVOICE_ID']; $count=count($inss);}
   if ($count > 1){ ?>
									<div class="col-sm-6">
									<div class="alert alert-info"><h4><b>Multiple Invoices Status</b></h4></div>
							
									 <table class="table">
    <thead>
      <tr>
        <th>Invoice Number</th>
        <th>Status</th>
        <th>User</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	
	
   
	foreach($inss as $invn){

$oci2=oci_parse($conn, "SELECT XXAP_GET_INVOICE_STATUS ('$invn') as status FROM DUAL") or die (oci_error());
oci_execute ($oci2);
$row2=oci_fetch_array($oci2, OCI_ASSOC+OCI_RETURN_NULLS);
$valid=$row2['STATUS'];

$ociup3=oci_parse($conn, "select * from ap_invoices_all where INVOICE_ID='$invn'") or die (oci_error());
oci_execute ($ociup3);
$row3=oci_fetch_array($ociup3, OCI_ASSOC+OCI_RETURN_NULLS);
$invoice_num=$row3['INVOICE_NUM'];
$orcname=$row3['LAST_UPDATED_BY'];
$status=$row3['WFAPPROVAL_STATUS'];
$paid=$row3['AMOUNT_PAID'];
 $inv_amount=$row3['INVOICE_AMOUNT'];
  $payment_status_flag=$row3['PAYMENT_STATUS_FLAG'];

$getname=oci_parse($conn, "select * from fnd_user_view where USER_ID='$orcname'") or die (oci_error());
oci_execute ($getname);
$namer=oci_fetch_array($getname, OCI_ASSOC+OCI_RETURN_NULLS);
$username=$namer['USER_NAME'];

$voids=oci_parse($conn, "select * from ap_invoice_payments_all where invoice_id='$invn' order by accounting_event_id desc") or die (oci_error());
oci_execute ($voids);
$voidr=oci_fetch_array($voids, OCI_ASSOC+OCI_RETURN_NULLS);
$void_s=$voidr['REVERSAL_FLAG'];

	?>
      <tr>
        <td><?php echo $invoice_num ;?></td>
        
		<td><?php
			if($status=='REQUIRED' and $valid<>'Validated'){echo 'Invoice SUBMITTED';}
			if($valid=='Validated' and $status=='REQUIRED'){echo 'Invoice VALIDATED';}
			if($status=='MANUALLY APPROVED' or $status=='WFAPPROVED'){
			
			if (!empty($paid) ){
			
			if($inv_amount==$paid ){echo 'PAID in Full';}
			
			if($inv_amount!=$paid){
			
			if($void_s=='Y'){echo 'Partial VOIDED';}else {echo 'Partially PAID';}
			}
			
			} 
			
			elseif (empty($paid) and $void_s=='Y'){echo 'Full VOIDED';}
			
			
						
			else {
			if($valid<>'Cancelled'){
			echo 'Invoice APPROVED';}}
			}
			
			if($valid=='Cancelled' and $void_s<>'Y') {echo 'Invoice CANCELLED';}
			
			
			 ?></td>
		
		
        <td><?php echo $username; ?></td>
      </tr>
	  
	  
    <?php } ?>
    </tbody>
  </table>
  
  
  
									</div>
									<?php } ?>
                                    </div>
									
                                    </div>
                                    </div>
                        <!-- END Table -->
                        <div class="clearfix"></div>



                        <div class="clearfix">
                            <form action="view?ref=<?php echo $ref;?>" method="post" enctype="multipart/form-data" name="upload-form" id="upload-form">
							<br /> <b>Other Notes</b><textarea name="notes" id="notes" rows="9" class="form-control"></textarea>
<div align="center">
							<br />
							<?php 
                                 if(in_array($user_name,$all) and $last_act['status']!='return_back') {
									 
									 
									 if ($cs=='accountant'){
									 
									  if ($last_act['status']!='on-hold'){
									 ?>
									 
									 
									 <button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
                                     <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
                                     <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
									
									<?php }else {?>
										 
<button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
                                     <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
									
								 <?php }}
								 
								 
									 
								 elseif ($cs=='sa' or $cs=='teller' or $cs=='ca' ){
									 
									 if ($last_act['status']!='on-hold'){
									 ?>
									 
									 
                                     <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
                                     <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
									
									<?php }else {?>
										 
                                     <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
									
								 <?php }}
									 
									 else {

									 
									 if ($cs=='bk'){
									 if ($last_act['status']=='on-hold') {
									 ?>
						 <button type="submit" name="archive" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i> Archive</button>
							<?php  }else {?>
													
 <button type="submit" name="archive" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn btn-primary"><i class="fa fa-thumbs-o-up"></i> Archive</button>
 <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
													
													
													<?php 
												}}
						
						else {
									 
									 
									if($last_act['status']=='reject'){}else { ?>
									 
									 <input type="hidden" value="demo" name="<?php echo ini_get("session.upload_progress.name"); ?>"/>
													 <div id="dvFile0"><input type="file" name="item_file[]" onChange="checkExtension(this.value)"></div><div id="dvFile1"></div>
        <a href="javascript:_add_more(0);"><B>(+) Add file</B></a>
        <br /><br />
		
		
                                            <?php } if($last_act['status']=='on-hold'){?>
											
											<button type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn  btn-success"><i class="fa fa-thumbs-o-up"></i> Approve</button>
                                                <button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
                                                <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
											<?php }else { 
											if($last_act['status']=='reject'){}else {
											?>
                                                <button type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn  btn-success"><i class="fa fa-thumbs-o-up"></i> Approve</button>
                                                <button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
                                                <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
                                                <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
											<?php }}?>
									 
									 
<?php }}}
									 
									 else{ 
													
													 if($last_act['status']=='return_back'){
														 

													 if(in_array($user_name,$backs) and $last_act['status']=='return_back' and $btn!=1  ){
														if ($last_act['current_status']=='Requester'){
													 ?>
													 <input type="hidden" value="demo" name="<?php echo ini_get("session.upload_progress.name"); ?>"/>
													 <div id="dvFile0"><input type="file" name="item_file[]" onChange="checkExtension(this.value)"></div><div id="dvFile1"></div>
        <a href="javascript:_add_more(0);"><B>(+) Add file</B></a>
        <br /><br>
		<button type="submit" name="submitag" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn  btn-primary"><i class="fa fa-thumbs-o-up"></i> Submit</button>

													 <?php }
if($last_act['current_status']=='accountant'){?>
<button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
             <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
           <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>

<?php
}

		elseif($last_act['current_status']=='sa' or $last_act['current_status']=='ca' or $last_act['current_status']=='teller') {?>

             <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
           <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
													 <?php }}else {
														 ?>
													 <input type="hidden" value="demo" name="<?php echo ini_get("session.upload_progress.name"); ?>"/>
													 <div id="dvFile0"><input type="file" name="item_file[]" onChange="checkExtension(this.value)"></div><div id="dvFile1"></div>
        <a href="javascript:_add_more(0);"><B>(+) Add file</B></a>
        <br /><br>
				<button type="submit" name="approved" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn  btn-success"><i class="fa fa-thumbs-o-up"></i> Approve</button>
                  <button name="sentback" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Return Back" class="btn btn-warning"><i class="fa fa-reply"></i> Return Back</button>  
                     <button name="on-hold" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Hold On" class="btn btn-info"><i class="fa fa-pause"></i>Hold-On</button> 
        <button name="reject" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
												
													 
												
													
													<?php 
													 }}
													 else {
														 
														 if($last_act['accountant']==$user_name and $last_act['accountant_status']<>1){?>
															

													<button type="submit" name="submitac" value="<?php echo $approv_r['ref'];?>" data-toggle="tooltip" title="Approve" class="btn  btn-primary"><i class="fa fa-thumbs-o-up"></i> Submit</button>
														 <?php }else {
														 
                                               echo '<a href="finance" class="btn btn-primary">Go Back to Dashboard</a>';
														 }
													}} ?>
									 
										 
										 
                            </div>
                            </form>
                        </div>
                        <!-- END Invoice Content -->
                        
                    </div>
                    <!-- END Invoice Block -->
                </div>
                
                <?php include 'footer.php';?>
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js" type="text/javascript"></script> 

<script language="JavaScript" type="text/javascript">

// allow all extensions
var exts = "";

// only allow specific extensions
// var exts = "jpg|jpeg|gif|png|bmp|tiff|pdf";

function checkExtension(value)
{
    if(value=="")return true;
    var re = new RegExp("^.+\.("+exts+")$","i");
    if(!re.test(value))
    {
        alert("Your file extension is not allowed: \n" + value + "\n\nOnly the following extensions are allowed: "+exts.replace(/\|/g,',')+" \n\n");
        return false;
    }

    return true;
}

$(document).ready(function() { 
//

//show the progress bar only if a file field was clicked
	var show_bar = 0;
    $('input[type="file"]').click(function(){
		show_bar = 1;
    });

//show iframe on form submit
    $("#upload-form").submit(function(){

		if (show_bar === 1) { 
			$('#progress-frame').show();
			function set () {
				$('#progress-frame').attr('src','progress-frame.php?up_id=<?php echo $up_id; ?>');
			}
			setTimeout(set);
		}
    });
//

});


var next_id=0;

var max_number =20;

	function _add_more() {
		
		if (next_id>=max_number)
		{
			alert("You reached maximum number of 20 files!");
			return;
		}

		next_id=next_id+1;
		var next_div=next_id+1;
		var txt = "<br><input type=\"file\" name=\"item_file[]\" onChange=\"checkExtension(this.value)\">";
		txt+='<div id="dvFile'+next_div+'"></div>';
		document.getElementById("dvFile" + next_id ).innerHTML = txt;
	}


	function validate(f){
		var chkFlg = false;
		for(var i=0; i < f.length; i++) {
			if(f.elements[i].type=="file" && f.elements[i].value != "") {
				chkFlg = true;
			}
		}
		if(!chkFlg) {
			alert('Please browse/choose at least one file');
			return false;
		}
		f.pgaction.value='upload';
		return true;
	}
</script>