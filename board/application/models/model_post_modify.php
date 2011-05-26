<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_post_modify extends MY_Model {

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
       // $this->cache->clean();
    }
    
    function insert($data,$table) {
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
        
        try{
            parent::insert($this->prefix.'post', $pre_data);
            return TRUE;
        }catch(Exception $e) {
           // return($e->getMessage());
            return FALSE;
        }   
    }
    
}
?>
