<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Event Type Management</h4>
  <br>
  <div class="text-right">
    <!-- Button Triggers Add Classroom modal -->
    <button type="button" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#addEventTypeModel"><strong><i class="fas fa-user-plus"></i>Add Event Type</strong></button>
  </div>
  </div>

  <div class="accordion" id="accordionExample">
  <?php 
  $eventtypelist=$this->EventTypeModel->getEventTypeList() ;
  foreach($eventtypelist as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->type_id; ?></td>
            <td ><?=$row->type_title?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2"></td>
            <td class="text-right buttoncol">
            </td>
            <td class="text-right buttoncol">
                <!--<a href="<?php echo base_url()?>aevent/<?=$row->event_type_id?>" class="btn btn-success btn-sm" title="Open/Close Event"><i class="fab fa-codiepie"></i></a>--->
            </td>
            <td class="text-right buttoncol">
               <button type="button" class="btn btn-warning btn-sm text-center" data-toggle="modal" data-target="#updateEventTypeModal" data-event-type="<?=$row->type_title?>" data-event-type-id="<?=$row->type_id;?>" >
               <strong><i class="fas fa-edit" title="Edit Location" ></i></strong></button>
           </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->type_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo asset_url()?>images/maleuser.jpg" class="tableuserimage"/>
          </div>
          <div class="col-sm-5">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Event Type:</td>
                  <td class="text-center"><?=$row->event_type_id?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Location:</td>
                  <td class="text-center"><?=$row->event_location_id?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Starts From:</td>
                  <td class="text-center"><?=date('d-m-Y',strtotime($row->start_date))." At "."10:00AM"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Ends On:</td>
                  <td class="text-center"><?=date('d-m-Y',strtotime($row->end_date))." At "."6:00PM"?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Days:</td>
                  <td><?=$row->days_quantity?> Day(s)</td>
                </tr>
                <tr>
                  <td class="cbtablecol">Event open:</td>
                  <td class="text-center"><?=$row->event_open?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Reg Start Date:</td>
                  <td class="text-center"><?=$row->reg_start_dt?></td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                
                <tr>
                  <td class="cbtablecol">Reg Open</td>
                  <td class="text-center"><?=$row->reg_open?></td>
                </tr>
                
                <tr>
                  <td class="cbtablecol">Payment Type:</td>
                  <td class="text-center"><?=$row->payment_type?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Price:</td>
                  <td class="text-center"><?=$row->price?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td class="text-center"><?=$row->status;?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Created On:</td>
                  <td class="text-center"><?=$row->created_on?></td>
                </tr>
                <tr>
                  <td class="cbtablecol" colspan="1">Last Updated On:</td>
                  <td class="text-center"><?=$row->last_updated_on?></td>
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
<!----------------------------Add Event Type Mannage------------------>
<div class="modal fade bd-example-modal-md" id="addEventTypeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>EventType/insertEventType" method="post">
          <div class="form-group row">
                <div class="col-sm-12">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Event Type:</label>
                      <div class="col-sm-8">
                          <input type="text" name="title" class="form-control" placeholder="Add Event Type" required="required"/>
                      </div>
                   </div>
                </div>
          </div>
          <div class="row">
                <div class="col-sm-12 text-right">
                  <input type="submit" value="Submit" class="btn btn-success submitbtn"/>
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-------------------edit event type mannage-------------------->

<div class="modal fade bd-example-modal-lg" id="updateEventTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Event Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>EventType/updateEventType" method="post">
          <div class="form-group row">
            <input type="hidden" name="uptypeid"/>
                <div class="col-sm-12">
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Event Type ID:</label>
                      <div class="col-sm-8 text-center">
                          <label class="col-form-label lead" id="eventtypeid"></label>
                      </div>
                  </div>    
                  <div class="row">
                      <label class="col-sm-4 col-form-label lead">Event Type:</label>
                      <div class="col-sm-8">
                          <input type="text" name="uptypetitle" class="form-control" placeholder="Update Event Type" autofocus="true" required="required"/>
                      </div>
                   </div>
                </div>
          </div>
          <div class="row">
                <div class="col-sm-12 text-right">
                  <input type="submit" value="Submit" class="btn btn-success submitbtn"/>
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
    $(document).ready(function(){
      //show.bs.modal jquery attributes
      $('#updateEventTypeModal').on('show.bs.modal', function(e) {
        var eventTypeId = $(e.relatedTarget).data('event-type-id');  
        var type_title = $(e.relatedTarget).data('event-type');
        $(e.currentTarget).find('input[name="uptypeid"]').val(eventTypeId);
        $(e.currentTarget).find('input[name="uptypetitle"]').val(type_title);
        $('#eventtypeid').html(eventTypeId);
      });
  
    });
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>