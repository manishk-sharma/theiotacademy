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
  </style>
<style type="text/css">
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
</style>
<?php
 $currentdate=date('Y-m-d');
 $regstartdate = date('Y-m-d\TH:i');
?>
<?php
  $d="05-05-2019";
$date=date_create($d);
$newd= date_format($date,"Y/m/d");
$typeList=$this->EventTypeModel->getEventTypeList();
$location=$this->EventLocationModel->getLocationList();
?>
<div class="container-fluid">
  <h4 class="text-center heading">Add New Guest Speaker</h4>
  <br>

  <form action="<?php echo base_url()?>submit-speaker" method="post" enctype="multipart/form-data">
    <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">First Name</label>
          <div class="col-sm-8">
            <input type="text" name="firstname" class="form-control" placeholder="Enter Your First Name" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Last Name:</label>
          <div class="col-sm-8">
            <input type="text" name="lastname" class="form-control" placeholder="Enter Your Last Name" required="required">
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
          <label class="col-sm-4 col-form-label lead">Birth Date</label>
          <div class="col-sm-8">
            <input type="date" name="birthdate" class="form-control" placeholder="Enter Your Birth Date" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead" pattern="\d+">Mobile No.</label>
          <div class="col-sm-8">
            <input type="tel" name="mobileno" class="form-control" placeholder="Enter Your Mobile No" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">E-mail.</label>
          <div class="col-sm-8">
            <input type="emailid" name="emailid" class="form-control" placeholder="Enter Your E-mail" required="required">
          </div>  
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Select Photo</label>
          <div class="col-sm-8">
            <input type="file" name="photo" class="form-control" placeholder="Optional" >
          </div>
        </div> 
       
      </div>
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">From Company:</label>
          <div class="col-sm-8">
            <input type="text" id="fromcompany" name="fromcompany" class="form-control" placeholder="Company" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Company:</label>
          <div class="col-sm-8">
            <input type="text" id="company" name="company" class="form-control" placeholder="Company" required="required">
          </div>  
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Designation:</label>
            <div class="col-sm-8">
              <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation" value="" required="required" />
            </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Facebook Link:</label>
          <div class="col-sm-8">
            <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Optional" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Twitter Link:</label>
          <div class="col-sm-8">
            <input type="text" id="twitter" name="twitter" class="form-control" placeholder="Optional" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Linked In Link:</label>
          <div class="col-sm-8">
            <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="Optional" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Description:</label>
          <div class="col-sm-8">
            <textarea name="description"  class="form-control" id="description" col="4" rows="4"  placeholder="Enter Description Here" required="required"></textarea>
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
<script type="text/javascript">
  function showPType() {
      var ptype=document.getElementById("paymenttype");
      var price=document.getElementById("price");
      if (ptype.value=="Paid") 
        {
          price.disabled="";
          price.value="";
        }
      else 
        {
          price.value=0;
          price.disabled="disabled";
        } 
    }
    
 //--------------------for Curren date and time--------------------
    document.getElementById('startdate').valueAsDate = new Date();
    document.getElementById('enddate').valueAsDate = new Date();

//--------------------for date and time calculation--------------------
    jQuery('#startdate').change(function()
      {
          var date1=(jQuery('#startdate').val());        
          var date2=(jQuery('#enddate').val());        
          var startdate = new Date(date1);            
          var enddate = new Date(date2);                                       
          var timeDiff = Math.abs(startdate.getTime() - enddate.getTime());             
          var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
          document.getElementById('numofdays').value=diffDays+1;
                                         
      }); 
      jQuery('#enddate').change(function()
      {
          var date1=(jQuery('#startdate').val());        
          var date2=(jQuery('#enddate').val());        
          var startdate = new Date(date1);            
          var enddate = new Date(date2);                                       
          var timeDiff = Math.abs(startdate.getTime() - enddate.getTime());             
          var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
          document.getElementById('numofdays').value=diffDays+1;
                                         
      });


//-------------------------------------------------------------    
  
</script> 
<?php 
}else{
  redirect(base_url()."login");
}
?>