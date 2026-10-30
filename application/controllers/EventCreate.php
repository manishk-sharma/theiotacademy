<?php 

//ob_start();

defined('BASEPATH') OR exit('No direct script access allowed');  
class EventCreate extends CI_Controller {  
 public function __construct(){  
   parent::__construct(); 
   error_reporting(0);

   $this->load->helper('utility_helper');
   $this->load->library('upload');
   $this->load->library('form_validation'); 
   $this->load->helper("file");
   $this->load->model('AppModel'); 
   $this->load->model('EmployeeModel');
   $this->load->model('UserModel');
   $this->load->model('DesigModel');
   $this->load->model('UserTypeModel');
   $this->load->library('session');
   $this->load->model('EventModel');
   $this->load->model('EventTypeModel');
   $this->load->model('EventDaysModel'); 
   $this->load->model('EventScheduleModel');
   $this->load->model('EventLocationModel');
   $this->load->model('EventGuestSpeakerModel');

 }

public function updateEvent($event_id){
  $data=$this->EventModel->getEventById($event_id);
  $this->load->view('admin/event/updateevent',$data);

}



//==============================Insert Event===========================================

public function eventInsert()  

{   

  //Validating the information

  //error messages

  $routeerrmsg=array(

                    'required'=>'Route Cannot Be Empty.',
                    'is_unique'=>'Route Already Exists. Choose Some Unique Route.'

                    );

  $eventtitleerrmsg=array(
                    'required'=>'event title Cannot Be Empty.'
                    );
  $shortdescriptionerrmsg=array(
                    'required'=>'short_description Cannot Be Empty.'
                    );

  $longdescriptionerrmsg=array(
                    'required'=>'long_description Cannot Be Empty.'
                    );

  $keywordserrmsg=array(
                    'required'=>'keywords Cannot Be Empty.'
                    );

  $startdateerrmsg=array(
                    'required'=>'Start Date Cannot Be Empty.'
                    );

  $enddateerrmsg=array(
                    'required'=>'End Date Cannot Be Empty.'
                    );

  $regstartderrmsg=array(
                    'required'=>'reg_start_date Cannot Be Empty.'
                    );

  $this->form_validation->set_rules('route','Route Name','required|is_unique[events.route]',$routeerrmsg);
  $this->form_validation->set_rules('eventtitle','Event Title','required',$eventtitleerrmsg);
  $this->form_validation->set_rules('shortdescription','Short Description','required',$shortdescriptionerrmsg);
  $this->form_validation->set_rules('longdescription','Long Description','required',$longdescriptionerrmsg);
  $this->form_validation->set_rules('keywords','keywords','required',$keywordserrmsg);
  $this->form_validation->set_rules('startdate','Start Date','required',$startdateerrmsg);
  $this->form_validation->set_rules('enddate','End Date','required',$enddateerrmsg);
  $this->form_validation->set_rules('regstartdate','Reg Start Date','required',$regstartderrmsg);
  if($this->form_validation->run()){
      $route_name=str_replace(" ","-",strtolower($this->input->post('route')));

      //Adding event slash to route
      $route_name="event/".$route_name ;
      $event_type_id=$this->input->post('eventtypeid');
      $event_title=$this->input->post('eventtitle');
      $event_location_id=$this->input->post('locationid');
      $short_description=$this->input->post('shortdescription');
      $long_description=$this->input->post('longdescription');
      $keywords=$this->input->post('keywords');
      $multi_day=$this->input->post('eventdays');
      $start_date=$this->input->post('startdate');
      $end_date=$this->input->post('enddate');
      $days_quantity=$this->input->post('dayquantity');
      $event_open=$this->input->post('eventopen');
      $reg_open=$this->input->post('regopen');
      $reg_link=$this->input->post('reg_link');
      $reg_start_dt=$this->input->post('regstartdate');
      $reg_end_dt=$this->input->post('regenddate');
      $payment_type=$this->input->post('paymenttype');
      $price=$this->input->post('price');

        if ($payment_type=="Free") {
            $price=0;
        }

        if ($reg_open==NULL) {
            $reg_open=0;
        }

        if ($event_open==NULL) {
            $event_open=0;
        }

        if ($multi_day==0) {
            $end_date=$start_date;
        }

        if (trim($reg_link)=='') {
          $reg_link='nil';
        }

      $event_id=$this->EventModel->insertEvent($route_name,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price);


      if($event_id)

      {  

      //=================for event dates====================

        for($i=1; $i<=$days_quantity; $i++){

          $day_id=$i ;

          $daydate=$this->input->post("daydate".$i);

          $insert_day_id=$this->EventDaysModel->insertEventDay($event_id,$daydate);//insert Date

          //echo " day_id = $insert_day_id ";

          if($event_type_id!=4){//type id 4 == industrial visit

            $schdqtyid="daydate".$day_id."schdquantity" ;

            $schdquantity=$this->input->post($schdqtyid) ;

            $schdstatus=false;

            for($j=1; $j<=$schdquantity; $j++){

              $schd_id=$j ;

              $insertflagid="daydate".$day_id."schd".$schd_id."insertflag" ;

              $insertflag=$this->input->post($insertflagid) ;

              if($insertflag){

                

                $start_time_id="daydate".$day_id."schd".$schd_id."schdstarttime" ;

                

                $end_time_id="daydate".$day_id."schd".$schd_id."schdendttime" ;

                

                $title_id="daydate".$day_id."schd".$schd_id."schdtitle" ;

                

                $description_id="daydate".$day_id."schd".$schd_id."schddescription" ;

                

                $speakertype_id="daydate".$day_id."schd".$schd_id."speakertype" ;

                

                $speaker_name_id="daydate".$day_id."schd".$schd_id."speakernameid" ;

                $schdpic_id="daydate".$day_id."schd".$schd_id."schdpic" ;

               // echo "$schdpic_id";

                

                $start_time=$this->input->post($start_time_id) ;

                

                $end_time=$this->input->post($end_time_id) ;

                

                $title=$this->input->post($title_id) ;

                

                $description=$this->input->post($description_id) ;

                

                $speaker_type=$this->input->post($speakertype_id) ;

                

                $speaker_id=$this->input->post($speaker_name_id) ;

                

                $schd_id=$this->EventScheduleModel->insertSchedule($insert_day_id,$event_id,$title,$description,$start_time,$end_time,$speaker_id,$speaker_type);//insert Schedule



                if($schd_id){



                  $schdstatus=true;



                  $picstatus=$this->uploadpicforschedule($schd_id,$schdpic_id);

                 // echo "true1";



                  if ($picstatus) {



                    $updateSchdImageNames=$this->EventScheduleModel->updateSchdImageNames($schd_id);



                    //echo "true2";

                  }



                }



              }//insert flag check if block end here

              

            }//schd for loop end here

            if ($schdstatus) {



              $this->EventDaysModel->updateDayScheduleStatus($insert_day_id,$schdstatus);

            }



          }

          

        }//end for loop of days 

        $introimgtatus=$this->uploadIntroImageFile($event_id) ;



        $mainimgtatus=$this->uploadMainImageFile($event_id) ;



        if($introimgtatus && $mainimgtatus){



           $this->EventModel->updateEventIntroImageName($event_id,$introimgtatus);//updating in db

           $this->EventModel->updateEventMainImageName($event_id,$mainimgtatus);//updating in db

            //Creating Event View, Route and Controller Function

            $this->createEventViewRouteCon(

              $event_id,

              $route_name,

              $event_type_id,

              $event_title,

              $event_location_id,

              $short_description,

              $long_description,

              $keywords,

              $multi_day,

              $start_date,

              $end_date,

              $days_quantity,

              $event_open,

              $reg_open,

              $reg_link,

              $reg_start_dt,

              $reg_end_dt,

              $payment_type,

              $price); 



            $this->session->set_flashdata('success', 'Event Inserted Successfully.');
            redirect(base_url().'aevent');

           }

           else{

            if (!$introimgtatus) {
              $introimageerrormsg=" Intro Image Not Uploade<br>";
            }
            elseif (!$mainimgtatus) {
              $mainimageerrormsg=" Main Image Not Upload<br>";

            }

            $this->session->set_flashdata('error',$introimageerrormsg,$mainimageerrormsg);
            redirect(base_url().'add-event');
        }

      }else{
          $this->session->set_flashdata('error', 'Some Error Occured. Please Try Again!');
          redirect(base_url().'add-event');

      }

    }else{
        $this->session->set_flashdata('error',validation_errors());
        redirect(base_url().'add-event');

    }

}



public function createEventViewRouteCon($event_id,$route_name,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price){

  $eventviewfolder=get_event_view_path() ;
  $configfolder=get_config_path() ;
  $controllerfolder=get_controller_path();
  $venue="Online";

  if ($event_location_id!=0) {
      $venue=$this->EventLocationModel->getLocationTitleById($event_location_id); 
  } 

  $imgsName=$this->EventModel->getEventImagesName($event_id);

  //-------------------Creating Event View File----------------------------------

  $event_file_name = "event".$event_id.".php";

  $event_view_file_path=$eventviewfolder.$event_file_name ;

  $event_template_file_path=$eventviewfolder."eventtemplate.php" ;

  //chdir($eventviewfolder);

  //Loading Event Template

  $event_template_string=implode(file($event_template_file_path));
//Creating New Event View File 

  $event_view_file=fopen($event_view_file_path,'w');

//Replacing Default Template Text With Specified Text

  //Replacing Event Title

  //echo($event_title);

  $find_string='tia-event-title' ; 
  $replace_string=$event_title ; 
  $new_file_string=str_replace($find_string,$replace_string,$event_template_string) ;
  //Replacing Event Type Id
  $find_string='tia-event-type-id' ; 
  $replace_string=$event_type_id ; 
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//event Id
$find_string='tia-event-id' ; 
$replace_string=$event_id ;
$new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//registraiton link 

  if($price==0 or $price=="" or $price=='nil'){
      $find_string='tia-event-reg-link';
      if($reg_link!='nil'){
        echo "$reg_link";
        $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="'.$reg_link.'" target="_blank">Register Now</a>';

      }

      else{
        $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="#" data-target="#regEventModal" data-toggle="modal">Register Now</a>';

      }

  }else{

    $find_string='tia-event-reg-link';
    $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="<?=base_url()?>EventBatchRegistration/reg_event/event/'.$event_id.'" target="_blank">Register Now</a>';

  }


$new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//Replacing Event Price  

  if ($price==0 or $price=="" or $price=='nil') {

    $price='Free';

  }



  else{

    $price=' &#x20b9 '.$price; 

  }



  $find_string='tia-event-price' ; 
  $replace_string=$price ; 
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//Replacing Event Start Date

  $find_string='tia-event-start-date' ;

  $replace_string=date('d M Y',strtotime($start_date));
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Replacing Event End Date

  $find_string='tia-event-end-date' ;
  $replace_string=date('d M Y',strtotime($end_date));
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//replacing Reg Open

  $find_string='tia-reg-open';

  $replace_string=$reg_open;
  $new_file_string=str_replace($find_string, $replace_string, $new_file_string); 
//Replacing Reg Start Date

  $find_string='tia-event-reg-open-date' ;
  $replace_string=date('Y-m-d\TH:i',strtotime($reg_start_dt));
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//Replacing Reg Start Date

  $find_string='tia-event-reg-close-date' ;
  $replace_string=date('Y-m-d\TH:i',strtotime($reg_end_dt));
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Replacing Event Venue 

  $replace_string="Online";

  if($venue!="Online"){
    $replace_string=$venue['location_title']." ".$venue['city']." ".$venue['state']." ".$venue['country'];

  }
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//Replacing Event Description 

  $find_string='tia-event-short-description' ;
  $replace_string=$short_description ;
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Replacing Event Long Description
  $find_string='tia-event-long-description' ; 

  $replace_string=$long_description ;
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Replacing Event Keywords

  $find_string='tia-event-keywords';
  $replace_string=$keywords;
  $new_file_string=str_replace($find_string, $replace_string,$new_file_string);

//Replacing Event Route

  $find_string='tia-event-route' ; 
  $replace_string=$route_name ;
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Replacing TIA Event Main Image Name

  $find_string='tax-speakers.jpeg' ;
  $replace_string=$imgsName['main_image'];
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//tia_event_id
  $find_string='$tia_event_id';
  $replace_string=$event_id;
  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);
  $eventtypetitle=$this->EventTypeModel->getEventTypeTitleById($event_type_id);
//tia-event-type-title

