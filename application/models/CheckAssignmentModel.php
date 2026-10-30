<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CheckAssignmentModel extends CI_Model{
    
function __construct() {
        $this->table = 'assignment_users';
		$this->load->library('session'); 
}    

public function userdetailsmatch($email){
	$this->db->where("email",$email);
	$query = $this->db->get($this->table);
	if($query->num_rows() > 0)
	{ 
		$data = $query->row_array();
		return $data;
	}
	else
	{   
		return false;
	}   
}

public function Register($data){
	$this->db->insert('assignment_users', $data);
	$enqid=$this->db->insert_id();
	return $enqid;
}

public function Update_Profile($id,$data){
	$this->db->where('id',$id);
	$status=$this->db->update('assignment_users',$data);
	return $status;
}
public function updateProfileByID($id,$name){
	$data = array('profile'=>$name);
	$this->db->where('id',$id);
	$status=$this->db->update('assignment_users',$data);
	return $status;
}

public function updateProfileByIDupdate($id,$name){
	$data = array('profile'=>$name);
	$this->db->where('id',$id);
	$status=$this->db->update('assignment_users',$data);
	return $status;
}

public function check_user($email) {
	$this->db->where("email",$email);
	$query = $this->db->get($this->table);
	if($query->num_rows() > 0)
	{ 
		$data = $query->row_array();
		return $data;
	}
	else
	{   
		return false;
	}   
} 

public function FindMachedAllData($email){
	$this->db->where("email",$email);
	$query = $this->db->get($this->table);
	if($query->num_rows() > 0){ 
		$data = $query->row_array();
		return $data;
	}
	else{   
		return false;
	}   
}


public function UploadAssignmentmfn($data){
	$this->db->insert('assignment_pdf_tbl', $data);
	$enqid=$this->db->insert_id();
	return $enqid;
}

public function checkassignmenttopicmatch($title,$userid){
	 
	$this->db->where(['user_id' => $userid, 'title' => $title]);
	$query = $this->db->get('assignment_pdf_tbl');
	if($query->num_rows() > 0){ 
		$data = $query->row_array();
		return $data;
	}
	else{   
		return false;
	}   
}


public function SingleUserAssignment($email){
	$this->db->select('assignment_users.username, assignment_users.email, assignment_users.mobile,assignment_users.batch,assignment_pdf_tbl.title,assignment_pdf_tbl.assignment_pdf,assignment_pdf_tbl.status,assignment_pdf_tbl.user_id,assignment_pdf_tbl.marks,assignment_pdf_tbl.id,assignment_pdf_tbl.created_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_pdf_tbl', 'assignment_pdf_tbl.user_id = assignment_users.id','inner');
	$this->db->where('assignment_users.email', $email);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}

}

public function FindUserMatchFeedback($email){
	$this->db->select('assignment_users.username, assignment_users.email,assignment_user_feedback.title,assignment_user_feedback.description,assignment_user_feedback.status,assignment_user_feedback.updated_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_user_feedback', 'assignment_user_feedback.user_id = assignment_users.id','inner');
	$this->db->where('assignment_users.email', $email);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}
}

public function Find_User_Matched_Project_Details($email){
	$this->db->select('assignment_users.username, assignment_users.email,assign_mini_project.id as id, assign_mini_project.title,assign_mini_project.mini_project, assign_mini_project.updated_at');
	$this->db->from('assignment_users');
	$this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id','inner');
	$this->db->where('assignment_users.email', $email);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}
}

public function AllUserAssignment(){
	$this->db->select('assignment_pdf_tbl.id as assignment_id,assignment_users.username, assignment_users.email,assignment_pdf_tbl.title,assignment_pdf_tbl.assignment_pdf,assignment_pdf_tbl.status,assignment_pdf_tbl.user_id,assignment_pdf_tbl.marks,assignment_pdf_tbl.created_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_pdf_tbl', 'assignment_pdf_tbl.user_id = assignment_users.id','inner');
	$this->db->where('assignment_pdf_tbl.marks IS NULL');
	$this->db->where_not_in('assignment_pdf_tbl.title', ['powerBI', 'tableau']);

	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}

}

public function updateAssignmentMarks($assignment_id,$userid,$title,$data){
	$this->db->where(['id'=>$assignment_id,'user_id' => $userid, 'title' => $title]);
    $result= $this->db->update('assignment_pdf_tbl', $data);
	return $result;
}

