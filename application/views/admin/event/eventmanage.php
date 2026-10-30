<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .cust_color{
    background: rgb(246,133,27);
  }
  .schdcardstyle{ 
    border:2px solid grey ;
    padding:10px;
    border-radius:25px;
  }
  .cross-btn{
    border-radius:25px!important;
  }
    .switch {
  position: relative;
  display: inline-block; 
  width: 90px;
  height: 34px;
}
.date-card-header{
      border: none;
      color: #ffff;
      padding:10px 0px;
      background: #fff;
      overflow: hidden;
      font-weight: bold;
      border-radius: 5px;
      border-color: #f4511e;
      font-family: "Roboto", sans-serif;
     background-color: #00bfb2;
 background-image: linear-gradient(to right, #614385 0%, #516395 51%, #614385 100%);
  }
  .date-card-header:hover{
     background-position: right center;
  }
  .card-inner{
    border-left:2px solid #614385;
    border-right:2px solid #614385;
  }

  .tia-event-day-date{
    width:100px;
    font-size:12px;
  } 
  .tia-schedule-table{
    width:100%; 
    font-size:12px;
  }
  .speaker-style{
    text-transform:capitalize;
  } 
  .tia-sch-table-title{
    text-decoration:underline;
    font-size:16px;
    text-align:center;
  }
  b{font-size: 15px;}
  .lh-50{
      line-height:60px ! important;
  }
  .modal-gradient
  {
      background: rgb(95,52,235);
      background: linear-gradient(90deg, rgba(95,52,235,1) 16%, rgba(181,39,241,1) 42%, rgba(215,37,90,1) 92%); color: white;
  }

  .pagination .active{
    color: #ff3115!important;
  }
  
  .pagination a{
    color:#3e206d; 
    padding:10px;
    margin: 2px;
    font-weight: bolder;
    text-decoration: none;
  }

  .pagination a:hover{
    text-decoration: underline;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Event Management</h4>
  <br>
  <div class="text-right">
    <a href="<?=base_url().'add-event'?>"class="btn btn-primary btn-sm"><strong><i class="fas fa-user-plus"></i>Add New Events</strong></a>
  </div> 

  <div class="accordion" id="accordionExample">

<div class="row ">
  <div class="col-sm-9">
  </div>
  <div class="col-sm-3">
      <nav aria-label="Page navigation example">
          <span class="pagination float-right">
              <?php print_r($data['links']); ?>
          </span>
      </nav><!-- .navigation end -->
  </div>
</div>
   <?php 
   date_default_timezone_set("Asia/Calcutta");
  foreach($data['results'] as $row){ 
   $eventtypeid=$row->event_type_id;
   $eventlocationid=$row->event_location_id;

//check the event type ongoing/upcoming/past
  $eventstatus=$row->event_flag;
  $status=$row->status;
    if ($eventstatus==1 and $status==1) {
      $eventstatus='  <b style=color:Orange;>Upcoming</b>';
    }
    elseif ($status==0) {
      $eventstatus='  <b style=color:red;>Disabled</b>';
    }

    if($eventstatus==2 and $status==1){
      $eventstatus='  <b style=color:green;>On-Going</b>';
    }
    elseif ($status==0) { 
      $eventstatus='  <b style=color:red;>Disabled</b>';
    }
    
    if($eventstatus==3 and $status==1){
      $eventstatus='  <b style=color:darkred;>Past</b>';
    }
    elseif ($status==0) {
      $eventstatus='  <b style=color:red;>Disabled</b>';
    }
   $eventtype=$this->EventTypeModel->getEventTypeTitleById($eventtypeid);           
  ?> 
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class=""><?=$row->event_id; ?> </td>
            <td ><?=$row->event_title.$eventstatus?><br>Event Type : <?=$eventtype?> </td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Start Date: <?=date('d-m-Y',strtotime($row->start_date))?>, End Date: <?=date('d-m-Y',strtotime($row->end_date))?></td>
            <?php
                  if ($eventtypeid==4) {?>
                    <td class="text-right buttoncol">
                      <button type="button" class="btn btn-success btn-sm text-center" 
                                data-toggle="modal" 
                                data-target="#addScheduleSpeakerModal"
                                data-eveid="<?=$row->event_id?>" disabled>
                      <strong><i class="fa fa-plus" title="Industrial Visit " ></i></strong>
                      </button>
                    </td>
                 <?php }
                 else{?>
                  <td class="text-right buttoncol">
                    <button type="button" class="btn btn-success btn-sm text-center" 
                              data-toggle="modal" 
                              data-target="#addScheduleSpeakerModal"
                              data-eveid="<?=$row->event_id?>">
                    <strong><i class="fa fa-plus" title="Add Schedule And Speaker" ></i></strong>
                    </button>
                  </td>
                <?php } ?>
            <td class="text-right buttoncol">
               <a href="<?=base_url().'Event/edit_event/'.$row->event_id?>" class="btn btn-warning btn-sm" title="Edit Event"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol">
               <button type="button" class="btn btn-info btn-sm text-center" data-toggle="modal" data-target="#EventStatusModel" title="Change Status" data-eventid="<?=$row->event_id?>"><strong><i class="fa fa-bolt" aria-hidden="true"></i></strong></button>
            </td>
          </tr>
          <tr>
            <td colspan="3"  class="text-right buttoncol pt-2">
                <?php if($row->status==1){ ?>
              <a href="<?=base_url().'EventCreate/enableDisableEvent/'.$row->event_id.'/0'?>" class="btn btn-success btn-sm" title="Hide/Show Event"><i class="fas fa-eye"></i></a>
              <?php }else{?>
              <a href="<?=base_url().'EventCreate/enableDisableEvent/'.$row->event_id.'/1'?>" class="btn btn-danger btn-sm" title="Hide/Show Event"><i class="fas fa-eye-slash"></i></a>
              <?php }?>
            </td>
             <td class="text-right buttoncol pt-2">
              <a href="<?php echo base_url()?><?=$row->route?>" target="_blank" class="btn btn-info btn-sm " type="button"  title="view Page"><i class="fas fa-external-link-alt"></i></a>
            </td>
            <td class="text-right buttoncol pt-2">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->event_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
          <tr>
            <td colspan="3" class="text-right buttoncol pt-2">
                <a href="EventCreate/duplicateEvent/<?=$row->event_id?>" class="btn btn-success btn-sm text-white"  title="Copy Event">
                    <i class="fas fa-copy"></i>
                </a>
            </td>

            <td  class="text-right buttoncol pt-2">
                <button class="btn btn-danger btn-sm" type="submit" name="remove_levels" value="delete" title="Delete Event" data-event-id="<?=$row->event_id?>" data-toggle="modal" data-target=".deleteModol" >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>

          </tr>
        </tbody>
        </table>
      </h2>
    </div>
    <div id="collapseOne<?=$row->event_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
            <div class="row">
                 <div class="col-sm-4 text-center">
                   <h6 class="text-center">Intro Image</h6>
                   <img src="<?=event_intro_image_url().$row->intro_image?>" height="200px" width="100%"/>
                   <form action="<?=base_url().'EventCreate/ReplaceIntroImage/'.$row->event_id?>" method="post" enctype="multipart/form-data">
                     <input type="file" class="form-control" name="introimage" required="required"  title="Required Size 100X300 PX"/>
                     <u>Required Size</u> 100X300 px<br> 
                     <input type="submit" value="Change Intro Image" class="text-right btn btn-warning btn-sm"/>
                   </form>
                 </div>
                 <div class="col-sm-8 text-center">
                   <h6 class="text-center">Main Image</h6>
                   <img src="<?=event_main_image_url().$row->main_image?>" height="200px" width="100%"/>
                   <form action="<?=base_url().'EventCreate/ReplaceMainImage/'.$row->event_id?>" method="post" enctype="multipart/form-data">
                     <input type="file" class="form-control" name="mainimage" required="required" title="Required Size 100X300 PX"/>
                     <u>Required Size</u> 1024 X 600 px
                     <input type="submit" value="Change Main Image" class="btn btn-warning btn-sm"/>
                   </form>
                 </div>
            </div>
        <div class="row">
          <div class="col-sm-6">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Event Type: </td>
                  <td class="text-center"><?=$eventtype;?></td>
                </tr>
                <tr>
                  <?php
                  $eventlocation['location_title']="Online"; 
                  if($eventlocationid>0){

                    $eventlocation=$this->EventLocationModel->getLocationTitleById($eventlocationid);
                  }
                  

                  ?>
                  <td class="cbtablecol">Location:</td>
                  <td class="text-center"><?=$eventlocation['location_title'];?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Starts From:</td>
                  <td class="text-center"><?=date('d-m-Y',strtotime($row->start_date))." At "."10:00AM"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Ends On:</td>
                  <td class="text-center"><?=date('d-m-Y',strtotime($row->end_date))." At "."6:00PM"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Days:</td>
                  <td class="text-center"><?=$row->days_quantity?> Day(s)</td>
                </tr>
                <tr>
                  <td class="cbtablecol">Reg Start Date:</td>
                  <td class="text-center"><?=$row->reg_start_dt?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Payment Type:</td>
                  <td class="text-center"><?=$row->payment_type?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Price:</td>
                  <td class="text-center"><?=$row->price?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-6">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Event Status</td>
                  <td class="text-center"><?=$eventstatus?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Event open:</td>
                  <?php
                    $value=$row->event_open;
                    if ($value==1) {
                     $checkvalue='Yes' ;
                    }
                    else
                      $checkvalue='No';
                  ?>
                  <td class="text-center"><?=$checkvalue?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Reg Open</td>
                  <?php
                    $value=$row->reg_open;
                    if ($value==1) {
                     $checkvalue='Yes' ;
                    }
                    else
                      $checkvalue='No';
                  ?>
                  <td class="text-center"><?=$checkvalue?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <?php
                    $value=$row->status;
                    if ($value==1) {
                     $checkvalue='Enabled' ;
                    }
                    else
                      $checkvalue='Disabled';
                  ?>
                  <td class="text-center"><?=$checkvalue;?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Created On:</td>
                  <td class="text-center"><?=$row->created_on?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Last Updated On:</td>
                  <td class="text-center"><?=$row->last_updated_on?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

<!----------------------------------->
<h5 class="text-center text-warning font-weight-bold mb-4">Event Date And Schedule</h5>
<div id="accordion">
  <?php
    $eventdayslist=$this->EventDaysModel->getScheduledEventDaysListByEventId($row->event_id);
    if(count($eventdayslist)>0){
      $daycount=0;
      foreach ($eventdayslist as $edrow) { 
        $daycount++;
        $dayidstring="dateheadingOne".$daycount;
        $daycollapse="daycollapse".$daycount;
        $daydate=date('d-m-Y',strtotime($edrow->day_date));
  ?>
  <div class="card mb-1" id="datecard">
    <div class="card-header date-card-header" id="<?=$dayidstring?>">
      <h5 class="ml-4 mb-0">
        <button class="btn btn-link text-white font-weight-bold" data-toggle="collapse" data-target="#<?=$daycollapse?>" aria-expanded="true" aria-controls="<?=$daycollapse?>">
          <?=$daydate?>
        </button>
       <!-- <?php if($edrow->status==1){ ?>
        <a href="<?=base_url().'EventDays/enableDisableDate/'.$row->event_id.'/'.$edrow->day_id.'/0'?>" class="btn btn-sm btn-success float-right mr-2" title="Hide/Show Schedule"><i class="fas fa-eye"></i></a>
        <?php }else{?>
        <a href="<?=base_url().'EventDays/enableDisableDate/'.$row->event_id.'/'.$edrow->day_id.'/1'?>" class="btn btn-sm btn-danger float-right mr-2" title="Hide/Show Schedule"><i class="fas fa-eye-slash"></i></a>
      <?php }?> -->
      </h5>
    </div>
    <div id="<?=$daycollapse?>" class="collapse" aria-labelledby="<?=$dayidstring?>" data-parent="#accordion">
      <div class="card-body card-inner">
    <?php
     $schedulelist=$this->EventScheduleModel->getEventScheduleByDayId($edrow->day_id);
     if(count($schedulelist)>0){
      foreach ($schedulelist as $schdrow) {
       $schdcount=$schdrow->schd_id ;
        $schdcountstring="date".$daycount."schd".$schdcount;?>
        <div class="row schdcardstyle mb-2">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center"  scope="col">#</th>
                <th class="text-center" scope="col">Start Time</th>
                <th class="text-center" scope="col">End Time</th>
                <th class="text-center" scope="col">Speaker</th>
                <th class="text-center" scope="col">Title</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-center" scope="row"><?=$schdcount?></th>
                <td class="text-center"><?=$schdrow->start_time?></td>
                <td class="text-center"><?=$schdrow->end_time?></td>
                <?php if($schdrow->speaker_type=="guest"){
                            $speaker_name=$this->EventGuestSpeakerModel->getGuestSpeakerNameById($schdrow->speaker_id);
                            $speaker_name=$speaker_name." (".$schdrow->speaker_type." Speaker)";
                          }else{
                            $speaker_name=$this->EmployeeModel->getEmployeeFullNameById($schdrow->speaker_id);
                          } ?>
                <td class="text-center"><?=$speaker_name?></td>
                <td class="text-center"><?=$schdrow->title?></td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <thead>
              <tr>
                <?php
                  if ($schdrow->schd_photo=='nil') {
                    $schdrow->schd_photo='defaultschd.png';
                }?>
                <th class="text-center" scope="col">Schd Pic</th>
                <th class="text-center" scope="col">Description</th>
                <th class="text-center" scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-center" scope="col">
                  <img src="<?=schd_pic_url().$schdrow->schd_photo?>" alt="schd-icon" height="60" width="60">
                </th>
                <td class="text-center text-justify"><?=$schdrow->description?></td>
                <td>
                  <?php if($schdrow->status==1){ ?>
                  <a href="<?=base_url().'EventSchedule/enableDisableSchedule/'.$schdrow->schd_id.'/0'?>" class="btn btn-success btn-sm" title="Hide/Show Schedule"><i class="fas fa-eye"></i></a>
                  <?php }else{?>
                  <a href="<?=base_url().'EventSchedule/enableDisableSchedule/'.$schdrow->schd_id.'/1'?>" class="btn btn-danger btn-sm" title="Hide/Show Schedule"><i class="fas fa-eye-slash"></i></a>
                  <?php }?>
                </td>
               <td class="text-center">
                  <button class="btn btn-warning btn-sm lh-50" 
                          data-target="#updateScheduleSpeakerModal"
                          title="Update Schedule & Speaker" data-toggle="modal" 
                          data-eventid="<?=$row->event_id?>"
                          data-schdid="<?=$schdrow->schd_id?>"
                          data-eventid="<?=$row->event_id?>"
                          data-daydate="<?=$daydate?>"
                          data-dateid="<?=$schdrow->day_id?>"
                          data-eventspeakerid="<?=$schdrow->speaker_id?>"
                          data-eventspeakertype="<?=$schdrow->speaker_type?>"
                          data-schd-photo="<?=$schdrow->schd_photo?>"
                          data-title="<?=$schdrow->title?>"
                          data-description="<?=$schdrow->description?>"
                          data-start-time="<?=$schdrow->start_time?>"
                          data-end-time="<?=$schdrow->end_time?>">
                    <i class="fas fa-edit" ></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      
      <?php } } ?>
      </div>
    </div>
  </div>
<?php } } ?>
</div>
      </div>
    </div>
  </div>
<?php } ?>
<!----------------Pagination Start Here-------------------->
<div class="row ">
  <div class="col-sm-9">
  </div>
  <div class="col-sm-3">
      <nav aria-label="Page navigation example">
          <span class="pagination float-right">
              <?php print_r($data['links']); ?>
          </span>
      </nav><!-- .navigation end -->
  </div>
</div>
<!----------------Pagination End Here----------------------------------------->
</div>
<br>
</div>



<!-------------Delete Modal-------------->
<div class="modal fade deleteModol" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-gradient">
        <div class="modal-body">
          Are you sure?
           <input type="hidden" name="event_id" id="event_id">
           <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url();?>">
        </div>
        <div class="modal-footer">
          <a id="deleteurl" href="<?php echo base_url().'EventCreate/DeleteEvent/'.$row->event_id?>" class="btn btn-danger"> Delete </a>
          <a type="button" data-dismiss="modal" class="btn"> Cancel</a>
        </div>
    </div>
  </div>
</div>
<!--------------------Delete Modal End Here----------------->

<?php $this->load->view("admin/commons/adminfooter.php") ;?> 
<!-- Modal for adding schedule & speaker -->
<div class="modal fade" id="addScheduleSpeakerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="show" role="document">
      <div class="modal-content modal-gradient">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add Schedule And Speaker</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                  <form action="<?php echo base_url()?>submit-schedule" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <div class="col-sm-6 row">
                          <input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url()?>"/>
                            <label class="col-sm-5 col-form-label">Event Id:</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control" id="eventid" name="eventid" value="" readonly="readonly" required="required">
                                  </div>
                        </div>
                        <div class="col-sm-6 row">
                            <label class="col-sm-5 col-form-label">Title:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="title" name="title" required="required">
                            </div>  
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-6 row">
                            <label class="col-sm-5 col-form-label">Event Days:</label>
                            <div class="col-sm-7"> 
                                  <!--populate days by List ajax-->   
                              <select name="dayid" class="form-control" id="dayid"></select>    
                            </div> 
                          </div>
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">Desc:</label>
                              <div class="col-sm-7">
                                  <textarea rows="2" class="form-control" name="description" id="description" title=" write description here" placeholder="description" required="required"></textarea>
                              </div>
                          </div>                           
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">Start-Time:</label>
                              <div class="col-sm-7">
                                  <input type="time" class="form-control" id="starttime" name="starttime" value="starttime" required="required"/>
                              </div>
                          </div>
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">End-Time:</label>
                              <div class="col-sm-7">
                                  <input type="time" id="endtime" class="form-control" name="endtime" value="starttime" required="required"/>
                              </div>
                          </div>
                      </div> 
                      <div class="form-group row">
                        <div class="col-sm-6 row">
                            <label class="col-sm-5"> Speaker Type</label>
                            <div class="col-sm-7">
                                <select name="eventspeakertype" id="eventspeakertype" class="form-control" onchange="updateActiveEventSpeakerList(this,document.getElementById('eventspeakerid'))">
                                      <option value="employee">Employee</option>
                                      <option value="guest">Guest</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 row">
                            <label class="col-sm-5"> Event Speaker</label>
                            <div class="col-sm-7">
                                <select name="eventspeakerid" class="form-control" id="eventspeakerid">
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 row">
                            <label class="col-sm-5"> Upload Photo</label>
                            <div class="col-sm-7">
                                <input type="file" id="photo" class="form-control" name="schdphoto" required="required"/>
                            </div>
                            <b class="ml-3" style="color:darkred">* Max size should Be 100px X 100px</b>
                        </div>
                        <div class="col-sm-6 row">
                          <label class="col-sm-5"> </label>
                            <div class="col-sm-7 text-center">
                                <button type="submit" name="submit" class="btn btn-success ">Submit</button>
                            </div>
                        </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<!-----------------------Update Schedule And Speaker----->
<div class="modal fade" id="updateScheduleSpeakerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="show" role="document">
      <div class="modal-content modal-gradient" >
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Update Schedule And Speaker (Event Id: <span id="dispeventid"></span>)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" >
              <div class="container-fluid">
                  <form action="<?php echo base_url()?>update-schedule" method="post" enctype="multipart/form-data">
                      <input type="hidden" id="upeventid" name="upeventid"/>
                      <input type="hidden" id="updateid" name="updateid"/>
                      <div class="form-group row">
                        <div class="col-sm-6 row">
                            <label class="col-sm-5 col-form-label">Schedule Id:</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control" id="upscheduleid" name="upscheduleid" value="" readonly="readonly" required="required">
                                  </div>
                        </div>
                        <div class="col-sm-6 row">
                            <label class="col-sm-5 col-form-label">Title:</label>
                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" id="uptitle" name="uptitle" required="required">
                                  </div>  
                        </div>

                      </div>
                      <div class="form-group row">
                          <div class="col-sm-6 row">
                            <label class="col-sm-5 col-form-label">Schedule Date:</label>
                            <div class="col-sm-7">
                            <select name="updateid" class="form-control" id="updayid"></select>
                            </div>
                        </div>
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">Description:</label>
                              <div class="col-sm-7">
                                  <textarea rows="2" class="form-control" name="updescription" id="updescription" placeholder="description"></textarea>
                              </div>
                          </div> 
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">Start-Time:</label>
                              <div class="col-sm-7">
                                  <input type="time" class="form-control" id="upstarttime" name="upstarttime"  required="required"/>
                              </div>
                          </div>
                          <div class="col-sm-6 row">
                              <label class="col-sm-5">End-Time:</label>
                              <div class="col-sm-7">
                                  <input type="time" id="endtime" class="form-control" name="upendtime"  required="required"/>
                              </div>
                          </div>
                      </div> 
                      <div class="form-group row">
                        <div class="col-sm-6 row">
                            <label class="col-sm-5"> Speaker Type</label>
                            <div class="col-sm-7">
                                <select name="upeventspeakertype" id="upeventspeakertype" class="form-control" onchange="updateActiveEventSpeakerList(this,document.getElementById('upeventspeakerid'))">
                                      <option value="employee">Employee</option>
                                      <option value="guest">Guest</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-sm-6 row">
                            <label class="col-sm-5"> Event Speaker</label>
                            <div class="col-sm-7">
                                <select id="upeventspeakerid" name="upeventspeakerid" class="form-control">
                                </select>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                            <div class="col-sm-6 row">
                                <div class="col-sm-12" style="line-height:70px;">
                                    Scheduled Pic: <img src="<?=schd_pic_url().$schdrow->schd_photo?>" class="text-center ml-4 img-responsive profile-pic" title="Current Profile"  height="70" width="70"/>
                                </div>
                            </div>
                            <div class="col-sm-6 row mt-3" id="schdphoto">
                                <label class="col-sm-5"> Upload Photo</label>
                                <div class="col-sm-7">
                                    <input type="file"  class="form-control" name="schdphoto"/>
                                </div>
                                <b class="ml-3" style="color:darkred; line-height:20px;">* Max size should Be 100px X 100px</b>
                            </div>
                            <div class="col-sm-6 row">
                                <div class="col-sm-12" style="line-height:40px;">
                                    Do You Want To Upload New Photo? 
                                    <input type="checkbox" name="checkphoto" value="1" class="ml-4" onchange="handleCheckBox(this);">
                                </div>
                            </div>
                            <div class="col-sm-6 row mt-4">
                              <label class="col-sm-5"> </label>
                                <div class="col-sm-7 text-center">
                                    <button type="submit" name="submit" class="btn btn-success ">Submit</button>
                                </div>
                            </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<!-------Update Schedule and speaker end here------------>
<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/addeventdaysajax.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/addeventspeakerajax.js"></script>
<script type="text/javascript">
  
//populate data in add shedule model   
$( document ).ready(function() {
      $('.popover-dismiss').popover({
      trigger: 'focus'
    });
  $('#EventStatusModel').on('show.bs.modal', function(e) {
        var eventId = $(e.relatedTarget).data('eventid');
        $(e.currentTarget).find('input[name="eventflagid"]').val(eventId);  
        $('#eventid').html(eventId);
      });
 
  $('#addScheduleSpeakerModal').on('show.bs.modal', function(e) {
       var eventid= $(e.relatedTarget).data('eveid');
       $(e.currentTarget).find('input[name="eventid"]').val(eventid);
       var dayslist=document.getElementById("dayid");
       var speaker_type=document.getElementById("eventspeakertype");
       var eventspeakeridlist=document.getElementById("eventspeakerid");

       updateEventDaysList(eventid,dayslist);
       updateActiveEventSpeakerList(speaker_type,eventspeakeridlist);
  });  

  $('#updateScheduleSpeakerModal').on('show.bs.modal', function(e) {
      var schdid= $(e.relatedTarget).data('schdid');
      var eventid= $(e.relatedTarget).data('eventid');
      var dayslist=document.getElementById("updayid");
      var title=  $(e.relatedTarget).data('title');
      var description=$(e.relatedTarget).data('description');
      var starttime=$(e.relatedTarget).data('start-time');
      var endtime  =$(e.relatedTarget).data('end-time');
      var daydate= $(e.relatedTarget).data('daydate');
      var eventspeakertype= $(e.relatedTarget).data('eventspeakertype');
      var schd_photo=$(e.reletedTarget).data('schd-photo');
      var eventspeakerid= $(e.relatedTarget).data('eventspeakerid');
      var eventiddisp=document.getElementById("dispeventid");
      var updaydate=document.getElementById("updaydate");
      var conceptName = $('#upeventspeakerid').find(":selected").val();
      $(e.currentTarget).find('input[name="upscheduleid"]').val(schdid);
      $(e.currentTarget).find('input[name="upeventid"]').val(eventid);
      $(e.currentTarget).find('input[name="uptitle"]').val(title);
      //$(e.currentTarget).find('input[name="updateid"]').val(dateid);
      $(e.currentTarget).find('textarea[name="updescription"]').val(description);
      $(e.currentTarget).find('input[name="upstarttime"]').val(starttime);
      $(e.currentTarget).find('input[name="upendtime"]').val(endtime);
      eventiddisp.innerHTML=eventid ;
      var upeventspeakerid=document.getElementById("upeventspeakerid");
      var upspeaker_type=document.getElementById("upeventspeakertype");
      updateActiveEventSpeakerList(upspeaker_type,upeventspeakerid);
      updateEventDaysList(eventid,dayslist);
      $("#upeventspeakertype").val(eventspeakertype).change();
      
      //console.log("Speaker ID: "+eventspeakerid);
      $("#upeventspeakerid").val(eventspeakerid).change();
      $(e.currentTarget).find('input[name="upeventspeakerid"]').val(eventspeakerid).change();
      console.log("Speaker Dropdown Value: "+conceptName);
       
  }); 

 
});
//handel checkbox of update schedule
var schdphoto=document.getElementById("schdphoto") ;
schdphoto.style.display = "none";
  function handleCheckBox(checkbox){
    if(checkbox.checked == true){
        schdphoto.style.display="" ;
    }else{
        schdphoto.style.display = "none";
    }
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.deleteModol').on('show.bs.modal', function(e){ 
      var eventId = $(e.relatedTarget).data('event-id'); 
      var delete_url=document.getElementById('deleteurl');
      var baseurl=document.getElementById('baseurl').value;
      delete_url.href=baseurl+'EventCreate/DeleteEvent/'+eventId;
      //alert(delete_url.href);
    });
  }); 

