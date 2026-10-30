<?php  
if($this->session->userdata("logged_in")){

$user_id=$this->session->userdata("user_id");

$detailesData=$this->TrainerDetailsModel->getTrainerByUserId($user_id);

  if(count($detailesData)>0){ 
    
    $detailesData=$detailesData[0];
    
    $first_name=$detailesData['first_name'];

    $last_name=$detailesData['last_name'];

    $birth_date=$detailesData['birth_date'];

    $gender=$detailesData['gender'];

    $trainer_id=$detailesData['trainer_id'];

    $course_id=$detailesData['course_id'];

    $photo=$detailesData['photo'];

  }

$addressData=$this->TrainerAddressModel->getTrainerAddressByUserId($user_id);

  if(count($addressData)>0){
  print_r($addressData);
  $addressData=$addressData[0];
  $communication_id=$addressData['communication_id'];
  $address=$addressData['address'];
  $city=$addressData['city'];
  $state=$addressData['state'];
  $country=$addressData['country'];
  $postal_code=$addressData['postal_code'];
  $communication_id=$addressData['communication_id'];
  $communication_id=$addressData['communication_id'];
  $communication_id=$addressData['communication_id'];
  }
  
?>
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


          .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{

            color:white;
            cursor: default;
            background-color: #ed3236;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
          }

          .disabled{
            background: darkgray;
            color:red;
          }
          .disabled:hover{
            cursor:not-allowed !important;
          }

/*==============Loader CSS=================*/
          .loader-modal {
              display:    none;
              position:   fixed;
              z-index:    1000;
              top:        0;
              left:       0;
              height:     100%;
              width:      100%;
              background: rgba( 255, 255, 255, .8) 
                          url('http://sampsonresume.com/labs/pIkfp.gif') 
                          50% 50% 
                          no-repeat;
          }

          /* When the body has the loading class, we turn
             the scrollbar off with overflow:hidden */
          body.loading {
              overflow: hidden;   
          }

          /* Anytime the body has the loading class, our
             modal element will be visible */
          body.loading .loader-modal {
              display: block;
          }

          .nav-tabs li a{
            font-weight: 600;
          }


        </style>
      
    </head>

    <body>
 
 <div class="loader-modal"> </div>

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
  <div class="imgcontainer">
      <center>
        <?php if(isset($photo)){ ?>
          <img id="uploadPreview" src="<?php echo trainer_url()?>profilepic/<?=$photo?>" alt="Avatar" class="avatar" height="250" width="250">
        <?php } else{ ?>
          <img id="uploadPreview" src="<?php echo asset_url()?>instructor_assets/imgs/avatar.png" alt="Avatar" class="avatar" height="250" width="250">
        <?php } ?>
         
          <br>
          <label for="profile-picture">Upload your Profile Photo: Require size (500 X 300)</label><br><br>  
      </center>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li class="active">
                  <a id="" class="btn  btn-xs " data-toggle="tab" href="#home">Introduction</a>
              </li>
              <li>
                  <a id="menuTab-2" data-toggle="tab" class="btn  btn-xs disabled " href="#menu2" >Communicational Details</a>
              </li>
              <li>
                  <a id="menuTab-3" data-toggle="tab" class="btn  btn-xs disabled " href="#menu3" >Education Details</a>
              </li>
              <li>
                  <a id="menuTab-4" data-toggle="tab" class="btn  btn-xs disabled " href="#menu4" >Certifications</a>
              </li>
              <li>
                  <a id="menuTab-5" data-toggle="tab" class="btn  btn-xs disabled" href="#menu5" >Experience Details</a>
              </li>
              <li>
                  <a id="menuTab-6" data-toggle="tab" class="btn  btn-xs disabled" href="#menu6" >About You</a>
              </li>
              <li>
                  <a id="menuTab-7" data-toggle="tab" class="btn  btn-xs disabled" href="#menu7">Why Student Want To Join</a>
              </li>
             <!-- <li>
                  <a id="menuTab-8" data-toggle="tab" class="btn  btn-xs disabled" href="#menu8">Complete</a>
              </li>
               <li>
                  <a id="menuTab-9" data-toggle="tab" class="btn  btn-xs disabled" href="#menu9">Menu 9</a>
              </li> -->
            </ul>
        </div>
      </div>
         

        <div class="tab-content">
<!-- =====Tab 1======= -->  

            <div id="home" class="tab-pane fade in active">
                <div class="form-container" style="padding:40px;">

                     <form id="introduction_form" action="#"  method="post" enctype="multipart/form-data">
                      <input type="hidden" name="trainer_id" id="trainer_id"  class="trainer_id" value='0'>

                        <h4>Introduction <span class="step">(Step 1 / 8)</span></h4><br><br>
                        
                        <div class="row">
                          <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label  class="col-sm-4" for="first-name">Select Profile</label>
                                    <div class="col-sm-8">
                                      <input type="file" id="imglink" accept="image/*" Name="picture" onchange="PreviewImage(this);"  required="required" />
                                    </div>
                                    
                                    
                                </div>
                            </div>
                          <div class="col-sm-4"></div>  
                        </div>
                        <div class="row">
                          <br>
                            <div class="col-sm-4">
                                <div class="form-group">

                                    <label for="first-name">First Name:</label><br>
                                <?php if(isset($first_name)){ ?>
                                    <input type="text" name="first_name" required class="first-name form-control table-text1" id="name" value="<?php echo $detailesData['first_name']?>" required="required">
                                <?php } else{  ?>
                                    <input type="text" name="first_name" required class="first-name form-control table-text1" id="name" required="required">
                                <?php } ?>  

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="last-name">Last Name:</label><br>
                                <?php if(isset($last_name)){ ?>
                                    <input type="text" name="last_name" required class="last-name form-control table-text1" id="name" value="<?php echo $detailesData['last_name']?>" required="required">
                                <?php } else{  ?>
                                    <input type="text" name="last_name" required class="last-name form-control table-text1" id="name" required="required">
                                <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-4"> 
                                <div class="form-group">
                                  <label for="DOB">D.O.B (DD-MM-YYYY) :</label>

                                <?php if(isset($birth_date)){ ?>
                                   <input class="form-control" type="date" name="birth_date" value="<?=$detailesData['birth_date']?>"  required="required"/>
                                <?php } else{  ?>
                                    <input class="form-control" type="date" name="birth_date"  required="required"/>
                                <?php } ?>
                                 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-8">
                              <div class="form-group">
                              
                                <div class="radio-buttons-1">

                                    <p>Gender (Male/Female/Others) :</p>
                                    <?php if(isset($gender)) { if($gender=='mail'){?>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="male" checked='checked'> Male
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="female"> Female
                                    </label>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="others"> Others
                                    </label>
                                     <?php }} else if(isset($gender)) { if($gender=='female'){?>

                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="male"> Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="female" checked='checked'> Female
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="others"> Others
                                    </label>
                                    <?php } } else{?>
                                      <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="male"> Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="female"> Female
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="radio_buttons_1_options" value="others" checked='checked'> Others
                                    </label>
                                    <?php }?>
                              
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
                                    <?php /*if($course_id==1){*/ ?>
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
                                  <?php /*} else if($course_id==2){*/ ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="1"> Java
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="2" checked='checked'> Web Development
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="3"> IOT
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="4"> Python
                                    </label>
                                  <?php /*} else if($course_id==3){*/ ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="1"> Java
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="2"> Web Development
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="3"  checked='checked'> IOT
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="4"> Python
                                    </label>
                                  <?php /*} else if($course_id==4){*/ ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="1"> Java
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="2"> Web Development
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="3"> IOT
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="checkboxes_1_options" value="4"  checked='checked'> Python
                                    </label>
                                  <?php /*}*/ ?>
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
                      <input type="hidden" name="communication_id" id="communication_id"  class="communication_id" value='0'>
                        <h4>Communicational Details <span class="step">(Step 2 / 8)</span></h4>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address">Address:</label><br>
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
                                    <input type="text" name="mobile_phone" class="mobile-phone form-control table-text1" id="mobile_phone" pattern="\d+" maxlength="10" required="required">
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
                                               <th class="text-center">Qualification</th>
                                              <th class="text-center">college/Univercity</th>
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
                            <button type="submit" name="Save & Next" class="btn btn-next"> Save & Next <i class="fa fa-angle-right"></i> </button>
                            <button type="button" name="skip" class="btn btn-skip"> Skip <i class="fa fa-angle-right"></i> </button>
                    </form>
                </div>
            </div>

<!-- =====Tab 5======= -->  
            <div id="menu5" class="tab-pane fade">
                  <div class="form-container">
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
                           <button type="button" name="skip" class="btn btn-skip"> Skip <i class="fa fa-angle-right"></i> </button>
                      </form>
                  </div>
            </div>

<!-- =====Tab 6======= -->  

            <div id="menu6" class="tab-pane fade">
                  <div class="form-container">
                        <form id="aboutYou_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                          <input type="hidden" name="aboutYou_id" id="aboutYou_id"  class="aboutYou_id" value='0'>
                          <h4>About You <span class="step">(Step 6 / 8)</span></h4>
                          <div class="row">
                              <div class="col-sm-3"></div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="about-you">Tell us a bit about yourself (min 500 words):</label><br>
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
            </div>

<!-- =====Tab 7======= -->  
            <div id="menu7" class="tab-pane fade">
                <div class="form-container">
                    <form id="whyJoin_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                      <input type="hidden" name="why_you_join_id" id="why_you_join_id"  class="why_you_join_id" value='0'>
                        <h4>Why Student Want To Join <span class="step">(Step 7 / 8)</span></h4>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="why-join">Tell us why should student connect to you for learning:</label><br>
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
            </div>

<!-- =====Tab 8======= -->  
           <!--  <div id="menu8" class="tab-pane fade" style="padding:40px;">
                  <div class="form-container">
                        <form id="bankDetails_form" method="post" enctype="multipart/form-data" onsubmit="return false">
                          <h4>Bank Details<p>This is required to transfer your salary</p> <span class="step">(Step 8 / 8)</span></h4>
                          <div class="row p-4">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="bank-name">Bank Name:</label><br>
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
            </div> -->

            <!-- =====Tab 8======= -->  
            <div id="menu9" class="tab-pane fade" style="padding:40px;">

                <center><h3>Form Submitted Successfully !</h3>
                  <p>You will be notify once your profile is approved. <br>Management team will be connect  you soon.</p></center>

            </div>

        </div>
    </div>
</div>
    
<input type="hidden" name="bases_url" id="bases_url" value="<?php echo base_url()?>">

<input type="hidden" name="assets_url" id="assets_url" value="<?php echo asset_url()?>">
        <!-- Java script -->
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

      //$body = $("body");
     // $('.loader-modal').show();

      $(document).on({
          ajaxStart: function() { $('.loader-modal').show();  },
          ajaxStop: function() { $('.loader-modal').hide();  }    
      });


      $( "#datepicker" ).datepicker();
      $("#datepicker").datepicker("setDate",new Date());
      $( "#datepicker" ).datepicker( "option", "dateFormat", "dd/mm/yy");


    


// =====Tab 1======= -->  
    $( "#introduction_form" ).submit(function(e) {

      var form = $(this);

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

              var valid=false;

              valid=callAjax(this,formUrl);

              if(valid){

                 $('[href="#menu2"]').tab('show');

                 $('#menuTab-2').removeClass('disabled');

              }

          }else{

              alert(false);
          }

    });


// =====Form 2======= -->  
    $( "#address_form" ).submit(function(e) {

        var form = $(this);
        if (form.valid() === true){

              var valid=false;

              e.preventDefault();


            var communication_id= $('#communication_id').val();

              if(parseInt(communication_id)>0){
          

                formUrl='TrainerAddress/editTrainerAddress';
              }
              else{
                formUrl='TrainerAddress/insert_trainerAddress';
              }

              //formUrl='TrainerDetails/insert_trainer';

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu3"]').tab('show');

                $('#menuTab-3').removeClass('disabled');
              }

          }else{

               alert(false);
          }



    });

