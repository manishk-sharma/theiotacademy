<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Download Offer Letter | Upskill Campus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.upskillcampus.com/assets/img/upskill-campus-fav-icon.png">
    <style type="text/css">
        .start-divveri{
              
            text-align: center;
            align-items: center;
            margin: auto;
            max-width: 1050px;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 35%);
            margin-top: 5%;
            padding-top: 20px;
            padding-bottom: 10%;
        }
        .upskilcmp_logo_img{
            width: 200px;
        }
        .input__filed-stdv{
            margin-top: 30px;
        }
        .input__filed-do-int{
           height: 56px !important;
        }
        .dwnload-frm-up-dv{
            padding: 0 20%;
        }
        .serialinpyt{
            border-radius: 20px;
            max-width: 300px;
            text-align: center;
            margin: auto;
        }
        .btndownloadoffrl{

            font-size: 17px;
            font-weight: 500;
            padding: 10px 7%;
            color: #fff;
           background: rgb(9,9,121);
            border-radius: 10px;
            transition: all 0.8s;
        }
        .btndownloadoffrl:hover{
            color: rgb(9,9,121);
            background: #fff;
            border-radius: 2px solid rgb(9,9,121);
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
              <img class="upskilcmp_logo_img" src="<?=asset_url()?>images/upskill-logo-new.png">
              <h3 class="mt-3">Please Download Your Offer Letter</h3>
                <div class="dwnload-frm-up-dv">
                <form id="Downloadofferletterups" method="post" onsubmit="return false">
                <div class="input__filed-stdv"> 
                <div class="form-group">
                 <input type="text" name="name" class="form-control input__filed-do-int" placeholder="Enter Your Name*">
                </div> 
                <div class="form-group">
                 <input type="email" name="email" class="form-control input__filed-do-int" placeholder="Enter Your Email*">
                </div>   
                <div class="form-group">
                  <select class="form-control input__filed-do-int" name="domain">
                      <option value="" disabled selected>Select Your Domain (Course Name)*</option>
                      <option value="5G">5G</option>
                      <option value="App Development">App Development</option>
                      <option value="Artificial Intelligence">Artificial Intelligence</option>
                      <option value="Business Analytic">Business Analytic</option>
                      <option value="Data Science">Data Science</option>
                      <option value="Digital Marketing">Digital marketing</option>
                       <option value="Data Science & Machine Learning,DS & ML,Data Science and Machine Learning,DS and ML">Data Science and Machine Learning</option>
                      <option value="Embedded system,Embedded systems">Embedded System</option>
                      <option value="Embedded and IOT,Embedded System and IoT">Embedded and IOT</option>
                      <option value="Electric Vehicle">Electric Vehicle</option>
                      <option value="Full Stack Developer,Full Stack Development">Full Stack Development</option>
                      <option value="Industry4.0">Industry4.0</option>
                      <option value="IOT, Internet Of Things">IoT</option>
                      <option value="Core Java,Java">Java</option>
                      <option value="Machine Learning">Machine Learning</option>
                      <option value="Python">Python</option>
                     
                     </select>
                </div>   
                 <p></p>
                 <input type="submit" value="Download Offer Letter" class="btndownloadoffrl">
                 
                 </div>
             </form> 
             </div>
        </div>
    </div>
    <!-- modal for data -->
<div class="modal fade" id="getsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <table width="100%" class="table table-bordered" id="idtabledetailss">
               <thead>
                  <tr>
                   <th width="20%" class="text-center">Name</th>
                   <th width="25%" class="text-center">Email</th>
                   <th width="28%" class="text-center">Doamin</th>
                   <th width="27%" class="text-center">Download</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                       <td id="oferrnameid" class="text-center"></td>
                       <td id="oferremailid" class="text-center"></td>
                       <td id="oferrdoamainid" class="text-center"></td>
                       <td id="oferrdownloadbtnid" class="text-center"></td>
                   </tr>
               </tbody>
           </table>
           <div id="getCodedata" class="text-center"></div>
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
$("#Downloadofferletterups" ).submit(function(e){ 

    const formUrl ='<?=base_url()?>Offerletterspdf/Downloaduserofferlt';   
    const formData = new FormData(this);
    console.log(new FormData(this));
    $.ajax({            
        type:'post',
        url : formUrl,
        processData: false,
        contentType: false,
        dataType: 'json',
        //async:false,
        data: formData,
        success: function (data) {
            if (data.message=="error") {
                alert(removeTags(data.response));
            }
            else{
                $("#Downloadofferletterups" )[0].reset();
                if (data.response[0].name && data.response[0].email){
                    $("#idtabledetailss").show();
                   $("#oferrnameid").html(data.response[0].name);
                   $("#oferremailid").html(data.response[0].email);
                   $("#oferrdoamainid").html(data.response[0].domain);
                   $("#oferrdownloadbtnid").html("<a class='btn btn-primary'  href='https://www.theiotacademy.co/Offerletterspdf/downloadpdfdetails/"+data.response[0].id+"'>download offer</a>");
                   $("#getsModal").modal('show');
                   $("#getCodedata").html('');
                }
                else{
                    console.log(data.response);
                     $("#idtabledetailss").hide();
                     $("#getCodedata").html(data.response);
                    $("#getsModal").modal('show');
                }
            }
        }
    });
})



/*======= End certification Form =======*/
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>