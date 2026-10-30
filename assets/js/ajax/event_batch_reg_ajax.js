 function sendOTP(otpUrl){
   
    var baseurl=document.getElementById("baseurl").value ;

    baseurl=baseurl+otpUrl;
    var email=$('#email').val();
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
                        storedata(response);
                        
            }      
    });
}
function storedata(data) {
    
	$('#otpdata').val(data);
}


