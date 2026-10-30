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
  <h4 class="text-center heading">Course Modules Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-course-module" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Module</strong></a>
  </div>
 
  <div class="accordion" id="accordionExample">
  <?php 
  $modulelist=$this->CourseModuleModel->getCourseModuleList() ;
  foreach($modulelist as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->module_id; ?></td>
            <td><?=$row->module_name?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Duration: <?=$row->duration?>&nbsp;Hour(s), Price: &#8377;&nbsp;<?=$row->module_fee?></td>
            <td class="text-right buttoncol">
              <!-- Button trigger modal -->
              <button type="button" title="Add To Course" class="btn btn-danger btn-sm shortbtn" data-toggle="modal" data-target="#exampleModal<?=$row->cm_id?>"><i class="fas fa-calendar-plus iconsize"></i></button>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>coursemodule/edit_cmodule/<?=$row->cm_id?>" class="btn btn-warning btn-sm shortbtn" title="Edit Module"><i class="fas fa-edit iconsize"></i></a>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed shortbtn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->cm_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle iconsize"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->cm_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-12">
              <h6>Description:</h6>
              <p class="text-justify"><?=$row->description?></p>
          </div>
          <div class="col-sm-12">
            <table border="0" class="table ">
              <thead>
                <tr>
                  <th colspan="2" class="ml-4">Sequence</th> 
                  <th>Topic Name</th> 
                </tr>
              </thead>  
                
              <tbody>
                <?php
                  $topicData=$this->ModuleTopicModel->getModuleTopicByCmID($row->cm_id);
                  foreach ($topicData as $srow){ ?>
                    <tr>
                      <td colspan="2" class=""><?=$srow->sequence?></td>
                      <td  class="cbtablecolnew"><?=$srow->topic_name?></td>
                    </tr>
                <?php }?>
                <!-- <tr>
                  <td class="cbtablecol">Status:</td>
                  <td>
                    <?php if($row->status==1){?>
                      <span style="color:green;">Active</span>
                    <?php }else{?>
                      <span style="color:red;">Inactive</span>
                    <?php }?>
                  </td>
                </tr> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal<?=$row->cm_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Module To Course</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url()?>submit-course-module-to-batch" method="post">
          <table border="0" class="table">
            <tbody>
              <tr>
                <td class="idcol"><?=$row->module_id; ?></td>
                <td><?=$row->module_name?></td>
              </tr>
              <tr>
                <td class="idcol">Course:</td>
                <td>
                  <select name="courseid" class="form-control" required="required">
                    <?php 
                      $courselist=$this->CourseModel->getActiveCoursesList() ;
                      foreach($courselist as $row2){
                        $cmexists=$this->CourseModuleModel->isModuleAlreadyInCourse($row->cm_id,$row2->course_id) ;
                        if(!$cmexists){
                    ?>
                    <option value="<?=$row2->course_id ?>"><?=$row2->course_title ?></option>
                  <?php }} ?>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" name="cmid" value="<?=$row->cm_id?>"/>
          <div class="text-center">
            <button type="submit" class="btn btn-success submitbtn">Submit</button>
          </div>
          </form>
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