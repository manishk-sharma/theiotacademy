<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ModuleTopicModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session'); 
        //$this->load->helper('url');
    }

    public function getModuledataById($cm_id){

    	$this->db->where('cm_id',$cm_id);

    	$query = $this->db->get('module_topic');

        $result=$query->result();

        $bigData=array();

        foreach($result as $row){
            $data=array(
                'topic_id'=> $row->topic_id,
                'sequence'=> $row->sequence,
                'topic_name'=>$row->topic_name

            );
            array_push($bigData,$data );
        }
        return $bigData ;

    }



    public function getModuleTopicByCmID($cm_id)
	{
		$this->db->where('cm_id',$cm_id);

		$this->db->order_by('sequence','ASC');

        $query=$this->db->get('module_topic');

        $result=$query->result();

        

        return $result;
	}

    public function insertModuleTopic($cm_id,$sequence,$topic_name){
		$data = array(
			'cm_id'=>$cm_id,
			'sequence'=>$sequence,
			'topic_name'=>$topic_name,
		);
		$this->db->insert('module_topic', $data);
		$topic_id=$this->db->insert_id();
		return $topic_id;
	}


	public function updateModuleTopic($cm_id,$topic_id,$sequence,$topic_name){
		$data = array(
			'cm_id'=>$cm_id,
			'sequence'=>$sequence,
			'topic_name'=>$topic_name,
		);
		$this->db->where('topic_id',$topic_id);

		$status=$this->db->update('module_topic',$data);

		return $status;
	}

	public function removeModuleTopic($topic_id)
	{
		$this->db->where('topic_id',$topic_id);
        $status=$this->db->delete('module_topic');
        return $status;
	}

}
?>