  $find_string='tia-event-type-title';
  $replace_string=$eventtypetitle;
  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);
  $speakerAndschdArr=$this->speakerAndScheduleReplace($event_id,$event_type_id);
//event-speakers

  $find_string='tia-event-speakers' ;
  $replace_string=$speakerAndschdArr[0] ;
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string);

//---------End-Replacing tia event speaker details--------------  

  $find_string='tia-event-schedule' ;
  $replace_string=$speakerAndschdArr[1] ;
  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;
//Rewriting File With New Content

  fwrite($event_view_file,$new_file_string);
  fclose($event_view_file);

//----------------------------Adding Event Route------------------------------

  //Creating Route Line Text

  //chdir($configfolder);

  $route_text1=strval('$route');

  $route_text2=strval('Event/');

  $route_line=$route_text1."['".$route_name."']='".$route_text2."event_".$event_id."';\n";

  //Adding Route Line To Routes File

  $route_file_path=$configfolder.'routes.php' ;

  $event_route=fopen($route_file_path,'a');

  fwrite($event_route,$route_line);

  fclose($event_route);

  //------------------------------------------------------------------------------

  //-------------------Adding Function For Route To Controller-----------------

  //chdir('C:\xampp\htdocs\projects\company\tianew\application\controllers');

  //Creating Controller Function

  $func_text1='public function';
  $func_text2='$this->load->view';
  $event_func_text=$func_text1." "."event_".$event_id."()\n{\n\t".$func_text2."('events/".$event_file_name."');\n}\n\n}?>";

  //Getting Event Controller File Path

  $event_con_file_path=$controllerfolder.'Event.php' ;

  //Loading Event Controller File Text

  $con_file_string=implode("",file($event_con_file_path));

  //Replacing End Tag Of Event Controller With Space

  $tag_replaced_string=str_replace("}?>", "",$con_file_string);

  //Adding Controller Function To Tag Replaced String

  $con_string_with_function=$tag_replaced_string."\n".$event_func_text ;

  //Opening Event Controller File For Writing In Write Mode

  $event_con_file=fopen($event_con_file_path,'w');

  //Writing Event Controller File Without End Tags

  fwrite($event_con_file,$con_string_with_function);
  fclose($event_con_file); //Closing File

}

