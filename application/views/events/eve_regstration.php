<!DOCTYPE html>
<html lang="en">
<head>
	  <title>Event Registration - The IoT Academy</title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow" />
		<meta name="googlebot" content="noindex, nofollow" />
		<meta name="yahooSeeker" content="noindex, nofollow" />
		<meta name="msnbot" content="noindex, nofollow" />
    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>fonts/flaticon.css"> 
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>fonts/fonts2/flaticon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.min.css">
    <?php $this->load->view("commons/commonheaderlink.php") ?>
    <style type="text/css">
        .footer-bottom {
           padding-bottom: 78px !important;
        } 
         .bg-dark{
		color:#ffffff !important;
	}
	input {
	  padding: 10px;
	  width: 100%;
	  border: 1px solid #aaaaaa;
	}
	/* Chrome, Safari, Edge, Opera */
	.mobile::-webkit-outer-spin-button,
	.mobile::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}


	/* Mark input boxes that gets an error on validation: */
	input.invalid {
	  background-color: #ffdddd;
	}

	/* Hide all steps by default: */
	.tab {
	  display: none;
	  margin-bottom: 0px!important;
	}
	
	button:hover {
	  opacity: 0.8;
	}

	button:active{
	  color:green;
	}

	button:focus {    

		background-color:green;    
	}

	#nextBtn{
	      height: 40px;
         width: 132px;
	}

	#submit{
	     height: 40px;
         width: 132px;
	}
	/* Make circles that indicate the steps of the form: */
	.steps-holder{
		  margin-top: 30px;
		  margin-bottom: 20px;
		  display: none;
		  }

	.step {
	  height: 15px;
	  width: 15px;
	  margin: 0 2px;
	  background-color: #bbbbbb;
	  border: none;  
	  border-radius: 50%;
	  display: inline-block;
	  opacity: 0.5;
	}

	.step.active {
	  opacity: 1;
	}

	/* Mark the steps that are finished and valid: */
	.step.finish {
	  background-color:  #4CAF50;
	}
	
	.form-holder {	 
		 margin-bottom: 150px;
	}

	.image-holder{
	  transform: translateY(20px)!important;
	  transform: translateX(40px)!important;
	  
	}

	.inline{
	  display: inline !important;
	  margin-top: 20px;
	  height: 30px;
	  width: 80px;
	  line-height: 5px;
	}
	input, textarea, select, button {
	  color: black!important; }


	.hide{
	  display: none;
	}

	.custhd{
	  margin-top: 20px;
	  border-bottom: 2px solid #fff;
	}

	.click{
	  text-decoration: underline;
	  color:yellow; 
	  cursor: pointer;
	}

	.click:active {
	  text-decoration: underline;
	}

	.table tr:first-child td  {
			border-top: none;
		}

	.table{
	  font-family: "Times New Roman", Times, serif;
	  font-size: 15px;
	} 

	.promo-code{

	  width: 130px;
	  margin-left: -18px;
	} 

	.quantity{
	  margin-left: 70px;
	  width: 70px;
	  height: 40px; 
	  border:none;
	  outline: none!important;
	}

	.text-capitalize{
	  text-transform:capitalize;
	}
	
	.payment-form-class{
		margin-top:18px;
	}
    .payment-next-pre-btn{
		color: white !important;
		font-size: 17px;
		font-weight: 700;
	} 
	@media only screen and (max-width: 768px){
     #submit {
     	width: 100%;
    height: 40px;
    margin-top: 10px;
}
   }
    </style>
	



</head>

<body class="single">
 
