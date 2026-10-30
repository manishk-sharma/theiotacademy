<?php include 'assets/template/header.php';?>

<h1 class="title">Student</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Student_model');
    $student=$CI->Student_model->studentList(filter_input(INPUT_GET,'student_id'));
?>

<form method="post" action="<?= base_url();?>Studentcnt/studentSave" onsubmit="return frm_validate();">
    <input type="hidden" name="student_id" value="<?php echo filter_input(INPUT_GET, 'student_id')?>">
    <input type="hidden" name="batch_id" value="<?php echo (isset($student->batch_id) ? $student->batch_id : filter_input(INPUT_GET,'batch_id'));?>">
    <table class="table table-hover table-condensed">
        <tbody>
            <tr>
                <th style="width:150px;">Batch Name</th>
                <td><input type="text" readonly="" name="batch_name" id="batch-name" value="<?php echo (isset($student->batch_name) ? $student->batch_name: filter_input(INPUT_GET, 'batch_name'));?>" style="width:100%;"></td>
            </tr>
           
            <tr>
                <th style="width:150px;">Student Name</th>
                <td><input type="text" maxlength="40" name="student_name" id="student-name" value="<?php echo (isset($student->student_name) ? $student->student_name:'');?>" style="width:100%;"></td>
            </tr>
          
            <tr>
                <td colspan="2">
                    <a href="<?php echo base_url()?>Studentcnt?batch_id=<?php echo (isset($student->batch_id) ? $student->batch_id : filter_input(INPUT_GET,'batch_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
                    <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'student_id')==0 ? 'Save' : 'Update')?></button>
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
    if(!$("#student-name").val()){
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