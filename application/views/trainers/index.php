<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Instructor Rrgistration Form</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/css/style.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/css/styletable.css">
        <link rel="stylesheet" href="<?php echo asset_url()?>instructor_assets/css/media-queries.css">

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo asset_url()?>instructor_assets/ico/favicon.ico">


        <!-- for profile picture -->

        <script type="text/javascript">

          function PreviewImage(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#uploadPreview').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }

        </script>
        <style type="text/css">
              .help-block{

                color:#f38684!important; 
              }

              input.form-control.exp-input {
              width: 145px;
          }

        </style>
      
    </head>

    <body>
    
<div class="description-container">
    <div class="container">
      <div class="row">
          <div class="col-sm-12 description-title">
              <h2>Instructor Registration Form</h2>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 description-text">
              <p>
                This is a complete registration form for the teachers who wants to join  <a href="https://theiotacademy.co/"><strong>IOT ACADEMY</strong></a> as an instructor
              </p>
              
          </div>
      </div>
  </div>
</div>
    
    <!-- Multi Step Form -->
<div class="msf-container">

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li class="active"><button data-toggle="tab" href="#home">Home</button></li>
              <li><button data-toggle="tab" href="#menu2">Menu 2</button></li>
              <li><button data-toggle="tab" href="#menu3">Menu 3</button></li>
              <li><button data-toggle="tab" href="#menu4">Menu 4</button></li>
              <li><button data-toggle="tab" href="#menu5">Menu 5</button></li>
              <li><button data-toggle="tab" href="#menu6">Menu 6</button></li>
              <li><button data-toggle="tab" href="#menu7">Menu 7</button></li>
              <li><button data-toggle="tab" href="#menu8">Menu 8</button></li>
              <li><button data-toggle="tab" href="#menu9">Menu 9</button></li>
            </ul>
        </div>
      </div>
         

        <div class="tab-content">

            <div class="imgcontainer">
                <center>
                    <img id="uploadPreview" src="<?php echo asset_url()?>instructor_assets/imgs/avatar.png" alt="Avatar" class="avatar" height="150" width="90">

                    <input type="file" id="imglink" accept="image/*" Name="imglink" onchange="PreviewImage(this);"  required="required" />
                    <br>
                    <label for="profile-picture">Upload your Profile Photo: Require size (500 X 300)</label><br><br>  
                </center>
            </div>

<!-- =====Tab 1======= -->  

            <div id="home" class="tab-pane fade in active">
            
                <div class="form-container" style="padding:40px;">
                     <form id="introduction_form" action="#"  method="post" enctype="multipart/form-data">

                      <input type="hidden" name="trainer_id" id="trainer_id"  class="trainer_id" value='0'>

                        <h4>Introduction <span class="step">(Step 1 / 8)</span></h4><br>
                        <input type="file"  accept="image/*" Name="picture"   required="required" />
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="first-name">First Name:</label><br>
                                
                                    <input type="text" name="first_name" required class="first-name form-control table-text1" id="name"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="last-name">Last Name:</label><br>
                                    <input type="text" name="last_name" class="last-name form-control table-text1" id="last_name"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                  <label for="DOB">D.O.B (DD-MM-YYYY) :</label>
                                  <input class="form-control" type="text" id="datepicker" name="birth_date"  required="required"/></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                              <div class="form-group">
                              
                                <div class="radio-buttons-1">

                                    <p>Gender (Male/Female/Others) :</p>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="1" checked='checked'> Male
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="2"> Female
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="3"> Others
                                    </label>
                              
                                </div>

                              </div>
                               <div class="col-sm-2"></div>
                          </div>

                        </div>
                        <div class="row mb-2 ">
                          <div class="col-sm-3"></div>
                            <div class="col-sm-6 p-4">
                                <div class="checkboxes-1">
                                    <p>Subjects willing to teach:</p>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="1" checked='checked'> Java
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="2"> Web Development
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="3"> IOT
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="4"> Python
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 mt-4">
                              <br>
                                <button type="submit" class="btn btn-next" >Save & Next <i class="fa fa-angle-right" ></i></button>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                  </form>
                </div>
            </div>

<!-- =====Tab 2======= -->

            <div id="menu2" class="tab-pane fade">
                <div class="form-container" style="padding-left:40px; padding-right:40px;">
                     <form id="address_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <h4>Communicational Details <span class="step">(Step 2 / 8)</span></h4>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address">Address:</label><br>
                                   <input type="hidden" name="trainer_id"  class="trainer_id" value='0'>
                                    <input type="hidden" name="communation_id" id="communation_id"  class="communation_id" value='0'>
                                    <input type="text" name="address" class="address form-control table-text1" id="address"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address-city">City:</label><br>
                                    <input type="text" name="address_city" class="address-city form-control table-text1" id="address_city"  required="required">
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address-state">State / Province:</label><br>
                                    <input type="text" name="address_state" class="address-state form-control table-text1" id="address_state"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address-country">Country:</label><br>
                                    <input type="text" name="address_country" class="address-country form-control table-text1" id="address_country"  required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address-postal-code">Postal Code:</label><br>
                                    <input type="text" name="address_postal_code" class="address-postal-code form-control table-text1" id="address_postal_code"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="telephone">Telephone:</label><br>
                                    <input type="text" name="telephone" class="telephone form-control table-text1" id="telephone"  required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile-phone">Mobile Phone:</label><br>
                                    <input type="telephone" name="mobile_phone" class="mobile-phone form-control table-text1" id="mobile_phone"  required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Alternate Email:</label><br>
                                    <input type="email" name="email" class="email form-control table-text1" id="email"  required="required">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4 mt-4">
                              <br>
                              <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                              <button type="submit" class="btn btn-next">Save & Next <i class="fa fa-angle-right"></i></button>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                  </form>
                </div>
            </div>

<!-- =====Tab 3======= -->  
                          
            <div id="menu3" class="tab-pane fade">
                  <div class="form-container">
                    <form id="educational_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="container cust_container table-responsive">
                          <h4>Education Details <span class="step">(Step 3 / 8)</span></h4>
                              <div class="table-wrapper">
                                  <div class="table-title">
                                      <div class="row">
                                          <div class="col-sm-8"><h2> <b></b></h2></div>
                                          <div class="col-sm-4">
                                              <button type="button" class="btn btn-info add-new edu-btn"><i class="fa fa-plus"></i> Add New</button>
                                          </div>
                                      </div>
                                  </div>
                                  <table class="table edu-table table-bordered">
                                      <thead>
                                          <tr>
                                              <th class="text-center">Board/Univercity</th>
                                              <th class="text-center">school/college</th>
                                              <th class="text-center">passing year</th>
                                              <th class="text-center">Upload Documents</th>
                                              <th class="text-center">Actions</th>
                                          </tr>
                                      </thead>

                                      <tbody>
                                        <input type="hidden" name="min-row"  class="min-row" id="edu-min-row">
                                        <input type="hidden" name="count-row"  class="count-row" id="edu-count-row">

                                      </tbody>
                                  </table>
                              </div>
                        </div>   
                        <br>
                        <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                         <button type="submit"  name="Save & Next" class="btn btn-next submit-btn">Save & Next <i class="fa fa-angle-right"></i>
                         </button>
                    </form>
                  </div>
            </div>

<!-- =====Tab 4======= -->  

            <div id="menu4" class="tab-pane fade">
                <div class="form-container">
                    <form id="certification_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                       <h4>Certification Details <span class="step">(Step 4 / 8)</span></h4>
                          <div class="container table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-8"><h2>Certifications:</h2></div>
                                        <div class="col-sm-4">

                                            <button type="button" class="btn btn-info add-new certf-btn"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="certf-table table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Course</th>
                                            <th class="text-center">Institution</th>
                                            <th class="text-center">Course Duration</th>
                                            <th class="text-center">Document Upload</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                      <input type="hidden" name="count-row"  class="count-row" id="certf-count-row">

                                      <input type="hidden" name="min-row"  class="min-row" id="certf-min-row">

                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="form-group row">
                          <div class="col-sm-12">
                                <label for="social-pinterest">Your Linkdn Handle :</label><br>
                                <div class="row">
                                  <div class="col-sm-4"></div>
                                  <div class="col-sm-4">
                                    <div>
                                        <input type="text" name="social_linkedin" class="social-linkdn form-control table-text1" id="social_linkedin"  required="required">
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                                
                          </div>                     
                        </div>
                              
                            <br>
                            <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                            <button type="submit" name="Save & Next" class="btn btn-next"> <i class="fa fa-angle-right"></i> Save & Next</button>
                    </form>
                </div>
            </div>

<!-- =====Tab 5======= -->  
            <div id="menu5" class="tab-pane fade">
                  <form id="experience_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                      <h4>Experience Details <span class="step">(Step 5 / 8)</span></h4>
                      <div class="container cust_container table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-8"><h2> <b></b></h2></div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-info add-new exp-btn"><i class="fa fa-plus"></i> Add New</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="exp-table table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Company Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End date</th>
                                            <th class="text-center">File Upload</th>
                                            <th class="text-center">Actions</th>
                                                                </tr>
                                    </thead>

                                    <tbody>
                                      <input type="hidden" name="count-row"  class="count-row" id="exp-count-row">
                                      
                                      <input type="hidden" name="min-row"  class="min-row" id="exp-min-row">
                                              
                                    </tbody>
                                </table>
                            </div>
                      </div>   
                      <br>
                      <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                      <button type="submit" class="btn btn-next">Save & Next <i class="fa fa-angle-right"></i>
                      </button>
                  </form>
            </div>

<!-- =====Tab 6======= -->  

            <div id="menu6" class="tab-pane fade">
                  <form id="aboutYou_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                      <h4>About You <span class="step">(Step 6 / 8)</span></h4>
                      <div class="row">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="about-you">Tell us a bit about yourself (min 500 words):</label><br>
                                  <input type="hidden" name="aboutYou_id" id="aboutYou_id"  class="aboutYou_id" value='0'>
                                  <textarea name="about_you" class="about-you form-control" id="about_you" minlength="100"  required="required" cols="10" rows="8"></textarea>
                              </div>
                          </div>
                          <div class="col-sm-3"></div>
                      </div>
                      
                      <br>
                      <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                      <button type="submit" class="btn btn-next">Save & Next <i class="fa fa-angle-right"></i></button>
                  </form>
            </div>

<!-- =====Tab 7======= -->  
            <div id="menu7" class="tab-pane fade">
                  <form id="whyJoin_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                      <h4>Why Student Want To Join <span class="step">(Step 7 / 8)</span></h4>
                      <div class="row">
                          <div class="col-sm-3"></div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="why-join">Tell us why should student connect to you for learning:</label><br>
                              <input type="hidden" name="why_you_join_id" id="why_you_join_id"  class="why_you_join_id" value='0'>
                                  <textarea name="why_join" cols="10" rows="9" class=" form-control"  required="required" minlength="100"></textarea>
                              </div>
                          </div>
                          <div class="col-sm-3"></div>
                      </div>
                      <br>
                      <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                      <button type="submit" class="btn btn-next">Save & Next <i class="fa fa-angle-right"></i></button>
                  </form>
            </div>

<!-- =====Tab 8======= -->  
            <div id="menu8" class="tab-pane fade" style="padding:40px;">
                  <form id="bankDetails_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                      <h4>Bank Details<p>This is required to transfer your salary</p> <span class="step">(Step 8 / 8)</span></h4>
                      <div class="row p-4">
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label for="bank-name">Bank Name:</label><br>
                                 <input type="hidden" name="bank_id" id="bank_id"  class="bank_id" value='0'>
                                <input type="text" name="bank_name" class="bank-name form-control" id="bank_name"  required="required">
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="branch">Branch :</label><br>
                                  <input type="text" name="branch" class="branch form-control" id="branch"  required="required">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="account-number">Account Number :</label><br>
                               <input type="text" name="account_number" class="account-number form-control" id="account_number"  required="required">
                              </div> 
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                  <label for="ifsc-code">IFSC Code :</label><br>
                                  <input type="text" name="ifsc_code" class="ifsc-code form-control" id="ifsc_code"  required="required">
                              </div> 
                          </div>
                      </div>
                        
                    
                      <br>
                      <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
                      <button type="submit" class="btn btn-next">Save & Next <i class="fa fa-angle-right"></i></button>
                  </form>
            </div>

        </div>
    </div>
</div>
    
<input type="hidden" name="bases_url" id="bases_url" value="<?php echo base_url()?>">

<input type="hidden" name="assets_url" id="assets_url" value="<?php echo asset_url()?>">
        <!-- Javascript -->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
  
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
    
        <script src="<?php echo asset_url()?>instructor_assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo asset_url()?>instructor_assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo asset_url()?>instructor_assets/js/scripts.js"></script>
        <script src="<?php echo asset_url()?>instructor_assets/js/scriptstable.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="<?php echo asset_url();?>js/ajax/saveTrainerAjax.js"></script>

  <!-- .....date picker.... -->
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
    $(function() {


      $( "#datepicker" ).datepicker();
      $("#datepicker").datepicker("setDate",new Date());
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy");
    


    function getFile(filePath) {
        return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
    }

// =====Tab 1======= -->  
    $( "#introduction_form" ).submit(function(e) {

      var form = $("#introduction_form");

                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                    },
                    rules: {
                        name: {
                            required: true,

                        },
                        last_name : {
                            required: true,
                        },                        

                    },
                    messages: {
                        name: {
                            required: "Name required",
                        },
                        last_name : {
                          required: "Last Name required",
                        },                        
                    }

                });

          if (form.valid() === true){

              var valid=false;

              e.preventDefault();

              var trainer_id=$('#trainer_id').val();

              if(parseInt(trainer_id)>0){

                formUrl='TrainerDetails/update_trainer';
              }
              else{
                formUrl='TrainerDetails/insert_trainer';
              }

            //  formUrl='TrainerDetails/insert_trainer';

              valid= (this,formUrl);

              if(valid){
 
                $('[href="#menu2"]').tab('show');
              }

          }else{

              // alert(false);
          }

    });


