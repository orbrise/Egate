<?php 

function clean($str){
	
	return addslashes($str);
	
}

function custom_echo($x, $length)
{
  if(strlen($x)<=$length)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    echo $y;
  }
}

function userdata($userid){
	
	$sel=mysql_query("select * from users where user_id='$userid'");
	return mysql_fetch_array($sel);
}

function approver($user_name){
	
	$appr=mysql_query("select * from users where username='$user_name' ");
	return $appr_r=mysql_fetch_array($appr);
	 
}

function approver1($user_name,$dept){
	
	$appr1=mysql_query("select * from $dept where username='$user_name' ");
	return $appr_r1=mysql_fetch_array($appr1);
	 
}


function user_type($user_name){
	
	$type=mysql_query("select * from users where username='$user_name' ");
	$type_r=mysql_fetch_array($type);
	return $type_r['type'];
}

function approval_list($app){
	
	//return $getl=mysql_query("select * from transactions where  approver='$user_name' and status='Requested'  order by id desc");
	
	return $getl=mysql_query("select * from transactions where approver='$app' and t_status=0  group by ref order by ref desc");
	
	}



function getform_data($ref){
	
	$getform=mysql_query("select * from formsdata where ref='$ref'");
	return mysql_fetch_array($getform);
	
}


function last_activity($ref){
	
	$lastac=mysql_query("select * from transactions where ref='$ref' order by id desc");
	return mysql_fetch_array($lastac);
} 




function all_approver($ref){
	
	$lastac1=mysql_query("select * from transactions where ref='$ref'");
	while ($lr=mysql_fetch_array($lastac1)){
		 $all_app[]=$lr['approver'];
	}
	return $all_app;
} 


function last_notes($ref){
	$lastnot=mysql_query("select * from notes where ref='$ref' order by id desc");
	return mysql_fetch_array($lastnot);
}

function get_ap($user_name,$dept){
	$gapp=mysql_query("select * from approvers where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_gd($user_name,$dept){
	$gapp=mysql_query("select * from group_directors where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_ac($user_name,$dept){
	$gapp=mysql_query("select * from accountants where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_sa($user_name,$dept){
	$gapp=mysql_query("select * from sr_accountant where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_ca($user_name,$dept){
	$gapp=mysql_query("select * from ca where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_teller($user_name,$dept){
	$gapp=mysql_query("select * from teller where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function get_bk($user_name,$dept){
	$gapp=mysql_query("select * from bk where username='$user_name' and dept='$dept'");
	return mysql_num_rows($gapp);
}

function maxid(){
	
	$mid=mysql_query("select max(ref) as mx from transactions");
	$midr=mysql_fetch_array($mid);
	return $midr['mx']+1;
	}
	
	
function getid($user_name){

$getid1=mysql_query("select * from users where username='$user_name'");
return mysql_fetch_array($getid1);

	}

function get_username($users){

$getname=mysql_query("select * from users where username='$users'");
$n=mysql_fetch_array($getname);
return $n['username'];
	}


function get_approver_status($user_name){
	
	$getap=mysql_query("select * from users where username='$user_name'");
	 return mysql_fetch_array($getap);
}

function total_app($username,$f,$l){
	
	$tapp=mysql_query("select distinct ref from transactions  where approver='$username' and t_status=0 and last_activity_date between '$f' and '$l' and status<>'on-hold' and status<>'return_back' and status<>'reject' ");
	return mysql_num_rows($tapp);
}

function total_req($username ,$f,$l){	
	$treq=mysql_query("select distinct ref from transactions where approver='$username' and last_activity_date between '$f' and '$l' and status='return_back' and t_status=0 and paid<>1 ");
	return mysql_num_rows($treq);
}

function total_reqr($username,$f,$l){	
	$treqr=mysql_query("select distinct ref from transactions where requester='$username' and last_activity_date between '$f' and '$l' and status='return_back' and t_status=0 and paid<>1 ");
	return mysql_num_rows($treqr);
}

function total_hold($username,$f,$l){
	$thold=mysql_query("select distinct ref from transactions where approver='$username' and last_activity_date between '$f' and '$l' and status='on-hold' and t_status=0 and paid<>1");
	return mysql_num_rows($thold);
}

function total_holdr($username,$f,$l){
	$tholdr=mysql_query("select distinct ref from transactions where requester='$username' and last_activity_date between '$f' and '$l' and status='on-hold' and t_status=0 and paid<>1");
	return mysql_num_rows($tholdr);
}


function total_regect($username,$f,$l){
	$trej=mysql_query("select distinct ref from transactions where approver='$username' and last_activity_date between '$f' and '$l' and status='reject' and t_status=1 and paid<>1");
	return mysql_num_rows($trej);
}

function total_regectr($username,$f,$l){
	$trejr=mysql_query("select distinct ref from transactions where requester='$username' and last_activity_date between '$f' and '$l' and status='reject' and t_status=1 and paid<>1");
	return mysql_num_rows($trejr);
}

function pre_app($user_name,$dept){
	$prev=mysql_query("select * from $dept where approver='$user_name'");
	$pre_r=mysql_fetch_array($prev);
	return $pre_r['username'];
}


function last_attachments($ref){
	$la=mysql_query("select * from notes where ref=$ref and filename<>'' order by id desc");
	return mysql_fetch_array($la);
	
}

function userstatus($ref,$username){
	
	$geta=mysql_query("select * from approves where ref=$ref and username='$username'");
	$geth=mysql_query("select * from on_hold where ref=$ref and username='$username'");
	$getr=mysql_query("select * from reject where ref=$ref and username='$username'");
	$gets=mysql_query("select * from sent_back where ref=$ref and username='$username'");
	
	return $numa=mysql_num_rows($geta);
	return $numh=mysql_num_rows($geth);
	return $numr=mysql_num_rows($getr);
	return $nums=mysql_num_rows($gets);
	
}

function u_appr($dept){
return	$uapp=mysql_query("select * from approvers where dept='$dept'");


}

function get_ap1($user_name){
	$gapp=mysql_query("select * from approvers where username='$user_name' ");
	return mysql_num_rows($gapp);
}

function get_gd1($user_name){
	$gapp=mysql_query("select * from group_directors where username='$user_name' ");
	return mysql_num_rows($gapp);
}

function get_ac1($user_name){
	$gapp=mysql_query("select * from accountants where username='$user_name' ");
	return mysql_num_rows($gapp);
}

function get_sa1($user_name){
	$gapp=mysql_query("select * from sr_accountant where username='$user_name' ");
	return mysql_num_rows($gapp);
}

function get_ca1($user_name){
	$gapp=mysql_query("select * from ca where username='$user_name' ");
	return mysql_num_rows($gapp);
}

function get_teller1($user_name){
	$gapp=mysql_query("select * from teller where username='$user_name'");
	return mysql_num_rows($gapp);
}

function get_bk1($user_name){
	$gapp=mysql_query("select * from bk where username='$user_name'");
	return mysql_num_rows($gapp);
}



?>