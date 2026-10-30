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

  .table-responsive {
    max-height:552;
    }

</style>

<div class="container-fluid">
  <h4 class="text-center heading">Email Management</h4>
  <div class="text-right mb-2">
    <a href="addCSVmail" class="btn btn-primary btn-sm text-center"><strong><i class="fas fa-user-plus"></i>Add New CSV</strong></a>

    
<!-- <?php echo base_url('EmailSetup/sendMail'); ?> -->
    <a href="#" id="sendMail" class="btn btn-warning btn-sm text-center"><strong>Send Eamil</strong></a>
    
    <?php  if(!empty($CsvRecords)) { ?>

    <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal"><strong>Delete Table</strong></a>
    <?php }?>
  </div>  
    <!-- Display status message -->
    <?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
    <?php } if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
  
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark" style="position: sticky;">
                    <tr>
                        <th class="text-center">#ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Send Mail Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($CsvRecords)){ foreach($CsvRecords as $row){ ?>
                    <tr>
                        <td class="text-center"><?php echo $row['id']; ?></td>
                        <td class="text-center"><?php echo $row['name']; ?></td>
                        <td class="text-center"><?php echo $row['email']; ?></td>

                        <?php  if($row['status']){?>

                        <td class="text-center text-success"> True</td>

                        <?php } else { ?>

                        <td class="text-center text-danger"> False </td>

                        <?php }?>
                        
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found...</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- Data list table -->
        
    </div>

</div>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Confirmation !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data delete once can not be recover !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url('EmailSetup/deleteTableRecord'); ?>" class="btn btn-default" > Delete</a>
      </div>
    </div>
  </div>
</div>
<input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>">
<?php $this->load->view("admin/commons/adminfooter.php") ;?>

<script type="text/javascript">
  
  $(function() {

    var baseurl=$('#base_url').val();

    baseurl=baseurl+'mail-send' ;
      
    $('#sendMail').click(function(){

      console.log('true1');

      var msg = callAjax(baseurl);

      if(msg==false){

        clearInterval(interval);
        console.log('true1');
      }

      var interval = setInterval(function(){
        
        console.log('true22');
        msg2 = callAjax(baseurl);

        if(msg2==false){

        clearInterval(interval);
        console.log('true22');
      }

      },100); 
    
    });

  });


  function callAjax(baseurl) {
    var flag;
    $.ajax({            
            url : baseurl,
            success : function(response) {
              
            flag=response ;

            
          }      

      });

    return flag;
  }

</script>

<?php 
}else{
  redirect(base_url()."login");
}
?>