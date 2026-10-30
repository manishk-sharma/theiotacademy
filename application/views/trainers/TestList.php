<?php include 'assets/template/header.php';?>

<h1 class="title">Test</h1>



<div style="display: inline-block; float: right;margin-bottom: 10px;">
    <button type='button' class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="<?php echo base_url(); ?>Testcnt/testForm?test_id=0">
            <button type='button' class='btn-primary'>New Test</button>
        </a>
</div>


<table class="table table-hover table-condensed">
   <thead>
       <tr>
        <th>Test Name</th>
        <th>Marks</th>
        <th>Duration</th>
        <th style="width:350px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="test-rows"></tbody>
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
    gettestList(); 
    init_form();

});

function gettestList(){
    var appendme;
    $("#errMsg").html("");
    $("#test-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Testcnt/testList",
        type: "post",
        async: false,
        success: function(feedback){
       
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr test_id='"+arr[i]['test_id']+"'>";
                  appendme+="<td>"+arr[i]['test_name']+"</td>";
                  appendme+="<td>"+arr[i]['test_marks']+"</td>";
                  appendme+="<td>"+arr[i]['test_duration']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='#'><button type='button' class='btn-primary' data-toggle='modal' data-target='#myModal' onclick='modal_set(this);'>Assign</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>TestQuestioncnt?test_id="+arr[i]['test_id']+ "&test_name="+ arr[i]['test_name']+"'><button type='button' class='btn-primary' style='font-size:16px;'>Add Questions</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Testcnt/testForm?test_id="+arr[i]['test_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Testcnt/testQuestionHome?test_id="+arr[i]['test_id'] + "&test_name="+ arr[i]['test_name']+ "'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#test-rows").append(appendme);
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
   $("#test-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    if(confirm("Do you want to delete?")){
        var par,test_id;
        $("#test-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                  par=$(this).closest("tr");
                  test_id=par.attr("test_id");
                    $.ajax({
                        url: "Testcnt/testDelete?test_id="+test_id,
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
    $("#myModal #student-modal").attr("href","<?php echo base_url()?>Studentcnt?test_id="+$(el).closest("tr").attr("test_id"));
    $("#myModal #batch-modal").attr("href","<?php echo base_url()?>Batchcnt?test_id="+$(el).closest("tr").attr("test_id"));
}

function checkAll(el){
    $("input.check").prop("checked",$(el).prop("checked"));
}

function navActive(){
    $("#test-nav").addClass("activenav");
}
    
</script>