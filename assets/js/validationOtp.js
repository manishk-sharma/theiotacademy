function validateEmail(emailField,formName){

  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

  if (reg.test(emailField.value) == false) 
  {
     
      $('#email-error'+formName).toggleClass('hide');
  

      $('#email-error'+formName).html('Invalid Email Id');


      return false;
  }

  $('#email-error'+formName).html('');

  $('#email-error'+formName).toggleClass('hide');

  $('#email'+formName).removeClass('invalid');

  return true;
}

function validateMobile(mobileField,formName) {

  var reg=/^[6-9]\d{9}$/;

  if (reg.test(mobileField.value) == false) 
  {
      //alert('Invalid Mobile Number');

      $('#mobile-error'+formName).toggleClass('hide');
  
      $('#mobile-error'+formName).html('Invalid Mobile Number');

      return false;

  }

  $('#mobile-error'+formName).html('dxcdxdc');
  $('#mobile-error'+formName).toggleClass('hide');
  $('#mobile'+formName).removeClass('invalid');
  return true;

}


function validateOTP(enterdOtp,formName){

    //alert(enterdOtp);
    var valid=false;
    var otpdata=$('#otpdata'+formName).val();

    if(otpdata && otpdata.length>0){

        var data=(JSON.parse(otpdata));
        
        var timestamp=new Date(data.timestamp);

        var currentTime=new Date().valueOf();

            timestamp.setMinutes(timestamp.getMinutes() + 5);

        var timestamp = timestamp.valueOf();    
     

            if(timestamp>currentTime){

              if(enterdOtp==data.otp){
                 $('#hide'+formName).hide();
                valid = true;

              } 

              else
                {

                  $('#hide'+formName).show();
                  valid = false;
                
                }

            }else{

              alert('Otp Expired ');

            }
            

    }
    return valid;
    

}


function sendOTP(otpUrl,formName){
    
    var baseurl=document.getElementById("baseurl").value ;

    baseurl=baseurl+otpUrl;

//getting email id from  email field where id must be = #email  

    var email=$('#email'+formName).val(); 

    data=email;

     $.ajax({            
            type:'post',
            url : baseurl,
            data:{
          email:email
            },
            //async:false,
            cache: false,
            success : function(response) {
                        var data=JSON.parse(response) ;
                        //console.log(data);
                        storedata(response,formName);
                        
            }      
    });

}
function storedata(data,formName) {


    /*create <input type="hidden" name="otpdata" id="otpdata"> 
    to store otp value in view page*/
    $('#otpdata'+formName).val(data);

}




