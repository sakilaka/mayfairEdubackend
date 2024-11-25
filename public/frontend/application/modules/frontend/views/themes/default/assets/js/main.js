$('.collaborate-slider').owlCarousel({
	center: false,
	items:4,
	loop: true,
	stagePadding: 0,
	margin: 0,
	autoplay: true,
	pauseOnHover: false,
	dots: true,
	nav: false,
	navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	responsive:{
	    200:{
	    
	      items: 1
	    },
        700:{
	    
            items: 2
          },
	    1000:{
	    
	      items: 3
	    },
	    1200:{
	    
	      items: 4
	    }
	}
});

$('.featured-slider').owlCarousel({
	center: false,
	items:4,
	loop: true,
	stagePadding: 0,
	margin: 0,
	autoplay: true,
	pauseOnHover: false,
	dots: true,
	nav: false,
	navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	responsive:{
	    200:{
	    
	      items: 1
	    },
        700:{
	    
            items: 2
          },
	    1000:{
	    
	      items: 3
	    },
	    1200:{
	    
	      items: 4
	    }
	}
});

// var counted = 0;
// $(window).scroll(function() {

//   var oTop = $('#counter').offset().top - window.innerHeight;
//   if (counted == 0 && $(window).scrollTop() > oTop) {
//     $('.count').each(function() {
//       var $this = $(this),
//         countTo = $this.attr('data-count');
//       $({
//         countNum: $this.text()
//       }).animate({
//           countNum: countTo
//         },

//         {

//           duration: 2000,
//           easing: 'swing',
//           step: function() {
//             $this.text(Math.floor(this.countNum));
//           },
//           complete: function() {
//             $this.text(this.countNum);
//             //alert('finished');
//           }

//         });
//     });
//     counted = 1;
//   }

// });