// =====Form  1======= -->  
    $( "#address_form" ).submit(function(e) {

      var form = $("#address_form");

                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                    },
                    rules: {
                        address_city: {
                            required: true,

                        },
                        address_state : {
                            required: true,
                        },                        

                    },
                    messages: {
                        address_city: {
                            required: "City Name is required",
                        },
                        address_state : {
                          required: "State Name required",
                        },                        
                    }

                });

          if (form.valid() === true){

              var valid=false;

              e.preventDefault();


            var communation_id= $('#communation_id').val();

              if(parseInt(communation_id)>0){
          

                formUrl='TrainerAddress/editTrainerAddress';
              }
              else{
                formUrl='TrainerAddress/insert_trainerAddress';
              }

              //formUrl='TrainerDetails/insert_trainer';

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu3"]').tab('show');
              }

          }else{

              // alert(false);
          }
     
 

    });


//===
 $( "#aboutYou_form" ).submit(function(e) {

      var form = $("#aboutYou_form");

                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                    },
                    rules: {
                        about_you: {
                            required: true,

                        },
                                        

                    },
                    messages: {
                        about_you: {
                            required: "Required",
                        },
                                               
                    }

                });

          if (form.valid() === true){

              var valid=false;

              e.preventDefault();


            var aboutYou_id= $('#aboutYou_id').val();

              if(parseInt(aboutYou_id)>0){
          

                formUrl='TrainerAboutYou/editTrainerAboutYou';
              }
              else{
                formUrl='TrainerAboutYou/insert_trainerAboutYou';
              }

              //formUrl='TrainerDetails/insert_trainer';

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu3"]').tab('show');
              }

          }else{

              // alert(false);
          }
     
 

    });

