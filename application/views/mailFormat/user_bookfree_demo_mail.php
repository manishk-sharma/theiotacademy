                       <html>
							<body>
								<p>Dear <strong><?=$student_name?>!</strong></p>
								<p>Thank you for requesting your free demo for the <strong><?=$student_course?></strong> course at <b>The IoT Academy</b>.</p>
								<table border=1 align=center style='padding: 50px; border-collapse: collapse; width: 800px; border-color: #ddd;'>
									<tbody>
										<tr style='background-color: #ed3236; height: 35px; color: #fff; font-weight: bold;'>
											<th colspan=2>&#x261B; Your Demo Details</th>
										</tr>
										<tr>
											<td style='padding: 10px; width: 350px; font-weight: bold;'> Your Course</td>
											<td style='padding: 10px;'><strong><?=$student_course?></strong></td>
										</tr>
										<tr style='background-color: #EBEBEB;'>
											<td style='padding: 10px; width: 350px;'>Your Name</td>
											<td style='padding: 10px;'><?=$student_name?></td>
										</tr>
										<tr>
											<td style='padding: 10px; width: 350px;'>Your Mob No</td>
											<td style='padding: 10px;'><?=$student_mobile?></td>
										</tr>
										
										<tr>
											<td style='padding: 10px; width: 350px;'>Your Email ID</td>
											<td style='padding: 10px;'><?=$student_email?></td>
										</tr>
										<tr>
											<td style='padding: 10px; width: 350px;'>Book Demo Date</td>
											<td style='padding: 10px;'><?=$student_date?></td>
										</tr>
										
										<tr>
											<td style='padding: 10px; width: 350px;'>Book Demo Time</td>
											<td style='padding: 10px;'><?=$student_demo_time?></td>
										</tr>
										<tr>
											<td style='padding: 10px; width: 350px;'>Location</td>
											<td style='padding: 10px;'>Remote/Online</td>
										</tr>
										<tr style='background-color: #EBEBEB;'>
											<td style='padding: 10px; font-weight: bold; width: 350px;'>Demo Status</td>
											<td style='padding: 10px; font-weight: bold;'>Completed</td>
										</tr>
										<tr style='background-color: #ed3236; height: 35px; color: #fff;'>
											<th colspan=2>&#x26AB; &#x26AB; &#x26AB; &#x26AB; &#x26AB;</th>
										</tr>
									</tbody>
								</table>
								<p>Thank you for booking your demo. Soon you will receive a meeting link/ID on your registered email </p>
								<p style='font-size: 18px; color: #ff0000;'>With best regards<br/><span>Team The IoT Academy</span><br/>
									<span style='font-size: 14px;'>Website: <a href="<?=base_url()?>"><?=base_url()?></a></span>
								</p>
							</body>
						</html>