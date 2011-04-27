<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function compress()
{
$CI =& get_instance();
$buffer = $CI->output->get_output();
 
$options = array(
    'clean' => true,
    //'hide-comments' => true,
	'output-xhtml'   => true,
	//'indent-cdata'   => true,
	'indent-spaces'=> 4,
	'wrap' => 0,
	'clean' => true,
	//'new-inline-tags' => 'div,script',
    'indent' => true
    );
 
$buffer = tidy_parse_string($buffer, $options, 'utf8');
tidy_clean_repair($buffer);
// warning: if you generate XML, HTML Tidy will break it (by adding some HTML: doctype, head, body..) if not configured properly
 
$CI->output->set_output($buffer);
$CI->output->_display(); 
}