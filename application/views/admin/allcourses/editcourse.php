<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("admin/commons/adminheader.php")?> 
<div class="container">
  <h3 class="text-center mt-2">Update Course Here!</h3><br>	
	<form action="<?=base_url()?>AddAllCourses/AllCourseUpdatebyId" method="post" enctype="multipart/form-data">
				<input type="hidden" value="<?=$result[0]->id?>" id="courseid" name="courseid"/>
					<div class="row">

					   <div class="col-sm-12">
					   	   <h6>Course Id: <?= $result[0]->id?></h6>
					   	</div> 	
					</div> 		  		
	 		<div class="mt-1">
	 			<label class="form-label">Course Url</label>
	 		    <input type="text" name="course_url" class="form-control" value="<?=$result[0]->course_url?>" required="true"/>
	 		</div>    									
 	        <div class="mt-3">
 	        	<label class="form-label">Course Title</label>
 	            <input type="text" name="course_title" class="form-control" value="<?=$result[0]->course_title?>" required="true"/>
 	        </div>							
            <div class="mt-3">
            	<label class="form-label">Select Course Type</label>
            	  <input type="hidden" value="<?=$result[0]->course_type?>" id="coursetvalue"/>
                <select name="choose_course_type" id="CourseType" class="form-control" required="true">
                	<option value="">Choose Course Type</option>
                    <option value="instructor-paced">Live Instructor-led Course</option>		
					<option value="self-paced">Self-paced Course</option>
				</select>				
            </div>														
		        <div class="mt-3">
		        	<label class="form-label">Course Duration</label>
		            <input type="text" name="course_duration" value="<?=$result[0]->course_duration?>" class="form-control"/>
		        </div>	
				<div class="mt-3">
				    <label class="form-label">Course Description</label>				
				    <textarea name="course_description" class="form-control" rows="7" placeholder="Enter Course Description" required="true"><?=$result[0]->course_description?></textarea>
				</div>

                <div class="row">
                	<div class="col-sm-6">
                		<div class="row mt-3">				
				            <div class="col-sm-4">Course Deadline Date</div>
				            <div class="col-sm-8">
				                <input type="date" name="course_deadline_date" class="form-control" value="<?=$result[0]->course_deadline?>">			
				            </div>			
				        </div>	
                	</div>
                	<div class="col-sm-6">
	                	
                	</div>
                </div>
	
				<div class="row">		
				    <div class="col-sm-12 text-right mt-4 mb-4">
				         <button type="submit" class="btn btn-success p-2">Update Course</button>		
				    </div>	
				</div>	
	</form>
</div>
<?php $this->load->view("admin/commons/adminfooter.php")?>

<script type="text/javascript">	
	function setCourseType(){		
		var catval=document.getElementById("coursetvalue").value ;		
		var catSelectMenu=document.getElementById("CourseType") ;
			catSelectMenu.value=catval ;
		}setCourseType() ;
</script>

