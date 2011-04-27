<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ajax_action extends MY_Controller {
	
	private $segment_begin;
	
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'firephp' );
		$this->segment_begin = $this->config->item ( 'segment_begin' );		
	}
	
	function upload() {
		$this->load->library ('upload');
		$this->load->helper('random');
		$filename = $this->uri->segment ( $this->segment_begin + 2 );
		$this->firephp->log($filename);
		$name = random_char ( 20 );
		if ($filename == "thumb") {
			$max_size = 30 * 1024;
			$uploaddir = $this->config->item ( 'fullpath_temp' );
			$image_x = 120;
			$image_y = 90;
			$image_thumb = 70;
			$image_resize = true;
			$urlDir = $this->config->item ( 'urlpath_temp' );
			$dir_pre = $this->config->item ( 'fullpath_temp' ) . "board/";
			$time_name = date ( "Y/n/j/H" );
			$realdir = $dir_pre . $time_name . "/";
		} elseif ($filename == "pic") {
			$dir_pre = $this->config->item ( 'fullpath_data' ). "board/";
			$time_name = date ( "Y/n/j/H" );
			$max_size = 100 * 1024;
			$image_x = 400;
			$image_y = 400;
			$image_resize = false;
			$uploaddir = $dir_pre . $time_name . "/";
			$realdir = $dir_pre . $time_name . "/";
			$urlDir = $this->config->item ( 'urlpath_data' )."board/". $time_name . "/";
		}
		
		$handle_file = new upload ( $_FILES [$filename] );
		if ($handle_file->uploaded) {
			$handle_file->file_new_name_body = $name;
			$handle_file->image_resize = $image_resize;
			$handle_file->image_x = $image_x;
			$handle_file->image_y = $image_y;
			$handle_file->image_default_color = "#FFFFFF";
			$handle_file->image_ratio_x = true;
			$handle_file->auto_create_dir = true;
			$handle_file->process ( $uploaddir );
			$handle_file->file_max_size = $max_size;
			$handle_file->allowed = array ('image/*' );
			if ($handle_file->file_is_image) {
				if ($handle_file->file_src_size > $max_size) {
					$status ['success'] = 0;
					$status ['error'] = "ขนาดรูปเกิน " . ($max_size / 1000) . " kb";
					echo json_encode ( $status );
					return 0;
				}
				if ($handle_file->processed) {
					$status ['name_only'] = $name;
					$status ['name'] = $handle_file->file_dst_name;
					$status ['ext'] = $handle_file->file_dst_name_ext;
					$status ['oldname'] = $handle_file->file_src_name;
					$status ['size'] = $handle_file->file_src_size;
					$status ['urlpath'] = $urlDir . $handle_file->file_dst_name;
					$status ['fullpath'] = $handle_file->file_dst_pathname;
					$status ['realdir'] = $realdir;
					$status ['urlDir'] = $urlDir;
					$status ['success'] = 1;
				} else {
					$status ['success'] = 0;
					$status ['error'] = $handle_file->error;
				}
			} else {
				$status ['success'] = 0;
				$status ['error'] = "อนุญาติเฉพาะไฟล์รูปนามสกุล jpg,jpeg,gif,png";
			}
		} else {
			$status ['success'] = 0;
			$status ['error'] = $handle_file->error;
		}
		
		if($filename=="thumb"){
		$handle_file->file_new_name_body   = $name."_thumb";
		$handle_file->image_resize         = $image_resize;
	
		$handle_file->image_x              = $image_thumb;
		$handle_file->image_y              = $image_thumb;
		$handle_file->image_default_color="#FFFFFF";
	
		$handle_file->image_ratio_x        = true;
		$handle_file->auto_create_dir = true;
		$handle_file->process($uploaddir);
		$handle_file->file_max_size= $max_size;
		$handle_file->allowed = array('image/*');
		if($handle_file->file_is_image){
			if($handle_file->file_src_size > $max_size ){
				 $status['success'] = 0 ;
				 $status['error'] = "ขนาดรูปเกิน ".($max_size/1000)." kb";
			}
			if ($handle_file->processed) {
				$status['name_thumb'] = $handle_file->file_dst_name ;
				$status['size_thumb']=$handle_file->file_src_size ;
				$status['urlpath_thumb']=$urlDir.$handle_file->file_dst_name ;
				$status['fullpath_thumb']=$handle_file->file_dst_pathname ;
				$status['realdir']=$realdir;
			  } else {
				 $status['success'] = 0 ;
				 $status['error'] = $handle_file->error;
			  }
		}else{
			$status['success'] = 0 ;
			$status['error'] = "อนุญาติเฉพาะไฟล์รูปนามสกุล jpg,jpeg,gif,png" ;
			die();
		}
	}
		$handle_file->clean ();
		echo json_encode ( $status );
		return 0;
	}

	function save() {	
		$this->load->library('Zend');
        $this->zend->load('Zend/Session');	
        $session_tlc = new Zend_Session_Namespace('tlcthai');
		require_once APPPATH.'libraries/HTMLPurifier/HTMLPurifier.auto.php';
		$_SESSION['center_login_name']='aum';
		$this->load->library('ip2location_lite');
		$this->load->library('securimage');
		$this->load->library('input');
		
        
		
		$this->load->helper('text');
		$session_tlc = new Zend_Session_Namespace('tlcthai');	
		$this->firephp->log($_SESSION);
		//$this->firephp->log($this->input->ip_address());
		//$this->firephp->log($this->ip2location_lite->getCity($this->input->ip_address()));
		
		$this->load->model('model_block_ip', 'block_ip');
		$this->load->model('model_bad_word', 'bad_word');
		
		
		foreach($this->block_ip->fetchAll() as $value){
			if(!$this->input->valid_ip($value['ip'])){
				$status['success']=0 ;
				$status['error']="ip นี้ไม่ได้รับอนุญาตให้้ใช้งาน" ;
				return json_encode($status);
			}
		}
		
		if($this->securimage->check(trim($_POST['code']))== false) {
			$status['success']=0 ;
			$status['error']="ใส่รหัสป้องกัน บอทไม่ถูกต้อง" ;
			return json_encode($status);
		}
		
		foreach($this->bad_word->fetchAll() as $value){
			$bad_word[]=$value['bad_word'];
		}
		$htmlallow ='	object[width|height|data],
		 				param[name|value],
		 				a[href],
		 				img[src|alt],
		 				span,param,
						br,i,b,ul,li
		 				';
		 	 
		$config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
        $config->set('HTML.TidyLevel', 'medium');
        $config->set('HTML.SafeObject', true);
        $config->set('Output.FlashCompat', true);
        $config->set('Filter.YouTube', true);
        $config->set('HTML.Allowed',$htmlallow );
       
        $htmlpurifier = new HTMLPurifier();
        $post_detail = $htmlpurifier->purify( $_POST['post_detail'] , $config );   
        $post_detail = word_censor($post_detail, $bad_word, '***');   
		$post_name=strip_tags($_POST['post_name']);
		$post_tag=strip_tags($_POST['post_tag']);
		$slug=strip_tags($_POST['slug']);



	}
}