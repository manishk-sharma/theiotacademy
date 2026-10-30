
<html>
	<body>
		<p>Dear <?=$name?>,</p>
		<p>Greetings from The IoT Academy!</p>
		<p>Thank you for showing your interest in the course on <strong style="background-color: #ff0;">"Applied Data Science with Python Certification Program By E&ICT Academy IIT Roorkee".</strong> To Download the Brochure <a href="<?php echo asset_url()?>data-science-program-by-eict-academy-iit-roorkee/brochure.pdf" target="_blank">Click Here</a></p>
		<p>As part of the admission process, Once the application form is submitted, the admission team will review your application and respond with the application status within 24 hours.</p>
		<p style="margin-top: 10px;">This course includes Learn  Python, Tableau, Bokeh, Matplotlib, IPython, Jupyter, NumPy, Pandas, PyTorch, Scikit-Learn, Machine Learning in Python, NLTK, MySQL and More From IIT Roorkee faculties and Industry Experts.</p>
		<table border=1 align=center style='padding: 50px; border-collapse: collapse; width: 800px; border-color: #ddd;'>
			<tbody>
				<tr style='background-color: #ed3236; height: 35px; color: #fff; font-weight: bold;'>
					<th colspan=2>Your Application Details</th>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px; font-weight: bold;'>Name</td>
					<td style='padding: 10px;'><strong><?=$name?></strong></td>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px;'> Mobile No</td>
					<td style='padding: 10px;'><?=$mobile?></td>
				</tr>
				<tr>
					<td style='padding: 10px; width: 350px;'> Email ID</td>
					<td style='padding: 10px;'><?=$email?></td>
				</tr>
				<tr>
				<td style='padding: 10px; width: 350px;'>State</td>
					<td style='padding: 10px;'><?=$state?></td>
				</tr>
				<tr>
				<td style='padding: 10px; width: 350px;'>City</td>
					<td style='padding: 10px;'><?=$city?></td>
				</tr>
				<tr style='background-color: #EBEBEB;'>
					<td style='padding: 10px; font-weight: bold; width: 350px;'>Aplication Status</td>
					<td style='padding: 10px; font-weight: bold;'>In-Review</td>
				</tr>
				<tr style='background-color: #ed3236; height: 35px; color: #fff;'>
					<th colspan=2>&#x26AB; &#x26AB; &#x26AB; &#x26AB; &#x26AB;</th>
				</tr>
			</tbody>
		</table>
		<p>In case you have any queries, please feel free to get back to us at <a href="tel:9354068856">+91-9354068856</a> or mail us at <a href="mailto:info@theiotacademy.co?subject=Regarding Data Science with Python Certification Program By IIT-R">info@theiotacademy.co</a>.</p>
		<p style="margin-top: 10px;">Thanks<br/><span>Team The IoT Academy</span><br/>
		<span>Website: <a href="<?=base_url()?>"><?=base_url()?></a></span>
		</p>
	</body>
</html>