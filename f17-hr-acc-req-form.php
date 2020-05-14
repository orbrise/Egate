<? ob_start();//Start buffer output ?>
<?php
session_start();
$up_id = uniqid(); 
$user_name=$_SESSION['user'];
$user_id=$_SESSION['user_id'];
include 'functions.php';
if (!$_SESSION['user']) {
        header('Location:index.php');
}

?>
<?php include 'header.php' ;?>


                <!-- Page content -->
                <div id="page-content">
                    <!-- Forms General Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="gi gi-notes_2"></i> Human Resources Accruals Request Form<br/><small></small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Finance</a></li>
                        <li><a href=""> Human Resources Accruals Request Form</a></li>
                    </ul>
                    <!-- END Forms General Header -->

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Elements Block -->
                        <?php 
                        include 'connection.php'; 
						$maxid=maxid();
                        $apr_name1=approver($user_name);
						$apr_name12=$apr_name1['approver'];
						$req_dept=$apr_name1['dept'];
						
						$uapp=mysql_query("select * from approvers where dept='$req_dept'");
						while ($newapps=mysql_fetch_array($uapp)){$apr_name[]=$newapps['username'];}


						
                        $ref_no= rand(10,1000);
						$refn=$ref_no;
                        $t=time();
$r=rand();
    $filecode=$t.$r;
                        if (isset($_POST['posted'])){
                               
                                
    $requester=$user_name;
	$rid=getid($requester);
	$rqid=$rid['user_id'];
	$dept=$rid['dept'];
	//======
	$appr=getid($apr_name);
	$apr=$appr['user_id'];
	
	
	
	//========
	
	$created_date=date('Y-m-d');
	$document_date=$_POST['docdate'];
	$ref=$maxid;
	$reqno=clean($_POST['reqno']);
	
	$amount=clean($_POST['amount']);
	$ledger=clean($_POST['ledger']);
	$bsal=clean($_POST['bsal']);
	$bsalarr=clean($_POST['bsalarr']);
	$phoneallow=clean($_POST['phoneallow']);
	$ot =clean($_POST['ot']);
	$carallow=clean($_POST['carallow']);
	
	$phoneallow=clean($_POST['phoneallow']);
	$phoneallowarr=clean($_POST['phoneallowarr']);
	$otarr=clean($_POST['otarr']);
	$carallowarr=clean($_POST['carallowarr']);
	$fuelallow=clean($_POST['fuelallow']);
	$otherallow=clean($_POST['otherallow']);
	$otherallowarr=clean($_POST['otherallowarr']);
	$fuelallowarr=clean($_POST['fuelallowarr']);
	$accoallow=clean($_POST['accoallow']);
	$accoallowarr=clean($_POST['accoallowarr']);
	$adsal=clean($_POST['adsal']);
	$leavesal=clean($_POST['leavesal']);
	$leaveencashment=clean($_POST['leaveencashment']);
	$leaveprov=clean($_POST['leaveprov']);
	
	$airticketencah=clean($_POST['airticketencah']);
	$gradu=clean($_POST['gradu']);
	$grad_prov=clean($_POST['grad_prov']);
	$airticketprov=clean($_POST['airticketprov']);
	$hleaveded=clean($_POST['hleaveded']);
	$adsalrec=clean($_POST['adsalrec']);
	$gradpro=clean($_POST['gradpro']);
	$unpaidleaveded=clean($_POST['unpaidleaveded']);
	$vech=clean($_POST['vech']);
	$vechfinesded=clean($_POST['vechfinesded']);
	$latecoming=clean($_POST['latecoming']);
	
	
	$desc1=clean($_POST['description']);
	$num_notes=strlen($notes);
	$pc=$_SERVER['REMOTE_ADDR'];
	$form_name='Human Resources Accruals Request Form';
	$i_p=$_SERVER['REMOTE_ADDR'];
    $entry_time=date('h:i;s');
    $unixtime=time();
    $subject=$user_name.' Generate a Request Req# '. $ref;
    
    $insform=mysql_query("insert into formsdata (id,username,ref,created_date,benif_name,amount,invoice,due_date,description,entry_date,entry_time,Ip,status,formid,ledger,
	basic_salary,basic_salary_arrear,phone_allow,phone_allow_arr,over_time,car_allown,over_time_arrears,car_allow_arre,fule_allow,other_allow,other_allow_arre,fule_all_arre,
	accomod_allow,accomo_allow_arre,advance_salary,leave_salary,leave_encash,leave_provision,airticket_encash,grautity_encashment,grad_prov,airticket_prov,hourly_leave_deduc,
	advance_salary_recovery,unpaid_leave_deduc,vehicles_other_deduc,vehicle_fines_deduc,late_coming_deduc,form_name) values
	('','$requester','$ref','$created_date','$bname', '$amount','$invoice','$due_date','$desc1','$created_date','$entry_time','$i_p','Requested',17,'$ledger',
	'$bsal','$bsalarr','$phoneallow','$phoneallowarr','$ot','$carallow','$otarr','$carallowarr','$fuelallow','$otherallow','$otherallowarr','$fuelallowarr',
	'$accoallow','$accoallowarr','$adsal','$leavesal','$leaveencashment','$leaveprov','$airticketencah','$gradu','$grad_prov','$airticketprov','$hleaveded',
	'$adsalrec','$unpaidleaveded','$vech','$vechfinesded','$latecoming','$form_name'
	)") or die (mysql_error());
	
    
foreach($apr_name as $aprs){
     $instra=mysql_query("insert into transactions (id,ref,requester,requester_id,req_dept,approver,approver_id,status,last_activity_user,last_activity_date,last_activity_time,current_status,formname) values
	                                ('','$ref','$requester','$rqid','$req_dept','$aprs','$apr','Requested','$requester','$created_date','$entry_time','approver','$form_name')") or die (mysql_error());
}
    
     $insfile3=mysql_query("insert into notes (id,ref,username,notes,status,code,entry_date,entry_time) values
                                                                    ('','$ref','$user_name','$subject','Requested','$filecode','$created_date','$entry_time')
                                                                    ");
    
                  ?>
                  
                  <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Notification Alert</strong></h2>
                                    

                            </div>
                            <?php 
                  if($insform){
                    echo '<div class="clearfix"></div><div class="alert alert-success"> Your Request Succesfully Done! </div>';
                    
                  }
                  
                  
                  
                  
             ///// files uploading     
                  
                  	if (!isset($_FILES["item_file"]))
		die ("Error: no files uploaded!");

	$file_count = count($_FILES["item_file"]['name']);
	

	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded

		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			
			$filen = $_FILES["item_file"]['name'][$j];	
            $file_name= $user_id.$unixtime.$ref_no.$_FILES["item_file"]['name'][$j];
			// ingore empty input fields
			if ($filen!="")
			{
		
				// destination path - you can choose any file name here (e.g. random)
				$path = "uploads/" .$user_id.$unixtime.$ref_no.$filen; 

				if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$path)) { 
				
					echo '<div class="alert alert-success">File# '.($j+1). $filen. ' uploaded successfully!</div>'; 
                    
                    $insfile=mysql_query("insert into notes (id,ref,username,notes,filename,code,entry_date,entry_time) values
                                                                    ('','$ref_no','$user_name','$subject','$file_name','$filecode','$created_date','$entry_time')
                                                                    ");
                    

				} else
				{
					echo  "Errors occoured during file upload!";
				}
			}	

		}
	}
    
    // uploading finish
    
    
    
    
    ?>
    
                                               
                                                            
                            
                                    
                            
                             
                             
                            </div>
                              
                            
                                
                            <?php } ?>   
                            
                            
                            
                            <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Submit Details </strong></h2>
                                </div>
                             
                                <table class="table table-bordered" width="907" border="1">
  <tr>
    <td width="130" >Request By</td>
    <td width="222"><?php echo '<b>'.ucfirst($user_name).'</b>' ;?></td>
    <td width="143" ></td>
    <td width="384"><b>
	<?php 
	 
	echo ucfirst($apr_name);
	
	?>
	</b></td>
  </tr>
  <tr>
    <td >Post Date</td>
    <td><?php echo date('d-M-Y');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
                            </div>
                            
                            </div>
                            </div>
                            
                            
                            
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Submit The Basic Form</strong></h2>
                                </div>
                                <!-- END Form Elements Title -->

                                <!-- Basic Form Elements Content -->
                                <form action="f17-hr-acc-req-form" method="post" enctype="multipart/form-data" id="testconfirmJQ" name="testconfirmJQ">
                                    
                                    <table  align="right" style="margin-bottom:10px;">
  <tr>
    <td width="123">Date:</td>
    <td width="153"><b><?php echo date('d/m/Y');?></b></td>
  </tr>
  <tr>
    <td></td>
    <td ><b></b></td>
  </tr>
