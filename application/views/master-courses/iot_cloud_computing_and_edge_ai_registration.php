<!DOCTYPE html>
  <html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>Application form - Online Certification in IoT Cloud Computing and Edge AI By E&ICT Academy, IIT Guwahati</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon"
            href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png"
            type="image/png" />
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>master-assets/css/ml-registration-form.css">
    <link rel="stylesheet" href="<?php echo asset_url()?>master-assets/css/style2.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo asset_url()?>css/style.min.css"> -->
  </head>

  <body>
  <div class="ml-main-dv">
      <div class="logo-image-dv">
          <a href="<?=base_url()?>"><img class="logo-image-size" src="<?=asset_url()?>images/theiotacademy-logo.svg" alt="logo"></a>
      </div>
      <div class="container">
          <div class="ml-application-start-dv">
             <!-- ajax loader -->
              <div class="loaderofform overlayhide"  id="enqform-overlay">
                  <!-- <img class="ajaxloaderimage overlayhide" src="<?=asset_url()?>images/master-course-image/form-ajax-loader.gif" id="enqform-overlay"> -->
              </div>
             <!-- end ajax loader -->
              <div class="row">
         <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 order-1 order-lg-2">
                      <div class="application-detail-dv">
                          <section class="fact-card">
                              <p class="title-of-course">Online Certification in IoT Cloud Computing and Edge AI By E&ICT Academy, IIT Guwahati</p>
                              <h6>Application Deadline: <strong style="font-weight:600;color: #196ae5;"><?php $this->load->view("course-deadline-date/iot_cloud_computing_and_edge_ai_iitg_deadline")?></strong></h6>
                              <h6>Eligibility Criteria</h6>
                              <p>Bachelor's degree with a minimum of 50% aggregate marks or equivalent.</p>
                              <h6>Contact Us</h6>
                              <p>Contact Us at <a href="tel:+91-9354068856">+91-9354068856</a> or mail
                              at <a href="mailto:eictiitg.admissions@theiotacademy.co">eictiitg.admissions@theiotacademy.co</a> in case of any
                              queries.</p>
                          </section>
                        </div>  
                 </div>
                 <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 order-2 order-lg-1">
                        <div class="ml-appli-form-heading">Application Form</div>
                         <span class="disphide text-center text-success" id="SuccessAlert"></span>
                          <span class="disphide text-center text-danger"  id="ErrorAlert"></span>
                        <div class="app-form-start-dv">
                          <form method="post" id="SubmitMlRegistrationForm" enctype="multipart/form-data" onsubmit="return false">
                               <input type="hidden" name="url_ml_iot_name" value="">
                               <input type="hidden" name="came_from_course" value="IoT Cloud Computing and Edge AI By IIT Guwahati">
                              <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter Your Name">
                              </div>
                              <div class="form-group">
                                <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Enter Your Mobile Number">
                              </div>
                              <div class="form-group">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address">
                              </div>
                              <div class="form-group">
                                <select name="degree" id="degree" class="form-control">
                                      <option>---Select Degree---</option>
                                      <option value="B.E./B.Tech.">B.E./B.Tech.</option>
                                      <option value="B.Com/B.Com-Hons." >B.Com./B.Com.(Hons.)</option>
                                      <option value="B.Sc/B.Sc-Hons." >B.Sc./B.Sc.(Hons.)</option>
                                      <option value="B.C.A./B.C.A-Hons" >B.C.A./B.C.A.(Hons.)</option>
                                      <option value="B.A./B.A-Hons." >B.A./B.A.(Hons.)</option>
                                      <option value="BBA/BBM/BMS" >BBA/BBM/BMS</option>
                                      <option value="B.Pharma" >B.Pharma</option>
                                      <option value="Other" >Other</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <input type="text" name="university" class="form-control" id="university" placeholder="Enter College / University Name">
                              </div>
                              <div class="form-group">
                                <select name="experience" class="form-control" id="experience">
                                       <option>---Select Work Experience---</option>
                                       <option value="college student">College Student</option>
                                       <option value="0-3 years">0-3 Years</option>
                                       <option value="3-5 years">3-5 Years</option>
                                       <option value="5-10 years">5-10 Years</option>
                                       <option value="10-15 years">10-15 Years</option>
                                       <option value="more than 15 years">More Than 15 Years</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <select name="industry" class="form-control" id="industry">
                                      <option>---Select Industry---</option>
                                      <option value="Automobile" >Automobile</option>
                                      <option value="Consulting" >Consulting</option>
                                      <option value="Education" >Education</option>
                                      <option value="Energy" >Energy</option>
                                      <option value="HR" >HR</option>
                                      <option value="IT & Technology">IT &amp; Technology</option>
                                      <option value="Manufacturing" >Manufacturing</option>
                                      <option value="Pharma" >Pharma/Healthcare</option>
                                      <option value="Research" >Research</option>
                                      <option value="Retail" >Retail</option>
                                      <option value="Telecom" >Telecom</option>
                                      <option value="Design" >Design</option>
                                      <option value="Others" >Others</option>
                                </select>
                              </div>
                              <div class="form-group">
                                 <div class="statement-start-dv">
                                    <h4>Statement of Purpose</h4>
                                    <p>Help the admissions committee to evaluate your cantididature. Please answer the following question.</p>
                                </div>
                                <label for="exampleInputstatement">Why do you want to learn IoT Cloud Computing and Edge AI By E&ICT Academy, IIT Guwahati? (Optional)</label>
                                <textarea name="statement" class="form-control" id="statement" style="resize: none; height:120px;" placeholder="Writing a statement of purpose and increase your chances of selection to the course (maximum 5000 characters)"></textarea>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputupload">Upload Resume / CV (only pdf, doc and docx having max size 2MB)</label>
                                <input type="file" name="resume" class="form-control" id="uploadfile">
                              </div>
                              <div class="form-group form-check">
                                <input type="checkbox" name="checkbox" class="form-check-input" id="Checkbox">
                                <label class="form-check-label" for="exampleCheck1">I hereby declare all the information provided is true to my knowledge.</label>
                              </div>
                              <div class="text-center application-btn-dv">
                                  <button type="submit" class="btn btn-primary">Submit Application</button>
                              </div>
                          </form>
                        </div> 
                 </div>
              </div> 
          </div>
      </div>
   </div>
  <?php $this->load->view("commons/footer.php")?>

