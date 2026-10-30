<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<style type="text/css">
  .icon{
    color: Mediumslateblue;
  }
</style>
<div class="container-fluid">
  <h4 class="text-center heading">Event Guest Speaker Management</h4>
  <br>
  <div class="text-right">
    <a href="<?=base_url().'add-speaker'?>"class="btn btn-primary btn-sm"><strong><i class="fas fa-user-plus"></i>Add New Speaker</strong></a>
  </div> 

  <div class="accordion" id="accordionExample">
   <?php 
  $speakerlist=$this->EventGuestSpeakerModel->getspeakerList();
  foreach($speakerlist as $row){ 
  ?> 
  <div class="card">
    <div class="card-header cardstyle" id="headingOne">
      <h2 class="mb-0">
        <table border="0" class="tablestyle">
          <tbody>
          <tr>
            <td class="idcol"><?=$row->speaker_id; ?></td>
            <td><?=$row->first_name." ".$row->last_name?></td>
            <td colspan="3" class="text-right edatecol">DOA: <?=date('d-m-Y',strtotime($row->created_on)) ?></td>
          </tr> 
           <tr>
           <td colspan="2">Designation:<?=$row->designation?></td>
            <td class="text-right buttoncol">
              <?php if($row->status==1){ ?>
              <a href="<?=base_url().'EventGuestSpeaker/enableDisableSpeaker/'.$row->speaker_id.'/0'?>" class="btn btn-success btn-sm" title="Active/Deactive"><i class="fas fa-eye"></i></a>
               <?php }else{?>
              <a href="<?=base_url().'EventGuestSpeaker/enableDisableSpeaker/'.$row->speaker_id.'/1'?>" class="btn btn-danger btn-sm" title="Active/Deactive"><i class="fas fa-eye-slash"></i></a>
              <?php }?>
            </td>
            <td class="text-right buttoncol">
               <a href="<?=base_url().'EventGuestSpeaker/edit_guest_speaker/'.$row->speaker_id?>" class="btn btn-warning btn-sm" title="Edit Employee"><i class="fas fa-edit"></i></a>
            </td> 
            <td class="text-right buttoncol">
               <button class="btn btn-primary btn-sm collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?=$row->speaker_id?>" aria-expanded="false" aria-controls="collapseOne" title="More Info"><i class="fas fa-info-circle"></i></button>
            </td>
          </tr>
        </tbody>
        </table>
      </h2>
    </div>

    <div id="collapseOne<?=$row->speaker_id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body cardbodystyle">
        <div class="row">
          <div class="col-sm-2 text-center">
            <img src="<?php echo guestspeaker_pic_url().$row->photo?>" class="tableuserimage" height="100" width="100"/>
            <div class="p-3">
                <a href="<?=$row->facebook_link?>" class="icon" target="_blank"> <i class="fab fa-facebook  fa-lg"></i></a>
                <a href="<?=$row->linkedin_link?>" class="icon" target="_blank"><i class="fab fa-linkedin fa-lg" aria-hidden="true"></i></a>
                <a href="<?=$row->twiter_link?>" class="icon" target="_blank"><i class="fab fa-twitter-square fa-lg"></i></a>
            </div>
          </div>
          <div class="col-sm-5">
            <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Email ID:</td>
                  <td><?=$row->email_id?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Mobile No.:</td>
                  <td><?=$row->mobile_no?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Company:</td>
                  <td><?=$row->company?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">From Company:</td>
                  <td><?=$row->from_company?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-sm-5">
             <table border="0" class="table tablestyle">
              <tbody>
                <tr>
                  <td class="cbtablecol">Birth Date</td>
                  <td><?=date('d-m-Y',strtotime($row->birth_date));?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Last Updated On:</td>
                  <td><?=$row->last_updated_on?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Created On:</td>
                  <td><?=$row->created_on?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Status:</td>
                  <td><?=$row->status;?></td>
                </tr>
                <tr>
                  <td class="cbtablecol">Description:</td>
                  <td><?=$row->description;?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
<?php } ?>
</div>
<br>
</div>

<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
  redirect(base_url()."login");
}
?>