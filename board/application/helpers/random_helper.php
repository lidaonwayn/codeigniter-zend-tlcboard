<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function random_char($len){
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		$ret_char = "";
		$num = strlen($chars);
		for($i = 0; $i < $len; $i++)	{
			$ret_char.= $chars[rand()%$num];
			$ret_char.=""; 
		}
		return $ret_char; 
}