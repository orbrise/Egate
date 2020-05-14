<? ob_start();//Start buffer output ?>
<?php
error_reporting();
session_start();
$user_name=$_SESSION['user'];
$userid=$_SESSION['user_id'];
if (!$_SESSION['user']) {
        header('Location:index.php');
}
include 'connection.php';
include 'functions.php';
$u_d=userdata($userid);
$type=$u_d['type'];
$search=$u_d['search'];
$reports=$u_d['reports'];
?>
<?php $data=approver($user_name);
		if(isset($_POST['profile123'])){
		
		$uid=$data['user_id'];
$uemail=$_POST['uemail'];
$upassword=$_POST['upassword'];
$cpassword=$_POST['cpassword'];
if ($upassword<>$cpassword){
echo '<script>alert("Your password is not matched! Try Again");</script>';
}else{
$upd=mysql_query("update users set password='$upassword', email='$uemail' where user_id=$uid");
if($upd){
echo '<script>alert("Your Profile Updated");</script>';
}
}
}
?>
<?php include 'header.php';

$fday=date('Y-m-01');
$lday=date('Y-m-t');
$ap=get_ap1($user_name) ;									
$gd=get_gd1($user_name) ;                     
$ac=get_ac1($user_name) ;
$sa=get_sa1($user_name) ;
$ca=get_ca1($user_name) ;
$teller=get_teller1($user_name) ;
$bk=get_bk1($user_name) ;