//=========================Event Update Module===========================

  public function eventEdit(){ 

  //Validating the information
  //error messages
  $routeerrmsg=array(
                    'required'=>'Route Cannot Be Empty.',
                    'is_unique'=>'Route Already Exists. Choose Some Unique Route.'
                    );

  $eventtitleerrmsg=array(
                    'required'=>'event title Cannot Be Empty.'
                    );

  $shortdescriptionerrmsg=array(
                    'required'=>'short_description Cannot Be Empty.'
                    );

  $longdescriptionerrmsg=array(
                    'required'=>'long_description Cannot Be Empty.'
                    );

  $keywordserrmsg=array(
                    'required'=>'keywords Cannot Be Empty.'
                    );

  $startdateerrmsg=array(
                    'required'=>'Start Date Cannot Be Empty.'
                    );

  $enddateerrmsg=array(
                    'required'=>'End Date Cannot Be Empty.'
                    );

  /*$regstartderrmsg=array(

                    'required'=>'reg_start_date Cannot Be Empty.'

                    );

  $this->form_validation->set_rules('regstartdate','Reg Start Date','required',$regstartderrmsg);*/

  $this->form_validation->set_rules('route','Route Name','required|is_unique[events.route]',$routeerrmsg);
  $this->form_validation->set_rules('eventtitle','Event Title','required',$eventtitleerrmsg);
  $this->form_validation->set_rules('shortdescription','Short Description','required',$shortdescriptionerrmsg);
  $this->form_validation->set_rules('longdescription','Long Description','required',$longdescriptionerrmsg);
  $this->form_validation->set_rules('keywords','keywords','required',$keywordserrmsg);
  $this->form_validation->set_rules('startdate','Start Date','required',$startdateerrmsg);
  $this->form_validation->set_rules('enddate','End Date','required',$enddateerrmsg);

  if($this->form_validation->run()){
        $event_id=$this->input->post('eventid') ;
        $route_name=str_replace(" ","-",strtolower($this->input->post('route')));
        $route_name="event/".$route_name ;
        $old_route_name=str_replace(" ","-",strtolower($this->input->post('oldroute')));
        $event_type_id=$this->input->post('eventtypeid');
        $event_title=$this->input->post('eventtitle');
        $short_description=$this->input->post('shortdescription');
        $long_description=$this->input->post('longdescription');
        $keywords=$this->input->post('keywords');
        $event_location_id=$this->input->post('locationid');
        $multi_day=$this->input->post('eventdays');
        $start_date=$this->input->post('startdate');
        $end_date=$this->input->post('enddate');
        $days_quantity=$this->input->post('dayquantity');
        $old_days_quantity=$this->input->post('olddayquantity');
        $event_open=$this->input->post('eventopen');
        $reg_open=$this->input->post('regopen');
        $reg_link=$this->input->post('reg_link');
        $reg_start_dt=$this->input->post('regstartdate');
        $reg_end_dt=$this->input->post('regenddate');
        $payment_type=$this->input->post('paymenttype');
        $price=$this->input->post('price');

        if(trim($reg_link)==''){

          $reg_link='nil';

        }
      $ustatus=true;

      $this->EventModel->updateEvent(

                  $event_id,
                  $route_name,
                  $event_type_id,
                  $event_title,
                  $event_location_id,
                  $short_description,
                  $long_description,
                  $keywords,
                  $multi_day,
                  $start_date,
                  $end_date,
                  $days_quantity,
                  $event_open,
                  $reg_open,
                  $reg_link,
                  $reg_start_dt,
                  $reg_end_dt,
                  $payment_type,
                  $price);

     // echo "olddayquantity:$old_days_quantity<br>";

      //echo "new date Quantity:$days_quantity<br>";

      //echo "old_days_quantity:$old_days_quantity";

        if($ustatus){

          if ($old_days_quantity==$days_quantity) {

          # if old dates Quantity And new dates Quantity are Equals. 
            for($i=1; $i<=$days_quantity; $i++){

              $dayDataArr=$this->updateDateForEvent($i,$event_id);

              $schdquantity=$dayDataArr['schdquantity'];

              for ($j=1; $j <=$schdquantity; $j++) {
                 $schdDataArr=$this->updateScheduleForDateEvent($i,$j,$event_id,$dayDataArr);
                 //print_r($schdDataArr);

              }//end of schedule for loop 

            }//end of  day for loop

          }//end compare of days count 

          elseif ($old_days_quantity<$days_quantity) {
            for($i=1; $i<=$days_quantity; $i++){

              $dayDataArr=$this->updateDateForEvent($i,$event_id);

              $schdquantity=$dayDataArr['schdquantity'];
              for ($j=1; $j <=$schdquantity; $j++) {

                $schdDataArr=$this->updateScheduleForDateEvent($i,$j,$event_id,$dayDataArr);
               //print_r($schdDataArr);

              } //end of schedule for loop 
            }//end of  day for loop
          }//end compare of days count 

          elseif ($old_days_quantity>$days_quantity) {
            for($i=1; $i<=$old_days_quantity; $i++){
              $dayDataArr=$this->updateDateForEvent($i,$event_id);
              $schdquantity=$dayDataArr['schdquantity'];
              //echo "schdquantity:$schdquantity";

              for ($j=1; $j <=$schdquantity; $j++) {

                $schdDataArr=$this->updateScheduleForDateEvent($i,$j,$event_id,$dayDataArr);

               //print_r($schdDataArr);

              } //end of schedule for loop 

            }//end of  day for loop

          }

          //Now Updating Inside Event View & Route Files

          $this->updateEventViewRoute($event_id,$route_name,$old_route_name,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price);

          $this->session->set_flashdata('success', 'Event Updated Successfully. Event Id : '.$event_id);

          redirect(base_url().'aevent');

        }

        else{

          $this->session->set_flashdata('error','Unable To Update Event. Please Try Again!');
          redirect(base_url().'Event/updateEvent/'.$event_id); 
        }



    }//if of validation



    else{
      $this->session->set_flashdata('error',validation_errors());

      redirect(base_url().'Event/updateEvent/'.$event_id);

    }//else of validation



}//function end here

public function updateDateForEvent($i,$event_id)



{

  $dateData=array();



  $db_daydate_id=$this->input->post("daydate".$i."dbid");



  $db_daydate=$this->input->post("daydate".$i."dbdate");



  $new_daydate=$this->input->post("daydate".$i."newdate");



  $daydate_operation=$this->input->post("daydate".$i."operation");



  $schdquantity=$this->input->post("daydate".$i."schdquantity") ;



    /*echo "<br>=============for date : 1===========================<br>";

    echo "daydate-operation = $daydate_operation<br>";

    echo "db-daydate id = $db_daydate_id<br>";

    echo "db-daydate = $db_daydate<br>";

    echo "new-daydate = $new_daydate<br>";

    echo "schdquantity = $schdquantity<br>";*/

    if ($daydate_operation=='insert') {



      $dayid=$this->EventDaysModel->insertEventDay($event_id,$new_daydate);



      $this->EventDaysModel->updateDayScheduleStatus($dayid,1);



      echo "<br>current insertedDate:$dayid<br>";



       $dateData['current_ins_day_id'] = $dayid;



    }

    elseif ($daydate_operation=='update') {



      $daystatus=$this->EventDaysModel->updateEventDay($event_id,$db_daydate_id,$new_daydate); 



    }

    elseif ($daydate_operation=='remove') {



      $daystatus=$this->EventDaysModel->deleteEventDayByDayId($db_daydate_id);



    }

    $dateData['db_daydate_id'] = $db_daydate_id;



    $dateData['date_operation']=$daydate_operation;



    $dateData['db_daydate'] = $db_daydate;



    $dateData['new_daydate'] = $new_daydate;



    $dateData['schdquantity'] = $schdquantity;



    $dateData['daystatus'] = $daystatus;



    return $dateData;

}





