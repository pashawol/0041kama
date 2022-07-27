(function($) {
	"use strict";
	$(function() {
	var block_show = false;
	function scrollMore(){

		

		var $target = $('#pp_loadmore_products');
		if (block_show) {
			return false;
		}
		if($target == false) {
			return false;
		}
		var wt = $(window).scrollTop() + 150;
		var wh = $(window).height();
		var et = $target.offset().top;
		var eh = $target.outerHeight();
		var dh = $(document).height();   
		if (wt + wh >= et || wh + wt == dh || eh + et < wh){
			block_show = true;
			var button = $($target),
			    data = {
				'action': 'loadmore',
				'query': wp_js_vars.posts, // that's how we get params from wp_localize_script() function
				'page' : wp_js_vars.current_page
			};

		//pause(700);

			$.ajax({
				url : wp_js_vars.ajaxurl, // AJAX handler
				data : data,
				related_products : 'no',
				type : 'POST',

				

				beforeSend : function ( xhr ) {
					button.addClass('loading');
					button.html('<svg class="icon icon-refresh "><use xlink:href="/wp-content/themes/kamacentr/assets/img/svg/sprite.svg#refresh"></use></svg><span>Загрузка...</span>'); // change the button text, you can also add a preloader image

				},

				success : function( data ){
					if( data ) {
						//console.log(data)
						console.log('current_page: ' + wp_js_vars.current_page + ' max_page: ' + wp_js_vars.max_page);

						$('#products_list').append( data ); // where to insert posts
						button.removeClass('loading');
						button.html( '<svg class="icon icon-refresh "><use xlink:href="/wp-content/themes/kamacentr/assets/img/svg/sprite.svg#refresh"></use></svg><span>Показать еще</span>' );
						wp_js_vars.current_page++;
						Sticky.update();

						if ( wp_js_vars.current_page == wp_js_vars.max_page )
							button.remove(); // if last page, remove the button
					} else {
						button.remove(); // if no data, remove the button as well
						$target = false;
					}
					block_show = false;
				}
			});



		}
	}

		window.addEventListener('scroll', () => {
		scrollMore();
		}, {
			passive: true
		});
	$(document).ready(function(){ 
		scrollMore();
	});
	});

	function pause(delay) {
	  var startTime = Date.now();

	  while (Date.now() - startTime < delay);
	}

}(jQuery));




