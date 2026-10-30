<?php include 'assets/template/header.php';?>

<h1 class="title">Topic</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Topic_model');
    $topic=$CI->Topic_model->topicList(filter_input(INPUT_GET,'topic_id'));

?>
<form method="post" action="<?= base_url();?>Topiccnt/topicSave" onsubmit="return frm_validate();">
    <input type="hidden" name="subject_id" value="<?php echo (isset($topic->subject_id) ? $topic->subject_id : filter_input(INPUT_GET,'subject_id'));?>">
    <input type="hidden" name="module_id" value="<?php echo (isset($topic->module_id) ? $topic->module_id : filter_input(INPUT_GET,'module_id'));?>">
    <input type="hidden" name="topic_id" value="<?php echo filter_input(INPUT_GET, 'topic_id')?>">
    <table class="table table-condensed">
       <tbody>
         
           <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" readonly="" name="subject_name" id="subject-name" value="<?php echo (isset($topic->subject_name) ? $topic->subject_name: filter_input(INPUT_GET, 'subject_name'));?>" style="width:100%;"></td>
          </tr>
          
          <tr>
            <th style="width:150px;">Module Name</th>
            <td><input type="text" readonly="" name="module_name" id="module-name" value="<?php echo (isset($topic->module_name) ? $topic->module_name: filter_input(INPUT_GET, 'module_name'));?>" style="width:100%;"></td>
          </tr>
           
           <tr>
            <th style="width:150px;">Topic Name</th>
            <td><input type="text" maxlength="40" name="topic_name" id="topic-name" value="<?php echo (isset($topic->topic_name) ? $topic->topic_name:'');?>" style="width:100%;"></td>
          </tr>
          <tr>
              <td colspan="2">
                  <a href="<?php echo base_url()?>Topiccnt?subject_id=<?php echo (isset($topic->subject_id) ? $topic->subject_id : filter_input(INPUT_GET,'subject_id'));?>&module_id=<?php echo (isset($topic->module_id) ? $topic->module_id : filter_input(INPUT_GET,'module_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                  <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'topic_id')==0 ? 'Save' : 'Update')?></button>
              </td>
          </tr>
        </tbody>

    </table>
</form>


<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
    
});

function frm_validate(){
    if(!$("#topic-name").val()){
        $("#errMsg").html("Missing Credentials");
        return false;
    }
    else{
        return true;
    }
    
}

function navActive(){
    $("#topic-nav").addClass("activenav");
}
    
</script>