<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<?php $batchdays=$this->BatchDaysModel->getBatchDaysById($batch_days_id);
?>
<style type="text/css">
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
  .form-check-input{
    margin-top:12px;
    margin-left:8px;
  }
  .checkboxlabel{
    margin-left:22px;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Update Batch Info</h4>
  <h4 class="text-center heading">(Batch ID: <?=$batch_id?>)</h4>
  <br>
  <form action="<?php echo base_url()?>update-batch" method="post">
    <input type="hidden" name="btcid" value="<?=$btc_id?>"/>
    <input type="hidden" name="batchid" value="<?=$batch_id?>"/>
    <input type="hidden" name="batchdaysid" value="<?=$batch_days_id?>"/>
    <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url();?>">


    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Course :</label>
          <div class="col-sm-8">
            <?php $courselist=$this->CourseModel->getActiveCoursesList()?>
            <select name="courseid" id="courseid" class="form-control">
              <?php foreach($courselist as $course){
                    if($course->course_id==$course_id){
              ?>
                <option value="<?=$course->course_id?>" selected="selected"><?=$course->cs_id?>-<?=$course->course_title?></option>
              <?php }else{ ?>
                <option value="<?=$course->course_id?>"><?=$course->cs_id?>-<?=$course->course_title?></option>
              <?php } }?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Faculty:</label>
          <div class="col-sm-8">
            <?php $emplist=$this->EmployeeModel->getEmployeeList()?>
            <select name="facultyid" class="form-control">
              <?php foreach($emplist as $emp){
                    $user=$this->UserModel->getUserShortInfoById($emp->user_id) ;
                    if($user['user_type_id']==3){
                      if($user['user_id']==$faculty_id){
              ?>
                <option value="<?=$emp->user_id?>" selected="selected"><?=$emp->employee_id?>-<?=$emp->first_name." ".$emp->last_name?></option>
              <?php }else{ ?>
                <option value="<?=$emp->user_id?>"><?=$emp->employee_id?>-<?=$emp->first_name." ".$emp->last_name?></option>
              <?php }}} ?>
            </select>
          </div>
        </div>
        
         <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Total Seats:</label>
          <div class="col-sm-8">
            <input type="number" name="totalseats" class="form-control" placeholder="Total Seats" value="<?=$total_seats?>" required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Start Date</label>
          <div class="col-sm-8">
            <input type="date" id="startdate" name="startdate" class="form-control" value="<?=$start_date?>" required="required"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">End Date:</label>
          <div class="col-sm-8">
            <input type="date" id="enddate" name="enddate" class="form-control" value="<?=$end_date?>" required="required"  />
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Start Time</label>
          <div class="col-sm-8">
            <input type="time" id="starttime" name="starttime" class="form-control" required="required" value="<?=$lecture_start_time?>" placeholder="Start Time"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">End Time:</label>
          <div class="col-sm-8">
            <input type="time"  id="endtime" name="endtime" class="form-control" required="required" value="<?=$lecture_end_time?>" placeholder="End Time"/>
          </div>
        </div>
       
      </div>
      <div class="col-sm-6">

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Batch Name:</label>
          <div class="col-sm-8">
            <input type="text" name="batchname" class="form-control" placeholder="Enter Batch Name" value="<?=$batch_name?>" required="required"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">ClassRoom:</label>
          <div class="col-sm-8">
            <?php $crlist=$this->ClassRoomModel->getClassRoomList()?>
            <select name="crid" id="classroom" class="form-control">
              <?php foreach($crlist as $cr){
                    if($cr->cr_id==$cr_id){
              ?>
                <option value="<?=$cr->cr_id?>" selected="selected"><?=$cr->classroom_id?>: <?=$cr->title?></option>
              <?php }else{ ?>
                <option value="<?=$cr->cr_id?>"><?=$cr->classroom_id?>: <?=$cr->title?></option>
              <?php }} ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Training Mode:</label>
          <div class="col-sm-8">
            <select name="trainingmode" id="trainingmode" class="form-control">
              <?php if($training_mode=='Online'){?>
                <option value="Offline">Offline</option>
                <option value="Online" selected="selected">Online</option>
              <?php }else{ ?>
                <option value="Offline" selected="selected">Offline</option>
                <option value="Online">Online</option>
              <?php }?>
            </select>
          </div>
        </div>

         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Duration(in Hrs):</label>
            <div class="col-sm-8">
             <input type="number" id="duration" name="duration" class="form-control" placeholder="Enter Online Duration In Hours" required="required" value="<?=$duration?>"/>
              <input type="hidden" name="durationHidden" id="durationHidden">
            </div>
         </div>

        

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">No. of Weeks:</label>
          <div class="col-sm-8">
            <input type="number" id="daysquantity" name="daysquantity" class="form-control" placeholder="Days Quantity" onkeyup="updateDurations()" required="required" value="<?=$days_quantity?>" min="1" readonly="true">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Hours Per Day:</label>
          <div class="col-sm-8">

             <input type="number" id="hoursperday" name="hoursperday" class="form-control" placeholder="Hours Per Day" onkeyup="updateDurations()" required="required" step=".5" value="<?=$hours_per_day?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Remark:</label>
          <div class="col-sm-8">
            <input type="text" name="remark" class="form-control" placeholder="Enter Remark" value="<?php if($remark!='nill') echo($remark);?>" />
          </div>
        </div>

      </div>


    </div>
    <div class="form-group row">
          <label class="col-sm-2 col-form-label lead">Batch Days:</label>
          <div class="col-sm-9">
            <div class="row">
              <!-- <div class="col-sm-2">
                <input type="checkbox" name="checkedAll" id="checkedAll" class="form-check-input checkSingle" onchange="handleCheckBox(this);"/>
                <label class="col-form-label lead checkboxlabel">Check all</label>
              </div> -->
              <div class="col-sm-2">
                <?php if($batchdays['monday']==1){?>
                <input type="checkbox" name="monday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="monday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Monday</label>
             </div>
              <div class="col-sm-2">
                <?php if($batchdays['tuesday']==1){?>
                <input type="checkbox" name="tuesday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="tuesday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Tuesday</label>
               </div>
              <div class="col-sm-2">
                <?php if($batchdays['wednesday']==1){?>
                <input type="checkbox" name="wednesday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="wednesday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Wednesday</label>
              </div>
              <div class="col-sm-2">
                <?php if($batchdays['thrusday']==1){?>
                <input type="checkbox" name="thrusday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="thrusday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Thrusday</label>
            </div>

              <div class="col-sm-2">
                <?php if($batchdays['friday']==1){?>
                <input type="checkbox" name="friday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="friday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Friday</label>
             </div>
            </div>
            <div class="row">
              
              <div class="col-sm-2">
                <?php if($batchdays['saturday']==1){?>
                <input type="checkbox" name="saturday" class="form-check-input" onchange="handleCheckBox(this);" checked />
                <?php }else{?>
                <input type="checkbox" name="saturday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Saturday</label>
            </div>

              <div class="col-sm-3">
               <?php if($batchdays['sunday']==1){?>
                <input type="checkbox" name="sunday" class="form-check-input" onchange="handleCheckBox(this);" checked/>
                <?php }else{?>
                <input type="checkbox" name="sunday" class="form-check-input" onchange="handleCheckBox(this);"/>
                <?php }?>
                <label class="col-form-label lead checkboxlabel">Sunday</label>
                </div>

              <div class="col-sm-3">
                <input type="hidden"  name="daysperweek" id="daysperweek" value="0"/>
              </div>
            </div>
          </div>
        </div>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center mb-4">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
      
    </div>
    
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript" src="<?=asset_url()?>js/ajax/getCourseModuleHourAjax.js"></script>

<script type="text/javascript">

    var currentdate=new Date();
    var currentstartdate=document.getElementById('startdate');
    currentstartdate.valueAsDate =currentdate;    //start date As  current date  
    
  $(function(){

   
    $("#courseid").change(function () {

        getCourseModuleListAjax(this.value);

    });

    $("#classroom").change(function () {

      if($(this).val()==4)
        
        $('#trainingmode').val('Online');

    });
    

    var time1=(jQuery('#starttime').val());        
    var time2=(jQuery('#endtime').val());       
    var diffTime=timeDiff(time1,time2);//time calculation

    jQuery('#hoursperday').val(diffTime); // set Value in  hours per day field


    jQuery('#starttime,#endtime').change(function()
    {   
        
        time1=(jQuery('#starttime').val()); 

        time2=(jQuery('#endtime').val());  

        diffTime=timeToDecimal(timeDiff(time1,time2));//time calculation

        jQuery('#hoursperday').val(diffTime); // set Value in  hours per day field
  });

        time1=(jQuery('#starttime').val()); 

        time2=(jQuery('#endtime').val());  

        diffTime=timeToDecimal(timeDiff(time1,time2));//time calculation

        jQuery('#hoursperday').val(diffTime); // set Value in  hours per day field  

function timeDiff(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);

    // If using time pickers with 24 hours format, add the below line get exact hours
    if (hours < 0)
       hours = hours + 24;

    return (hours <= 9 ? "0" : "") + hours + ":" + (minutes <= 9 ? "0" : "") + minutes;
}

function timeToDecimal(t) {
    var arr = t.split(':');
    var dec = parseInt((arr[1]/6)*10, 10);

    return parseFloat(parseInt(arr[0], 10) + '.' + (dec<10?'0':'') + dec);
} 


    $('#duration').on('input paste change ', function(e) {
     
      var durationHidden=parseInt($('#durationHidden').val());

      var duration=parseInt($(this).val());

      if(duration<durationHidden){

        alert("Not less than actual duration");

        $(this).val(durationHidden);

      }
      else if(duration>durationHidden){

          $("input:checkbox").prop('checked', $(this).prop("checked"));

          $('#daysquantity').val(0);
      }

    });


  });


  function updateDurations(daysperweek){

    var duration=parseInt($('#duration').val());

    var hoursperday = parseInt($('#hoursperday').val());

    var daysquantity=parseInt($('#daysquantity').val());

    var weekduration=hoursperday*daysperweek;

    var numofdays=(duration/weekduration);

    $('#daysquantity').val(Math.round(numofdays));

    //alert(Math.round(numofdays/7));
    
  }

</script>
<script type="text/javascript">

  

  function handleCheckBox(checkbox){

    var hoursperday = parseFloat($('#hoursperday').val());

    if(hoursperday>0){

        var duration=parseInt($('#duration').val());
        var daysperweek=document.getElementById("daysperweek") ;

        if(checkbox.checked == true){

            daysperweek.value=parseInt(daysperweek.value)+1 ;

        }else{

            daysperweek.value=parseInt(daysperweek.value)-1 ;

            if(daysperweek.value<0){

              daysperweek.value=0 ;
            }
        }
        updateDurations(daysperweek.value);
      }else{
        checkbox.checked =false;
        alert('Plz slecet start and end time frist');
      }  
    }
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>