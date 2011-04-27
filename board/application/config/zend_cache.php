<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$zend_cache= array(		
				'frontendOpts' => array(
								'caching' => true, 
								'lifetime' => 1800, 
								'automatic_serialization' => true 
								),
				'fastbackendOpts' => array(
								'servers' => array (
									'host' => '127.0.0.1', 
									'port' => 11211  
									), 
								'compression' => true 								
				),
				'slowbackendOpts' => array()
);
