$j(document).ready(function() { 

	// If you don't use a global js sheet, these can also go in the footer.

    $j('.fancybox').fancybox({
     // padding   : 0,
      maxWidth  : '100%',
      maxHeight : '100%',
      width   : 560,
      height    : 315,
      autoSize  : true,
      closeClick  : true,
      openEffect  : 'elastic',
      closeEffect : 'elastic'
    });
	/* Using custom settings */
	
	// $("a#inline").fancybox({
	// 	'hideOnContentClick': true
	// });

	// /* Apply fancybox to multiple items */
	
	// $("a.group").fancybox({
	// 	'transitionIn'	:	'elastic',
	// 	'transitionOut'	:	'elastic',
	// 	'speedIn'		:	600, 
	// 	'speedOut'		:	200, 
	// 	'overlayShow'	:	false
	// });

});



