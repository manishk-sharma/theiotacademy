                       <html>
							<body>
								<p>Dear <strong><?=$student_name?>!</strong></p>
								<p>Thank you for applying the <strong><?=$student_course?></strong> course at The IoT Academy.</p>
								<table border=1 align=center style='padding: 50px; border-collapse: collapse; width: 800px; border-color: #ddd;'>
									<tbody>
										<tr style='background-color: #3A3A3A; height: 35px; color: #fff; font-weight: bold;'>
											<th colspan=2>&#x261B; Your Registration Details</th>
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
										<tr style='background-color: #EBEBEB;'>
											<td style='padding: 10px; font-weight: bold; width: 350px;'>Registration Status</td>
											<td style='padding: 10px; font-weight: bold;'>Completed</td>
										</tr>
										<tr style='background-color: #3A3A3A; height: 35px; color: #fff;'>
											<th colspan=2>&#x26AB; &#x26AB; &#x26AB; &#x26AB; &#x26AB;</th>
										</tr>
									</tbody>
								</table>
								<p>Thank you for applying this course and soon our team member will call you on mobile no <?=$student_mobile?>.</p>
								<p style='font-size: 18px; color: #ff0000;'>With best regards<br/><span style='color: #00f;'>Team The IoT Academy</span><br/>
									<span style='color: #ff0080; font-size: 14px;'>Website: <a href="<?=base_url()?>"><?=base_url()?></a></span>
								</p>
							</body>
						</html>