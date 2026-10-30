var baseurl=document.getElementById("baseurl").value ;
// FOR DATES DROPDOWN===============
function updateEventDaysList(event_id,days_dropdown){
    jsonurl=baseurl+'get-event-date-data-by-event-ajax' ;
     $.ajax({            
            type:'post',
            url : jsonurl,
            data: {
                    eventid : event_id 
            },
            success : function(response) {
                        //console.log("Response: "+response) ;
                        if(response!="false"){
                            var data = JSON.parse(response);//jQuery.parseJSON(response)
                            //console.log(data);
                            populateDaysDropdown(data,days_dropdown) ;
                        }
                      }      
    });
}

function populateDaysDropdown(data,days_dropdown){
    var daysId=days_dropdown ;
    daysId.innerHTML=''  ;
    for(var i=0; i<data.length; i++){
        var ditem=data[i];
        var doption= document.createElement('option'); 
        doption.value=ditem.day_id ;
        doption.text=ditem.day_date;
        daysId.appendChild(doption);
    }
}


