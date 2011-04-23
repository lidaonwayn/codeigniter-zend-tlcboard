<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Newtopic extends CI_Controller {

       function __construct()
       {
            parent::__construct();
            $this->load->library('firephp');
       }

       function show()
       {
           $this->parser->parse("test/facebook_connect.tpl", $data);
           parse_str($_SERVER['QUERY_STRING'],$_GET);
           $this->firephp->log($this->uri->segment(1));
           $this->firephp->log($_GET);
       }
}
?>
