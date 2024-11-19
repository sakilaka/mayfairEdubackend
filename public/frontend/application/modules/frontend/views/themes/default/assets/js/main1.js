/***************************************************
==================== JS INDEX ======================
****************************************************
01. Teacher Slider Js
02. Testimonial Slider Js
03. Related Class Slider Js

****************************************************/

(function ($) {
"use strict";

	////////////////////////////////////////////////////
    // 01. Teacher Slider Js

	$('.teacher__slider').owlCarousel({
		center: true,
		items:1,
		loop: false,
		stagePadding: 0,
		margin: 10,
		autoplay: true,
		pauseOnHover: false,
		dots: true,
		nav: true,
		navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>",],
		responsive:{
			300:{
			
			  items: 1
			},
			700:{
			
				items: 2
			},
			1000:{
			
			  items: 4
			},
			1200:{
			
			  items: 5
			},
			1900:{
			
				items: 6
			}
		}
	});


	////////////////////////////////////////////////////
    // 02. Testimonial Slider Js

	$('.testimonial__slider').owlCarousel({
		center: false,
		items:1,
		loop: true,
		stagePadding: 0,
		margin: 30,
		autoplay: true,
		pauseOnHover: false,
		dots: true,
		nav: true,
		navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>",],
		responsive:{
			300:{
			
			  items: 1
			},
			700:{
			
				items: 1
			},
			1000:{
			
			  items: 1
			},
			1200:{
			
			  items: 1
			}
		}
	});

	////////////////////////////////////////////////////
    // 03. Related Class Slider Js

	$('.related__class__slider').owlCarousel({
		center: true,
		items:1,
		loop: false,
		stagePadding: 0,
		margin: 10,
		autoplay: true,
		pauseOnHover: false,
		dots: true,
		nav: false,
		navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>",],
		responsive:{
			300:{
			
				items: 1
			  },
			  700:{
			  
				  items: 2
			  },
			  1000:{
			  
				items: 4
			  },
			  1200:{
			  
				items: 5
			  },
			  1900:{
			  
				  items: 6
			  }
		}
	});


})(jQuery);

