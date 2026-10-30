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
<?php 
    $subjectList=$this->SubjectModel->getActiveSubjectsList();
?>
<div class="container-fluid">
  <h4 class="text-center heading">Update Course Information</h4>
  <h5 class="text-center heading">(Course ID: <?=$cs_id?>)</h5>
  <br>
  <form action="<?php echo base_url()?>update-course" method="post">
    <input type="hidden" name="courseid" value="<?=$course_id?>"/>
    <input type="hidden" name="csid" value="<?=$cs_id?>"/>
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course Title:</label>
          <div class="col-sm-8">
            <input type="text" name="coursetitle" class="form-control" placeholder="Enter Course Title" required="required" value="<?=$course_title?>"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Subject:</label>
          <div class="col-sm-8">
            <select class="form-control" id="subject_id" name="subject_id">

              <?php $subject_title=$this->SubjectModel->getSubjectTitleById($subject_id);?>

              <option value="<?=$subject_id?>" selected><?=$subject_title ?></option>
              <?php foreach($subjectList as $srow){ 
                if($srow->subject_id!=$subject_id) {?>
                <option value="<?=$srow->subject_id?>"><?=$srow->subject_title?></option>
              <?php }} ?>
             
            </select>
          </div>
        </div>
       
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Project Work:</label>
          <div class="col-sm-8">
            <textarea name="projectwork" class="form-control" placeholder="Enter Project Work Info" rows="4" required="required"><?=$project_work?></textarea>
          </div>
        </div>
        
      </div>


    </div>
    
    <div class="row mt-2">
        <label class="col-sm-2 col-form-label lead">Course Description:</label>
        <div class="col-sm-10">
          <textarea name="coursedescription" id="coursedescription" class="form-control" placeholder="Enter Course Description" rows="4" required="required"><?=$course_description?></textarea>
        </div>
    </div>

    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-right mt-4">
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