</table>
                                    
                                    
                                  <table class="table table-bordered" width="920" border="1">
								 

  <tr>
    <td valign="middle" style="vertical-align:middle;">Ledger</td>
    <td colspan="2"><select name="ledger" id="ledger" class="form-control" required>
      <option value="">Select</option>
      <option>ADCI</option>
      <option>GIFFIN</option>
      <option>IPC</option>
      <option>DREXEL</option>
      <option>CIVIC</option>
    </select></td>
    <td><span style="vertical-align:middle;">Total Amount</span></td>
    <td colspan="2"><input type="number" name="amount" id="amount" class="form-control" style="" required/></td>
   </tr>
  <tr>
    <td width="142" valign="middle" style="vertical-align:middle;">Basic Salary</td>
    <td width="167">
      <input type="number" name="bsal" id="bsal" class="form-control" style="" required/>
    </td>
    <td width="139" style="vertical-align:middle;">Basic Salary Arrears</td>
    <td width="145">
	<input type="number" name="bsalarr" id="bsalarr" class="form-control" style="" required/>
	</td>
    <td width="159">Phone Allowances </td>
    <td width="177"><input type="number" name="phoneallow" id="phoneallow" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Over Time</td>
    <td><input type="number" name="ot" id="ot" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;">Car Allowances</td>
    <td><input type="number" name="carallow" id="carallow" class="form-control" style="" required/></td>
    <td>Phone Allowances Arrears</td>
    <td><input type="number" name="phoneallowarr" id="phoneallowarr" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Over Time Arrears</td>
      </tr>
    </table></td>
    <td><input type="number" name="otarr" id="otarr" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Car    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><input type="number" name="carallowarr" id="carallowarr" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances</td>
      </tr>
    </table></td>
    <td><input type="number" name="fuelallow" id="fuelallow" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances</td>
      </tr>
    </table></td>
    <td><input type="number" name="otherallow" id="otherallow" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances Arrears</td>
      </tr>
    </table></td>
    <td><input type="number" name="otherallowarr" id="otherallowarr" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><input type="number" name="fuelallowarr" id="fuelallowarr" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance</td>
      </tr>
    </table></td>
    <td><input type="number" name="accoallow" id="accoallow" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance Arrears</td>
      </tr>
    </table></td>
    <td><input type="number" name="accoallowarr" id="accoallowarr" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary</td>
      </tr>
    </table></td>
    <td><input type="number" name="adsal" id="adsal" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Salary</td>
      </tr>
    </table></td>
    <td><input type="number" name="leavesal" id="leavesal" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Encashment&nbsp;</td>
      </tr>
    </table></td>
    <td><input type="number" name="leaveencashment" id="leaveencashment" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Provision</td>
      </tr>
    </table></td>
    <td><input type="number" name="leaveprov"  id="leaveprov" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Encashment</td>
      </tr>
    </table></td>
    <td><input type="number" name="airticketencah" id="airticketencah" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Gratuity    Encashment (Regular)</td>
      </tr>
    </table></td>
    <td><input type="number" name="gradu" id="gradu" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Provision</td>
      </tr>
    </table></td>
    <td><input type="number" name="airticketprov" id="airticketprov" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Hourly    Leave Deduction</td>
      </tr>
    </table></td>
    <td><input type="number" name="hleaveded" id="hleaveded" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary Recovery</td>
      </tr>
    </table></td>
    <td><input type="number" name="adsalrec" id="adsalrec" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Graduity    Provision</td>
      </tr>
    </table></td>
    <td><input type="number" name="grad_prov" id="grad_prov" class="form-control" style="" /></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Unpaid    Leave Deduction</td>
      </tr>
    </table></td>
    <td><input type="number" name="unpaidleaveded" id="unpaidleaveded" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Other Deductions</td>
      </tr>
    </table></td>
    <td><input type="number" name="vech" id="vech" class="form-control" style="" required/></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Fines Deductions</td>
      </tr>
    </table></td>
    <td><input type="number" name="vechfinesded" id="vechfinesded" class="form-control" style="" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Late    Coming Deduction</td>
      </tr>
    </table></td>
    <td colspan="5"><input type="number" name="latecoming" id="latecoming" class="form-control" style="" required/></td>
   </tr>
