<?php //print_r($payinfo) ;?>
<?php //print_r($reginfo) ;?>
<?php //print_r($stdinfo) ;?>
<?php //print_r($courseinfo) ;?>
<?php //print_r($compinfo) ;?>
<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<script>
	function printFeeReceipt() {
	var prtContent = document.getElementById("feereceipt");
	var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	}
</script>
<div class="container-fluid">
<div style="width:100%; height:88% ;background-color:white;">
<div class="row">
	<div class="col-sm-2">
		<a href="<?php echo base_url()?>apayment" class="btn btn-primary" style="font-weight:bold;margin-top:1%; margin-left:1%;width:100%;">Back</a>
	</div>
	<div class="col-sm-8"></div>
	<div class="col-sm-2">
		<button class="btn btn-warning" onclick="printFeeReceipt()" style="font-weight:bold;margin-top:1%; margin-left:1%;width:100%;">Print Receipt</button>
	</div>
</div>
<div id="feereceipt">
<h4 style="text-align:center;">Payment Receipt</h4>
<table style=" width:80% ;" border="0" align="center" >
<thead>
<tr>
<th colspan="4">
<hr style=" border-top: 1px solid black ;">
<div id="complogo">
	
</div>
<div id="compname">
<h2 style="text-align:center;"><?=$compinfo['company_name']?></h2>
<h5 style="text-align:center;">(A Division of Uniconverge Technologies Pvt. Ltd.)</h5>
<p style="text-align:center; font-size:90%; font-weight:normal;">Address: <?=$compinfo['company_addr']?></p>
</div>
<hr style=" border-top: 1px solid black ;">
</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="4" align="right">Date:&nbsp;<?=date('d-m-Y',strtotime($payinfo['trans_date']))?></td>
</tr>
<tr>
<td colspan="4">Received From:</td>
</tr>
<tr>
<td colspan="4"><?=$stdinfo['first_name']." ".$stdinfo['last_name']?></td>   
</tr>
<tr>
<td colspan="4">Student ID:&nbsp;<?=$stdinfo['student_id']?>&nbsp;|&nbsp;Reg. ID:&nbsp;<?=$reginfo['registration_id']?></td>   
</tr>
<tr>
<td colspan="4">Mob No.:&nbsp;<?=$stdinfo['mobile_no']?>&nbsp;|&nbsp;Email ID:&nbsp;<?=$stdinfo['email_id']?></td>
</tr>  
<tr>
<td colspan="4" align="right">Receipt No.:&nbsp;<?=$payinfo['payment_id']?></td>
</tr>
<tr>
<td colspan="4">Transaction Details</td>   
</tr>

<tr>
<td style="font-weight:bold;" width="5%"><hr style=" border-top: 1px solid black ;">S.No.<hr style=" border-top: 1px solid black ;"></td>
<td style="font-weight:bold;" colspan="2"><hr style=" border-top: 1px solid black ;">Description<hr style=" border-top: 1px solid black ;"></td>
<td style="font-weight:bold; text-align:right;" width="5%"><hr style=" border-top: 1px solid black ;">Amount(&#8377;)<hr style=" border-top: 1px solid black ;"></td>
</tr>
<tr>
<td style="text-align:top;">1.<br><br><br><br></td>
<td colspan="2" style="height:20%;">
	<span style="font-size:16px;font-weight:bold;">Course:&nbsp;<?=$courseinfo['course_title']?></span><br>Payment Type:&nbsp;<?=$payinfo['payment_type']?><br>Remark:&nbsp;<?=$payinfo['remarks']?>
    <br><br>
</td>
<td style="height:20%; text-align:right;">&#8377;&nbsp;<?=$payinfo['fee_amount']?>.00<br><br><br><br></td>
</tr>
<tr>
<td colspan="3" style="text-align:right;"><hr style=" border-top: 1px solid black ;">GST As Applicable:<hr style=" border-top: 1px solid black ;"></td>
<td style="text-align:right;"><hr style=" border-top: 1px solid black ;">&#8377;&nbsp;<?=$payinfo['tax_amount']?>.00<hr style=" border-top: 1px solid black ;"></td>
</tr>
<tr>
<td colspan="3" style="text-align:right; font-weight:bold;">Net Amount Paid:<hr style=" border-top: 1px solid black ;"></td>
<td style="text-align:right; font-weight:bold;">&#8377;&nbsp;<?=$payinfo['net_amount']?>.00<hr style=" border-top: 1px solid black ;"></td>
</tr>

<tr>
<td></td>
<td>Payment Mode:&nbsp;&nbsp;<?=$payinfo['payment_mode']?></td>
<td>Bank Name:&nbsp;&nbsp;<?=$payinfo['inst_bank']?></td>
<td></td>
</tr>
<tr>
<td></td>
<td>Instrument No.:&nbsp;&nbsp;<?=$payinfo['inst_number']?></td> 
<td>Instrument Date:&nbsp;&nbsp;<?=date('d-m-Y',strtotime($payinfo['inst_date']))?></td>
<td></td>
</tr>
<tr>
<td></td>
<td colspan="3">Instrument Amount:&nbsp;&#8377;&nbsp;<?=$payinfo['inst_amount']?></td>
</tr>
<tr>
<td></td>
<td colspan="3">Transaction Status:&nbsp;&nbsp;<?=$payinfo['trans_status']?></td>
</tr>
<tr>
<td colspan="4" style="text-align:justify;">
<br><br>
Note: If above mentioned payments are done other than CASH then the actual receipt is subjects to realisation of respective instrument (e.g. Cheque/Online Payment/EFT/Credit Card/Debit Card).
<br><br>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:justify;">
It is a computer generated report doesn't require any signatures.
<hr style=" border-top: 1px solid black ;">
<br>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:justify;">
If you have any discrepancy in the receipt then please contact us at <span style="font-weight:bold;"><?=$compinfo['contact_no']?></span> or email us at <span style="font-weight:bold;"><?=$compinfo['email_id']?></span>
<hr style=" border-top: 1px solid black ;">
<br>
</td>
</tr>
</tbody>
</table>
</div>
</div>

</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
  redirect(base_url()."login");
}
?>