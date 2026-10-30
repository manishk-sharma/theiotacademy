<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Employee Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-employee" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Employee</strong></a>
  </div>
  <div class="accordion" id="accordionExample">
  <?php 
  $emplist=$this->EmployeeModel->getEmployeeList() ;
  foreach($emplist as $row){ 
    $usershortinfo=$this->UserModel->getUserShortInfoById($row->user_id) ;
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->employee_id; ?></td>
            <td><?=$row->first_name." ".$row->last_name?></td>
            <td colspan="3" class="text-right edatecol">DOA: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Designation: <?=$this->DesigModel->getDesigTitleById($row->desig_id)?></td>
            <td class="text-right buttoncol">
              <a href="#" class="btn btn-success btn-sm" title="Active/Deactive"><i class="fas fa-eye"></i></a>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>employee/edit_employee/<?=$row->emp_id?>" class="btn btn-warning btn-sm" title="Edit Employee"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->emp_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->emp_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo employee_pic_url().$row->photo?>" class="tableuserimage"/>
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
                  <td><?=date('d-m-Y',strtotime($row->birth_date));?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td><?=$row->status;?></td>
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