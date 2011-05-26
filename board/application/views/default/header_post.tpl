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
		<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_02.jpg" width="67" height="26" border="0" alt="header" />
		<a href="http://www.tlcthai.com/" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_03.jpg" width="39" height="26" border="0" alt="header" />
		</a>
		<a href="http://www.tlcthai.com/sports/" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_04.jpg" width="90" height="26" border="0" alt="header" />
		</a>
		<a href="http://www.tlcthai.com/webboard/list_parent_sportnew.php?table_id=1&amp;cate_id=39" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_05.jpg" width="67" height="26" border="0" alt="header" />
		</a>
		<a href="http://www.tlcthai.com/webboard/list_topic.php?table_id=1&amp;cate_id=179" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_06.jpg" width="83" height="26" border="0" alt="header" />
		</a>
		<a href="images/index-detail01-3_02.jpg?table_id=1&amp;cate_id=177" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_07.jpg" width="92" height="26" border="0" alt="header" />
		</a>
		<a href="http://www.tlcthai.com/football/" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_08.jpg" width="89" height="26" border="0" alt="header" />
		</a>
		<a href="http://www.tlcthai.com/sports/clip-vdo/" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_09.jpg" width="71" height="26" border="0" alt="header" />
		</a>
		<a href="http://motorshow.tlcthai.com/" target="_blank">
			<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_10.jpg" width="88" height="26" border="0" alt="header" />
		</a>
		<img src="{$assets_path}theme/{$theme}/images/index-detail01-3_12.jpg" width="438" height="26" border="0" alt="header" />
	</center>
    </div>
<!--end HEAD-->   
        <!--Content-->		
<div class="container">
    	<!--Logo-->

   
        
        
        
	<div class="span-24 last bg_none">
		<div class="head_logo">
			<img src="{$assets_path}theme/{$theme}/images/tlc_logo_8.gif" border="0" alt="logo" />
                </div>
		<div class="head_banner">
			<img src="{$assets_path}theme/{$theme}/images/banner.jpg" border="0" alt="logo" />
                </div>
	</div>  
    <!--end Logo-->  


  <!--Menu-->
	<div class="span-24">
		<div class="menu_f">
			<iframe src="/truehitsstat.php?pagename=Toppage" width="14" height="17" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>
		</div>
		<div class="menu">    
			<div class="menu1">
				<a href="http://www.tlcthai.com/" target="_blank">ข่าวเด่น เรื่องด่วน</a>
                        </div>	
                        <div class="menu2">
                            <a href="http://www.tlcthai.com/" target="_blank">เรื่องน่าสนใจ</a>
                        </div>
                        <div class="menu3">
                            <a href="http://www.tlcthai.com/" target="_blank">ข่าวบันเทิงไทย</a>
                        </div>
                        <div class="menu4">
                            <a href="http://www.tlcthai.com/" target="_blank">ข่าวบันเทิงเกาหลี</a>
                        </div>
                        <div class="menu5">
                            <a href="http://www.tlcthai.com/" target="_blank">ข่าวกีฬา</a>
                        </div>
                        <div class="menu6">
                            <a href="http://www.tlcthai.com/" target="_blank">ข่าวหนังสือพิมพ์</a>
                        </div>
                </div>  
		<div class="s_box">
			<form method="post" action="">
				<div class="search">
					<div class="search_left">
						ค้นหา 
					</div>
					<div class="search_mid">
						<input type="text" style="border:none; width:164px; height:22px; padding:2px 2px; margin:0px;" value="ค้นหา" />
					</div>
					<div class="search_right"> 
						GO
					</div>
				</div>
			</form>
		</div>
	</div>	