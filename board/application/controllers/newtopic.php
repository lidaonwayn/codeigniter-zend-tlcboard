<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Newtopic extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('firephp');
    }

    function add() {
        $this->load->library('parser');
        //$this->load->library('form_validation');
        //$this->load->helper('form');
        //$this->load->library('ip2location_lite');
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
        $data['gen_id']= md5(time());
        $date = new Zend_Date();
        $session_tlc->checkpost = array(
            'post' => $data['gen_id'],
            'time' => $date->get(),      
        );
        //$this->firephp->log($session_tlc->checkpost);
        
        foreach ($cmeta as $arrvalue) {
            $meta_key = explode("-", $arrvalue['meta_key']);
            $metatag[($meta_key[0])][($meta_key[1])][($meta_key[2])] = $arrvalue['meta_value'];
        }
        $data['ip'] = $this->input->ip_address();
        $data['metatag'] = $metatag;
        $data['theme'] = $category['cate_theme'];
        $data['cparent'] = $cparent;
        $data['sid'] = md5(time());
        //$this->firephp->log($_SESSION);
        $this->parser->parse($category['cate_theme'] . "/newtopic.tpl", $data);
    }

}

?>