$( "#whyJoin_form" ).submit(function(e) {

      var form = $("#whyJoin_form");

                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                    },
                    rules: {
                        why_join: {
                            required: true,

                        },
                                        

                    },
                    messages: {
                        why_join: {
                            required: "Required",
                        },
                                               
                    }

                });

          if (form.valid() === true){

              var valid=false;

              e.preventDefault();


            var why_you_join_id= $('#why_you_join_id').val();

              if(parseInt(why_you_join_id)>0){
          

                formUrl='TrainerWhyJoin/editTrainerWhyJoin';
              }
              else{
                formUrl='TrainerWhyJoin/insert_why_join';
              }

              //formUrl='TrainerDetails/insert_trainer';

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu3"]').tab('show');
              }

          }else{

              // alert(false);
          }
     
 

    });

$( "#bankDetails_form" ).submit(function(e) {

      var form = $("#bankDetails_form");

                form.validate({
                    errorElement: 'span',
                    errorClass: 'help-block',
                    highlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').addClass("has-error");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).closest('.form-group').removeClass("has-error");
                    },
                    rules: {
                        bank_name: {
                            required: true,

                        },
                         branch: {
                            required: true,

                        },
                         account_number: {
                            required: true,

                        },
                         ifsc_code: {
                            required: true,

                        },
                                        

                    },
                    messages: {
                        bank_name: {
                            required: "Required",
                        },
                         branch: {
                            required: "Required",
                        },
                         account_number: {
                            required: "Required",
                        },
                         ifsc_code: {
                            required: "Required",
                        },
                                               
                    }

                });

          if (form.valid() === true){

              var valid=false;

              e.preventDefault();


            var bank_id= $('#bank_id').val();

              if(parseInt(bank_id)>0){
          

                formUrl='TrainerAccount/updateAccount';
              }
              else{
                formUrl='TrainerAccount/insert_account';
              }

              //formUrl='TrainerDetails/insert_trainer';

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu3"]').tab('show');
              }

          }else{

              // alert(false);
          }
     
 

    });


var valid=false;

function callAjax(form, formUrl){
  
  $.ajax({            
            type:'post',
            url : formUrl,
            processData: false,
            contentType: false,
            async:false,
             // dataType: "json",
            data: new FormData(form),
            success: function (data) {

                  valid = true;
                  setValueToHiddField(data);
              },
              error: function (data) {
                  console.log('An error occurred.');
              }     
    });

  return valid;
}


function setValueToHiddField(data) {

    var mydata=JSON.parse(data);

    $('#'+mydata.key).val(mydata.value);

}   



</script>
        <!-- ......end date picker.... -->
  
            
        

    </body>

</html>
