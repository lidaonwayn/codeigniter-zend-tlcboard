<!--sidebar-->         
<div class="span-8 bg_white">

    <!--Advertise-->

    <div class="advertise">
        <div class="advertise_title">
            <img src="/asset/theme/default_th/images/index-detail01-3_51.jpg" alt="โฆษณา" />
        </div>
        <div class="advertise_img">
            <img src="/asset/theme/default_th/images/index-detail01-3_57.jpg" alt="โฆษณา" />
        </div>
    </div>


    <!--end advertise-->

    <!--clip news-->

    <div class="p_newsclip">
        <div class="p_newsclip_title">
            <h2><a href="/drama" title="คลิปเป็นข่าว" target="_blank">
                    &nbsp;&nbsp;&nbsp;คลิปเป็นข่าว
                </a>
            </h2>
        </div>

                    	 {foreach from=$array_clip_news  item=v name=foo}
        <div class="p_clip_smallbox">
            <div class="p_clip_smallshow">
                <a href="http://vdoclip.tlcthai.com/{$array_clip_news.ID}/{$array_clip_news.post_name}/" title="{$array_clip_news.post_title}" target="_blank">
                    <img src="/motorshow/wp-content/thumbnails/{$array_clip_news.ID}.jpg" alt="{$array_clip_news.post_title}" border="0" width="100" height="75" />
                </a>
            </div>
            <div class="p_clip_smalltext">
                <a href="http://vdoclip.tlcthai.com/{$array_clip_news.ID}/{$array_clip_news.post_name}/" title="{$array_clip_news.post_title}" target="_blank">
								{$array_clip_news.post_title}
                </a>
            </div>
        </div>
			{/foreach}					
        <div class="p_clip_nextlink">
            <a href="http://www.tlcthai.com/" title="คลิปเป็นข่าวทั้งหมด" target="_blank"> คลิปเป็นข่าวท้งหมด </a>
        </div>

    </div>

    <!--end clip news -->

    <!--Drama-->

    <div class="drama_box">
        <div class="p_drama">
            <div class="p_drama_left"></div>
            <div class="p_drama_middle">
                <div class="p_drama_title">
                    <h2><a target="_blank" title="ละครย้อนหลัง" href="/drama"> &nbsp;&nbsp;&nbsp;&nbsp;ละครย้อนหลัง</a></h2>
                </div>
                <div class="p_drama_bigshow">
                    <a href="{$array_sidebar_drama.0.url_bkin}" title="{$array_sidebar_drama.0.title_bkin}" target="_blank">
                        <img src="{$array_sidebar_drama.0.pic_bkin}" alt="{$array_sidebar_drama.0.title_bkin}" width="275" height="120" border="0" />
                    </a>
                </div>
                <div class="p_drama_bigtext">
                    <a href="{$array_sidebar_drama.0.url_bkin}" title="{$array_sidebar_drama.0.title_bkin}" target="_blank">{$array_sidebar_drama.0.title_bkin}</a>
                </div>
					   {foreach from=$array_sidebar_drama  item=v name=foo}
						{if $smarty.foreach.foo.index > 0}
                <div class="p_drama_smallbox">
                    <div class="p_drama_smallshow">
                        <a href="{$v.url_bkin}" title="{$v.title_bkin}" target="_blank"><img src="{$v.pic_bkin}" width="120" height="90" border="0" alt="{$v.title_bkin}" /></a>
                    </div>
                    <div class="p_drama_smalltext">
                        <a href="{$v.url_bkin}" title="{$v.title_bkin}" target="_blank">{$v.title_bkin}</a>
                    </div>
                </div>
						{/if}
					{/foreach}	
            </div>
        </div>


        <!-- end drama -->

        <!--TVonline-->

        <div class="p_tvonline_tvonline">
            <center>
                <a target="_blank" title="ดูทีวีออนไลน์" href="http://tv.tlcthai.com/">ดูทีวีออนไลน์</a>
				:
                <ul>
                    <li>
                        <a target="_blank" title="ดูทีสีช่อง3" href="http://tv.tlcthai.com/31/">
                            <img border="0" alt="ดูทีวีช่อง3" src="/asset/theme/default_th/images/logotv_3.jpg">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" title="ดูทีวีช่อง5" href="http://tv.tlcthai.com/93/">
                            <img border="0" alt="ดูทีวีช่อง5" src="/asset/theme/default_th/images/logotv_5.jpg">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" title="ดูทีวีช่อง9" href="http://tv.tlcthai.com/32/">
                            <img border="0" alt="ดูทีวีช่อง9" src="/asset/theme/default_th/images/logotv_mcot.jpg">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" title="ดูทีวีช่องNBT" href="http://tv.tlcthai.com/33/">
                            <img border="0" alt="ดูทีวีช่องNBT" src="/asset/theme/default_th/images/logotv_itv.jpg">
                        </a>
                    </li>
                </ul>
            </center>

        </div>
    </div>
    <!--end TV online -->


    <!--Interest-->

    <div class="p_interest">
        <div class="p_interest_title">
            <h2><a href="/drama" title="เรื่องน่าสนใจ" target="_blank"> &nbsp;&nbsp;&nbsp;เรื่องน่าสนใจ </a></h2>
        </div>
        <div class="p_interest_in1">
            <div class="interest_img">
                <img src="/asset/theme/default_th/images/index-detail01-3_121.jpg" alt="เรื่องน่าสนใจ" />
            </div>
            <div class="textbox_in1">
                <h6>รอยเลื่อนทั้งหมดในประเทศไทย</h6>
                <p>รอยเลื่อนหรือรอยแตกในเปลือกโลก เป็นแหล่งกำเนิดของแผ่นดินไหว ปริญญา ยุตาลับ (2533)</p>
            </div>
        </div>

        <div class="list_int">
            <ul>
                <li><a href="/drama" target="_blank"> งานกาชาดประจำปี 2554</a></li>
                <li><a href="/drama" target="_blank">ขอเคารพชาวญี่ปุ่น ในเรื่องน้ำใจ และระเบียบวินัยให้กัน</a></li>
                <li><a href="/drama" target="_blank">อดีตเหตุการณ์ เซอร์โนเบิล โรงไฟฟ้านิวเคลียร์ระเบิดเมื่อ 20 กว่าปีก่อน</a></li>
                <li><a href="/drama" target="_blank"> งานกาชาดประจำปี 2554</a></li>
                <li><a href="/drama" target="_blank">อดีตเหตุการณ์ เซอร์โนเบิล โรงไฟฟ้านิวเคลียร์ระเบิดเมื่อ 20 กว่าปีก่อน</a></li>
            </ul>
        </div>

        <div class="list_textLink">
            <a href="http://www.tlcthai.com/" title="อ่านเรื่องน่าสนใจทั้งหมด" target="_blank">อ่านเรื่องน่าสนใจทั้งหมด</a>
        </div>

    </div>

    <!--end interest-->

    <!--Gold-->
    <div class="span-8 last">

        <div class="p_goldPrice1">
            <div class="gold_img">
                <a href="http://newspaper.tlcthai.com/more.php?feedrss=http://twitter.com/statuses/user_timeline/154457514.rss&headline=%E0%B8%A3%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%97%E0%B8%AD%E0%B8%87%E0%B8%84%E0%B8%B3&from=http://twitter.com/statuses/user_timeline/154457514.rss&fromimg=gold&color=blue"><img src="/asset/theme/default_th/images/logo_gold.jpg" width="42" height="42" alt="ราคาทองคำ" title="ราคาทองคำ"/></a>
            </div>
            <div class="gold_text2">
                <a href="http://newspaper.tlcthai.com/more.php?feedrss=http://twitter.com/statuses/user_timeline/154457514.rss&headline=%E0%B8%A3%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%97%E0%B8%AD%E0%B8%87%E0%B8%84%E0%B8%B3&from=http://twitter.com/statuses/user_timeline/154457514.rss&fromimg=gold&color=blue" title="ราคาทองคำ"><h2>ราคาทองคำ</h2></a>
            </div>
            <div class="next"><a href="http://newspaper.tlcthai.com/more.php?feedrss=http://twitter.com/statuses/user_timeline/154457514.rss&headline=%E0%B8%A3%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%97%E0%B8%AD%E0%B8%87%E0%B8%84%E0%B8%B3&from=http://twitter.com/statuses/user_timeline/154457514.rss&fromimg=gold&color=blue" title="ราคาทองคำ"><img src="/asset/theme/default_th/images/index-detail01-3_131.jpg" width="42" height="12" alt="ราคาทองคำ" title="ราคาทองคำ"/></a></div>            
        </div>
        <div class="p_goldPrice2">
            <div class="gold_img">
                <a href="http://twitter.com/#!/ThaiGoldPrice/statuses/63428736925704192"><img src="/asset/theme/default_th/images/index-detail01-3_139.jpg" width="42" height="42"  alt="ราคาทองคำ" title="ราคาทองคำ"/></a>
            </div>
            <div class="gold_text">
                <p><a href="http://twitter.com/#!/ThaiGoldPrice/statuses/63428736925704192">ทองคำแท่ง ( No change )<br /> ซื้อ 20450 / ขาย 20550</a></p>
            </div>
        </div>
    </div>


    <!--edn-->

    <!-- Facebook Fan page -->
    <div class="facebook">
        <a target="_blank" href="http://www.facebook.com/koreatlc">
            <img height="26" border="0" width="100" src="http://music.tlcthai.com/images/fb_header_01.jpg"><img height="26" border="0" width="115" src="http://music.tlcthai.com/images/fb_header_02.jpg" /><img height="26" border="0" width="80" alt="Facebook ทีแอลซีเกาหลี" src="http://music.tlcthai.com/images/fb_header_03.jpg" /><a target="_blank" href="http://twitter.com/tlcthaidotcom"></a>
            <iframe frameborder="0" scrolling="no" allowtransparency="false" style="border:none; overflow:hidden; width:295px; height:300px; background-color:#ffffff" src="http://www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/tlcfanclub&width=295&connections=10&stream=false&header=false&height=280">

            </iframe>
    </div>
</div>
<!--end-->
<div class="span-24 last">
    <div class="hitz">
        <ul>
            <li><strong>คำค้นยอดฮิต :</strong>&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> ecard</a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> facebook</a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> ภาพพื้นหลัง</a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> ดาราเกาหลี</a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> รูปการ์ตูน </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> โค้ดเมาส์ </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> scribble </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> webband </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> twitter </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> imeem </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> blackberry </a></li>
            <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
            <li><a href="/drama" target="_blank"> เกมส์ </a></li>
        </ul>
    </div>
</div>
</div> 

