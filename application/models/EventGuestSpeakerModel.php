 <?php



/**

 *   

 */

class EventGuestSpeakerModel extends CI_Model

{

	

	public function __construct(){

        parent::__construct(); 

        $this->load->database();

        $this->load->library('session'); 

        //$this->load->helper('url');

    }



	//-----------------------read the record of speakers------------------

	public function getSpeakerList()

	{

		$query=$this->db->get('event_guest_speaker'); 

		return $query->result();  

	}

	

	public function getActiveSpeakerList($value='')

	{	

		$this->db->where('status',1);

		$query=$this->db->get('event_guest_speaker'); 

		return $query->result();  

	}

	//---------------------------Read the Details Of Speaker By Id------------------------

	public function getGuestSpeakerById($id){

		$data=array() ;

        $this->db->where('speaker_id',$id) ;

        $query = $this->db->get('event_guest_speaker');

        $result=$query->result();

           foreach($result as $row){

            $data=array(

                'first_name'=>$row->first_name, 

				'last_name'=>$row->last_name, 

				'gender'=>$row->gender,

				'birth_date'=>$row->birth_date,

				'mobile_no'=>$row->mobile_no,

				'email_id'=>$row->email_id,

				'photo'=>$row->photo,

				'from_company'=>$row->from_company,

				'company'=>$row->company,

				'designation'=>$row->designation,

				'description'=>$row->description,

				'facebook_link'=>$row->facebook_link,

				'twitter_link'=>$row->twitter_link,

				'linkedin_link'=>$row->linkedin_link

            );

        }

        return $data ;

    }

//---------------------------Read the full Name Of  Speaker By Id------------------------

	public function getGuestSpeakerNameById($id){

        $full_name="nil" ;

        $this->db->where('speaker_id',$id) ;

        $query = $this->db->get('event_guest_speaker');

        $result=$query->result();

        foreach($result as $row){

          $first_name=$row->first_name ;

          $last_name=$row->last_name ;

          $full_name=$first_name." ".$last_name ;

        }

        return $full_name ;

    }

	//----------------------------insert data into speakers----------------

	public function insertSpeaker($first_name,$last_name,$gender,$birth_date,$mobile_no,$email_id,$from_company,$company,$designation,$description,$facebook_link,$twitter_link,$linkedin_link)

	{

			$data=array(

				'first_name'=>$first_name, 

				'last_name'=>$last_name,

				'gender'=>	$gender,

				'birth_date'=>$birth_date,

				'mobile_no'=>$mobile_no,

				'email_id'=>$email_id,

				'from_company'=>$from_company,

				'company'=>$company,

				'designation'=>$designation,

				'description'=>$description,

				'facebook_link'=>$facebook_link,

				'twitter_link'=>$twitter_link,

				'linkedin_link'=>$linkedin_link 

			);

			$this->db->insert('event_guest_speaker',$data);

			$speaker_id=$this->db->insert_id();

			return $speaker_id;	 

	}

	//----------------------------Update data into speakers----------------

	public function updateSpeaker($speaker_id,$first_name,$last_name,$gender,$birth_date,$mobile_no,$email_id,$from_company,$company,$designation,$description,$facebook_link,$twitter_link,$linkedin_link)

	{ 

			$data=array(

				'speaker_id'=>$speaker_id,

				'first_name'=>$first_name,

	 			'last_name'=>$last_name,

				'gender'=>$gender,

				'birth_date'=>$birth_date, 

				'mobile_no'=>$mobile_no,

				'email_id'=>$email_id,

				'from_company'=>$from_company,

				'company'=>$company,

				'designation'=>$designation,

				'description'=>$description,

				'facebook_link'=>$facebook_link,

				'twitter_link'=>$twitter_link,

				'linkedin_link'=>$linkedin_link);

			$this->db->where('speaker_id',$speaker_id);

			$ustatus=$this->db->update('event_guest_speaker',$data);

			return $ustatus;	 

	}



	public function getSpeakerById($id) 

	{

		$data=array();

		$this->db->where('speaker_id',$id);

		$query=$this->db->get("event_guest_speaker");

		$result=$query->result();

		foreach ($result as $row) {

			$data=array(

				'speaker_id'=>$row->speaker_id,

				'first_name'=>$row->first_name,

				'last_name'=>$row->last_name,

				'gender'=>$row->gender,

				'birth_date'=>$row->birth_date,

				'mobile_no'=>$row->mobile_no,

				'email_id'=>$row->email_id,

				'photo'=>$row->photo,

				'from_company'=>$row->from_company,

				'company'=>$row->company,

				'designation'=>$row->designation,

				'description'=>$row->description,

				'facebook_link'=>$row->facebook_link,

				'twitter_link'=>$row->twitter_link,

				'linkedin_link'=>$row->linkedin_link);

		}

		 return $data;

	}





	public function updateSpeakerImageNames($speaker_id){

	        $data = array(

	                    'photo'=>'guestspeakerpic-'.$speaker_id.'.png',

	                );

	        $this->db->where('speaker_id',$speaker_id);

	        $ustatus=$this->db->update('event_guest_speaker',$data);

	        return $ustatus; 

	    }

	//------------------if pic not Uploaded-----------

    public function profileUplodaFailed($speaker_id){

            $data = array(

                        'photo'=>'nil',

                    );

            $this->db->where('speaker_id',$speaker_id);

            $ustatus=$this->db->update('event_guest_speaker',$data);

            //print_r($ustatus);

            return $ustatus; 

    } 

    public function updateSpeakerStatus($speaker_id,$status)

        {

        	$data=array('status'=>$status);

        	$this->db->where('speaker_id',$speaker_id);

        	$ustatus=$this->db->update('event_guest_speaker',$data);

        	return $ustatus;

        }    



}	



	