<?php $this->load->view("commons/header.php")?>
<div class="container-fluid"  style="background-color: #537895;
background-image: linear-gradient(315deg, #537895 0%, #09203f 74%);">

  <div class="row" style="margin-bottom:-99px;">
    <div class="col-xs-2 col-sm-3"></div>
    <div class="col-sm-6">
      <!-- Circles which indicates the steps of the form: -->
      <h2 class="text-white text-center custhd" ><?=$eventData['event_title']?> Registration</h2>
        <div class="text-center steps-holder">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
      <noscript>
         <h3 class="text-danger">Your browser does not support JavaScript!</h3>
      </noscript>

      <div class="form-holder " id="form-holder">
        <form id="EventregForm" class="form text-white " method="post" action="<?=base_url()?>Paytm/start_payment">
          <input type="hidden" name="EventregForm" id="form" value="">
          <!-- One "tab" for each step in the form: -->
                     
        <div class="container tab mt-0">
		  <div class="row">
			   <div class="col-sm-1"></div>
			   <div class="col-sm-10">
			        <div class="form-group row payment-form-class">
						<div class="col-sm-3 col-form-label lead text-white">First Name:</div>
						 <div class="col-sm-9">
						    <input class="form-control" placeholder="First name..." name="fname" required="required">
                        </div>
                    </div>
					<div class="form-group row payment-form-class">
					    <div class="col-sm-3 col-form-label lead text-white">Last Name:</div>
					    <div class="col-sm-9">
						   <input class="form-control" placeholder="Last Name..."  name="lname" required="required">
					    </div>
					</div>
					<div class="form-group row payment-form-class">
					    <div class="col-sm-3 col-form-label lead text-white">Email ID:</div>
					    <div class="col-sm-9">
						   <input type="email" id="emailEventregForm" name="EMAIL_ID" class="form-control" placeholder="Email ID..." required="required">
						   <span class="text-danger" id="email-errorEventregForm"></span>
					    </div>
					</div>
					<div class="form-group row payment-form-class">
					    <div class="col-sm-3 col-form-label lead text-white">Mobile Number:</div>
					    <div class="col-sm-9">
						  <input type="tel" id="mobileEventregForm" name="MOBILE_NUM" class="form-control" placeholder="Mobile..." maxlength="10" required="required">
						  <span class="text-danger" id="mobile-errorEventregForm"></span>
					    </div>
					</div>
			   </div>
			   <div class="col-sm-1"></div>
		  </div>
        </div>
		<!----=========comment otp verification=========
          <div class="tab">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead text-white"></label>
              <label class="col-sm-8 " >
                  Verification code has been sent to your email:
                <p class="text-primary" id="verify_mailEventregForm"></p>
              </label>
            </div>
            <div class="form-group row"> 
				  <label class="mt-4 col-sm-4 col-form-label lead text-white">Enter OTP:</label>   
				  <div class="col-sm-8 mt-4">
					<input type="Number"class="form-control mobile"  placeholder="OTP..."  name="otp" id="otpEventregForm" onKeyPress="if(this.value.length==6) return false;"required="required">
					<p class="mt-2" id="resendOtpTextEventregForm" style="display: none;">
					  Didn't get? &nbsp;&nbsp;&nbsp;
					  <u>
						<a class = "click text-primary" onclick="sendOTP('otp-url','EventregForm');">Resend</a>
					  </u>
					</p>
					<p class="text-right text-danger hide" id="hideEventregForm">Invalid OTP</p>
				  </div>
            </div>
            <br>
          </div>
		  ====comment otp verification========---->

          <div class="tab" id="check_out">

            <input id="ORDER_ID" type="hidden" tabindex="1" maxlength="20" size="20"name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,999999999)?>">

            <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001">

             <input type="hidden" id="event_id"  name="event_id" autocomplete="off" value="<?=$eventData['event_id']?>">

             <input type="hidden" id="batch_event_type"  name="batch_event_type" autocomplete="off" value="<?=$event_batch_title?>">

            <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
             
              <div class="form-group row">

              <b class="">EVENT: <?=$eventData['event_title']?></b>

              <table class="table">

                  <tbody style="border: 0!important;color:#ffffff;">
                    <tr>
                      <td scope="row"><b style="">Rate:</b></td>
                      <td class="text-center">
                        <strong><?=number_format($eventData['price'],2)?> &#8377;</strong>
                        <input type="hidden" id="price" class="price" name="price" value="<?=$eventData['price']?>">
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Quantity:</th>
                      <td class="float-rght">
                        <input type="number" name="quantity" id="quantity" class="form-control quantity" onKeyPress=" return false;" value="1" min="1" max="10">
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Total Base Price:</th>
                      <td class="text-center">
                        <b id="price-section" class="price-section">
                          <strong id="price-text"><?=number_format($eventData['price'],2)?></strong> &#8377; Only
                        </b>
                      </td>
                    </tr>
                    <tr>
                      <?php if(count($autoDiscountData)>0){ ?>
                        <th scope="row"> Promo code applied: </th>
                        <td class="float-right">
                          <input type="text" id="promo-code" class="d-inline form-control promo-code pr-1" name="discountCode" value="<?=$autoDiscountData['discount_name']?>"> 
                          <i class=" fa fa-check fa-lg text-success" id="promo-check" aria-hidden="true"></i>
                          <p style="font-size: 12px; margin-top: -5px;">
                          Do you have another ? apply here
                          </p>
                        </td>
                      <?php } else{ ?>

                        <th scope="row"> Do you have any Promo/Discount Code:</th>

                        <td class="float-rght">

                          <input type="text" id="promo-code" class="d-inline form-control promo-code " name="discountCode" value="" > 

                          <i class=" fa  fa-lg text-success" id="promo-check" aria-hidden="true"></i>

                        </td>

                      <?php }?>

                    </tr>
              <?php if(count($autoDiscountData)>0){ 
                $discountRate = $autoDiscountData['discount_rate'];
              }else{
                $discountRate = 0;
              } ?>
                   <tr class="prsnt-discount">
                      <th scope="row">Discount</th>
                      <td  class="text-center"><strong id="prsntdiscount"><?=number_format($discountRate,2)?></strong> %</td>
                    </tr>
                    <tr class="discount-amount">
                      <th scope="row">Total Discount </th>
                      <td  class="text-center"><strong id="discountamount">

                        <?php
                            $totalBasePrice=$eventData['price'];

                          $discountAmount=($totalBasePrice*$discountRate/100);

                          echo(number_format($discountAmount,2));

                        ?>
                        

                      </strong> &#8377;</td>
                    </tr>
                    <tr class="clac-Discount">
                      <th>Price After Discount</th>
                      <td  class="text-center"><strong id="clacDiscount">
                        
                        <?php 

                          $totalPrice=$totalBasePrice-$discountAmount;
                          echo(number_format($totalPrice,2));
                        ?>

                      </strong>&#8377;</td>
                    </tr>
                    <tr class="calc-GST">
                      <th>Gst 18 %</th>
                      <td class="text-center"><strong id="calc-GST">
                        
                        <?php

                        $GSTammount=($totalPrice*18)/100;
                        echo(number_format($GSTammount,2));

                        ?>

                      </strong>&#8377;</td>
                    </tr>
                    <tr class="amount-To-Pay">
                      <th>Total price</th>
                      <td class="text-center"><strong id="amountToPay">
                        
                         <?php

                        $amountToPay=$GSTammount+$totalPrice;
                        echo(number_format($amountToPay,2));


                        ?>

                      </strong> &#8377;</td>
                    </tr>
                    
                    <input type="hidden" name="TXN_AMOUNT" id="TXN_AMOUNT" value="<?=$amountToPay?>">

                  </tbody>
              </table>
             
            </div><br>

          </div>
          <div class="row text-right">
           <div class="col-sm-4"></div>
            <div class="col-sm-8 ">
              <div class="row payment-form-class">
                <div class="col-sm-4">
                     <button class="btn btn-warning form-control payment-next-pre-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                </div>
                <div class="col-sm-8">
                    <button class="btn btn-success form-control pl-4 pr-4 mr-2 payment-next-pre-btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <button type="submit" class=" form-control btn btn-success payment-next-pre-btn" type="button" id="submit" >Click To Pay</button>
                </div>
              </div>
            </div> 
          </div>
        </div>
        </form>

      </div>  

    </div>
    <div class="col-sm-3"></div>

  </div>

