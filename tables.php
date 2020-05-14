<?php if($row['formid']==1){?>

<style>
.noborder{border-top:0px; vertical-align:bottom;}
td{border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;}
</style>
<br>
<div class="clearfix"></div><br>
<table class="table" width="951" height="200" border="0">
  <tr >
    <td valign="middle" style="border:0px; vertical-align:bottom;"><span class="style2">Beneficiary Name</span></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><?php echo '<b>'.$row['benif_name'].'</b>';?></td>
    <td style="border:0px; vertical-align:bottom;" >Beneficiary Bank Account Number</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_ac'];?></b></td>
   </tr>
  <tr >
    <td align="right" width="92" valign="middle" style="border:0px; vertical-align:bottom;"><span style="text-align:right;">Beneficiary Bank Name</span></td>
    <td width="154" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_name'];?></b></td>
    <td width="140" style="border:0px; vertical-align:bottom;">Payment Currency</td>
    <td width="167" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><?php echo '<b>'.$row['payc'].'</b>';?></td>
    <td width="182" style="border:0px; vertical-align:bottom;">Amount (AED)</td>
    <td width="176" style="border:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><?php echo '<b>'.number_format($row['amount']).'</b>';?></td>
  </tr>
  <tr>
    <td style="border:0px; vertical-align:bottom;">Invoice #</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <?php echo '<b>'.$row['invoice'].'</b>';?></td>
    <td style="border:0px; vertical-align:bottom;">Invoice Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo date('d-m-Y',strtotime($row['inv_date']));?></td>
    <td style="border:0px; vertical-align:bottom;">Settlement Due date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><?php echo '<b>'.date('d-M-Y', strtotime($row['due_date'])).'</b>' ; ?></td>
  </tr>
</table>
<?php  } //========================?>




<?php if($row['formid']==2){?>

<table class="table" width="581" height="200" border="0">
  <tr>
    <td width="10" valign="middle" style="border:0px; vertical-align:bottom;" class="text-right">Beneficiary Name</td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" class="text-center"><b><?php echo $row['benif_name'];?></b></td>
    <td width="10" style="border:0px; vertical-align:bottom;" class="text-right">Amount (AED)</td>
    <td width="167" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" class="text-center"><b><?php echo $row['amount'];?></b></td>
   </tr>
</table>

<?php } //==========================================?>

<?php if($row['formid']==3){?>

<table class="table" width="700" height="100" border="0">
  <tr>
    <td  width="144" style="border:0px; vertical-align:bottom;">Beneficiary Name</td>
    <td width="230" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" class="text-center"><b><?php echo $row['benif_name'];?></b></td>
    <td width="144" style="border:0px; vertical-align:bottom;" class="text-right" >Amount (AED)</td>
    <td width="308" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" class="text-center"><b><?php echo $row['amount'];?></b></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;border-top:0px;">Settlement Due date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" class="text-center"><b><?php echo $row['due_date'];?></b></td>
    <td style="vertical-align:middle;border-top:0px;"></td>
    <td></td>
	
  </tr>
</table>



<?php } //==========================================?>



<?php if($row['formid']==4){?>


<table class="table" width="951" height="200" border="0">
  <tr>
    <td style="border:0px; vertical-align:bottom;">Beneficiary Name</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_name'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Beneficiary Bank Account Number</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_ac'];?></b></td>
   </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Contract /P.O #</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['contract_po'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Number of receipt Stores / certificate of completion of the work</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['completion_work'];?></b></td>
   </tr>
  <tr>
    <td  width="118"  style="border:0px; vertical-align:bottom;">Beneficiary Bank Name</td>
    <td width="149" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_name'];?></b></td>
    <td style="border:0px; vertical-align:bottom;" width="171">Payment Currency</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['payc'];?></b></td>
    <td width="153" style="border:0px; vertical-align:bottom;">Amount (AED)</td>
    <td width="176" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
  </tr>
  <tr>
    <td style="border:0px; vertical-align:bottom;">Invoice #</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['invoice'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Invoice Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_date'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Settlement Due date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['due_date'];?></b></td>
  </tr>
</table>
<?php } //==========================================?>


<?php if($row['formid']==5){?>

<table class="table" width="641" height="100" border="0">
  <tr>
    <td style="border:0px; vertical-align:bottom;">Beneficiary Name</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_name'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Amount (AED)</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
   </tr>
  <tr>
    <td  width="133" style="border:0px; vertical-align:bottom;">Batch / Invoice #</td>
    <td width="178" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['invoice'];?></b></td>
    <td style="border:0px; vertical-align:bottom;" width="141">Batch / Invoice Date</td>
    <td width="161" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['benif_name'];?></b>
    </td>
   </tr>
</table>


<?php } //==========================================?>