<script src="<?php echo asset_url()?>js/jquery.min.js"></script>
 <script type="text/javascript">
/*===========start datascience  form submit=================*/
    $("#SubmitMlRegistrationForm").submit(function (e) {

      $("input[name='url_ml_iot_name']").val($(location).attr('href'));

      const formUrl = '<?=base_url()?>IoTCloudComputingandEdgeAIregistration/iot_cloud_computing_and_edge_ai_registration_submit_form';
      const formData = new FormData(this);
      $.ajax({
        type: 'post',
        url: formUrl,
        processData: false,
        contentType: false,
        //async:false,
        data: formData,
        beforeSend: function () {
          $("#enqform-overlay").removeClass('overlayhide');
          $("#enqform-overlay").addClass('overlayshow');
        },

        success: function (data) {
          $("#enqform-overlay").removeClass('overlayshow');
          $("#enqform-overlay").addClass('overlayhide');
          $("#SubmitMlRegistrationForm")[0].reset();//Reset The Form
          $("#SuccessAlert").html(data.response);
          //alert(data.response);
          //alert("Your Application Requested Successfully.");
          $("#SuccessAlert").removeClass("disphide");
          $("#SuccessAlert").addClass("dispshow");
          $("#SuccessAlert").fadeIn();
          $("#SuccessAlert").fadeOut(15000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $("#enqform-overlay").removeClass('overlayshow');
          $("#enqform-overlay").addClass('overlayhide');
          var responseData = jqXHR.responseJSON;
          if (responseData.statusCode == 501) {
            $("#ErrorAlert").html(responseData.response);
            $("#ErrorAlert").removeClass("disphide");
            $("#ErrorAlert").addClass("dispshow");
            $("#ErrorAlert").fadeIn();
            $("#ErrorAlert").fadeOut(10000);
          } else {
            var htmlString= jqXHR.responseJSON.response;

            var stripedHtml = htmlString.replace(/<[^>]+>/g, '');

            //console.log(stripedHtml);
            alert(stripedHtml);
           
          }

        }
      });
    })

    /*=========== end ml with iot submit=================*/


  </script>

  </body>
  </html>
