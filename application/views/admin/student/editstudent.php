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
  <h4 class="text-center heading">Update Student Info</h4>
  <h5 class="text-center heading">(Student ID:&nbsp;<?=$student_id?>)</h5>
  <br>
  <form action="<?php echo base_url()?>update-student" method="post">
    <input type="hidden" name="stdid" value="<?=$std_id?>"/>
    <input type="hidden" name="studentid" value="<?=$student_id?>"/>
    <input type="hidden" name="userid" value="<?=$user_id?>"/>
    <div class="row">
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
              <?php if($gender=='Female'){?>
                <option value="Male">Male</option>
                <option value="Female" selected="selected">Female</option>
              <?php }else{?>
                <option value="Male" selected="selected">Male</option>
                <option value="Female">Female</option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Guardian Name:</label>
          <div class="col-sm-3">
            <select name="glabel" class="form-control">
              <?php if($guardian_label=='Mrs.'){?>
                <option value="Mr.">Mr.</option>
                <option value="Mrs." selected="selected">Mrs.</option>
                <option value="Ms.">Ms.</option>
              <?php }else if($guardian_label=='Ms.'){?>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms." selected="selected">Ms.</option>
              <?php }else{ ?>
                <option value="Mr." selected="selected">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-5">
            <?php if($guardian_name=="nil"){?>
              <input type="text" name="gname" class="form-control" placeholder="Enter Guardian Name" required="required"/>
            <?php }else{?>
              <input type="text" name="gname" class="form-control" placeholder="Enter Guardian Name" required="required" value="<?=$guardian_name?>"/>
            <?php }?>
          </div>
        </div>

      </div>
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Date of Birth:</label>
          <div class="col-sm-8">
            <input type="date" name="birthdate" class="form-control" required="required" value="<?=$birth_date?>"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Email ID:</label>
          <div class="col-sm-8">
            <input type="hidden" name="oldemailid" value="<?=$email_id?>"/>
            <input type="email" name="newemailid" class="form-control" placeholder="Enter Your Email ID" required="required" value="<?=$email_id?>"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Mobile No.:</label>
          <div class="col-sm-8">
            <input type="tel" name="mobileno" class="form-control" placeholder="Enter Your Mobile No." required="required" value="<?=$mobile_no?>"/>
          </div>
        </div>
       
      </div>

    </div>
    
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
        <input type="submit" value="Update Now" class="btn btn-primary submitbtn"/>
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