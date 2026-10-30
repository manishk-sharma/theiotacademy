<?php include 'assets/template/header.php';?>

<h1 class="title">Study Material</h1>

<div class="form-control" style="margin-bottom: 5px; width: 800px; display: inline-block; border: none; box-shadow: none;">
    <label for="subject-list">Select Subject</label>
    <select id="subject-list" style="width:150px;" name="subject_id" onchange="insModuleList(this.value);"></select>
    <label for="module-list">Select Module</label>
    <select id="module-list" style="width:150px; display: inline-block;" name="module_id" onchange="insTopicList(this.value);"></select>
    <label for="topic-list">Select Topic</label>
    <select id="topic-list" style="width:150px; display: inline-block;" name="topic_id" onchange="getstudymaterialList(this.value);"></select>
</div>

<div style="display: inline-block; float: right;">
    <button type='button'  class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="#" onclick="return val_button(this);">
            <button type='button' class='btn-primary'>New Material</button>
        </a>
</div>




<table class="table  table-hover table-condensed">
   <thead>
        <tr>
            <th style="width: 20px;">Sr.No</th>
            <th style="padding-left: 10px;">Title</th>
            <th style="width:250px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
        </tr>
    </thead>
     <tbody id="studymaterial-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog" style="width: 60%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Assign</h3>
        </div>
        <div class="modal-body">
            <p>To whom you want this test to be assigned?</p>
            <div>
                <a id='student-modal' href="#"><button class='btn-primary'>Student</button></a>
                <a id='batch-modal' href="#"><button class='btn-primary'>Batch</button></a>
            </div>
            
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
    $("#studymaterial-rows").html("");
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

function getstudymaterialList(topic_id){
    var appendme;
    $("#errMsg").html("");
    $("#studymaterial-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>StudyMaterialcnt/substudymaterialList?topic_id="+topic_id,
        type: "post",
        async: false,
        success: function(feedback){
            
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr studymaterial_id='"+arr[i]['studymaterial_id']+"'>";
                  appendme+="<td>"+i+"</td>";
                  appendme+="<td class='studymaterial_title'>"+arr[i]['studymaterial_title']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='#'><button type='button' class='btn-primary' data-toggle='modal' data-target='#myModal' onclick='modal_set(this);'>Assign</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>StudyMaterialcnt/studymaterialForm?studymaterial_id="+arr[i]['studymaterial_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Pdfcnt?studymaterial_id="+arr[i]['studymaterial_id']+"'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#studymaterial-rows").append(appendme);
                   
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
    
    $(el).attr("href","<?php echo base_url();?>StudyMaterialcnt/studymaterialForm?studymaterial_id=0&subject_id="+$("#subject-list").val()+"&subject_name=" + $('#subject-list option:selected').text()+"&module_id="+$("#module-list").val()+"&module_name=" + $('#module-list option:selected').text()+"&topic_id="+$("#topic-list").val()+"&topic_name=" + $('#topic-list option:selected').text());
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
        getstudymaterialList(topic_id);
    }
    
}



function delRecord(){
   
   var count=0;
   $("#studymaterial-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        
        return false;
    }
    
    
    if(confirm("Do you want to delete?")){
        var par,studymaterial_id;
        $("#studymaterial-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                par=$(this).closest("tr");
                studymaterial_id=par.attr("studymaterial_id");
               
                $.ajax({
                    url: "StudyMaterialcnt/studymaterialDelete?studymaterial_id="+studymaterial_id,
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

function modal_set(el){
    $("#myModal #student-modal").attr("href","<?php echo base_url()?>Studentcnt?studymaterial_id="+$(el).closest("tr").attr("studymaterial_id"));
    $("#myModal #batch-modal").attr("href","<?php echo base_url()?>Batchcnt?studymaterial_id="+$(el).closest("tr").attr("studymaterial_id"));
}

function checkAll(el){
    $("input.check").prop("checked",$(el).prop("checked"));
}

function navActive(){
    $("#studymaterial-nav").addClass("activenav");
}

</script>