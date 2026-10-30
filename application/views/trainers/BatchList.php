<?php include 'assets/template/header.php';?>

<h1 class="title">Batch</h1>

<div style="text-align: right; margin-bottom: 10px;">
   
    <?php if(filter_input(INPUT_GET, 'test_id')){ ?>
        <button type="button" class="btn-primary" onclick="val_button();">Assign</button> 
        <input type="hidden" id="test_id" value="<?php echo filter_input(INPUT_GET, 'test_id');?>">
    <?php } elseif(filter_input(INPUT_GET,'studymaterial_id')){ ?>
        <button type="button" class="btn-primary" onclick="val_button();">Assign</button> 
        <input type="hidden" id="studymaterial_id" value="<?php echo filter_input(INPUT_GET, 'studymaterial_id');?>">
    <?php }elseif(filter_input(INPUT_GET,'assignment_id')){ ?>
        <button type="button" class="btn-primary" onclick="val_button();">Assign</button> 
        <input type="hidden" id="assignment_id" value="<?php echo filter_input(INPUT_GET, 'assignment_id');?>">
    <?php }else{ ?>
        <button type='button' class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="Batchcnt/BatchForm?batch_id=0">
            <button type='button' class='btn-primary'>New Batch</button>
        </a>
    <?php }?>
</div>

<table class="table table-hover table-condensed">
   <thead>
       <tr>
        <th>Batch Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;" type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="batch-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
 getbatchList();
 
});

function getbatchList(){
    var appendme;
    $("#batch-rows").html("");
    $.ajax({
        url: "Batchcnt/batchList",
        type: "post",
        async: false,
        success: function(feedback){
           //alert(feedback);
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr batch_id='"+arr[i]['batch_id']+"'>";
                  appendme+="<td>"+arr[i]['batch_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Batchcnt/batchForm?batch_id="+arr[i]['batch_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Studentcnt?batch_id="+arr[i]['batch_id'] + "'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#batch-rows").append(appendme);
                }
            }catch(err){
            alert("No data Found");
            }
        }      
    });
}

function delRecord(){
    
   var count=0;
   $("#batch-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    if(confirm("Do you want to delete?")){    
        var par,batch_id;
        $("#batch-rows").find(".check").each(function(){
            if($(this).prop("checked")){
              par=$(this).closest("tr");
              batch_id=par.attr("batch_id");
                $.ajax({
                url: "Batchcnt/batchDelete?batch_id="+batch_id,
                type: "post",
                async: false,
                success: function(feedback){
                   if(feedback.indexOf("true")>=0){
                       par.remove();
                    }
                  }
                });
            } 
        });
    }
}

function val_button(){
    
    var count=0;
   $("#batch-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        $("#errMsg").html("Select atleat one batch");
        return;
    }
    
    else{
        if($('#test_id').val()){
            if(confirm("Do you want to Assign?")){
                $("#errMsg").html("");
                var par,batch_id,test_id;
                $("#batch-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      batch_id=par.attr("batch_id");
                      test_id= $("#test_id").val();
                        $.ajax({
                        url: "Testcnt/batchAssign?test_id="+test_id+"&batch_id="+batch_id,
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
                var par,batch_id,studymaterial_id;
                $("#batch-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      batch_id=par.attr("batch_id");
                      studymaterial_id= $("#studymaterial_id").val();
                        $.ajax({
                        url: "StudyMaterialcnt/batchAssign?studymaterial_id="+studymaterial_id+"&batch_id="+batch_id,
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
                $("#batch-rows").find(".check").each(function(){
                    if($(this).prop("checked")){
                      par=$(this).closest("tr");
                      batch_id=par.attr("batch_id");
                      assignment_id= $("#assignment_id").val();
                        $.ajax({
                        url: "Assignmentcnt/batchAssign?assignment_id="+assignment_id+"&batch_id="+batch_id,
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


function checkAll(el){
    $("input.check").prop("checked",$(el).prop("checked"));
}

</script>