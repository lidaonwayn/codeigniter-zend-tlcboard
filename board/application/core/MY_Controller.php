<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Bangkok');

class MY_Controller extends CI_Controller  {

  function __construct()
  {
    parent::__construct();
    $this->load->library('Zend');
    $this->zend->load('Zend/Registry');
    $this->zend->load('Zend/Locale');
    $this->zend->load('Zend/Cache');
    $this->zend->load('Zend/Date');
    $this->zend->load('Zend/Session');
  }
}

?>
