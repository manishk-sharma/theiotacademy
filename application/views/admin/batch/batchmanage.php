<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .cbtablecolnew{
    width:220px; 
  } 
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Batches Management</h4>
  <div class="text-right">
    <a href="add-batch" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Batch</strong></a>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $batchlist=$this->BatchModel->getBatchList() ;
  foreach($batchlist as $row){ 
    $empinfo=$this->EmployeeModel->getEmployeeDetailsByUserId($row->faculty_id) ;
    $crinfo=$this->ClassRoomModel->getClassRoomById($row->cr_id) ;
    $course=$this->CourseModel->getCourseById($row->course_id);
    $weekdaystext=$this->BatchDaysModel->getBatchDaysTextById($row->batch_days_id) ;
    $reglist=$this->BatchModel->getRegListByBatchId($row->btc_id) ;
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0"> 
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->batch_id; ?></td>
            <td><?=$row->batch_name?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Course: <?=$course['course_title']?>&nbsp;(<?=$course['cs_id']?>)</td>
            <td class="text-right buttoncol">
              <a href="<?php echo base_url()?>batch/add_students_to_batch/<?=$row->btc_id?>" class="btn btn-danger btn-sm shortbtn" title="Add Students To Batch"><i class="fas fa-user-plus iconsize"></i></a>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>batch/edit_batch/<?=$row->btc_id?>" class="btn btn-warning btn-sm shortbtn" title="Edit Batch Info"><i class="fas fa-edit iconsize"></i></a>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed shortbtn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->btc_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle iconsize"></i></button>
            </td>
          </tr>
          <tr>
            <td colspan="2">From: <span style="color:blue;"><?=date('d-m-Y',strtotime($row->start_date))?></span> To <span style="color:green;"><?=date('d-m-Y',strtotime($row->end_date))?></span> | Days: <?=$weekdaystext?></td>
            <td class="text-right buttoncol">
              <button class="btn btn-danger btn-sm collapsed shortbtn" type="button" data-toggle="collapse" data-target="#collapseTwo<?=$row->btc_id?>" aria-expanded="false" aria-controls="collapseTwo" title="View Students"><i class="fas fa-user-graduate iconsize"></i></button>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>" target="_blank" class="btn btn-primary btn-sm shortbtn" title="Print Batch Summary"><i class="fas fa-print iconsize"></i></a>
            </td>
            <td class="text-right buttoncol">
                <?php if($row->status==1){ ?>

                <a href="<?=base_url().'Batch/enableDisableBatch/'.$row->btc_id.'/0'?>" class="btn btn-success btn-sm"  title="Deactivate"><i class="fas fa-eye"></i></a>

              <?php }else{ ?>

                <a href="<?=base_url().'Batch/enableDisableBatch/'.$row->btc_id.'/1'?>" class="btn btn-danger btn-sm"  title="Activate"><i class="fas fa-eye-slash"></i></a>

              <?php } ?>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>
     <div id="collapseTwo<?=$row->btc_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <?php if(count($reglist)>0){?>
       <div class="row">
         <div class="col-sm-12">
           <table border="0" class="table tablestyle">
              <thead>
                <tr>
                  <th colspan="3" class="text-center">Enrolled Students</th>
                </tr>
                <tr>
                  <th class="cbtablecol">Reg. ID</th>
                  <th>Name</th>
                  <th>Course</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($reglist as $regitem){
                      $stdinfo=$this->StudentModel->getStudentById($regitem->std_id) ;
                      $courseinfo=$this->CourseModel->getCourseById($regitem->course_id) ;
                ?>
                <tr>
                  <td class="cbtablecol"><a href="#"><?=$regitem->registration_id?></a></td>
                  <td><?=$stdinfo['first_name']." ".$stdinfo['last_name']?></td>
                  <td><a href="#"><?=$courseinfo['cs_id']?></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
         </div>
       </div>
     <?php }else{ ?>
      <h3 class="lead text-center">No Students Enrolled Yet.</h3>
     <?php } ?>
     </div>
    <div id="collapseOne<?=$row->btc_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-6">
              <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Faculty:</td>
                  <td><?=$empinfo['employee_id']."&nbsp;(".$empinfo['first_name']." ".$empinfo['last_name'].")"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Timings:</td>
                  <td><?=substr($row->lecture_start_time,0,-3)?> To <?=substr($row->lecture_end_time,0,-3)?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Week Days:</td>
                  <td><?=$weekdaystext?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Class Room:</td>
                  <td><?=$crinfo['classroom_id']." (".$crinfo['title'].")"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Available Seats:</td>
                  <td><?=$row->available_seats?>&nbsp;Seat(s)</td>
                </tr>
                <tr>
                  <td class="cbtablecol">Stud. Enrolled:</td>
                  <td style="color:blue;"><?=$row->std_enrolled?>&nbsp;Student(s)</td>
                </tr>
              </tbody>
            </table>
          </div>
           <div class="col-sm-6">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecolnew">Training Mode:</td>
                  <td><?=$row->training_mode?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Duration:</td>
                  <td><?=$row->duration?>&nbsp;Hour(s)</td>
                </tr>
                 <tr>
                  <td class="cbtablecolnew">Hours Per Day:</td>
                  <td><?=$row->hours_per_day?>&nbsp;Hours(s)</td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">No. of Days:</td>
                  <td><?=$row->days_quantity?>&nbsp;Day(s)</td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td>
                    <?php if($row->status==1){?>
                      <span style="color:green;">Active</span>
                    <?php }else{?>
                      <span style="color:red;">Inactive</span>
                    <?php }?>
                  </td>
                </tr>
                <tr>
                  <td class="cbtablecol">Last Updated:</td>
                  <td><?=date('d-m-Y,H:i:s a',strtotime($row->last_updated_on))?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<br>
</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
  redirect(base_url()."login");
}
?>