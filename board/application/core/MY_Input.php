<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MY_Input extends CI_Input {
 function _sanitize_globals()
 {
 $this->allow_get_array = TRUE;
 parent::_sanitize_globals();
 }
}
?>
