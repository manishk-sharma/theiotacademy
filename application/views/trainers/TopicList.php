<?php include 'assets/template/header.php';?>

<h1 class="title">Topic</h1>

<div class="form-control" style="margin-bottom: 5px; width: 800px; display: inline-block; border: none; box-shadow: none;">
    <label for="subject-list">Select Subject</label>
    <select id="subject-list" style="width:150px;" name="subject_id" onchange="insModuleList(this.value);"></select>
    <label for="module-list">Select Module</label>
    <select id="module-list" style="width:150px; display: inline-block;" name="module_id" onchange="gettopicList(this.value);"></select>
</div>

<div style="display: inline-block; float: right;">
    <button type='button'  class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="#" onclick="return val_button(this);">
            <button type='button' class='btn-primary'>New Topic</button>
        </a>
</div>




<table class="table  table-hover table-condensed">
   <thead>
       <tr>
           <th>Topic Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="topic-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

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
    $("#topic-rows").html("");
    var appendme;
    $("#module-list").html("");
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

function gettopicList(module_id){
    var appendme;
    $("#errMsg").html("");
    $("#topic-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Topiccnt/subtopicList?module_id="+module_id,
        type: "post",
        async: false,
        success: function(feedback){
          try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr topic_id='"+arr[i]['topic_id']+"'>";
                  appendme+="<td>"+arr[i]['topic_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Topiccnt/topicForm?topic_id="+arr[i]['topic_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Questioncnt?subject_id="+arr[i]['subject_id']+"&module_id="+arr[i]['module_id']+"&topic_id="+arr[i]['topic_id']+"'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#topic-rows").append(appendme);
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
    
    
    $(el).attr("href","<?php echo base_url();?>Topiccnt/topicForm?topic_id=0&subject_id="+$("#subject-list").val()+"&subject_name=" + $('#subject-list option:selected').text()+"&module_id="+$("#module-list").val()+"&module_name=" + $('#module-list option:selected').text());
    return true;

    
}

function init_form(){
    var subject_id="<?php echo filter_input(INPUT_GET, 'subject_id');?>";
    var module_id="<?php echo filter_input(INPUT_GET, 'module_id');?>";
    
    if(subject_id){
        $("#subject-list").val(subject_id);
        insModuleList(subject_id);
        $("#module-list").val(module_id);
        gettopicList(module_id);
    }
    
}

function delRecord(){
   
   var count=0;
   $("#topic-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    
    if(confirm("Do you want to delete?")){
        var par,topic_id;
        $("#topic-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                par=$(this).closest("tr");
                topic_id=par.attr("topic_id");
                $.ajax({
                    url: "Topiccnt/topicDelete?topic_id="+topic_id,
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
    $("#topic-nav").addClass("activenav");
}
    
</script>