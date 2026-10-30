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
  <h4 class="text-center heading">Add New Company</h4>
  <br>
  <form action="<?php echo base_url()?>submit-company" method="post">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Company Name:</label>
          <div class="col-sm-8">
            <input type="text" name="companyname" class="form-control" placeholder="Enter Your Company Name" required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">PAN No.:</label>
          <div class="col-sm-8">
            <input type="text" name="panno" class="form-control" placeholder="Enter Company's PAN No." required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">GST No.:</label>
          <div class="col-sm-8">
            <input type="text" name="gstno" class="form-control" placeholder="Enter Company's GST No." required="required"/>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Website:</label>
          <div class="col-sm-8">
            <input type="text" name="website" class="form-control" placeholder="Enter Company's Website URL" required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Remark:</label>
          <div class="col-sm-8">
            <textarea name="remark" class="form-control" placeholder="Enter Remarks" required="required"></textarea>
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
          <label class="col-sm-4 col-form-label lead">Contact No.:</label>
          <div class="col-sm-8">
            <input type="tel" name="contactno" class="form-control" placeholder="Enter Contact No." required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Alternate Contact No.:</label>
          <div class="col-sm-8">
            <input type="tel" name="altcontactno" class="form-control" placeholder="Enter Alternate Contact No." required="required"/>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Address:</label>
          <div class="col-sm-8">
            <textarea name="compaddress" class="form-control" placeholder="Enter Your Company's Address" rows="4" required="required"></textarea>
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