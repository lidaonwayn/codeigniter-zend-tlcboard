<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		{foreach $metatag as $itemmeta1}
			{foreach $itemmeta1 as $keymeta2=>$itemmeta2}
				{foreach $itemmeta2 as $keymeta3=>$itemmeta3}
		<meta {$keymeta2}="{$keymeta3}" content="{$itemmeta3}" />
			  {/foreach}
			{/foreach}		
		{/foreach}
	
<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/grid960/reset.css" />
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/grid960/text.css" />
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/jqueryui/jquery-ui-1.8.12.custom.css" />
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/grid960/960.css" /> 
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/jqvalidation/template.css" /> 
		<link rel="stylesheet" type="text/css" href="{$assets_path}css/jqvalidation/validationEngine.jquery.css" /> 
		<style type="text/css">
			div.button {
				height: 20px;	
				width: 128px;
				background: url({$assets_path}img/button.png) 0 0;
				font-size: 14px; color: #C7D92C; text-align: center; padding-top: 15px;
			}
			.tagEditor {
				margin: 4px 0;
				padding: 0;
			}
			.tagEditor li{
				display: inline;
				background-image: url({$assets_path}img/minus_small.png);
				background-color: #eef;
				background-position: right center;
				background-repeat: no-repeat;
				list-style-type: none;
				padding: 0 18px 0 6px;
				margin: 0 4px;	
				cursor: pointer;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
			}
			.tagEditor li:hover{
				background-color: #eee;
			}
			
		</style>
<!-- END CSS --> 
		<title>ทดสอบ</title>
	</head>
	<body>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	