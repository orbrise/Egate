<? ob_start();//Start buffer output ?>
<?php
error_reporting(0);
session_start();
$user_name=$_SESSION['user'];
if (!$_SESSION['user']) {
        header('Location:index.php');
}

?>

<?php include 'headerd.php'; ?>
                <div id="page-content">
                    <!-- Social Widgets Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="gi gi-share_alt"></i>E-Gate Dashboard<br><small>Select Your Particular Department</small>
                            </h1>
                        </div>
                    </div>
                    <!-- END Social Widgets Header -->

                    <!-- Advanced Widgets with Users Row -->
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <!-- Advanced Active Theme Color Widget -->
                            <div class="widget">
                                <div class="widget-advanced">
                                    <!-- Widget Header -->
                                    <div class="widget-header text-center themed-background-dark">
                                        <h3 class="widget-content-light">
                                            <a href="finance.php" class="themed-color">Finance Department</a><br>
                                            <small>ADCI Group</small>
                                        </h3>
                                    </div>
                                    <!-- END Widget Header -->

                                    <!-- Widget Main -->
                                    <div class="widget-main">
                                        <a href="finance.php" class="widget-image-container animation-hatch">
                                            <img src="img/placeholders/avatars/avatorf.png" alt="avatar" class="widget-image img-circle">
                                        </a>
                                        <div class="row text-center animation-fadeIn">
                                            <div class="col-xs-4">
                                                <h3><strong>140</strong><br><small>Total Approvals</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>15</strong><br><small>Total Request Sent</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>980</strong><br><small>Total Rejects</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Widget Main -->
                                </div>
                            </div>
                            <!-- END Advanced Active Theme Color Widget -->
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <!-- Advanced Specific Theme Color Widget -->
                            <div class="widget">
                                <div class="widget-advanced">
                                    <!-- Widget Header -->
                                    <div class="widget-header text-center themed-background-dark-modern">
                                        <h3 class="widget-content-light">
                                            <a href="" class="themed-color">HR Department</a><br>
                                            <small>ADCI Group</small>
                                        </h3>
                                    </div>
                                    <!-- END Widget Header -->

                                    <!-- Widget Main -->
                                    <div class="widget-main">
                                        <a href="" class="widget-image-container animation-hatch">
                                            <img src="img/placeholders/avatars/avatorhr.png" alt="avatar" class="widget-image img-circle">
                                        </a>
                                        <div class="row text-center animation-fadeIn">
                                            <div class="col-xs-4">
                                                <h3><strong>140</strong><br><small>Total Approvals</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>15</strong><br><small>Total Request Sent</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>980</strong><br><small>Total Rejects</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Widget Main -->
                                </div>
                            </div>
                            <!-- END Advanced Specific Theme Color Widget -->
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <!-- Advanced Specific Theme Color Widget -->
                            <div class="widget">
                                <div class="widget-advanced">
                                    <!-- Widget Header -->
                                    <div class="widget-header text-center themed-background-dark">
                                        <h3 class="widget-content-light">
                                            <a href="" class="themed-color-autumn">Accounts Department</a><br>
                                            <small>ADCI Group</small>
                                        </h3>
                                    </div>
                                    <!-- END Widget Header -->

                                    <!-- Widget Main -->
                                    <div class="widget-main">
                                        <a href="" class="widget-image-container animation-hatch">
                                            <img src="img/placeholders/avatars/avatoracc.png" alt="avatar" class="widget-image img-circle">
                                        </a>
                                        <div class="row text-center animation-fadeIn">
                                            <div class="col-xs-4">
                                                <h3><strong>140</strong><br><small>Total Approvals</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>15</strong><br><small>Total Request Sent</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>980</strong><br><small>Total Rejects</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Widget Main -->
                                </div>
                            </div>
                            <!-- END Advanced Theme Color Widget -->
                        </div>
                        
                          <div class="col-sm-6 col-md-4">
                            <!-- Advanced Specific Theme Color Widget -->
                            <div class="widget">
                                <div class="widget-advanced">
                                    <!-- Widget Header -->
                                    <div class="widget-header text-center themed-background-dark-autumn">
                                        <h3 class="widget-content-light">
                                            <a href="" class="themed-color-autumn">Procurment Department</a><br>
                                            <small>ADCI Group</small>
                                        </h3>
                                    </div>
                                    <!-- END Widget Header -->

                                    <!-- Widget Main -->
                                    <div class="widget-main">
                                        <a href="" class="widget-image-container animation-hatch">
                                            <img src="img/placeholders/avatars/avatorpur.png" alt="avatar" class="widget-image img-circle">
                                        </a>
                                        <div class="row text-center animation-fadeIn">
                                            <div class="col-xs-4">
                                                <h3><strong>140</strong><br><small>Total Approvals</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>15</strong><br><small>Total Request Sent</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>980</strong><br><small>Total Rejects</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Widget Main -->
                                </div>
                            </div>
                            <!-- END Advanced Theme Color Widget -->
                        </div>
                        
                        
                         <div class="col-sm-6 col-md-4">
                            <!-- Advanced Specific Theme Color Widget -->
                            <div class="widget">
                                <div class="widget-advanced">
                                    <!-- Widget Header -->
                                    <div class="widget-header text-center themed-background-dark-autumn">
                                        <h3 class="widget-content-light">
                                            <a href="" class="themed-color-autumn">Sales Department</a><br>
                                            <small>ADCI Group</small>
                                        </h3>
                                    </div>
                                    <!-- END Widget Header -->

                                    <!-- Widget Main -->
                                    <div class="widget-main">
                                        <a href="" class="widget-image-container animation-hatch">
                                            <img src="img/placeholders/avatars/avatorpur.png" alt="avatar" class="widget-image img-circle">
                                        </a>
                                        <div class="row text-center animation-fadeIn">
                                            <div class="col-xs-4">
                                                <h3><strong>140</strong><br><small>Total Approvals</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>15</strong><br><small>Total Request Sent</small></h3>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3><strong>980</strong><br><small>Total Rejects</small></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Widget Main -->
                                </div>
                            </div>
                            <!-- END Advanced Theme Color Widget -->
                        </div>
                        
                        
                        
                        
                        
                        
                    </div>
                    <!-- END Advanced Widgets with Users Row -->

                   

                  
                    
                   
                    <!-- Simple Widgets with post inputs Row -->
                    
                    <!-- END Simple Widgets with post inputs Row -->
                </div>
                <!-- END Page Content -->

                


<?php include 'footer.php' ;?>