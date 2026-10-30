<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css"> 
  .cbtablecolnew{
    width:220px;
  }
  .lead{
    font-size:16px;
  }
  .logobtn{
    border-radius:25px;
    font-weight:bold;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Company Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-company" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Company</strong></a>
  </div>

  <?php 
  $complist=$this->CompanyModel->getCompanyList() ;
  foreach($complist as $row){ ?>

  <div class="card mb-3" style="margin-top:5px;">
    <div class="row no-gutters">
      <div class="col-md-4 text-center">
        <img src="<?php echo asset_url()?>images/company/<?=$row->logo?>" class="card-img" alt="<?=$row->company_name?> Logo">
        <button type="button" class="btn btn-warning btn-sm logobtn">Change Logo</button>
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <table border="0" style="width:100%;">
            <tbody>
              <tr>
                <td><h5 class="card-title heading"><u><?=$row->company_name?></u></h5></td>
                <td style="width:30px;">
                  <a href="<?php echo base_url()?>company/edit_company/<?=$row->comp_id?>" class="btn btn-warning btn-sm shortbtn" title="Edit Company"><i class="fas fa-edit iconsize"></i></a>
                </td>
                <td style="width:30px;">
                  <?php if($row->status==1){?>
                    <button type="button" title="Click To Disable" class="btn btn-success btn-sm shortbtn" data-toggle="modal" data-target="#exampleModal<?=$row->comp_id?>"><i class="fas fa-eye iconsize"></i></button>
                  <?php }else{?>
                    <button type="button" title="Click To Enable" class="btn btn-danger btn-sm shortbtn" data-toggle="modal" data-target="#exampleModal<?=$row->comp_id?>"><i class="fas fa-eye-slash iconsize"></i></button>
                  <?php }?>
                </td>
              </tr>
            </tbody>
          </table>
          
          <div class="row">
            <div class="col-sm-4 lead">Email ID:</div>
            <div class="col-sm-8 lead"><?=$row->email_id?></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">Contact No.:</div>
            <div class="col-sm-8 lead"><?=$row->contact_no?></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">Alternate Contact No.:</div>
            <div class="col-sm-8 lead"><?=$row->alt_contact_no?></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">PAN No.:</div>
            <div class="col-sm-8 lead"><?=$row->pan_no?></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">GST No.:</div>
            <div class="col-sm-8 lead"><?=$row->gst_no?></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">Website:</div>
            <div class="col-sm-8 lead"><a href="<?=$row->website?>" target="_blank"><?=$row->website?></a></div>
          </div>
          <div class="row">
            <div class="col-sm-4 lead">Address:</div>
            <div class="col-sm-8 lead"><?=$row->company_addr?></div>
          </div>
          <p class="card-text"><small class="text-muted"><?=$row->remark?></small></p>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>
<br>
</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
  redirect(base_url()."login");
}
?>