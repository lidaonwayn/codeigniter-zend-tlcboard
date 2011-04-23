<?php
class Zendcache extends MY_Controller {
	public $cache;
	public $prefix;
	
	function __construct()
  	{
  		require(APPPATH . 'config/zend_cache.php');
    	parent::__construct();
    	$this->load->library('firephp');
			
    	$options = array( 
        			'slow_backend' => 'Apc', 
        			'fast_backend' => 'Memcached', 
        			'slow_backend_options' => array(), 
        			'fast_backend_options' => $zend_cache['fastbackendOpts'], 
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
        	$zend_cache['frontendOpts'],
            $options
        );
  	}
  	
  	
  	function save($key)
  	{
  		$this->cache->load($this->key);
  	}
        
	
}
