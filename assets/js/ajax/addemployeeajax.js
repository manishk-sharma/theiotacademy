function updateDesignation(){
    var usertype=document.getElementById("usertypeid").value ;
    var baseurl=document.getElementById("baseurl").value ;
    baseurl=baseurl+'get-desig-list-by-user-type-ajax' ;
     $.ajax({            
            type:'post',
            url : baseurl,
            data: {
                    usertypeid : usertype
            },
            success : function(response) {
                        console.log("Response: "+response) ;
                        if(response!="false"){
                            var data = jQuery.parseJSON(response);
                            populateDesigDropdown(data) ;
                        }
                      }      
    });
}

function populateDesigDropdown(data){
    var desig=document.getElementById("desigid") ;
    desig.innerHTML=''  ;
    for(var i=0; i<data.length; i++){
        var ditem=data[i] ;
        var doption= document.createElement('option');
        doption.text=ditem.title ;
        doption.value=ditem.desig_id ;
        desig.appendChild(doption);
    }
}