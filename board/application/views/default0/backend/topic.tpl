 {include file="`$theme`/backend/header.tpl"}
 
<div class="container_16 clearfix" id='form_topic'>

	<form method="post"  id="form_post" id="form_post">
		<div class="grid_11 " >
			<fieldset>
				 <legend>หัวข้อ</legend>
					<div id="topicname" class="formrow">
					<label for="post_topic"><B>เรื่อง :</B></label>
					<input type="text" name="post_topic" id="post_topic" class="validate[required,minSize[6]] text-input" value="{if isset($post_topic)}{$post_topic}{/if}" />
					<br />
					</div>
					<label for="slug"><B>Slug :</B></label> 
					<input  name="slug" id="slug" value="{if isset($slug)}{$slug}{/if}" class="slug validate[required]" />
					<br />
			</fieldset>
			<fieldset  id="con_post">
				 <legend>เนื้อหา</legend>
				<div id='buttonupload' class="button" style="float:left;">Upload image</div><br/>
				<label >อัพโหลดได้ครั้งละ 5 รูปนะครับ</label>
				<textarea id="post_detail" name="post_detail" class="tinymce"  style="width: 100%; height: 400px; display: none;"  aria-hidden="true" >
                                       {if isset($post_detail)}{$post_detail}{/if}
                                </textarea><br/>
				<div id="buttonthumb" class="button">Upload thumb</div>
				<div id="showthumb" >
                                {if ($post_tmp == 1)}
                                    {if ($thumb_big != '')}
                                        <img src="{$thumb_big}" alt="" />120*90<br />
                                    {/if}
                                    {if ($thumb_small != '')}
                                        <img src="{$thumb_small}" alt="" />70*70<br /><br />
                                    {/if}
                                
                                    <br /><input type="checkbox" name="delthumb" id="delthumb" value="1" />
                                    <label for="delthumb">ต้องการลบรูป</label><br /><br />
                                {/if}
                                    
                                </div>
				<br />
				<label for="post_topic">ผู้โพสต์</label>
                                {if isset($session_post_name)}
				<input type="text" name="post_name" id="post_name" readonly="readonly"  value="{$session_post_name}" />
                                {elseif isset($post_name)}
				<input type="text" name="post_name" id="post_name" class="validate[required,minSize[3]] text-input" value="{$post_name}" />
                                {else}
                                <input type="text" name="post_name" id="post_name" class="validate[required,minSize[3]] text-input" value="" />
                                {/if}
				 ip address {$ip} <br />
				แสดงความคิดเห็น 
				<input type="radio" name="mode_comment" id="mode_comment" value="on" class="validate[required] radio" {if $mode_comment=='on'}checked="checked"{/if}/>อนุญาต
				<input type="radio" name="mode_comment" id="mode_comment" value="off" class="validate[required] radio" {if $mode_comment=='off'}checked="checked"{/if} />ไม่อนุญาต
			</fieldset>


		</div>
		<div class="grid_5" >
			<div class="grid_5 clearfix" >
				  <fieldset>
					  <legend>Category</legend>
					   
					    {foreach $cparent as $arr_cparent}
					 <input type="radio" name="category" id="category" value="{$arr_cparent.cate_key}" class="validate[required] radio" {if $cate_key==$arr_cparent.cate_key}checked="checked"{/if} />{$arr_cparent.cate_name}
					    {/foreach}
					    
				</fieldset>
				 <fieldset>
					  <legend>Tag ป้ายชื่อคำค้น</legend>
					    <label>
					  <input  id="post_tag" name="post_tag" type="text" size="30" maxlength="100" />
		 	<div id='tag_count'></div><a id="resetTagsButton">ล้าง tag ทั้งหมด</a>
			<br /><b>**พิมพ์คำที่บ่งบอกถึงเรื่องที่เกี่ยวข้องกับเนื้อหา </b><br>โดยใช้การ<b>เว้นวรรค</b> กรณีเป็นคำเชื่อมให้ใช้ <b>+</b> เป็นตัวเชื่อมคำ 
			<div id='tag_count'></div>	
					<!-- capcha -->
					<div style="width: 400px; float: left; height: 90px">
						<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="/board/test/securimage_show" alt='captcha' />
						<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
							<param name="allowScriptAccess" value="sameDomain" />
							<param name="allowFullScreen" value="false" />
							 <param name="movie" value="{$assets_path}media/securimage_play.swf?audio=/board/test/securimage_play&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
							<param name="quality" value="high" />
							<param name="bgcolor" value="#ffffff" />
							<embed src="{$assets_path}media/securimage_play.swf?audio=/board/test/securimage_play&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" 
							quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" 
							type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
						</object>

						<br />
						<!-- pass a session id to the query string of the script to prevent ie caching -->
						 <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/board/test/securimage_show?sid=' + Math.random(); return false">
                                                    <img src="{$assets_path}img/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" />
                                                 </a>
						 <div><input type="text" name="code" size="12" id="code" class="validate[required] text-input" /> กรุณาใส่รหัสที่เห็นในภาพด้วย<br /></div>	
					</div>
					<!-- end capcha -->
		</div>
		<div class="clear"></div>
		<div class="grid_5 clearfix" >
			<div style="margin-left:10px;">
			<input type="hidden" id="submit_value" name="submit_value" value="draft"></input>
                        <input type="hidden" id="code_post" name="code_post" value="{$gen_id}"></input>
                        {if $action=="add"}
			<BUTTON  id="btt_publish" value="publish" onclick="submit_form('publish');" >เผยแผ่</BUTTON>
                        {elseif $action=="edit"}
                        <input type="hidden" id="post_id" name="post_id" value="{$post_id}"></input>
                        <BUTTON  id="btt_edit" value="edit" onclick="submit_form('edit');" >แก้ไข</BUTTON>
                        {/if}
			<BUTTON  id="btt_preview" value=" preview" onclick="submit_form('preview');">ดูก่อน</BUTTON>
			<BUTTON  id="btt_draft" value="draft" onclick="preview();">ต้นร่าง</BUTTON>

			</div>
		</div>
	
	</form>
	<br />
	<br />

</div>
 
 {include file="`$theme`/backend/footer.tpl"}