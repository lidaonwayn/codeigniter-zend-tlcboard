<?php 
class Model_post extends MY_Model {
	private $prefix;
	private $prefix_cache = "post_";
	public $cid;

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
	
	//$config is array
	// order,sort,page,limit
	function fetchAll($config=array()) {
		
		//assign variable
		if(isset($config['order'])) $field_order=$config['order'];
		else $field_order='post_id';
		if(isset($config['sort'])&& (strtoupper($config['sort'])=="ASC" or strtoupper($config['sort'])=="DESC")) $sort=$config['sort'];	
		else $sort='ASC';
		if(isset($config['limit'])) $limit=$config['limit'];
		else $limit=null;
		if(isset($config['page'])) $page=$config['page'];
		else $page=null;
	
		if(empty($id))$key_shuffix="all";
		else $key_shuffix=$id;
		
		$key_cache=$this->prefix_cache.$key_shuffix;
		//$this->firephp->log($key_cache);
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();
			$select->from ( $this->prefix.'post' )->order ( 'post_id DESC' );
			if(!empty($limit)&&!empty($page))	$select-->limitpage($page, $limit);			
			//$this->firephp->log("no cache");
			$result=parent::fetchAll ( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			//$this->firephp->log("cached");
			return $result;
		}
	}
	
	function insert($data) {
		$pre_ex=array(
			'cate_id' =>  $data['cate_id'],
			
		);
		return parent::insert ( 'post_board', $data );
	}
	
	
	function check_uniq($filed,$str) {
		$select = parent::select ();
		$select->from($this->prefix.'post',array('post_id', 'COUNT(*)'));
		$select->where($filed.'=?',$str);	
		if(parent::fetch ( $select ) > 0) return FALSE;
		else return TRUE;
	}
	
	
}
?>