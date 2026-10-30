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
  <h4 class="text-center heading">Update Registration Info</h4>
  <h5 class="text-center heading">(Reg. ID: <?=$registration_id?>)</h5>
  <br>
  <form action="<?php echo base_url()?>register-update" method="post">
    <input type="hidden" name="regid" value="<?=$reg_id?>"/>
    <input type="hidden" name="registrationid" value="<?=$registration_id?>"/>
    <input type="hidden" name="stdid" value="<?=$std_id?>"/>
    <div class="row">
      <div class="col-sm-6">

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Student Id:</label>
          <div class="col-sm-8">
            <label class="col-form-label lead"><?=$student_id?></label>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Name:</label>
          <div class="col-sm-8"> 
            <label class="col-form-label lead"><?=$first_name." ".$last_name?></label>
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
                  if($course_id==$row->course_id){
              ?>
              <option value="<?=$row->course_id ?>" selected="selected"><?=$row->course_title ?></option>
              <?php }else{?>
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
            <label class="col-form-label lead"><?=date('d-m-Y',strtotime($birth_date))?></label>
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
            <input type="number" id="discountamount" name="discountamount" class="form-control" min="0" required="required" onkeyup="updateTotalFee()" onchange="updateTotalFee()" value="<?=$discount_amount?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Total Fee (&#8377;):</label>
          <div class="col-sm-8">
            <input type="number" id="totalfee" name="totalfee" class="form-control" min="100" value="<?=$total_fee?>" disabled="disabled"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Admission Date:</label>
          <div class="col-sm-8">
            <input type="date" name="admissiondate" class="form-control" required="required" value="<?=$admission_date?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course Start Date:</label>
          <div class="col-sm-8">
            <input type="date" name="coursestartdate" class="form-control" required="required" value="<?=$course_start_date?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Training Mode:</label>
          <div class="col-sm-8">
            <select name="trainingmode" class="form-control">
              <?php if($training_mode=='Online'){?>
                <option value="Offline">Offline</option>
                <option value="Online" selected="selected">Online</option>
              <?php }else{?>
                <option value="Offline" selected="selected">Offline</option>
                <option value="Online">Online</option>
              <?php }?>
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