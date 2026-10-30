
<html>
	<body>
		<p>Dear <strong><?=$emp_name?>!</strong></p>
		<p>Thank you for requesting your job application for the <strong><?=$emp_job_category?></strong> job at <b>The IoT Academy</b>.</p>
		<table border=1 align=center style='padding: 50px; border-collapse: collapse; width: 800px; border-color: #ddd;'>
			<tbody>
				<tr style='background-color: #ed3236; height: 35px; color: #fff; font-weight: bold;'>
					<th colspan=2>&#x261B; Your Job Application Details</th>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px; font-weight: bold;'>Applied For</td>
					<td style='padding: 10px;'><strong><?=$emp_job_category?></strong></td>
				</tr>
				<tr style='background-color: #EBEBEB;'>
					<td style='padding: 10px; width: 350px;'> Name</td>
					<td style='padding: 10px;'><?=$emp_name?></td>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px;'> Mobile No</td>
					<td style='padding: 10px;'><?=$emp_mobile?></td>
				</tr>
				
				<tr>
					<td style='padding: 10px; width: 350px;'> Email ID</td>
					<td style='padding: 10px;'><?=$emp_email?></td>
				</tr>
				<tr>
				<td style='padding: 10px; width: 350px;'>apply Date</td>
					<td style='padding: 10px;'><?=$created_date?></td>
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
		<p>Thank you for applying your job apllication. Soon you will receive a meeting link/ID on your registered email </p>
		<p style='font-size: 18px; color: #ff0000;'>With best regards<br/><span>Team The IoT Academy</span><br/>
			<span style='font-size: 14px;'>Website: <a href="<?=base_url()?>"><?=base_url()?></a></span>
		</p>
	</body>
</html>