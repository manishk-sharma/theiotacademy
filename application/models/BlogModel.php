<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');



class BlogModel extends CI_Model  

{

    public function __construct(){

        parent::__construct();

        $this->load->database();

        $this->load->library('session'); 

        //$this->load->helper('url'); 

    }
    public function getBlogList()  

    {   

        $query = $this->db->get('blog_details');

        return $query->result();

    }

//=====================Start Use In Pagination============

    public function record_count() {
        return $this->db->count_all("blog_details");
    }
    
    
    public function last_N_blogs($n){ 

        $query=$this->db->query("SELECT * FROM blog_details where status=1 ORDER BY blog_id DESC LIMIT $n");
         return $query->result();
    } 

    public function get_all_blogs($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by('created_on','desc') ;
        $query = $this->db->get("blog_details");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
  //=========For Public Page= Start ============
    public function active_record_count() {
       $this->db->where('status',1);
       $query = $this->db->get("blog_details");                
        return $query->num_rows();
    }

    public function get_all_active_blogs($limit, $start) {
        $offset = ($start - 1) * $limit;
        $this->db->where('status',1);
        $this->db->order_by('created_on','desc') ;
        $this->db->limit($limit, $offset);
        $query = $this->db->get("blog_details");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
    public function findRelatedBLog($category,$blog_id){
        $this->db->where('status',1);
        $this->db->where('category !=', $category);
        $this->db->where('blog_id !=', $blog_id);
        $this->db->limit(7);
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get("blog_details");
        if ($query->num_rows() > 4) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
        // else{
           
        //     $this->db->where('status',1);
        //     $this->db->where('blog_id !=', $blog_id);
        //     $this->db->limit(7);
        //     $this->db->order_by("created_on", "desc");
        //     $query = $this->db->get("blog_details");
        //      foreach ($query->result() as $row) {
        //             $data[] = $row;
        //         }
        //         return $data;
        // }
   }
    public function findRecentRelatedBLog($category,$blog_id){
          
        $this->db->where('status',1);
        $this->db->where('category', $category);
        $this->db->where('blog_id !=', $blog_id);
        $this->db->limit(3);
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get("blog_details");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
      
   }


      //search blog
   public function get_search_all_blogs_by_keyword($searchkeyvalue){

        $this->db->where('status',1);
        $this->db->like('keywords', $searchkeyvalue);
         $this->db->or_like('title', $searchkeyvalue);
        $this->db->or_like('route', $searchkeyvalue);
        $this->db->or_like('uploaded_by', $searchkeyvalue);
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get("blog_details");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

public function get_search_all_blogs_by_categoryname($catoptvalue){
    $this->db->where('status',1);
        $this->db->like('category', $catoptvalue);
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get("blog_details");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

}
//=========For Public Page= End============ 
   
//======================End click next 10 blog ===========
  
    public function getActiveBlogList()

    {   

        $this->db->where('status',1);

        $this->db->order_by('created_on','desc') ;

        $query = $this->db->get('blog_details');

        return $query->result();

    }



    public function insertBlog($title,$category,$description,$content,$keywords,$uploaded_by,$route){

        $data = array(

            'title'=>$title, 

            'category'=>$category,

            'description'=>$description,

            'content'=>$content,

            'keywords'=>$keywords,
            'uploaded_by'=>$uploaded_by,

            'route'=>$route

        );

        $this->db->insert('blog_details', $data);

        $blogid=$this->db->insert_id();

        return $blogid;

    }



    public function getBlogById($id){

        $data=array() ;

        $this->db->where('blog_id',$id) ;

        $query = $this->db->get('blog_details');

        $result=$query->result();

        foreach($result as $row){

            $data=array(

                'blog_id'=> $row->blog_id,

                'header_image'=> $row->header_image,

                'featured_image'=> $row->featured_image,

                'title'=> $row->title,

                'category'=> $row->category,
                'description'=> $row->description,

                'content'=> $row->content,
                'uploaded_by'=> $row->uploaded_by,
                'keywords'=> $row->keywords,

                'route'=> $row->route,

                'status'=> $row->status,

                'last_updated_on'=> date('d-m-Y',strtotime($row->last_updated_on)),

                'created_on'=> date('d-m-Y',strtotime($row->created_on))

            );

        }

        return $data ;

    }



    public function updateBlog($blog_id,$title,$category,$description,$content,$keywords,$uploaded_by,$route_name){

        $data=array(

                'title'=> $title,

                'category'=> $category,

                'description'=> $description,

                'content'=> $content,

                'keywords'=> $keywords,
                'uploaded_by'=>$uploaded_by,
                'route'=> $route_name,

        );

        $this->db->where('blog_id',$blog_id);

        $ustatus=$this->db->update('blog_details',$data);

        return $ustatus; 

    }

    //Update Header And Featured Images

    public function updateBlogImageNames($blog_id){

        $data = array(

                    'header_image'=>'headerimage-'.$blog_id.'.png',

                    'featured_image'=>'featuredimage-'.$blog_id.'.png',

                );

        $this->db->where('blog_id',$blog_id);

        $ustatus=$this->db->update('blog_details',$data);

        return $ustatus; 

    }

    //Update Featured Image Name

    public function updateFeaturedImgName($blog_id,$filestatus){

         //print_r($filestatus);

        $filetype=$filestatus['ext'];

        $data = array(

                    'featured_image'=>'featuredimage-'.$blog_id.$filetype

                );

        $this->db->where('blog_id',$blog_id);

        $ustatus=$this->db->update('blog_details',$data);

        return $ustatus; 

    }



    //Update Header Image Name

    public function updateHeaderImgName($blog_id,$headerimgstatus){

        //print_r($headerimgstatus);

        $filetype=$headerimgstatus['ext'];

        $data = array(

                    'header_image'=>'headerimage-'.$blog_id.$filetype

                );

        $this->db->where('blog_id',$blog_id);

        $ustatus=$this->db->update('blog_details',$data);

        return $ustatus; 

    }



    public function updateBlogStatus($blog_id,$status){

        $data = array('status'=>$status);

        $this->db->where('blog_id',$blog_id);

        $ustatus=$this->db->update('blog_details',$data);

        return $ustatus; 

    }

    public function getBlogImagesName($blog_id)

    {

        $data=array();

        $this->db->where('blog_id',$blog_id);

        $query=$this->db->get('blog_details');

        $result=$query->result();

        foreach ($result as $row) {

            $data=array(

                'header_image'=>$row->header_image,

                'featured_image'=>$row->featured_image

            );

        }

        return $data;

    }



    public function deleteBlogData($blog_id)

    {

       $this->db->where('blog_id',$blog_id);

        $status=$this->db->delete('blog_details');

        return $status;

    }

}

?>