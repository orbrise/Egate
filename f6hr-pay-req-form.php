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
                                <i class="gi gi-notes_2"></i>Human Resources payment Request Form<br/><small></small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Finance</a></li>
                        <li><a href="">Human Resources payment Request Form</a></li>
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
	$bban=clean($_POST['bban']);
	$bname=clean($_POST['bname']);
	$ledger=clean($_POST['ledger']);
	$acno=clean($_POST['acno']);
	$accurals=clean($_POST['accurals']);
	$bbn=clean($_POST['bbn']);
	$pay_c=mysql_real_escape_string($_POST['payc']);
	$cpo=clean($_POST['cpo']);
	$nors=clean($_POST['nors']);
    $invoiceno=clean($_POST['invoiceno']);
	$invdate=clean($_POST['invdate']);
	$amount=clean($_POST['amount']);
	$due_date=$_POST['duedate'];
	$desc1= clean($_POST['description']);
	$choos1=clean($_POST['choos1']);
	$choos2=clean($_POST['choos2']);
	$choos3=clean($_POST['choos3']);
	$choos4=clean($_POST['choos4']);
	
	$cam1=clean($_POST['cam1']);
	$cam2=clean($_POST['cam2']);
	$cam3=clean($_POST['cam3']);
	$cam4=clean($_POST['cam4']);
	
	$notes=clean($_POST['notes']);
	
	$num_notes=strlen($notes);
	$pc=$_SERVER['REMOTE_ADDR'];
	$form_name='Human Resources payment Request Form';
	$i_p=$_SERVER['REMOTE_ADDR'];
    $entry_time=date('h:i;s');
    $unixtime=time();
    $subject=$user_name.' Generate a Request Req# '. $ref;
    
    $insform=mysql_query("insert into formsdata (id,username,ref,created_date,benif_name,amount,invoice,due_date,description,entry_date,entry_time,Ip,status,formid,benif_bank_ac,ledger,total_amount,acc_no,choos1,choos2,choos3,choos4,choos_amount1,choos_amount2,choos_amount3,choos_amount4
	,accurals,form_name) values
	('','$requester','$ref','$created_date','$bname', '$amount','$invoice','$due_date','$desc1','$created_date','$entry_time','$i_p','Requested',6,'$bban','$ledger','$amount','$acno','$choos1','$choos2','$choos3','$choos4','$cam1','$cam2','$cam3','$cam4','$accurals','$form_name')") or die (mysql_error());
	
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
                                <form action="f6hr-pay-req-form" method="post" enctype="multipart/form-data" id="testconfirmJQ" name="testconfirmJQ">
                                    
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
                                    
                                    
                                  <table class="table table-bordered" width="802" border="1">
								  

  <tr>
    <td valign="middle" style="vertical-align:middle;"><span class="style2">Ledger</span></td>
    <td>
      <select name="ledger" id="ledger" class="form-control" required>
        <option selected="selected">Select</option>
        <option>ADCI</option>
        <option>GIFFIN</option>
        <option>IPC</option>
        <option>DREXEL</option>
        <option>CIVIC</option>
      </select>
</td>
    <td style="vertical-align:middle;">Batch/Benificiary Bank Account Number</td>
    <td><input type="text" name="bban" id="bban" class="form-control" /></td>
   </tr>
  <tr>
    <td  width="123" valign="middle" style="vertical-align:middle;">Batch / Benificiary Name</td>
    <td width="234"><input type="text" name="bname" id="bname" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;" width="106">Batch / Benificiary Bank Account Number</td>
    <td width="311"><label>
      <input type="number" name="acno" id="acno" class="form-control" required/>
    </label></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Total Amount</td>
    <td><input type="number" name="amount" id="amount" class="form-control" style="" required/></td>
    <td style="vertical-align:middle;"><select name="choos1" id="choos1" class="form-control">
      <option selected="selected" name="choos1">Choose From List</option>
      <option>ADCI</option>
      <option>GIFFIN</option>
      <option>IPC</option>
      <option>DREXEL</option>
      <option>CIVIC</option>
    </select></td>
    <td> <input type="number" name="cam1" id="cam1" class="form-control" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><select name="choos2" id="choos2" class="form-control" required>
      <option selected="selected">Choose From List</option>
      <option>ADCI</option>
      <option>GIFFIN</option>
      <option>IPC</option>
      <option>DREXEL</option>
      <option>CIVIC</option>
    </select></td>
    <td><input type="number" name="cam2" id="cam2" class="form-control" required/></td>
    <td style="vertical-align:middle;"><select name="choos3" id="choos3" class="form-control" required>
      <option selected="selected">Choose From List</option>
      <option>ADCI</option>
      <option>GIFFIN</option>
      <option>IPC</option>
      <option>DREXEL</option>
      <option>CIVIC</option>
    </select></td>
    <td><input type="number" name="cam3" id="cam3" class="form-control" required/></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><select name="choos4" id="choos4"  class="form-control" required>
      <option selected="selected">Choose From List</option>
      <option>ADCI</option>
      <option>GIFFIN</option>
      <option>IPC</option>
      <option>DREXEL</option>
      <option>CIVIC</option>
    </select></td>
    <td><input type="number" name="cam4" id="cam4" class="form-control" required/></td>
    <td style="vertical-align:middle;">Accruals</td>
    <td><input type="text" name="accurals" id="accurals" class="form-control" required/></td>
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
					$("span#bban strong").html($("input#bban").val());
					$("span#bname strong").html($("input#bname").val());
					$("span#acno strong").html($("input#acno").val());
					$("span#amount strong").html($("input#amount").val());
					$("span#choos1 strong").html($("select#choos1").val());
					$("span#choos2 strong").html($("select#choos2").val());
					$("span#choos3 strong").html($("select#choos3").val());
					$("span#choos4 strong").html($("select#choos4").val());
					
					$("span#cam1 strong").html($("input#cam1").val());
					$("span#cam2 strong").html($("input#cam2").val());
					$("span#cam3 strong").html($("input#cam3").val());
					$("span#cam4 strong").html($("input#cam4").val());
					
					$("span#accurals strong").html($("input#accurals").val());
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
<table class="table table-bordered" width="802" border="1">
  <tr>
    <td valign="middle" style="vertical-align:middle;">Ledger</td>
    <td>
       <span id="ledger"><strong></strong></span>
</td>
    <td style="vertical-align:middle;">Batch/Benificiary Bank Account Number</td>
    <td> <span id="bban"><strong></strong></span></td>
   </tr>
  <tr>
    <td  width="123" valign="middle" style="vertical-align:middle;">Batch / Benificiary Name</td>
    <td width="234"> <span id="bname"><strong></strong></span></td>
    <td style="vertical-align:middle;" width="106"> Account Number</td>
    <td width="311"><label>
      <span id="acno"><strong></strong></span>
    </label></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Total Amount</td>
    <td> <span id="amount"><strong></strong></span></td>
    <td style="vertical-align:middle;"><span id="choos1"><strong></strong></span></td>
    <td> <span id="cam1"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><span id="choos2"><strong></strong></span></td>
    <td> <span id="cam2"><strong></strong></span></td>
	
    <td style="vertical-align:middle;"> <span id="choos3"><strong></strong></span></td>
    <td> <span id="cam3"><strong></strong></span></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><span id="choos4"><strong></strong></span></td>
    <td> <span id="cam4"><strong></strong></span></td>
    <td style="vertical-align:middle;">Accruals</td>
    <td><span id="accurals"><strong></strong></span></td>
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