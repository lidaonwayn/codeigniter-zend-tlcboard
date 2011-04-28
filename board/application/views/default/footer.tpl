	<!-- jS -->
	<script type="text/javascript" src="{$assets_path}js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="{$assets_path}tiny_mce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery-ui-1.8.12.custom.min.js"></script>
	<script type="text/javascript" src="{$assets_path}js/ajaxupload.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery.form.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery_tag_editor.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="{$assets_path}js/jquery.slug.js"></script> 
	<script type="text/javascript" src="{$assets_path}js/jquery.blockUI.js"></script> 
	
	{literal}
	<script type="text/javascript">
		var count_tag =  0  ;
        $(function() {
           $('textarea.tinymce').tinymce({
             // Location of TinyMCE script
            script_url : '{/literal}{$assets_path}{literal}tiny_mce/tiny_mce.js',

            // General options
    		theme : "advanced",
			plugins : "pdw,advimage,advlink,media,emotions,preview,emotions,inlinepopups,insertdatetime,contextmenu,paste",
			skin : "cirkuit",
			
            // Theme options
			theme_advanced_buttons1_add_before : "pdw_toggle,newdocument,separator",
			theme_advanced_buttons1_add : "fontsizeselect",
			theme_advanced_buttons2_add : "separator,forecolor",
			theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
			theme_advanced_buttons3_add_before : "",
			theme_advanced_buttons3_add : "media,youtube,emotions",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_disable : "fontselect  ,styleselect ,help",
			extended_valid_elements : "hr[class|width|size|noshade]",
			paste_use_dialog : true,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : true,
			apply_source_formatting : true,
			force_br_newlines : true,
			force_p_newlines : false,
			relative_urls : false,
            pdw_toggle_on : "1",
            pdw_toggle_toolbars : "2,3",

            // Example content CSS (should be your site CSS)
            //content_css : "{/literal}{$assets_path}{literal}tiny_mce/css/content.css"

           });

          	$("#form_post").validationEngine('attach');
        	var options = { 
        	    beforeSubmit:  showRequest,  // pre-submit callback 
        		success:       showResponse , // post-submit callback 
        		url:"/board/ajax_action/save.html",
        		type:     "post",        // 'get' or 'post', override for form's 'method' attribute 
        		dataType:  "json"       // 'xml', 'script', or 'json' (expected server response type) 
        	    }; 
       
        	//$('#add_user').attr((this.encoding ? 'encoding' : 'enctype') , 'multipart/form-data');
        	$("#form_post").ajaxForm(options); 
       	
        	$('#btt_post','#btt_preview').click(function() {
        	    var content = tinyMCE.activeEditor.getContent(); // get the content
        	    if((content=="") || (content==null))
        	    {
        	   	 	alert("กรุณาใส่รายละเอียดเนื้อหา ด้วย");
        	    }
        	  //  $('#post_detail').val(content); // put it in the textarea
        	});
                   

        	var button = $('#buttonupload'), interval;
        	var num_pic=1;
        		new AjaxUpload(button, {
        			action: '/board/ajax_action/upload/pic', 
        			name: 'pic',

        			//sizeLimit: 10,
        			//allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'] ,        
        			onSubmit : function(file, ext){
        				// change button text, when user selects file	
        				// Allow only images. You should add security check on the server-side.
        				if (ext && /^(jpg|png|jpeg|gif)$/i.test(ext)) {                            
        				} else {
        				    alert('not image');
        				    return false;
        				}
        				button.text('Uploading');

        				// If you want to allow uploading only 1 file at time,
        				// you can disable upload button

        				this.disable();

        				// Uploding -> Uploading. -> Uploading...
        				interval = window.setInterval(function(){
        					var text = button.text();
        					if (text.length < 13){
        						button.text(text + '.');					
        					}else {
        						button.text('Uploading');				
        					}
        				}, 200);
        			},

        			onComplete: function(file, response){
        				button.text('Upload image');
        				window.clearInterval(interval);

        				// enable upload button
        				this.enable();
        				var status = jQuery.parseJSON(response);
        				
        				// add file to the list
        				if(status.success==0){
        					alert(status.error);
        				}else if(status.success== null){
        					alert("อัพโหลดไฟล์ไม่สำเร็จ");
        				}else{
        					if(num_pic>=5){
        						alert("อัพรูปได้มากสุด 5 รูปครับ");
        					}else{
        						$str ="อัพโหลดได้ "+(5-num_pic)+" ครั้งนะครับ";
        						$('#pic_board').html($str);		
        						num_pic++;
        						$('#post_detail').tinymce().execCommand('mceInsertContent',false,'<img src="'+status.urlpath+'" />');
        					}
        				}
        			},
        			messages: {
        				// error messages, see qq.FileUploaderBasic for content            
        			},
        			showMessage: function(message){ alert(message); }   
        		});    

        		var buttonthumb = $('#buttonthumb'), interval;
        		new AjaxUpload(buttonthumb, {
        			action: '/board/ajax_action/upload/thumb', 
        			name: 'thumb',
        			onSubmit : function(file, ext){
            			
        				// change button text, when user selects file			
        				buttonthumb.text('Uploading');
        				if (ext && /^(jpg|png|jpeg|gif)$/i.test(ext)) {                            
        				} else {
        				    alert('not image');
        				    return false;
        				}
       						
        				// If you want to allow uploading only 1 file at time,
        				// you can disable upload button
        				this.disable();
       			
        				// Uploding -> Uploading. -> Uploading...
        				interval = window.setInterval(function(){
        					var text = buttonthumb.text();
        					if (text.length < 13){
        						buttonthumb.text(text + '.');					
        					} else {
        						buttonthumb.text('Uploading');				
        					}
        				}, 200);
        			},
        			onComplete: function(file, response){
        				buttonthumb.text('Upload thumb');       						
        				window.clearInterval(interval);
       							
        				// enable upload button
        				this.enable();
        				var status = jQuery.parseJSON(response);

        				//console.log(status);
        				// add file to the list

        				if(status.success==0){
        					alert(status.error);
        				}else if(status.success== null){
        					alert("อัพโหลดไฟล์ไม่สำเร็จ");
        				}else{
        					$str ="<img src=\""+status.urlpath+"\" />120*90<br />";
        					$str +="<img src=\""+status.urlpath_thumb+" \" />70*70<br /><br />";
        					$str +="<input type=\"hidden\" name=\"realdir\" id=\"realdir\" value=\""+status.realdir+"\" />";
        					$str +="<input type=\"hidden\" name=\"urlDir\" id=\"urlDir\" value=\""+status.urlDir+"\" />";
        					$str +="<input type=\"hidden\" name=\"path_thumb_big\" id=\"path_thumb_big\" value=\""+status.fullpath+"\" />";
        					$str +="<input type=\"hidden\" name=\"image_thumb_big\" id=\"image_thumb_big\" value=\""+status.name+"\" />";
        					$str +="<input type=\"hidden\" name=\"name_only\" id=\"name_only\" value=\""+status.name_only+"\" />";
        					$str +="<input type=\"hidden\" name=\"pic_ext\" id=\"pic_ext\" value=\""+status.ext+"\" />";
        					$str +="<input type=\"hidden\" name=\"path_thumb_small\" id=\"path_thumb_small\" value=\""+status.fullpath_thumb+"\" />";
        					$str +="<input type=\"hidden\" name=\"image_thumb_small\" id=\"image_thumb_small\" value=\""+status.name_thumb+"\" />";
        					$str +="<br /><input type=\"checkbox\" name=\"delthumb\" id=\"delthumb\" value=\"1\" />";
        					$str +="<label for=\"delpicprofile\">ต้องการลบรูป</label><br /><br />";
        					$('#showthumb').html($str);	
        				}
        			}
        		});

       		 $("#resetTagsButton").click(function() {
                 $("#post_tag").tagEditorResetTags();
             });

 			$("#post_tag").tagEditor(
             {
                 confirmRemoval: true,
                 separator: ' ',
                 completeOnSeparator: true,
		 		 continuousOutputBuild: true,
                 completeOnBlur: true
             });  

 			$("#post_topic").slug();     		              
        });  
        
    	  
        // post-submit callback 
        function showResponse(responseText, statusText, xhr, $form)  {
        	//alert("showResponse");   
             if(responseText.success==0)
        	{
        		alert('เกิดข้อผิดพลาด'+responseText.error); 
        	}else if(responseText.success==1){
        		alert('เรียบร้อยแล้ว'); 
        		//window.location ="http://www.tlcthai.dav/board/view/cate_id="+responseText.cate_id+"&post_id="+responseText.post_id;
        	}else{
        		alert('เกิดข้อผิดพลาด');
        	}
             $('#form_topic').unblock(); 
        }

        function showRequest(responseText, statusText, xhr, $form)  { 
           // alert("showRequest".statusText);
	        $('#form_topic').block({ 
	            message: '<h1>Processing</h1>', 
	            css: { border: '3px solid #a00' } 
	        }); 
        }
                    
	</script>
	{/literal}
	
	<!-- END jS -->
	</body>
</html>