public function updateScheduleForDateEvent($i,$j,$event_id,$dayDataArr)

{

  $schdDataArr=array();



  $db_daydate_id=$dayDataArr['db_daydate_id'];



  $day_date_operation=$dayDataArr['date_operation'];



  //echo "db_daydate_id:$db_daydate_id";

  // $new_daydate_id=$dayDataArr['curnt_insrt_daydate_id'];

  $schd_operation=$this->input->post("daydate".$i."schd".$j."operation");



  $schd_insertflag=$this->input->post("daydate".$i."schd".$j."insertflag");



  $db_schd_id=$this->input->post("daydate".$i."schd".$j."dbid");



  $start_time=$this->input->post("daydate".$i."schd".$j."schdstarttime") ;



  $end_time=$this->input->post("daydate".$i."schd".$j."schdendttime") ;



  $title=$this->input->post("daydate".$i."schd".$j."schdtitle") ;



  $description=$this->input->post("daydate".$i."schd".$j."schddescription") ;



  $speaker_id=$this->input->post("daydate".$i."schd".$j."speakernameid") ;



  $speaker_type=$this->input->post("daydate".$i."schd".$j."speakertype") ;



  $schdpic_id="daydate".$i."schd".$j."schdpic" ;



  if($schd_operation=='remove'){



    $delstatus=false;



     $delstatus=$this->EventScheduleModel->deletScheduleBySchdId($db_schd_id);



     $schdDataArr['delstatus']=$delstatus;



  }

  elseif ($schd_operation=='update') {



  $updateStatus=false;



  //echo "<br>Update Schd: Update date:$db_daydate_id<br>";

  echo "<br>for event: Update date:$event_id<br>";

  $updateStatus=$this->EventScheduleModel->updateSchedule($db_schd_id,$db_daydate_id,$event_id,$title,$description,$start_time,$end_time,$speaker_id,$speaker_type);



    $schdDataArr['updateStatus']=$updateStatus;



    if ($updateStatus) {

      $updatePicStatus=false;



      $updatePicStatus=$this->uploadpicforschedule($schd_id,$schdpic_id);



      //$schdDataArr['updatePicStatus']=$updatePicStatus;

        if ($updatePicStatus) {



          $updateSchdImageNames=$this->EventScheduleModel->updateSchdImageNames($schd_id);



          $schdpicmessage="Schedule Updated Successfully" ;



              $this->session->set_flashdata('success',$schdpicmessage);



        }

        else{

          $schdpicmessage=" Photo Not Uploadded <br> File Type Must be Png/PNG And Max Size shuld be 100px X 100px , . Or Contact Administrator." ;



              $this->session->set_flashdata('error',$schdpicmessage);



        }



    }



  }

  elseif($schd_operation=='insert'){



    if ($day_date_operation=='insert') {



    $db_day_id=$dayDataArr['current_ins_day_id'];



    }

    else{



      $db_day_id=$dayDataArr['db_daydate_id'];



    }



    $insertStatus=false;



    $insertStatus=$this->EventScheduleModel->insertSchedule($db_day_id,$event_id,$title,$description,$start_time,$end_time,$speaker_id,$speaker_type);



      $schdDataArr['insertStatus']=$insertStatus;



      if ($insertStatus) {



        $insertPicstatus=false;



       $insertPicstatus=$this->uploadpicforschedule($schd_id,$schdpic_id);



       $schdDataArr['insertPicstatus']=$insertPicstatus;



        if ($insertPicstatus) {



          $updateSchdImageNames=$this->EventScheduleModel->updateSchdImageNames($schd_id);



          $schdpicmessage="Schedule Updated Successfully" ;



              $this->session->set_flashdata('success',$schdpicmessage);

        }

        else{



          $schdpicmessage=" Photo Not Uploadded <br> File Type Must be Png/PNG And Max Size shuld be 100px X 100px , . Or Contact Administrator." ;

              $this->session->set_flashdata('error',$schdpicmessage);



        }



      }//end of insert pic



  }//end of insert schd



  return $schdDataArr;

}



#====================================================

public function updateEventViewRoute($event_id,$route_name,$old_route_name,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price){



  $eventviewfolder=get_event_view_path() ;



  $configfolder=get_config_path() ;



  $controllerfolder=get_controller_path();



  $venue="Online";



  if ($event_location_id!=0) {



      $venue=$this->EventLocationModel->getLocationTitleById($event_location_id); 

  }



  $imgsName=$this->EventModel->getEventImagesName($event_id);



  $eventdates=$this->EventModel->getEventsDates($event_id);



  //-------------------Creating Event View File----------------------------------

  $event_file_name = "event".$event_id.".php";



  $event_file_name=str_replace(' ','', $event_file_name);



  $event_view_file_path=$eventviewfolder.$event_file_name ;



  $event_template_file_path=$eventviewfolder."eventtemplate.php" ;



  //chdir($eventviewfolder);

  //Loading Event Template

  $event_template_string=implode(file($event_template_file_path));



//Creating New Event View File 

  $event_view_file=fopen($event_view_file_path,'w');

  

//Replacing Default Template Text With Specified Text

  //Replacing Event Title

  /*Please pass event_template_string as third parameter into str_replace() function only for 

  first string replacement and thereafter use new_file_string */

  $find_string='tia-event-title';



  $replace_string=$event_title;



  $new_file_string=str_replace($find_string,$replace_string,$event_template_string) ;



  //Replacing Event Type Id

  $find_string='tia-event-type-id' ; 



  $replace_string=$event_type_id ; 



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//event Id

$find_string='tia-event-id' ; 



$replace_string=$event_id ;



$new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//registraiton link 

  if($price==0 or $price=="" or $price=='nil'){



      $find_string='tia-event-reg-link';



      if($reg_link!='nil'){



        echo "$reg_link";

        $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="'.$reg_link.'" target="_blank">Register Now</a>';

      }

      else{



        $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="#" data-target="#regEventModal" data-toggle="modal">Register Now</a>';

      }

      



  }else{



    $find_string='tia-event-reg-link';



    $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="<?=base_url()?>EventBatchRegistration/reg_event/event/'.$event_id.'" target="_blank">Register Now</a>';



  }



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;





//Replacing Event Price

  if ($price==0) {



    $price='Free';

  }



  else



  {



    $price='&#x20b9; '.$price.' Per Person';



  } 

    



  $find_string='tia-event-price' ; 



  $replace_string=$price ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Start Date

  $find_string='tia-event-start-date' ;



  $replace_string=date('d M Y',strtotime($start_date));



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event End Date

  $find_string='tia-event-end-date' ;



  $replace_string=date('d M Y',strtotime($end_date));



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  //replacing Reg Open

  $find_string='tia-reg-open';



  $replace_string=$reg_open;

  

  $new_file_string=str_replace($find_string, $replace_string, $new_file_string); 



//Replacing Reg Start Date

  $find_string='tia-event-reg-open-date' ;



  $replace_string=date('Y-m-d\TH:i',strtotime($eventdates['reg_start_dt']));



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Reg Start Date

  $find_string='tia-event-reg-close-date' ;



  $replace_string=date('Y-m-d\TH:i',strtotime($eventdates['reg_end_dt']));



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Status

  if ($event_open==0) {



    $status='Coming Soon';



  }

  else if ($event_open==1) {



    $status='On-Going';

  }

  else{



    $status='Past';



  }

  $find_string='tia-event-status' ;



  $replace_string=$status ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Venue

  //echo $venue['location_title']; 

  $find_string='tia-event-venue' ;



  $replace_string="Online";



  if($venue!="Online"){



    $replace_string=$venue['location_title']." ".$venue['city']." ".$venue['state']." ".$venue['country'];



  }

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  $eventtypetitle=$this->EventTypeModel->getEventTypeTitleById($event_type_id);



  $find_string='tia-event-type-title';



  $replace_string=$eventtypetitle;



  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);