</div>

<input type="hidden" id="baseurl" name="baseurl" value="<?=base_url()?>">

<input type="hidden"  id="otpdataEventregForm" name="otpdata" value=""> 

<!-- footer -->
<?php $this->load->view("commons/footer.php")?>
<script src="<?php echo asset_url()?>js/validationOtp.js"></script>

<script>

$(function(){

  $.cookie('test_status','null');

});  
  
var currentTab = 0; // Current tab is set to be the first tab (0)

showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");

  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {

    document.getElementById("prevBtn").style.display = "none";
    document.getElementById("submit").style.display = "none";
    

  } 
  else {

    document.getElementById("prevBtn").style.display = "inline";
    document.getElementById("submit").style.display = "none";
  }

  if (n == (x.length - 1)) {

    document.getElementById("nextBtn").innerHTML = "Submit";
    document.getElementById("nextBtn").style.display= "none";

   document.getElementById("submit").style.display = "block";
   document.getElementById('form-holder').style.transform="translateY(40px)";;

  } else {

    document.getElementById("nextBtn").innerHTML = "Next";
    document.getElementById("nextBtn").style.display= "block";

  }
  //... and run a function that will display the correct step indicator:


}


function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");

  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;

  // Hide the current tab:
  x[currentTab].style.display = "none";


  var email=$("#emailEventregForm").val();


    $("#verify_mailEventregForm").html(email);
    
    if ($.cookie('test_status') == 'null') {

        sendOTP('otp-url','EventregForm'); 

        $.cookie('test_status', '1'); 
    }
 
    resendOtpText();

  // Increase or decrease the current tab by 1:

  currentTab = currentTab + n;

  // if you have reached the end of the form...
  if (currentTab >= x.length) {

    // ... the form gets submitted:
    document.getElementById("regForm").submit();

    return false;

  }

  // Otherwise, display the correct tab:
  showTab(currentTab);

}

