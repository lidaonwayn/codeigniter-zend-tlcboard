<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Topic extends MY_Controller {

    function __construct() {
        parent::__construct();  
        $this->load->library('firephp');
        $this->load->library('zacl');
        $this->load->helper('url');
       // session_start();
        session_cache_expire();
        //session_destroy();
    }
    
    function create_session(){
       
        $session_member = new Zend_Session_Namespace('member');
        $_SESSION['center_userid'] = 41551;
        //$this->firephp->log($_SESSION['center_userid']);
        if(isset($_SESSION['center_userid'])){
            if(!isset($session_member->sync) or ($session_member->sync=='no')){      
                 $this->load->library('Dump_session_user');
                  new dump_session_user($_SESSION['center_userid']);
            }
        }
    }

    function add() {
        $this->load->library('parser');
        $this->load->library('input');
        $this->create_session();

        $segment_begin = $this->config->item('segment_begin');
        $data['assets_path'] = $this->config->item('assets_path');
        $session_tlc = new Zend_Session_Namespace('tlcthai');
        $session_member = new Zend_Session_Namespace('member');
        $this->load->model('model_category', 'category');

        $this->load->library('securimage/securimage');
        $img = new Securimage();
        //$this->firephp->log($img->generateCode(5));
        if($this->zacl->check_acl($session_member->member_role_name,'topic/edit') !== TRUE ){
            redirect('/login', 'refresh');
        }
       
        $category = $this->category->fetch($this->uri->segment($segment_begin + 2));
        $cmeta = $this->category->fetchmeta($this->uri->segment($segment_begin + 2));
        $cparent = $this->category->fetch_each_parent($category['cate_parent']);
        //$this->firephp->log($cparent);
        $data['gen_id'] = md5(time());
        $date = new Zend_Date();
        $session_tlc->checkpost = array(
            'post' => $data['gen_id'],
            'time' => $date->get(),
        );
        if(isset($session_member->member_login))   {
            $data['session_post_name'] = $session_member->member_login ;
        }
        foreach ($cmeta as $arrvalue) {
            $meta_key = explode("-", $arrvalue['meta_key']);
            $metatag[($meta_key[0])][($meta_key[1])][($meta_key[2])] = $arrvalue['meta_value'];
        }
        $data['ip'] = $this->input->ip_address();
        $data['action']="add";
        $data['metatag'] = $metatag;
        $data['theme'] = $category['cate_theme'];
        $data['cparent'] = $cparent;
        $data['sid'] = md5(time());
        //$this->firephp->log($_SESSION);
        $this->parser->parse($category['cate_theme'] . "/backend/topic.tpl", $data);
    }
    
    function edit() {
        $this->load->library('parser');
        $this->load->library('input');
        $this->create_session();
        $segment_begin = $this->config->item('segment_begin');
        $session_tlc = new Zend_Session_Namespace('tlcthai');
        $session_member = new Zend_Session_Namespace('member');
        
        $this->load->model('model_post', 'post');
        $this->load->model('model_category', 'category');

        $this->load->library('securimage/securimage');
        $img = new Securimage();
        //$this->firephp->log($img->generateCode(5));
        //$this->firephp->log($acl->isAllowed('topic/edit',$session_member->member_role_name ));
        $post_id=$this->uri->segment($segment_begin + 2);
        $data=$this->post->fetch($post_id);
        $data['slug']=substr($data['slug'], 0, -5); 
        $data['post_tag']=explode(" ", $data['post_tag']);
        $data['assets_path'] = $this->config->item('assets_path');
        $data['post_detail']=htmlspecialchars($data['post_detail']);
        $this->firephp->log($_SESSION);
        $this->firephp->log($this->zacl->check_acl($session_member->member_role_name,'topic/edit')); 
        
        if($this->zacl->check_acl($session_member->member_role_name,'topic/edit',$session_member->member_id,$data['post_userid']) !== TRUE ){
            redirect('/login', 'refresh');
        }
       // $acl=new zacl;
        //$this->firephp->log($acl->check_acl('topic/edit',$session_member->member_role_name));
        
        $category = $this->category->fetch($data['cate_key']);
        $cmeta = $this->category->fetchmeta($data['cate_key']);
        $cparent = $this->category->fetch_each_parent($category['cate_parent']);
        //$this->firephp->log($cparent);
        $data['gen_id'] = md5(time());
        $date = new Zend_Date();
        $session_tlc->checkpost = array(
            'post' => $data['gen_id'],
            'time' => $date->get(),
        );

        foreach ($cmeta as $arrvalue) {
            $meta_key = explode("-", $arrvalue['meta_key']);
            $metatag[($meta_key[0])][($meta_key[1])][($meta_key[2])] = $arrvalue['meta_value'];
        }
        if(isset($session_member->member_login))   {
                $data['session_post_name'] = $session_member->member_login ;
        }
        $data['action']="edit";
        $data['ip'] = $this->input->ip_address();
        $data['metatag'] = $metatag;
        $data['theme'] = $category['cate_theme'];
        $data['cparent'] = $cparent;
        $data['sid'] = md5(time());
        //$this->firephp->log($data);
        $this->parser->parse($category['cate_theme'] . "/backend/topic.tpl", $data);
    }

}

?>
