
<script type="text/javascript" src="<?php echo config_item('assets_path') ; ?>js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo config_item('assets_path') ; ?>tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
        $(function() {
                $('textarea.tinymce').tinymce({
                        // Location of TinyMCE script
                        script_url : '<?php echo config_item('assets_path') ; ?>tiny_mce/tiny_mce.js',

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
			relative_urls : true,
                        pdw_toggle_on : "1",
                        pdw_toggle_toolbars : "2,3",

                        // Example content CSS (should be your site CSS)
                        content_css : "css/content.css"

                });
        });
</script>

<form method="post" action="somepage">
<textarea id="content" name="content" class="tinymce" style="width:100%">
</textarea>
</form>
