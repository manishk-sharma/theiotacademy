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
  <h4 class="text-center heading">Add New Enquiry</h4>
  <br>
  <form action="<?php echo base_url()?>submit-enquiry" method="post">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">First Name:</label>
          <div class="col-sm-8">
            <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name" required="required"/>
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
          <label class="col-sm-4 col-form-label lead">Course:</label>
          <div class="col-sm-8">
            <select name="courseid" class="form-control">
              <?php 
                $courselist=$this->CourseModel->getActiveCoursesList() ;
                foreach($courselist as $row){
              ?>
              <option value="<?=$row->course_id ?>"><?=$row->course_title ?></option>
              <?php } ?> 
            </select>
          </div>
        </div>

      </div>
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Email ID:</label>
          <div class="col-sm-8">
            <input type="email" name="emailid" class="form-control" placeholder="Enter Your Email ID" required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Mobile No.:</label>
          <div class="col-sm-8">
            <input type="tel" name="mobileno" class="form-control" placeholder="Enter Your Mobile No." required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Source:</label>
          <div class="col-sm-8">
            <select name="sourceid" class="form-control">
              <?php 
                $sourcelist=$this->EnquirySourceModel->getActiveEnquirySourcesList() ;
                foreach($sourcelist as $row){
              ?>
              <option value="<?=$row->source_id ?>"><?=$row->title ?></option>
              <?php } ?> 
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Message:</label>
          <div class="col-sm-8">
            <textarea name="message" class="form-control" placeholder="Enter Your Message"></textarea>
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
<?php 
}else{
  redirect(base_url()."login");
}
?>