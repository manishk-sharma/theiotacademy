<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to Paytm Getwey</title>
		<style type="text/css">
		</style>
	</head>
	<body>
	<h1>Merchant Check Out Page</h1>
	<pre>
	</pre>
	<form method="post" action="<?=base_url()?>Paytm/start_payment">
		<table border="1">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td><label>ORDER_ID::*</label></td>
					<td><input type="hidden" id="ORDER_ID"  maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,99999999)?>">
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>CUSTID ::*</label></td>
					<td><input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>MOBILE_NUM ::*</label></td>
					<td><input id="MOBILE_NUM" tabindex="4" maxlength="10"
						size="10" name="MOBILE_NUM" autocomplete="off" placeholder="9999999999" value="9897485784" required>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>EMAIL_ID ::*</label></td>
					<td><input type="email" id="EMAIL_ID" tabindex="4" name="EMAIL_ID" autocomplete="off" placeholder="yogesh@example.com">
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>Channel ::*</label></td>
					<td><input type="hidden"  id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					</td>
				</tr>
				<tr>
					<td>6</td>
					<td><label>txnAmount*</label></td>
					<td><input title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="100">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		* - Mandatory Fields
	</form>
</body>
</html>