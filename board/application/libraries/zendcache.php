<?php
class Zendcache {
	function __construct(){
		$this->load->library('Zend');
		$this->zend->load('Zend/Cache');
		
		self::$_conn = $conn;
	}
}

