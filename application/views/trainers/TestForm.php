<?php include 'assets/template/header.php';?>

<h1 class="title">Test</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Test_model');
    $test=$CI->Test_model->testList(filter_input(INPUT_GET,'test_id'));
    
?>
<form method="post" action="<?= base_url();?>Testcnt/testSave" onsubmit="return frm_validate();">
    <input type="hidden" name="test_id" value="<?php echo filter_input(INPUT_GET, 'test_id')?>">
    <table class="table table-condensed">
       
        <tbody>

            <tr>
                <th style="width:150px;">Test Name</th>
                <td><input type="text" maxlength="40" name="test_name" id="test-name" value="<?php echo (isset($test->test_name) ? $test->test_name:'');?>" style="width:100%;"></td>
            </tr>
            
            <tr>
                <th style="width:150px;">Marks</th>
                <td><input type="text" maxlength="40" name="test_marks" id="test-marks" value="<?php echo (isset($test->test_marks) ? $test->test_marks:'');?>" style="width:100%;"></td>
            </tr>
            
            <tr>
                <th style="width:150px;">Test Duration</th>
                <td><input type="text" maxlength="40" name="test_duration" id="test-duration" value="<?php echo (isset($test->test_duration) ? $test->test_duration:'');?>" style="width:100%;"></td>
            </tr>
 
            <tr>
                <td colspan="2">
                    <a href="<?php echo base_url()?>Testcnt"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                    <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'test_id')==0 ? 'Save' : 'Update')?></button>
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
    if(!$("#test-name").val()){
        $("#errMsg").html("Missing Credentials");
        return false;
    }
    else{
        return true;
    }
    
}

function navActive(){
    $("#test-nav").addClass("activenav");
}
    
</script>