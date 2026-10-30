<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Verify Certificate | Upskill Campus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <style type="text/css">
        .start-divveri{
              
            text-align: center;
            align-items: center;
            margin: auto;
            max-width: 459px;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 35%);
            margin-top: 15%;
            padding-top: 20px;
            padding-bottom: 90px;
        }
        .input__filed-stdv{
            margin-top: 30px;
        }
        .serialinpyt{
            border-radius: 20px;
            max-width: 300px;
            text-align: center;
            margin: auto;
        }
        .btnvalidsate{
             text-align: right;
            float: right;
            font-size: 17px;
            font-weight: 500;
            padding: 5px 16px;
            border-radius: 20px;
            margin-right: 30px;
        }
        .nameemb{
            background: #ececec;
            font-size: 18px;
            padding: 10px 5px;
            text-align: left;
            display: flex;
            padding-left: 20%;
        }
        .firstnamel{
            background: #196ae5;
            color: #fff;
            font-weight: 700;
            font-size: 25px;
            border-radius: 50px;
            padding: 13px 23px;
        }
        .fstppf{
            padding-top: 13px;
            padding-right: 11px;
        }
        .verif-ups-images img{
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="start-divveri">
              <img src="<?=asset_url()?>images/upskill-logo-new.png">
              <h2 class="mt-3">Verify a Certificate</h2>

                <form id="VerifyCertificateForm" method="post" onsubmit="return false">
                <div class="input__filed-stdv">    
                 <input type="text" name="serialno" class="form-control serialinpyt" placeholder="Enter Your Certification Id *">
                 <p></p>
                 <input type="submit" value="Validate" class="btnvalidsate btn btn-outline-success">
                 
                 </div>
             </form> 
        </div>
    </div>
    <!-- modal for data -->
<div class="modal fade" id="getsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div id="getCodedata"></div>
           <div class="text-center pb-4">
               <a href="<?=base_url()?>UpSkill-Campus-verify-certificate">Verify Another Certificate</a>
           </div>
           
      </div>
    </div>
  </div>
</div>
  
    <!-- modal data end -->
    <script src="<?php echo asset_url()?>master-assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">

    function removeTags(str) { 
    if ((str===null) || (str==='')) 
        return false; 
    else
        str = str.toString();  
    return str.replace( /(<([^>]+)>)/ig, ''); 
}     

/*======start certification Form =======*/
$("#VerifyCertificateForm" ).submit(function(e){ 

    const formUrl ='<?=base_url()?>Certificatepdf/verified_member';   
    const formData = new FormData(this);
    $.ajax({            
        type:'post',
        url : formUrl,
        processData: false,
        contentType: false,
        dataType:'json',
        //async:false,
        data: formData,
        success: function (data) {
            if (data.message=="error") {
                alert(removeTags(data.response));
                $("#enqform-overlay").hide();
            }
            else{
            if (data.message=="success") {
            $("#VerifyCertificateForm" )[0].reset();
             $("#getCodedata").html(data.response);
           $("#getsModal").modal('show');
           }
           else{
              $("#VerifyCertificateForm" )[0].reset();
              $("#getCodedata").html(data.response);
              $("#getsModal").modal('show');
                
            }
           }
        }

    });
});



/*======= End certification Form =======*/
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>