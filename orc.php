 <meta http-equiv="refresh" content="2">

<?php 
include 'functions.php';
$conn=oci_connect('apps','apps','erptest.panafrica.com:1571/RND');

 
$con= mysql_connect("localhost","umer","kingumer");
$db= mysql_select_db('prototype',$con);

$t=time();
$r=rand();
$filecode=$t.$r;


$sql=mysql_query("select distinct ref,req_dept from prototype.transactions where accountant<>'' and t_status<>1 or cancel_status=1") or die (mysql_error());
while($row=mysql_fetch_array($sql)){ $ref[]=$row['ref']; $dept=$row['req_dept'];
echo '<pre>';

}
print_r($ref);

if (empty($ref)){echo 'no value available';}else {
foreach($ref as $key){


$oci=oci_parse($conn, "select * from ap_invoices_all where attribute4='$key' order by INVOICE_ID desc") or die (oci_error());
oci_execute ($oci);
$row1=oci_fetch_array($oci, OCI_ASSOC+OCI_RETURN_NULLS);

 $inv=$row1['INVOICE_ID'];
 $inv_num=$row1['INVOICE_NUM'];
$orcname=$row1['LAST_UPDATED_BY'];



$voids=oci_parse($conn, "select * from ap_invoice_payments_all where invoice_id='$inv' order by accounting_event_id desc") or die (oci_error());
oci_execute ($voids);
$voidr=oci_fetch_array($voids, OCI_ASSOC+OCI_RETURN_NULLS);
$void_s=$voidr['REVERSAL_FLAG'];
$void_s=$voidr['REVERSAL_FLAG'];
$check_id=$voidr['CHECK_ID'];


$checkidd=oci_parse($conn, "select * from ap_checks_all where check_id='$check_id' order by check_id desc") or die (oci_error());
oci_execute ($checkidd);
$checkiddr=oci_fetch_array($checkidd, OCI_ASSOC+OCI_RETURN_NULLS);
$checknumber=$checkiddr['CHECK_NUMBER'];
$amount=$checkiddr['AMOUNT'];


$getname=oci_parse($conn, "select * from fnd_user_view where USER_ID='$orcname'") or die (oci_error());
oci_execute ($getname);
$namer=oci_fetch_array($getname, OCI_ASSOC+OCI_RETURN_NULLS);
$username=$namer['USER_NAME'];


$date=date('Y-m-d');
$time=date('h:i:s');

$oci2=oci_parse($conn, "SELECT XXAP_GET_INVOICE_STATUS ('$inv') as status FROM DUAL") or die (oci_error());
oci_execute ($oci2);
$row2=oci_fetch_array($oci2, OCI_ASSOC+OCI_RETURN_NULLS);

$valid=$row2['STATUS'];
$status=$row1['WFAPPROVAL_STATUS'];
$paid=$row1['AMOUNT_PAID'];
 $inv_amount=$row1['INVOICE_AMOUNT'];
  $payment_status_flag=$row1['PAYMENT_STATUS_FLAG'];

$no=mysql_query("select * from notes where ref='$key' order by id desc");
$nor=mysql_fetch_array($no);
$acc_status=$nor['acc_status'];
$sr_acc=$nor['sr_acc'];
$ch_acc=$nor['ch_acc'];
$cashier=$nor['cashier'];
$cancel_status=$nor['cancel_status'];
$void_status=$nor['void_status'];
$half_paid=$nor['half_paid'];
$half_void=$nor['half_void'];
$invoiceno=$nor['invoice_no'];
$dels=$nor['dels'];

/*
$no1=mysql_query("select * from notes1 where ref='$key' order by id desc");
$nor1=mysql_fetch_array($no1);
$half_void1=$nor1['half_void'];*/

$sql33=mysql_query("select *  from prototype.transactions where ref='$key' and invoice_no='$inv_num'") or die (mysql_error());
$row33=mysql_fetch_array($sql33);
$cs1=$row33['current_status'];
if($cs1=='accountant') {$cs='Accountant';}
if($cs1=='sa') {$cs='Sr Accountant';}
if($cs1=='ca') {$cs='Chief Accountant';}
if($cs1=='bk') {$cs='Bookkeeper';}


if ($valid=='Cancelled' and $void_s<>'Y' and $dels<>1 ){
	
	if ($cancel_status==1 and $invoiceno==$inv_num){}else {
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from accountants where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,back_status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','return_back','$gd_name','return_back','$username','$date','$time','accountant',1,1,'$gd_name','$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and back_status=''");
						}
						
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
	($key,'$username','$username CANCELLED the Request. Invoice Number = $inv_num','Request CANCELLED','$filecode','$date','$time','1','$inv_num') ");
	
		$del=mysql_query("delete from invoices_check where ref=$key and status='0'");
		
		
	}
	
}


if ($valid=='Cancelled' and $void_s=='Y'){
	
	if ($cancel_status==1 and $invoiceno==$inv_num){}else {
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from accountants where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,back_status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','return_back','$gd_name','return_back','$username','$date','$time','accountant',1,1,'$gd_name','$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and back_status=''");
						}
						
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,cancel_status,invoice_no) values
	($key,'$username','$username VOID Payment and CANCELLED the Request. Invoice Number = $inv_num','Request CANCELLED and Payment VOID','$filecode','$date','$time','1','$inv_num') ");
	
	}
	
}



