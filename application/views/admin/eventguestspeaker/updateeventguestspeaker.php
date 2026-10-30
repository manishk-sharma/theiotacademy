<?php  
if($this->session->userdata("logged_in")){
?>
  
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
    .switch {
  position: relative;
  display: inline-block;
  width: 90px; 
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
   border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.slider:after
{
 content:'NO';
 color: white;
 display: block;
 position: absolute;
 transform: translate(-50%,-50%);
 top: 50%;
 left: 50%;
 font-size: 10px;
 font-family: Verdana, sans-serif;
}

input:checked + .slider:after
{  
  content:'YES';
}

/*--------- END --------*/
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
  .profile-pic{
      border:2px solid #118c8b;;
      border-radius:50%;
  }
</style>
<?php
$typeList=$this->EventTypeModel->getEventTypeList();
$location=$this->EventLocationModel->getLocationList();
?>
<div class="container-fluid">
  <h4 class="text-center heading">Update Guest Speaker</h4>
  <br>

  <form action="<?php echo base_url()?>update-speaker" method="post" enctype="multipart/form-data">
    <div class="row">
      <!--Left Side Form-->
        <div class="col-sm-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead">Spaeker Id</label>
              <div class="col-sm-8">
                <input type="text" value="<?=$speaker_id?>" name="upspeakerid" class=" text-center form-control" readonly>
              </div>
            </div>
             <div class="form-group row">
              <label class="col-sm-4 col-form-label lead">First Name</label>
              <div class="col-sm-8">
                <input type="text" value="<?=$first_name?>" name="upfirstname" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead">Last Name:</label>
              <div class="col-sm-8">
                <input type="text" value="<?=$last_name?>" name="uplastname" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label lead">Gender:</label>
                <div class="col-sm-8">
                  <select name="upgender" class="form-control">
                    <?php if($gender=="Female"){?>
                      <option value="Male">Male</option>
                      <option value="Female" selected="selected">Female</option>
                    <?php }else{?>
                      <option value="Male" selected="selected">Male</option>
                      <option value="Female">Female</option>
                    <?php }?>
                  </select>
                </div>
              </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead">Birth Date</label>
              <div class="col-sm-8">
                <input type="date" value="<?=$birth_date?>" name="upbirthdate" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead" pattern="\d+" maxlenght="10">Mobile No.</label>
              <div class="col-sm-8">
                <input type="tel" value="<?=$mobile_no?>" name="upmobileno" class="form-control" required="required" maxlength="10">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label lead">E-mail.</label>
              <div class="col-sm-8">
                <input type="emailid" value="<?=$email_id?>" name="upemailid" class="form-control" required="required">
              </div>  
            </div>
            <div class="form-group row">
                <div class="col-sm-4 text-center">
                    <img src="<?php echo guestspeaker_pic_url().$photo?>" class="img-responsive profile-pic" title="Current Profile"  height="70" width="70"/>
                </div>
                <div class="col-sm-8" style="line-height:70px;">
                    Do You Want To Upload New Photo? 
                    <input name="checkphoto" type="checkbox" value="1" class="ml-4" onchange="handleCheckBox(this);">
                </div>
            </div>
            <div class="form-group row " id="profilepic">
              <label class="col-sm-4 col-form-label lead">Select Photo</label>
              <div class="col-sm-8">
                <input type="file" id="geustphoto" name="photo" class="form-control" >
              </div>
            </div>
        </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">From Company:</label>
          <div class="col-sm-8">
            <input type="text" id="fromcompany" value="<?=$from_company?>" name="upfromcompany" class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Company:</label>
          <div class="col-sm-8">
            <input type="text" id="company" value="<?=$company?>" name="upcompany" class="form-control" required="required">
          </div>  
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Designation:</label>
            <div class="col-sm-8">
              <input type="text" value="<?=$designation?>" name="updesignation" id="designation" class="form-control"  required="required" />
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Facebook Link:</label>
          <div class="col-sm-8">
            <input type="text" value="<?=$facebook_link?>" name="upfacebook" id="facebook" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Twitter Link:</label>
          <div class="col-sm-8">
            <input type="text" id="twitter" value="<?=$twitter_link?>" name="uptwitter" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Linked In Link:</label>
          <div class="col-sm-8">
            <input type="text" id="linkedin" value="<?=$linkedin_link?>" name="uplinkedin" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Description:</label>
          <div class="col-sm-8">
            <textarea name="updescription" id="description" col="4" rows="4" class="form-control" required="required"><?=$description?></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4"></div>
       <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
    </div>
  </form>
  
</div>
<script type="text/javascript">
var profilepic=document.getElementById("profilepic") ;
profilepic.style.display = "none";
  function handleCheckBox(checkbox){
    if(checkbox.checked == true){
        profilepic.style.display="" ;
    }else{
        profilepic.style.display = "none";
    }
  }
</script>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
  redirect(base_url()."login");
}
?>