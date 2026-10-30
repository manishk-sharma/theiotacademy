<?php  
if($this->session->userdata("logged_in")){
?>
  
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<!--------------------PLUGIN OF RICH TEXT CSS------------------------------------>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/eventadmin.css">
<link rel="stylesheet" href="<?php echo asset_url()?>admin/js/richtext.min.css">
<style type="text/css">
  #prevBtn.active{
    background-color:none; 
  }
</style> 
<!-------------------------------------------------------------------------------->
<?php
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
//$currentdatetime=date('Y-m-d H:i');
 $currentdate=date('Y-m-d');

 $regstartdate = date('Y-m-d\TH:i');

 $regenddate=date("Y-m-d\TH:i", strtotime('tomorrow'));

?>
<?php
  $d="05-05-2019";
$date=date_create($d);
$newd= date_format($date,"Y/m/d");
$typeList=$this->EventTypeModel->getActiveEventTypeList();
$location=$this->EventLocationModel->getActiveLocationList();
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
        <h4 class="text-center heading mt-4 text-warning">Add New Event</h4>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-bottom:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </div>
  </div>
  <!----------MultiPart Form Start Here--------->
  <form id="myForm" name="myForm" action="<?php echo base_url()?>EventCreate/eventInsert" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
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
            <input type="text" name="route" class="form-control" required="required" title="www.theiotacademy.co/Event/Page Route show-here" />
          </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
            Intro Image:
            </div>
            <div class="col-sm-8">
               <input type="file" name="introimage"   class="form-control" required="required"  />
            </div>  
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                Main Image:
            </div>
            <div class="col-sm-8">
               <input type="file" name="mainimage"   class="form-control" required="required"  />
            </div> 
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Title:</label>
          <div class="col-sm-8">
            <input type="text" name="eventtitle" class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Type:</label>
          <div class="col-sm-8">
            <select id="eventtypeid" name="eventtypeid"   class="form-control" required="required">
              <?php 
              foreach($typeList as $row){ ?>
                <option value="<?=$row->type_id?>"><?=$row->type_title?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Location:</label>
          <div class="col-sm-8">
            <select id="inputState" class="form-control"  name="locationid">
                 <option value="0">Online</option>
              <?php foreach($location as $row){ ?>
                 <option value="<?=$row->location_id?>"><?=$row->location_title?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Open:</label>
          <div class="col-sm-8 ">
            <label class="switch">
              <input type="checkbox" value="1" id="eventopen" name="eventopen">
              <div class="slider round"></div></label>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg Open:</label>
          <div class="col-sm-8 ">
            <label class="switch"><input type="checkbox" value="1" name="regopen" id="regopen">
              <div class="slider round text-center"></div></label>
          </div>
        </div>
       
      </div> 
      <!--Right Side Form-->
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg Start date:</label>
          <div class="col-sm-8">
            <input type="datetime-local" id="regstartdate"   name="regstartdate" value="<?=$regstartdate?>"  class="form-control" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Reg End date:</label>
          <div class="col-sm-8">
            <input type="datetime-local" id="regenddate"   name="regenddate" value="<?=$regenddate?>"  class="form-control" required="required">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Event Days:</label>
          <div class="col-sm-8 ">
            <select id="eventdays" name="eventdays" class="form-control" title="Single Day / Multi Days">
                  <option value="0">Single</option>
                 <option value="1">Multi</option>
            </select>
          </div>
        </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Starts Date:</label>
            <div class="col-sm-8">
              <input type="date" name="startdate" id="startdate"   class="form-control"  required="required"/ >
              <div class="dateerrortext"> </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Ends Date:</label>
            <div class="col-sm-8">
              <input type="Date" name="enddate" id="enddate"   class="form-control" required="required"/>
            </div> 
          </div>
        <div class="form-group row"> 
          <label class="col-sm-4 col-form-label lead">No. of Days:</label>
          <div class="col-sm-8">
            <input type="number" name="dayquantity" id="numofdays"   class="form-control" placeholder="No. of Days" required="required" min="0" value="1"  readonly="readonly">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Payment types:</label>
          <div class="col-sm-8">
            <select title="Paid/Free" name="paymenttype" id="paymenttype" class="form-control" onchange="showPType();">
                 <option value="Paid" >Paid</option>
                <option value="Free">Free</option>
            </select>
          </div>
        </div>
        <div class="form-group row" id="reg_link_row">
          <label class="col-sm-4 col-form-label lead">Registration link:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" id="reg_link" class="reg_link" name="reg_link" placeholder="Optional">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Price per person:</label>
          <div class="col-sm-8">
            <input type="text" id="price" name="price"  class="form-control" placeholder="Enter Amount" pattern="\d+" required="required" title="price In Rupees"> 
            <p class="text-danger p-2" id="price-text" style="font-size: 11px;"></p>
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
              <textarea name="keywords" class="form-control"   placeholder="Keywords"  required="required"></textarea>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
              <label class="col-sm-4 col-form-label lead ">Short Description:</label>
              <div class="col-sm-8">
                <textarea name="shortdescription" cols="" rows=""   class=" form-control" placeholder="Description In Short"  required="required"></textarea>
              </div>
          </div>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label lead">Long Description:</label>
          <div class="col-sm-10">
              <textarea name="longdescription"   class=" rich-content form-control" cols="4" rows="4"required="required"></textarea>
          </div>
      </div>
  </div>
    <!---Third Tab-->
  <div class="tab">
    <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url();?>">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center lead">Event Dates And Schedules</h3>
            <!---------Accordian Data Populate Here ------------->
            <div class="accordion" id="accordionForDaysAndSchedules">
              
            </div>
        </div>
    </div>
    
  </div>
  <div class="row p-4">
    <div class="col-sm-8"></div>
      <div class="col-sm-2">
          <button class="form-control btn-info" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      </div>
     <div class="col-sm-2 nextBtnDiv">
        <button class="form-control btn btn-warning " type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <input type="Submit" name="mysubmitbtn" class="  btn-success form-control" id="mysubmitbtn" value="Submit" hidden="hidden" />
     </div>
  </div>

</div>    
<!---------Multi Part Form End Hre------------>

  </form> 

<?php $this->load->view("admin/commons/adminfooter.php") ;?>

<!-----------------------------PLUGIN OF RICH TEXT JS  start---------------------------------------->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url()?>admin/js/inserteventcomponents.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/addeventspeakerajax.js"></script>
<script type="text/javascript" src="<?php echo asset_url()?>admin/js/jquery.richtext.js"></script>
<script>
        $(document).ready(function() {
            $('.rich-content').richText();
        });
</script>
<!--------------------PLUGIN OF RICH TEXT JS end---------------->
<!--------------Submit Form Validation----------->
<script type="text/javascript">

  var reg_link_row=document.getElementById("reg_link_row");

      reg_link_row.style.display="none";

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
        } 
    }
    //--------------------for Curren date and time--------------------
    currentdate=new Date();
    var currentstartdate=document.getElementById('startdate');
    var currentenddate=document.getElementById('enddate');
    currentstartdate.valueAsDate =currentdate;     //start date As  current date  
    currentenddate.valueAsDate =currentdate;       //end date As  current date 

    var eventdays=document.getElementById("eventdays");
    if (eventdays.value==0) {
          //jQuery('#enddate').val('');
          currentenddate.readOnly = true;
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

    if(y[i].name=='reg_link'){
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
 
  
  
   

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  // and adds the "active" class on the current step:
  x[n].className += " active";
}
//=================================================================================

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

//Populate Dates from (start Date and end Date) On 3rd Tab
function countTab(n) {
    var startDate=(jQuery('#startdate').val());        
    var endDate=(jQuery('#enddate').val());
    var countdays=(jQuery('#numofdays').val());
    var datesArrr = getDatesInArray(new Date(startDate), new Date(endDate));
    var eventtype=(jQuery('#eventtypeid').val());
    generateEventLayout(datesArrr,countdays);//Create date And Schedule Layout 
    $(".date-row").html("");   
}
// this Function Return Array of Dates Betweens Start Date And End Date
var getDatesInArray = function(startDate, endDate){
  var datesArrr = [],
      currentDate = startDate,
      addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
      };
  while (currentDate <= endDate) {
    datesArrr.push(currentDate);
    currentDate = addDays.call(currentDate, 1);
  }
  return datesArrr;
};


</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>
