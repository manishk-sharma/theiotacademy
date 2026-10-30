<!---------------->
<!DOCTYPE html>
<html lang="en">
<head>
        <!-- meta tag -->
        <meta charset="utf-8">
        <!---Change SEO Data Here For Title-->
        <title>Receipt  - THE IoT ACADEMY</title> 
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="icon" href="https://www.theiotacademy.co/assets/images/logoicon.png" type="image/x-icon" />

        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->   
        <meta name="google-site-verification" content="C9Cq_KXvbhDfCA8PO4rSqFevR_ebDyX4_y8iuj4">
        <meta name="msvalidate.01" content="B59ACA364606E77DFA470E8E79DBC20A" /> 
        <!---Change SEO Data Here Start-->
        <link rel="canonical" href="https://www.theiotacademy.co/about-us"/>
        <meta name="keywords" content="Contact Us - THE IoT ACADEMY" />
        
        <meta name="description" content="Kindly contact us at C-56/11, 3rd Floor, Near Stellar IT Park, Sector-62, Noida. Our Phone Number - 9354068856, 8287096558. Our Email - enquiry@theiotacademy.co" />
        <!---Change SEO Data Here End-->
        <meta name="distribution" content="global" />
        <meta http-equiv="content-language" content="en-gb">

        <meta name="yandex-verification" content="44a2a6f2942a8a2a" />

        <meta name="geo.region" content="IN-UP" />
        <meta name="geo.position" content="28.613207;77.372733" />
        <meta name="ICBM" content="28.613207, 77.372733" />

        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <meta name="yahooSeeker" content="index, follow" />
        <meta name="msnbot" content="index, follow" />

        <!-- Theiotacademy Open Graph data -->
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="theiotacademy" />
        <!---Change SEO Data Here Start-->
        <meta property="og:title" content="Contact Us - THE IoT ACADEMY" />
        <meta property="og:description" content="Kindly contact us at C-56/11, 3rd Floor, Near Stellar IT Park, Sector-62, Noida. Our Phone Number - 9354068856, 8287096558. Our Email - enquiry@theiotacademy.co"/>  
        <meta property="og:url" content="https://www.theiotacademy.co/about-us"/>
        <meta property="og:image" content="https://www.theiotacademy.co/assets/images/aboutus/background/aboutus2.png"/>
        <meta property="og:image:type" content="image/png"/>
        <meta property="og:image:alt" content="Contact Us"/>
        <!---Change SEO Data Here End-->
        <meta property="og:ttl" content="345600" />
        <meta property="fb:profile_id" content="426804161019130" />

        <!-- Theiotacademy Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@academyforiot" />
        <meta name="twitter:creator" content="@academyforiot" />
        <meta https-equiv="Content-Type" content="Text/HTML" />

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107997348-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-107997348-1');
        </script>

        <!-- bootstrap v4 css -->
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/font-awesome.min.css">
        <!-- animate css -->
        
        <!-- owl.carousel css -->
        
        <!-- slick css -->
         
        <!-- magnific popup css -->
         
        <!-- Offcanvas CSS -->
         
        <!-- flaticon css  -->
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>fonts/flaticon.css"> 
        <!-- flaticon2 css  -->
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>fonts/fonts2/flaticon.css">
        <!-- rsmenu CSS -->
        
        <!-- rsmenu transitions CSS -->
        
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.min.css">
        <!-- responsive css -->
        
        
        <style type="text/css">
            
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
<?php $this->load->view("commons/header.php")?>  

<?php 

$cust_details=$this->CompTeamModel->getTeamByOrderId($ORDERID);
?>

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

<div class="container-fluid" >
<div style="width:100%; height:88% ;background-color:white;">
<div class="row">
  <div class="col-sm-2">
    
  </div>
  <div class="col-sm-8"></div>
  <div class="col-sm-2">
    <button class="btn btn-warning" onclick="printTable()" style="font-weight:bold;margin-top:1%; margin-left:1%;width:100%;">Print Receipt</button>
  </div>
</div>

<div id="feereceipt">

<?php if($STATUS=='TXN_SUCCESS'){?>    
<h4 style="text-align:center;">Payment Receipt</h4>
<h5 style="text-align:center;">Your registration for the <u>Tech Savvy Contest 2020</u> is successful. Reciept has been mailed to you. <br>
Kindly check your inbox/spam/junk folder for the same.
</h5>

<?php } else{ ?>

<h4 style="text-align:center; color:red"><?=$STATUS?></h4>
<h5 style="text-align:center;">Your registration for the <u>Tech Savvy Contest 2020</u> is Unsuccessful.</h5>
    <div class="row mb-4 p-4">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table class="table table-bordered">
              <thead>
                
              </thead>
              <tbody>
                <tr class="table-danger">
                  <th scope="row">STATUS</th>
                  <td  class="text-center"><?=$STATUS?></td>
                </tr>
                <tr>
                  <th scope="row">RESPONSE MESSAGE</th>
                  <td ><?=$RESPMSG?></td>
                </tr>
              </tbody>
            </table>
            If you have any discrepancy in the receipt then please contact us at <span style="font-weight:bold;"><a href="tel:9354068856">9354068856</a></span> or email us at <span style="font-weight:bold;"><a href="mailto:enquiry@theiotacademy.co">enquiry@theiotacademy.co</a></span>
        </div> 
        <div class="col-sm-2"></div>  
    </div>
<?php } if($STATUS=='TXN_SUCCESS') { ?>
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
<td colspan="2">Received From : Team - <strong><?=$cust_details['team_name']?></strong></td>
   
<td></td>
</tr>

<tr>
<!-- <td colspan="4">Mob No :&nbsp;<?=$mobile_num?>&nbsp;|&nbsp;Email ID:&nbsp;<?=$email_id?></td> -->
</tr>


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

<?php }?>


</div>
</div>

</div>

<?php $this->load->view("commons/footer.php")?>

<script type="text/javascript" src="<?php echo asset_url();?>js/captcha.js"></script>

<script type="text/javascript">
  
  //<!-- Script to print the content of a div -->

  function printTable() { 
      var tableContents = document.getElementById("feereceipt").innerHTML; 
      var a = window.open('', '', 'height=500, width=500'); 
      a.document.write('<html>'); 
      a.document.write('<body > <h1>Payment Receipt <br><br>'); 
      a.document.write(tableContents); 
      a.document.write('</body></html>'); 
      a.document.close(); 
      a.print(); 
  } 


</script>

</body>
</html>