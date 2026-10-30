<?php include 'assets/template/header.php';?>

<h1 class="title">Student Dashboard</h1>

<div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4" id="student_name" style="text-align: right;"><h4>Welcome, <b></b></h4></div>
</div>


<div class="form-control" style="margin-bottom: 5px; width: 500px; display: inline-block; border: none; box-shadow: none;">
    <label for="subject-list">Select Subject</label>
    <select id="subject-list" style="width:250px" name="subject_id" onchange="getStudentDashboard(<?php echo $_SESSION['student_id']; ?>,this.value);"></select>
</div>

<div id="content">
    <div class="row">
        <div class ="col-sm-3">
            <div class="box">
                <b>Total Tests Attempted</b>
                <div id="total_tests" class="box-content">
                </div>
            </div>  
        </div>

        <div class ="col-sm-3">
            <div class="box">
                <b>Total Questions</b>
                <div id="total_questions" class="box-content">
                </div>
            </div>  
        </div>

        <div class ="col-sm-3">
            <div class="box">
                <b>Total Correct Questions</b>
                <div id="correct_questions" class="box-content">
                </div>
            </div>  
        </div>

        <div class ="col-sm-3">
            <div class="box">
                <b>Total Incorrect Questions</b>
                <div id="incorrect_questions" class="box-content">
                </div>
            </div>  
        </div>

    </div>

    <div class="row" style="margin-top: 20px;">
        <div style="display: inline-block;">
            <input type="hidden" id="unattempted_questions">
            <canvas id="test_pie_chart" width="500" height="350"></canvas>
        </div>
        <div style="display: inline-block;">
            <input type="hidden" id="unknown_level">
            <input type="hidden" id="easy_level">
            <input type="hidden" id="medium_level">
            <input type="hidden" id="hard_level">
            <canvas id="level_pie_chart" width="500" height="350"></canvas>
        </div>
    </div>
</div>

<?php include 'assets/template/footer.php';?>


<script>
$(document).ready(function(){
    $("#content").hide();
    insSubjectList();
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


function getStudentDashboard(student_id,subject_id){
    
    $("#errMsg").html("");
    $.ajax({
        url: "<?php echo base_url();?>StudentDashboardcnt/studentDashboard?student_id="+student_id+"&subject_id="+subject_id,
        type: "post",
        async: false,
        success: function(feedback){
           //alert(feedback);
          try{
              var arr = JSON.parse(feedback);
              $("#student_name").find("b").html(arr[0]['student_name']);
              $("#total_tests").html(arr[0]['subject_tests']);
              $("#total_questions").html(arr[0]['total_questions']);
              $("#correct_questions").html(arr[0]['correct_questions']);
              $("#incorrect_questions").html(arr[0]['incorrect_questions']);
              $("#unattempted_questions").val(arr[0]['incorrect_questions']);
              $("#unknown_level").val(arr[0]['unknown_level']);
              $("#easy_level").val(arr[0]['easy_level']);
              $("#medium_level").val(arr[0]['medium_level']);
              $("#hard_level").val(arr[0]['hard_level']);
                if(arr[0]['total_tests']===0){
                        $("#errMsg").html("No data found");
                    }
                else{
                    $("#content").show();
                    getTestChart();
                    getLevelChart();
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


function navActive(){
    $("#module-nav").addClass("activenav");
}


    
</script>

<script>
function getTestChart(){
    var incorrect_questions = $("#incorrect_questions").text();
    var correct_questions = $("#correct_questions").text();
    var unattempted_questions = $("#unattempted_questions").val();
    new Chart(document.getElementById("test_pie_chart"), {
        type: 'pie',
        data: {
          labels: ["Correct", "Incorrect","Unattempted"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#33ff33", "#ff1a1a","#6666FF"],
            data: [incorrect_questions,correct_questions,unattempted_questions]
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Total Test Questions'
          }
        }
    });
}

function getLevelChart(){
    var unknown_level = $("#unknown_level").val();
    var easy_level = $("#easy_level").val();
    var medium_level = $("#medium_level").val();
    var hard_level = $("#hard_level").val();
    new Chart(document.getElementById("level_pie_chart"), {
        type: 'pie',
        data: {
          labels: ["Easy", "Medium","Hard","Unknown"],
          datasets: [{
            label: "",
            backgroundColor: ["#33ff33","#FFFF33","#ff1a1a","#6666FF"],
            data: [easy_level,medium_level,hard_level,unknown_level]
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Level Wise Questions Attempted'
          }
        }
    });
}
</script>   