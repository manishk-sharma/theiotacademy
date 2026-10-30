<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .followbtn{
    width:100%;
    font-weight:bold;
    border-radius:0px;
    font-size:12px;
    height:20px;
    padding-top:0px;
  }
  .fupcbtablecol{
    width:50px;
  }
  .fupbuttoncol{
    width:30px;
    padding:0;
  }
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Enquiry Management</h4>
  <div class="text-right">
    <a href="<?php echo base_url()?>add-enquiry" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New Enquiry</strong></a>
    <a href="<?php echo base_url()?>export-enquiry-list-excel" class="btn btn-success btn-sm text-center"><strong><i class="far fa-file-excel"></i>Export To Excel</strong></a>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $enquirylist=$this->EnquiryModel->getEnquiryList() ;
  foreach($enquirylist as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->enquiry_id; ?></td>
            <td><?=$row->first_name." ".$row->last_name?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Course: <?=$this->CourseModel->getCourseTitleById($row->course_id);?></td>
            <td class="text-right buttoncol">
              <?php if($row->reg_status==0){?>
              <a href="<?php echo base_url()?>register/register_student/<?=$row->enq_id?>" class="btn btn-danger btn-sm" title="Register Now"><i class="fas fa-user-graduate"></i></a>
              <?php } ?>
            </td>
            <td class="text-right buttoncol">
              <?php if($row->reg_status==0){?>
               <a href="<?php echo base_url()?>enquiry/edit_enquiry/<?=$row->enq_id?>" class="btn btn-warning btn-sm" title="Edit Enquiry"><i class="fas fa-edit"></i></a>
              <?php } ?>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->enq_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="3" class="text-right">
              <button class="btn btn-primary btn-sm collapsed followbtn" type="button" data-toggle="collapse" data-target="#followupdiv<?=$row->enq_id?>" aria-expanded="false" aria-controls="followupdiv<?=$row->enq_id?>" title="Follow Ups Info">Follow Ups</button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->enq_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-6">
            <table border="0" class="tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Dated:</td>
                  <td><?=date('d-m-Y',strtotime($row->created_on))?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Name:</td>
                  <td><?=$row->first_name." ".$row->last_name?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Email ID:</td>
                  <td><?=$row->email_id?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$row->mobile_no?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-6">
             <table border="0" class="tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Gender:</td>
                  <td><?=$row->gender?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Course:</td>
                  <td><?=$this->CourseModel->getCourseTitleById($row->course_id);?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Source:</td>
                  <td><?=$this->EnquirySourceModel->getSourceTitleById($row->source_id);?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Message:</td>
                  <td class="text-justify"><?=$row->message?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--Div For Follow Ups-->
    <div id="followupdiv<?=$row->enq_id?>" class="collapse" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <table border="1" class="table tablestyle">
            <thead>
              <tr>
                <th colspan="3" class="text-center">Enquiry Follow Ups</th>
              </tr>
              <tr>
                <th class="fupcbtablecol">Date</th>
                <th>Remarks</th>
                <th class="fupbuttoncol">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-enq-id="<?=$row->enq_id?>" data-enquiry-id="<?=$row->enquiry_id?>" data-target="#addFollowUpModal"><i class="fas fa-plus"></i></button>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $fuplist=$this->EnquiryFollowUpModel->getEnquiryFollowUpListByEnqId($row->enq_id)?>
              <?php foreach($fuplist as $fup){?>
              <tr>
                <td class="fupcbtablecol"><?=date('d-m-Y',strtotime($fup->fup_date))?><br><?php if($fup->fup_status==1){ ?>
                  <span style="color:green;">Completed</span>
                <?php }else{ ?>
                  <span style="color:blue;">Pending</span>
                <?php }?>
                </td>
                <td>
                  <?php if($fup->remark=="nil"){
                            echo "Not Yet Completed" ;
                        }else{
                            echo $fup->remark ;
                        }
                  ?> 
                </td>
                <td class="fupbuttoncol">
                 <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-fup-id="<?=$fup->fup_id?>" data-fup-date="<?=$fup->fup_date?>" data-remark="<?=$fup->remark?>" data-fup-status="<?=$fup->fup_status?>" data-enq-id="<?=$row->enq_id?>" data-enquiry-id="<?=$row->enquiry_id?>" data-target="#updateFollowUpModal"><i class="fas fa-edit"></i></button>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>
    </div>

  </div>
<?php } ?>
</div>
<br>
<!-- Add FollowUp Modal -->
<div class="modal fade" id="addFollowUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Follow Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>submit-enquiry-followup" method="post">
          <input type="hidden" name="enqid"/>
          <input type="hidden" name="enquiryid"/>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Enquiry ID:</label>
            <div class="col-sm-8">
              <label id="enquiryid" class="col-form-label lead"></label>
            </div>
          </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Follow Up Date:</label>
            <div class="col-sm-8">
              <input type="date" name="fupdate" class="form-control" required="required"/>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
              <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
            </div>
            <div class="col-sm-4"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update FollowUp Modal -->
<div class="modal fade" id="updateFollowUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Follow Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>update-enquiry-followup" method="post">
          <input type="hidden" name="enqid"/>
          <input type="hidden" name="enquiryid"/>
          <input type="hidden" name="fupid"/>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">FollowUp ID:</label>
            <div class="col-sm-8">
              <label id="dispfupid" class="col-form-label lead"></label>
            </div>
          </div>
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Enquiry ID:</label>
            <div class="col-sm-8">
              <label id="uenquiryid" class="col-form-label lead"></label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Follow Up Date:</label>
            <div class="col-sm-8">
              <input type="date" name="fupdate" class="form-control" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">FollowUp Status:</label>
            <div class="col-sm-8">
              <select id="fupstatus" name="fupstatus" class="form-control">
                <option value="0">Pending</option>
                <option value="1">Completed</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Remark:</label>
            <div class="col-sm-8">
              <textarea id="fupremark" name="fupremark" class="form-control" required="required"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
              <input type="submit" value="Update" class="btn btn-primary submitbtn"/>
            </div>
            <div class="col-sm-4"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
  //triggered when modal is about to be shown
$('#addFollowUpModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var enqId = $(e.relatedTarget).data('enq-id');
    var enquiryId = $(e.relatedTarget).data('enquiry-id');
    
    //populate the textbox
    $(e.currentTarget).find('input[name="enqid"]').val(enqId);
    $(e.currentTarget).find('input[name="enquiryid"]').val(enquiryId);
    $('#enquiryid').html(enquiryId);
});

$('#updateFollowUpModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var enqId = $(e.relatedTarget).data('enq-id');
    var enquiryId = $(e.relatedTarget).data('enquiry-id');
    var fupId = $(e.relatedTarget).data('fup-id');
    var fupDate = $(e.relatedTarget).data('fup-date');
    var fupRemark = $(e.relatedTarget).data('remark');
    var fupStatus = $(e.relatedTarget).data('fup-status');
    
    //populate the textbox
    $(e.currentTarget).find('input[name="enqid"]').val(enqId);
    $(e.currentTarget).find('input[name="enquiryid"]').val(enquiryId);
    $(e.currentTarget).find('input[name="fupid"]').val(fupId);
    $(e.currentTarget).find('input[name="fupdate"]').val(fupDate);
    //$(e.currentTarget).find('input[name="fupremark"]').html(fupRemark);
    $('select[name="fupstatus"]').val(fupStatus);
    $('#uenquiryid').html(enquiryId);
    $('#dispfupid').html(fupId);
    $('#fupremark').html(fupRemark);
});
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>