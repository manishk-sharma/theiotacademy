var baseurl=document.getElementById("base_url").value ;

function changetypeajax(param){

    var batch_event_type=param.value;
    //alert(batch_event_type);

    jsonurl=baseurl+'get-batch-event-list-by-ajax';

        $.ajax({

            type:'post',

            url :jsonurl,

            data:{

                batch_event_type : batch_event_type
            },
            async: false,

            success:function(response){
                //console.log("Response: "+response) ;
                if(response!="false"){
                    var data = jQuery.parseJSON(response);
                    populateDropdown(data,batch_event_type);
                }
                
            }

        });
}


function populateDropdown(data,batch_event_type) {

var dropdown=document.getElementById('batch_event_id');

    dropdown.innerHTML='';

    for(var i=0; i<data.length; i++){

        var doption= document.createElement('option');

        if(batch_event_type=='event'){

            doption.value=data[i].event_id;
            doption.innerHTML=data[i].event_title;

        }else{

            doption.value=data[i].batch_id;
            doption.innerHTML=data[i].batch_title;
        }
        dropdown.appendChild(doption);
    }
    //console.log(data);


}

