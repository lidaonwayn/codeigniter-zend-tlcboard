<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_member extends MY_Model {
    private $prefix;
    private $prefix_cache = "member_";
    public  $id;
    private $cache;
    private $cache_id;
    private $table_member;

    function __construct() {
        require(APPPATH . 'config/zend_cache.php');
        parent::__construct();
        $this->load->library('firephp');
        $this->cache = Zend_Cache::factory(
                        'Core', 'Two Levels', $zcache['frontendOpts'], $zcache['options']
        );
        
        $this->cache->clean();
    }
    
    private function gen_cacheid($id){
        $this->load->helper('string');
        $cache_id=$this->prefix_cache.$id;
        if (($gen_id = $this->cache->load($cache_id))=== false ) {
            $gen_id=random_string('unique');
            //$this->firephp->log($gen_id);
            $this->cache->save($gen_id, $cache_id);    
            return $gen_id;
        }else {
            return $gen_id;
        }          
    }
    
    private function del_cacheid($id){
        $gen_id=$this->gen_cacheid($id);
        $this->cache->remove($this->cache_id);       
    }


    function fetch($id){
        $this->cache_id=$this->gen_cacheid($id);
       $key_cache=$this->cache_id;
       // $this->firephp->log("post = ".$result=$this->cache->load($key_cache));
        if(!($result=$this->cache->load($key_cache))){
           // $this->firephp->log("no cache");
        
        $this->table_member=$this->config->item('table_member');
                $select = parent::select ();
                $select->from ( array('m'=>$this->table_member), 
                                array('user_id', 
                                    'user_firstname',
                                    'user_lastname',
                                    'user_login',
                                    'role_name',
                                    'fb_id'))
                        ->where ( 'user_id=?', $id );
                $result=parent::fetchRow( $select );
                $this->cache->save($result,$key_cache);
                return $result;
        }else{
                return $result;
        }
    }
}
?>
