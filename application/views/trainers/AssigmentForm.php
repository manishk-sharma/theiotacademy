<?php include 'assets/template/header.php';?>

<h1 class="title">Assignment</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Assignment_model');
    $assignment=$CI->Assignment_model->assignmentList(filter_input(INPUT_GET,'assignment_id'));
    
    
?>
<form method="post" action="<?= base_url();?>Assignmentcnt/assignmentSave" enctype="multipart/form-data" onsubmit="return frm_validate();">
    <input type="hidden" name="subject_id" value="<?php echo (isset($assignment->subject_id) ? $assignment->subject_id : filter_input(INPUT_GET,'subject_id'));?>">
    <input type="hidden" name="module_id" value="<?php echo (isset($assignment->module_id) ? $assignment->module_id : filter_input(INPUT_GET,'module_id'));?>">
    <input type="hidden" name="topic_id" value="<?php echo (isset($assignment->topic_id) ? $assignment->topic_id : filter_input(INPUT_GET,'topic_id'));?>">
    <input type="hidden" name="assignment_id" value="<?php echo filter_input(INPUT_GET, 'assignment_id')?>">
    
    <table class="table table-condensed">
       <tbody>
         
           <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" readonly="" name="subject_name" id="subject-name" value="<?php echo (isset($assignment->subject_name) ? $assignment->subject_name: filter_input(INPUT_GET, 'subject_name'));?>" style="width:100%;"></td>
          
            <th style="width:150px;">Module Name</th>
            <td><input type="text" readonly="" name="module_name" id="module-name" value="<?php echo (isset($assignment->module_name) ? $assignment->module_name: filter_input(INPUT_GET, 'module_name'));?>" style="width:100%;"></td>
          </tr>
          
          <tr>
            <th style="width:150px;">Topic Name</th>
            <td colspan="3"><input type="text" readonly="" name="topic_name" id="topic-name" value="<?php echo (isset($assignment->topic_name) ? $assignment->topic_name: filter_input(INPUT_GET, 'topic_name'));?>" style="width:100%;"></td>
          </tr>
           
          <tr>
            <th style="width:150px;">Title</th>
            <td colspan="3">
                <input type="text" maxlength="400" id="assignment_title" name="assignment_title" style="width:100%;" value="<?php echo (isset($assignment->assignment_title) ? $assignment->assignment_title:'');?>">
            </td>
          </tr>
          
          <tr>
            <th style="width:150px;">Upload File</th>
            <td colspan="3">
                <input type="file" class="btn-primary" id="assignment_file" name="assignment_file"  style="width:100%; display: none;" value="<?php echo (isset($assignment->assignment_title) ? $assignment->assignment_title:'');?>">
                <button type="button" class ="btn-primary" onclick="browse();">Upload</button>
                <p id="file_name" style="display: inline-block; font-weight: bold;"><?php echo (isset($assignment->assignment_title) && file_exists("uploads/assignment/".filter_input(INPUT_GET, 'assignment_id').".pdf") ? $assignment->assignment_title.".pdf":'');?></p>
            </td>
          </tr>
          
          
       </tbody>
    </table>
           
    
    <a href="<?php echo base_url()?>Assignmentcnt?subject_id=<?php echo (isset($assignment->subject_id) ? $assignment->subject_id : filter_input(INPUT_GET,'subject_id'));?>&module_id=<?php echo (isset($assignment->module_id) ? $assignment->module_id : filter_input(INPUT_GET,'module_id'));?>&topic_id=<?php echo (isset($assignment->topic_id) ? $assignment->topic_id : filter_input(INPUT_GET,'topic_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
    <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'assignment_id')==0 ? 'Save' : 'Update')?></button>
    
</form>


<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
   
    $("#assignment_file").on("change",function() {
        var file=$("#assignment_file").val().replace(/C:\\fakepath\\/i,'');
        $("#file_name").text(file);
    });


});

function browse(){
    $("#assignment_file").click();
  
}

function frm_validate(){
   
    if(!$("#assignment_title").val()){
        $("#errMsg").html("Enter Title of the File");
        return false;
    }
    
    if(!$("#file_name").text()){
         $("#errMsg").html("Select a File");
        return false;
    }
}

function navActive(){
    $("#studymaterial-nav").addClass("activenav");
}
    
</script>