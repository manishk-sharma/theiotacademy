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
  <h4 class="text-center heading">New Registration For Existing Student</h4>
  <h5 class="text-center heading">(Student ID: <?=$student_id?>)</h5>
  <br>
  <form action="<?php echo base_url()?>register-existing" method="post">
    <input type="hidden" name="stdid" value="<?=$std_id?>"/>
    <input type="hidden" name="studentid" value="<?=$student_id?>"/>
    <input type="hidden" name="emailid" value="<?=$email_id?>"/>
    <input type="hidden" name="fname" value="<?=$first_name?>"/>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">First Name:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=$first_name?></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Last Name:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=$last_name?></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Gender:</label>
          <div class="col-sm-8">
           <label class="col-form-label lead"><?=$gender?></label>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course:</label>
          <div class="col-sm-8">
            <select id="courseid" name="courseid" class="form-control" onchange="updateCourseFee()">
              <?php 
                $courselist=$this->CourseModel->getActiveCoursesList() ;
                $coursefeeflag=0 ;
                foreach($courselist as $row){
                  $exists=$this->RegisterModel->isStudentCourseRegisterExists($std_id,$row->course_id);
                  if(!$exists){
                    if($coursefeeflag==0){
                      $course_fee=$row->course_fee ;
                    }
                    $coursefeeflag++ ;
              ?>
              <option value="<?=$row->course_id ?>"><?=$row->course_title ?></option>
              <?php }} ?> 
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Email ID:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=$email_id?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Mobile No.:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=$mobile_no?></label>
          </div>
        </div>
       
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Date of Birth:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=date('d-m-Y',$birth_date)?></label>
          </div>
        </div>

      </div>
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course Fee (&#8377;):</label>
          <div class="col-sm-8">
            <label id="coursefeelabel" class="col-form-label lead">&#8377;&nbsp;<?=$course_fee?></label>
            <input type="hidden" id="coursefee" name="coursefee" value="<?=$course_fee?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Discount Amt. (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="discountamount" name="discountamount" class="form-control" min="0" value="0" required="required" onkeyup="updateTotalFee()" onchange="updateTotalFee()" value="<?=$discount_amount?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Total Fee (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="totalfee" name="totalfee" class="form-control" min="100" value="<?=$course_fee?>" disabled="disabled"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Admission Date:</label>
          <div class="col-sm-8">
            <input type="date" name="admissiondate" class="form-control" required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course Start Date:</label>
          <div class="col-sm-8">
            <input type="date" name="coursestartdate" class="form-control" required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Training Mode:</label>
          <div class="col-sm-8">
            <select name="trainingmode" class="form-control">
                <option value="Offline">Offline</option>
                <option value="Online">Online</option>
            </select>
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
<script type="text/javascript">
  function updateTotalFee(){
    var coursefee=document.getElementById("coursefee") ;
    var discount=document.getElementById("discountamount") ;
    var totalfee=document.getElementById("totalfee") ;
    var coursefeelabel=document.getElementById("coursefeelabel") ;
    totalfee.value=coursefee.value-discount.value ;
    coursefeelabel.innerHTML="&#8377;&nbsp;"+coursefee.value ;
  }
</script>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript" src="<?php echo asset_url()?>js/ajax/registerstudentajax.js"></script>
<?php 
}else{
  redirect(base_url()."login");
}
?>