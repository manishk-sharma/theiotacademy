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
</style>
<div class="container-fluid bg-light">
  <a href="aemail" class="btn btn-primary text-center "><strong><i class="fas fa-arrow-left"></i> Go Back</strong></a>
  <h4 class="text-center heading">Uplaod CSV </h4>
  <br>
    <div class="row">
        <!-- File upload form -->
        <div class="col-md-12  mb-2" id="importFrm">
            <form action="<?php echo base_url('EmailSetup/import'); ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="email form-control">Uplaod CSV  :</label>
                      <input class="form-control" type="file" name="file" accept=".csv"/>
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="email form-control">Mail Subject :</label>
                      <input type="text" class="form-control" name="subject"  id="subject" >
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-sm-12 mt-2">
                        <label for="email form-control">Message : <b class="text-danger">* </b>(Don't start with hello / mr /mrs etc.....)</label>
                        <textarea name="message" id="editor" placeholder="dont type Hello Mr/Mrs etc simply write your message" style="width: 100%; color: #495057;" >
                          &lt;p&gt; &lt;/p&gt;
                      </textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12 text-right mb-2 mr-5">
                        <input type="submit" class="btn btn-primary" name="importSubmit"  value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<script src="<?php echo asset_url()?>ckeditor/ckeditor.js"></script>
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}

$(document).ready(function(){
  CKEDITOR.replace( 'editor',{
    extraPlugins : 'filebrowser',
    filebrowserBrowseUrl:'',
    filebrowserUploadMethod : "form",
    filebrowserUploadUrl:'<?php echo base_url("upload_img");?>'
  });

  

});

</script>
<?php 
}else{
  redirect(base_url()."login");
}
?>