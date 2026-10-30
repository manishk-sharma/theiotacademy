<?php include 'assets/template/header.php';?>

<h1 class="title">Module</h1>

<div class="form-control" style="margin-bottom: 5px; width: 500px; display: inline-block; border: none; box-shadow: none;">
    <label for="subject-list">Select Subject</label>
    <select id="subject-list" style="width:250px" name="subject_id" onchange="getmoduleList(this.value);"></select>
</div>

<div style="display: inline-block; float: right;">
    <button type='button' class='btn-danger' onclick="delRecord();">Delete</button>
        <a href="#" onclick="return val_button(this);">
            <button type='button' class='btn-primary'>New Module</button>
        </a>
</div>




<table class="table  table-hover table-condensed">
   <thead>
       <tr>
        <th>Module Name</th>
        <th style="width:150px; text-align: center">Action <input style="float: right;"  type='checkbox' id="checkAll" onchange="checkAll(this);"></th>
      </tr>
    </thead>
     <tbody id="module-rows"></tbody>
</table>

<?php include 'assets/template/footer.php';?>

<script>
$(document).ready(function(){
    navActive();
    insSubjectList(); 
    init_form();
    

});


function insSubjectList(){
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

function getmoduleList(subject_id){
    var appendme;
    $("#errMsg").html("");
    $("#module-rows").html("");
    $.ajax({
        url: "<?php echo base_url();?>Modulecnt/submoduleList?subject_id="+subject_id,
        type: "post",
        async: false,
        success: function(feedback){
           //alert(feedback);
            try{
                var arr = JSON.parse(feedback);
                for(var i in arr){  
                  appendme="<tr module_id='"+arr[i]['module_id']+"'>";
                  appendme+="<td>"+arr[i]['module_name']+"</td>";
                  appendme+="<td style='text-align: center;'>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Modulecnt/moduleForm?module_id="+arr[i]['module_id']+"'><button type='button' class='btn-primary'>Edit</button></a>";
                  appendme+="&nbsp;<a href='<?php echo base_url()?>Topiccnt?subject_id="+arr[i]['subject_id']+"&module_id="+arr[i]['module_id']+"'><button type='button' class='btn-primary'>View</button></a>";
                  appendme+="&nbsp;<input type='checkbox' class='check' style='float: right;'></td>";
                  appendme+="</tr>";
                  $("#module-rows").append(appendme);
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
    $(el).attr("href","<?php echo base_url();?>Modulecnt/moduleForm?module_id=0&subject_id="+$("#subject-list").val()+"&subject_name=" + $('#subject-list option:selected').text());
    return true;
  
}

function init_form(){
    var subject_id="<?php echo filter_input(INPUT_GET, 'subject_id');?>";
    if(subject_id){
        $("#subject-list").val(subject_id);
        getmoduleList(subject_id);
    }
    
}

function delRecord(){
   
   var count=0;
   $("#module-rows").find(".check").each(function(){
       if($(this).prop("checked")){
            count++;
        }
    });
   
    if(count===0){
        return false;
    }
    
    
    if(confirm("Do you want to delete?")){
        var par,module_id;
        $("#module-rows").find(".check").each(function(){
            if($(this).prop("checked")){
                  par=$(this).closest("tr");
                  module_id=par.attr("module_id");
                    $.ajax({
                        url: "Modulecnt/moduleDelete?module_id="+module_id,
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
    $("#module-nav").addClass("activenav");
}
    
</script>