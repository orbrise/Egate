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
                                <i class="gi gi-notes_2"></i>Invoices payment Request Form<br/><small></small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Finance</a></li>
                        <li><a href="">Invoices payment Request Form</a></li>
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
	$bname=clean($_POST['bname']);
	$bban=clean($_POST['bban']);
	$bbn=clean($_POST['bbn']);
	$pay_c=mysql_real_escape_string($_POST['payc']);
	$cpo=clean($_POST['cpo']);
	$nors=clean($_POST['nors']);
    $invoice=clean($_POST['invoice']);
	$invdate=date('Y-m-d',strtotime($_POST['invdate']));
	$amount=clean($_POST['amount']);
	$due_date=date('Y-m-d',strtotime($_POST['duedate']));
	$desc1= clean($_POST['description']);

	$notes=clean($_POST['notes']);
	$num_notes=strlen($notes);
	$pc=$_SERVER['REMOTE_ADDR'];
	$form_name='Invoices payment Request Form';
	$i_p=$_SERVER['REMOTE_ADDR'];
    $entry_time=date('h:i;s');
    $unixtime=time();
    $subject=$user_name.' Generate a Request Req# '. $ref;
    
	
	if($due_date < $invdate){ echo '<div class="alert alert-danger"> Error: Your Due Date should be after Invoice Date. Try Again</div>'; } else {
    $insform=mysql_query("insert into formsdata (id,username,ref,created_date,benif_name,amount,invoice,due_date,description,entry_date,entry_time,Ip,status,formid,benif_bank_ac,benif_bank_name,payc,inv_date,contract_po,completion_work,form_name) values
	                                ('','$requester','$ref','$created_date','$bname', '$amount','$invoice','$due_date','$desc1','$created_date','$entry_time','$i_p','Requested',4,'$bban','$bbn','$pay_c','$invdate','$cpo','$nors','$form_name')") or die (mysql_error());
	
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
                              
                            
                                
						<?php } } ?>   
                            
                            
                            
                            <div class="block">
                                <!-- Basic Form Elements Title -->
                                <div class="block-title">
                                    
                                    <h2><strong>Submit Details </strong></h2>
                                </div>
                             
                                <table class="table table-bordered" width="907" border="1">
  <tr>
    <td width="130" >Request By <?php echo date("H:i:s");?></td>
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
                                <form action="f4inv-pay-req-form" method="post" enctype="multipart/form-data" id="testconfirmJQ" name="testconfirmJQ">
                                    
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
                                    
                                    
                                   <table class="table table-bordered" width="951" border="1">
								   
								   


  <tr>
    <td valign="middle" style="vertical-align:middle;"><span class="style2">Beneficiary Name</span></td>
    <td><input type="text" name="bname" id="bname" class="form-control" required></td>
    <td style="vertical-align:middle;">Beneficiary Bank Account Number</td>
    <td colspan="3"><input type="text" name="bban" id="bban" class="form-control" required></td>
   </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Contract /P.O #</td>
    <td><input type="text" name="cpo" id="cpo" class="form-control" required /></td>
    <td style="vertical-align:middle;">Number of receipt Stores / certificate of completion of the work</td>
    <td colspan="3"><input type="text" name="nors" id="nors" class="form-control" required/></td>
   </tr>
  <tr>
    <td  width="118" valign="middle" style="vertical-align:middle;">Beneficiary Bank Name</td>
    <td width="149"><input type="text" name="bbn" id="bbn" class="form-control" required></td>
    <td style="vertical-align:middle;" width="171">Payment Currency</td>
    <td width="144"><label>
      <select name="payc" id="payc" class="form-control" required>
        <option value="">Select Currency</option>
        <option>AED</option>
        <option>SAR</option>
        <option>EUR</option>
        <option>USD</option>
        <option>QAR</option>
        <option>EGP</option>
        <option>CHF</option>
      </select>
    </label></td>
    <td width="153"><span style="vertical-align:middle;">Amount</span></td>
    <td width="176"><input type="text" name="amount" id="amount" class="form-control" required></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;">Invoice #</td>
    <td><input type="text" name="invoice" id="invoice" class="form-control" requierd></td>
    <td style="vertical-align:middle;">Invoice Date</td>
    <td><input type="text" id="invdate" name="invdate" class="form-control input-datepicker" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required >
	</td>
    <td><span style="vertical-align:middle;">Payment Due date</span></td>
    <td><input type="text" id="duedate" name="duedate" class="form-control input-datepicker" data-date-format="yyyy/mm/dd" placeholder="yyyy/mm/dd" required >
	</td>
  </tr>
</table>

Description:<br>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?php include 'footer.php';?>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" />
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
                     $("span#bname strong").html($("input#bname").val());
					$("span#bban strong").html($("input#bban").val());
					$("span#bbn strong").html($("input#bbn").val());
					$("span#payc strong").html($("select#payc").val());
					$("span#amount strong").html($("input#amount").val());
					$("span#invoice strong").html($("input#invoice").val());
					$("span#invdate strong").html($("input#invdate").val());
					$("span#duedate strong").html($("input#duedate").val());
					$("span#cpo strong").html($("input#cpo").val());
					$("span#nors strong").html($("input#nors").val());
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
<table class="table table-bordered" width="951" border="1">
  <tr>
    <td valign="middle" style="vertical-align:middle;"><span class="style2">Beneficiary Name</span></td>
    <td><span id="bname"><strong></strong></span></td>
    <td style="vertical-align:middle;">Beneficiary Bank Account Number</td>
    <td colspan="3"><span id="bban"><strong></strong></span></td>
   </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Contract /P.O #</td>
    <td><span id="cpo"><strong></strong></span></td>
    <td colspan="2" style="vertical-align:middle;">Number of receipt Stores / certificate of completion of the work</td>
    <td colspan="2"><span id="nors"><strong></strong></span></td>
  </tr>
  <tr>
    <td  width="118" valign="middle" style="vertical-align:middle;">Beneficiary Bank Name</td>
    <td width="149"><span id="bbn"><strong></strong></span></td>
    <td style="vertical-align:middle;" width="171">Payment Currency</td>
    <td width="144"><label>
      <span id="payc"><strong></strong></span>
    </label></td>
    <td width="153"><span style="vertical-align:middle;">Amount (AED)</span></td>
    <td width="176"><span id="amount"><strong></strong></span></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;">Invoice #</td>
    <td><span id="invoice"><strong></strong></span></td>
    <td style="vertical-align:middle;">Invoice Date</td>
    <td><span id="invdate"><strong></strong></span></td>
    <td><span style="vertical-align:middle;">Settlement Due date</span></td>
    <td><span id="duedate"><strong></strong></span></td>
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
               