</table>




Description<br>
<textarea class="form-control" name="description" id="description" cols="5" rows="10"></textarea>
<br>
<input type="hidden" name="posted">
<div class="clearfix"></div>
                                    <div class="form-group form-actions">
                                        <div class="col-md-9 col-md-offset-5">
                                        <input type="hidden" value="demo" name="<?php echo ini_get("session.upload_progress.name"); ?>"/>

	<div id="dvFile0"><input type="file" name="item_file[]" onChange="checkExtension(this.value)"></div><div id="dvFile1"></div>
        <a href="javascript:_add_more(0);"><B>(+) Add file</B></a>
        <br /><input type="hidden" name="ref" value="<?php echo $ref_no;?>">
        <br />                                  <input type="hidden" name="posted" value="posted" />
                                            <button type="submit"  class="btn btn-sm btn-primary" id="submitJQ" name="submitJQ"><i class="fa fa-angle-right"></i> Submit</button>
                                            <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                        </div>
                                    </div>
                                    
                                </form>
                                <!-- END Basic Form Elements Content -->
                                <div class="clearfix"></div><br />
                            </div>
                            <!-- END Basic Form Elements Block -->
                        </div>

                    </div>


                </div>
                <!-- END Page Content -->

                <?php include 'footer.php';?>
				
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>


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
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>


