
<html>
	<body>
		<p>Dear <strong><?=$fname?>!</strong></p>
		<p>Thank you for requesting your faculty application for the <strong><?=$department?></strong> department at <b>The IoT Academy</b>.</p>
		<table border=1 align=center style='padding: 50px; border-collapse: collapse; width: 800px; border-color: #ddd;'>
			<tbody>
				<tr style='background-color: #ed3236; height: 35px; color: #fff; font-weight: bold;'>
					<th colspan=2>&#x261B; Your faculty Application Details</th>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px; font-weight: bold;'>Department</td>
					<td style='padding: 10px;'><strong><?=$department?></strong></td>
				</tr>
				<tr style='background-color: #EBEBEB;'>
					<td style='padding: 10px; width: 350px;'> Name</td>
					<td style='padding: 10px;'><?=$fname ?> <?=$lname?></td>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px;'> Mobile No</td>
					<td style='padding: 10px;'><?=$mobile_no?></td>
				</tr>
				
				<tr>
					<td style='padding: 10px; width: 350px;'> Email ID</td>
					<td style='padding: 10px;'><?=$email_id?></td>
				</tr>
				<tr>
				<td style='padding: 10px; width: 350px;'>Message</td>
					<td style='padding: 10px;'><?=$query?></td>
				</tr>
				<tr style='background-color: #EBEBEB;'>
					<td style='padding: 10px; font-weight: bold; width: 350px;'>Aplication Status</td>
					<td style='padding: 10px; font-weight: bold;'>Completed</td>
				</tr>
				<tr style='background-color: #ed3236; height: 35px; color: #fff;'>
					<th colspan=2>&#x26AB; &#x26AB; &#x26AB; &#x26AB; &#x26AB;</th>
				</tr>
			</tbody>
		</table>
		<p>Thank you for applying your faculty application. As soon as our team member will call you on mobile no <?=$mobile_no?>. </p>
		<p style='font-size: 18px; color: #ff0000;'>With best regards<br/><span>Team The IoT Academy</span><br/>
			<span style='font-size: 14px;'>Website: <a href="<?=base_url()?>"><?=base_url()?></a></span>
		</p>
	</body>
</html>