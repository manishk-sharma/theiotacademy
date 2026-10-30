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
  <h4 class="text-center heading">Add New Course</h4>
  <br>
  <br>
  <form action="<?php echo base_url()?>submit-course" method="post">
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course Title:</label>
          <div class="col-sm-8">
            <input type="text" name="coursetitle" class="form-control" placeholder="Enter Course Title" required="required"/>
          </div>
        </div>
        <div class="form-group row mt-2">
          <label class="col-sm-4 col-form-label lead">Subject:</label>
          <div class="col-sm-8">
            <?php 
                $subjectList=$this->SubjectModel->getActiveSubjectsList();
            ?>
            <select class="form-control" id="subject_id" name="subject_id">
              <?php  foreach( $subjectList as $srow) {?>
                <option value="<?=$srow->subject_id?>"><?=$srow->subject_title?></option>
                <?php }?>
            </select>
          </div>
        </div>
        
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
       
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Project Work:</label>
          <div class="col-sm-8">
            <textarea name="projectwork" class="form-control" placeholder="Enter Project Work Info" rows="4" required="required"></textarea>
          </div>
        </div>
        
      </div>


    </div>
    
    <div class="row mt-2">
        <label class="col-sm-2 col-form-label lead">Course Description:</label>
        <div class="col-sm-10">
          <textarea name="coursedescription" id="coursedescription" class="form-control" placeholder="Enter Course Description" rows="4" required="required"></textarea>
        </div>
    </div>
    <div class="row mt-4">
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
      
    </div>
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>

<?php 
}else{
  redirect(base_url()."login");
}
?>