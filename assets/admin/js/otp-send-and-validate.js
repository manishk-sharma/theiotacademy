$(function(){

  $.cookie('test_status','null');

});  



function validateOTP(param){

    //alert(true);
    var otpdata=$('#otpdata').val();

    var data=(JSON.parse(otpdata));
    
    var timestamp=new Date(data.timestamp);

    var currentTime=new Date().valueOf();

        timestamp.setMinutes(timestamp.getMinutes() + 5);

    var timestamp = timestamp.valueOf();    
 

        if(timestamp>currentTime){


          if(param.value==data.otp){
      
            $('#hide').addClass('hide');
            return true;

          } 

          else
            {

              $('#hide').removeClass('hide');
              return false;
            
            }

        }else{

          alert('Otp Expired ');
          return false

        }
        

}
