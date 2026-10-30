<?php  
if($this->session->userdata("logged_in")){
?>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
 <script src="<?php echo asset_url()?>ckeditor4n/ckeditor4n/ckeditor.js"></script>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">

  .submitbtn{
    width:150px; 
    border-radius:25px; 
    font-weight:bold; 
  }

  .modal-gradient{
    background: rgb(95,52,235);
    background: linear-gradient(90deg, rgba(95,52,235,1) 16%, rgba(181,39,241,1) 42%, rgba(215,37,90,1) 92%);
     color: white;
  }

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

</style> 

<div class="container-fluid">
  <h4 class="text-center heading mt-1">Uploaded Job List</h4>
  <div class="text-right mb-3">
    <a href="<?=base_url().'upload-job'?>"class="btn btn-primary btn-sm"><strong><i class="fas fa-user-plus"></i>Add New Job</strong></a>
  </div>
  <div><h4 class="text-success" id="updatedhjcv"></h4></div>
<div class="row ">
  <div class="col-sm-9">
  </div>
  <div class="col-sm-3">
      <nav aria-label="Page navigation example">
          <span class="pagination float-right">
              <?php print_r($data['links']); ?>
          </span>
      </nav><!-- .navigation end -->
  </div>
</div>
  <div class="accordion" id="accordionExample">
  <?php 
   if (count($result)>0){
  foreach($result as $row){ ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody> 
          <tr>
            <td class="idcol"><?=$row['id']; ?></td>
            <td><?=$row['job_title']?></td>
            <td colspan="3" class="text-right edatecol">last date: <?=date('d-m-Y',strtotime($row['deadline']))?></td>
          </tr>
          <tr>
             <td colspan="3"></td>
            <td class="text-right buttoncol pt-2 pr-2">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row['id']?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
            <td class="text-right buttoncol pt-2 pr-2">
                <button class="btn btn-danger btn-sm deletebtnvc" type="submit" name="remove_levels" value="delete" title="Delete Job" data-course-id="<?=$row['id']?>" data-toggle="modal" data-target=".deleteModol" >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
            <td class="text-right buttoncol pt-2">
                <button class="updatejobcd btn btn-success btn-sm" type="submit" name="remove_levels" value="edit job" title="edit Job" data-jb-id="<?=$row['id']?>" data-toggle="modal" data-target=".updateModol" >
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>
    <div id="collapseOne<?=$row['id']?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
       <div class="row">
          <div class="col-sm-12">
            <div class="mt-4">
                <p class="m-0"><b>Job Title</b></p>
                <p><span><?=$row['job_title']?></span></p>
                
                <p class="m-0"><b>Job Deadline</b></p>
                <p><span><?=date('d-m-Y',strtotime($row['deadline']))?></span></p>
                <p class="m-0"><b>Job Details</b></p>
                <p><span><?=$row['job_details']?></span></p>
            </div>
         </div>
       </div>
      </div>
    </div>
  </div>

<?php } ?>

</div>
<br>
</div>
 <div class="modal fade deleteModol" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modal-gradient">
        <div class="modal-body">
          Are you sure?
           <input type="hidden" name="blog_id" id="blog_id">
           <input type="hidden" name="baseurl" id="baseurl" value="<?=base_url();?>">
        </div>
        <div class="modal-footer">
          <a id="deleteurl" href="<?php echo base_url().'JobUploadController/DeleteJob/'.$row['id']?>" class="btn btn-danger"> Delete </a>
          <a type="button" data-dismiss="modal" class="btn"> Cancel</a>
        </div>
    </div>
  </div>
</div>

<div class="modal fade updateModol" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update This Job</h5>
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       <form id="Updajojbformn" method="post" onsubmit="return false">
    <div class="form-group">
      <input id="findid" type="hidden" name="idofjob" value="">
      <label for="inputEmail4">Job Title</label>
      <input id="findtitelnm" type="text" class="form-control" name="ujobtitle" value="">
    </div>
  <div class="form-group">
    <label for="inpputlocation">Job Location</label>
    <input id="findjblocatininm" type="text" class="form-control" name="ujjloction" value="">
  </div>
  <div class="form-group">
    <label for="inputAddress">Job Deadline</label>
    <input id="findjbdeadlinm" type="date" class="form-control" name="ujdeadline" value="">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Number Of Vacancy</label>
    <input id="findnofvc" type="number" class="form-control" name="ujvacancy" value="">
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputCity" id="gkhjgkhjg">Job Details</label>
     <textarea id="editor1" class="content form-control jobudtcx" name="jobdetails" rows="10"></textarea>  
    </div>
    
  </div>
  <button type="submit" class="btn btn-primary">Update</button>
</form>

      </div>
    </div>
  </div>
</div>


<div class="row mb-3 ">
    <div class="col-sm-9">
    </div>
    <div class="col-sm-3">
        <nav aria-label="Page navigation example">
            <span class="pagination float-right">
                <?php print_r($data['links']); ?>
            </span>
        </nav><!-- .navigation end -->
    </div>

</div>

<?php
}
else{
?>
<div class="container">
  <h2 class="text-center">There is No Job Found, Please Upload a New Job.</h2>
</div>
<?php }?>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.deletebtnvc').on('click', function(e){ 
      var courseId = $(this).data('course-id'); 
      var delete_url=document.getElementById('deleteurl');
      var baseurl=document.getElementById('baseurl').value;
      delete_url.href=baseurl+'JobUploadController/DeleteJob/'+courseId;
      //alert(delete_url.href);
    });
  });  

