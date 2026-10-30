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
  <h4 class="text-center heading">Add New Employee</h4>
  <br>
  <form action="<?php echo base_url()?>submit-employee" method="post" enctype="multipart/form-data">
    <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url()?>"/>
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">

        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">First Name:</label>
            <div class="col-sm-8">
              <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name" required="required" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Last Name:</label>
            <div class="col-sm-8">
              <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Gender:</label>
            <div class="col-sm-8">
              <select name="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Date of Birth:</label>
            <div class="col-sm-8">
              <input type="date" name="birthdate" class="form-control" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Facebook Link:</label>
            <div class="col-sm-8">
              <input type="text" name="facebooklink" class="form-control" placeholder="Optional" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Twitter Link:</label>
            <div class="col-sm-8">
              <input type="text" name="twitterlink" class="form-control" placeholder="Optional" />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Password:</label>
            <div class="col-sm-8">
              <input type="password" name="password" class="form-control" placeholder="Please Enter Your Password" required="true"/>
            </div>
          </div>
       
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">LinkedIn Link:</label>
          <div class="col-sm-8">
            <input type="text" name="linkedinlink" class="form-control" placeholder="Optional" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Photo:</label>
          <div class="col-sm-8">
            <input type="file" name="photo" class="form-control" placeholder="Optional" />
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
                ?>
                <option value="<?=$row->type_id ?>"><?=$row->title ?></option>
                <?php }} ?> 
              </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Designation:</label>
            <div class="col-sm-8">
              <select id="desigid" name="desigid" class="form-control">
                <?php 
                  $desiglist=$this->DesigModel->getDesigListByUserType(1) ;
                  foreach($desiglist as $row){
                ?>
                <option value="<?=$row->desig_id ?>"><?=$row->title ?></option>
                <?php } ?> 
              </select>
            </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Email ID:</label>
            <div class="col-sm-8">
              <input type="email" name="emailid" class="form-control" placeholder="Enter Your Email ID" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Mobile No.:</label>
            <div class="col-sm-8">
              <input type="tel" name="mobileno" class="form-control" placeholder="Enter Your Mobile No." required="required" max="10"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Description.:</label>
            <div class="col-sm-8">
              <textarea name="description" class="form-control" placeholder="Enter Description Here." required="required"></textarea>
            </div>
          </div>
      </div>


    </div>
    
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript" src="<?php echo asset_url()?>js/ajax/addemployeeajax.js"></script>
<?php 
}else{
  redirect(base_url()."login");
}
?>