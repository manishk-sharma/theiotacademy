<?php if($this->session->userdata("logged_in")){ ?>

<!-- Sidebar -->

<div class="border-right sidebar-modify" id="sidebar-wrapper">

    <div class="sidebar-heading sidebar-heading-modify">Admin Portal</div>

    <div class="list-group list-group-flush">

    <span href="#" class="list-group-item sidebar-item-modify" style="background-color:#118c8b;height:70px;">

        <div style="float:left;">

            <img src="<?php echo asset_url();?>images/maleuser.png" class="userimage"/>

        </div> 

        <div style="float:left;">

            <div class="dropdown">

                <a class="nav-link dropdown-toggle sidebar-item-modify" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#118c8b;color:white;padding-top:0;">



                    <?php if($this->session->userdata("user_type_id")==3) {

                        

                        $this->TrainerModel->getTrainerFirstNameByUserId ($this->session->userdata('user_id'));

                    }else{

                       

                        echo($this->EmployeeModel->getEmployeeFirstNameByUserId ($this->session->userdata('user_id')));

                    }?>

                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">

                <a class="dropdown-item" href="#">View/Edit Profile</a>

                <a class="dropdown-item" href="#">Change Photo</a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="<?php echo base_url()?>sign-out">Logout</a>

                </div>

            </div>

            <h4 class="sidebar-item-modify" style="font-size:12px;margin-left:16px;background-color:#118c8b;color:white;">Nice Meeting You!</h4>

        </div>

    </span>

    <a href="<?php echo base_url()?>app/dashboard" class="list-group-item list-group-item-action sidebar-item-modify">Dashboard</a>

    <?php if ($this->session->userdata("user_type_id")!=3) {?>

     <div class="btn-group dropright">

      <button type="button" class="btn btn-default dropdown-toggle sidebar-item-modify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;margin-left:8px;margin-top:4px;">Live Web Options</button>

      <div class="dropdown-menu">

        <a class="dropdown-item" href="#">Live Enquiry</a>

        <a class="dropdown-item" href="#">Workshop Reg.</a>

        <a class="dropdown-item" href="#">CA Reg.</a>

        <a class="dropdown-item" href="#">FDP Reg.</a>

        <a class="dropdown-item" href="#">Subscribers</a>

        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="#">Event Reg.</a>

      </div>

    </div> 



    <a href="<?php echo base_url()?>aenquiry" class="list-group-item list-group-item-action sidebar-item-modify">Enquiries</a>

    <a href="<?php echo base_url()?>aemail" class="list-group-item list-group-item-action sidebar-item-modify">Send Email</a>
    <a class="list-group-item list-group-item-action sidebar-item-modify" target="_blank" href="<?php echo base_url()?>JobUploadController/our_jobs">Upload Jobs</a>
    <div class="d-flex mb-2">
  <div class="dropdown mr-1">
    <a href="#" class="ml-4 text-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
      Certificate
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item"  href="<?php echo base_url()?>add-details-for-verify-certificate">Add & Verify Certificate</a>
      <a class="dropdown-item"  href="<?php echo base_url()?>webinar-pdf-home">Webinar Certificate</a>
      <a class="dropdown-item"  href="<?php echo base_url()?>workshop-pdf-home">Workshop Certificate</a>
      <a class="dropdown-item" href="<?php echo base_url()?>certificate-pdf-home">Internship Certificate</a>
      <a class="dropdown-item" href="<?php echo base_url()?>industrial-user-certificate-home">Student Visit Certificate</a>
            <a class="dropdown-item" href="<?php echo base_url()?>new_certificate-pdf-home">NewInternship Certificate</a>

    </div>
  </div>
</div>

    <div class="d-flex">
  <div class="dropdown mr-1">
    <a href="#" class="ml-4 text-white dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
      Offer Letter
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item"  href="<?php echo base_url()?>offer-home">Issue In Image Format</a>
      <a class="dropdown-item" href="<?php echo base_url()?>offer-pdf-home">Issue In Pdf Format</a>
    </div>
  </div>
</div>
     <a href="<?php echo base_url()?>all-instructors-course" class="list-group-item list-group-item-action sidebar-item-modify">Instructor Courses</a>

    <?php }

    if(($this->session->userdata("user_type_id")==1)||($this->session->userdata("user_type_id")==2)){

    ?>

    <a href="<?php echo base_url()?>astudent" class="list-group-item list-group-item-action sidebar-item-modify">Students</a>

    <a href="<?php echo base_url()?>aregistration" class="list-group-item list-group-item-action sidebar-item-modify">Registrations</a>

    <?php } ?>



    <?php 

    if(($this->session->userdata("user_type_id")==1)||($this->session->userdata("user_type_id")==2)){

    ?>

    <a href="<?php echo base_url()?>abatch" class="list-group-item list-group-item-action sidebar-item-modify">Batches</a>

    <a href="<?php echo base_url()?>acourse" class="list-group-item list-group-item-action sidebar-item-modify">Courses</a>



    <a href="<?php echo base_url()?>asubject" class="list-group-item list-group-item-action sidebar-item-modify">Subject</a>

   

    <a href="<?php echo base_url()?>apayment" class="list-group-item list-group-item-action sidebar-item-modify">Fee Payments</a>

    <a href="<?php echo base_url()?>aevent" class="list-group-item list-group-item-action sidebar-item-modify">Events</a>

     <!-- <a href="<?php echo base_url()?>ablog" class="list-group-item list-group-item-action sidebar-item-modify">Blogs</a> -->



    <?php } if ($this->session->userdata("user_type_id")==3) {?>



        <a href="<?php echo base_url()?>asubject" class="list-group-item list-group-item-action sidebar-item-modify">Subject</a>



        <a href="<?php echo base_url()?>acourse" class="list-group-item list-group-item-action sidebar-item-modify">Courses</a>



        

        <a href="<?php echo base_url()?>abatch" class="list-group-item list-group-item-action sidebar-item-modify">Batches</a>

        

   <?php }?>

    </div>

</div>

<!--#sidebar-wrapper -->

<?php 

} else{

   redirect(base_url()."login") ; 

}

?>