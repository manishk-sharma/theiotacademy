<?php  
if($this->session->userdata("logged_in")){
?>
  
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<!--------------------PLUGIN OF RICH TEXT CSS------------------------------------>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/eventadmin.css">
<link rel="stylesheet" href="<?php echo asset_url()?>admin/js/richtext.min.css">
<!-------------------------------------------------------------------------------->
<?php
date_default_timezone_set("Asia/Calcutta");

$typeList=$this->EventTypeModel->getActiveEventTypeList();
$eventLocation=$this->EventLocationModel->getActiveLocationList();
?>
<div class="container-fluid" id="containerfluid">
  <div class="row">
    <div class="col-sm-12">
        <h4 class="text-center heading mt-4 text-warning">Update Event</h4>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-bottom:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </div>
  </div>
  <form id="upmyForm" name="upmyForm" action="<?php echo base_url()?>EventCreate/eventEdit" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
    <input type="hidden" id="eventid" name="eventid" value="<?=$event_id?>">
    <input type="hidden" name="oldroute" value="<?=$route_name?>">
<!---First Tab-->
    <div class="tab">
      <div class="row">
      <!--Left Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <div class="col-sm-4">
              Page Route:
          </div>
          <div class="col-sm-8">
            <input type="text" name="route" value="<?=$route_name=str_replace('event/', '', $route_name);?>" class="form-control" required="required" value=""/>
          </div> 
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Title:</label>
          <div class="col-sm-8">
            <input type="text" name="eventtitle" value="<?=$event_title?>" class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Type:</label>
          <div class="col-sm-8">
            <select id="eventtypeid" name="eventtypeid" class="form-control" required="required">
             <?php $title=$this->EventTypeModel->getEventTypeTitleById($event_type_id);?>
              <option value="<?=$event_type_id?>" selected="selected"><?=$title?></option>

              <?php foreach($typeList as $row){ 
                if($row->type_id!=$event_type_id) {?>
                <option value="<?=$row->type_id?>"><?=$row->type_title?></option>
              <?php }} ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Location:</label>
          <div class="col-sm-8">
            <select id="inputState" class="form-control" required="required" name="locationid">
            <?php
            if($location_id>0){
             $location=$this->EventLocationModel->getLocationTitleById($event_location_id);?>
            <option value="<?=$event_location_id?>" selected="selected"><?=$location['location_title']?></option>
            <?php } else {?>
               <option value="0" selected="selected">Online</option>
              <?php } foreach($eventLocation as $row){ 
                    if($row->location_id!=$event_location_id){?>
                  <option value="<?=$row->location_id?>"><?=$row->location_title?></option>
              <?php }} ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Open:</label>
          <div class="col-sm-8 ">
            <label class="switch">
            <?php if($event_open==1) {?>
              <input type="checkbox" id="eventopen" value="1" checked="checked" name="eventopen">
            <?php } else {?>
              <input type="checkbox" id="eventopen" value="1" name="eventopen">
            <?php }?>
              <div class="slider round"></div>
            </label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg Open:</label>
          <div class="col-sm-8 ">
            <label class="switch">
                <?php if($reg_open==1) {?>
                <input type="checkbox" value="1" name="regopen" id="regopen" checked="checked">
                <?php } else {?>
                <input type="checkbox" value="1" name="regopen" id="regopen">
                <?php }?>
                <div class="slider round"></div>
            </label>
          </div>
        </div>
      </div> 
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg Start date:</label>
          <div class="col-sm-8">
            <?php
            $regstartdt= date('Y-m-d\TH:i',strtotime($reg_start_dt));
            ?>
            <input type="datetime-local" id="regstartdate"   name="regstartdate" value="<?=$regstartdt?>"  class="form-control" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg End date:</label>
          <div class="col-sm-8">
            <?php
            $regenddt= date('Y-m-d\TH:i',strtotime($reg_end_dt));
           // echo "$regenddt";
            ?>
            <input type="datetime-local" id="regenddate"   name="regenddate" value="<?=$regenddt?>"  class="form-control" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Days:</label>
          <div class="col-sm-8 ">
            <select id="eventdays" name="eventdays" class="form-control">
              <?php if($multi_day==0){?>
                  <option value="0" selected="selected">Single</option>
                  <option value="1">Multi</option>
              <?php }else{?>
                  <option value="0">Single</option>
                  <option value="1" selected="selected">Multi</option>
               <?php }?>
            </select>
          </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Starts Date:</label>
            <div class="col-sm-8">
              <input type="date"  value="<?=$start_date?>" name="startdate" id="startdate" class="form-control"  required="required" />
              <div class="dateerrortext"> </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Ends Date:</label>
            <div class="col-sm-8">
              <input type="Date" name="enddate" id="enddate" value="<?=$end_date?>" class="form-control" value="" required="required" readonly="readonly"/>
            </div>
          </div>
        <div class="form-group row"> 
          <label class="col-sm-4 col-form-label lead">No. of Days:</label>
          <div class="col-sm-8">
            <input type="hidden" name="olddayquantity" value="<?=$days_quantity?>">
            <input type="number" name="dayquantity" id="numofdays" class="form-control" placeholder="Enter No. of Days" required="required" min="0"/ value="<?=$days_quantity?>" readonly="readonly">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Payment types:</label>
          <div class="col-sm-8">
            <select name="paymenttype" id="paymenttype" class="form-control" onchange="showPType();">
                <?php if($payment_type=="Paid"){?>
                 <option value="Paid" selected="selected">Paid</option>
                 <option value="Free">Free</option>
                <?php } else{?>
                <option value="Paid" >Paid</option>
                <option value="Free" selected="selected">Free</option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="form-group row" id="reg_link_row">
          <label class="col-sm-4 col-form-label lead">Registration link:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" id="reg_link" class="reg_link" name="reg_link" placeholder="Optional" value="<?=$reg_link?>">
          </div>
        </div>
         <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Price per person:</label>
          <div class="col-sm-8">
            <?php if($price==0){?>
            <input type="text" value="<?=$price?>" id="price" name="price" class="form-control" placeholder="Enter Amount" pattern="\d+" required="required" disabled="disabled">
            <p class="text-danger p-2" id="price-text" style="font-size: 11px;"></p>
          <?php } else{?>
             <input type="text" value="<?=$price?>" id="price" name="price" class="form-control" placeholder="Enter Amount" pattern="\d+" required="required">
             <p class="text-danger p-2" id="price-text" style="font-size: 11px;"></p>
           <?php }?>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!---Second Tab-->
    <div class="tab">
      <div  class="row">
        <div class="col-sm-6">
          <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Keywords:</label>
          <div class="col-sm-8">
            <textarea name="keywords" class="form-control" placeholder="Keywords"  required="required"><?=$keywords?></textarea>
          </div>
        </div> 
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
              <label class="col-sm-4 col-form-label lead ">Short Description:</label>
              <div class="col-sm-8">
                <textarea name="shortdescription" cols="" rows=""   class=" form-control" placeholder="Description In Short"  required="required"><?=$short_description?></textarea>
              </div>
          </div>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label lead">Long Description:</label>
          <div class="col-sm-10">
              <textarea name="longdescription"   class=" rich-content form-control" cols="4" rows="4"required="required"><?=$long_description?></textarea>
          </div>
      </div>
  </div>
    <!---Third Tab-->
  <div class="tab">
    <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url();?>">
    <div class="row">
      <div class="col-sm-12">
        <div class="dateAndSchdTable" id="dateAndSchdTable">
          
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center lead">Event Dates And Schedules</h3>
            <input type="hidden" name="eventdata" id="eventdata">
            <div class="accordion" id="accordionForUpdateDaysAndSchedules">

            </div>
        </div>
    </div>
  </div>
  <div class="row p-4 mb-3">
    <div class="col-sm-8"></div>
      <div class="col-sm-2">
          <button class="form-control mb-3 btn btn-primary" style="background:#007bff;" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      </div>
     <div class="col-sm-2 nextBtnDiv">
        <button class="form-control btn btn-warning " type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <input type="Submit" name="mysubmitbtn" class="  btn-success form-control" id="mysubmitbtn" value="Submit" hidden="hidden" />
     </div>
  </div>
</form>
</div>
<!---------Multi Part Form End Hre------------>




<!-----------------------Model for schd rearrange----------------->
<!-- Modal -->
<div class="modal fade" id="rearrangeSchd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Shift Schedule </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <label class="col-sm-3"> Select Date </label>
          <div class="col-sm-9">
            <select class="schdDate form-control" id="schdDateArrange">
            </select>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-sm-4"></div>
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <button type="button" class=" text-right btn btn-primary shiftSchdbtn" id="shiftSchd">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!---------------------------------------------------------------->
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<!------------------PLUGIN OF RICH TEXT JS  start------------------>
<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/updateeventspeakerajax.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/upeventdaysscheduleajax.js"></script>
<script type="text/javascript" src="<?php echo asset_url()?>admin/js/updateeventcomponents.js"></script>
<script type="text/javascript" src="<?php echo asset_url()?>admin/js/jquery.richtext.js"></script>

<script>
        $(document).ready(function() {
            $('.rich-content').richText();
        });
</script>
<!-----------------PLUGIN OF RICH TEXT JS end---------------------->
<script type="text/javascript">
  //ajax- Function Calling-------------------------
  var eventId=document.getElementById("eventid").value;
  PrintEventList(eventId);
  //ajax-End-here-----------------------------

  var reg_link_row=document.getElementById("reg_link_row");

      reg_link_row.style.display="none";

      var ptype=document.getElementById("paymenttype");     
      
      if (ptype.value=="Paid") 
        {
          reg_link_row.style.display="none";
        }
      else 
        {
          reg_link_row.style.display="";
        }

  function showPType() {

      var ptype=document.getElementById("paymenttype");     
      var price=document.getElementById("price");

      var reg_link_row=document.getElementById("reg_link_row");

      if (ptype.value=="Paid") 
        {
          price.disabled="";
          price.value="";
          reg_link_row.style.display="none";
        }
      else 
        {
          price.value=0;
          price.disabled="disabled";
          reg_link_row.style.display="";
           document.getElementById('price-text').innerHTML="";

        } 
    }
    //--------------------for Curren date and time--------------------
    currentdate=new Date();
    var currentstartdate=document.getElementById('startdate');
    var currentenddate=document.getElementById('enddate');
    //currentstartdate.valueAsDate =currentdate;     //start date As  current date  
    //currentenddate.valueAsDate =currentdate;       //end date As  current date 

    var eventdays=document.getElementById("eventdays");
    if (eventdays.value==0) {
          //jQuery('#enddate').val('');
          currentenddate.readOnly = true;
        }
        else{
           currentenddate.readOnly = false;
        }
    //for event Days=> single/multi ----------------------------     
     jQuery('#eventdays').change(function(){
         if (eventdays.value==0) {
          currentenddate.readOnly = true;
          currentenddate.valueAsDate=currentstartdate.valueAsDate;
          jQuery('#numofdays').val(1);
        }
      else{
          currentenddate.readOnly = false;
        }                                
      });

 //-------------------start date end date validation------------------
    jQuery('#startdate,#enddate').change(function()
    {   
        if (eventdays.value==0) {
          currentenddate.valueAsDate=currentstartdate.valueAsDate;
        }
        var date1=(jQuery('#startdate').val());        
        var date2=(jQuery('#enddate').val());       
        var startdate = new Date(date1);          
        var enddate = new Date(date2);
        var timeDiff = Math.abs(startdate.getTime() - enddate.getTime());            
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //date and time calculation
        jQuery('#numofdays').val(diffDays+1); // set Value in  number of days fields
         if (enddate<startdate && eventdays.value==1) {
          $('.dateerrortext').html("<p style='color:red;''>*start date less than end date</p>"); 
         jQuery('#enddate').val('');
         jQuery('#numofdays').val('0');
        }
        else{
           $('.dateerrortext').html("");
        }
  });

                                
//=====================Multi Part Form Validate======================

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
function showTab(n) {
  var prevBtn=document.getElementById("prevBtn");
  var nextBtn=document.getElementById("nextBtn");
  var mysubmitbtn=document.getElementById("mysubmitbtn");
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    prevBtn.style.display = "none";
  } else {
    prevBtn.style.display = "inline";
  }

  if (n == (x.length-1)) {
     nextBtn.style.display="none";
     nextBtn.hidden="hidden";
    //nextBtn.innerHTML = "Submit";
    //nextBtn.type="submit";
    mysubmitbtn.hidden=false;
  } else {
    nextBtn.style.display="";
    nextBtn.innerHTML = "Next";
     nextBtn.hidden=false;
    mysubmitbtn.hidden=true;
  }

  fixStepIndicator(n);// function that will display the correct step indicator:
  if(n==2){ 
      countTab(n); // Get Start and End Date when Tab = 2
  }

}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {

    if (y[i].name=='reg_link') {

      continue;

    }
    // If a field is empty...
    if (y[i].value.trim() == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  
}

//=============================
var ptype = $('#paymenttype').val();

//alert(ptype);

  if (ptype=="Paid"){

    validPrice=validateprice();

  }
  else{
    validPrice=true;
     document.getElementById('price-text').innerHTML="";
  }
//===============================

 if(validPrice==true){

  var keywords=$('textarea[name="keywords"]').val().trim();
  var shortdescription=$('textarea[name="shortdescription"]').val().trim();
  var longdescription=$('textarea[name="longdescription"]').val().trim();

  if(!(keywords.length=="" || shortdescription.length=="")){

    valid = true;
  }

   if(keywords.length==""){

    $('textarea[name="keywords"]').addClass("invalid");
  }
  else{

    $('textarea[name="keywords"]').removeClass("invalid"); 
  }
   if(longdescription.length<=20){

    $('textarea[name="shortdescription"]').addClass("invalid");
  }
  else{

    $('textarea[name="shortdescription"]').removeClass("invalid"); 
  }


 }else{
  valid=false;
 }
  

  // If the valid status is true, mark the step as finished and valid:
  if (valid) {

    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}



function fixStepIndicator(n) {
  // This function removes the "active" class of all steps
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  // and adds the "active" class on the current step:
  x[n].className += " active";
}

//Populate Dates from (start Date and end Date) On 3rd Tab
function countTab(n) {
  // Get Start and End Date when n = 2
    var startDate=(jQuery('#startdate').val());        
    var endDate=(jQuery('#enddate').val());
    var countdays=(jQuery('#numofdays').val());

    var newDatesArr= getDatesInArray(new Date(startDate), new Date(endDate));
    var eventtype=(jQuery('#eventtypeid').val());
//===========//Create date And Schedule Layout====================== 
    eventData=document.getElementById("eventdata");
    eventData=(JSON.parse(eventData.value));    
    getDataForUppendDateAndSchdCard(newDatesArr,eventData); //new date & (db event data)  
    $(".date-row").html("");
  

}
// this Function Return Array of Dates Betweens Start Date And End Date
var getDatesInArray = function(startDate, endDate) {
  var datesArr = [],
      currentDate = startDate,
      addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
      };
  while (currentDate <= endDate) {
    datesArr.push(currentDate);
    currentDate = addDays.call(currentDate, 1);
  }
  return datesArr;
};


//Date In YYY-MM-DD Formats
function formatDateToYMD(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
//Date In DD-MM-YYY Formats
function formatDateToDMY(date) {
      var date= new Date(date);
      var dd = String(date.getDate()).padStart(2, '0');
      var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = date.getFullYear();
      date = dd + '/' + mm + '/' + yyyy;
      return date;
}


function validateprice(){

  price=$('#price').val();

  var price=parseInt(price);
  var abc=true;

  if(!Number.isNaN(price)){

    document.getElementById('price-text').innerHTML=""; 

    //alert(price);

    if(price<50){

      document.getElementById('price-text').innerHTML="<b>Minium price 50 rupess</b>"; 
      abc = false;

    }

    return abc;

  }else{

      document.getElementById('price-text').innerHTML="<b>Minium price 50 rupess</b>"; 
  
      return false;
  }

}
</script> 
<?php 
}else{
  redirect(base_url()."login");
}

?>
