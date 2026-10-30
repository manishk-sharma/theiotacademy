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
  <h4 class="text-center heading">Designation Management</h4>
  <div class="text-right">
    <!-- Button Triggers Add Classroom modal -->
    <button type="button" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#addDesignationModal"><strong><i class="fas fa-user-plus"></i>Add Designation</strong></button>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $eslist=$this->DesigModel->getDesignationList() ;
  foreach($eslist as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->desig_id; ?></td>
            <td><?=$row->title?>&nbsp;(<?=$this->UserTypeModel->getUserTypeTitleById($row->user_type_id)?>)</td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2"><?=$row->description?></td>
            <td class="text-right buttoncol">
              <!--Empty Space For Button-->
            </td>
            <td class="text-right buttoncol">
               <!-- Button Triggers Update Enquiry Source modal -->
               <button type="button" class="btn btn-warning btn-sm text-center" data-toggle="modal" data-target="#updateDesignationModal" data-desig-id="<?=$row->desig_id?>" data-desig-title="<?=$row->title?>" data-description="<?=$row->description?>" data-user-type-id="<?=$row->user_type_id?>" title="Update Designation"><i class="fas fa-edit"></i></button>
            </td>
            <td class="text-right buttoncol">
               <a href="<?php echo base_url()?>designation/change_status/<?=$row->source_id?>" class="btn btn-success btn-sm" title="Change Status"><i class="fas fa-eye"></i></a>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

  </div>
<?php } ?>
</div>
<!-- Add Designation Modal -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Designation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>submit-designation" method="post">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Desig. Title:</label>
            <div class="col-sm-8">
              <input type="text" name="title" class="form-control" placeholder="Enter Desig. Title" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Description:</label>
            <div class="col-sm-8">
              <input type="text" name="description" class="form-control" placeholder="Enter Description" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">User Type:</label>
            <div class="col-sm-8">
              <?php $utlist=$this->UserTypeModel->getUserTypeList()?>
              <select id="upusertypeid" name="usertypeid" class="form-control">
                <?php foreach($utlist as $utitem){?>
                <option value="<?=$utitem->type_id?>"><?=$utitem->title?></option>
                <?php } ?>
              </select>
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

<!-- Update Designation Modal -->
<div class="modal fade" id="updateDesignationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Designation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>update-designation" method="post">
          <input type="hidden" name="desigid"/>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Desig. ID:</label>
            <div class="col-sm-8">
              <label class="col-form-label lead" id="dispdesigid"></label>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Desig. Title:</label>
            <div class="col-sm-8">
              <input type="text" name="uptitle" class="form-control" placeholder="Enter Desig. Title" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">Description:</label>
            <div class="col-sm-8">
              <input type="text" name="updescription" class="form-control" placeholder="Enter Description" required="required"/>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label lead">User Type:</label>
            <div class="col-sm-8">
              <?php $utlist=$this->UserTypeModel->getUserTypeList()?>
              <select id="upusertypeid" name="upusertypeid" class="form-control">
                <?php foreach($utlist as $utitem){?>
                <option value="<?=$utitem->type_id?>"><?=$utitem->title?></option>
                <?php } ?>
              </select>
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
  //not in used   but maybe useful
 $( document ).ready(function(){
//   function setSelectedIndex(s, v) {
//     for ( var i = 0; i < s.options.length; i++ ) {
//         if ( s.options[i].value == v ) {
//             s.options[i].selected = true;
//             
//         }
//     }
//   }

      //triggered when modal is about to be shown
  $('#updateDesignationModal').on('show.bs.modal', function(e) {
      //get data-id attribute of the clicked element
      var desigId = $(e.relatedTarget).data('desig-id');
      var desigTitle = $(e.relatedTarget).data('desig-title');
      var description = $(e.relatedTarget).data('description');
      var userTypeId = $(e.relatedTarget).data('user-type-id');
      //populate the textbox
      $(e.currentTarget).find('input[name="desigid"]').val(desigId);
      $(e.currentTarget).find('input[name="uptitle"]').val(desigTitle);
      $(e.currentTarget).find('input[name="updescription"]').val(description);
      $('select[name="upusertypeid"]').val(userTypeId);
      $('#dispdesigid').html(desigId);
  });
});
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>