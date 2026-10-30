<?php 
if($this->session->userdata("user")){
?>
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" type="image/x-icon" />
<?php $this->load->view("assignment/admin/common/adminheader.php") ;?>
<style type="text/css">

  .submitbtn{
    width:150px; 
    border-radius:25px; 
    font-weight:bold; 
  }

  .modal-gradient{
    background: rgb(95,52,235);
    background: linear-gradient(90deg, rgba(95,52,235,1) 16%, rgba(181,39,241,1) 42%, rgba(215,37,90,1) 92%);
     color: white;
  }

  .pagination .active{
    color: #ff3115!important;
  }

  .pagination a{
    color:#3e206d; 
    padding:10px;
    margin: 2px;
    font-weight: bolder;
    text-decoration: none;

  }
  .pagination a:hover{
    text-decoration: underline;
  }
  .data-not-found-assign{
	margin-top: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .btn_of_change_st{
	color: #fff;
    background: red;
    border: none;
    padding: 5px 4px;
    display: flex;
    margin-top: 1px;
    margin-bottom: 1px;
    margin-left: 0px;
    justify-content: stretch;
    border-radius: 0px 4px 4px 0;
  }
  .change_status_form{
	 display: flex;

  }
</style> 

<div class="container-fluid">
  <h4 class="text-left heading mt-3 mb-3">All User Feedback/Suggestion/Query</h4>

       <div class="row" style="max-height: 690px;overflow:auto;">
          <div class="col-sm-12">
		  <table class="table table-bordered">
			<thead>
			<tr>
			<th class="text-left">id</th>
			<th class="text-left">User Name</th>
			<th class="text-left">Email</th>
			<th class="text-left">Mobile</th>
			<th class="text-left">Title</th>
			<th class="text-left">Feedback Description</th>
			<th class="text-left">Date</th>
			<th class="text-left">Status</th>
             <th class="text-center">
				Change Status
            </th>
          </tr>
			</thead>
          <tbody> 
		  <?php 
		    if(isset($fd_result)){
			
			  foreach($fd_result as $result){
				?>
					
			<tr>
				<td class="text-left" style="width:3%"><?=$result['id']?></td>
				<td class="text-left" style="width:8%"><?=$result['name']?></td>	
				<td class="text-left" style="width:5%"><?=$result['email']?></td>	
				<td class="text-left" style="width:5%"><?=$result['mobile']?></td>	
				<td class="text-left" style="width:7%"><?=$result['title']?></td>
				<td class="text-left" style="width:34%"><?=$result['description']?></td>
				<td class="text-left" style="width:20%"><?= date('d-m-Y', strtotime($result['updated_at'])) ?></td>
				<td class="text-left" style="width:7%"><?php if($result['status']=='0'){echo "<span style='color:yellow;'>Pending</span>";}elseif($result['status']=='1'){echo "<span style='color:green;'>Complete</span>";}elseif($result['status']=='2'){echo "<span style='color:red;'>Rejected</span>";}?></td>
				<td class="text-center" style="width:15%">
					<form action="<?=base_url().'AssignmentAllUserAdmin/edit_status_of_feedback/'.$result['id']?>" class="change_status_form" method="post">
						<select name="change-status" class="form-control text-center" required="true" style="width:92px;">
						<option value="" class="text-danger">--Select Status--</option>
                         <option value="0">Pending</option>
                         <option value="1">Complete</option>
                         <option value="2">Rejected</option>
						</select>
						<input type="submit" value="change" class="btn_of_change_st">
					</form>
				</td>
				
			</tr>
			<?php		
				}
			  }
			  else{
				echo "<tr><td colspan='5'><h3 class='text-center data-not-found-assign'>No data is available.</h3></td></tr>";
			}
			?>
        </tbody>
        </table>
         </div>
       </div>


<br>
</div>

<?php $this->load->view("assignment/admin/common/adminfooter.php") ;?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php } 
else{ 
	redirect(base_url()."assignment-login") ;
	}?>
