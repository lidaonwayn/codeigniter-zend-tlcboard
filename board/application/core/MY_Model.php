<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $parent_name = null;
    public $tbname = null;
    private $_hasLoadConstructor = false;
    private static $_conn = null;

    //display logs
    public $channel =null;
    public $response =null;
    public $request =null;
    //display logs
    
    public function __construct() {

        parent::__construct();
        require(APPPATH . 'config/zend_cache.php');
        $this->load->library('Zend');
        $this->zend->load('Zend/Db');
        $this->zend->load('Zend/Db/Expr');
        
        $this->zend->load('Zend/Db/Profiler');
        $this->zend->load('Zend/Db/Profiler/Firebug'); 
        
        $this->zend->load('Zend/Cache');
        
        $this->parent_name = strtolower(get_class($this));

        log_message('debug', "Model intregate Zend Class Initialized");
    }
    
    public function connect($profile=null) {
        require(APPPATH . 'config/database.php');
        if (is_null($profile)) {
            $profile = $active_group;
        }

        $dbConf = $db[$profile];

        $params = array(
            'host' => $dbConf['hostname'],
            'username' => $dbConf['username'],
            'password' => $dbConf['password'],
            'dbname' => $dbConf['database'],
        	'profiler' => array(
		            'enabled' => true,
		            'class' => 'Zend_Db_Profiler_Firebug'
		            )
        );

        $conn = Zend_Db::factory($dbConf['dbdriver'], $params);
        		
        if ($dbConf['char_set'] && $dbConf['dbcollat']) {
            $conn->Query('SET character_set_results=' . $dbConf['char_set']);
            $conn->Query('SET collation_connection=' . $dbConf['dbcollat']);
            $conn->Query('SET NAMES ' . $dbConf['char_set']);
        }      	
        self::$_conn = $conn;
    }

    public function query($string) {
        $this->connect('slave');
        return self::$_conn->Query($string);
    }
    
    public function qoute($string) {
        $this->connect('slave');
        return self::$_conn->quoteIdentifier($string);
    }

    public function select() {
        $this->connect('slave');
        return self::$_conn->select();
    }

    public function fetchObject($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchObject($sql, $attrs);
    }

    public function fetchAll($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchAll($sql, $attrs);
    }

    public function fetchRow($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchRow($sql, $attrs);
    }

    public function fetchOne($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchOne($sql, $attrs);
    }

    public function fetchCol($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchCol($sql, $attrs);
    }

    public function fetchPair($sql, $attrs=null) {
        $this->connect('slave');
        return self::$_conn->fetchPair($sql, $attrs);
    }

    public function insert($table, $data) {
        $this->connect('master');
        if (self::$_conn->insert($table, $data)) {
            return self::$_conn->lastInsertId();
        }
        return false;
    }

    public function update($table, $data, $where) {
        $this->connect('master');
        return self::$_conn->update($table, $data, $where);
    }

    public function delete($table, $where) {
        $this->connect('master');
        return self::$_conn->delete($table, $where);
    }

    public function expr($string) {
        return new Zend_Db_Expr($string);
    }



}

?>