//Replacing Event Description 

  $find_string='tia-event-short-description' ;



  $replace_string=$short_description ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Long Description

  $find_string='tia-event-long-description' ; 



  $replace_string=$long_description ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Keywords

  $find_string='tia-event-keywords';



  $replace_string=$keywords;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string);  



//Replacing Event Route

  $find_string='tia-event-route' ; 



  $replace_string=base_url().$route_name;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing TIA Event Main Image Name

  $imgsName=$this->EventModel->getEventImagesName($event_id);



  $find_string='tax-speakers.jpeg' ;



  $replace_string=$imgsName['main_image'];



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing TIA Event Intro Image Name

  $find_string='tia-event-intro-image' ;



  $replace_string="introimage-".$event_id.".png" ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  $find_string='$tia_event_id';



  $replace_string=$event_id;



  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);

//======================Update Speaker and Schedule======================================

  $speakerAndschdArr=$this->speakerAndScheduleReplace($event_id,$event_type_id);



  $find_string='tia-event-speakers' ;



  $replace_string=$speakerAndschdArr[0] ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string);

//---------End-Replacing tia event speaker details--------------  

  $find_string='tia-event-schedule' ;



  $replace_string=$speakerAndschdArr[1] ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Rewriting File With New Content

  fwrite($event_view_file,$new_file_string);



  fclose($event_view_file);

  //-------------------------------------------------------------



  //---------------------Updating Route------------------------------------

 

  //Updating New Route To Routes File

  $route_file_path=$configfolder.'routes.php' ;



  //Loading Route File Data

  $route_file_string=implode(file($route_file_path));



  //Creating New Route File 

  $route_file=fopen($route_file_path,'w');

  

  //Replacing Old Route With New Route

  

  $find_string=$old_route_name ;

  

  $replace_string=$route_name;

  

  $new_file_string=str_replace($find_string,$replace_string,$route_file_string) ;



  //Rewriting File With New Content

  fwrite($route_file,$new_file_string);



  fclose($route_file);



}

  //------------------------------------------------------------------------



public function speakerAndScheduleReplace($event_id,$event_type_id)