public function update_Manual_Assignment_Marks($assignment_id, $user_id, $title, $data){
    $this->db->where('id', $assignment_id);
    $this->db->where('user_id', $user_id);
    $this->db->where('title', $title);
    return $this->db->update('assignment_pdf_tbl', $data);
}

public function isexiststitleofnews($title){
	
	$count=0 ;
	$this->db->where('title',$title);
	$query = $this->db->get('assignment_news_update');
	$result=$query->result();
	$count=count($result) ;
	if($count>0){
			return TRUE ;
	}else{
			return FALSE ;
	}
}

public function NewsUpdateInsertd($data){
	$this->db->insert('assignment_news_update', $data);
	$enqid=$this->db->insert_id();
	return $enqid;
}

public function getAllNewsEventadmin(){
	$this->db->order_by("id", "desc");
	 $query = $this->db->get('assignment_news_update');
	 return $query->result_array();
}

public function getNewseventbyid($id){
	$this->db->where("id", $id);
	$query = $this->db->get('assignment_news_update');
	return $query->result_array();

}
public function updatenewsevents($data,$newsuid){
   $this->db->where("id", $newsuid);
  $updatedata = $this->db->update('assignment_news_update', $data);
	return $updatedata;     
}

public function deletenewsupdatebyid($id){
	$this->db->where('id',$id);
    $status=$this->db->delete('assignment_news_update');
    return $status;

}
public function delete_project_admin_by_id($id){
	$this->db->where('id',$id);
    $status=$this->db->delete('assign_mini_project');
    return $status;

}

public function delete_assignment_topic_admin_by_id($id){
    
	$this->db->where('id',$id);
    $status=$this->db->delete('assignment_pdf_tbl');
    return $status;

}

public function NewsandUpdateForAll(){
	$this->db->order_by("id", "desc");
	 $query = $this->db->get('assignment_news_update');
	 return $query->result_array();
}

public function getAllUserData(){
    $this->db->order_by("id", "desc");
    $this->db->select('id, username, email, mobile, batch, course, created_at');
    $this->db->where('status', '0');
	$this->db->order_by('created_at', 'DESC');
    $this->db->limit(1000); // fetch only 1000 latest rows
    $query = $this->db->get('assignment_users');
    return ($query->num_rows() > 0) ? $query->result_array() : false;
}


public function AllUserWithMarks(){
	$this->db->select('assignment_users.username,assignment_users.email,assignment_users.mobile,assignment_users.batch,assignment_users.course,assignment_pdf_tbl.title,assignment_pdf_tbl.assignment_pdf,assignment_pdf_tbl.status,assignment_pdf_tbl.user_id,assignment_pdf_tbl.marks,assignment_pdf_tbl.feedback as feedback,assignment_pdf_tbl.id as assignpdfid,assignment_pdf_tbl.created_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_pdf_tbl', 'assignment_pdf_tbl.user_id = assignment_users.id','inner');
	$this->db->order_by('assignment_pdf_tbl.created_at', 'DESC');
	$this->db->limit(1000);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}
}

public function getmarksdetaileditbyid($id){

	$this->db->where("id", $id);
	$query = $this->db->get('assignment_pdf_tbl');
	return $query->result_array();
}

public function changeassignmentmarksbyadmin($data,$newsuid){

	$this->db->where("id", $newsuid);
   $updatedata = $this->db->update('assignment_pdf_tbl', $data);
   if ($updatedata) {
    return $newsuid;
} else {
    return false;
}
 }



 public function get_user_by_email($email)
 {
	 return $this->db->where('email', $email)->get('assignment_users')->row();
 }

 public function update_reset_token($user_id, $token, $expiry)
 {
	 $this->db->where('id', $user_id)
			  ->update('assignment_users', ['password_reset_token' => $token, 'token_expiry' => $expiry]);
 }

 public function get_user_by_token($token)
 {
	 return $this->db->where('password_reset_token', $token)->get('assignment_users')->row();
 }

 public function update_password($user_id, $new_password)
 {
	 $this->db->where('id', $user_id)
			  ->update('assignment_users', ['password' => $new_password, 'password_reset_token' => null, 'token_expiry' => null]);
 } 

