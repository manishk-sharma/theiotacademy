<?php include 'assets/template/header.php';?>

<h1 class="title">Batch</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Batch_model');
    $batch=$CI->Batch_model->batchList(filter_input(INPUT_GET,'batch_id'));

?>
<form method="post" action="<?= base_url();?>Batchcnt/batchSave" onsubmit="return frm_validate();">
    <input type="hidden" name="batch_id" value="<?php echo filter_input(INPUT_GET, 'batch_id')?>">
    <table class="table  table-hover table-condensed">
       <tbody>
          <tr>
            <th style="width:150px;">Batch Name</th>
            <td><input type="text" maxlength="40" name="batch_name" id="batch-name" value="<?php echo (isset($batch->batch_name) ? $batch->batch_name:'');?>" style="width:100%;"></td>
          </tr>
          <tr>
              <td colspan="2">
                  <a href="<?php echo base_url()?>Batchcnt"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                  <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'batch_id')==0 ? 'Save' : 'Update')?></button>
              </td>
          </tr>
        </tbody>

    </table>
</form>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){

    
});

function frm_validate(){
    if(!$("#batch-name").val()){
        $("#errMsg").html("PLease write the batch name");
        return false;
    }
    else{
        return true;
    }
    
}
    
</script>