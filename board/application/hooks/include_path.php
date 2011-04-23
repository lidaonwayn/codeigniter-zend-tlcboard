<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function set_custom_include_path()
{
    
    ini_set('include_path',ini_get('include_path').';'.FCPATH.APPPATH.'third_party');
}
?>
