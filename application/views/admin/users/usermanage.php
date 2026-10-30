<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
  <h4 class="text-center heading">Users Management</h4>
  <br>
  <div class="accordion" id="accordionExample">
  <?php 
  $userlist=$this->UserModel->getUserList() ;
  foreach($userlist as $row){ 
    //$courseinfo=$this->AppModel->getUserShortInfoById($row->course_id) ;
    if($row->user_type_id==4){
      $moreinfo=$this->StudentModel->getStudentByUserId($row->user_id) ;
    }else{
      $moreinfo=$this->EmployeeModel->getEmployeeDetailsByUserId($row->user_id) ;
    }
  ?>
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->user_id; ?></td>
            <td><?=$moreinfo['first_name']." ".$moreinfo['last_name']?></td>
            <td colspan="3" class="text-right edatecol">DOE: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr>
           <tr>
            <td colspan="2">Email ID: <?=$row->email_id?></td>
            <td class="text-right buttoncol">
              <!--Empty Space For Button-->
            </td>
            <td class="text-right buttoncol">
             <?php if($row->status==1){?>
               <a href="#" class="btn btn-success btn-sm" title="Enable/Disable"><i class="fas fa-eye"></i></a>
             <?php }else{?>
                <a href="#" class="btn btn-danger btn-sm" title="Enable/Disable"><i class="fas fa-eye-slash"></i></a>
             <?php }?>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->user_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
            <td class="text-right buttoncol">
               <button class="btn btn-warning btn-sm collapsed" type="button" data-toggle="modal" data-target="#passwordModel" data-emailid="<?=$row->email_id?>" data-userid="<?=$row->user_id?>"  title="Reset Password">
                <i class="fas fa-key"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->user_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo employee_pic_url().$moreinfo['photo']?>" class="tableuserimage"/>
          </div>
          <div class="col-sm-5">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">User Type:</td>
                  <td><?=$this->UserTypeModel->getUserTypeTitleById($row->user_type_id)?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Email ID:</td>
                  <td><?=$row->email_id?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Password:</td>
                  <td><?=$row->password?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$moreinfo['mobile_no']?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                 <tr>
                  <td class="cbtablecol">
                    <?php if($row->user_type_id==4){?>
                      Student ID:
                    <?php }else{?>
                      Employee ID:
                    <?php }?>
                  </td>
                  <td>
                    <?php 
                    if($row->user_type_id==4){
                      echo $moreinfo['student_id'] ;
                    }else{
                      echo $moreinfo['employee_id'] ;
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td class="cbtablecol">Guardian Name:</td>
                  <td><?=$moreinfo['guardian_label']." ".$moreinfo['guardian_name']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Gender:</td>
                  <td><?=$moreinfo['gender']?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Birth Date</td>
                  <td><?=date('d-m-Y',strtotime($moreinfo['birth_date']));?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
     
      </div>
    </div>
  </div>


  <div class="modal fade bd-example-modal-md" id="passwordModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url()?>User/resetUserPassword" method="post">
          <div class="form-group row">
            <input type="hidden" name="userid">
            <input type="hidden" name="emailid">
                <div class="col-sm-12">
                  <div class="row">
                    <label class="col-sm-4 col-form-label lead">
                      Email ID:
                    </label>
                    <label class="col-sm-8 col-form-label lead">
                      <h5 class="" id="email"> </h5>
                    </label>
                      <label class="col-sm-4 col-form-label lead">Enter Password:</label>
                      <div class="col-sm-8">
                          <input type="password" name="password" id="password" class="form-control" placeholder="password . . ." required="required"/>
                      </div>
                   </div>
                </div>
          </div>
          <div class="row">
                <div class="col-sm-12 text-right">
                  <input type="submit" value="Reset" class="btn btn-warning submitbtn"/>
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>
<br>
</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>

<script type="text/javascript">
  $(function(){
   
      $('#passwordModel').on('show.bs.modal', function(e) {

        var user_id = $(e.relatedTarget).data('userid');  
        var email_id = $(e.relatedTarget).data('emailid');

        $(e.currentTarget).find('input[name="userid"]').val(user_id);
        $(e.currentTarget).find('input[name="emailid"]').val(email_id);
        $('#email').html(email_id);

      });
  
    });
</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>