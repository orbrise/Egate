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
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
	                                ('','$ref','$req','$rqid','$dept','$gd','$apr','approved','approved','$user_name','$date','$time','accountant',1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$ref and approver_status=1 and gd_status=0") ;
						}
						
								}
	  
	  
     $insertapp=mysql_query("insert into approves (id,ref,req,username,entry_date,entry_time,status,dept) values
                 ('','$ref','$req','$user_name','$date','$time','approved','$dept')
                                ");
								
							if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                 ('','$ref','$user_name','$notes','approved','$filecode','$date','$time')
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

// on hold start function
                            
                             if (isset($_POST['on-hold'])){
             
	  $notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  
	   $insert=mysql_query("update transactions set status='on-hold',last_activity_user='$user_name',last_activity_date='$date',last_activity_time='$time'
								where ref=$ref ");

                                
                                  $inserthold=mysql_query("insert into on_hold (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref','$req','$user_name','$date','$time','on-hold','$dept')
                                ");
                                
                                if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	 if ($cs=='bk' or $cs=='ca' or $cs=='sa' or $cs=='accountant' or  $cs=='teller'){
								if ($cs=='bk'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s','$filecode','$date','$time',1,1,1)
                                "); }
								
								if ($cs=='ca'){
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status,sr_acc) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s','$filecode','$date','$time',1,1)
                                "); }
								
								
								if ($cs=='accountant'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s','$filecode','$date','$time')
                                ");
								}
								
								if ($cs=='sa'){ 
								
								$insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time,acc_status) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s','$filecode','$date','$time',1)
                                ");
								}
								
								
								}else {
								
                                $insertnote=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                        ('','$ref','$user_name','$hold_n','$hold_s','$filecode','$date','$time')
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

// reject functions start
                            
                             if (isset($_POST['reject'])){
                                
                                $get_all=last_activity($ref);
                                $requester=$get_all['requester'];
                                $approver=$get_all['approver'];
								$requester_id=$get_all['requester_id'];
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
                 ('','$ref','$user_name','$notes','reject','$filecode','$date','$time')
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
								$reqid=$get_all['requester_id'];
                               $prevu=$get_all['last_activity_user'];
								
							
								
								
									 
									 if($get_all['current_status']=='accountant' or $get_all['current_status']=='approver') {
		
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,back_status,
last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status) values
('','$ref','$req','$rqid','$dept','$req','$apr','return_back','return_back','$req','$user_name','$date','$time','Requester',0,0)") or die (mysql_error());

			$del=mysql_query("delete from transactions where ref=$ref and approver<>'$req'");						
		
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
                                
                                  $inserthold=mysql_query("insert into sent_back (id,ref,req,username,entry_date,entry_time,status,dept) values
                                                                        ('','$ref','$req','$user_name','$date','$time','return back','$req_dept')
                                ");
                                
                               if($notescount==0){$notes=$user_name.' Approved Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                 ('','$ref','$user_name','$return_s1','return_back','$filecode','$date','$time')
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
							
							
							
							if (isset($_POST['submitag'])){
                                
								
								$notes1=clean($_POST['notes']);
	  $notescount=strlen($notes1);
	  
	 
$lac=last_activity($ref);
                               $req_dept=$lac['req_dept'];
							   $req=$lac['requester'];
							   
							   $uapp=mysql_query("select * from approvers where dept='$req_dept'");
						while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}
							   

	  foreach($apr_name as $aprs){
		  
		  $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status) values
	                                ('','$ref','$user_name','','$req_dept','$aprs','','Requested','Resubmit','$user_name','$date','$time','approver')") or die (mysql_error());
									$del=mysql_query("delete from transactions where ref=$ref and final_status<>'Resubmit'");
									
	  }
	  
                                if($notescount==0){$notes=$user_name.' Resubmit Request Ref# '.$ref;}
							
			  else{ $notes=$notes1;}
			  
	 $insertnotes=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                 ('','$ref','$user_name','$notes','Re Submit','$filecode','$date','$time')
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
                                    Department<br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">example@example.com</a>
                                </address>
                            </div>
                            <!-- END Company Info -->

                            <!-- Client Info -->
                            <div class="col-sm-6 text-right">
                               <!-- <img src="users_pics/<?php echo $tranc['approver_id'];?>.jpg" alt="photo" width="64" height="64" class="img-circle"> -->
                                <hr>
                                <h2><strong>Approver Information</strong></h2>
                                <address>
                                    <?php echo $tranc['approver'];?><br>
                                    Designation<br>
                                     Department<br>
                                    <a href="javascript:void(0)">example@example.com</a> <i class="fa fa-envelope-o"></i>
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
                                        <small><a href="page_ready_timeline.html"><strong>Complete History</strong></a></small>
                                    </h3>
                                </div>
                                <div class="widget-extra"><br />
                                
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
                                                    <p class="push-bit"><a href="page_ready_user_profile.html"><strong><?php echo $row['username'].' - '. $row['status'];?></strong></a></p>
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
                                    </div>
                                    </div>
                        <!-- END Table -->
                        <div class="clearfix"></div>



                        <div class="clearfix">
                          
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