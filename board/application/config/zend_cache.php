<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$zcache= array(		
				'frontendOpts' => array(
								'caching' => true,
								'lifetime' => 7200, 
								'automatic_serialization' => true 
								),
				'fastbackendOpts' => array(
								'servers' => array (
									'host' => '127.0.0.1', 
									'port' => 11211  
									), 
								'compression' => true 								
				),
				'slowbackendOpts' => array('cache_db_complete_path' => 'C:\ms4w\apps\tlcthai\board\system\cache\sqllite\cachedb.db'
                                )
);

$zcache['options'] = array(
            'slow_backend' => 'Sqlite',
            'fast_backend' => 'Memcached',
            'slow_backend_options' => $zcache['slowbackendOpts'],
            'fast_backend_options' => $zcache['fastbackendOpts'],
            'stats_update_factor' => 10,
            'slow_backend_custom_naming' => TRUE,
            'fast_backend_custom_naming' => TRUE,
            'slow_backend_autoload' => TRUE,
            'fast_backend_autoload' => TRUE,
            'auto_refresh_fast_cache' => TRUE
        );
