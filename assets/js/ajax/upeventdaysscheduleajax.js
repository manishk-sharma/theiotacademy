/*FOR UPDATE DATE SCHEDULE*/

//Base url i.e=>(www.thiotacademy.co/)
var baseurl=document.getElementById("baseurl").value ;

//Getting Event hidden field================================
var eventData=document.getElementById("eventdata");

function PrintEventList(event_id){
    jsonurl=baseurl+'get-event-data-by-ajax' ;
     $.ajax({            
            type:'post',
            url : jsonurl,
            data: {
                    eventid : event_id 
            },
            success : function(response) {
                        //console.log("Response: "+response) ;
                        if(response!="false"){
                            data =JSON.parse(response);
                            console.log(data);
                            getEventList(data);
                        }
                      }      
    });
}

function getEventList(data) {
  //getDataForUppendDateAndSchdCard(data);
  eventData.value=JSON.stringify(data);
}



//Getting Event Schedule===========================

