<meta http-equiv="refresh" content="2">

<?php 
include 'functions.php';
$conn=oci_connect('apps','apps','erptest.panafrica.com:1571/RND');

 
$con= mysql_connect("localhost","umer","kingumer");
$db= mysql_select_db('prototype',$con);


$sql=mysql_query("select distinct ref,req_dept from prototype.transactions where accountant<>'' and t_status<>1 or cancel_status=1") or die (mysql_error());
while($row=mysql_fetch_array($sql)){ $ref[]=$row['ref']; $dept=$row['req_dept'];

echo '<pre>';

}
$t=time();
$r=rand();
$filecode=$t.$r;
print_r($ref);


if (empty($ref)){echo 'no value available';}else {
foreach($ref as $key){
$oci=oci_parse($conn, "select * from ap_invoices_all where attribute4='$key' order by INVOICE_ID desc") or die (oci_error());
oci_execute ($oci);
$row1=oci_fetch_array($oci, OCI_ASSOC+OCI_RETURN_NULLS);

$inv=$row1['INVOICE_ID'];
$orcname=$row1['LAST_UPDATED_BY'];


$voids=oci_parse($conn, "select * from ap_invoice_payments_all where invoice_id='$inv'") or die (oci_error());
oci_execute ($voids);
$voidr=oci_fetch_array($voids, OCI_ASSOC+OCI_RETURN_NULLS);
$void_s=$voidr['REVERSAL_FLAG'];

$getname=oci_parse($conn, "select * from fnd_user_view where USER_ID='$orcname'") or die (oci_error());
oci_execute ($getname);
$namer=oci_fetch_array($getname, OCI_ASSOC+OCI_RETURN_NULLS);
$username=$namer['USER_NAME'];


$date=date('Y-m-d');
$time=date('h:i:s');

$oci2=oci_parse($conn, "SELECT XXAP_GET_INVOICE_STATUS ('$inv') as status FROM DUAL") or die (oci_error());
oci_execute ($oci2);
$row2=oci_fetch_array($oci2, OCI_ASSOC+OCI_RETURN_NULLS);

echo $valid=$row2['STATUS'];
$status=$row1['WFAPPROVAL_STATUS'];
$paid=$row1['AMOUNT_PAID'];
 $inv_amount=$row1['INVOICE_AMOUNT'];
 echo  $payment_status_flag=$row1['PAYMENT_STATUS_FLAG'];

$no=mysql_query("select * from notes where ref='$key' order by id desc");
$nor=mysql_fetch_array($no);
$acc_status=$nor['acc_status'];
$sr_acc=$nor['sr_acc'];
$ch_acc=$nor['ch_acc'];
$cashier=$nor['cashier'];
$cancel_status=$nor['cancel_status'];
$void_status=$nor['void_status'];

if ($valid=='Cancelled'){
	
	if ($cancel_status==1){}else {
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from accountants where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,back_status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant) values
	                                ('','$key','$req','','$dept','$gd_name','','return_back','$gd_name','return_back','$username','$date','$time','$username',1,1,'$gd_name')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and back_status=''");
						}
						
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,cancel_status) values ($key,'$username','Chief Accountant CANCELLED the Request','Request CANCELLED','$filecode','$date','$time','1') ");
	
	}
	
}


if($status=='REQUIRED'){
	
if ($acc_status==1){}else {
	
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from sr_accountant where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','$username',1,1,1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and sr_accountant<>1")or die (mysql_error());
						}
							
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status) values 
													($key,'$username','Accountant submit invoice in oracle','Submitted in Oracle','$filecode','$date','$time','1') ")or die (mysql_error());
	
	}	
	
	
}


if($valid=='Validated'){
	
	if($sr_acc==1){}else{

$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from ca where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','$username',1,1,1,1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and approver<>'$gd_name'");
						}
							
		$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc) values ($key,'$username','Sr Accountant Validated in oracle','Validated in Oracle','$filecode','$date','$time',1,1) ");

	}	

}


if($status=='MANUALLY APPROVED' or $status=='WFAPPROVED' and $paid==''){
	
	if($ch_acc==1){}else{

$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from teller where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','$username',1,1,1,1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and approver<>'$gd_name'");
						}
							
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc) values ($key,'$username','Chief Accountant Approved in oracle','Approved in Oracle','$filecode','$date','$time',1,1,1) ");
	
	}		



}


if(empty($paid) and $status=='MANUALLY APPROVED' and $void_s=='Y'){
	
	if($void_status==1){}else{
$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from ca where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','$username',1,1,1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and approver<>'$gd_name'");
						}	
						
						$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,void_status) values ($key,'$username','Book Keeper Void Payment','Cashier Void Payment','$filecode','$date','$time',1,1,1,0,1) ");
}
}




if(!empty($paid)){
	
	if($inv_amount==$paid) {
			if($cashier==1){}else{
			
$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from bk where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant,paid) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','$username',1,1,1,1,1,1)") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and paid<>1");
						}	
	
	
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier) values ($key,'$username','Cashier Paid','Cashier Paid','$filecode','$date','$time',1,1,1,1) ");
}

}
}


}
}


?>