public function searchRecords($keyword = '', $batch = '', $topic = '') {

    $this->db->select('
        assignment_users.username,
        assignment_users.email,
        assignment_users.mobile,
        assignment_users.batch,
        assignment_users.course,
        assignment_pdf_tbl.title,
        assignment_pdf_tbl.assignment_pdf,
		assignment_pdf_tbl.feedback,
        assignment_pdf_tbl.status,
        assignment_pdf_tbl.user_id,
        assignment_pdf_tbl.marks,
        assignment_pdf_tbl.id as assignpdfid,
        assignment_pdf_tbl.created_at
    ');
    $this->db->from('assignment_users');
    $this->db->join('assignment_pdf_tbl', 'assignment_pdf_tbl.user_id = assignment_users.id', 'inner');

    // ✅ If keyword is provided → search in multiple columns
    if (!empty($keyword)) {
        $this->db->group_start();
        $this->db->like('assignment_users.username', $keyword);
        $this->db->or_like('assignment_users.email', $keyword);
        $this->db->or_like('assignment_users.mobile', $keyword);
        $this->db->or_like('assignment_users.batch', $keyword);
        $this->db->or_like('assignment_pdf_tbl.title', $keyword);
        $this->db->group_end();
    }
    if (!empty($batch)) {
        $this->db->where('assignment_users.batch', $batch);
    }
    if (!empty($topic)) {
        $this->db->where('assignment_pdf_tbl.title', $topic);
    }
    $this->db->order_by('assignment_pdf_tbl.created_at', 'DESC');
    $query = $this->db->get();
    return $query->result_array();
}


public function matchcomplaintopic($userid,$title){

    $this->db->where(["user_id"=>$userid,"title"=>$title]);
	$query = $this->db->get('assignment_user_feedback');
	if($query->num_rows() > 0){ 
		$data = $query->row_array();
		return $data;
	}
	else{   
		return false;
	}   
}

public function feedback_register($data){
	$this->db->insert('assignment_user_feedback', $data);
	$enqid=$this->db->insert_id();
	return $enqid;
}

public function AllFeedBackData(){

	$this->db->select('assignment_users.username as name,assignment_users.email as email,assignment_users.mobile as mobile,assignment_users.course as course,assignment_user_feedback.title as title,assignment_user_feedback.description as description,assignment_user_feedback.status as status,assignment_user_feedback.id,assignment_user_feedback.updated_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_user_feedback', 'assignment_user_feedback.user_id = assignment_users.id','inner');
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array(); // Returns the result as an array
	} else {
		return false;
	}

}

public function change_feedback_status_admin($data,$id){
	
	$this->db->where("id", $id);
   $update_status = $this->db->update('assignment_user_feedback', $data);
   if ($update_status) {
       return $id;
    } 
	else {
        return false;
    }

}

public function UploadMiniProjectSubmit($data){
	$this->db->insert('assign_mini_project', $data);
	$enqid=$this->db->insert_id();
	return $enqid;
}
public function check_project_title_match($userid,$title){
	$this->db->where(['user_id' => $userid, 'title' => $title]);
	//$this->db->where(['user_id' => $userid]);
	$query = $this->db->get('assign_mini_project');
	if($query->num_rows() > 0){ 
		$data = $query->row_array();
		return $data;
	}
	else{   
		return false;
	}   
}

// public function All_Project_Details_dt($limit, $start) {
//     $this->db->limit($limit, $start);
//     $this->db->select('
//         assignment_users.username as name,
//         assignment_users.email as email,
//         assignment_users.course as course,
//         assignment_users.batch as batch,
//         assign_mini_project.title as title,
//         assign_mini_project.mini_project as mini_project,
//         assign_mini_project.status as status,
//         assign_mini_project.id,
//         assign_mini_project.created_at
//     ');
//     $this->db->from('assignment_users');
//     $this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id','inner');
//     $this->db->order_by('assign_mini_project.created_at', 'DESC'); // 👈 Order by latest first
//     $query = $this->db->get();

//     if ($query->num_rows() > 0) {
//         return $query->result_array(); // Returns the result as an array
//     } else {
//         return false;
//     }
// }

