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

		/*function close_contact_popup(){
			$('#connect-popup').fadeOut();
			alert('close_contact_popup');
		}
*/
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

        $('.no-hover>a').click(function( event ){
        	event.preventDefault();
        });
		
		/**
		  * NAME: Bootstrap 3 Triple Nested Sub-Menus
		  * This script will active Triple level multi drop-down menus in Bootstrap 3.*
		  */
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			// Avoid following the href location when clicking
			event.preventDefault(); 
			// Avoid having the menu to close when clicking
			event.stopPropagation(); 
			// Re-add .open to parent sub-menu item
			if(!$(this).parent().hasClass('open')){
				$(this).parent().addClass('open');
				$(this).parent().find("ul").parent().find("li.dropdown").addClass('open');
			}else{
				$(this).parent().removeClass('open');
				$(this).parent().find("ul").parent().find("li.dropdown").removeClass('open');
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
			$('.desktop-banner-prev').on('click',function(){
				owl.trigger('prev.owl.carousel');
			});
			$('.desktop-banner-next').on('click',function(){
				owl.trigger('next.owl.carousel');
			});
			
			var mobile_owl = $("#main-mobile-banner");
			mobile_owl.owlCarousel({
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
			$('.mobile-banner-prev').on('click',function(){
				mobile_owl.trigger('prev.owl.carousel');
			});
			$('.mobile-banner-next').on('click',function(){
				mobile_owl.trigger('next.owl.carousel');
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
  page_template_template_media: {
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
  },
  testimonials_tc: {
	init: function(){
		$(document).ready(function(){
			updateCheckBoxValue();
		});
	}  
  },
  testimonials_sc: {
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

/*function close_contact_popup(){
	$('#connect-popup').fadeOut();
	alert('close_contact_popup');
}*/

function initStayConnect(){
	$('.toggle_connect').click(function(){
		if(!$('#connect-popup').is(':visible')){
			$('#connect-popup').fadeIn();
		}
	});
	
	$('.toggle_connect_link').click(function(){
		if(!$('#connect-popup').is(':visible')){
			$('#connect-popup').fadeIn();
		}
	});
	
	$('#connect_close').click(function(){
		$('#connect-popup').fadeOut();
	});
	
	$(document).click(function(event) { 
		if(!$(event.target).closest('#connect-popup').length && event.target.id === 'connect_close') {
			if(event.target.id === 'toggle_connect' || event.target.className === 'toggle_connect_link' ){
				console.log(0);
				return;
			}else{
				$('#connect-popup').fadeOut();
			}
		}        
	});
}

function getUrlVars()
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++)
	{
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}	

function addItem(arr, val){
	if($.inArray( val, arr ) === -1){
		arr.push(val);
	}	
}

function updateCheckBoxValue(){
	var current_category = [];
	var current_concern = [];
	var current_sort = '';
	var category_str = '';
	var concern_str = '';
	var sort_str = '';
	
	current_sort = getUrlVars().sorting;
	var current_category_str = getUrlVars().product_cat;
	var current_concern_str = getUrlVars().concern_cat;
	
	//console.log(current_category_str);
	
	if(current_category_str !== '' && typeof current_category_str !== 'undefined'){
		current_category = current_category_str.split(',');
	}
	if(current_concern_str !== '' && typeof current_concern_str !== 'undefined'){
		current_concern = current_concern_str.split(',');
	}
	
	function initRadio(){
		$('.sort_order').each(function(){
			$(this).prop('checked', false);
		});
		
		$('.sort_order').each(function(){
			if(current_sort !== '' && typeof current_sort !== 'undefined'){
				if($(this).val() === current_sort){
					$(this).prop('checked', true);	
				}
			}else{
				if($(this).val() === 'newest'){	
					$(this).prop('checked', true);	
				}
			}
		});
	}
	
	function initChecked(arr, classname){
		if(arr.length > 0 ){
			$('.'+classname).each(function(){
				$(this).prop('checked', false);	
			});
			
			$('.'+classname).each(function(){
				if($.inArray( $(this).val(), arr ) > -1){
					$(this).prop('checked', true);	
				}
			});
		}else{
			$('.'+classname).each(function(){
				$(this).prop('checked', true);
				addItem(arr, $(this).val());
			});
		}
	}
	
	function checkAllActive(classname, allItem){
		if($('.'+classname+':checked').not('#'+allItem).length === $('.'+classname).not('#'+allItem).length){
			$('#'+allItem).prop('checked', true);
		}else if($('.'+classname+':checked').not('#'+allItem).length < $('.'+classname).not('#'+allItem).length){
			$('#'+allItem).prop('checked', false);
		}
	}
	
	initRadio();
	initChecked(current_category, 'category_filter');
	initChecked(current_concern, 'concern_filter');
	
	
	checkAllActive('category_filter', 'category_all');
	checkAllActive('concern_filter', 'concern_all');
	
	$('.category_filter').each(function(){
		if($(this).attr('id') !== 'category_all'){
			if($(this).prop('checked') && $.inArray( $(this).val(), current_category ) === -1){
				current_category.push($(this).val());
			}
		}
		$(this).change(function(){
			if($(this).attr('id') === 'category_all'){
				
				if($(this).prop('checked')){
					$('.category_filter').each(function(){
						addItem(current_category, $(this).val());
					});
					updateFilterStr();
				}else{
					$('.category_filter').each(function(){
						current_category = [0];
					});
					updateFilterStr();
				}
			}else{
				if($(this).prop('checked')){
					addItem(current_category, $(this).val());
					updateFilterStr();
					
				}else{
					var removeItem = $(this).val();
					current_category = jQuery.grep(current_category, function(value) {
					  return value !== removeItem;
					});
					
					updateFilterStr();
				}
			}
		});
	});
	
	$('.concern_filter').each(function(){
		if($(this).attr('id') !== 'concern_all'){
			if($(this).prop('checked') && $.inArray( $(this).val(), current_concern ) === -1){
				current_concern.push($(this).val());
			}
		}
		$(this).change(function(){
			if($(this).attr('id') === 'concern_all'){
				
				if($(this).prop('checked')){					
					$('.concern_filter').each(function(){
						$(this).prop('checked', true);	
						addItem(current_concern, $(this).val());
					});
					updateFilterStr();
				}else{				
					$('.concern_filter').each(function(){
						$(this).prop('checked', false);
						current_concern = [0];
					});
					updateFilterStr();
				}
			}else{
				if($(this).prop('checked')){
					addItem(current_concern, $(this).val());
					updateFilterStr();
					
				}else{
					var removeItem = $(this).val();
					current_concern = jQuery.grep(current_concern, function(value) {
					  return value !== removeItem;
					});
					
					updateFilterStr();
				}
			}
		});
	});
	
	$('input[name=sort_order]:radio').change(function(){
		updateFilterStr();
	});
	
	function updateFilterStr(){
		category_str = '';
		concern_str = '';
		sort_str = '';
		for(var i=0; i<current_category.length; i++){
			if(current_category[i] !== ''){
				category_str += current_category[i]+',';
			}
		}
		category_str = category_str.slice(0,-1);
		
		for(var j=0; j<current_concern.length; j++){
			if(current_concern[j] !== ''){
				concern_str += current_concern[j]+',';
			}
		}
		concern_str = concern_str.slice(0,-1);
		
		sort_str = $('input[name=sort_order]:checked').val();
		//console.log(full_url);
		//var url = window.location.origin + window.location.pathname + '?product_cat='+category_str + '&concern_cat=' + concern_str + '&sorting=' + sort_str;
		var url = full_url + '?product_cat='+category_str + '&concern_cat=' + concern_str + '&sorting=' + sort_str;
		window.location.href = url;
	}	
}

})(jQuery); // Fully reference jQuery after this point.
