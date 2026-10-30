<?php 
if($this->session->userdata("logged_in")){
?>
<?php $this->load->view("admin/commons/adminheader.php") ;?>
<div class="container-fluid">
	<h2 class="text-center pt-2 mt-4">Admin Dashboard</h2>
	<?php
		echo ($this->session->userdata('user_type_id'));
	?>
</div>
<?php $this->load->view("admin/commons/adminfooter.php") ;?>
<?php 
}else{
	redirect(base_url()."login") ;
}
?>