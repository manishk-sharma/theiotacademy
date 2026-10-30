<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Student Management</h4>
  <br>
  <div class="accordion" id="accordionExample">
  <?php 
  $studentlist=$this->StudentModel->getStudentList() ;
  foreach($studentlist as $row){ 
    $usershortinfo=$this->UserModel->getUserShortInfoById($row->user_id) ;
    $reginfo=$this->RegisterModel->getRegisterInfoByStdId($row->std_id) ;
    $first_course="nil" ;
    $admission_date="nil" ;
    foreach($reginfo as $reg){
      $first_course=$reg->course_id ;
      $admission_date=$reg->admission_date ;
    }
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->student_id; ?></td>
            <td><?=$row->first_name." ".$row->last_name?></td>
            <td colspan="3" class="text-right edatecol">DOA: <?=date('d-m-Y',strtotime($admission_date)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Course: <?=$this->CourseModel->getCourseTitleById($first_course);?></td>
            <td class="text-right buttoncol">
              <a href="<?php echo base_url()?>register/register_existing_student/<?=$row->std_id?>" class="btn btn-success btn-sm" title="New Course Registration For Existing Student"><i class="fab fa-codiepie"></i></a>
            </td>
            <td class="text-right buttoncol">
               <a href="student/edit_student/<?=$row->std_id?>" class="btn btn-warning btn-sm" title="Edit Student"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->std_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->std_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo asset_url()?>images/maleuser.jpg" class="tableuserimage"/>
          </div>
          <div class="col-sm-5">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Email ID:</td>
                  <td><?=$usershortinfo['email_id']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$row->mobile_no?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Guardian Name:</td>
                  <td><?=$row->guardian_label." ".$row->guardian_name?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Gender:</td>
                  <td><?=$row->gender?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Birth Date</td>
                  <td><?=date('d-m-Y',$row->birth_date);?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td><?=$row->status;?></td>
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
                  <th colspan="2" class="text-center">Course Information</th>
                </tr>
                <tr>
                  <th>Reg. ID</th>
                  <th>Course Name</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($reginfo as $rinfo){?>
                <tr>
                  <td class="cbtablecol"><a href="#"><?=$rinfo->registration_id?></a></td>
                  <td><?=$this->CourseModel->getCourseTitleById($rinfo->course_id)?></td>
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