public function All_Project_Details_dt(){
    $this->db->select('
        assignment_users.username as name,
        assignment_users.email as email,
        assignment_users.course as course,
        assignment_users.batch as batch,
        assign_mini_project.title as title,
        assign_mini_project.mini_project as mini_project,
        assign_mini_project.status as status,
        assign_mini_project.id,
        assign_mini_project.created_at
    ');
    $this->db->from('assignment_users');
    $this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id', 'inner');
    $this->db->order_by('assign_mini_project.created_at', 'DESC'); // latest first
    $this->db->limit(1000); // get only 1000 rows
    
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return false;
    }
}



public function count_all_project_list(){
	$this->db->select('assignment_users.username as name,assignment_users.email as email,assignment_users.course as course,assignment_users.batch as batch,assign_mini_project.title as title,assign_mini_project.mini_project as mini_project,assign_mini_project.status as status,assign_mini_project.id,assign_mini_project.created_at');
	$this->db->from('assignment_users');
	$this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id','inner');
	return $this->db->count_all_results();
}

public function project_search_records($keyword = '', $batch = '',$topic='') {

    $this->db->select('
        assignment_users.username AS name,
        assignment_users.email AS email,
        assignment_users.course AS course,
        assignment_users.batch AS batch,
        assign_mini_project.title AS title,
        assign_mini_project.mini_project AS mini_project,
        assign_mini_project.status AS status,
        assign_mini_project.id,
        assign_mini_project.created_at
    ');
    $this->db->from('assignment_users');
    $this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id', 'inner');

    // ✅ Keyword search if provided
    if (!empty($keyword)) {
        $this->db->group_start();
        $this->db->like('assignment_users.username', $keyword);
        $this->db->or_like('assignment_users.email', $keyword);
        $this->db->or_like('assignment_users.mobile', $keyword);
        $this->db->or_like('assignment_users.batch', $keyword);
        $this->db->or_like('assign_mini_project.title', $keyword);
        $this->db->group_end();
    }

    // ✅ Batch filter if selected
    if (!empty($batch)) {
        $this->db->where('assignment_users.batch', $batch);
    }
	if (!empty($topic)) {
        $this->db->where('assign_mini_project.title', $topic);
    }

    $this->db->order_by('assign_mini_project.created_at', 'DESC');
    $query = $this->db->get();

    return $query->result_array();
}

public function Result_Of_Assignment_Batch($batch){
	$this->db->select('assignment_pdf_tbl.id, assignment_pdf_tbl.user_id, assignment_users.username, assignment_users.email,assignment_pdf_tbl.title,assignment_pdf_tbl.marks,assignment_pdf_tbl.created_at');
	$this->db->from('assignment_users');
	$this->db->join('assignment_pdf_tbl', 'assignment_pdf_tbl.user_id = assignment_users.id','inner');
	$this->db->where('assignment_users.batch =', $batch);
	$query = $this->db->get();
	if ($query->num_rows() > 0) {
		return $query->result_array();
	} else {
		return false;
	}
}

public function Result_Of_Project_Uploaded_Not_Uploaded($batch) {
    $this->db->select('
        assignment_users.id,
        assignment_users.username as name,
        assignment_users.email as email,
        assign_mini_project.title as title,
        assignment_users.course as course,
        assignment_users.batch as batch,
        assign_mini_project.mini_project as mini_project,
        assign_mini_project.created_at
    ');
    $this->db->from('assignment_users');
    $this->db->join('assign_mini_project', 'assign_mini_project.user_id = assignment_users.id', 'left');
    $this->db->where('assignment_users.batch', $batch);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return [];
    }
}

 public function update_feedback($id, $data)
    {
        $this->db->where('id', $id);
        $update_status = $this->db->update('assignment_pdf_tbl', $data);

        return $update_status ? $id : false;
    }
public function get_assignment_file($id) {
    $this->db->select('a.id, a.assignment_pdf as path, a.title, u.username');
    $this->db->from('assignment_pdf_tbl a');
    $this->db->join('assignment_users u', 'u.id = a.user_id', 'left'); // join with users table
    $this->db->where('a.id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row(); // object with ->path, ->title, ->username
    } else {
        return false;
    }
}

public function get_project_name_file($id) {
   $this->db->select('a.id, a.mini_project as path, a.title, u.username');
	$this->db->from('assign_mini_project a');
	$this->db->join('assignment_users u', 'u.id = a.user_id', 'left');
	 $this->db->where('a.id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->row(); 
    } else {
        return false;
    }
}


}
?>
