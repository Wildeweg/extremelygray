
/*--------------------------------------------------------------------------------------------
  Add class of JS and remove no-js class
----------------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
	var doc = document.getElementById('doc');
	doc.removeAttribute('class', 'no-js');
	doc.setAttribute('class', 'js');
});

/*--------------------------------------------------------------------------------------------
  Show/Hide for Share Buttons
----------------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    	jQuery('.share-links-wrap').hide();
		jQuery('.share-btn').click(function () {
		jQuery(this).next('.share-links-wrap').fadeToggle('fast');
    });
});

/*---------------------------------------------------------------------------------------------
  Scalable/responsive Videos (more info see: fitvidsjs.com) 
----------------------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	jQuery('#primary').fitVids();
});