function validateForm() {

  // This function deals with validation of the form fields
  var x, y, i, valid = true,flag=false;

  x = document.getElementsByClassName("tab");

  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:

  for (i = 0; i < y.length; i++) {

    // If a field is empty...
    if (y[i].value == "") {

      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;

    }

  }

  var flag=emailAndMobileValidate(y);

  if(flag==false && valid==true )

    valid=flag;
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {

      document.getElementsByClassName("step")[currentTab].className += " finish";

  }

  return valid; // return the valid status
}



function emailAndMobileValidate(param){

  var flag1=flag2=flag3=false;

  for (var i = 0; i < param.length; i++) {

    if(param[i].id=='emailEventregForm'){

      flag1=validateEmail(param[i],'EventregForm');

    }
    
    else if(param[i].id=="mobileEventregForm"){

      flag2=validateMobile(param[i],'EventregForm');
    }
    else if(param[i].id=="otpEventregForm"){

      flag3=validateOTP(param[i].value,'EventregForm');
    }

  }
  if(flag1&&flag2 ||flag3){

    //$('#hide').addClass('hide');
    return true;

  }
  else

    return false;
}








function resendOtpText() {
 
  setTimeout(function() { disp_text(); },40000);
 
}

function disp_text() {
   
  $('#resendOtpTextEventregForm').css("display", "block");
   
}

//================CHECK-OUT TAB==================

var allDiscountData=<?php echo json_encode($allDiscountData);?>; 

  //console.log(allDiscountData);


