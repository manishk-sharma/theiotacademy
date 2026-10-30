function updateCourseFee(){
    var course=document.getElementById("courseid").value ;
    var coursefee=document.getElementById("coursefee") ;
    var baseurl=document.getElementById("baseurl").value ;
    baseurl=baseurl+'get-course-fee-ajax' ;
     $.ajax({            
            type:'post',
            url : baseurl,
            data: {
                    courseid : course
            },
            success : function(response) {
                        console.log("Response: "+response) ;
                        var data = jQuery.parseJSON(response);
                        var courseFeeAmount=parseInt(data.course_fee) ;
                        if(courseFeeAmount!=0){
                            coursefee.value=courseFeeAmount ;
                            updateTotalFee();
                            console.log("Course Fee: "+courseFeeAmount);
                        }else{
                            window.alert("Unable To Fetch Course Fee Amount.");
                        }
                        
            }      
    });
}