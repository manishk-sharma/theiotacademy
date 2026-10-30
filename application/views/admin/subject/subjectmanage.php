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
  <h4 class="text-center heading">Subject Management</h4>

  <div class="text-right">
    <a href="#" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#add-subject" title="Add Subject"><strong><i class="fas fa-user-plus"></i>Add New Subject</strong></a>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
 
  $user_id = $this->session->user_id;
  foreach($subjectData as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->subject_id; ?></td>
            <td><?=$row->subject_title?></td>
            <td colspan="2" class="text-center edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
           
            <td colspan="2" class="text-right buttoncol">
             
               <?php if($row->status==1){ ?>

              <a href="<?=base_url().'Subject/enableDisableSubject/'.$row->subject_id.'/0'?>" class="btn btn-success btn-sm" title="Hide/Show Event"><i class="fas fa-eye"></i></a>

              <?php }else{?>

              <a href="<?=base_url().'Subject/enableDisableSubject/'.$row->subject_id.'/1'?>" class="btn btn-danger btn-sm" title="Hide/Show Event"><i class="fas fa-eye-slash"></i></a>

              <?php }?>
             
            </td>
            <td class="text-right buttoncol">
              
               <a class="btn btn-warning btn-sm" title="Edit Subject" data-toggle="modal" data-target="#updateSubjectModal" data-subject_id="<?=$row->subject_id?>" data-subject_title="<?=$row->subject_title?>" ><i class="fas fa-edit"></i></a>
              
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->subject_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->subject_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-6">
            <table border="0" class="tablestyle">
              <tbody>                
                <tr>
                  <td class="cbtablecol">created by:</td>
                  <td><?=$this->EmployeeModel->getEmployeeFullNameByUserId($row->created_by);?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-6">
             <table border="0" class="tablestyle">
              <tbody>
                
                  <td class="cbtablecol">last updated on:</td>
                  <td><?=date('d-m-Y H:s a',strtotime($row->last_updated_on))?></td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--Div For Follow Ups-->
    

  </div>
<?php } ?>
</div>
<br>
<!-- Add FollowUp Modal -->
<div class="modal fade" id="add-subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>submit-subject" method="post">
        	<input type="hidden" name="userid" value="<?=$user_id?>">
         <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Subject Title:</label>
            <div class="col-sm-8">
               <input type="text" name="subjecttitle" class="form-control" required="required"/>
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
<div class="modal fade" id="updateSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>update-subject" method="post">
          <input type="hidden" name="subjectid"/>
          <input type="hidden" name="userid" value="<?=$user_id?>" />
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Subject ID:</label>
            <div class="col-sm-8">
              <label id="subjectid" class="col-form-label lead text-center"></label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Subject Title :</label>
            <div class="col-sm-8">
              <input type="text" name="subjecttitle" class="form-control" required="required"/>
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
$('#add-subject').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var enqId = $(e.relatedTarget).data('enq-id');
    var enquiryId = $(e.relatedTarget).data('enquiry-id');
    
    //populate the textbox
    $(e.currentTarget).find('input[name="enqid"]').val(enqId);
    $(e.currentTarget).find('input[name="enquiryid"]').val(enquiryId);
    $('#enquiryid').html(enquiryId);
});

$('#updateSubjectModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var subjectId = $(e.relatedTarget).data('subject_id');
    var subjectTitle = $(e.relatedTarget).data('subject_title');
    //populate the textbox
    $("#subjectid").text(subjectId);

    $(e.currentTarget).find('input[name="subjectid"]').val(subjectId);
    
    $(e.currentTarget).find('input[name="subjecttitle"]').val(subjectTitle);


    
});

</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>