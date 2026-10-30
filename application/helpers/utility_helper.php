<?php

function asset_url()

{

   return base_url().'assets/';

}

function aws_asset_url()

{
   return 'https://s3-tiaimgv1.s3.ap-south-1.amazonaws.com/images/';
}




function blog_header_image_url()

{

   return base_url().'uploads/blogdata/headerimage/';

}



function blog_featured_image_url()

{

   return base_url().'uploads/blogdata/featuredimage/'; 

}

function resume_url(){

   return base_url().'uploads/resume/';

}

function mliotresume_url(){

   return base_url().'uploads/appicantresume/';

}

function event_intro_image_url()

{

   return base_url().'uploads/eventdata/introimage/';

}


function event_doc_url()

{

   return base_url().'uploads/eventdata/documents/';

}


function event_main_image_url()

{

   return base_url().'uploads/eventdata/mainimage/';

}



function general_pic_url()

{

   return base_url().'uploads/profilepic/generalpic/';

}

function schd_pic_url()

{

   return base_url().'uploads/eventdata/scheduleimage/';

}



function employee_pic_url()

{

   return base_url().'uploads/profilepic/employee/';

}



function guestspeaker_pic_url()

{

   return base_url().'uploads/profilepic/guestspeaker/';

}

function techSavvyUploadUrl()

{

   return base_url().'uploads/techsavvy2020/';

}


function trainer_url()

{

   return base_url().'uploads/trainer/';

}





function get_view_path()

{

    $view_folder_path=APPPATH.'views/';

    if(is_dir($view_folder_path)){

    	return $view_folder_path;

    }else{

    	return false ;

    }

}





function get_config_path()

{

    $config_folder_path=APPPATH.'config/';

    if(is_dir($config_folder_path)){

    	return $config_folder_path;

    }else{

    	return false ;

    }

}



function upload_path(){

  $start_path=APPPATH;

  $newpath=str_replace('application','uploads', APPPATH);

  return $newpath;

}



function get_controller_path()

{

    $config_folder_path=APPPATH.'controllers/';

    if(is_dir($config_folder_path)){

    	return $config_folder_path;

    }else{

    	return false ;

    }

}



function get_blog_view_path()

{

    $blog_view_folder_path=APPPATH.'views/blogs/';

    if(is_dir($blog_view_folder_path)){

    	return $blog_view_folder_path;

    }else{

    	return false ;

    }

}

function get_event_view_path() 
{

    $event_view_folder_path=APPPATH.'views/events/';

    if(is_dir($event_view_folder_path)){

        return $event_view_folder_path;

    }else{

        return false ;

    }

}



?>