</script>
<!------------Change Date Model Populate And Date Validation--------------->
<script type="text/javascript">

  $('#ChangeDateModel').on('show.bs.modal', function(e) {
        var eventId = $(e.relatedTarget).data('event-id');
        var regStartDt = $(e.relatedTarget).data('reg-start-dt');
        var startDate = $(e.relatedTarget).data('start-date');
        var endDate = $(e.relatedTarget).data('end-date');
        var baseurl=document.getElementById('baseurl').value;
        var changeDateForm=document.getElementById('dateform');
        changeDateForm.action=baseurl+'EventCreate/changeEventDate/'+eventId; 
        $(e.currentTarget).find('input[name="regstartdate"]').val(regStartDt); 
        $(e.currentTarget).find('input[name="startdate"]').val(startDate); 
        $(e.currentTarget).find('input[name="enddate"]').val(endDate); 
        $('#dateeventid').html(eventId);

        var date1=(jQuery('#startdate').val());        
        var date2=(jQuery('#enddate').val());       
        var startdate = new Date(date1);          
        var enddate = new Date(date2);
        var timeDiff = Math.abs(startdate.getTime() - enddate.getTime());             
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        jQuery('#numofdays').val(diffDays+1); // set Value in  number of days fields
      });
  //-------------Date Validation-----------------------
  var startdate="";
  var enddate="";
  jQuery('#startdate,#enddate').change(function()
      {   
          var regStartDt=(jQuery('#regstartdate').val());        
          var startDt=(jQuery('#startdate').val());        
          var endDt=(jQuery('#enddate').val());       
          var startdate = new Date(startDt);          
          var enddate = new Date(endDt);
          var timeDiff = Math.abs(startdate.getTime() - enddate.getTime());             
          var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
          jQuery('#numofdays').val(diffDays+1); // set Value in  number of days fields
           if (enddate<startdate) {
            $('.dateerrortext').html("<p style='color:white;''>*start date less than end date</p>"); 
           jQuery('#enddate').val('');
           jQuery('#numofdays').val('0');
          }
          else{
             $('.dateerrortext').html("");
          }
    var initialRegSatrtDt=(jQuery('#hregstartdate').val());
    var initialStartDt=(jQuery('#hstartdate').val());        
    var initialEndDt=(jQuery('#henddate').val());
    if(initialStartDt==startDt && initialEndDt==endDt){
      document.getElementById("changeDatebtn").disabled = true;
    }
    else{
      document.getElementById("changeDatebtn").disabled = false;
    }  
}); 
 </script>
<?php 
}else{
  redirect(base_url()."login");
}
?>