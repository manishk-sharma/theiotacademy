<?php include 'assets/template/header.php';?>

<h1 class="title">Module</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Module_model');
    $module=$CI->Module_model->moduleList(filter_input(INPUT_GET,'module_id'));

?>
<form method="post" action="<?= base_url();?>Modulecnt/moduleSave" onsubmit="return frm_validate();">
    <input type="hidden" name="module_id" value="<?php echo filter_input(INPUT_GET, 'module_id')?>">
    <input type="hidden" name="subject_id" value="<?php echo (isset($module->subject_id) ? $module->subject_id : filter_input(INPUT_GET,'subject_id'));?>">
    <table class="table  table-hover table-condensed">
       <tbody>
         
           <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" readonly="" name="subject_name" id="subject-name" value="<?php echo (isset($module->subject_name) ? $module->subject_name: filter_input(INPUT_GET, 'subject_name'));?>" style="width:100%;"></td>
          </tr>
           
           <tr>
            <th style="width:150px;">Module Name</th>
            <td><input type="text" maxlength="40" name="module_name" id="module-name" value="<?php echo (isset($module->module_name) ? $module->module_name:'');?>" style="width:100%;"></td>
          </tr>
          <tr>
              <td colspan="2">
                  <a href="<?php echo base_url()?>Modulecnt?subject_id=<?php echo (isset($module->subject_id) ? $module->subject_id : filter_input(INPUT_GET,'subject_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                  <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'module_id')==0 ? 'Save' : 'Update')?></button>
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
    if(!$("#module-name").val()){
        $("#errMsg").html("Missing Credentials");
        return false;
    }
    else{
        return true;
    }
    
}

function navActive(){
    $("#module-nav").addClass("activenav");
}
    
</script>