<script>
            $(function(){
                
                // jQuery UI Dialog    
                        
                $('#jq-dialog').dialog({
                    autoOpen: false,
                    width: 800,
                    modal: true,
                    resizable: false,
                    buttons: {
                        "Submit Form": function() {
                            document.testconfirmJQ.submit();
                        },
                        "Cancel": function() {
                            $(this).dialog("close");
                        }
                    }
                });
                
                $('form#testconfirmJQ').submit(function(e){
                	e.preventDefault();
                     $("span#ledger strong").html($("select#ledger").val());
					
					$("span#amount strong").html($("input#amount").val());
					$("span#bsal strong").html($("input#bsal").val());
					$("span#bsalarr strong").html($("input#bsalarr").val());
					$("span#phoneallow strong").html($("input#phoneallow").val());
					$("span#ot strong").html($("input#ot").val());
					
					$("span#carallow strong").html($("input#carallow").val());
					$("span#phoneallowarr strong").html($("input#phoneallowarr").val());
					$("span#otarr strong").html($("input#otarr").val());
					$("span#carallowarr strong").html($("input#carallowarr").val());
					$("span#fuelallow strong").html($("input#fuelallow").val());
					
					$("span#fuelallow strong").html($("input#fuelallow").val());
					$("span#otherallow strong").html($("input#otherallow").val());
					$("span#otherallowarr strong").html($("input#otherallowarr").val());
					$("span#fuelallowarr strong").html($("input#fuelallowarr").val());
					$("span#accoallow strong").html($("input#accoallow").val());
					
					$("span#accoallowarr strong").html($("input#accoallowarr").val());
					$("span#adsal strong").html($("input#adsal").val());
					$("span#leavesal strong").html($("input#leavesal").val());
					$("span#leaveencashment strong").html($("input#leaveencashment").val());
					$("span#leaveprov strong").html($("input#leaveprov").val());
					
					$("span#airticketencah strong").html($("input#airticketencah").val());
					$("span#gradu strong").html($("input#gradu").val());
					$("span#airticketprov strong").html($("input#airticketprov").val());
					$("span#hleaveded strong").html($("input#hleaveded").val());
					$("span#adsalrec strong").html($("input#adsalrec").val());
					
					$("span#grad_prov strong").html($("input#grad_prov").val());
					$("span#unpaidleaveded strong").html($("input#unpaidleaveded").val());
					$("span#vech strong").html($("input#vech").val());
					$("span#vechfinesded strong").html($("input#vechfinesded").val());
					$("span#latecoming strong").html($("input#latecoming").val());
					
					
					$("span#description strong").html($("textarea#description").val());
					
                    $('#jq-dialog').dialog('open');
                });
                
                //Thickbox
                
                
                $('input#TBcancel').click(function(){
                    tb_remove();
                });
                
                $('input#TBsubmit').click(function(){
                    document.testconfirmTB.submit();
                });
            
                
            });
