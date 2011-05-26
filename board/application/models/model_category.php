<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_category extends MY_Model {
	private $prefix;
	private $prefix_cache = "cate_";
	public $cid;
	//private $cache;
	
	function __construct() {
            require(APPPATH . 'config/zend_cache.php');
		parent::__construct ();
		
		$this->load->library('firephp');
	//	$this->load->library('Zend');
        //$this->zend->load('Zend/Cache');
        
       // $this->zend->load('Zend/Db/Profiler');
       // $this->zend->load('Zend/Db/Profiler/Firebug');
       // $this->zend->load('Zend/Db/Profiler/Query');
        
		$this->prefix=$this->config->item('table_prefix');
		$this->prefix_cache=$this->prefix.$this->prefix_cache;
		$this->cache = Zend_Cache::factory(
            'Core',
            'Two Levels',
        	$zcache['frontendOpts'],
            $zcache['options']
        );
       // $this->cache->clean();
	}
	
	function fetchAll() {
		$key_cache=$this->prefix_cache."all";
		//$this->firephp->log($key_cache);
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();
			$select->from ( $this->prefix.'category' )->order ( 'cate_id DESC' );
			//$this->firephp->log("no cache");
			$result=parent::fetchAll ( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			//$this->firephp->log("cached");
			return $result;
		}
	}
	
	//$field is string key or id
	function fetch($find,$field="key") {
		$key_cache=$this->prefix_cache.$find;
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();
			$select->from ( $this->prefix.'category' )->where ( 'cate_'.$field.'=?', $find );
			$result=parent::fetchRow( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			return $result;
		}
	}
	
	function fetchmeta($find,$field="key") {
		$key_cache='meta'.$this->prefix_cache.$find;
		$this->cache->remove($key_cache);
		$this->cache->load($key_cache);
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();
			$select->from (array('c' =>$this->prefix.'category'),'c.cate_key')
					->join(array('cmeta' => $this->prefix.'catemeta'),'c.cate_id=cmeta.cate_id')
					->where ( 'cate_'.$field.'=?', $find );
			$result=parent::fetchAll( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			return $result;
		}
	}
	
	function fetch_each_parent($find=0) {
		$key_cache='cate_parent'.$this->prefix_cache.$find;
		$this->cache->load($key_cache);
		if(!($result=$this->cache->load($key_cache))){
			$select = parent::select ();	
			$select->from (array('c' =>$this->prefix.'category'),
						   	array('cate_id','cate_key','cate_name','cate_mode_post'))
					->where ( 'cate_parent=?', $find )
					->where ( 'cate_status!=\'ban\'' );
			//$this->firephp->log($select);
			$result=parent::fetchAll( $select );
			$this->cache->save($result,$key_cache);
			return $result;
		}else{
			return $result;
		}
	}
	
	function update($data, $id) {
		if (parent::update ( $this->prefix.'category', $data, 'cate_id=' . $id )) {
			parent::cacheRemove ( $this->prefix.'category' . $id );
		}
		return true;
	}
	
	function delete($id) {
		if (parent::delete ( 'category', 'cate_id=' . $id )) {
			parent::cacheRemove ( 'category' . $id );
		}
		return true;
	}
	
	function insert($data) {
		return parent::insert ( 'category', $data );
	}
}
?>