$(function(){



  $('#quantity').change(function(){
  
    var quantity = $(this).val();

    if(quantity==''){

      $('#quantity').val(1);

    }

//=============

    var quantity = $('#quantity').val();    

    var price = $('#price').val();

    var totalBasePrice=calcTotalBasePrice(quantity,price);

    var promoCode=$('#promo-code').val();

    var prsntDiscount=promoCodeCheck(promoCode);

    var discountAmount=clacDiscountAmount(totalBasePrice,prsntDiscount);

    var amountforGST=priceAfterDiscount(totalBasePrice,discountAmount);
    
    var amountOfGST=GSTammount(amountforGST);

    totalAmount=(amountforGST+amountOfGST);

    $('#amountToPay').text(totalAmount.toFixed(2));

     $('#TXN_AMOUNT').val(totalAmount);

  });

  
  
  $('#promo-code').on('input paste change ', function(e) {
     
    var promoCode=$(this).val();

    var quantity = $('#quantity').val();

    var price = $('#price').val();

    var totalBasePrice=calcTotalBasePrice(quantity,price);

    var prsntDiscount=promoCodeCheck(promoCode);

    var discountAmount=clacDiscountAmount(totalBasePrice,prsntDiscount);

    var amountforGST=priceAfterDiscount(totalBasePrice,discountAmount);
    
    var amountOfGST=GSTammount(amountforGST);

    totalAmount=(amountOfGST+amountforGST);

    $('#amountToPay').text(totalAmount.toFixed(2));
    $('#TXN_AMOUNT').val(totalAmount);

  });

  var prsntdiscount=$('#promo-code').val();

  if (prsntdiscount.length<1) {

        $('.prsnt-discount').hide();
        $('.discount-amount').hide();
        $('.clac-Discount').hide();

  }
  


});






//=========================================

function clacDiscountAmount(totalBasePrice,prsntDiscount) {
  
  var discountAmount=(totalBasePrice/100)*prsntDiscount;

   $('#discountamount').text(discountAmount.toFixed(2));

  return discountAmount;

}

function calcTotalBasePrice(price,quantity) {
  
  var totalBasePrice = parseFloat(price) * parseFloat(quantity);

  $('#price-text').text(totalBasePrice.toFixed(2));

  return totalBasePrice;

}

function priceAfterDiscount(totalBasePrice,discountAmount) {
  
  var priceAfterDiscount=totalBasePrice-discountAmount;

  $('#clacDiscount').text(priceAfterDiscount.toFixed(2));

  return priceAfterDiscount;
}

function GSTammount(amountforGST) {
  
  var GSTammount=(amountforGST/100)*18;

  $('#calc-GST').text(GSTammount.toFixed(2));

  return GSTammount;

}


function promoCodeCheck(promoCode) {

  for (var i = 0; i < allDiscountData.length; i++) {

      
      var dicountPromo=allDiscountData[i].discount_name;
      var prsntDiscount=parseFloat(allDiscountData[i].discount_rate);
      if(dicountPromo.trim()==promoCode.trim()){



        $('#promo-check').toggleClass('text-danger fa-times',false);
        $('#promo-check').addClass('text-success fa-check');


        $('#prsntdiscount').text(prsntDiscount.toFixed(2));
        //$('.prsntdiscount').css({"display": " table-row"});

        $('.prsnt-discount').fadeIn("slow");
        $('.discount-amount').fadeIn("slow");
        $('.clac-Discount').fadeIn("slow");

        return prsntDiscount;

    }
    else{

        $('#promo-check').toggleClass('text-success fa-check');
        $('#promo-check').addClass('text-danger fa-times');

        $('#prsntdiscount').text(0);

        $('.prsnt-discount').fadeOut("slow");
        $('.discount-amount').fadeOut("slow");
        $('.clac-Discount').fadeOut("slow");


    }

  }

  return false;

}

</script>
<script type="text/javascript">
 //CHANGE THE MODAL HEADER MSG

   $('#enquireNowModal').on('show.bs.modal', function (event) {
        ///$('#form_name').val(event.relatedTarget.dataset['formName']);
        var headerMsg = event.relatedTarget.dataset['title'];
        var modal = $(this);
        if(typeof headerMsg != 'undefined' && headerMsg!='nil'){
            headerMsg = headerMsg+' @ <a class="text-white" href="tel:9354068856">+91-9354068856</a>';
            modal.find('.modal-title').html(headerMsg)
        }else{
            headerMsg = 'Quick Enquiry @ <a class="text-white" href="tel:9354068856">+91-9354068856</a>';
            modal.find('.modal-title').html(headerMsg)
        }
    });
    //End CHANGE THE MODAL HEADER MSG
</script>
</body>



</html>