<?php if($row['formid']==6){?>

<table class="table" width="802" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;"><span class="style2">Ledger</span></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['ledger'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Batch/Benificiary Bank Account Number</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_ac'];?></b></td>
   </tr>
  <tr>
    <td  width="123"  style="border:0px; vertical-align:bottom;">Batch / Benificiary Name</td>
    <td width="234" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_name'];?></b></td>
    <td style="border:0px; vertical-align:bottom;" width="106"> Account Number</td>
    <td width="311" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['acc_no'];?></b>
    </td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Total Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
    <td style="border:0px; vertical-align:bottom;"><?php echo $row['choos1'];?></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['cam1'];?></b></td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;"><?php echo $row['choos2'];?></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['cam2'];?></b></td>
    <td style="border:0px; vertical-align:bottom;"><?php echo $row['choos3'];?></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['cam3'];?></b></td>
  </tr>
  <tr>
    <td style="border:0px; vertical-align:bottom;"><?php echo $row['choos4'];?></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['cam4'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Accruals</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['accurals'];?></b></td>
  </tr>
</table>



<?php } //==========================================?>


<?php if($row['formid']==7){?>

<table class="table" width="802" height="120" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;"><span class="style2">From Ledger</span></td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['from_ledger'];?></b>
    </td>
    <td style="border:0px; vertical-align:bottom;">To Ledger</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['to_ledger'];?></b></td>
  </tr>
  <tr>
    <td  width="173"  style="border:0px; vertical-align:bottom;">From Bank Account</td>
    <td width="159" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['from_bank'];?></b></td>
    <td style="border:0px; vertical-align:bottom;" width="147"> To Bank Account</td>
    <td width="295" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['to_bank'];?></b>
    </td>
   </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Total Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


<?php } //==========================================?>


<?php if($row['formid']==8){?>
<table class="table" width="906" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Type</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo $row['type'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Benificiary Name</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_name'];?></b></td>
   </tr>
  <tr>
    <td  width="165"  style="border:0px; vertical-align:bottom;">Contract #</td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['contract_no'];?></b></td>
    <td style="border:0px; vertical-align:bottom;" width="138"> Currency Type</td>
    <td width="141" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['payc'];?></b></td>
    <td width="50"  style="border:0px; vertical-align:bottom;">Amount</td>
    <td width="300"  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['amount'];?></b>
    </td>
   </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">From Period </td>
    <td colspan="2" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['from_period'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">To Period</td>
    <td colspan="2" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['to_period'];?></b></td>
   </tr>
</table>


<?php } //==========================================?>





<?php if($row['formid']==9){?>

<table class="table" width="474" height="130" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Prepayment Request NO. </td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['prepay_req_no'];?></b>
    </td>
    <td width="138" style="border:0px; vertical-align:bottom;">Prepayment Currency</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['payc'];?></b></td>
  </tr>
  <tr>
    <td  width="165"  style="border:0px; vertical-align:bottom;">Payment Amount</td>
    <td  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['prepay_amount'];?></b></td>
    <td width="144" style="border:0px; vertical-align:bottom;">Total Cost</td>
    <td width="125"  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['total_cost'];?></b>
    </td>
   </tr>
  <tr>
    <td style="border:0px; vertical-align:bottom;">Deposit Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['diposit_amount'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Surplus Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['suplus_amount'];?></b></td>
    <td width="125" style="border:0px; vertical-align:bottom;">% Increase of prepayment</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['perc_increase_prepay'];?></b></td>
  </tr>
</table>


<?php } //==========================================?>




<?php if($row['formid']==10){?>

<table class="table" width="1156" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Premenant Petty Cash Request NO. </td>
    <td width="317" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['prepay_req_no'];?></b>
    </td>
    <td width="144" style="border:0px; vertical-align:bottom;">Description</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['description'];?></b></td>
  </tr>
  <tr>
    <td  width="222"  style="border:0px; vertical-align:bottom;">Premenant Petty Cash  Amount</td>
    <td  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
    <td width="144" style="border:0px; vertical-align:bottom;">Total Cost</td>
    <td width="231"  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><label>
      <b><?php echo $row['total_cost'];?></b>
    </label></td>
   </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Deposit Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo $row['diposit_amount'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Surplus Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['suplus_amount'];?></b></td>
    <td width="174">% Increase of <span style="border:0px; vertical-align:bottom;">Premenant</span>prepayment</td>
    <td width="46" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['perc_increase_prepay'];?></b></td>
  </tr>
</table>

<?php } //==========================================?>


<?php if($row['formid']==11){?>

<table class="table" width="1156" border="0">
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Temporary Petty Cash Request NO. </td>
    <td width="317" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['prepay_req_no'];?></b>
    </td>
    <td width="144" style="border:0px; vertical-align:bottom;">Description</td>
    <td colspan="3" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['description'];?></b></td>
  </tr>
  <tr>
    <td  width="222"  style="border:0px; vertical-align:bottom;">Temporary Petty Cash  Amount</td>
    <td  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
    <td width="144" style="border:0px; vertical-align:bottom;">Total Cost</td>
    <td width="231"  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><label>
      <b><?php echo $row['total_cost'];?></b>
    </label></td>
   </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Deposit Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo $row['diposit_amount'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Surplus Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['suplus_amount'];?></b></td>
    <td width="174">% Increase of <span style="border:0px; vertical-align:bottom;">Temporary</span>prepayment</td>
    <td width="46" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['perc_increase_prepay'];?></b></td>
  </tr>
</table>

<?php } //==========================================?>




<?php if($row['formid']==12){?>

<table class="table" width="969" border="0">
  <tr>
    <td valign="middle" style="border:0px; vertical-align:bottom;">Premenant Petty Cash Request NO. </td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['per_prety_cash_reqno'];?></b>
    </td>
    <td width="138" style="border:0px; vertical-align:bottom;">Temporary Petty Cash  Amount</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b></td>
    <td width="129" style="border:0px; vertical-align:bottom;">Total Costs </td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['total_cost'];?></b></td>
  </tr>
  <tr>
    <td  width="224" style="border:0px; vertical-align:bottom;">Reimbursement Amount</td>
    <td  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['Reimbur_amt'];?></b></td>
   </tr>
</table>

<?php } //==========================================?>


<?php if($row['formid']==13){?>

<table class="table" width="1137" height="130" border="0">
  <tr>
    <td width="118"  style="border:0px; vertical-align:bottom;">Customer Name</td>
    <td width="225" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
   <b><?php echo $row['cus_name'];?></b>
   </td>
    <td width="90" style="border:0px; vertical-align:bottom;">Cheque #</td>
    <td width="275" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['check_no'];?></b></td>
    <td width="98" style="border:0px; vertical-align:bottom;">Cheque Amount</td>
    <td width="149" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['check_amount'];?></b></td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Due Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['due_date'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Invoice #</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_no'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Invoice Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo $row['inv_date'];?></b></td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Invoice Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_amt'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php } //==========================================?>


<?php if($row['formid']==14){?>
<table class="table" width="1137" height="130" border="0">
  <tr>
    <td width="118"  style="border:0px; vertical-align:bottom;">Customer Name</td>
    <td width="225" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
   <b><?php echo $row['cus_name'];?></b>
   </td>
    <td width="90" style="border:0px; vertical-align:bottom;">Cheque #</td>
    <td width="275" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['check_no'];?></b></td>
    <td width="98" style="border:0px; vertical-align:bottom;">Cheque Amount</td>
    <td width="149" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['check_amount'];?></b></td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Invoice Amount</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_amt'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Invoice #</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['invoice'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Invoice Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"> <b><?php echo $row['inv_date'];?></b></td>
  </tr>
  
</table>

<?php } //==========================================?>


<?php if($row['formid']==15){?>

<table class="table" width="770" height="130" border="0">
  <tr>
    <td width="104"  style="border:0px; vertical-align:bottom;" class="text-center">Customer Name</td>
    <td width="152" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['cus_name'];?></b>
    </td>
    <td width="62" style="border:0px; vertical-align:bottom;" class="text-center">Invoice #</td>
    <td width="173" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['invoice'];?></b></td>
    <td width="78" style="border:0px; vertical-align:bottom;" class="text-center">Invoice Date</td>
    <td width="149" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_date'];?></b>    </td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;" class="text-center">Invoice Amount</td>
    <td  style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_amt'];?></b></td>
   </tr>
</table>

<?php } //==========================================?>


<?php if($row['formid']==16){?>


<table class="table" width="824" height="130" border="0">
  <tr>
    <td style="border:0px; vertical-align:bottom;">Benificiary Name</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_name'];?></b></td>
    <td style="border:0px; vertical-align:bottom;">Beneficiary Bank Account Number</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['benif_bank_ac'];?></b></td>
   </tr>
  <tr>
    <td width="146" style="border:0px; vertical-align:bottom;">Beneficiary Bank Name</td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['benif_bank_name'];?></b>
    </td>
    <td width="152" style="border:0px; vertical-align:bottom;">Payment Currency</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['payc'];?></b></td>
    <td width="62" style="border:0px; vertical-align:bottom;">Amount</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['amount'];?></b>    </td>
  </tr>
  <tr>
    <td  style="border:0px; vertical-align:bottom;">Charge To</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
      <b><?php echo $row['charg_to'];?></b>
    </td>
   </tr>
</table>


<?php } //==========================================?>


<?php if($row['formid']==17){?>

<table class="table table-bordered" width="920" border="1">
  <tr>
    <td valign="middle" style="vertical-align:middle;">Ledger</td>
    <td colspan="2"><b><?php echo $row['ledger'];?></b></td>
    <td><span style="vertical-align:middle;">Total Amount</span></td>
    <td colspan="2"><b><?php echo $row['amount'];?></b></td>
   </tr>
  <tr>
    <td width="142" valign="middle" style="vertical-align:middle;">Basic Salary</td>
    <td width="167">
      <b><?php echo $row['basic_salary'];?></b>
    </td>
    <td width="139" style="vertical-align:middle;">Basic Salary Arrears</td>
    <td width="145">
	<b><?php echo $row['basic_salary_arrear'];?></b>
	</td>
    <td width="159">Phone Allowances </td>
    <td width="177"><b><?php echo $row['phone_allow'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;">Over Time</td>
    <td><b><?php echo $row['over_time'];?></b></td>
    <td style="vertical-align:middle;">Car Allowances</td>
    <td><b><?php echo $row['car_allown'];?></b></td>
    <td>Phone Allowances Arrears</td>
    <td><b><?php echo $row['phone_allow_arr'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Over Time Arrears</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['over_time_arrears'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Car    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['car_allow_arre'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['fule_allow'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['other_allow'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Other    Allowances Arrears</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['other_allow_arre'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Fuel    Allowances&nbsp; Arrears</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['fule_all_arre'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['accomod_allow'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Accommodation    Allowance Arrears</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['accomo_allow_arre'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['advance_salary'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Salary</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['leave_salary'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Encashment&nbsp;</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['leave_encash'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Leave    Provision</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['leave_provision'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Encashment</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['airticket_encash'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Gratuity    Encashment (Regular)</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['grautity_encashment'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Air    Ticket Provision</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['airticket_prov'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Hourly    Leave Deduction</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['hourly_leave_deduc'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Advance    Salary Recovery</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['advance_salary_recovery'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Graduity    Provision</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['grad_prov'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Unpaid    Leave Deduction</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['unpaid_leave_deduc'];?></b></td>
    <td style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Other Deductions</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['vehicles_other_deduc'];?></b></td>
    <td><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Vechiles    Fines Deductions</td>
      </tr>
    </table></td>
    <td><b><?php echo $row['vehicle_fines_deduc'];?></b></td>
  </tr>
  <tr>
    <td valign="middle" style="vertical-align:middle;"><table cellspacing="0" cellpadding="0">
      <tr>
        <td >Late    Coming Deduction</td>
      </tr>
    </table></td>
    <td colspan="5"><b><?php echo $row['late_coming_deduc'];?></b></td>
   </tr>
</table>


<?php } //==========================================?>


<?php if($row['formid']==18){?>


<table class="table" width="969" border="0">
  <tr>
    <td width="224" style="border:0px; vertical-align:bottom;" class="text-center">Customer Name</td>
    <td width="150" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;">
    <b><?php echo $row['cus_name'];?></b>
    </td>
    <td width="138" style="border:0px; vertical-align:bottom;" class="text-center">Contract/PO/WO No</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;" ><b><?php echo $row['contract_po'];?></b></td>
    <td width="129" style="border:0px; vertical-align:bottom;" class="text-center">Inv Amount</td>
    <td width="144" style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['inv_amt'];?></b></td>
  </tr>
  <tr>
    <td style="border:0px; vertical-align:bottom;" class="text-center">Due Date</td>
    <td style="border-top:0px; vertical-align:bottom; border-bottom:1px solid #D3D3D3;"><b><?php echo $row['due_date'];?></b></td>
    
   
  </tr>
  
</table>
</table>


<?php } //==========================================?>













  <tr>
    <td height="76" colspan="5" valign="top" style="border-top:0px; vertical-align:bottom;">
         <br>Description<textarea name="textarea" id="textarea" rows="9" class="form-control" readonly="readonly"><?php echo $row['description'];?></textarea>
         
       </td>
  </tr>