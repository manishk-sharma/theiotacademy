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
  <h4 class="text-center heading">Courses Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-course" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Course</strong></a>
    <a href="<?php echo base_url()?>acoursemodule" class="btn btn-danger btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Course Modules</strong></a>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $courselist=$this->CourseModel->getCoursesList() ;
  foreach($courselist as $row){ 
  ?>
  <div class="card" id="card<?=$row->course_id?>">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->cs_id; ?></td>
            <td><?=$row->course_title?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td  class="text-left buttoncol">
               Subject : 
            </td>
            <td  colspan="2" class="text-left buttoncol">
               <?=$this->SubjectModel->getSubjectTitleById($row->subject_id)?>
            </td>
            <td  class="text-right buttoncol">
              <?php if($row->status==1){ ?> 

                <a href="<?=base_url().'Course/enableDisableCourse/'.$row->course_id.'/0'?>" class="btn btn-success btn-sm"  title="Deactivate"><i class="fas fa-eye"></i></a>

              <?php }else{ ?>

                <a href="<?=base_url().'Course/enableDisableCourse/'.$row->course_id.'/1'?>" class="btn btn-danger btn-sm"  title="Activate"><i class="fas fa-eye-slash"></i></a>

              <?php } ?>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>course/edit_course/<?=$row->course_id?>" class="btn btn-warning btn-sm" title="Edit Course"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->course_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->course_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-6">
            <table border="0" class="table tablestyle">
              <tbody>

                <tr>
                  <td class="cbtablecol">Project Work:</td>
                  <td><?=$row->project_work?></td>
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

              </tbody>
            </table>
          </div>
           <div class="col-sm-6">
            <table border="0" class="table tablestyle">
              <tbody>

                <tr>
                  <td class="cbtablecol">Created On:</td>
                  <td><?=date('d-m-Y h:s a',strtotime($row->created_on))?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Last Updated:</td>
                  <td><?=date('d-m-Y h:s a',strtotime($row->last_updated_on))?></td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
             <table border="0" class="table tablestyle">
              <thead>
                <tr>
                  <th colspan="2" class="text-center">Modules Information</th>
                </tr>
                <tr>
                  <th>Module ID</th>
                  <th>Module Name</th>
                </tr>
              </thead>
              <tbody>
                <?php $modulelist=$this->CourseModuleModel->getModulesByCourseId($row->course_id);
                  foreach($modulelist as $mlist){
                    $minfo=$this->CourseModuleModel->getCourseModuleById($mlist->cm_id);
                ?>
                <tr>
                  <td class="cbtablecol"><a href="#"><?=$minfo['module_id']?></a></td>
                  <td><?=$minfo['module_name']?></td>
                </tr>
                <?php }?>
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