 {include file="`$theme`/header.tpl"}
 
<div class="container_16 clearfix">

	<form method="post" action="/board/ajax_action/save/" id="form_post" id="form_post">
		<div class="grid_8 " style="background-color:#CFF">
			{foreach $cparent as $arr_cparent}
			<input type="radio" name="category" id="category" value="{$arr_cparent.cate_id}" class="validate[required] radio" />{$arr_cparent.cate_name}<br />
			{/foreach}
		</div>
		<div class="grid_16 clearfix" style="background-color:#FCF">
			<label for="post_topic">หัวข้อ </label>
			<input type="text" name="post_topic" id="post_topic" class="validate[required,minSize[6]] text-input" /><br />
			<label for="slug">Slug:</label> 
			<input name="slug" id="slug" value="" class="slug validate[required]" />
			<div id='buttonupload' class="button">Upload image</div>
			<div id="pic_board">อัพโหลดได้ 5 ครั้งนะครับ</div>
			<textarea id="post_detail" name="post_detail" class="tinymce" style="width:100%"></textarea>
		</div>
		<div class="grid_16 clearfix" style="background-color:#9CF">
			<div id="buttonthumb" class="button">Upload thumb</div>
			<div id="showthumb" ></div>
			
			<label for="post_topic">ผู้โพสต์</label>
			<input type="text" name="post_name" id="post_name" class="validate[required,minSize[4]] text-input">
			<br /><B>Tag ป้ายชื่อคำค้น</B> 
			<input  id="post_tag" name="post_tag" type="text" size="30" maxlength="100" >
		 	<div id='tag_count'></div><a id="resetTagsButton">ล้าง tag ทั้งหมด</a>
			<br /><b>**พิมพ์คำที่บ่งบอกถึงเรื่องที่เกี่ยวข้องกับเนื้อหา </b><br>โดยใช้การ<b>เว้นวรรค</b> กรณีเป็นคำเชื่อมให้ใช้ <b>+</b> เป็นตัวเชื่อมคำ 
			<div id='tag_count'></div>	
			<!-- capcha -->
			<div style="width: 430px; float: left; height: 90px">
				<img id="siimage" align="left" style="padding-right: 5px; border: 0" src="/board/test/securimage_show?sid={$sid}" alt='captcha' />
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
				 <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/board/test/securimage_show?sid=' + Math.random(); return false"><img src="{$assets_path}img/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
				 <br /><input type="text" name="code" size="12" id="code" class="validate[required] text-input" /> กรุณาใส่รหัสที่เห็นในภาพด้วย<br /><br />	
			</div>
			<!-- end capcha -->
			<br /><br /><br />
			<input type="submit" name="btt_post"  id="btt_post"  value="post" > 
			<input type="submit" name="btt_preview"  id="btt_preview"  value="preview" >
		</div>
	
	</form>
	<br />
	<br />
	<br />
	<br />
	<br />
</div>
 
 {include file="`$theme`/footer.tpl"}