if($status=='REQUIRED' and $valid<>'Validated' ){
	
if ($acc_status==1 and $invoiceno==$inv_num){	
/*
$ociup=oci_parse($conn, "select * from ap_invoices_all where attribute4='$key'") or die (oci_error());
oci_execute ($ociup);

while($rr=oci_fetch_array($ociup, OCI_ASSOC+OCI_RETURN_NULLS)){ $inss[]=$rr['INVOICE_NUM'];}
  $allinss= implode(",", $inss);

//$upsq=mysql_query("update prototype.notes set notes='$username submit  invoice in oracle Invoice Numbers = $inv_num' where ref=$key and status='Submitted in Oracle'");

	*/							
} else {
	
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from sr_accountant where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','sa',1,1,1,1,'$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and sr_accountant<>1")or die (mysql_error());
						}
							
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,dels,invoice_no) values 
	($key,'$username','$username submitted invoice in oracle. Invoice Number = $inv_num','Submitted invoice in Oracle','$filecode','$date','$time','1','1','$inv_num') ")or die (mysql_error());
													
			$newcheck=mysql_query("insert into prototype.invoices_check (id,ref,invoice_num,last_user,req,dept) values ('','$key','$inv_num','$username','$req','$dept')");
	
	}	
	
	
}


if($valid=='Validated' and $status=='REQUIRED'){
	
	if($sr_acc==1 and $invoiceno==$inv_num){}else{

$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from ca where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','ca',1,1,1,1,1,'$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and status='sa'");
						}
							
		$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,invoice_no) values 
		($key,'$username','$username VALIDATED invoice in oracle. Invoice Number= $inv_num','Validated in Oracle','$filecode','$date','$time',1,1,'$inv_num') ");

	}	

}

if($valid<>'Cancelled'){
if($status=='MANUALLY APPROVED' or $status=='WFAPPROVED' and $paid==''){
	
	if($ch_acc==1 and $invoiceno==$inv_num){}else{

$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
								
	$uapp=mysql_query("select * from teller where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','teller',1,1,1,1,1,'$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and approver<>'$gd_name'");
						}
							
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,invoice_no) values
	($key,'$username','$username APPROVED invoice in oracle. Invoice Number = $inv_num','Approved in Oracle','$filecode','$date','$time',1,1,1,'$inv_num') ");
	
	}		



}
}

if(empty($paid) and $status=='MANUALLY APPROVED' and $void_s=='Y' and $valid<>'Cancelled'){
	
if($void_status==1 and $invoiceno==$inv_num){}else{
$lac=last_activity($key);
$req=$lac['requester'];
$dept=$lac['req_dept'];
								
$uapp=mysql_query("select * from ca where dept='$dept'");
while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','ca',1,1,1,1,'$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and paid=1");
						}	
						
						$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,void_status,invoice_no) values 
						($key,'$username','$username VOID Full Payment <br>Total Balance: $paid/$inv_num<br> Invoice Number = $inv_num<br> Document # $checknumber and Amount: $amount',' VOID full Payment','$filecode','$date','$time',1,1,1,0,1,'$inv_num') ");
}
}




