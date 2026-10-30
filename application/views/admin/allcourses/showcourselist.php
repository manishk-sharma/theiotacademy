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
  <h4 class="text-center heading mt-1">All Courses List</h4>
  <div class="text-right mb-3">
    <a href="<?=base_url().'add-instructor-course'?>"class="btn btn-primary btn-sm"><strong><i class="fas fa-user-plus"></i>Add New Course</strong></a>
  </div>
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
  foreach($data as $row){ 
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody> 
          <tr>
            <td class="idcol"><?=$row->id; ?></td>
            <td><?=$row->course_title?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="3"></td>
            <td class="text-right buttoncol pr-2">
               <!-- Button Triggers Update Classroom modal -->
               <a href="<?=base_url().'AddAllCourses/AllCoursefindbyId/'.$row->id?>" class="btn btn-warning btn-sm text-center" title="Update Course"><i class="fas fa-edit"></i></a>
            </td>
            <td class="text-right buttoncol pl-2">
              <a href="<?=$row->course_url?>" target="_blank" class="btn btn-info btn-sm " type="button"  title="view Page"><i class="fas fa-external-link-alt"></i></a>
            </td>
          </tr>
          <tr>
             <td colspan="3"></td>
            <td class="text-right buttoncol pt-2 pr-2">
                <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
            <td class="text-right buttoncol pt-2">
                <button class="btn btn-danger btn-sm" type="submit" name="remove_levels" value="delete" title="Delete Course" data-course-id="<?=$row->id?>" data-toggle="modal" data-target=".deleteModol" >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>
    <div id="collapseOne<?=$row->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
       <div class="row">
         <div class="col-sm-4 text-center">
           <h6 class="text-center">Course Image</h6>
           <img src="<?=base_url().'uploads/allcourse/'.$row->course_image?>" height="200px" width="100%"/>
          <!--  <form action="<?=base_url()?>AddAllCourses/updateimageaddcourse" method="post" enctype="multipart/form-data">
              <input type="file" name="course_image" class="form-control"/> 
              <button type="submit" class="btn btn-success p-2">change image</button>   
           </form> -->
         </div>
          <div class="col-sm-8">
            <div class="mt-4">
                <p class="m-0"><b>Course Deadline:</b> &nbsp;&nbsp;&nbsp;<span><?=$row->course_deadline?></span></p>
                 <p class="m-0"><b>Course Type:</b> &nbsp;&nbsp;&nbsp;<span><?=$row->course_type?></span></p>
                <p class="m-0"><b>Course Duration:</b> &nbsp;&nbsp;&nbsp;<span><?=$row->course_duration?></span></p>
                <p class="m-0"><b>Course Description:</b> &nbsp;&nbsp;&nbsp;<span><?=$row->course_description?></span></p>
                
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
          <a id="deleteurl" href="<?php echo base_url().'AddAllCourses/DeleteCourse/'.$row->id?>" class="btn btn-danger"> Delete </a>
          <a type="button" data-dismiss="modal" class="btn"> Cancel</a>
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
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.deleteModol').on('show.bs.modal', function(e){ 
      var courseId = $(e.relatedTarget).data('course-id'); 
      var delete_url=document.getElementById('deleteurl');
      var baseurl=document.getElementById('baseurl').value;
      delete_url.href=baseurl+'AddAllCourses/DeleteCourse/'+courseId;
      //alert(delete_url.href);
    });
  });  

</script>
<?php 
}else{

  redirect(base_url()."login");

}

?>