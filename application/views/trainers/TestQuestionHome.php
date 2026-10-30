
<?php include 'assets/template/header.php';?>
<input type="hidden" id="test_id" value="<?php echo filter_input(INPUT_GET, 'test_id'); ?>">

<h1 class="title" style="margin-bottom: 30px;"><?php echo filter_input(INPUT_GET, 'test_name'); ?></h1>


    <table class="table table-hover table-condensed">
       <thead>
            <tr>
                <th style="width: 20px;">Sr.No</th>
                <th>Question</th>
                <th style="width:150px; text-align: center">Action </th>
            </tr>
        </thead>
         <tbody id="question-rows"></tbody>
         <tr>
             <td colspan="3">
             <a href="<?php echo base_url()?>Testcnt"><button type='button' class='btn-primary'>Back</button></a>
             </td>
         </tr>
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
    getquestionList($("#test_id").val());
});

function getquestionList(test_id){
    var appendme;
    $("#errMsg").html("");
    $("#question-rows").html("");
    
    $.ajax({
        url: "<?php echo base_url();?>TestQuestioncnt/subTestQuestionHomeList?test_id="+test_id,
        type: "post",
        async: false,
        success: function(feedback){
            try{
                var j=1;
                var arr = JSON.parse(feedback);
                for(var i in arr){
                  appendme="<tr question_id='"+arr[i]['question_id']+"'>";
                  appendme+="<td>"+j+"</td>";
                  appendme+="<td class='question_name'>"+arr[i]['question_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<button type='button' class='btn-primary' data-toggle='modal' data-target='#myModal' onclick='viewOptions(this,"+arr[i]['question_id']+");'>View</button></a>";
                  appendme+="</tr>";
                  $("#question-rows").append(appendme);
                  j++;
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



function checkQuestion(el){
    
    var par=$(el).closest("tr");
    if($(el).prop("checked")){
        par.find(".questioncheck").val('Y');
    }
    else{
        par.find(".questioncheck").val('');
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

function navActive(){
    $("#test-nav").addClass("activenav");
}

</script>