if(!empty($paid)){
	
	$lac=last_activity($key);
	$req=$lac['requester'];
	$dept=$lac['req_dept'];
	
	 if($inv_amount!=$paid){
			
			
			if($half_paid==1 and $invoiceno==$inv_num){
			
			if($void_s=='Y'){
			$sql15=mysql_query("update prototype.notes set status='Partially Void', entry_date='$date',entry_time='$time', notes='$username VOID Partial payment Amount $amount.<br> Total balance = $paid / $inv_amount <br> Invoice Number = $inv_num <br> Document # $checknumber' where ref='$key' and half_paid=1");

			}
			
			
			else{
			$sql15=mysql_query("update prototype.notes set status='Partially Paid', entry_date='$date',entry_time='$time', notes='$username Paid Partially Amount $amount.<br> Total Paid = $paid / $inv_amount <br> Invoice Number = $inv_num <br> Document # $checknumber' where ref='$key' and half_paid=1");
			}
			}
			
			else{
			
			
			if($half_paid==0 and $invoiceno==$inv_num){
			
			if($void_s=='Y' ){
			$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,half_paid,invoice_no) values 
			($key,'$username','$username VOID Partially Amount $amount.<br> Total Balance = $paid / $inv_amount<br> Invoice Number = $inv_num<br> Document # $checknumber','Partially VOID ','$filecode','$date','$time',1,1,1,1,'$inv_num') ");
	 
			}
			else {
			$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,half_paid,invoice_no) values 
			($key,'$username','$username PAID Partially Amount $amount.<br> Total Paid = $paid / $inv_amount <br> Invoice Number = $inv_num <br> Document # $checknumber','Paid Partially','$filecode','$date','$time',1,1,1,1,'$inv_num') ");
	 
	 }}
	  
	 }
	 }
	 
	
	
	
	if($inv_amount==$paid) {
			if($cashier==1 and $invoiceno==$inv_num){}else{
			

								
	$uapp=mysql_query("select * from bk where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
								
						
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant,sr_accountant,chif_accountant,paid,invoice_no) values
	                                ('','$key','$req','','$dept','$gd_name','','approved','Approved','$username','$date','$time','bk',1,1,1,1,1,1,'$inv_num')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$key and paid<>1");
						}	
	
	
	$sql4=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,sr_acc,ch_acc,cashier,invoice_no) values
	($key,'$username','$username Paid Full Amount $paid / $inv_amount <br> Invoice Number = $inv_num <br> Document # $checknumber and Amount: $amount',' Paid in Full','$filecode','$date','$time',1,1,1,1,'$inv_num') ");
}

}
}


}
}

$checkn=mysql_query("select * from  prototype.invoices_check where status=0 group by ref order by id desc");
while ($ckr=mysql_fetch_array($checkn)){
  $invs=$ckr['invoice_num'];
 $stat=$ckr['status'];

$invq=oci_parse($conn, "select * from ap_invoices_all where invoice_num='$invs'");

oci_execute ($invq);
$invqr=oci_fetch_array($invq, OCI_ASSOC+OCI_RETURN_NULLS);
   $invoice_s=$invqr['INVOICE_NUM'];
  $usr=$invqr['LAST_UPDATED_BY'];
  $ref_s=$invqr['ATTRIBUTE4'];
 
 $getname1=oci_parse($conn, "select * from fnd_user_view where USER_ID='$usr'") or die (oci_error());
oci_execute ($getname1);
$namer1=oci_fetch_array($getname1, OCI_ASSOC+OCI_RETURN_NULLS);
$username1=$namer1['USER_NAME'];


if(empty($invoice_s)){

	$deln=mysql_query("update  prototype.invoices_check set  status=1 where invoice_num='$invs'");
	
}



}


$checkn1=mysql_query("select * from  prototype.invoices_check where status=1");
while ($ckr1=mysql_fetch_array($checkn1)){
 $invs1=$ckr1['invoice_num'];
 $stat1=$ckr1['status'];
  $del=$ckr1['del'];
$user=$ckr1['last_user'];
$reff=$ckr1['ref'];
$req=$ckr1['req'];

if($del==1){} else{

$uapp=mysql_query("select * from accountants where dept='$dept'");
								while ($newapps=mysql_fetch_array($uapp)){$gd_name=$newapps['username'];
						
						$instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,back_status,final_status,last_activity_user,last_activity_date,last_activity_time,current_status,approver_status,gd_status,accountant) values
	                                ('','$reff','$req','','$dept','$gd_name','','return_back','$gd_name','return_back','$user','$date','$time','accountant',1,1,'$gd_name')") or die (mysql_error());
									
									$del=mysql_query("delete from transactions where ref=$reff and status='sa'");
						}
						
						
$nnot=mysql_query("insert into prototype.notes (ref,username, notes,status,code,entry_date,entry_time,acc_status,del,dels) values 
											('$reff','$user','$user Deleted invoice in oracle. Invoice Number = $invs1','Deleted From Oracle','$filecode','$date','$time','0','1','1') ")or die (mysql_error());

											 $deln1=mysql_query("update  prototype.invoices_check set del=1 where invoice_num='$invs1'");

											
	}
	}
	