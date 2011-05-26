<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                {if ($mode=="view")}
                    {foreach $metatag as $itemmeta1}
                            {foreach $itemmeta1 as $keymeta2=>$itemmeta2}
                                    {foreach $itemmeta2 as $keymeta3=>$itemmeta3}
                    <meta {$keymeta2}="{$keymeta3}" content="{$itemmeta3}" />
                              {/foreach}
                            {/foreach}		
                    {/foreach}
                {/if}  

	
<!-- CSS -->
		<link href="{$assets_path}css/blueprint/print.css" rel="stylesheet" type="text/css" />
                <link href="{$assets_path}css/blueprint/screen.css" rel="stylesheet" type="text/css" />
                <!--[if lt IE 8]><link rel="stylesheet" href="{$assets_path}css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
                <link href="{$assets_path}theme/{$theme}/css/style.css" rel="stylesheet" type="text/css" />	
                <link href="{$assets_path}theme/{$theme}/css/share-botton-css.css" rel="stylesheet" type="text/css" />	
<!-- END CSS --> 

	<title>{$post_topic}</title>
</head>
<body>
	<!--HEAD-->
		<div class="menu_top">
    <center>
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_02.jpg" width="67" height="26" />
    <a href="http://www.tlcthai.com/">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_03.jpg" width="39" height="26" border="0" /></a>
    <a href="http://www.tlcthai.com/sports/">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_04.jpg" width="90" height="26" border="0" /></a>
    <a href="http://www.tlcthai.com/webboard/list_parent_sportnew.php?table_id=1&amp;cate_id=39">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_05.jpg" width="67" height="26" /></a>
    <a href="http://www.tlcthai.com/webboard/list_topic.php?table_id=1&amp;cate_id=179">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_06.jpg" width="83" height="26" border="0" /></a>
    <a href="images/index-detail01-3_02.jpg?table_id=1&amp;cate_id=177">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_07.jpg" width="92" height="26" border="0" /></a>
    <a href="http://www.tlcthai.com/football/">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_08.jpg" width="89" height="26" /></a>
    <a href="http://www.tlcthai.com/sports/clip-vdo/">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_09.jpg" width="71" height="26"/></a>
    <a href="http://motorshow.tlcthai.com/">
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_10.jpg" width="88" height="26" /></a>
    <a href="http://www.tlcthai.com/sports/clip-vdo/"></a>
    <a href="http://www.tlcthai.com/sports/clip-vdo/"></a>
    <img src="{$assets_path}theme/{$theme}/images/index-detail01-3_12.jpg" width="438" height="26" />
    </center>
	</div>
    <!--HEAD-->
	<!--Content-->	