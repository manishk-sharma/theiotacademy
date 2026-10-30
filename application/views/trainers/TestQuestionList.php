
<?php include 'assets/template/header.php';?>

<h1 class="title">Test Question</h1>

<form method="post" action="<?php echo base_url();?>TestQuestioncnt/testQuestionSave" id="testQuestion_frm" onsubmit="return frm_validate();">
    <div class="form-control row" style="margin-bottom: 30px; width: 800px; display: inline-block; border: none; box-shadow: none;">
        <div class="col-sm-3">
            <label for="test-list">Select Test</label>
            <select id="test-list" style="width:150px;" name="test_id" onchange="insSubjectList();"></select>
        </div>
        <div class="col-sm-3">
            <label for="subject-list">Select Subject</label>
            <select id="subject-list" style="width:150px;" name="subject_id" onchange="insModuleList(this.value);"></select>
        </div>
        <div class="col-sm-3">
            <label for="module-list">Select Module</label>
            <select id="module-list" style="width:150px; display: inline-block;" name="module_id" onchange="insTopicList(this.value);"></select>
        </div>
        <div class="col-sm-3">
            <label for="topic-list">Select Topic</label>
            <select id="topic-list" style="width:150px; display: inline-block;" name="topic_id" onchange="getquestionList(this.value);"></select>
        </div>
    </div>

    <div class="form-group" style="display: inline-block; float: right;">
        <button type='submit' class='btn-primary'>Add to Test</button>
    </div>
    
    <table class="table table-hover table-condensed">
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
</form>


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
    insTestList();
    init_form();
  
});

function insTestList(){
    var appendme;
    $("#question-rows").html("");
    $("#test-list").html("");
    
    $.ajax({
        url: "<?php echo base_url();?>Testcnt/testList",
        type: "post",
        async: false,
        success: function(feedback){

           try{
                var arr = JSON.parse(feedback);
                $("#test-list").html("<option value=''>Select Test</option>");
                for(var i in arr){  
                  appendme="<option value='"+arr[i]['test_id']+"'>"+arr[i]['test_name']+"</option>";
                  $("#test-list").append(appendme);
                }
            
            }catch(err){
            alert("No data Found");
            }
        }      
    });
    
}

function insSubjectList(){
    var appendme;
    $("#question-rows").html("");
    $("#subject-list").html("");
    $("#module-list").html("");
    $("#topic-list").html("");
    
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
    $("#question-rows").html("");
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
    var appendme;
    $("#question-rows").html("");
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
    var chk='',chkval='';
    var test_id = $("#test-list").val();
    $("#errMsg").html("");
    $("#question-rows").html("");
    
    $.ajax({
        url: "<?php echo base_url();?>Questioncnt/subTestQuestionList?topic_id="+topic_id+"&test_id="+test_id,
        type: "post",
        async: false,
        success: function(feedback){
            
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){
                    if(arr[i]['test_id']){
                        chk="checked";
                        chkval='Y';}
                    else{
                     chk="";
                     chkval="";
                    }
                  appendme="<tr question_id='"+arr[i]['question_id']+"'>";
                  appendme+="<td>"+arr[i]['question_no']+"</td>";
                  appendme+="<td class='question_name'>"+arr[i]['question_name']+"</td>";
                  appendme+="<td>"+arr[i]['mcreated_on']+"</td>";
                  appendme+="<td>"+arr[i]['mupdated_on']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<button type='button' class='btn-primary' data-toggle='modal' data-target='#myModal' onclick='viewOptions(this,"+arr[i]['question_id']+");'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox'"+ chk + " class='check' style='float: right;' onchange='checkQuestion(this);'></td>";
                  appendme+="&nbsp;<input type='hidden' name='question_id[]' class='question_id' value='"+ arr[i]['question_id'] +"'></td>";
                  appendme+="&nbsp;<input type='hidden' name='questioncheck[]' value='"+ chkval + "' class='questioncheck'></td>";
                  appendme+="</tr>";
                  $("#question-rows").append(appendme);
                }
            }catch(err){
            alert("No data Found");
            }
        }      
    });
}



function checkQuestion(el){
    
    var par=$(el).closest("tr");
    if($(el).prop("checked")){
        par.find(".questioncheck").val('Y');
    }
    else{
        par.find(".questioncheck").val('');
    }

}


function init_form(){
    var test_id="<?php echo filter_input(INPUT_GET, 'test_id');?>";
    var subject_id="<?php echo filter_input(INPUT_GET, 'subject_id');?>";
    var module_id="<?php echo filter_input(INPUT_GET, 'module_id');?>";
    var topic_id="<?php echo filter_input(INPUT_GET, 'topic_id');?>";
    
    if(test_id){
        $("#test-list").val(test_id);
        insSubjectList();
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



function checkAll(el){
    $("input .check").prop("checked",$(el).prop("checked"));
}


function frm_validate(){
    
    if(!$("#test-list").val()){
        $("#errMsg").html("Test Not Selected");
        return false;
    }
    
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

    return true;
}

function navActive(){
    $("#testquestion-nav").addClass("activenav");
}

</script>