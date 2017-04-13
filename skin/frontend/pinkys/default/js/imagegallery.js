$j(document).ready(function() { 

	// If you don't use a global js sheet, these can also go in the footer.

    $j('.image-popup').fancybox({
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

});



