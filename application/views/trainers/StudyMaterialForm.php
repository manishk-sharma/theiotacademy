<?php include 'assets/template/header.php';?>

<h1 class="title">Study Material</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('StudyMaterial_model');
    $studymaterial=$CI->StudyMaterial_model->studymaterialList(filter_input(INPUT_GET,'studymaterial_id'));
    
    
?>
<form method="post" action="<?= base_url();?>StudyMaterialcnt/studymaterialSave" enctype="multipart/form-data" onsubmit="return frm_validate();">
    <input type="hidden" name="subject_id" value="<?php echo (isset($studymaterial->subject_id) ? $studymaterial->subject_id : filter_input(INPUT_GET,'subject_id'));?>">
    <input type="hidden" name="module_id" value="<?php echo (isset($studymaterial->module_id) ? $studymaterial->module_id : filter_input(INPUT_GET,'module_id'));?>">
    <input type="hidden" name="topic_id" value="<?php echo (isset($studymaterial->topic_id) ? $studymaterial->topic_id : filter_input(INPUT_GET,'topic_id'));?>">
    <input type="hidden" name="studymaterial_id" value="<?php echo filter_input(INPUT_GET, 'studymaterial_id')?>">
    
    <table class="table table-condensed">
       <tbody>
         
           <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" readonly="" name="subject_name" id="subject-name" value="<?php echo (isset($studymaterial->subject_name) ? $studymaterial->subject_name: filter_input(INPUT_GET, 'subject_name'));?>" style="width:100%;"></td>
          
            <th style="width:150px;">Module Name</th>
            <td><input type="text" readonly="" name="module_name" id="module-name" value="<?php echo (isset($studymaterial->module_name) ? $studymaterial->module_name: filter_input(INPUT_GET, 'module_name'));?>" style="width:100%;"></td>
          </tr>
          
          <tr>
            <th style="width:150px;">Topic Name</th>
            <td colspan="3"><input type="text" readonly="" name="topic_name" id="topic-name" value="<?php echo (isset($studymaterial->topic_name) ? $studymaterial->topic_name: filter_input(INPUT_GET, 'topic_name'));?>" style="width:100%;"></td>
          </tr>
           
          <tr>
            <th style="width:150px;">Title</th>
            <td colspan="3">
                <input type="text" maxlength="400" id="studymaterial_title" name="studymaterial_title" style="width:100%;" value="<?php echo (isset($studymaterial->studymaterial_title) ? $studymaterial->studymaterial_title:'');?>">
            </td>
          </tr>
          
          <tr>
            <th style="width:150px;">Upload File</th>
            <td colspan="3">
                <input type="file" class="btn-primary" id="studymaterial_file" name="studymaterial_file"  style="width:100%; display: none;" value="<?php echo (isset($studymaterial->studymaterial_title) ? $studymaterial->studymaterial_title:'');?>">
                <button type="button" class ="btn-primary" onclick="browse();">Upload</button>
                <p id="file_name" style="display: inline-block; font-weight: bold;"><?php echo (isset($studymaterial->studymaterial_title) && file_exists("uploads/".filter_input(INPUT_GET, 'studymaterial_id').".pdf") ? $studymaterial->studymaterial_title.".pdf":'');?></p>
            </td>
          </tr>
          
          
       </tbody>
    </table>
           
    
    <a href="<?php echo base_url()?>StudyMaterialcnt?subject_id=<?php echo (isset($studymaterial->subject_id) ? $studymaterial->subject_id : filter_input(INPUT_GET,'subject_id'));?>&module_id=<?php echo (isset($studymaterial->module_id) ? $studymaterial->module_id : filter_input(INPUT_GET,'module_id'));?>&topic_id=<?php echo (isset($studymaterial->topic_id) ? $studymaterial->topic_id : filter_input(INPUT_GET,'topic_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
    <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'studymaterial_id')==0 ? 'Save' : 'Update')?></button>
    
</form>


<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
   
    $("#studymaterial_file").on("change",function() {
        var file=$("#studymaterial_file").val().replace(/C:\\fakepath\\/i,'');
        $("#file_name").text(file);
    });


});

function browse(){
    
    $("#studymaterial_file").click();
//    if($("#studymaterial_file").){
//        var file=$("#studymaterial_file").val().replace(/C:\\fakepath\\/i,'');
//        $("#file_name").text(file);
//    }
    
    
}

function frm_validate(){
    // var file= document.getElementById("studymaterial_file").files[0].name;
    
   
    if(!$("#studymaterial_title").val()){
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