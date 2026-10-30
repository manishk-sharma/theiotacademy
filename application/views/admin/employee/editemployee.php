<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  } 
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Update Employee Info</h4>
  <br>
  <form action="<?php echo base_url()?>update-employee" method="post" enctype="multipart/form-data">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url()?>"/>
    <input type="hidden" name="empid" value="<?=$emp_id?>"/>
    <input type="hidden" name="employeeid" value="<?=$employee_id?>"/>
    <input type="hidden" name="userid" value="<?=$user_id?>"/>
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">

        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">First Name:</label>
            <div class="col-sm-8">
              <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name" required="required" value="<?=$first_name?>"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Last Name:</label>
            <div class="col-sm-8">
              <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name" required="required" value="<?=$last_name?>"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Gender:</label>
            <div class="col-sm-8">
              <select name="gender" class="form-control">
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
            <label class="col-sm-4 col-form-label lead">Date of Birth:</label>
            <div class="col-sm-8">
              <input type="date" name="birthdate" class="form-control" required="required" value="<?=$birth_date?>"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Facebook Link:</label>
            <div class="col-sm-8">
              <input type="text" name="facebooklink" class="form-control" value="<?=$facebook_link?>" placeholder="Optional" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Twitter Link:</label>
            <div class="col-sm-8">
              <input type="text" name="twitterlink" value="<?=$twitter_link?>" class="form-control" placeholder="Optional" />
            </div>
          </div>
        <div class="form-group row">
            <div class="col-sm-4 text-center">
                <img src="<?php echo employee_pic_url().$photo?>" class="img-responsive profile-pic" title="Current Profile"  height="70" width="70"/>
            </div>
            <div class="col-sm-8" style="line-height:70px;">
                Do You Want To Upload New Photo? 
                <input name="checkphoto" type="checkbox" value="1" class="ml-4" onchange="handleCheckBox(this);">
            </div>
                  
        </div>
        <div class="form-group row" id="profilepic">
              <label class="col-sm-4 col-form-label lead">Photo:</label>
              <div class="col-sm-8">
                <input type="file" name="photo" class="form-control" placeholder="Optional" />
              </div>
        </div>  
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">LinkedIn Link:</label>
          <div class="col-sm-8">
            <input type="text" name="linkedinlink" class="form-control" value="<?=$linkedin_link?>" placeholder="Optional" />
          </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">User Type:</label>
            <div class="col-sm-8">
              <select id="usertypeid" name="usertypeid" class="form-control" onchange="updateDesignation()">
                <?php 
                  $utlist=$this->UserTypeModel->getUserTypeList() ;
                  foreach($utlist as $row){
                    if($row->type_id!=4){
                      if($row->type_id==$user_type_id){
                ?>
                  <option value="<?=$row->type_id ?>" selected="selected"><?=$row->title ?></option>
                <?php }else{?>
                  <option value="<?=$row->type_id ?>"><?=$row->title ?></option>
                <?php }}} ?> 
              </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Designation:</label>
            <div class="col-sm-8">
              <select id="desigid" name="desigid" class="form-control">
                <?php 
                  $desiglist=$this->DesigModel->getDesigListByUserType($user_type_id) ;
                  foreach($desiglist as $row){
                    if($row->desig_id==$desig_id){
                ?>
                  <option value="<?=$row->desig_id ?>" selected="selected"><?=$row->title ?></option>
                <?php }else{?>
                  <option value="<?=$row->desig_id ?>"><?=$row->title ?></option>
                <?php }} ?> 
              </select>
            </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Email ID:</label>
            <div class="col-sm-8">
              <input type="email" name="emailid" class="form-control" placeholder="Enter Your Email ID" required="required" value="<?=$email_id?>" readonly="readonly"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Mobile No.:</label>
            <div class="col-sm-8">
              <input type="tel" name="mobileno" class="form-control" placeholder="Enter Your Mobile No." required="required" max="10" value="<?=$mobile_no?>"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Description:</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="description" placeholder="Write Description Here" required="required" ><?=$description?></textarea> 
            </div>
          </div>
          <div class="form-group row">
           <div class="col-sm-4"></div>
           <div class="col-sm-4"></div>
            <div class="col-sm-8 text-right">
               <input type="submit" value="Update" class="btn btn-primary submitbtn"/> 
            </div>
          </div>
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
<script type="text/javascript" src="<?php echo asset_url()?>js/ajax/addemployeeajax.js"></script>
<?php 
}else{
  redirect(base_url()."login");
}
?>