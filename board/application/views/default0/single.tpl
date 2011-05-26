{* include file="webboard/theme/default/cate/default_header.tpl" *}
{include file="`$theme`/header.tpl"}	
<div class="container">

    <!--Logo-->
    <div class="span-24 last bg_none">
        <div class="head_logo">
            <img src="{$assets_path}theme/{$theme}/images/tlc_logo_8.gif" alt=""  />
        </div>
        <div class="head_banner">
            <img src="{$assets_path}theme/{$theme}/images/banner.jpg" alt=""  />
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
            <a href="http://www.tlcthai.com" target="_blank">หน้าแรก </a> > {$cate_name}
        </div>
        <!--end menu-->

        <!---news-->
        <div class="span-16 last bg_white">
            <div class="head_p2">
                <div class="head_p2_news">
                    <p>{$post_topic}</p>
                </div>

            </div>

            <div class="span-16">
                <div class="news2">
                    <div class="news2_img">
                           {$post_detail}
                    </div>
                    <div class="last_news2">
                       {if ($mode=="view")} โพสเมื่อ - {$post_date}{/if} โพสต์โดย : {$post_name}
                    </div>
                    <div class="tag">
                        <h4>ป้ายคำค้น :
                        {foreach $post_tag as $value}
                            {if $value==""}
                                ไม่มี
                            {/if}
                            <a href="{$base_url}tag/{$value}">{$value}</a>
                        {/foreach}
                        </h4>
                    </div>

                </div>
            </div>
            <div class="advertise2">
                ADVERTISING AREA
            </div>
{if ($mode=="view")}
            <div class="face_comment">
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tlcthai.com%2Fwebboard%2Fview_topic.php%3Ftable_id%3D1%26cate_id%3D201%26post_id%3D114558&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:30px;" allowTransparency="true"></iframe>
                <br /><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=APP_ID&amp;xfbml=1"></script><fb:comments href="www.tlcthai.com" num_posts="1" width="500"></fb:comments>
            </div>

            <!--end news-->

            <!--comment-->
            <div class="comment" id="div_form_reply">
                <h2><strong>Leave a Reply</strong></h2>
		<form  name="form_reply" id="form_reply" action="/board/action_reply/save.html">
                    <input type="hidden" name="post_id" id="post_id" value="{$post_id}" />
                    <input type="hidden" name="ip" id="ip" value="{$ip}" />
                    <p>
                        <input id="reply_name" type="text" tabindex="1" size="35" value="" name="reply_name" />
                        <label for="reply_name"><small>Name (required) </small></label>
                    </p>
                    <p>
                        <input id="reply_email" type="text" tabindex="1" size="35" value="" name="reply_email" />
                        <small>Mail </small>
                    </p>
                    <p>
                        <input id="reply_email" type="text" tabindex="1" size="35" value="" name="reply_email" /></label>
                        <label for="website">
                                <small>Website</small>
                        </label>
                    </p>
                    <p>
                        <label for="reply_detail">You can't use this HTML tags</label>
                        <br />
                        <textarea id="reply_detail" tabindex="4" rows="10" cols="100%" name="reply_detail"></textarea>
                    </p>
                    <p>
                         {foreach $smileys_array as $item}
                         {$item}
                         {/foreach}
                    </p>
                    <p>
			<strong>คำถาม</strong>
			{$antibot_txt} ได้เท่าไหร่ กรอกตัวเลขลงในช่องนี้
			<input id="antibot" type="text" maxlength="5" size="5" name="post_antibot" />
			<br />
			<input type="image" src="{$assets_path}theme/{$theme}/images/submit_comment.png" alt="Submit" width="144" height="36" />
                    </p>
                    
                </form>
            </div>

            <!--End Comment-->

 <!--reply-->
           <div class="webboard_comment_form">
       {$page_nav}
	 {foreach $comment as $vc}

		<div class="webboard__detail">
		<!-- delete comment -->
			<div class="detail_c">
				<div class="detail_comment">
                                        <a name=comment"comment-{$vc.reply_id}"></a>
					<b> ความคิดเห็นที่ {$count_reply-$page_current-($vc@index)} </b> 
				</div>
			</div>
			<!--Replay -->
			<br />
			<div class="re">
				Re: {$post_topic}
			</div>
			<!--Replay -->
			<div class="detail_comment_head">
				
                                <a id="vote-{$vc.reply_id}" class="reply-ajax" name="vote-{$vc.reply_id}">
					ชอบ
				</a>
                            &nbsp;
                                <a id="devote-{$vc.reply_id}" class="reply-ajax" name="devote-{$vc.reply_id}">
					ไม่ชอบ
				</a>
				&nbsp;
				<a id="ban-{$vc.reply_id}" class="reply-ajax" name="ban-{$vc.reply_id}">
					แจ้งลบ
				</a>
			</div>
			<br clear="all" />
			<!-- delete comment -->
			<div class="detail_comment_box">
				<div class="detail_comment">
					{$vc.reply_detail}
				</div>
			</div>
			<div class="detail_comment_user detail_comment_user_last">
				<b>  โดย   :  </b>  {$vc.name}	<b> วันที่ </b> :   {$vc.reply_date}  <br />
			</div> <!-- end detail comment-->

	</div>
	{/foreach}
       {$page_nav}
               </div>
<!--End reply-->
{/if}
        </div>


        <!--end news-->
 {include file="`$theme`/sidebar.tpl"}

 {include file="`$theme`/footer.tpl"}

