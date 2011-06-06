<?php

class view extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('firephp');
        $this->load->library('parser');   
        $this->load->helper('url');
        $this->load->helper('smiley');
        $this->load->library('antibot_aum');
        $this->load->helper('html');
    }
    
    function index(){ 
        $per_page=20;
        $segment_begin = $this->config->item('segment_begin');
        $session_tlc = new Zend_Session_Namespace('tlcthai');
        $this->load->model('model_post', 'post');
        $this->load->model('model_category', 'category');
        $this->load->model('model_reply', 'reply');
        $this->load->library('pagination');
        $post_id=str_replace('.html','',$this->uri->segment($segment_begin + 1));
        //$post_id=substr($this->uri->segment($segment_begin + 1),0, -5);
        //var_dump(str_replace('.html','',$post_id)) ;
        //exit;
        $data=$this->post->fetch($post_id);
        $data['assets_path'] = $this->config->item('assets_path');
        $data['relate_slug']=$this->post->relate_slug($data['slug'],$post_id);
        $data['relate_cate']=$this->post->relate($data['cate_key'],'cate_key');
        $data['theme']=$data['cate_theme'];
        $data['post_tag']=explode(" ", trim($data['post_tag']));
        $category = $this->category->fetch($data['cate_key']);
        $cmeta = $this->category->fetchmeta($data['cate_key']);
        $cparent = $this->category->fetch_each_parent($category['cate_parent']);

        ////////// page ////////////////////
        //$page['base_url'] = base_url().'view/'.$post_id.'/'.$data['slug'];
        $page['base_url'] = base_url().'view/'.$post_id.".html";
        $page_current=$this->uri->segment($segment_begin + 2);
        if (empty($page_current)) $page_current=1 ;
        $page['full_tag_open'] = '<center>';
        $page['full_tag_close'] = '</center>';
        $page['first_link'] = 'First';
        $page['last_link'] = 'Last';
        $page['uri_segment'] = 3;
        $page['display_pages'] = true;  
        $page['total_rows'] = $this->reply->count($post_id,$this->config->item('table_reply'));
        $page['per_page'] = $per_page; 
        $this->pagination->initialize($page); 
        $data['page_nav']=$this->pagination->create_links();
        //////////  end page //////////////////////
        
        foreach ($cmeta as $arrvalue) {
            $meta_key = explode("-", $arrvalue['meta_key']);
            $metatag[($meta_key[0])][($meta_key[1])][($meta_key[2])] = $arrvalue['meta_value'];
        }
        
        $data['page_current']=$page_current;
        $data['base_url'] = base_url();
        $data['ip'] = $this->input->ip_address();
        $data['metatag'] = $metatag;
        $data['theme'] = $category['cate_theme'];
        $data['cate_name'] = $category['cate_name'];
        $data['antibot_txt'] = $this->antibot_aum->create();
        $data['count_reply'] = $page['total_rows'];
        $data['sid'] = md5(time());
        $data['mode']="view";
//        $col_array = $this->table->make_columns($image_array, 8);
//        $data['smiley_table'] = $this->table->generate($col_array);
//        $data['smileys_array'] = get_clickable_smileys($data['assets_path']."img/smileys/", 'comments');
//        $data['smileys_js']=smiley_js();
//        $image_array = smiley_js("comment_textarea_alias", "reply_detail");
        
       // $image_array = get_smiley_links($data['assets_path']."img/smileys/", "comments");
         $data['smileys_array'] = get_clickable_smileys($data['assets_path']."img/smileys/", 'reply_detail');
         $data['smileys_js']=smiley_js();
         

         //comment
         $data['comment']=$this->reply->fetchpage($post_id,$this->config->item('table_reply'),$page_current,$per_page);
         //var_dump($data['comment']);
         //end comment 
         echo doctype('xhtml1-trans');
        $this->parser->parse($data['theme'] . "/single.tpl", $data);
    }
    
    function preview()
    {
        $this->load->model('model_category', 'category');      
        //var_dump($_COOKIE);
        if(isset($_COOKIE["data_post"])){
            $data=json_decode($_COOKIE["data_post"],true);
        }else{
            echo "ไม่มีข้อมูล ระบบนี้ต้องใช้ cookie";
            die();
        }
        
        $category = $this->category->fetch($data['cate_key']);
        $data['post_detail']=htmlspecialchars_decode($data['post_detail']);
        $data['cate_name'] = $category['cate_name'];
        $data['assets_path'] = $this->config->item('assets_path');
        $data['base_url'] = base_url();
        $data['post_tag']=explode(" ", trim($data['post_tag']));
        $data['mode']="preview";
        //var_dump($data);
        
        $data['theme'] = $category['cate_theme'];
        echo doctype('xhtml1-trans');
        $this->parser->parse($data['theme'] . "/single.tpl", $data);
    }
    
}
?>