// Dynamic Form =====Form 3======= -->  
     $( "#educational_form" ).submit(function(e) {

          formUrl='TrainerEducation/insert_education';

          var valid=false;

          valid=callAjaxForDaynamicField(this,formUrl);


          if(valid){

             $('[href="#menu4"]').tab('show');
     
              $('#menuTab-4').removeClass('disabled');

          }
      });

// Dynamic Form =====Form 4======= -->  
    $( "#certification_form" ).submit(function(e) {

        console.log(this);


        formUrl='TrainerCertification/insert_certificate';

        var valid=false;

        valid=callAjaxForDaynamicField(this,formUrl);


        if(valid){

           $('[href="#menu5"]').tab('show');
  
           $('#menuTab-5').removeClass('disabled');

        }

    });

// Dynamic Form =====Form 5======= -->  
    
    $( "#experience_form" ).submit(function(e) {

        console.log(this);


        formUrl='TrainerExperience/insertExperience';

        var valid=false;

        valid=callAjaxForDaynamicField(this,formUrl);


        if(valid){

           $('[href="#menu6"]').tab('show');
     
           $('#menuTab-6').removeClass('disabled');

        }

      

    });

// =====Form 6======= -->  

    $( "#aboutYou_form" ).submit(function(e) {

      
      var form = $(this);

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

                $('[href="#menu7"]').tab('show');
     
                $('#menuTab-7').removeClass('disabled');
              }

          }else{

              // alert(false);
          }

      

    });

    

