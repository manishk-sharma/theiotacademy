<?php include 'assets/template/header.php';?>

<h1 class="title">Question</h1>

<hr>

<?php
    $CI =& get_instance();
    $CI->load->model('Topic_model');
    $question=$CI->Question_model->questionList(filter_input(INPUT_GET,'question_id'));
    $option =$CI->Question_model->optionList(filter_input(INPUT_GET,'question_id'));
    
    
?>
<form method="post" action="<?= base_url();?>Questioncnt/questionSave" onsubmit="return frm_validate();">
    <input type="hidden" name="subject_id" value="<?php echo (isset($question->subject_id) ? $question->subject_id : filter_input(INPUT_GET,'subject_id'));?>">
    <input type="hidden" name="module_id" value="<?php echo (isset($question->module_id) ? $question->module_id : filter_input(INPUT_GET,'module_id'));?>">
    <input type="hidden" name="topic_id" value="<?php echo (isset($question->topic_id) ? $question->topic_id : filter_input(INPUT_GET,'topic_id'));?>">
    <input type="hidden" name="question_id" value="<?php echo filter_input(INPUT_GET, 'question_id')?>">
    
    <table class="table table-condensed">
       <tbody>
         
           <tr>
            <th style="width:150px;">Subject Name</th>
            <td><input type="text" readonly="" name="subject_name" id="subject-name" value="<?php echo (isset($question->subject_name) ? $question->subject_name: filter_input(INPUT_GET, 'subject_name'));?>" style="width:100%;"></td>
          
            <th style="width:150px;">Module Name</th>
            <td><input type="text" readonly="" name="module_name" id="module-name" value="<?php echo (isset($question->module_name) ? $question->module_name: filter_input(INPUT_GET, 'module_name'));?>" style="width:100%;"></td>
          </tr>
          
          <tr>
            <th style="width:150px;">Topic Name</th>
            <td colspan="3"><input type="text" readonly="" name="topic_name" id="topic-name" value="<?php echo (isset($question->topic_name) ? $question->topic_name: filter_input(INPUT_GET, 'topic_name'));?>" style="width:100%;"></td>
          </tr>
          
          <tr>
            <th style="width:150px;">Question No.</th>
            <td>
                <input type="text" id="question_no" name="question_no" value="<?php echo (isset($question->question_no) ? $question->question_no:'');?>" style="width:100px;">
            </td>
            <th style="width:150px;">Difficulty Level</th>
            <td>
                <select id="level-list" name="level_id" style="width:200px;">
                </select
            </td>
          </tr>
           <tr>
            <th style="width:150px;">Question</th>
            <td colspan="3">
                <textarea type="text" maxlength="400" id="question_name" name="question_name" id="question-name"  style="width:100%;"><?php echo (isset($question->question_name) ? $question->question_name:'');?></textarea>
            </td>
          </tr>
          
       </tbody>
    </table>
           
    <div class="container-fluid" style="margin-bottom: 5px;">
    <?php 
        $arr = array();
        for($i=0;$i<count($option);$i++){
            $arr[$option[$i]->option_no-1] = $i;  
        }
        for($i=0;$i<4;$i++){
        if(($i+1)%2==0){ echo"<div class='row' style='margin-bottom:5px;'>";}?>
                <div class="col-sm-6 option-rec">
                    <?php echo"<label style='width:100%'>Option [". chr($i+65) ."]<div style='display:inline-block; float:right;'>Correct</div></label>" ?>
                    <input type="hidden" class="option_flag" name="option_flag[]" value="<?php echo(isset($arr[$i]) ? $option[$arr[$i]]->option_flag :'');?>">
                    <input type="hidden" name="option_id[]" value="<?php echo (isset($arr[$i]) ? $option[$arr[$i]]->option_id :'');?>">
                    <input style="width: calc(100% - 40px);"  maxlength="100" id="option_name" class="option_name" name="option_name[]" value="<?php echo (isset($arr[$i]) ? $option[$arr[$i]]->option_name :'');?>">
                    <input type="checkbox" class="check" style="float:right;" <?php echo((isset($arr[$i])&& $option[$arr[$i]]->option_flag=='Y')? 'checked':'');?> onchange="option_checked(this);">
                </div>
    <?php if(($i+1)%2==0){ echo"</div>";}}?>
        
    </div>
    
    
    <table class="table table-hover table-condensed">
       <tbody>
           <tr>
            <th style="width:150px;">Remarks/Desciption</th>
            <td colspan="3">
                <textarea type="text" maxlength="200" name="remark" style="width:100%;"><?php echo (isset($question->remark) ? $question->remark:'');?></textarea>
            </td>
          </tr>
       
       </tbody>
    </table>
    <a href="<?php echo base_url()?>Questioncnt?subject_id=<?php echo (isset($question->subject_id) ? $question->subject_id : filter_input(INPUT_GET,'subject_id'));?>&module_id=<?php echo (isset($question->module_id) ? $question->module_id : filter_input(INPUT_GET,'module_id'));?>&topic_id=<?php echo (isset($question->topic_id) ? $question->topic_id : filter_input(INPUT_GET,'topic_id'));?>"><button type='button' class='btn-primary'>Back</button></a>&nbsp;
    <button type='submit' class='btn-success'><?php echo (filter_input(INPUT_GET,'question_id')==0 ? 'Save' : 'Update')?></button>
    
</form>


<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
navActive();
insLevelList();

    
});

function insLevelList(){
     
    var appendme;
    var level_id = "<?php echo (isset($question->level_id) ?$question->level_id: '' ) ?>";
    $("#level-list").html("");
    $.ajax({
        url: "<?php echo base_url();?>Levelcnt/levelList",
        type: "post",
        async: false,
        success: function(feedback){
           try{
                var arr = JSON.parse(feedback);
                $("#level-list").html("<option value=''>Select Level</option>");
                for(var i in arr){  
                  appendme="<option value='"+arr[i]['level_id']+"'>"+arr[i]['level_name']+"</option>";
                  $("#level-list").append(appendme);
                }
            
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
    $("#level-list").val(level_id);
    
    
}

function option_checked(el){
    
   var par=$(el).closest("div");
    
    if($(el).prop("checked")){
        par.find(".option_flag").val("Y");
    }
    else{
        par.find(".option_flag").val("");
    }
        
    
}



function frm_validate(){
    
    var check=0;
    var option=0;
 
    if(!$("#question_no").val()){
        $("#errMsg").html("Enter Question Number");
        return false;
    }

    if(!$("#question_name").val()){
        $("#errMsg").html("Enter Question Name");
        return false;
    }
    
    $("div.option-rec").each(function (){
       if($(this).find(".option_name").val()){
         option++;
         if($(this).find(".option_flag").val()){
            check++;
            }
        }
    });
    
    if(option < 2){
        $("#errMsg").html("Please enter atleast two option values");
        return false;
    }
    
    if(check < 1){
        $("#errMsg").html("Please Check atleast one correct option");
        return false;
    }
    
    return true;
}

function navActive(){
    $("#question-nav").addClass("activenav");
}
    
</script>