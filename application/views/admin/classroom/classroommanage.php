<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .submitbtn{
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">ClassRoom Management</h4>
  <div class="text-right">
    <!-- Button Triggers Add Classroom modal -->
    <button type="button" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#addClassRoomModal"><strong><i class="fas fa-user-plus"></i>Add Classroom</strong></button>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $crlist=$this->ClassRoomModel->getClassRoomList() ;
  foreach($crlist as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->classroom_id; ?></td>
            <td><?=$row->title?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2"></td>
            <td class="text-right buttoncol">
              <a href="<?php echo base_url()?>classroom/change_status/<?=$row->cr_id?>" class="btn btn-success btn-sm" title="Change Status"><i class="fas fa-eye"></i></a>
            </td>
            <td class="text-right buttoncol">
               <!-- Button Triggers Update Classroom modal -->
               <button type="button" class="btn btn-warning btn-sm text-center" data-toggle="modal" data-target="#updateClassRoomModal" data-cr-id="<?=$row->cr_id?>" data-cr-title="<?=$row->title?>" data-classroom-id="<?=$row->classroom_id?>" title="Update ClassRoom"><i class="fas fa-edit"></i></button>
            </td>
            <td class="text-right buttoncol">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->cr_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->cr_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
       <h3>Ongoing Batches List</h3>
      </div>
    </div>

  </div>
<?php } ?>
</div>
<!-- Add Classroom Modal -->
<div class="modal fade" id="addClassRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New ClassRoom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>submit-classroom" method="post">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">ClassRoom Title:</label>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control" placeholder="Enter ClassRoom Title" required="required"/>
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

<!-- Update Classroom Modal -->
<div class="modal fade" id="updateClassRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update ClassRoom</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>update-classroom" method="post">
          <input type="hidden" name="crid"/>
          <input type="hidden" name="classroomid"/>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">ClassRoom ID:</label>
            <div class="col-sm-8">
              <label class="col-form-label lead" id="dispcr"></label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">ClassRoom Title:</label>
            <div class="col-sm-8">
              <input type="text" name="utitle" class="form-control" placeholder="Enter ClassRoom Title" required="required"/>
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

<br>
</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
  //triggered when modal is about to be shown
$('#updateClassRoomModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var crId = $(e.relatedTarget).data('cr-id');
    var classroomId = $(e.relatedTarget).data('classroom-id');
    var crTitle = $(e.relatedTarget).data('cr-title');
    
    //populate the textbox
    $(e.currentTarget).find('input[name="crid"]').val(crId);
    $(e.currentTarget).find('input[name="classroomid"]').val(classroomId);
    $(e.currentTarget).find('input[name="utitle"]').val(crTitle);
    $('#dispcr').html(classroomId);
});
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>