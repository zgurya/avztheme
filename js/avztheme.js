jQuery(function($){
	/*
	 * Main menu Scroll
	 */
	$("header li.scroll a").click(function(e) {
		e.preventDefault();
		var elemID=$(this).attr('href');
	    $('html, body').animate({
	        scrollTop: $(elemID).offset().top-100
	    }, 1000);
	});
	
	/* 
	 * Magnific Popup Gallery 
	 */
	$('#gallery .items.magnific-popup').each(function() {
		$(this).magnificPopup({
			delegate: '.item',
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			gallery: { enabled:true }
		})
	});
	
	/* 
	 * Masonry 
	 */
	if($('#gallery .items.masonry').length){
		var $container = $('#gallery .items.masonry');
		$container.imagesLoaded( function() {
			$container.fadeIn();
			$container.masonry({
				itemSelector: '#gallery .item',
				columnWidth: '#gallery .item'
			});  
		});
	}
})