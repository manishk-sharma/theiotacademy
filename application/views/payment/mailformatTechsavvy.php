
<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        .iotlogo{
            height:100px;
            width:70%;
        }
        .bgcolor{
          background-color: #537895;
          background-image: linear-gradient(315deg, #537895 0%, #09203f 74%);
        }
        .table-div{
          margin-top: 70px;
          height: 700px;
          background-color: white;
        }
        .table{

          
        }
    </style>
</head>
<body class="instructor-home">
<?php 

$cust_details=$this->CompTeamModel->getTeamByOrderId($ORDERID);

?>


<div id="feereceipt">
<h2 style="text-align:center;">Payment Receipt</h2>

<table style=" width:80% ;" border="0" align="center" >
<thead>


<tr>
<th colspan="6">
<hr style=" border-top: 1px solid black ;">
<div id="complogo">
  
</div>
<div id="compname">
<h2 style="text-align:center;">The IoT Academy</h2>
<h5 style="text-align:center;">(A Division of Uniconverge Technologies Pvt. Ltd.)</h5>
<p style="text-align:center; font-size:90%; font-weight:normal;">Address: Block C-56/11, Ground Floor, Near Stellar IT Park, Sector-62, Noida, UP-201309</p>
</div>
<hr style=" border-top: 1px solid black ;">
</th>
</tr>


</thead>
<tbody>

<tr>
<td colspan="4" align="right">Date:&nbsp;<?=date('d-m-Y h:i:s A',strtotime($TXNDATE))?></td>
</tr>


<tr>
<td colspan="2">Received From : <?=$cust_details['team_name']?></td>
   
<td></td>
</tr>

<!-- <tr>
<td colspan="4">Mob No :&nbsp;<?=$mobile_num?>&nbsp;|&nbsp;Email ID:&nbsp;<?=$email_id?></td>
</tr> -->


<tr>
<td colspan="4">Receipt No.:&nbsp;<?=$ORDERID?></td>
</tr>
<tr>
<td colspan="4">Transaction Id : <?=$TXNID?></td>   
</tr>

<tr>

<td style="font-weight:bold;" width="5%"><hr style=" border-top: 1px solid black ;">S.No.<hr style=" border-top: 1px solid black ;"></td>

<td style="font-weight:bold;" colspan="2"><hr style=" border-top: 1px solid black ;">Description<hr style=" border-top: 1px solid black ;"></td>

<td colspan="2" style="font-weight:bold;" ><hr style=" border-top: 1px solid black ;">Rate<hr style=" border-top: 1px solid black ;"></td>


<td style="font-weight:bold; text-align:right;" width="5%"><hr style=" border-top: 1px solid black ;">Amount(&#8377;)<hr style=" border-top: 1px solid black ;"></td>

</tr>

<tr>

<td>1.</td>

<td colspan="2" style="height:20%;">
  <span style="font-size:16px;font-weight:bold;">Contest: Tech Savvy 2020&nbsp;</span><br>Payment Type:&nbsp; Registration
    <br><br>
</td>


<td style="height:20%; text-align:left;">  500.00 &nbsp;<br><br><br><br></td>

<td style="height:20%; text-align:left;"> &nbsp;<br><br><br><br></td>

<td style="height:20%; text-align:right;"> 500.00 &nbsp;<br><br><br><br></td>


</tr>



<tr>

<td></td>

<td>Payment Mode:&nbsp;&nbsp;<?=$PAYMENTMODE?></td>
<?php if(isset($BANKNAME)){?>
<td>Bank Name:&nbsp;&nbsp;<?=$BANKNAME?></td>
<?php } else { ?>
<td>Gateway:&nbsp;&nbsp;<?=$GATEWAYNAME?></td>
<?php }?>

<td></td>

</tr>


<tr>
<td colspan="5" style="text-align:left; font-weight:bold;">Net Amount Paid:<hr style=" border-top: 1px solid black ;"></td>
<td style="text-align:right; font-weight:bold;">&nbsp;<?=number_format($TXNAMOUNT,2)?><hr style=" border-top: 1px solid black ;"></td>
</tr>

<tr>

<td></td>

<td>Payment Mode:&nbsp;&nbsp;<?=$PAYMENTMODE?></td>
<?php if(isset($BANKNAME)){?>
<td>Bank Name:&nbsp;&nbsp;<?=$BANKNAME?></td>
<?php } else { ?>
<td>Gateway:&nbsp;&nbsp;<?=$GATEWAYNAME?></td>
<?php }?>

<td></td>
</tr>





<tr>
<td colspan="6" style="text-align:justify;">
<br><br>
Note: If above mentioned payments are done other than CASH then the actual receipt is subjects to realisation of respective instrument (e.g. Cheque/Online Payment/EFT/Credit Card/Debit Card).
<br><br>
</td>
</tr>


<tr>
<td colspan="6" style="text-align:justify;">
It is a computer generated report doesn't require any signatures.
<hr style=" border-top: 1px solid black ;">
<br>
</td>
</tr>


<tr>
<td colspan="6" style="text-align:justify;">
If you have any discrepancy in the receipt then please contact us at <span style="font-weight:bold;"><a href="tel:9354068856">9354068856</a></span> or email us at <span style="font-weight:bold;"><a href="mailto:enquiry@theiotacademy.co">enquiry@theiotacademy.co</a></span>
<hr style=" border-top: 1px solid black ;">
<br>
</td>
</tr>


</tbody>
</table>
</div>
</body>
</html>