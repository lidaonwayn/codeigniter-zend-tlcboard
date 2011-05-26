<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Topic extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('firephp');
    }

    function add() {
        $this->load->library('parser');
        $this->load->library('input');
        $segment_begin = $this->config->item('segment_begin');
        $data['assets_path'] = $this->config->item('assets_path');
        $session_tlc = new Zend_Session_Namespace('tlcthai');

        $this->load->model('model_category', 'category');

        $this->load->library('securimage/securimage');
        $img = new Securimage();
        //$this->firephp->log($img->generateCode(5));

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
        
        $segment_begin = $this->config->item('segment_begin');
        $session_tlc = new Zend_Session_Namespace('tlcthai');

        $this->load->model('model_post', 'post');
        $this->load->model('model_category', 'category');

        $this->load->library('securimage/securimage');
        $img = new Securimage();
        //$this->firephp->log($img->generateCode(5));
        
        $post_id=$this->uri->segment($segment_begin + 2);
        $data=$this->post->fetch($post_id);
        $data['slug']=substr($data['slug'], 0, -5); 
        $data['post_tag']=explode(" ", $data['post_tag']);
        $data['assets_path'] = $this->config->item('assets_path');
        $data['post_detail']=htmlspecialchars($data['post_detail']);
        $this->firephp->log($data['post_detail']);
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
        $data['action']="edit";
        $data['ip'] = $this->input->ip_address();
        $data['metatag'] = $metatag;
        $data['theme'] = $category['cate_theme'];
        $data['cparent'] = $cparent;
        $data['sid'] = md5(time());
        $this->parser->parse($category['cate_theme'] . "/backend/topic.tpl", $data);
    }

}

?>
