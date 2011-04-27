<?php
class Model_bad_word extends MY_Model {
	private $prefix;
	private $prefix_cache = "blockip_";

	//private $cache;
	
	function __construct() {
		parent::__construct ();
		require(APPPATH . 'config/zend_cache.php');
		$this->load->library('firephp');
		$this->load->library('Zend');
        $this->zend->load('Zend/Cache');
        
		//$this->prefix=$this->config->item('table_prefix');
		//$this->prefix_cache=$this->prefix.$this->prefix_cache;
		$zcache=$zend_cache;
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
            'Core',
            'Two Levels',
        	$zcache['frontendOpts'],
            $zcache['options']
        );
        //$this->cache->clean();
	}
	
	function fetchAll() {
		$key_cache=$this->prefix_cache."all";
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();
			$select->from ( 'bad_word' )->order ( 'id DESC' );
			$result=parent::fetchAll ( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			return $result;
		}
	}
}