{

  $speakerSchdArr=array();

 //---------------------------------speaker list gose here----------------------------------------

$event_speaker_list="";



 if ($event_type_id!=4){//Skip for Industrial Visit



    $temp_array=array();



    $daylist=$this->EventDaysModel->getActiveEventDaysListByEventId($event_id);

    //print_r($daylist);

    foreach ($daylist as $drow) 

    {



      $schdlist=$this->EventScheduleModel->getActiveEventScheduleByDayId($drow->day_id);



     if(count($schdlist)>0){

     // if schd count >0

      foreach ($schdlist as $schdrow) 

      { 

        

        $entryflag=false;

        

        $daysparray=array();

        

        array_push($daysparray,$drow->day_id);

        

        array_push($daysparray,$schdrow->schd_id);

        

        array_push($daysparray,$schdrow->speaker_id);

        

        array_push($daysparray,$schdrow->speaker_type);

       

        if (sizeof($temp_array)>0) {

                  

                  $found=$this->isDaySchdSpeakerExistsInArray($temp_array,$daysparray);



                  if ($found) {

                    $entryflag=false;

                  }



                  else{



                    array_push($temp_array,$daysparray);

                    $entryflag=true;



                  }

        }

        else{



         array_push($temp_array,$daysparray);



         $entryflag=true;



        }



        if ($entryflag==true) {



          if ($schdrow->speaker_type=='guest'){ 

          //if guest

            $speakerdata=$this->EventGuestSpeakerModel->getGuestSpeakerById($schdrow->speaker_id);



            $designation=$speakerdata['designation'];



            if ($speakerdata['facebook_link']=='nil' and $speakerdata['twitter_link']=='nil' and $speakerdata['linkedin_link']=='nil') {

                     $hidediv="hide";

            }

            else{



              $hidediv=" ";



            }

            if($speakerdata['facebook_link']=='nil'){



              $fblink='hide';



            }

            else{



              $fblink=' ';



            }

            if($speakerdata['twitter_link']=='nil'){



              $tweetlink='hide';

            }



            else{



              $tweetlink=' ';



            }

            if($speakerdata['linkedin_link']=='nil'|| $speakerdata['linkedin_link']==null){



                $linkedlink='hide';



            }

            else{



              $linkedlink=' ';



            }

            if ($speakerdata['photo']=='nil'or $speakerdata['photo']=='') {



              if ($speakerdata['gender']=='Male') {



                $pic='<?=general_pic_url()?>maleuser.png';



              }

              else{



              $pic='<?=general_pic_url()?>femaleuser.png';

              }

            }

            else{ 



              $pic='<?=guestspeaker_pic_url()?>'.$speakerdata['photo'].'';



            }



           }

           // end of if Guest

           else{ // i.e => employee



            $speakerdata=$this->EmployeeModel->getEmployeeById($schdrow->speaker_id);



            $designation=$this->DesigModel->getDesigTitleById($speakerdata['desig_id']);



              if ($speakerdata['facebook_link']=='nil' and $speakerdata['twitter_link']=='nil' and $speakerdata['linkedin_link']=='nil') {

                     $hidediv="hide";



                }



              else{



                  $hidediv=" ";



                }

              if($speakerdata['facebook_link']=='nil'){



                $fblink='hide';

              }



              else{



                  $fblink=' ';

              }



              if($speakerdata['twitter_link']=='nil'){



                 $tweetlink='hide';

              }



              else{



                $tweetlink=' ';



              }



              if($speakerdata['linkedin_link']=='nil'){



                $linkedlink='hide';



              }

              else{



                $linkedlink=' ';



              }  

              if ($speakerdata['photo']=='nil'or $speakerdata['photo']=='') {



                  if ($speakerdata['gender']=='Male') {



                    $pic='<?=general_pic_url()?>maleuser.png';



                  }

                  else{



                 $pic='<?=general_pic_url()?>femaleuser.png';



                  }

              }

              else{ 



                  $pic='<?=employee_pic_url()?>'.$speakerdata['photo'].'';

              }



           }// else => employee



          $event_speaker_list= $event_speaker_list.

                  '<div class="row">

                        <div class="col-sm-4">

                            <div class="team_img text-center">

                                 <img class="img-fluid img-item" src="'.$pic.'" alt="">

                                <div class="speaker-name-content">

                                <h4 style="color:#f4511e;">'.$speakerdata['first_name']." ".$speakerdata['last_name'].'</h4>

                                <h5 style="text-transform: capitalize;">'.$designation.'</h5>

                                <div class="hover '.$hidediv.'" >

                                    <a href="'.$speakerdata['facebook_link'].'"

                                      class="'.$fblink.'" target="_blank"><i class="fa fa-facebook"></i>

                                    </a>

                                    <a href="'.$speakerdata['twitter_link'].'" class="'.$tweetlink.'" target="_blank"><i class="fa fa-twitter ml-2"></i>

                                    </a>

                                    <a href="'.$speakerdata['linkedin_link'].'" class="'.$linkedlink.'" target="_blank"><i class="fa fa-linkedin ml-2"></i>

                                    </a>

                                </div>

                              </div>

                            </div>

                        </div>

                        <div class="col-sm-8">

                            <h4 class="text-center mt-4">About The Speaker</h4>

                             <p class="mt-0 event-heder-content">'.$speakerdata['description'].'</p>

                        </div>

                    </div>';

        }



      }



    }//if of schd count



  }//if of date



 }//if(speaker List is Blank if it industrial Visit) 



 $speakerSchdArr[0]=$event_speaker_list; 



//---------------------schedule goes here--------------------

  $tiaschedulelist="";

  if ($event_type_id!=4){

        $eventdayslist=$this->EventDaysModel->getActiveEventDaysListByEventId($event_id);

        if(count($eventdayslist)>0)

        {

           foreach ($eventdayslist as $edrow) {

                $day_date_string=date('d-m-Y',strtotime($edrow->day_date)) ;

                $schedulelist=$this->EventScheduleModel->getActiveEventScheduleByDayId($edrow->day_id);

                //print_r($schedulelist);

            if(count($schedulelist)>0)

            {

              foreach($schedulelist as $sdrow){

                if($sdrow->speaker_type=="guest"){

                  $speaker_name=$this->EventGuestSpeakerModel->getGuestSpeakerNameById($sdrow->speaker_id);

                  //$speaker_name=$speaker_name." (".$sdrow->speaker_type." Speaker)";

                }else{

                  $speaker_name=$this->EmployeeModel->getEmployeeFullNameById($sdrow->speaker_id);

                }  

//------------------------------------------ 

                $schdstarttime=date('H:i a',strtotime(substr($sdrow->start_time,0,-3)));

                $schdendtime=date('H:i a',strtotime(substr($sdrow->end_time,0,-3)));

                $schdtitle=$sdrow->title;

                $schdspeaker=$speaker_name;

                $schddecription=$sdrow->description;

                $schd_photo=$sdrow->schd_photo;

                if ($schd_photo=='nil') {

                  $schd_photo='defaultschd.png';

                }

                $tiaschedulelist=$tiaschedulelist.

                      '<div class="event_schedule_inner">

                          <ul class="nav nav-tabs nav-justified cust-nav" id="myTab" role="tablist">

                              <li class="nav-item">

                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Date : '.$day_date_string.'</a>

                              </li>

                          </ul>

                          <div class="tab-content" id="myTabContent">

                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                  <div class="media">

                                      <div class="d-flex">

                                          <img src="<?=schd_pic_url()?>'.$schd_photo.'" alt="">

                                      </div>

                                      <div class="media-body">

                                          <h5 class="datearea">From '.$schdstarttime.' To '.$schdendtime.' </h5>

                                          <h4 style="margin:0px;">'.$schdtitle.'</h4>

                                          <p>Speech by : '.$schdspeaker.'</p>

                                          <p class="text-justify">'.$schddecription.'</p>

                                      </div>

                                  </div>

                              </div>

                          </div>

                      </div>' ;

                }

              }else{  

                $tiaschedulelist='<h2 id="past_events" class="active" style="color: #f4511e;"> Not Scheduled Yet.</h2>';

              }

            }

          }else{

            $tiaschedulelist='';

          }  

       }//-------- 

       $speakerSchdArr[1]= $tiaschedulelist;       

  return $speakerSchdArr ;

//------------------date end here--------------------------------------------  



//---------------------schedule end here---------------------  

}



  public function updatEventPageIfAnyChangesApply($event_id)

  {     

        $eventdata=$this->EventModel->getEventById($event_id);

        $event_id=$eventdata['event_id'];

        $route_name=$eventdata['route_name'];

        $old_route_name=$eventdata['old_route_name'];

        $event_type_id=$eventdata['event_type_id'];

        $event_title=$eventdata['event_title'];

        $event_location_id=$eventdata['event_location_id'];

        $short_description=$eventdata['short_description'];

        $long_description=$eventdata['long_description'];

        $keywords=$eventdata['keywords'];

        $multi_day=$eventdata['multi_day'];

        $start_date=$eventdata['start_date'];

        $end_date=$eventdata['end_date'];

        $days_quantity=$eventdata['days_quantity'];

        $event_open=$eventdata['event_open'];

        $reg_open=$eventdata['reg_open'];

        $reg_start_dt=$eventdata['reg_start_dt'];

        $reg_end_dt=$eventdata['reg_end_dt'];

        $payment_type=$eventdata['payment_type'];

        $price=$eventdata['price'];

  //--------------------------------------------------------------------------------



//------------------------------------------------------------------------------

  $eventviewfolder=get_event_view_path() ;

  $configfolder=get_config_path() ;

  $controllerfolder=get_controller_path();

  //-------------------Creating Event View File----------------------------------

  $event_file_name = "event".$event_id.".php";

  $event_file_name=str_replace(' ','', $event_file_name);

  $event_view_file_path=$eventviewfolder.$event_file_name ;

  $event_template_file_path=$eventviewfolder."eventtemplate.php" ;

  //chdir($eventviewfolder);

  //Loading Event Template

  $event_template_string=implode(file($event_template_file_path));



//Creating New Event View File 

  $event_view_file=fopen($event_view_file_path,'w');

  

//Replacing Default Template Text With Specified Text

  //Replacing Event Title

  //echo($event_title);

  $find_string='tia-event-title' ; 

  $replace_string=$event_title ; 

  $new_file_string=str_replace($find_string,$replace_string,$event_template_string) ;



  //Replacing Event Type Id

  $find_string='tia-event-type-id' ; 

  $replace_string=$event_type_id ; 

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//event Id

$find_string='tia-event-id' ; 

$replace_string=$event_id ;

$new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//registraiton link 

  if($price==0 or $price=="" or $price=='nil'){



      $find_string='tia-event-reg-link';



      $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="#" data-target="#regEventModal" data-toggle="modal">Register Now</a>';



  }else{



    $find_string='tia-event-reg-link';



    $replace_string='<a class="banner_btn bg-clr"  id="register_now" href="<?=base_url()?>EventBatchRegistration/reg_event/event/'.$event_id.'" target="_blank">Register Now</a>';



  }

  

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  

//Replacing Event Price

  if ($price==0) {

    $price='Free';

  }

  else {

    $price='&#x20b9; '.$price.' Per Person';

  }



  $find_string='tia-event-price' ; 

  $replace_string=$price ;

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;





//Replacing Event Start Date

  $find_string='tia-event-start-date' ;

  $replace_string=$start_date;

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event End Date

  $find_string='tia-event-end-date' ;

  $replace_string=$end_date;

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Reg Start Date

  $find_string='tia-event-reg-open-date' ;

  $replace_string=date('Y-m-d\TH:i',strtotime($reg_start_dt));

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  //replacing Reg Open

  $find_string='tia-reg-open';



  $replace_string=$reg_open;

  

  $new_file_string=str_replace($find_string, $replace_string, $new_file_string); 



//Replacing Reg Start Date

  $find_string='tia-event-reg-close-date' ;

  $replace_string=date('Y-m-d\TH:i',strtotime($reg_end_dt));

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//Replacing Event Status

  if ($event_open==0) {

    $status='Coming Soon';

  }

  else if ($event_open==1) {

    $status='On-Going';

  }

  else{

    $status='Past';

  }

  $find_string='tia-event-status' ;

  $replace_string=$status ;

  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Venue

 $venue="Online";

  if ($event_location_id!=0) {

      $venue=$this->EventLocationModel->getLocationTitleById($event_location_id); 

  }

  //echo $venue['location_title']; 

  $find_string='tia-event-venue' ;

  $replace_string="Online";

  if($venue!="Online"){



    $replace_string=$venue['location_title']." ".$venue['city']." ".$venue['state']." ".$venue['country'];

  }



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;

//-----------------replacing event type-----------------------

  $eventtypetitle=$this->EventTypeModel->getEventTypeTitleById($event_type_id);

  $find_string='tia-event-type-title';



  $replace_string=$eventtypetitle;



  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);



