<?php include 'assets/template/header.php';?>

<h1 class="title">Question</h1>

<div class="form-control" style="margin-bottom: 5px; width: 800px; display: inline-block; border: none; box-shadow: none;">
    <label for="subject-list">Select Subject</label>
    <select id="subject-list" style="width:150px;" name="subject_id" onchange="insModuleList(this.value);"></select>
    <label for="module-list">Select Module</label>
    <select id="module-list" style="width:150px; display: inline-block;" name="module_id" onchange="insTopicList(this.value);"></select>
    <label for="topic-list">Select Topic</label>
    <select id="topic-list" style="width:150px; display: inline-block;" name="topic_id" onchange="getquestionList(this.value);"></select>
</div>

<div style="display: inline-block; float: right;">
    <button type='button'  class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="#" onclick="return val_button(this);">
            <button type='button' class='btn-primary'>New Question</button>
        </a>
</div>




<table class="table  table-hover table-condensed">
   <thead>
        <tr>
            <th style="width: 20px;">Sr.No</th>
            <th>Question</th>
            <th style="width: 100px;">Created On</th>
            <th style="width: 100px;">Updated On</th>
            <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
        </tr>
    </thead>
     <tbody id="question-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog" style="width: 60%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script>
$(document).ready(function(){
    navActive();
    insSubjectList();
    init_form();
});

function insSubjectList(){
    $("#topic-rows").html("");
    var appendme;
    $("#subject-list").html("");
    $.ajax({
        url: "<?php echo base_url();?>Subjectcnt/subjectList",
        type: "post",
        async: false,
        success: function(feedback){
           try{
                var arr = JSON.parse(feedback);
                $("#subject-list").html("<option value=''>Select Subject</option>");
                for(var i in arr){  
                  appendme="<option value='"+arr[i]['subject_id']+"'>"+arr[i]['subject_name']+"</option>";
                  $("#subject-list").append(appendme);
                }
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
}

function insModuleList(subject_id){
    
    var appendme;    
    $("#topic-rows").html("");
    $("#module-list").html("");
    $("#topic-list").html("<option value=''>Select Module</option>");
    
    $.ajax({
        url: "<?php echo base_url();?>Modulecnt/submoduleList?subject_id="+subject_id,
        type: "post",
        async: false,
        success: function(feedback){
          try{
                var arr = JSON.parse(feedback);
                $("#module-list").html("<option value=''>Select Module</option>");
                    for(var i in arr){  
                      appendme="<option value='"+arr[i]['module_id']+"'>"+ arr[i]['module_name']+"</option>";
                      $("#module-list").append(appendme);
                }
            
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
}

function insTopicList(module_id){
    $("#question-rows").html("");
    var appendme;
    $("#topic-list").html("");
    $.ajax({
        url: "<?php echo base_url();?>Topiccnt/subtopicList?module_id="+module_id,
        type: "post",
        async: false,
        success: function(feedback){
          try{
                var arr = JSON.parse(feedback);
                $("#topic-list").html("<option value=''>Select Topic</option>");
                for(var i in arr){  
                  appendme="<option value='"+arr[i]['topic_id']+"'>"+ arr[i]['topic_name']+"</option>";
                  $("#topic-list").append(appendme);
                }
            
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
}

function getquestionList(topic_id){
    var appendme;
    $("#errMsg").html("");
    $("#question-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Questioncnt/subquestionList?topic_id="+topic_id,
        type: "post",
        async: false,
        success: function(feedback){

            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr question_id='"+arr[i]['question_id']+"'>";
                  appendme+="<td>"+arr[i]['question_no']+"</td>";
                  appendme+="<td class='question_name'>"+arr[i]['question_name']+"</td>";
                  appendme+="<td>"+arr[i]['mcreated_on']+"</td>";
                  appendme+="<td>"+arr[i]['mupdated_on']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Questioncnt/questionForm?question_id="+arr[i]['question_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<button type='button' class='btn-primary' data-toggle='modal' data-target='#myModal' onclick='viewOptions(this,"+arr[i]['question_id']+");'>View</button>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#question-rows").append(appendme);
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
    
    if(!$("#subject-list").val()){
        $("#errMsg").html("Subject Not Selected");
        return false;
    }
    
    if(!$("#module-list").val()){
        $("#errMsg").html("Module Not Selected");
        return false;
    }
    
    if(!$("#topic-list").val()){
        $("#errMsg").html("Topic Not Selected");
        return false;
    }
    
    $(el).attr("href","<?php echo base_url();?>Questioncnt/questionForm?question_id=0&subject_id="+$("#subject-list").val()+"&subject_name=" + $('#subject-list option:selected').text()+"&module_id="+$("#module-list").val()+"&module_name=" + $('#module-list option:selected').text()+"&topic_id="+$("#topic-list").val()+"&topic_name=" + $('#topic-list option:selected').text());
    return true;
    

}

function init_form(){
    var subject_id="<?php echo filter_input(INPUT_GET, 'subject_id');?>";
    var module_id="<?php echo filter_input(INPUT_GET, 'module_id');?>";
    var topic_id="<?php echo filter_input(INPUT_GET, 'topic_id');?>";
    
    if(subject_id){
        $("#subject-list").val(subject_id);
        insModuleList(subject_id);
        $("#module-list").val(module_id);
        insTopicList(module_id);
        $("#topic-list").val(topic_id);
        getquestionList(topic_id);
    }
    
}

function viewOptions(el,question_id){
    $.ajax({
        url: "<?php echo base_url();?>Questioncnt/optionList?question_id="+question_id,
        type: "post",
        async: false,
        success: function(feedback){
           // alert(feedback);
           $("#myModal .modal-title").html($(el).closest("tr").find(".question_name").text());
           $("#myModal .modal-body").html("");
            try{
               var appendme,corr;
                var arr = JSON.parse(feedback);
                for(var i in arr){
                    if(arr[i]['option_flag']==='Y'){
                    corr="<div style='float:right;'>[Correct]</div>";
                    }
                    else{
                    corr='';
                    }
                  appendme="<div style='display:inline-block; width:50%; border: 1px solid #eee; padding: 5px 10px;'><label>Option ["+ String.fromCharCode(parseInt(arr[i]['option_no'])+64)+"]</label>"+corr+"<p> "+arr[i]['option_name']+"</p></div>";
                  $("#myModal .modal-body").append(appendme);
                }
            }catch(err){
            alert("No data Found");
            }
           
        } 
        
    });
        
}

function delRecord(){
   
   var count=0;
   $("#question-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    
    if(confirm("Do you want to delete?")){
        var par,question_id;
        $("#question-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                par=$(this).closest("tr");
                question_id=par.attr("question_id");
               
                $.ajax({
                    url: "Questioncnt/questionDelete?question_id="+question_id,
                    type: "post",
                    async: false,
                    success: function(feedback){
                      if(feedback.indexOf("true")>=0){
                           par.remove();
                        }
                        else{
                            $("#errMsg").html("Can't Delete");
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
    $("#question-nav").addClass("activenav");
}

</script>