<?php if( ! defined('BASEPATH')) exit('No direct script access allowed!');

require_once(APPPATH.'libraries/facebook.php');

/**
 * Simple facebook integration library
 *
 * @author einstein2@hotmail.com
 */

class Fb_connect extends Facebook
{
    function construct($config)
    {
        parent::__construct($config);
    }
}
