//Base url i.e=>(www.thiotacademy.co/)
var baseurl=document.getElementById("baseurl").value ;

function getCourseModuleListAjax(course_id){

    //alert("i'm working");

    jsonurl=baseurl+'get-courseModuleHours-by-ajax' ;
     $.ajax({            
            type:'post',
            url : jsonurl,
            data: {
                    courselist : course_id 
            },
            success : function(response) {
                        //console.log("Response: "+response) ;
                        if(response!="false"){
                            data =JSON.parse(response);
                            populateData(data);
                        }
                      }      
    });
}

function populateData(duration) {
    console.log(duration);
    $("#duration").val(duration);
    $("#durationHidden").val(duration);


}