if ($ap>=1 or $gd>=1 or $ac>=1 or $sa>=1 or $ca>=1 or $teller>=1 or $bk>=1){$check='1';} 

 ?>
                <!-- Page content -->
                <div id="page-content">
                    <!-- Dashboard Header -->
                    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
                    <div class="content-header content-header-media">
                        <div class="header-section">
                            <div class="row">
                                <!-- Main Title (hidden on small devices for the statistics to fit) -->
                                <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                                    <h1>Welcome <strong><?php echo ucfirst($user_name);?></strong><br><small>You Look Awesome!</small></h1>
                                </div>
                                <!-- END Main Title -->

                                <!-- Top Stats -->
                               <div class="col-md-8 col-lg-6">
                                    <div class="row text-center">
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
											<?php if ($check==0) { } else {?>
                                                <strong><a href="approv"><?php echo $t_app_n=total_app($user_name,$fday,$lday);?></a></strong><br>
                                                <small><i class="fa fa-pencil-square-o"></i>Pending Approvals</small>
                                             <?php }?>
											</h2>
                                        </div>
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
											<?php if ($check==0) { ?>
											
											<strong><a href="requests?searchstatus=return_back&fdate=&tdate=&search="><?php echo $t_req_n=total_reqr($user_name,$fday,$lday);?></a></strong><br>
                                            	<small><i class="fa fa-hand-o-up"></i> Return Back</small>
											
											
										<?php	} else {?>
                                                <strong><a href="approv?refno=&formname=Form+Name&searchstatus=return_back&fdate=&tdate=&search="><?php echo $t_req_n=total_req($user_name,$fday,$lday);?></a></strong><br>
                                            	<small><i class="fa fa-hand-o-up"></i> Return Back</small>
                                           <?php }?>
											</h2>
                                        </div>
                                        <div class="col-xs-4 col-sm-3">
                                            <h2 class="animation-hatch">
											<?php if ($check==0) {?>

											 <strong><a href="requests?searchstatus=On-Hold&fdate=&tdate=&search="><?php echo total_holdr($user_name,$fday,$lday);?></a></strong><br>
                                                <small><i class="fa fa-pause"></i> Total On-Hold</small>
											
										<?php	} else {?>
                                                <strong><a href="approv?refno=&searchstatus=On-Hold&fdate=&tdate=&search="><?php echo total_hold($user_name,$fday,$lday);?></a></strong><br>
                                                <small><i class="fa fa-pause"></i> Total On-Hold</small>
												<?php }?>
                                            </h2>
                                        </div>
                                        <!-- We hide the last stat to fit the other 3 on small devices -->
                                        <div class="col-sm-3 hidden-xs">
                                            <h2 class="animation-hatch">
											<?php if ($check==0) {?>
											
											<strong><a href="requests?searchstatus=Rejected&fdate=&tdate=&search="><?php echo total_regectr($user_name,$fday,$lday);?></a></strong><br>
                                                <small><i class="fa fa-times"></i> Total Rejected</small>

<?php											} else {?>
                                                <strong><a href="approv?refno=&searchstatus=Rejected&fdate=&tdate=&search="><?php echo total_regect($user_name,$fday,$lday);?></a></strong><br>
                                                <small><i class="fa fa-times"></i> Total Rejected</small>
												<?php }?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Top Stats -->
                            </div>
                        </div>
                        <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
                        <img src="img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
                    </div>
                    <!-- END Dashboard Header -->

                    <!-- Mini Top Stats Row -->
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="<?php if ($check=='1') {echo 'approv';}else {echo '#';}?>" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Approvals</strong><br>
                                        <small>Request You Need to Approve</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="requests" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                                        <i class="fa fa-hand-o-up"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Requests</strong><br>
                                        <small>Requests That You Sent</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="dept_search" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Search in Department</strong>
                                        <small>Search Entries</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <!-- Widget -->
                            <a href="<?php if($reports==1){echo 'reports';}else {echo '#';}?>" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                                        <i class="gi gi-pie_chart"></i>
                                    </div>
                                    <h3 class="widget-content text-right animation-pullDown">
                                        <strong>Reports</strong>
                                        <small>Advance Reports</small>
                                    </h3>
                                </div>
                            </a>
                            <!-- END Widget -->
                            
                            
                        </div>
                        
                        
                        <div class="col-sm-12">
                        <h3 class="sub-header"><strong>All Forms List</strong></h3>
                        </div>
                        <div class="clearfix"></div>
						
						
						
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f1prepay-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Prepayment Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f2per-petty-cash-pay-req" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Permanent Petty Cash Payment Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f3tem-petty-cash-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Temporary Petty Cash Payment Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f4inv-pay-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Invoices payment Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f5petty-cash-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Petty Cash Payment Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f6hr-pay-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Human Resources payment Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f7int-bank-transf-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Internal Bank Transfer Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f8lc-bg-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>LC & BG Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                   
                       
                       
                               <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f9pre-pay-set-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Prepayment Settlement Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f10per-pety-cash-set-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Permenant Petty Cash Settlement Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f11tem-pety-cash-set-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Temporary Petty Cash Settlement Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f12per-pery-cash-reim-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Permenant Petty Cash Reimbursement Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f13-rec-post-date-cheq-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Receipts -Post Date Cheque Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                       <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f14-rec-curr-date-cheq-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Receipts -Current Date Cheque Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f15-rec-cash-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Receipts -Cash Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f16-fam-pay-req" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Family Payment Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                   
                          <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f18-sale-inv-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Sales Invoice Request Form </strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        
                           <div class="col-sm-6 col-lg-3">
                        
                        
                            <a href="f17-hr-acc-req-form" class="widget widget-hover-effect1">
                                <div class="widget-simple">
                                    <img src="img/placeholders/avatars/form.png" alt="avatar" class="widget-image img-circle pull-left">
                                    <h4 class="widget-content text-left">
                                        <strong>Human Resources Accruals Request Form</strong>
                                      
                                    </h4>
                                </div>
                            </a>
                        </div>
                        
        
                       
                       
                       
                       
                       
                       
                       
                    </div>
                    <!-- END Mini Top Stats Row -->

                    <!-- Widgets Row -->
                    
                    <!-- END Widgets Row -->
                </div>
                <!-- END Page Content -->

                



<?php include 'footer.php' ;?>