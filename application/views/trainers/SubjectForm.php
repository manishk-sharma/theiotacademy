<?php include 'assets/template/header.php';?>

<h1 class="title">Subject</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Subject_model');
    $subject=$CI->Subject_model->subjectList(filter_input(INPUT_GET,'subject_id'));

?>
<form method="post" action="<?= base_url();?>Subjectcnt/subjectSave" onsubmit="return frm_validate();">
    <input type="hidden" name="subject_id" value="<?php echo filter_input(INPUT_GET, 'subject_id')?>">
    <table class="table table-condensed">
       <tbody>
          <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" maxlength="40" name="subject_name" id="subject-name" value="<?php echo (isset($subject->subject_name) ? $subject->subject_name:'');?>" style="width:100%;"></td>
          </tr>
          <tr>
              <td colspan="2">
                  <a href="<?php echo base_url()?>Subjectcnt"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                  <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'subject_id')==0 ? 'Save' : 'Update')?></button>
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
    if(!$("#subject-name").val()){
        $("#errMsg").html("Missing Credentials");
        return false;
    }
    else{
        return true;
    }
    
}

function navActive(){
    $("#subject-nav").addClass("activenav");
}
    
</script>