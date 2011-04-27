//
//	jQuery Slug Generation Plugin by Perry Trinier (perrytrinier@gmail.com)
//  Licensed under the GPL: http://www.gnu.org/copyleft/gpl.html

jQuery.fn.slug = function(options) {
	var settings = {
		slug: 'slug', // Class used for slug destination input and span. The span is created on $(document).ready() 
		hide: true	 // Boolean - By default the slug input field is hidden, set to false to show the input field and hide the span. 
	};
	
	if(options) {
		jQuery.extend(settings, options);
	}
	
	$this = jQuery(this);

	//jQuery(document).ready( function() {
		//if (settings.hide) {
		//	jQuery('input.' + settings.slug).after("<span class="+settings.slug+"></span>");
		//	jQuery('input.' + settings.slug).hide();
		//}
	//});
	
	makeSlug = function() {
			var slugcontent = jQuery.trim($this.val());
			var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
			var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9ก-๙\-]/g,'');
			//finishedslug =jQuery.trim(finishedslug);
			finishedslug = finishedslug.replace(/[^a-zA-Z0-9ก-๙\-]/g,'') // remove invalid chars
			    .replace(/\s+/g, '-') // collapse whitespace and replace by -
			    .replace(/-+/g, '-'); // collapse dashesv
			finishedslug =finishedslug.substring(0, 25);
			//if(finishedslug.substring(finishedslug.length, finishedslug.length - 1)="-"){
			//	finishedslug = finishedslug.substring(0, finishedslug.length - 1)
			//}
			jQuery('input.' + settings.slug).val(finishedslug.toLowerCase());
			//jQuery('input.' + settings.slug).text(finishedslug.toLowerCase());

		}
		
	jQuery(this).keyup(makeSlug);
		
	return $this;
};