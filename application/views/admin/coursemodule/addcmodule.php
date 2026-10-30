<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>

<style type="text/css">

  .submitbtn{ 
    width:150px;
    border-radius:25px;
    font-weight:bold;
  }

  #add_new{
    outline: none;
    border:none;
  }
  .addnewBtn{
    position: relative;
    top: 10px;
  }
  #removeBtn{
    cursor: not-allowed;
  }
input::placeholder{
  text-align: center;
}

.number::-webkit-outer-spin-button,
.number::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

</style>

<div class="container-fluid">
  <h4 class="text-center heading">Add Course Module</h4>
  <br>
  <form action="<?php echo base_url()?>submit-course-module" method="post">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Module Name:</label>
          <div class="col-sm-8">
            <input type="text" name="modulename" class="form-control" placeholder="Enter Module Name" required="required" pattern="^[-a-zA-Z0-9-()]+(\s+[-a-zA-Z0-9-()]+)*$"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Module Fee(in Rs.):</label>
          <div class="col-sm-8">
            <input type="number" name="modulefee" class="form-control" placeholder="Enter Module Fee" required="required" pattern="^[-a-zA-Z0-9-()]+(\s+[-a-zA-Z0-9-()]+)*$"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Duration(in Hours):</label>
          <div class="col-sm-8">
            <input type="number" id="duration" name="duration" class="form-control" placeholder="Enter Online Duration In Hours" required="required" pattern="^[-a-zA-Z0-9-()]+(\s+[-a-zA-Z0-9-()]+)*$"/>
          </div>
        </div>

      </div>
      <div class="col-sm-6">

         <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Description:</label>
          <div class="col-sm-8">
            <textarea name="description" class="form-control" placeholder="Enter Module Description" rows="6" required="required"></textarea>
          </div>
        </div>

        
      </div>


    </div>

    <div class="form-group row">
      
      <div class="col-sm-12">
          
          <table class="table ">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="text-center">Sequence</th>
                <th class="text-center">Topic Name</th>
                <th class="text-center">
                  <button class="form-control addnewBtn bg-success text-white  p-1 btn-sm" type="button" id="addnewBtn">Add 
                    <i class="fa fa-plus mt-1" aria-hidden="true"></i></button>
                </th>
              </tr>
            </thead>
            <tbody class="add_child" id="add_child">

                <input type="hidden" name="countTopic" id="countTopic" value="1">

              <tr id="tableRow1">
                <input type="hidden" name="flag1" value="1">

                <th class="text-center" scope="row">

                  <input type="number" name="sequence1" class="form-control number" required="required" min="1" placeholder="Enter Sequence" >
                </th>

                <td class="text-center">
                  <input type="text" class="form-control" name="topic_name1" required="required" placeholder="Enter Topic Name">
                </td>

                <td class="text-center">
                  <button class="form-control bg-danger p-1 text-white" type="button" id="removeBtn" data-remove_id="1" disabled="disabled">
                      <i class="fa fa-trash " aria-hidden="true" ></i>
                  </button>
                </td>
              </tr>

            </tbody>
          </table>

      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-right">
        <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
      
    </div>
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript" src="<?=asset_url()?>/admin/js/addTopic-CourseModule.js"></script>
<script type="text/javascript">
  function updateDurations(){
    var hoursperdaystud=document.getElementById("hoursperdaystud") ;
    var daysquantitystud=document.getElementById("daysquantitystud") ;
    var hoursperdayprof=document.getElementById("hoursperdayprof") ;
    var daysquantityprof=document.getElementById("daysquantityprof") ;
    var durationonline=document.getElementById("durationonline") ;
    var durationofflinestudhrs=document.getElementById("durationofflinestudhrs") ;
    var durationofflineprofhrs=document.getElementById("durationofflineprofhrs") ;
    //For Students
    durationofflinestudhrs.value= hoursperdaystud.value*daysquantitystud.value ;
    //For Professionals
    durationofflineprofhrs.value= hoursperdayprof.value*daysquantityprof.value ;
  }
</script>
<script type="text/javascript">
  
  $(function() {

    $("#addnewBtn").on("click", addNewTopic);

  });   
        
</script>

<?php 
}else{
  redirect(base_url()."login");
}
?>