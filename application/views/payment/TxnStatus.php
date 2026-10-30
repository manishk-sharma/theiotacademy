<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
	// following files need to be included
	require_once(APPPATH.'libraries/encdec_paytm.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Transaction status query</title>
<meta name="GENERATOR" content="Evrsoft First Page">
</head>
<body>
	<h2>Transaction status query</h2>
	<form method="post" action="<?=base_url()?>/Paytm/check_payment_status">
		<table border="1">
			<tbody>
				<tr>
					<td><label>ORDER_ID::*</label></td>
					<td><input name="ORDER_ID" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="">
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input value="Status Query" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		<br/></br/>
		<?php
		if (isset($responseParamList) && count($responseParamList)>0 )
		{ 
		?>
		<h2>Response of status query:</h2>
		<table style="border: 1px solid nopadding" border="0">
			<tbody>
				<?php
					foreach($responseParamList as $paramName => $paramValue) {
				?>
				<tr >
					<td style="border: 1px solid"><label><?php echo $paramName?></label></td>
					<td style="border: 1px solid"><?php echo $paramValue?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
		}
		?>
	</form>
</body>
</html>