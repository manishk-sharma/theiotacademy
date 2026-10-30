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
  
  .removeBtn{
    cursor: not-allowed;
  }

  input::placeholder{
    text-align: center;
  }

</style>

<div class="container-fluid">
  <h4 class="text-center heading">Update Course Module</h4>
  <h5 class="text-center heading">(Module Id:&nbsp;<?=$module_id?>)</h5>
  <br>
<?php $topicsData=json_encode($this->ModuleTopicModel->getModuledataById($cm_id));?>

  <form action="<?php echo base_url()?>update-course-module" method="post">
    <input type="hidden" name="cmid" value="<?=$cm_id?>"/>
    <input type="hidden" name="moduleid" value="<?=$module_id?>"/>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Module Name:</label>
          <div class="col-sm-8">
            <input type="text" name="modulename" class="form-control" placeholder="Enter Module Name" required="required" value="<?=$module_name?>"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Module Fee(in Rs.):</label>
          <div class="col-sm-8">
            <input type="number" name="modulefee" class="form-control" placeholder="Enter Module Fee" required="required" value="<?=$module_fee?>"/>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead">Duration (in Hrs):</label>
          <div class="col-sm-8">
            <input type="number" id="duration" name="duration" class="form-control" placeholder="Enter Online Duration In Hours" required="required" value="<?=$duration?>" min="0"/>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label lead"><br><br>Description:</label>
          <div class="col-sm-8">
            <textarea name="description" class="form-control" placeholder="Enter Module Description" rows="6" required="required"><?=$description?></textarea>
          </div>
        </div>

      </div>


    </div>
    
    <div class="form-group row">
      
      <div class="col-sm-12">
          
          <table class="table" id="topicTable">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="text-center">Sequence</th>
                <th class="text-center">Topic Name</th>
                <th class="text-center">
                  <button class="form-control addnewBtn bg-success text-white  p-1 btn-sm" type="button" id="addnewBtn" onclick="updateTopic(-1,-1)">Add 
                    <i class="fa fa-plus mt-1" aria-hidden="true"></i></button>
                </th>
              </tr>
            </thead>
            <input type="hidden" name="trList" id="trList" value="3">
                
            <tbody class="add_child" id="add_child">

                <input type="hidden" name="countTopic" id="countTopic" value="1">
                <input type="hidden" name="activeCount" id="activeCount" >
    

            </tbody>
          </table>

      </div>
    </div>

    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4 text-center">
      </div>
      <div class="col-sm-4 text-right">
         <input type="submit" value="Submit" class="btn btn-primary submitbtn"/>
      </div>
    </div>
  </form>

</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript" src="<?=asset_url()?>/admin/js/updateTopic-CourseModule.js"></script>

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

    var topicsData = <?=$topicsData?>;

    dbTopicData((topicsData));

  });   
        
</script>

<?php 
}else{
  redirect(base_url()."login");
}
?>