//Replacing Event Description 

  $short_description=$eventdata['short_description']; 



  $find_string='tia-event-short-description' ;



  $replace_string=$short_description ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Long Description

  $find_string='tia-event-long-description' ; 



  $replace_string=$long_description ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Replacing Event Keywords

  $find_string='tia-event-keywords';



  $replace_string=$keywords;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string);  



//Replacing Event Route

  $find_string='tia-event-route' ; 



  $replace_string=$route_name;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  //Replacing TIA Event Main Image Name

  $imgsName=$this->EventModel->getEventImagesName($event_id);



  $find_string='tax-speakers.jpeg' ;



  $replace_string=$imgsName['main_image'];



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



  $find_string='$tia_event_id';



  $replace_string=$event_id;



  $new_file_string=str_replace($find_string, $replace_string, $new_file_string);



  //======================Update Speaker and Schedule======================================

  $speakerAndschdArr=$this->speakerAndScheduleReplace($event_id,$event_type_id);



  $find_string='tia-event-speakers' ;



  $replace_string=$speakerAndschdArr[0] ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string);



//---------End-Replacing tia event speaker details--------------  

  $find_string='tia-event-schedule' ;



  $replace_string=$speakerAndschdArr[1] ;



  $new_file_string=str_replace($find_string,$replace_string,$new_file_string) ;



//Rewriting File With New Content

  fwrite($event_view_file,$new_file_string);



  fclose($event_view_file);

  //-------------------------------------------------------------

//------------------------------------------------------------------------------      

}



public function isDaySchdSpeakerExistsInArray($majorarray,$searcharray){

  $status=false ;



  $statusarray=array() ;



  $count=0 ;



  foreach($majorarray as $targetarray){



    $count++ ;



      $elementcheckflag=true ;



      for($i=2; $i<=3; $i++){



        if($targetarray[$i]!=$searcharray[$i]){



          $elementcheckflag=false ;



          //echo "Element Not Found At Target Array-".$count." and at ".$i."th index<br>" ;

        }

        else{



          //echo "Element Found At Target Array-".$count." and at ".$i."th index<br>" ;

        }



      }



      if($elementcheckflag){



        //echo "Target Array Matched<br>" ;

      }

      else{

        //echo "Target Array Not Matched<br>" ;

      }



      array_push($statusarray,$elementcheckflag) ;

  }



  if(in_array(true,$statusarray)){



    $status=true ;



    //echo "---------Sorry Cannot Insert this search array to major array.--------------<br>";

  }

  else{



    $status=false ;

    //echo "---------We have inserted this search array to major array.--------------<br>";

  }



  return $status ;

}





//-----------------Delete Old Intro Image--------------------

public function ReplaceIntroImage($event_id){



  $imgdata=$this->EventModel->getEventImagesName($event_id);



  $file = $imgdata['intro_image'];  //Getting File Name From DB



  $path = upload_path().'eventdata\introimage\\'.$imgdata['intro_image']; //Getting File Path



  unlink($path);//Old Images Delete



  $this->updateIntroImage($event_id); //Uploade New Intro Image.



}



//-----------------Delete Old Main Image-----------------

public function ReplaceMainImage($event_id){



  $imgdata=$this->EventModel->getEventImagesName($event_id);



  $file = $imgdata['main_image'];  //Getting File Name From DB



  $path = upload_path().'eventdata\mainimage\\'.$imgdata['main_image']; //Getting File Path

  unlink($path);//Old Images Delete

  $this->updateOnlyMainImage($event_id); //Uploade New Main Image.



}



//------------------Intro Image Upload ----------------------- 

