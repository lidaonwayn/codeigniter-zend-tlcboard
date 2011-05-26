<?php

class Model_reply extends MY_Model {

    private $prefix;
    private $prefix_cache = "reply_";
    public $cid;

    //private $cache;

    function __construct() {
        require(APPPATH . 'config/zend_cache.php');
        parent::__construct();
        $this->load->library('firephp');

        $this->prefix=$this->config->item('table_prefix');

        $this->cache = Zend_Cache::factory(
                        'Core', 'Two Levels', $zcache['frontendOpts'], $zcache['options']
        );
        $this->cache->clean();
    }
    
    function fetchpage($post_id,$table_reply,$page=0,$limit=20) {
        $key_cache = $this->prefix_cache ."_".$post_id."_fetchpage_".$page."_".$limit;
       // $this->firephp->log('load cache = '.$this->cache->load($key_cache));
        if (($result = $this->cache->load($key_cache))=== false ) {
            $select = parent::select()
                ->from(array('r' => $this->config->item('table_prefix').$table_reply)) 
                ->where("post_id=?",$post_id)
                ->order(array('reply_date DESC','reply_id DESC'))
                ->limit($limit,$page); 
            $result = parent::fetchAll($select);
            $this->cache->save($result, $key_cache);
        //    $this->firephp->log("reply fetchpage ".$key_cache);
            return $result;
        }else {
          //  $this->firephp->log("cache reply fetchpage ".$key_cache);
            return $result;
        }     
    }  
    
    function fetchall($post_id,$table_reply) {
        $key_cache = $this->prefix_cache . $key_shuffix;
        
    } 
    
    function count($find,$table_reply,$field="post_id") {
        $key_cache = $this->prefix_cache ."count".$field."_".$find;
        if (!($result = $this->cache->load($key_cache))) {
            $select = parent::select()
                    ->from(array('r' => $this->config->item('table_prefix').$table_reply),array('count' => 'COUNT(*)')) 
                    ->where('r.'.$field.'=?',$find);
            $result = parent::fetchOne($select);
            return $result;
       }else {
            //$this->firephp->log("cached");
            return $result;
        } 
    } 

    function insert($data,$table_reply) {    
        foreach ($data as $key => $value) {
            if(is_numeric($key)) {
               continue; 
            }
            $pre_data[$key]=$value;
        }      
        $pre_data['reply_date']=new Zend_Db_Expr('NOW()');
        
       // var_dump($pre_data);      
        try {
            parent::insert($table_reply, $pre_data);
            return TRUE;
        }catch(Exception $e) {
            return FALSE;
        }   
    }
    
    function vote_increase($id,$tablename){
        $key_cache = $this->prefix_cache ."vote_".$tablename."_".$id;
        $this->firephp->log($key_cache." = ".$this->cache->load($key_cache));
        if (!($vote = $this->cache->load($key_cache))) {
            $select = parent::select()
                    ->from(array('r' => $tablename),'vote')
                    ->where('r.reply_id=?',$id);
            $vote=parent::fetchOne($select);
        }
        $this->firephp->log("mod = ".$vote % 10);
        if(($vote % 10)==0){  
             $this->firephp->log("ใน if");
            $data=(array('vote'=> $vote));            
            $where=('reply_id='.$id);
            parent::update($tablename, $data,$where);
        }
             
             $vote++;
             $this->cache->save($vote,$key_cache);
             return $vote;
    }
    
    function vote_decrease($id,$tablename){
        $key_cache = $this->prefix_cache ."vote_".$tablename."_".$id;
        if (!($vote = $this->cache->load($key_cache))) {
            $select = parent::select()
                    ->from(array('r' => $tablename),'vote')
                    ->where('r.reply_id=?',$id);
            $vote=parent::fetchOne($select);
        }
        if(($vote % 10)==0){
            $data=(array('vote'=> $vote));            
            $where=('reply_id='.$id);
            parent::update($tablename, $data,$where);
        }
         $vote--;
         $this->cache->save($vote,$key_cache);
         return $vote;
    }
    
        function report_ban($id,$tablename){
            $key_cache = $this->prefix_cache ."ban_".$tablename."_".$id;
            if (!($ban = $this->cache->load($key_cache))) {
                $select = parent::select()
                        ->from(array('r' => $tablename),'ban')
                        ->where('r.reply_id=?',$id);
                $ban=parent::fetchOne($select);
            }
            if(($ban % 10)==0){
                $data=(array('ban'=> $ban));            
                $where=('reply_id='.$id);
                parent::update($tablename, $data,$where);
            }
             $ban--;
             $this->cache->save($ban,$key_cache);
             return $ban;
        }
}