</script>
</head>
<div id="jq-dialog" title="Verify Form ">
	<p class="alert alert-error">Verify Form Values befor Submit: 
    </p>
	
   
                    <table class="table table-bordered" width="920" border="1">
  <tr>
    <td valign="middle" style="vertical-align:middle;">Ledger</td>
    <td colspan="2"><span id="ledger"><strong></strong></span></td>
    <td><span style="vertical-align:middle;">Total Amount</span></td>
    <td colspan="2"><span id="amount"><strong></strong></span></td>
   </tr>
  <tr>
    <td width="142" valign="middle" style="vertical-align:middle;">Basic Salary</td>
    <td width="167">
     <span id="bsal"><strong></strong></span>
    </td>
    <td width="139" style="vertical-align:middle;">Basic Salary Arrears</td>
    <td width="145">
	<span id="bsalarr"><strong></strong></span>
	</td>
    <td width="159">Phone Allowances </td>
    <td width="177"><span id="phoneallow"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Over Time</td>
    <td><span id="ot"><strong></strong></span></td>
    <td style="vertical-align:middle;">Car Allowances</td>
    <td><span id="carallow"><strong></strong></span></td>
    <td>Phone Allowances Arrears</td>
    <td><span id="phoneallowarr"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Over Time Arrears</td>
      </tr>
    </table></td>
    <td><span id="otarr"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Car    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><span id="carallowarr"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances</td>
      </tr>
    </table></td>
    <td><span id="fuelallow"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances</td>
      </tr>
    </table></td>
    <td><span id="otherallow"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances Arrears</td>
      </tr>
    </table></td>
    <td><span id="otherallowarr"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><span id="fuelallowarr"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance</td>
      </tr>
    </table></td>
    <td><span id="accoallow"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance Arrears</td>
      </tr>
    </table></td>
    <td><span id="accoallowarr"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary</td>
      </tr>
    </table></td>
    <td><span id="adsal"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Salary</td>
      </tr>
    </table></td>
    <td><span id="leavesal"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Encashment&nbsp;</td>
      </tr>
    </table></td>
    <td><span id="leaveencashment"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Provision</td>
      </tr>
    </table></td>
    <td><span id="leaveprov"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Encashment</td>
      </tr>
    </table></td>
    <td><span id="airticketencah"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Gratuity    Encashment (Regular)</td>
      </tr>
    </table></td>
    <td><span id="gradu"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Provision</td>
      </tr>
    </table></td>
    <td><span id="airticketprov"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Hourly    Leave Deduction</td>
      </tr>
    </table></td>
    <td><span id="hleaveded"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary Recovery</td>
      </tr>
    </table></td>
    <td><span id="adsalrec"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Graduity    Provision</td>
      </tr>
    </table></td>
    <td><span id="grad_prov"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Unpaid    Leave Deduction</td>
      </tr>
    </table></td>
    <td><span id="unpaidleaveded"><strong></strong></span></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Other Deductions</td>
      </tr>
    </table></td>
    <td><span id="vech"><strong></strong></span></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Fines Deductions</td>
      </tr>
    </table></td>
    <td><span id="vechfinesded"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Late    Coming Deduction</td>
      </tr>
    </table></td>
    <td colspan="5"><span id="latecoming"><strong></strong></span></td>
   </tr>
</table>



Description:<br>
<div style="border:1px solid #EAEDF1; padding:15px;">
<span id="description"><strong></strong></span>
</div>
<br>
<br>
</div>

<br>
</div>  