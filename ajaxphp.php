<?php 
include 'connection.php';

if(isset($_GET['q'])){
 $type=$_GET['q'];
 
?>
<select id="val_skill" name="user" class="form-control" onchange="showUser1(this.value)">
                                                    <option value="">Please select</option>
                                                   <?php 
												   $getdept=mysql_query("select * from users where status=0 and dept='$type'") or die (mysql_error());
												   while($appl=mysql_fetch_array($getdept)){?>
												<option value="<?php echo $appl['username'];?>"><?php echo $appl['username'];?></option>
												<?php 	   
												   }
												   
												   ?>
                                                   
                                                </select>

<?php 
}


if(isset($_GET['u'])){
  $user=$_GET['u'];

 $getdept=mysql_query("select * from users where username='$user'") or die (mysql_error());
 $appl=mysql_fetch_array($getdept);?>
 <table class="table">
 <tr><td>
 Search Page Right:
</td>
<td><label class="switch switch-primary"> <input type="checkbox" name="search" value="1"  <?php if($appl['search']==1){echo 'checked="checked"';}?>><span></span></label></td>
</tr>
 <tr><td>
 Report Page Right:
</td>
<td><label class="switch switch-primary"> <input type="checkbox" name="report" value="1"  <?php if($appl['reports']==1){echo 'checked';}?>><span></span></label></td>
</tr>
 </table>
 <?php 

}




?>