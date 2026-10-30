<?php 
if($this->session->userdata("logged_in")){
?>

<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">

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
  td{
    font-size: 1.2em;
  }

</style>

<div class="container-fluid">

  <h4 class="text-center heading">Discount Management</h4>
  <br>

  <div class="text-right mb-1">

    <a href="<?=base_url().'discount-add'?>"class="btn btn-primary btn-sm">
      
      <strong>
        
        <i class="fas fa-user-plus"></i>Add Discount

      </strong>

    </a>

  </div> 

<?php foreach($discount_list as $row):?>

  <div class="accordion mb-2" id="accordionExample">
  
    <div class="card p-0" id="card<?=$row->discount_id?>">

      <div class="card-header pb-0 cardstyle" id="headingOne">

        <h2 class="mb-0">

          <table border="0" class="tablestyle">

            <tbody>

            <tr>

              <td class="idcol"><?=$row->discount_id; ?></td>

              <td><?=$row->discount_name?></td>

              <td colspan="3" class="text-center edatecol">DOD: <?=date('d-M-Y',strtotime($row->discount_date)) ?></td>

            </tr>

             <tr>

              <td colspan="2"></td>

              <td class="text-right buttoncol pb-2">

              <?php if($row->status==1){ ?>

                <a href="<?=base_url().'Discount/enableDisableDiscount/'.$row->discount_id.'/0'?>" class="btn btn-success btn-sm" title="Hide/Show Discount"><i class="fas fa-eye"></i></a>

              <?php }else{?>

                <a href="<?=base_url().'Discount/enableDisableDiscount/'.$row->discount_id.'/1'?>" class="btn btn-danger btn-sm" title="Hide/Show Discount"><i class="fas fa-eye-slash"></i></a>

              <?php }?>

              </td>

              <td class="text-right buttoncol pr-1 pl-1 pb-2">

                 <a href="<?php echo base_url()?>Discount/discount_update/<?=$row->discount_id?>" class="btn btn-warning btn-sm shortbtn" title="Edit Discount"><i class="fas fa-edit iconsize"></i></a>

              </td>

              <td class="text-right buttoncol pb-2">

                  <button class="btn btn-primary btn-sm collapsed shortbtn" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->discount_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle iconsize"></i>
                  </button>

              </td>

            </tr>

          </tbody>

          </table>

        </h2>

      </div>

      <div id="collapseOne<?=$row->discount_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">

        <div class="card-body cardbodystyle">

          <div class="row">

            <div class="col-sm-6">

              <table border="0" class="table tablestyle">

                <tbody>

                  <tr>

                    <td class="cbtablecolnew">Discount For:</td>

                    <td><?=ucfirst($row->batch_event_type)?></td>

                  </tr>

                  <tr>
                    <?php if($row->batch_event_type=='event') {

                      $batch_event_data=$this->EventModel->getEventNameById($row->batch_event_id) ;

                      ?>


                    <td class="cbtablecolnew">Event Name:</td>

                    <?php } else{

                      $batch_event_data=$this->BatchModel->getBatchNameById($row->batch_event_id);

                     ?>

                      <td class="cbtablecolnew">Batch Name:</td>

                    <?php } ?>

                    <td><?=$batch_event_data?></td>

                  </tr>

                  <tr>

                    <td class="cbtablecolnew">Discount Date:</td>

                    <td><?=date('d-M-Y',strtotime($row->discount_date))?></td>

                  </tr>

                  <tr>

                    <td class="cbtablecolnew">Discount Mode:</td>

                  <?php if($row->auto_manual==0){ ?>

                    <td>Auto</td> 

                  <?php } else { ?>

                     <td>Manual</td>

                   <?php } ?>

                  </tr>

                </tbody>

              </table>

            </div>

             <div class="col-sm-6">

              <table border="0" class="table tablestyle">

                <tbody>


                  <tr>

                    <td class="cbtablecolnew">Discount Rate:</td>

                    <td><strong><?=$row->discount_rate?> %</strong></td>

                  </tr>

                  <tr>

                    <td class="cbtablecolnew">Last Updated On:</td>

                    <td><?=date('d-M-Y H:i:s',strtotime($row->last_updated_on))?></td>

                  </tr>

                  <tr>
                    <td class="cbtablecolnew">Created On:</td>
                    <td><?=date('d-M-Y H:i:s',strtotime($row->created_on))?></td>
                  </tr>

                  <tr>

                    <td class="cbtablecolnew">Status:</td>

                    <td>
                      <?php if($row->status==1){?>
                        <span style="color:green;">Active</span>
                      <?php }else{?>
                        <span style="color:red;">Deactive</span>
                      <?php }?>
                    </td>

                  </tr>

                </tbody>

              </table>
            </div>

            <div class="col-sm-12">
                <strong>Description:</strong> 
                <p class="text-justify"><?=$row->description?></p>
            </div>

          </div>

        </div>

      </div>

    </div> 

  </div>
<?php endforeach;?>
  <br>

</div>




<?php $this->load->view("admin/commons/adminfooter.php") ;?> 

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>/assets/js/ajax/batch_event_dropdownajax.js"></script>

<script type="text/javascript">

$( document ).ready(function() {
        
});

</script>

<?php 
}else{
  redirect(base_url()."login");
}
?>