<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>

<style type="text/css">
  .submitbtn{
    border-radius:25px;
    font-weight:bold;
  }
  .form-check-input{
    margin-top:2px;
    margin-left:8px;
  }
  .checkboxlabel{
    margin-left:22px;
    margin-right:6px;
  }
  .coursestyle{
    padding-left:10px;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Add Students To Batch</h4>
  <div class="row">
    <div class="col-sm-4">
      <h4 class="text-center heading">Batch ID: <?=$batch_id?></h4>
    </div>
    <div class="col-sm-4">
      <h4 class="text-center heading">Students Selected: <span id="dispselectstd">0</span></h4>
    </div>
    <div class="col-sm-4 text-center">
      <form action="<?php echo base_url()?>submit-students-to-batch" method="post">
        <input type="hidden" id="regids" name="regids" value="0"/>
        <input type="hidden" id="regqty" name="regqty" value="0"/>
        <input type="hidden" id="btcid" name="btcid" value="<?=$btc_id?>"/>
        <input type="hidden" id="batchid" name="batchid" value="<?=$batch_id?>"/>
        <input type="hidden" id="availableseats" name="availableseats" value="<?=$available_seats?>"/>
        <input type="hidden" id="totalseats" name="totalseats" value="<?=$total_seats?>"/>
        <input type="hidden" id="stdenrolled" name="stdenrolled" value="<?=$std_enrolled?>"/>
        <input id="addstdbtn" type="submit" value="Go Forward To Add Students" class="btn btn-primary btn-sm submitbtn"/>
      </form>
    </div>
  </div>
  
  <div class="accordion" id="accordionExample">
  <?php 
  $count=0 ;
  $reglist=$this->RegisterModel->getRegistrationList() ;
  foreach($reglist as $row){ 
    $studentinfo=$this->StudentModel->getStudentById($row->std_id) ;
    $regexists=$this->BatchModel->isRegAlreadyInBatch($btc_id,$row->reg_id) ;
    $moduleexist=$this->CourseModuleModel->isModuleExistsInCourseOfReg($cm_id,$row->reg_id);
    if(!$regexists && $moduleexist){
      $count++ ;
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol">
              <input type="checkbox" name="regcheck<?=$row->reg_id?>" class="form-check-input" onchange="handleCheckBox(this);" value="<?=$row->reg_id?>"/>
              <span class="checkboxlabel"><?=$row->registration_id; ?></span>
            </td>
            <td><?=$studentinfo['first_name']." ".$studentinfo['last_name']?></td>
            <td colspan="3" class="text-right edatecol">DOA: <?=date('d-m-Y',strtotime($row->admission_date)) ?></td>
          </tr>
           <tr>
            <td colspan="2" class="coursestyle">Course: <?=$this->CourseModel->getCourseTitleById($row->course_id);?></td>
            <td class="text-right buttoncol">
              <!--Empty Space For Button-->
            </td>
            <td class="text-right buttoncol">
              <!--Empty Space For Button-->
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->reg_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->reg_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo asset_url()?>images/maleuser.jpg" class="tableuserimage"/>
          </div>
          <div class="col-sm-5">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Email ID:</td>
                  <td><?=$this->UserModel->getEmailByUserId($studentinfo['user_id'])?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$studentinfo['mobile_no']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Total Fee:</td>
                  <td>&#8377;&nbsp;<?=$row->total_fee?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Pending Fee:</td>
                  <td>&#8377;&nbsp;<?=$row->balance_fee?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Guardian Name:</td>
                  <td><?=$studentinfo['guardian_label']." ".$studentinfo['guardian_name']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Gender:</td>
                  <td><?=$studentinfo['gender']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Birth Date</td>
                  <td><?=date('d-m-Y',strtotime($studentinfo['birth_date']));?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td>
                  <?php if($row->status==1){ ?>
                    <span style="color:green">Active</span>
                  <?php }else{?>
                    <span style="color:red">Inactive</span>
                  <?php } ?> 
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <!--Module List Here-->
      </div>
    </div>
  </div>
<?php }} ?>
</div>
<br>
</div>
<?php 
if($count==0){
  $message="No Students Are Eligible To Be Enrolled To This Batch." ;
  $this->session->set_flashdata('error',$message);
  redirect(base_url().'abatch');
}
?>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script type="text/javascript">
  var addstdbtn=document.getElementById("addstdbtn") ;
  addstdbtn.disabled=true ;

  function handleCheckBox(checkbox){
    console.log("Value: "+checkbox.value);
    var regids=document.getElementById("regids") ;
    var regqty=document.getElementById("regqty") ;
    var dispselectstd=document.getElementById("dispselectstd") ;
    if(checkbox.checked == true){
        regqty.value=parseInt(regqty.value)+1 ;
        if(parseInt(regids.value)==0){
          regids.value=checkbox.value+"," ;
        }else{
          regids.value=regids.value+checkbox.value+"," ;
        }
    }else{
        regqty.value=parseInt(regqty.value)-1 ;
        regids.value=regids.value.replace(checkbox.value+',',"");
    }
    if(parseInt(regqty.value)>0){
      addstdbtn.disabled=false ;
    }else{
      addstdbtn.disabled=true ;
      regids.value=0 ;
    }
    dispselectstd.innerHTML=regqty.value ;
}
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>