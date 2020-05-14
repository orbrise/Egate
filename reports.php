<? ob_start();//Start buffer output ?>
<?php
error_reporting(0);
session_start();
$user_name=$_SESSION['user'];
if (!$_SESSION['user']) {
        header('Location:index.php');
}
include 'connection.php';
include 'functions.php';
include 'ajax.php';
?>
<?php include 'header.php';?>

                <!-- Page content -->
                <div id="page-content">
                    <!-- Datatables Header -->
                    <div class="content-header">
                        <div class="header-section">
                            <h1>
                                <i class="fa fa-table"></i>Approvals<br><small>Requests Need to Approve by You</small>
                            </h1>
                        </div>
                    </div>
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="finance.php">Dashboard</a></li>
                        <li>Approvals</li>
                    </ul>
                    <!-- END Datatables Header -->
                                
								<?php 
								
								 $approvrget=approver($user_name);
							 $approvr=$approvrget['approver'];
							 $req_dept=$approvrget['dept'];
							 
							 
								?>

                            
                    <!-- Datatables Content -->
                    <div class="block full">
                        <div class="block-title">
                            <h2><strong>Requests</strong> Pending for Approvals</h2>

                        </div>
						<form action="reports" method="get" >
					   
					   <div class="col-sm-1">
					   <select id="val_skill" name="dept" class="form-control" onchange="showUser1(this.value)">
                                                    <option value="">Please select</option>
                                                   <?php 
												   
												   $getdept=mysql_query("select distinct dept from users where status=0 and dept<>''") or dier (mysql_error());
												   while($appl=mysql_fetch_array($getdept)){?>
												<option value="<?php echo $appl['dept'];?>" <?php if($appl['dept']==$_GET['dept']){echo 'selected="selected"';} ;?>><?php echo $appl['dept'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>
					   </div>
					   
					   
                       <div class="col-sm-1"><div id="txtHint1"><select id="val_skill" name="user" class="form-control">
                                                    <option value="">Please select</option>
                                                   <?php 
												   if(!empty($_GET['dept'])){
													   $dept=$_GET['dept'];
												   $getdept=mysql_query("select * from users where status=0 and dept='$dept'") or dier (mysql_error());
												   while($appl=mysql_fetch_array($getdept)){?>
												<option value="<?php echo $appl['username'];?>" <?php if($appl['username']==$_GET['user']){echo 'selected="selected"';} ;?>><?php echo $appl['username'];?></option>
												<?php 	   
												   }
												   }
												   ?>
                                                   
                                                </select></div></div>
					   
					   
                                 
  
  
                        <div class="col-sm-2">
  <select name="searchstatus" id="select" class="form-control" class="form-control">
  <option value="all">Status</option>
  <option <?php if($_GET['searchstatus']=='Requested') {echo "selected=='selected'";}?>>Requested</option>
    <option <?php if($_GET['searchstatus']=='Approved') {echo "selected='selected'";}?>>Approved</option>
    <option value="return_back" <?php if($_GET['searchstatus']=='return_back') {echo "selected='selected'";}?>>Return Back</option>
    <option <?php if($_GET['searchstatus']=='On-Hold') {echo "selected=='selected'";}?>>On-Hold</option>
    <option <?php if($_GET['searchstatus']=='Rejected') {echo "selected=='selected'";}?>>Rejected</option>
  </select>
  </div>
                        
                        <div class="col-sm-2"><input type="date" name="fdate" class="form-control" value="<?php if(empty($_GET['fdate'])) {echo date('Y-m-01');} else {echo date('Y-m-d',strtotime($_GET['fdate']));}?>" />  </div>
                        <div class="col-sm-2"><input type="date" name="tdate" class="form-control" value="<?php if(empty($_GET['tdate'])) {echo date('Y-m-t');} else {echo date('Y-m-t',strtotime($_GET['tdate']));}?>"/></div>
						<input type="hidden" name="search">
                        <div class="col-sm-1"><button class="btn btn-default"><i class="fa fa-search"></i></button></div>
             <div class="clearfix"></div>           
               </form>         
  <br />
  
  
  <div class="table-responsive">
                        <?php 
								if(isset($_GET['search'])){
									$s_ref=$_GET['refno'];
								
									$s_formn=$_POST['formname'];
									$s_searchstatus=$_GET['searchstatus'];
									$s_fdate=$_GET['fdate'];
									$s_tdate=$_GET['tdate'];
									$s_user=$_GET['user'];
									$s_dept=$_GET['dept'];
									$get_name=get_username($s_user);
									
									
									if(!empty($s_ref)){
										
									$refno=" and ref=".$s_ref;
									}
									
									if(!empty($s_fdate)){
										
									$fdate=" and entry_date>='".$s_fdate."'";
									$fdate1= " and last_activity_date>='".$s_fdate."'";
									}
									
									if(!empty($s_tdate)){
										
									$tdate=" and entry_date<='".$s_tdate."'";
									$tdate1= " and last_activity_date<='".$s_tdate."'";
									}
									
									if(!empty($s_fdate) and !empty($s_tdate)){
										
									$bdate1=" and entry_date between '".$s_fdate."' and '".$s_tdate."'";
									 $bdate2= " and last_activity_date between '".$s_fdate."' and '".$s_tdate."'";
									}
									
									if(!empty($s_user))
									{
										$username=" and username='".$get_name."'";
										$username1=" and requester='".$get_name."'";
										$username2=" and requester='".$get_name."' or approver='".$get_name."' or last_activity_user='".$get_name."'";
									}				

									if(!empty($s_dept)){
										
										$sdept=" and dept='".$_GET['dept']."'";
										$sdept1=" and req_dept='".$_GET['dept']."'";
									}
									
									if(!empty($s_searchstatus)){
									
									if (empty($s_user) and empty($s_dept)){
										
										if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date,dept from approves where a_status=0 $sdept $username $bdate1 group by dept") or die (mysql_error());
									}
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date,dept from sent_back where s_status=0 $sdept $username $bdate1 group by dept") or die (mysql_error());
									}
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date,dept from on_hold where h_status=0 $sdept $username $bdate1 group by dept") or die (mysql_error());
									}
									
									if($s_searchstatus=='Requested'){
									$ret_list=mysql_query("select count(distinct ref) as count,req_dept from transactions where t_status=0 $sdept1 $username2 $bdate2 group by req_dept") or die (mysql_error());
									}
									
									if($s_searchstatus=='Rejected'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date,dept from reject where h_status=0 $sdept $username $bdate1 group by dept") or die (mysql_error());
									}
									
									if($s_searchstatus=='all'){
									$ret_list=mysql_query("select count(distinct ref) as count,req_dept from transactions where t_status=0 $sdept1 $username2 $bdate2 group by req_dept") or die (mysql_error());
									}
									
										
									}
									
									if (empty($s_user) and !empty($s_dept)){
										
									if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select count(distinct ref) as count,username from approves where a_status=0 $sdept $username $bdate1 group by username") or die (mysql_error());
									
									}
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select count(distinct ref) as count,requester from transactions where t_status=0 and status='return_back' $sdept1 $username2 $bdate2 group by requester") or die (mysql_error());
									}
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select count(distinct ref) as count,username from on_hold where h_status=0 $sdept $username $bdate1 group by username") or die (mysql_error());
									}
									
									if($s_searchstatus=='Requested'){
									$ret_list=mysql_query("select count(distinct ref) as count,requester from transactions where t_status=0 $sdept1 $username2 $bdate2 group by requester") or die (mysql_error());
									}
									
									if($s_searchstatus=='Rejected'){
									$ret_list=mysql_query("select count(distinct ref) as count,username from reject where h_status=0 $sdept $username $bdate1 group by username") or die (mysql_error());
									}
									
									if($s_searchstatus=='all'){
										
									$ret_list=mysql_query("select count(distinct ref) as count,requester from transactions where t_status=0 $sdept1 $username2 $bdate2 group by requester") or die (mysql_error());
									}
									
									
									}
									
									
									
									if (!empty($s_user) and !empty($s_dept)){
										
									if($s_searchstatus=='Approved'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date from approves where a_status=0 $sdept $username $bdate1 group by entry_date") or die (mysql_error());
									}
									
									if($s_searchstatus=='return_back'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date from sent_back where s_status=0 $sdept $username $bdate1 group by entry_date") or die (mysql_error());
									}
									
									if($s_searchstatus=='On-Hold'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date from on_hold where h_status=0 $sdept $username $bdate1 group by entry_date") or die (mysql_error());
									}
									
									if($s_searchstatus=='Requested'){
									$ret_list=mysql_query("select count(distinct ref) as count,last_activity_date from transactions where t_status=0 $sdept1 $username2 $bdate2 group by last_activity_date") or die (mysql_error());
									}
									
									if($s_searchstatus=='Rejected'){
									$ret_list=mysql_query("select count(distinct ref) as count,entry_date from reject where h_status=0 $sdept $username $bdate1 group by entry_date") or die (mysql_error());
									}
									
									if($s_searchstatus=='all'){
									$ret_list=mysql_query("select count(distinct ref) as count,last_activity_date from transactions where t_status=0 $sdept1 $username2 $bdate2 group by last_activity_date") or die (mysql_error());
									}
									
									
									}
									}
									
									

									//echo "select count(distinct ref) as count,username from approves where a_status=0 $sdept $username $bdate1 group by username";
                              $num=mysql_num_rows($ret_list);
									if(empty($num)){echo '<h3>No Data Available</h3>';} else {
									?>
										
 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Total", { role: "style" } ],
		
		<?php while($approv_r=mysql_fetch_array($ret_list)){
        
		if(empty($s_user) and empty($s_dept)){ ?>
        ["<?php if(!empty($approv_r['dept'])) {echo $approv_r['dept'];}else {echo $approv_r['req_dept'];} ?>", <?php echo  $approv_r['count'];?>, "#394263"],
        
		<?php }
		
		if(empty($s_user) and !empty($s_dept)){
		?>
		
		["<?php if(!empty($approv_r['username'])) {echo $approv_r['username'];} else {echo $approv_r['requester'];} ?>", <?php echo  $approv_r['count'];?>, "#394263"],
		
		
		<?php }
		
		if(!empty($s_user) and !empty($s_dept)){?>
		["<?php if(!empty($approv_r['entry_date'])) {echo $approv_r['entry_date'];}else {echo $approv_r['last_activity_date'];} ?>", <?php echo  $approv_r['count'];?>, "#394263"],
		
		<?php }}?>

								   
								   
							
								 
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Date Wise Report",
        width: 1700,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  <div class="col-sm-7">
<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
</div>
  <div class="clearfix"></div>
  
  
  
                 
	<?php  }}?>		

 <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>									
							</div>			
  
                        
						</div>
									
						
                      
                    <!-- END Datatables Content -->
                </div>
                <!-- END Page Content -->


            <?php include 'footer.php';?>