public function updateIntroImage($event_id){



    $status=array();



    $status['status']=false ;



    $status=$this->uploadIntroImageFile($event_id) ;



    //print_r($status);

    if($status['status']){



      $flag=$this->EventModel->updateEventIntroImageName($event_id,$status);



      if($flag){



        //$this->updatEventPageIfAnyChangesApply($event_id);

        $this->session->set_flashdata('success', 'Intro Image Updated Successfully.');



        redirect(base_url().'aevent');



      }



      else{



        $this->session->set_flashdata('error', 'Error ! Intro Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }



    }

    else{



        $this->session->set_flashdata('error', 'Error ! Intro Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }



    redirect(base_url().'aevent');



}



public function uploadIntroImageFile($event_id)

{       

        $fileStatus=array();



        

        $fileStatus['status']=false ;

        

        $error="no error" ;

        

        $config['file_name']      = 'introimage-'.str_replace(" ","",$event_id);

        

        $config['upload_path']    = './uploads/eventdata/introimage/';

        

        $config['allowed_types']  = 'PNG|png|JPG|jpg|JPEG|jpeg|bmp|BMP|tiff|TIFF';

        

        $config['overwrite']      = TRUE; 

        

        $config['max_size']       = 5000; #5MB

        

        $config['max_width']      = 5000; #px width

        

        $config['max_height']     = 3000; #px height



        //$this->load->library('upload', $config);

        $this->upload->initialize($config);



        if ( ! $this->upload->do_upload('introimage'))

        {

            $error = array('error' => $this->upload->display_errors());

            //echo "Upload Failed" ; print_r($error) ;

            $fileStatus['status']=false;

        }

        else

        {

            $data = array('upload_data' => $this->upload->data());

            //echo "File Uploaded Successfully , $data" ;

            $fileStatus['status']=true ;

            

        }

        $fileStatus['ext']=$this->upload->data('file_ext');

        return $fileStatus ;

        //return $error ;

       // print_r($fileStatus);

}





//----------Updating Main Image---------------

public function updateMainImage($event_id){



    $status=array();



    $status['status']=false ;



    $status=$this->uploadMainImageFile($event_id) ;



    //print_r($status);

    if($status['status']){



      $flag=$this->EventModel->updateEventMainImageName($event_id,$status);



      if($flag){

        //$this->updatEventPageIfAnyChangesApply($event_id);

        $this->session->set_flashdata('success', 'Main Image Updated Successfully.');



        redirect(base_url().'aevent');



      }



      else{



        $this->session->set_flashdata('error', 'Error ! Main Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }

    }else{



        $this->session->set_flashdata('error', 'Error ! Main Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }



    redirect(base_url().'aevent');



}



public function uploadMainImageFile($event_id)

{       

        $fileStatus=array();

        

        $fileStatus['status']=false ;

        

        $error="no error" ;

        

        $config['file_name']      = 'mainimage-'.str_replace(" ","",$event_id);

        

        $config['upload_path']    = './uploads/eventdata/mainimage/';

        

        $config['allowed_types']  = 'PNG|png|JPG|jpg|JPEG|jpeg|bmp|BMP|tiff|TIFF';

        

        $config['overwrite']      = TRUE; 

        

        $config['max_size']       = 5000;  #5MB

        

        $config['max_width']      = 5000;  #px width

        

        $config['max_height']     = 3000;  #px height



        //$this->load->library('upload', $config);

        $this->upload->initialize($config);



        if ( ! $this->upload->do_upload('mainimage'))

        {

            $error = array('error' => $this->upload->display_errors());

            //echo "Upload Failed" ; print_r($error) ;

            $fileStatus['status']=false;

        }

        else

        {

            $data = array('upload_data' => $this->upload->data());

            //echo "File Uploaded Successfully , $data" ;

            $fileStatus['status']=true ;

            

        }

        $fileStatus['ext']=$this->upload->data('file_ext');



        return $fileStatus ;

}



//----------------------this Function only Run if Main Image Update ---------

public function updateOnlyMainImage($event_id){



    $status=array();



    $status['status']=false ;



    $status=$this->uploadMainImageFile($event_id) ;



    if($status['status']){



      $flag=$this->EventModel->updateEventMainImageName($event_id,$status);



      if($flag){



        $this->updatEventPageIfAnyChangesApply($event_id);



        $this->session->set_flashdata('success', 'Main Image Updated Successfully.');



        redirect(base_url().'aevent');



      }

      else{



        $this->session->set_flashdata('error', 'Error ! Main Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }

    }else{



        $this->session->set_flashdata('error', 'Error ! Main Image Not Updated.Please Try Again!');



        redirect(base_url().'aevent');



      }

    redirect(base_url().'aevent');



}//---------------------------End Here-----------------------



//==================Enable and Disable Event================================



public function enableDisableEvent($event_id,$status){



  $ustatus=$this->EventModel->updateEventStatus($event_id,$status) ;



  if($ustatus){ 

    $eventstatus=$this->updatEventPageIfAnyChangesApply($event_id);



    if($status==1){



      $this->session->set_flashdata('success', 'Event Enabled Successfully.');



    }else{



      $this->session->set_flashdata('success', 'Event Disabled Successfully.');



    }



  }else{



    if($status==1){



      $this->session->set_flashdata('error', 'Unable To Enable The Event. Try Later!');



    }else{



      $this->session->set_flashdata('error', 'Unable To Disable The Event. Try Later!');



    }



  }



  redirect(base_url().'aevent');



}



//----------------------------Delete Events---------------------------------



public function DeleteEvent($event_id)

{

  

  $status=$this->DeleteEventFiles($event_id);

  //echo($status);



   $delstatus=$this->EventModel->deleteEventData($event_id);



  if ($status) {



  }

  if ($delstatus) {



   $this->session->set_flashdata('success', 'Event Deleted Successfully. Event Id: '.$event_id);



  }

  else{



    $this->session->set_flashdata('error','Event Not Deleted Plz Try Again Or Contact Admin');



  }



 redirect(base_url().'aevent');



}



public function DeleteEventFiles($event_id)



{

  $status=false;



  $arr_status=array();



  $eventImgName=$this->EventModel->getEventImagesName($event_id);//Getting Imgs Name to DB

  $event_file="event".$event_id.".php";



  $eventIntroImg=$eventImgName['intro_image'];



  $eventMainImg=$eventImgName['main_image'];





  //Now Deleting The  event(php file),header and Featured Images Files--------------

  $EventFilePath=get_event_view_path().$event_file;



  if(file_exists($EventFilePath)){



    unlink($EventFilePath);



    $arr_status[0]=true;



  }



  else

  {



    $arr_status[0]=true;



  }



  $IntroImgPath = upload_path().'eventdata\introimage\\'.$eventIntroImg; //File Path

  if(file_exists($IntroImgPath)){



    unlink($IntroImgPath);



    $arr_status[1]=true;



  }



  else{



    $arr_status[1]=true;



  }

  $MainImgPath = upload_path().'eventdata\mainimage\\'.$eventMainImg; // File Path



  if(file_exists($MainImgPath)){



    unlink($MainImgPath);



    $arr_status[2]=true;



  }

  else{



    $arr_status[2]=true;



  }



  if (!in_array(false, $arr_status))

  {



    $status=true;



  }



  return $status;



}



public function duplicateEvent($event_id)

{



  $status=$this->EventModel->copyEvent($event_id);



  $new_created_event=$status[0];



  $eventdata=$this->EventModel->getEventById($new_created_event);



        

        $event_id=$eventdata['event_id'];

        

        $route_name=$eventdata['route_name'];

        

        $event_type_id=$eventdata['event_type_id'];

        

        $event_title=$eventdata['event_title'];

        

        $event_location_id=$eventdata['event_location_id'];

        

        $short_description=$eventdata['short_description'];

        

        $long_description=$eventdata['long_description'];

        

        $keywords=$eventdata['keywords'];

        

        $multi_day=$eventdata['multi_day'];

        

        $start_date=$eventdata['start_date'];

        

        $end_date=$eventdata['end_date'];

        

        $days_quantity=$eventdata['days_quantity'];

        

        $event_open=$eventdata['event_open'];

        

        $reg_open=$eventdata['reg_open'];

        

        $reg_start_dt=$eventdata['reg_start_dt'];

        

        $reg_end_dt=$eventdata['reg_end_dt'];

        

        $payment_type=$eventdata['payment_type'];

        

        $price=$eventdata['price'];



   $this->createEventViewRouteCon($event_id,$route_name,$event_type_id,$event_title,$event_location_id,$short_description,$long_description,$keywords,$multi_day,$start_date,$end_date,$days_quantity,$event_open,$reg_open,$reg_link,$reg_start_dt,$reg_end_dt,$payment_type,$price);



  if ($status[1]) {



   $this->session->set_flashdata('success', 'Duplicat Event Created Successfully. Event Id: '.$event_id);



  }

  else{



    $this->session->set_flashdata('error','Duplicat Event Not Created.<br> Plz Try Again Or Contact Admin');



  }



 redirect(base_url().'aevent');



}





public function changeEventDate($event_id)

{



  $status=$this->EventModel->backupEventData($event_id);

  if ($status) {



    $this->session->set_flashdata('success','Date Changed Successfully!');



  }



  else{



    $this->session->set_flashdata('error','Date Not Changed Try Again <br> Or Contact Admin');



  }



  redirect(base_url().'aevent');



}





public function uploadpicforschedule($schd_id,$schdpic)

  {

      //echo "$schdpic";

      $uploadStatus=false ;



      $picuploadstatus=false ;

      //Uploading schd pic

      $status=false ;



          

          $error="no error" ;

          

          $config2['file_name']      = 'schedulepic-'.$schd_id;

          

          $config2['upload_path']    = './uploads/eventdata/scheduleimage/';

          

          $config2['allowed_types']  = 'PNG|png';

          

          $config2['overwrite'] = TRUE;

          

          $config2['max_size']       = 1000; //1MB

          

          $config2['max_width']      = 100;

          

          $config2['max_height']     = 100;



          $this->upload->initialize($config2);



          if ( ! $this->upload->do_upload($schdpic))

          {

              $error = array('error' => $this->upload->display_errors());

              //echo "Upload Failed" ;

             // print_r($error) ;

              $status=false ;

          }

          else

          {

              $data = array('upload_data' => $this->upload->data());

              //echo "File Uploaded Successfully" ;

              //echo $data ;

              $status=true ;

          }



          return $status;

          //echo print_r($error) ;

  }



} ?>

