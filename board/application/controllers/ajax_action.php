<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Ajax_action extends MY_Controller {

    private $segment_begin;

    function __construct() {
        parent::__construct();
        $this->load->library('output');
        $this->load->library('firephp');
        $this->segment_begin = $this->config->item('segment_begin');
        $this->output->set_status_header(200);
        $this->output->set_header('Content-type: application/json');
    }

    function upload() {
        $this->load->library('upload');
        $this->load->helper('random');
        $filename = $this->uri->segment($this->segment_begin + 2);
        //$this->firephp->log($filename);
        $name = random_char(20);
        if ($filename == "thumb") {
            $max_size = 30 * 1024;
            $uploaddir = $this->config->item('fullpath_temp');
            $image_x = 120;
            $image_y = 90;
            $image_thumb = 70;
            $image_resize = true;
            $urlDir = $this->config->item('urlpath_temp');
            $dir_pre = $this->config->item('fullpath_temp') . "board/";
            $time_name = date("Y/n/j/H");
            $realdir = $dir_pre . $time_name . "/";
        } elseif ($filename == "pic") {
            $dir_pre = $this->config->item('fullpath_data') . "board/";
            $time_name = date("Y/n/j/H");
            $max_size = 100 * 1024;
            $image_x = 400;
            $image_y = 400;
            $image_resize = false;
            $uploaddir = $dir_pre . $time_name . "/";
            $realdir = $dir_pre . $time_name . "/";
            $urlDir = $this->config->item('urlpath_data') . "board/" . $time_name . "/";
        }

        $handle_file = new upload($_FILES [$filename]);
        if ($handle_file->uploaded) {
            $handle_file->file_new_name_body = $name;
            $handle_file->image_resize = $image_resize;
            $handle_file->image_x = $image_x;
            $handle_file->image_y = $image_y;
            $handle_file->image_default_color = "#FFFFFF";
            $handle_file->image_ratio_x = true;
            $handle_file->auto_create_dir = true;
            $handle_file->process($uploaddir);
            $handle_file->file_max_size = $max_size;
            $handle_file->allowed = array('image/*');
            if ($handle_file->file_is_image) {
                if ($handle_file->file_src_size > $max_size) {
                    $status ['success'] = 0;
                    $status ['error'] = "ขนาดรูปเกิน " . ($max_size / 1000) . " kb";
                    echo json_encode($status);
                    die();
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

        if ($filename == "thumb") {
            $handle_file->file_new_name_body = $name . "_thumb";
            $handle_file->image_resize = $image_resize;

            $handle_file->image_x = $image_thumb;
            $handle_file->image_y = $image_thumb;
            $handle_file->image_default_color = "#FFFFFF";

            $handle_file->image_ratio_x = true;
            $handle_file->auto_create_dir = true;
            $handle_file->process($uploaddir);
            $handle_file->file_max_size = $max_size;
            $handle_file->allowed = array('image/*');
            if ($handle_file->file_is_image) {
                if ($handle_file->file_src_size > $max_size) {
                    $status['success'] = 0;
                    $status['error'] = "ขนาดรูปเกิน " . ($max_size / 1000) . " kb";
                }
                if ($handle_file->processed) {
                    $status['name_thumb'] = $handle_file->file_dst_name;
                    $status['size_thumb'] = $handle_file->file_src_size;
                    $status['urlpath_thumb'] = $urlDir . $handle_file->file_dst_name;
                    $status['fullpath_thumb'] = $handle_file->file_dst_pathname;
                    $status['realdir'] = $realdir;
                } else {
                    $status['success'] = 0;
                    $status['error'] = $handle_file->error;
                }
            } else {
                $status['success'] = 0;
                $status['error'] = "อนุญาติเฉพาะไฟล์รูปนามสกุล jpg,jpeg,gif,png";
                die();
            }
        }
        $handle_file->clean();
        echo json_encode($status);
        die();
    }

    function save() {
        
        $badword_arr=array();
        
        $session_tlc = new Zend_Session_Namespace('tlcthai');
        require_once APPPATH . 'libraries/HTMLPurifier/HTMLPurifier.auto.php';
        $_SESSION['center_login_name'] = 'aum';
        //$this->load->library('ip2location_lite');
        //$this->load->library('firephp');
        $this->load->library('securimage/securimage');
        $this->load->library('input');

        $this->load->helper('text');

        $this->load->model('model_block_ip', 'block_ip');
        $this->load->model('model_bad_word', 'bad_word');
        $this->load->model('model_post', 'post');
        $delthumb=0;
        //---------test--------------------
        //$session_tlc->username = $_SESSION['center_login_name'];
        //$this->firephp->log($_SESSION);
        //$this->firephp->log($this->input->post());
        //---------endtest--------------------
        
        if($session_tlc->checkpost['post']!=$this->input->post('code_post')){
                $status['success'] = 0;
                $status['error'] = "เกิดข้อผิดพลาด กรุณา กด f5 แล้ว่ส่งข้อมูลใหม่";
                echo json_encode($status);
                die();
        }

        foreach ($this->block_ip->fetchAll() as $value) {
            if (!$this->input->valid_ip($value['ip'])) {
                $status['success'] = 0;
                $status['error'] = "ip นี้ไม่ได้รับอนุญาตให้้ใช้งาน";
                echo json_encode($status);
                die();
            }
        }


        if ($this->securimage->check($this->input->post('code')) == false) {
            $status['success'] = 0;
            $status['error'] = "ใส่รหัสป้องกัน บอทไม่ถูกต้อง";
            echo json_encode($status);
            die();
        }

        
        foreach ($this->bad_word->fetchAll() as $value) {
            $badword_arr[] = $value['bad_word'];
        }

        $htmlallow = '	object[width|height|data],
                        param[name|value],
                        a[href],
                        img[src|alt],
                        span,param,
                        br,i,b,ul,li,p
                        ';

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
        $config->set('HTML.TidyLevel', 'medium');
        $config->set('HTML.SafeObject', true);
        $config->set('Output.FlashCompat', true);
        $config->set('Filter.YouTube', true);
        $config->set('HTML.Allowed', $htmlallow);

        $htmlpurifier = new HTMLPurifier();
        
        $thumb_small = $this->input->post('path_thumb_small', TRUE);
        $thumb_big = $this->input->post('path_thumb_big', TRUE);
        $thumb_ext = $this->input->post('pic_ext', TRUE);
        $delthumb = $this->input->post('delthumb', TRUE);
        $thumb_name_only = $this->input->post('name_only', TRUE);
        $this->firephp->log($thumb_small,$thumb_big);
        
        $post_detail = $htmlpurifier->purify($this->input->post('post_detail', TRUE), $config);
        $post_detail=nl2br($post_detail);
        $post_detail = word_censor($post_detail, $badword_arr, '***');
        $post_topic = strip_tags(trim($this->input->post('post_topic', TRUE)));
        $post_name = strip_tags(trim($this->input->post('post_name', TRUE)));
        $post_category = strip_tags(trim($this->input->post('category', TRUE)));
        $post_tag = strip_tags($this->input->post('post_tag', TRUE));
        $slug = strip_tags($this->input->post('slug', TRUE));
        $button = strip_tags($this->input->post('submit_value', TRUE));
        
        if((!empty($thumb_small) and !empty ($thumb_big)) and ($delthumb==0) and ($button!="preview") ){
            //ใส่รูป thumb
            $time_name=date("Y/n/j/H");
            $dir_pre = $this->config->item('fullpath_data') . "board/";
            $path_thumb_big=$dir_pre.$time_name."/".$thumb_name_only."_big".".".$thumb_ext ;
            $path_thumb_small=$dir_pre.$time_name."/".$thumb_name_only."_small".".".$thumb_ext;
            
            if(!is_dir($dir_pre.$time_name)){
                mkdir($dir_pre.$time_name, 777, true);
            }
            if( (!copy($thumb_big,$path_thumb_big)) or (!copy($thumb_small,$path_thumb_small)) )
            {
                    $status['success']=0 ;
                    $status['error']="อัพโหลดรูป ไม่สำเร็จ" ;
                    echo json_encode($status);
                    die();
            }else{
                    $urlthumb_big=$this->config->item('urlpath_data')."board/".$time_name."/".$thumb_name_only."_big".".".$thumb_ext ;
                    $urlthumb_small=$this->config->item('urlpath_data')."board/".$time_name."/".$thumb_name_only."_small".".".$thumb_ext;
                    $isthumb= 1 ;
            }
        }else{
                $urlthumb_big="";
                $urlthumb_small="";
                $isthumb= 0 ;
        }

        $data['post_status'] = $button;
        $data['cate_key'] = $post_category;
        $data['post_detail'] = $post_detail;
        $data['post_topic'] = $post_topic;
        $data['post_name'] = $post_name;
        $data['post_tag'] = $post_tag;
        $data['slug'] = $slug;
        $data['post_tmp']=$isthumb;
        $data['thumb_small'] = $urlthumb_small;
        $data['thumb_big'] = $urlthumb_big;
        $data['post_ip'] = $this->input->ip_address();
        $data['mode_comment'] = $this->input->post('mode_comment', TRUE);
            
         
        //var_dump($data);
        if (($button == "publish") or ($button == "draft")) {
            if($this->post->insert($data)){
                if ((!$this->post->check_uniq('slug', $slug)) and ($button != "preview")) {
                    //$this->firephp->log("ซ้ำ");
                    $status['success'] = 0;
                    $status['error'] = "slug ต้องไม่ซ้ำ";
                    echo json_encode($status);
                    die();
                }
              $status['success']=1;
            }else{
               $status['success']=0; 
            }
            $status['callback'] = $button;
        }elseif ($button == "preview") {
              $status['success']=1;
              $data['post_detail']=htmlspecialchars($data['post_detail']);
              setcookie("data_post",json_encode($data),time()+1200,"/");
              //$this->firephp->log(json_encode($data));
              //$this->firephp->log("setcookie preview");
             // $this->firephp->log($_COOKIE["data_post"]);
            $status['callback'] = "preview";
        }elseif ($button == "edit") {
            $post_id = $this->input->post('post_id', TRUE);
            $data['post_status'] = "publish";
            if ((!$this->post->check_uniq('slug', $slug,$post_id)) and ($button != "preview")) {
                $status['success'] = 0;
                $status['error'] = "slug ต้องไม่ซ้ำ";
                echo json_encode($status);
                die();
            }
            if($this->post->update($data,$post_id)){
              $status['success']=1;
            }else{
               $status['success']=0; 
            }
            $status['callback'] = "edit";
        }
        //$session_tlc->checkpost['post']='0000000000';
        echo json_encode($status);
        die();

    }

}