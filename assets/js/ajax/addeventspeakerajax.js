var baseurl=document.getElementById("baseurl").value ;

function updateActiveEventSpeakerList(param,speaker_list,printspname){
    speaker_type=param.value;
    jsonurl=baseurl+'get-active-speaker-list-by-type-ajax' ;
     $.ajax({            
            type:'post',
            url : jsonurl, 
            data: {
                    eventspeakertype : speaker_type
            },
            success : function(response) {
                       //console.log("Response: "+response) ;
                        if(response!="false"){
                            var data = jQuery.parseJSON(response);
                            populateSpeakerDropdown(data,speaker_type,speaker_list,printspname) ;
                        }
                      }      
    }); 
}



function populateSpeakerDropdown(data,s_type,speaker_list,uspeakerid){
    var eventSpeaker=speaker_list ;
    eventSpeaker.innerHTML=''  ;
    for(var i=0; i<data.length; i++){
        var ditem=data[i];
        //console.log(ditem);
        var doption= document.createElement('option'); 
        if(s_type=='guest'||s_type=='Guest'){
            doption.value=ditem.speaker_id;
            //console.log("inside Guest");
            if(doption.value==uspeakerid){
                doption.selected="selected" ;
            }
        }
        else{
            //console.log("inside Employee");
            doption.value=ditem.emp_id ;  
            if(doption.value==uspeakerid){
                doption.selected="selected" ;
            }
        }
        var fullname=ditem.first_name+" "+ditem.last_name;
        doption.text=fullname;
        eventSpeaker.appendChild(doption);
    }
}
