<!-- Sidebar -->
<style>
.logoutbtnofadminas {
    display: flex;
    margin-top: 12%;
    justify-content: center;

}

.logoutbtnofadminas a {
    color: #fff;
    background: red;
    min-width: 200px;
    text-decoration: none;
    text-align: center;
    border-radius: 5px;
    padding: 7px;
    align-items: center;
}

.sidebar-modify {
    position: sticky;
    top: 0;
    height: 100vh;
}
</style>
<div class="border-right sidebar-modify" id="sidebar-wrapper">

    <div class="sidebar-heading sidebar-heading-modify">Admin Portal</div>

    <div class="list-group list-group-flush">

        <span href="#" class="list-group-item sidebar-item-modify"
            style="background-color:#118c8b;height:70px;cursor:pointer;" id="navbarDropdown1" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <div style="float:left;">

                <img src="<?php echo asset_url(); ?>images/maleuser.png" class="userimage" />

            </div>

            <div style="float:left;">
                <h4 class="sidebar-item-modify"
                    style="font-size:12px;margin-left:16px;background-color:#118c8b;color:white;">Nice Meeting You!</h4>
            </div>
        </span>

        <a href="<?php echo base_url() ?>assignment-admin-dashboard"
            class="list-group-item list-group-item-action sidebar-item-modify">Dashboard</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>UploadNewsUpdate/newsupdateshow">Upload News and Events</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>AssignmentAllUserAdmin/AllUserForAdmin">All Assignment User</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>assignment-all-feedback">Feedback Of Student</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>project-all-details">Project Details</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>download-result-batch-wise">Download Assignment Result</a>
         <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>assigment-update-marks-manual">Update Assignment Result Marks</a>
         <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>admin-assignment-attendance">Upload Attendance Report</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>assignment-admin-csv-live-test">Upload Assignment/Mini Test/Live Test Report</a>
        <a class="list-group-item list-group-item-action sidebar-item-modify"
            href="<?php echo base_url() ?>assignment-project-admin-report-show">Upload Project Report</a>    
    </div>
    <div class="logoutbtnofadminas"><a href="<?php echo base_url() ?>assignment-logout">Logout</a></div>
</div>

<!--#sidebar-wrapper -->