<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Registrations Management</h4>
  <br>
  <div class="accordion" id="accordionExample">
  <?php 
  $reglist=$this->RegisterModel->getRegistrationList() ;
  foreach($reglist as $row){ 
    //$courseinfo=$this->AppModel->getUserShortInfoById($row->course_id) ;
    $studentinfo=$this->StudentModel->getStudentById($row->std_id) ;
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->registration_id; ?></td>
            <td><?=$studentinfo['first_name']." ".$studentinfo['last_name']?></td>
            <td colspan="3" class="text-right edatecol">DOA: <?=date('d-m-Y',strtotime($row->admission_date)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Course: <?=$this->CourseModel->getCourseTitleById($row->course_id);?></td>
            <td class="text-right buttoncol">
              <!--Empty Space For Button-->
            </td>
            <td class="text-right buttoncol">
               <a href="register/edit_registration/<?=$row->reg_id?>" class="btn btn-warning btn-sm" title="Edit Registration"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->reg_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->reg_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                  <td><?=$this->UserModel->getEmailByUserId($studentinfo['user_id'])?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$studentinfo['mobile_no']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Total Fee:</td>
                  <td>&#8377;&nbsp;<?=$row->total_fee?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Pending Fee:</td>
                  <td>&#8377;&nbsp;<?=$row->balance_fee?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Guardian Name:</td>
                  <td><?=$studentinfo['guardian_label']." ".$studentinfo['guardian_name']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Gender:</td>
                  <td><?=$studentinfo['gender']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Birth Date</td>
                  <td><?=date('d-m-Y',strtotime($studentinfo['birth_date']));?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td>
                  <?php if($row->status==1){ ?>
                    <span style="color:green">Active</span>
                  <?php }else{?>
                    <span style="color:red">Inactive</span>
                  <?php } ?> 
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <?php $paylist=$this->PaymentModel->getPaymentListByRegId($row->reg_id) ;
          if(count($paylist)>0){
        ?>
        <div class="row">
          <div class="col-sm-12">
             <table border="0" class="table tablestyle">
              <thead>
                <tr>
                  <th colspan="2" class="text-center">Payment History</th>
                </tr>
                <tr>
                  <th class="cbtablecol">Payment ID</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($paylist as $payment){?>
                <tr>
                  <td class="cbtablecol"><a href="#"><?=$payment->payment_id?></a></td>
                  <td>&#8377;&nbsp;<?=$payment->fee_amount?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
        <?php } ?>
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