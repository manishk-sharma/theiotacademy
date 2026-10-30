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
  <h4 class="text-center heading">Payments Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-payment" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Payment</strong></a>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $paylist=$this->PaymentModel->getPaymentList() ;
  foreach($paylist as $row){ 
    $reginfo=$this->RegisterModel->getRegistrationById($row->reg_id) ;
    $studinfo=$this->StudentModel->getStudentById($reginfo['std_id']) ;
  ?>
  <div class="card" id="card<?=$row->course_id?>">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->payment_id; ?></td>
            <td><?=$studinfo['first_name']." ".$studinfo['last_name']?></td>
            <td colspan="3" class="text-right edatecol">DOP: <?=date('d-m-Y',strtotime($row->trans_date)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Reg.ID:<a href="#">&nbsp;<?=$reginfo['registration_id']?></a>, Amt. Paid: &#8377;&nbsp;<?=$row->net_amount?></td>
            <td class="text-right buttoncol">
              <a href="<?php echo base_url()?>payment/payment_receipt/<?=$row->pay_id?>" class="btn btn-primary btn-sm shortbtn" title="Print Receipt"><i class="fas fa-print"></i></a>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>course/edit_course/<?=$row->pay_id?>" class="btn btn-warning btn-sm shortbtn" title="Edit Payment"><i class="fas fa-edit iconsize"></i></a>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed shortbtn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->pay_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle iconsize"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->pay_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-6">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecolnew">Amount:</td>
                  <td>&#8377;&nbsp;<?=$row->fee_amount?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Tax Amount:</td>
                  <td>&#8377;&nbsp;<?=$row->tax_amount?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Net Amount:</td>
                  <td><strong>&#8377;&nbsp;<?=$row->net_amount?></strong></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Payment Mode:</td>
                  <td><?=$row->payment_mode?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Payment Type:</td>
                  <td><?=$row->payment_type?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Payment Date:</td>
                  <td><?=date('d-m-Y',strtotime($row->trans_date))?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Last Updated:</td>
                  <td><?=date('d-m-Y',strtotime($row->last_updated_on))?></td>
                </tr>
              </tbody>
            </table>
          </div>
           <div class="col-sm-6">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecolnew">Trans. Status:</td>
                  <td><?=$row->trans_status?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Instrument No.:</td>
                  <td><?=$row->inst_number?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Instrument Amt.:</td>
                  <td>&#8377;&nbsp;<?=$row->inst_amount?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Instrument Date:</td>
                  <td><?=date('d-m-Y',strtotime($row->inst_date))?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Instrument Bank:</td>
                  <td><?=$row->inst_bank?></td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Status:</td>
                  <td>
                    <?php if($row->status==1){?>
                      <span style="color:green;">Active</span>
                    <?php }else{?>
                      <span style="color:red;">Cancelled</span>
                    <?php }?>
                  </td>
                </tr>
                <tr>
                  <td class="cbtablecolnew">Remark:</td>
                  <td><?=$row->remarks?></td>
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