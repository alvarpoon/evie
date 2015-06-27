/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      $(document).ready(function() {
        $(".subscribe-container a").fancybox({
          wrapCSS    : 'fancybox-custom',
          //closeClick : true,
          closeBtn  : true,
          openEffect : 'none',
          padding: 0,

          helpers : {
            title : {
              type : 'inside'
            },
            overlay : {
              css : {
                'background' : 'rgba(238,238,238,0.85)'
              }
            }
          }
        });
		
		initStayConnect();
      });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
	  $(document).ready(function() {
			var owl = $("#main-banner");
			owl.owlCarousel({
				loop:true,
				nav:true,
				autoplay:true,
				autoplayTimeout:5000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					}
				}
			});
			$('.custom-banner-prev').on('click',function(){
				owl.trigger('prev.owl.carousel');
			});
			$('.custom-banner-next').on('click',function(){
				owl.trigger('next.owl.carousel');
			});
	  });
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  },
  media_coverage: {
    init: function(){
		$(".fancybox-effects-c").fancybox({
			wrapCSS    : 'fancybox-custom',
			//closeClick : true,
			closeBtn  : true,
			openEffect : 'none',
			padding: 0,

			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				}
			}
		});
	}
  },
  testimonials: {
	init: function(){
		$(document).ready(function(){
			updateCheckBoxValue();
		});
	}  
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

function initStayConnect(){
	$('#toggle_connect').click(function(){
		if(!$('#connect-popup').is(':visible')){
			$('#connect-popup').fadeIn();
		}
	});
	
	$(document).click(function(event) { 
		if(!$(event.target).closest('#connect-popup').length && event.target.id !== 'toggle_connect') {
			$('#connect-popup').fadeOut();
		}        
	});
}

function updateCheckBoxValue(){
	$('.checkbox-container input[type=checkbox]').each(function(){
		$(this).change(function(){
			if($(this).attr('id') === 'concern_all'){
				if($(this).prop('checked')){
					$(':checkbox[name='+ $(this).attr('name') +']').attr('checked',$(this).attr('checked'));
				}else{
					$(':checkbox[name='+ $(this).attr('name') +']').attr('checked',$(this).attr('checked'));
				}
			}
		});
	});
}

})(jQuery); // Fully reference jQuery after this point.
