function updateAmount(){
    var reg=document.getElementById("regid").value ;
    var feeamount=document.getElementById("feeamount") ;
    var totalfee=document.getElementById("totalfee") ;
    var paidfee=document.getElementById("paidfee") ;
    var balancefee=document.getElementById("balancefee") ;
    var baseurl=document.getElementById("baseurl").value ;
    baseurl=baseurl+'get-balance-fee-by-reg-id-ajax' ;
     $.ajax({            
            type:'post',
            url : baseurl,
            data: {
                    regid : reg
            },
            success : function(response) {
                        console.log("Response: "+response) ;
                        var data = jQuery.parseJSON(response);
                        var balanceFeeAmount=parseInt(data.balance_fee) ;
                        if(balanceFeeAmount!=0){
                            feeamount.value=balanceFeeAmount ;
                            totalfee.value=parseInt(data.total_fee) ;
                            paidfee.value=parseInt(data.paid_fee) ;
                            balancefee.value=balanceFeeAmount ;
                            console.log("Balance Fee Amount: "+balanceFeeAmount);
                        }else{
                            window.alert("Unable To Fetch Balance Fee Amount.");
                        }
                        
            }      
    });
}