// =====Form 7======= -->  


    $( "#whyJoin_form" ).submit(function(e) {

      
      var form = $(this);

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

                $('[href="#menu8"]').tab('show');
      
                $('#menuTab-8').removeClass('disabled');

              }

          }else{

              alert(false);
          }

    });



// =====Form 8======= -->  

    $( "#bankDetails_form" ).submit(function(e) {

        var form = $(this);

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

              valid=callAjax(this,formUrl);

              if(valid){

                $('[href="#menu9"]').tab('show');

                $('#menuTab-9').removeClass('disabled');

              }

          }else{

              // alert(false);
          }

    });

}); 



var valid=false;

function callAjax(form, formUrl){
  
  $.ajax({            
            type:'post',
            url : formUrl,
            processData: false,
            contentType: false,
            async:true,
            data: new FormData(form),
            success: function (data) {

                  valid = true;
                  setValueToHiddField(data);


              },
              error: function (data) {
                  console.log('An error occurred.');
                  console.log(data);
              }     
    });

  return valid;
}

function setValueToHiddField(data) {
    var mydata=JSON.parse(data);
    console.log(mydata);

  $('#'+mydata.key).val(mydata.value);
   
}



//Form for dynamic fields ====================
function callAjaxForDaynamicField(form, formUrl){
  
  $.ajax({            
            type:'post',
            url : formUrl,
            processData: false,
            contentType: false,
            async:true,
            data: new FormData(form),
            success: function (data) {

                  valid = true;
                  console.log(data);
                  setValueToHiddcDaynamicField(data);


              },
              error: function (data) {
                  console.log('An error occurred.');
                  console.log(data);
              }     
    });

  return valid;
}

 //Form for dynamic fields ====================
function setValueToHiddcDaynamicField(data) {

    var mydata=JSON.parse(data);
    console.log(mydata);
    for (var i = 0; i < mydata.length; i++) {

      $('#'+mydata[i].key).val(mydata[i].value);
      
    }
}
   



</script>
        <!-- ......end date picker.... -->
  
       <?php if(count($detailesData)>0){   ?>

       <script type="text/javascript">

          $('[href="#menu2"]').tab('show');
          $('#menuTab-2').removeClass('disabled');
       
       </script>
       <?php } ?>     
        

    </body>

</html>
<?php 
}else{
  redirect(base_url()."login");
}
?>
