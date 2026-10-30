<?php include 'assets/template/header.php';?>

<h1 class="title">Students</h1>

<div class="form-control" style="margin-bottom: 5px; width: 500px; display: inline-block; border: none; box-shadow: none;">
    <label for="batch-list">Select Batch</label>
    <select id="batch-list" style="width:250px" name="batch_id" onchange="getstudentList(this.value);"></select>
</div>

<div style="display: inline-block; float: right;">
    <?php  if(filter_input(INPUT_GET, 'test_id')){ ?>
    <button type="button" class="btn-primary" onclick="assign_button();">Assign</button> 
        <input type="hidden" id="test_id" value="<?php echo filter_input(INPUT_GET, 'test_id');?>">
    <?php }elseif(filter_input(INPUT_GET,'studymaterial_id')){ ?>
        <button type="button" class="btn-primary" onclick="assign_button();">Assign</button> 
        <input type="hidden" id="studymaterial_id" value="<?php echo filter_input(INPUT_GET, 'studymaterial_id');?>">
    <?php }elseif(filter_input(INPUT_GET,'assignment_id')){ ?>
        <button type="button" class="btn-primary" onclick="assign_button();">Assign</button> 
        <input type="hidden" id="assignment_id" value="<?php echo filter_input(INPUT_GET, 'assignment_id');?>">
    <?php }else{?>
    
    <button type='button' class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="#" onclick="return val_button(this);">
            <button type='button' class='btn-primary'>New Student</button>
        </a>
    <?php } ?>
</div>

<table class="table  table-hover table-condensed">
   <thead>
       <tr>
        <th>Student Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="student-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
    insBatchList(); 
    init_form();
    

});


function insBatchList(){
    var appendme;
    $("#batch-list").html("");
    $.ajax({
        url: "<?php echo base_url();?>Batchcnt/batchList",
        type: "post",
        async: false,
        success: function(feedback){
           try{
                var arr = JSON.parse(feedback);
                $("#batch-list").html("<option value=''>Select Batch</option>");
                for(var i in arr){  
                  appendme="<option value='"+arr[i]['batch_id']+"'>"+arr[i]['batch_name']+"</option>";
                  $("#batch-list").append(appendme);
                }
            
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
}

function getstudentList(batch_id){
    var appendme;
    $("#errMsg").html("");
    $("#student-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Studentcnt/substudentList?batch_id="+batch_id,
        type: "post",
        async: false,
        success: function(feedback){
 
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr student_id='"+arr[i]['student_id']+"'>";
                  appendme+="<td>"+arr[i]['student_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Studentcnt/studentForm?student_id="+arr[i]['student_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#student-rows").append(appendme);
                }
                
                if(arr.length===0){
                    $("#errMsg").html("No data found");
                }
                
            }catch(err){
            alert("No data Found");
            }
        }      
    });
}

function val_button(el){
  
    if(!$("#batch-list").val()){
        $("#errMsg").html("Batch Not Selected");
        return false;
    }
    $(el).attr("href","<?php echo base_url();?>Studentcnt/studentForm?student_id=0&batch_id="+$("#batch-list").val()+"&batch_name=" + $('#batch-list option:selected').text());
    return true;
  
}

function assign_button(){
    
    
    var count=0;
    $("#student-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        $("#errMsg").html("Select atleat one student");
        return false;
    }
    
    else{
        if($('#test_id').val()){
            if(confirm("Do you want to Assign?")){
                $("#errMsg").html("");
                var par,test_id,student_id;
                $("#student-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      student_id=par.attr("student_id");
                      test_id= $("#test_id").val();

                        $.ajax({
                        url: "Testcnt/studentAssign?test_id="+test_id+"&student_id="+student_id,
                        type: "post",
                        async: false,
                        success: function(feedback){

                            if(feedback.indexOf("true")>=0){
                                $("#errMsg").html("Assigned");
                            }
                            else{
                                $("#errMsg").html("Failed To Assigned");
                            }
                        }
                        });
                    } 
                });
            }

        }
        
        else if($('#studymaterial_id').val()){
            
            if(confirm("Do you want to Assign?")){
                $("#errMsg").html("");
                var par,student_id,studymaterial_id;
                $("#student-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      student_id=par.attr("student_id");
                      studymaterial_id= $("#studymaterial_id").val();
                        $.ajax({
                        url: "StudyMaterialcnt/studentAssign?studymaterial_id="+studymaterial_id+"&student_id="+student_id,
                        type: "post",
                        async: false,
                        success: function(feedback){
                           
                            if(feedback.indexOf("true")>=0){
                                $("#errMsg").html("Assigned");
                            }
                            else{
                                $("#errMsg").html("Failed To Assigned");
                            }
                        }
                        });
                    } 
                });
            }

        }
        
        else if($('#assignment_id').val()){
            if(confirm("Do you want to Assign?")){
                $("#errMsg").html("");
                var par,assignment_id,studymaterial_id;
                $("#student-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      student_id=par.attr("student_id");
                      assignment_id= $("#assignment_id").val();
                        $.ajax({
                        url: "Assignmentcnt/studentAssign?assignment_id="+assignment_id+"&student_id="+student_id,
                        type: "post",
                        async: false,
                        success: function(feedback){
                            if(feedback.indexOf("true")>=0){
                                $("#errMsg").html("Assigned");
                            }
                            else{
                                $("#errMsg").html("Failed To Assigned");
                            }
                        }
                        });
                    } 
                });
            }

        }
        
        
        
    }
    
    
}





function init_form(){
    var batch_id="<?php echo filter_input(INPUT_GET, 'batch_id');?>";
    if(batch_id){
        $("#batch-list").val(batch_id);
        getstudentList(batch_id);
    }
    
}

function delRecord(){
   
   var count=0;
   $("#student-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    
    if(confirm("Do you want to delete?")){
        var par,student_id;
        $("#student-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                  par=$(this).closest("tr");
                  student_id=par.attr("student_id");
                    $.ajax({
                        url: "Studentcnt/studentDelete?student_id="+student_id,
                        type: "post",
                        async: false,
                        success: function(feedback){
                          if(feedback.indexOf("true")>=0){
                               par.remove();
                            }
                            else{
                                alert("Can't Delete");
                            }
                          }
                    });
            }
        });
    }
}


function checkAll(el){
    $("input.check").prop("checked",$(el).prop("checked"));
}

function navActive(){
    $("#student-nav").addClass("activenav");
}
    
</script>