<?php 
if($this->session->userdata("user")){
?>
<?php $this->load->view("assignment/admin/common/adminheader.php") ;?>
<div class="container-fluid">
	<h2 class="text-center pt-2 mt-4">Admin Dashboard</h2>
	<?php
		 echo $data['username'];
	?>
</div>
<?php $this->load->view("assignment/admin/common/adminfooter.php") ;?>
<?php 
}else{
	redirect(base_url()."assignment/login") ;
}
?>
