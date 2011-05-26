{include file="webboard/theme/default/test/default_header.tpl"}
	
	<div class="container">
    	
        <!--Logo-->
		<div class="span-24 last bg_none">
        	<div class="head_logo">
            <img src="/board/asset/theme/default_th/images/tlc_logo_8.gif" alt=""  />
          </div>
            <div class="head_banner">
            <img src="/board/asset/theme/default_th/images/banner.jpg" alt=""  />
            </div>
        </div>  
    	<!--end Logo-->  
            
		<!--Menu-->
        
        	<div class="span-24">
            	<div class="menu_f">
                    <a target="_blank" href="http://truehits.net/stat.php?login=tlcthai">
					<img height="17" border="0" width="14"  alt="Thailand Web Stat" src="http://lvs.truehits.in.th/goggen.php?hc=q0027679&bv=0&rf=bookmark&test=TEST&web=pDoY%2bQBRjvpbUJ44eMSNkQ%3D%3D&bn=Netscape&ss=1366*768&sc=24&sv=1.3&ck=y&ja=y&vt=C4C96814.31&fp=&fv=10.2 r152&truehitspage=Sport&truehitsurl=http%3a//www.tlcthai.com/sports/">
					</a>
                </div>
   	    	  		<div class="menu">                	
					<div class="menu1">
                    	<a href="http://www.tlcthai.com/" target="_new">ข่าวเด่น เรื่องด่วน</a>
                    </div>	
                    <div class="menu2">
                    	<a href="http://www.tlcthai.com/" target="_new">เรื่องน่าสนใจ</a>
                    </div>
                    <div class="menu3">
                    	<a href="http://www.tlcthai.com/entertainment/" target="_new">ข่าวบันเทิงไทย</a>
                    </div>
                    <div class="menu4">
                    	<a href="http://korea.tlcthai.com/" target="_new">ข่าวบันเทิงเกาหลี</a>
                    </div>
                    <div class="menu5">
                    	<a href="http://www.tlcthai.com/sports/" target="_new">ข่าวกีฬา</a>
                    </div>
                    <div class="menu6">
                    	<a href="http://newspaper.tlcthai.com/" target="_new">ข่าวหนังสือพิมพ์</a>
                    </div>
                </div>    
                
            	<div class="s_box">
				<form method="post" action="">
					<div class="search">
						<div class="search_left"> ค้นหา </div>
							<div class="search_mid">
							<input type="text" style="border:none; width:164px; height:22px; padding:2px 2px; margin:0px;" value="ค้นหา">
							</div>
							<div class="search_right"> GO </div>
					</div>
		 	  	</form>
                </div>
   	  </div>
                
            
<div class="span-24 last bg_white">
    <div class="span-24 last menu_red">
    	<a href="http://www.tlcthai.com" target="_blank">หน้าแรก </a> > ข่าวด่วน     	  
    </div>
        <!--end menu-->
        
      	<!---news-->
	<div class="span-16 last bg_white">
			<div class="span-16">            	
                	<div class="bignews_img">
                	<img src="/board/asset/theme/default_th/images/index-detail01-3_51 (2).jpg"  alt="ข่าวเด่น"/>
                    </div>
                
                	<div class="bignews_text">
                	<h2>ญี่ปุ่น อุดรอยรั่ว เตาปฎิกรณ์ โรงไฟฟ้าฟูกูชิมะไม่สำเร็จ</h2>
                   	  <p>น้ำปนเปื้อนกัมมันตรังสียังไหลลงสู่มหาสมุทรแปซิฟิกต่อเนื่อง ขณะเทปโก้พบศพ 2 คนงานที่หายตัวไปแล้ว 4 เม.ย. รายงานข่าวจากสำนักข่าวต่างประเทศเปิดเผยว่า  เทปโก้พบรอยร้าวขนาด 20 เซนติเมตร ที่หลุมคอนกรีตของอาคารเตาปฏิกรณ์หมายเลข 2 ของโรงไฟฟ้านิวเคลียร์ฟูกูชิมะ หลุมดังกล่าวลึก 2 เมตรมีน้ำปนเปื้อนกัมมันตภาพรังสีที่วัดได้มากกว่า 1,000 มิลลิซิเวิร์ทส์ต่อชั่วโมง โดยมากกว่าปริมาณเฉลี่ยที่ปกติผู้ที่อาศัย</p>
						                    	
                    	<p><a href="http://www.tlcthai.com/" target="_new">อ่านข่าวเพิ่มเติม</a></u></p>
                    </div>			        
			</div>
            
       	  <div class="span-16">
	    {foreach item=data from=$arr_list name=myfor3}
	  	<div class="news">
                    	<div class="news_img">
                        <img src="/board/asset/theme/default_th/images/index-detail01-3_70.jpg" alt="ข่าวเด่น" />
                        </div>
                        <div class="news_text">
                        	<a href="http://www.tlcthai.com/webboard/view_topic.php?table_id={$table_id}&amp;cate_id={$data.cate_id}&amp;post_id={$data.post_id}" title="{$data.post_topic}" target="_blank">
				{$data.post_topic}
				</a>
                        	<p> ฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟ
                            ฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟฟ</p>
                        </div>
                        <div class="last_news">
                        	<a href="http://www.tlcthai.com/" target="_new">ข่าวเด่น เรื่องด่วน</a>
                             - {$data.post_date} โพสต์โดย : {$data.post_name}
			</div>
	  	</div>
		{/foreach}
                    
          </div>
	</div>				
	
    
    <!--end news-->
    
 {include file="webboard/theme/default/test/default_sidebar.tpl"}   

{include file="webboard/theme/default/test/default_footer.tpl"}
