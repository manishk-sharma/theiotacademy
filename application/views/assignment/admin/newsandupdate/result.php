<?php 
if($this->session->userdata("user")){
?>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("assignment/admin/common/adminheader.php") ;?>
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
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
  <h4 class="text-center heading mt-1">Uploaded News and Update List</h4>
  <div class="text-right mb-3">
    <a href="<?=base_url().'add-news-and-update'?>"class="btn btn-primary btn-sm"><strong><i class="fas fa-user-plus"></i>Add News and Update</strong></a>
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
		$count=1;
  foreach($result as $row){ ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody> 
          <tr>
            <td class="idcol"><?php echo $count ?></td>
            <td><?=$row['title']?></td>
            <td colspan="3" class="text-right edatecol">last date: <?=date('d-m-Y',strtotime($row['created_at']))?></td>
          </tr>
          <tr>
             <td colspan="3"></td>
            <td class="text-right buttoncol pt-2 pr-2">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row['id']?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
            <td class="text-right buttoncol pt-2 pr-2">
                <button class="btn btn-danger btn-sm deletebtnvc" type="submit" name="remove_levels" value="delete" title="Delete News Update" data-course-id="<?=$row['id']?>" data-toggle="modal" data-target=".deleteModol" >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
            <td class="text-right buttoncol pt-2">
								<a href="<?=base_url().'UploadNewsUpdate/editnewseventdata/'.$row['id']?>" class="btn btn-warning btn-sm text-center" title="Update NewsEvents"><i class="fas fa-edit"></i></a>

            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>
    <div id="collapseOne<?=$row['id']?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
       <div class="row">
          <div class="col-sm-8">
            <div class="mt-4">
                <p class="m-0"><b>Title</b></p>
                <p><span><?=$row['title']?></span></p>
                
                <p class="m-0"><b>Description</b></p>
                <p><span><?=$row['description']?></span></p>
            </div>
         </div>
       </div>
      </div>
    </div>
  </div>

<?php 
$count++ ;
}?>

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
          <a id="deleteurl" href="<?php echo base_url().'UploadNewsUpdate/DeleteNewsUpdate/'.$row['id']?>" class="btn btn-danger"> Delete </a>
          <a type="button" data-dismiss="modal" class="btn"> Cancel</a>
        </div>
    </div>
  </div>
</div>


<?php
}
else{
?>
<div class="container">
  <h2 class="text-center">There is No News and update, Please Upload a New news and event.</h2>
</div>
<?php }?>
<?php $this->load->view("assignment/admin/common/adminfooter.php") ;?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.deletebtnvc').on('click', function(e){ 
      var courseId = $(this).data('course-id'); 
      var delete_url=document.getElementById('deleteurl');
      var baseurl=document.getElementById('baseurl').value;
      delete_url.href=baseurl+'UploadNewsUpdate/DeleteNewsUpdate/'+courseId;
      
    });
  });  

</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>