</script>

<?php 
}else{

  redirect(base_url()."login");

}

?>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script>
    CKEDITOR.replace('editor1');
    function updateCKEditorStatus() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            return true; // Return true to allow form submission
        }

    $(document).ready(function(){
    $(".updatejobcd").on("click", function(e){
       var updidforj = $(this).data('jb-id');
        const formUrl = '<?= base_url() ?>JobUploadController/editmatjobdata';
        $.ajax({
            type: 'post',
            url: formUrl,
            data: {'e_idupv':updidforj},
             dataType:'json',

            success: function (data) {
                if (data.message=="success") { 
                   
                   $("#findid").val(data.response[0].id); 
                   $("#findtitelnm").val(data.response[0].job_title); 
                   $("#findjblocatininm").val(data.response[0].job_location); 
                   $("#findjbdeadlinm").val(data.response[0].deadline); 
                   $("#findnofvc").val(data.response[0].vacancy); 
                   // $("#editor1").val(data.response[0].job_details); 
                    CKEDITOR.instances['editor1'].setData(data.response[0].job_details);
                }
                else{
                    $('#error-msg').show();
                    $('#error-msg').html(data.response);
                    $('#error-msg').fadeOut(15000);
                }
            
        }   
    });
});


     $("#Updajojbformn").submit(function(e) {
        const formUrl = '<?= base_url() ?>JobUploadController/update_jobin';
        updateCKEditorStatus();
        const formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: formUrl,
            processData: false,
            contentType: false,
            dataType:'json',
            data: formData,
            beforeSend: function() {
                $('#enqform-overlay').show();
            },
            
            success: function (data) {
            if (data.message=="error") {
                alert(removeTags(data.response));
                $('#enqform-overlay').hide();
            }
            else{
                if (data.message=="success") { 
                    $('#updatedhjcv').show();
                    // $('.updateModol').modal('hide');
                     $('#closemodal').click ();
                $('#updatedhjcv').html(data.response);
                $('#enqform-overlay').hide();
                }
                else{
                    $('#error-msg').show();
                    $('#error-msg').html(data.response);
                    $('#error-msg').fadeOut(15000);
                }
            }
        }   
    });
});
});

</script>