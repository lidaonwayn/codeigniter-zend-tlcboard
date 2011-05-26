<?php

class Model_post extends MY_Model {

    private $prefix;
    private $prefix_cache = "post_";
    public $cid;
    private $cache;

    function __construct() {
        require(APPPATH . 'config/zend_cache.php');
        parent::__construct();
        $this->load->library('firephp');

        $this->prefix=$this->config->item('table_prefix');
        //$this->prefix_cache=$this->prefix.$this->prefix_cache;

        $this->cache = Zend_Cache::factory(
                        'Core', 'Two Levels', $zcache['frontendOpts'], $zcache['options']
        );
        $this->cache->clean();
    }

    //$config is array
    // order,sort,page,limit
    function fetchAll($config=array()) {

        //assign variable
        if (isset($config['order']))
            $field_order = $config['order'];
        else
            $field_order='post_id';
        if (isset($config['sort']) && (strtoupper($config['sort']) == "ASC" or strtoupper($config['sort']) == "DESC"))
            $sort = $config['sort'];
        else
            $sort='ASC';
        if (isset($config['limit']))
            $limit = $config['limit'];
        else
            $limit=null;
        if (isset($config['page']))
            $page = $config['page'];
        else
            $page=null;

        if (empty($id))
            $key_shuffix = "all";
        else
            $key_shuffix=$id;

        $key_cache = $this->prefix_cache . $key_shuffix;
        if (!($result = $this->cache->load($key_cache))) {
            $select = parent::select();
            $select->from($this->prefix . 'post')->order('post_id DESC');
            if (!empty($limit) && !empty($page))
                $select-- > limitpage($page, $limit);
            //$this->firephp->log("no cache");
            $result = parent::fetchAll($select);
            $this->cache->save($result, $key_cache);
            return $result;
        }else {
            //$this->firephp->log("cached");
            return $result;
        }
    }

    
    function fetch($find,$field="post_id") {
            $key_cache=$this->prefix_cache.$field.$find;
           // $this->firephp->log("post = ".$result=$this->cache->load($key_cache));
            if(!($result=$this->cache->load($key_cache))){
               // $this->firephp->log("no cache");
                    $select = parent::select ();
                    $select->from ( array('p'=>$this->prefix.'post') )
                            ->join(array('c'=>$this->prefix.'category'),
                                    'p.cate_key=c.cate_key',
                                    array('cate_id','cate_theme')
                                    )
                            ->where ( $field.'=?', $find );
                    $result=parent::fetchRow( $select );
                    $this->cache->save($result,$key_cache);
                    $result['slug']=$result['slug'].".html";
                    return $result;
            }else{
                    $result['slug']=$result['slug'].".html";
                    return $result;
            }
    }   
    
    
    function relate_slug($slug,$post_id,$cate_key=NULL){
        $count_link = 5;
        $sql_merg_relate="";
        $relate_link=explode("-", $slug, 5);
        $key_cache=$this->prefix_cache.md5($slug);
        if(!($result=$this->cache->load($key_cache))){
            for($k =0;$k<count($relate_link);$k++) {		
                $sql_merg_relate.=sprintf("SELECT '%%%s%%' AS cond ",$relate_link[$k]);
                if(($k+1)!=count($relate_link)) {		
                        $sql_merg_relate.=sprintf("UNION ALL ");
                }
            }		
            if($cate_key != NULL){
                $sql_search=sprintf("SELECT  `post_id`,`cate_key`,`post_topic`,`thumb_big`,`thumb_smll`,`slug` 
                            FROM %s w WHERE EXISTS ( SELECT  1 FROM ( %s ) c  
                            WHERE   w.`slug` LIKE cond 
                            AND w.cate_key=%s 
                            AND w.post_id!=%s 
                            AND ban ='no' 
                            AND post_status='publish' ) 
                            ORDER BY post_id desc limit 5",
                            $this->prefix.'post',$sql_merg_relate,$cate_key,$post_id);
            }else{
                $sql_search=sprintf("SELECT  `post_id`,`cate_key`,`post_topic`,`thumb_big`,`thumb_small`,`slug` 
                            FROM %s w WHERE EXISTS ( SELECT  1 FROM ( %s ) c  
                            WHERE   w.`slug` LIKE cond 
                            AND w.post_id!=%s 
                            AND ban ='no' 
                            AND post_status='publish' ) 
                            ORDER BY post_id desc limit 5",
                            $this->prefix.'post',$sql_merg_relate,$post_id);
            }
            $q=parent::query($sql_search);
            $result=$q->fetchAll();
            return $result;
        }else {
            return $result;
        }
    }
    
    
    function relate($find,$field,$codition='=',$limit=5) {
        $key_cache=$this->prefix_cache.$field.$find.$limit;
        if(!($result=$this->cache->load($key_cache))){
                $select = parent::select ();
                $select->from ( $this->prefix.'post' )
                        ->where ( $field.$codition." ?", $find )
                        ->limit(0, $limit);
                $result=parent::fetchRow( $select );
                $this->cache->save($result,$key_cache);
                return $result;
        }else{
                return $result;
        }
    } 
    
    function insert($data) {
        //$pre_data[]=array();
        foreach ($data as $key => $value) {
            if(is_numeric($key)) {
               continue; 
            }
            $pre_data[$key]=$value;
        }

        
        $pre_data['post_date']=new Zend_Db_Expr('NOW()');
        $pre_data['table_reply']=$this->config->item('table_prefix').$this->config->item('table_reply');
        $pre_data['table_modify']=$this->config->item('table_prefix').$this->config->item('table_modify');
        
        try {
            parent::insert($this->prefix.'post', $pre_data);
            return TRUE;
        }catch(Exception $e) {
           // return($e->getMessage());
            return FALSE;
        }   
    }

    function update($data,$id) {
        //$pre_data[]=array();
        $result_post=$this->fetch($id);
        $this->firephp->log($data);
        foreach ($data as $key => $value) {
            if(is_numeric($key)) {
               continue; 
            }elseif($key=="post_ip"){
                $pre_data['modify_ip']=$value ;
            }else{
                $pre_data[$key]=$value;
            }
        }
        $pre_data['modify_date']=new Zend_Db_Expr('NOW()');
        
        foreach ($result_post as $key => $value) {
            if((is_numeric($key)) or ($key=="cate_id") or ($key=="cate_theme")) {
               continue; 
            }else{
                $pre_olddata[$key]=$value;
            }
            
        }
 
        $this->firephp->log($pre_olddata);
        
        try {
            parent::insert($result_post['table_modify'], $pre_olddata);
            parent::update($this->prefix.'post', $pre_data,"post_id=".$id);
            return TRUE;
        }catch(Exception $e) {
           // return($e->getMessage());
            return FALSE;
        }   
    }
    
    function check_uniq($filed, $str,$post_id=NULL) {
        $select = parent::select();
        $select->from($this->prefix . 'post', array('count' => 'COUNT(*)'));
        $select->where($filed . '=?', $str);
        if(!empty($post_id)){
           $select->where('post_id!=?', $post_id); 
        }
        $qcount=$select->query();
        $rcount=$qcount->fetchObject();
        if ($rcount->count > 0){
            $select->reset();
            return FALSE;
        }elseif($rcount->count == 0){
            $select->reset();
            return TRUE;
        }else{
            $select->reset();
            return FALSE;
        }
    }

}

?>