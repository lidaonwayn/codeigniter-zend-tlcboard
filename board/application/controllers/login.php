<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class login extends MY_Controller {
    
    function __construct() {
            parent::__construct();
        }
        
    function index(){
        $this->load->library('parser');
        $this->parser->parse("login.tpl");
    }
    
}
?>
