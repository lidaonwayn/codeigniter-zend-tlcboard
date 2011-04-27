<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Newtopic extends MY_Controller {

       function __construct()
       {
            parent::__construct();
           	$this->load->library('firephp');
       }

       function add()
       {  	
       		$this->load->library('parser');	 	
		    $this->load->library('form_validation');
		    $this->load->helper('form');
       		
       		$segment_begin=$this->config->item('segment_begin');
       		$data['assets_path']=$this->config->item('assets_path');
       		
       		$this->load->model('model_category', 'category');
          	
          	$category=$this->category->fetch($this->uri->segment($segment_begin+2));
          	$cmeta=$this->category->fetchmeta($this->uri->segment($segment_begin+2));
          	$cparent=$this->category->fetch_each_parent($category['cate_parent']);
          	//$this->firephp->log($cparent);
          	
          	foreach($cmeta as $arrvalue){
          		$meta_key=explode("-",$arrvalue['meta_key']);
          		$metatag[($meta_key[0])][($meta_key[1])][($meta_key[2])]=$arrvalue['meta_value'];
          	}
          	
          	$data['metatag']=$metatag;	
          	$data['theme']=$category['cate_theme'];
          	$data['cparent']=$cparent;
			$data['sid']=md5(time());

          	$this->parser->parse($category['cate_theme']."/newtopic.tpl",$data); 	
       }
       

}
?>
