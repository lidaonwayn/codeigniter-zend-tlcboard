<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Model_category extends MY_Model {
	private $prefix;
	function __construct() {
		parent::__construct ();
		$this->prefix=$this->config->item('table_prefix');
	}
	
	function fetchAll() {
		$select = parent::select ();
		$select->from ( 'category' )->order ( 'cate_id DESC' );
		return parent::fetchAll ( $select );
	}
	
	function fetch($id) {
		// if ($row = parent::cacheLoad('category'.$id))
		// {
		$select = parent::select ();
		$select->from ( $this->prefix.'category' )->where ( 'cate_id=?', $id );
		return parent::fetchRow ( $select );
	
	// }
	}
	
	function fetchmeta($id) {
		// if ($row = parent::cacheLoad($this->prefix.'category'.$id))
		// {
		$select = parent::select ();
		$select->from (array() $this->prefix.'category' )
		->where ( 'cate_id=?', $id );
		return parent::fetchRow ( $select );
	
	// }
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
