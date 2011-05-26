{include file="`$theme`/header_post.tpl"}

<div class="span-24 last bg_white">

	<div class="span-24 last menu_red">
    	<a href="http://www.tlcthai.com" target="_blank">หน้าแรก </a> > ข่าวด่วน     	  
        </div>
 <!---news-->
<div class="span-16 last bg_white">
	<div class="head_p2">
		<div class="head_p2_news">
			<p>{$post_topic}</p>
   
		</div>
		<div class="head_facebook_like">
			<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tlcthai.com%2Fwebboard%2Fview_topic.php%3Ftable_id%3D1%26cate_id%3D201%26post_id%3D114558&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;font&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" ></iframe> 
                
                </div>  
	</div>	
    <div class="span-16">
		<div class="news2">
			{$post_detail}
			<div class="last_news2">
				<a href={$base_url}/view/{$post_id}/{$slug}.html  >{$post_topic}  </a>
				{$post_date} โพสต์โดย : {$post_name}
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
		ADVERTISING AREA <br />
                 ลิงค์ที่มีเนื้อหาใกล้เคียง <br /> 
        {foreach $relate_slug as $value_slug}
            <a href={$base_url}/view/{$value_slug.post_id}/{$value_slug.slug}  >{$value_slug.post_topic}  </a><br />
        {/foreach}
	</div>
    {*<div >
        ลิงค์ที่มีเนื้อหาใกล้เคียง <br /> 
        {foreach $relate_slug as $value_slug}
            <a href={$base_url}/view/{$value_slug.post_id}/{$value_slug.slug}  >{$value_slug.post_topic}  </a><br />
        {/foreach}
            </div>
*}
	<div class="face_comment">
		<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tlcthai.com%2Fwebboard%2Fview_topic.php%3Ftable_id%3D1%26cate_id%3D201%26post_id%3D114558&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:30px;" ></iframe>
		<br />
		<div id="fb-root"></div>
		<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#appId=APP_ID&amp;xfbml=1"></script>
		<fb:comments href="www.tlcthai.com" num_posts="1" width="500"></fb:comments>
	</div>      
   <!-- end news -->

   	<!--comment-->
	<div class="comment" id="div_form_reply">
		<h2><strong>Leave a Reply</strong></h2>
		<form  name="form_reply" id="form_reply" action="/board/action_reply/save.html">
                    <input type="hidden" name="post_id" id="post_id" value="{$post_id}" />
                    <input type="hidden" name="ip" id="ip" value="{$ip}" />
                    <p>
                        <label for="dummy0">
                            <input id="reply_name" type="text" tabindex="1" size="35" value="" name="reply_name" />
                        </label>
                        <label for="reply_name"><small>Name (required) </small></label>
                    </p>
                    <p>
                        <label for="dummy0"><input id="reply_email" type="text" tabindex="1" size="35" value="" name="reply_email" />
                                <small>Mail </small>
                        </label>
                    </p>
                    <p>
                        <label for="dummy0"><input id="website" type="text" tabindex="1" size="35" value="" name="website" /></label>
                        <label for="website">
                                <small>Website</small>
                        </label>
                    </p>
                    <p>
                        <label for="dummy2">You can't use this HTML tags</label>
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

		<div class="webboard_comment_detail">							     
		<!-- delete comment -->
			<div class="detail_c">
				<div class="detail_comment">  
					<b> ความคิดเห็นที่ {($vc@index+1)+$page_current} </b> <a name="data2"></a> 
				</div>
			</div>
			<!--Replay -->
			<br /> 
			<div class="re">
				Re: {$post_topic} 
			</div>
			<!--Replay -->
			<div class="detail_comment_head">
				<a href="{$base_url}/action_reply/like/{$vc.reply_id}"> 
					ชอบ
				</a>
                            &nbsp;
                                <a href="{$base_url}/action_reply/unlike/{$vc.reply_id}"> 
					ไม่ชอบ
				</a>
				&nbsp;
				<a href="{$base_url}/action_reply/report/{$vc.reply_id}"> 
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
   
{include file="`$theme`/footer_post.tpl"}