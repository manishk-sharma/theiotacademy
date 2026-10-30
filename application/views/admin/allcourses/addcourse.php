<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--PLUGIN OF RICH TEXT CSS-->
<link rel="stylesheet" href="<?php echo asset_url()?>admin/css/site.css">
<?php $this->load->view("admin/commons/adminheader.php")?>
<div class="container ">
	
	<h3 class="text-center mt-2">Add New Course</h3><br>	
	<form action="<?=base_url()?>AddAllCourses/AllCourseInsert" method="post" enctype="multipart/form-data">		  		
	 		<div class="mt-1">
	 		    <input type="text" name="course_url" class="form-control" placeholder="Enter Course Url" required="true"/>
	 		</div>    									
 	        <div class="mt-3">
 	            <input type="text" name="course_title" class="form-control" placeholder="Enter Course Title" required="true"/>
 	        </div>							
            <div class="mt-3">
                <select name="choose_course_type" id="CourseType" class="form-control" required="true">
                	<option value="">Choose Course Type</option>
                    <option value="instructor-paced">Live Instructor-led Course</option>		
					<option value="self-paced">Self-paced Course</option>
				</select>				
            </div>														
		        <div class="mt-3">
		            <input type="text" name="course_duration" class="form-control" placeholder="Enter Course Duration Like 9 Months" />
		        </div>	
				<div class="mt-3">				
				    <textarea name="course_description" class="form-control" rows="7" placeholder="Enter Course Description" required="true"></textarea>
				</div>

                <div class="row">
                	<div class="col-sm-6">
                		<div class="row mt-3">				
				            <div class="col-sm-4">Course Deadline Date</div>
				            <div class="col-sm-8">
				                <input type="date" name="course_deadline_date" class="form-control">			
				            </div>			
				        </div>	
                	</div>
                	<div class="col-sm-6">
	                	<div class="row mt-3">
				            <div class="col-sm-3">Course Image</div>
				            <div class="col-sm-9">
				                <input type="file" name="course_image" class="form-control"/>				
				            </div>			
			            </div>
                	</div>
                </div>
	
				<div class="row">		
				    <div class="col-sm-12 text-right mt-4 mb-4">
				        <!-- <input class="btn btn-success p-2" type="submit" name="Add_course" value="Add Course"  /> -->
				         <button type="submit" class="btn btn-success p-2">Add Course</button>		
				    </div>	
				</div>	
	</form>
</div>
<?php $this->load->view("admin/commons/adminfooter.php")?>
   
    