<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Action_reply extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('output');
        $this->load->library('firephp');
        $this->load->library('antibot_aum');
        $this->segment_begin = $this->config->item('segment_begin');
        $this->output->set_status_header(200);
        $this->output->set_header('Content-type: application/json');
       
    }
    
    function save_reply(){
        $this->load->library('input');
        $this->load->helper('text');
        $this->load->model('model_reply', 'reply');
        $this->load->model('model_post', 'post');
        $session_tlc = new Zend_Session_Namespace('tlcthai');
        
        $reply_detail=strip_tags($this->input->post('reply_detail', TRUE));
        $post_id=$this->input->post('post_id', TRUE);
        $reply_ip=$this->input->post('ip', TRUE);
        $reply_email=$this->input->post('reply_email', TRUE);
        $reply_website=$this->input->post('reply_website', TRUE);
        $reply_detail=nl2br($reply_detail);
        $reply_name=strip_tags($this->input->post('reply_name', TRUE));
        $result_post=$this->post->fetch($post_id);
        if(empty($reply_detail) or empty($reply_name) or empty($post_id) or empty($reply_ip)){
               $status['success']=0 ;
               $status['error']="ข้อมูลที่ส่งมาไม่ครบ กรุณาลองใหม่" ;
               echo json_encode($status);
               die();
        }
        
        if(!$this->antibot_aum->checkbot($this->input->post('post_antibot', TRUE))){
               $status['success']=0 ;
               $status['error']="รหัสป้องกันบอทผิด กรุณากรอกใหม่"; ;
               echo json_encode($status);
               die();
        }
        
       $data['post_id']=$post_id;
       $data['reply_detail']=$reply_detail;
       $data['reply_email']=$reply_email ;
       $data['reply_website']=$reply_website ;
       $data['reply_ip']=$this->input->ip_address();
       $data['name']=$reply_name;

       if($session_tlc->username) $data['user_id']=$user_id;
       if($this->reply->insert($data,$result_post['table_reply'])){
           $status['success']=1;
       }else{
           $status['success']=0; 
           $status['error']="บันทึกข้อมูล ไม่ได้"; 
       }
        echo json_encode($status);
        die();
    }
    
    function report()
    {
        $this->load->model('model_reply', 'reply');
        $this->load->model('model_post', 'post');
        $session_tlc = new Zend_Session_Namespace('tlcthai');
               
         $post_id=$this->input->post('post_id', TRUE);
         $result_post=$this->post->fetch($post_id);
         $reply_id=$this->input->post('reply_id', TRUE);
         $action=$this->input->post('action', TRUE);
         if($action=="vote") $result=$this->reply->vote_increase($reply_id,$result_post['table_reply']);
         elseif($action=="devote") $result=$this->reply->vote_decrease($reply_id,$result_post['table_reply']);
         elseif($action=="ban") $result=$this->reply->report_ban($reply_id,$result_post['table_reply']);
         else{
             $status["success"]=0;
             $status["action"]=$action;
             $status["error"]='พารามิเตอร์ ไม่ครบ';
         }
         
         if(is_numeric($result)){
             $status["success"]=1;
             $status["action"]=$action;
             $status["vote"]=$result;
         }else{
             $status["success"]=0;
             $status["error"]=$action.'ไม่สำเร็จ';
         }
        echo json_encode($status);
        die();
    }
}
