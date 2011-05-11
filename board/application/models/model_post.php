<?php

class Model_post extends MY_Model {

    private $prefix;
    private $prefix_cache = "post_";
    public $cid;

    //private $cache;

    function __construct() {
        parent::__construct();
        require(APPPATH . 'config/zend_cache.php');
        $this->load->library('firephp');
        $this->load->library('Zend');
        $this->zend->load('Zend/Cache');

        $this->prefix=$this->config->item('table_prefix');
        $this->prefix_cache=$this->prefix.$this->prefix_cache;
        $zcache = $zend_cache;
        $zcache['options'] = array(
            'slow_backend' => 'Apc',
            'fast_backend' => 'Memcached',
            'slow_backend_options' => $zcache['slowbackendOpts'],
            'fast_backend_options' => $zcache['fastbackendOpts'],
            'stats_update_factor' => 10,
            'slow_backend_custom_naming' => false,
            'fast_backend_custom_naming' => false,
            'slow_backend_autoload' => false,
            'fast_backend_autoload' => false,
            'auto_refresh_fast_cache' => false
        );
        $this->cache = Zend_Cache::factory(
                        'Core', 'Two Levels', $zcache['frontendOpts'], $zcache['options']
        );
        //$this->cache->clean();
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
        //$this->firephp->log($key_cache);
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
            if(!($result=$this->cache->load($key_cache))){
                    $select = parent::select ();
                    $select->from ( $this->prefix.'post' )->where ( $field.'=?', $find );
                    $result=parent::fetchRow( $select );
                    $this->cache->save($result,$key_cache);
                    return $result;
            }else{
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
                $sql_search=sprintf("SELECT  `post_id`,`cate_key`,`post_topic`,`thumb_big`,`thumb_smll` 
                            FROM %s w WHERE EXISTS ( SELECT  1 FROM ( %s ) c  
                            WHERE   w.`slug` LIKE cond 
                            AND w.cate_key=%s 
                            AND w.post_id!=%s 
                            AND ban ='no' 
                            AND post_status='publish' ) 
                            ORDER BY post_id desc limit 5",
                            $this->prefix.'post',$sql_merg_relate,$cate_key,$post_id);
            }else{
                $sql_search=sprintf("SELECT  `post_id`,`cate_key`,`post_topic`,`thumb_big`,`thumb_small`
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
    
    function insert($data) {
        
        $pre_data[]=array();
        foreach ($data as $key => $value) {
            $pre_data[$key]=$value;        
        }
        
        $pre_data['post_date']=new Zend_Db_Expr('NOW()');
        $pre_data['table_reply']=$this->config->item('table_reply');
        $pre_data['table_modify']=$this->config->item('table_modify');
        
        try {
            parent::insert($this->prefix.'post', $pre_data);
            return TRUE;
        }catch(Exception $e) {
           // return($e->getMessage());
            return FALSE;
        }   
    }

    function check_uniq($filed, $str) {
        $select = parent::select();
        $select->from($this->prefix . 'post', array('count' => 'COUNT(*)'));
        $select->where($filed . '=?', $str);
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