<?php include 'assets/template/header.php';?>

<h1 class="title">Student Assigned</h1>

<div style="display: inline-block; float: right;margin-bottom: 10px;">
    <button type='button' class='btn-danger' onclick="delRecord();">Unassign</button>
        <a href="<?php echo base_url(); ?>Assignmentcnt">
            <button type='button' class='btn-primary'>New Assign</button>
        </a>
</div>


<table class="table table-hover table-condensed">
   <thead>
       <tr>
        <th>Student Name</th>
        <th>Assignment</th>
        <th>Batch Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="assignment-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
    getstudentAssignList(); 
    init_form();

});

function getstudentAssignList(){
    var appendme;
    $("#errMsg").html("");
    $("#assignment-rows").html("");
   
    $.ajax({
        url: "<?php echo base_url();?>Assignmentcnt/studentAssignList",
        type: "post",
        async: false,
        success: function(feedback){
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr assignment_id='" + arr[i]['assignment_id'] + "' student_id='" + arr[i]['student_id'] + "'>";
                  appendme+="<td>"+arr[i]['student_name']+"</td>";
                  appendme+="<td>"+arr[i]['assignment_title']+"</td>";
                  appendme+="<td>"+arr[i]['batch_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<button type='button' class='btn btn-primary disabled'>Assigned</button>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#assignment-rows").append(appendme);
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


function delRecord(){
   
   var count=0;
   $("#assignment-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        $("#errMsg").html("Select Atleast one to be Unassigned");
        return false;
    }
    
    if(confirm("Do you want to unassign?")){
        var par,assignment_id,student_id;
        
        $("#assignment-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                  par=$(this).closest("tr");
                  assignment_id=par.attr("assignment_id");
                  student_id=par.attr("student_id");
                  
                  $.ajax({
                        url: "<?php echo base_url();?>Assignmentcnt/studentAssignDelete?assignment_id="+assignment_id+"&student_id="+student_id,
                        type: "post",
                        async: false,
                        success: function(feedback){
                        
                          if(feedback.indexOf("true")>=0){
                               par.remove();
                            }
                            else{
                                $("#errMsg").html("Can't UnAssign");
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
    $("#assignment-nav").addClass("activenav");
}
    
</script>