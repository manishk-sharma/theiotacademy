<?php include 'assets/template/header.php';?>

<h1 class="title">Subject</h1>

<div style="text-align: right; margin-bottom: 10px;">
    <button type='button' class='btn-danger' onclick="delRecord();">Delete</button>
    <a href="<?php echo base_url(); ?>Subjectcnt/subjectForm?subject_id=0">
        <button type='button' class='btn-primary'>New Subject</button>
    </a>
</div>

<table class="table table-hover table-condensed">
    <thead>
       <tr>
        <th>Subject Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="subject-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
    getsubjectList();
});

function getsubjectList(){
    var appendme;
    $("#subject-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Subjectcnt/subjectList",
        type: "post",
        async: false,
        success: function(feedback){
           //alert(feedback);
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr subject_id='"+arr[i]['subject_id']+"'>";
                  appendme+="<td>"+arr[i]['subject_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Subjectcnt/subjectForm?subject_id="+arr[i]['subject_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Modulecnt?subject_id="+arr[i]['subject_id']+"'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#subject-rows").append(appendme);
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
   $("#subject-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    if(confirm("Do you want to delete?")){
        var par,subject_id;
        $("#subject-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                  par=$(this).closest("tr");
                  subject_id=par.attr("subject_id");
                    $.ajax({
                    url: "Subjectcnt/subjectDelete?subject_id="+subject_id,
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
    $("#subject-nav").addClass("activenav");
}
    
</script>