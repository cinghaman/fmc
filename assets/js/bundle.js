( function($) {

	$(document).ready(function(){
		// bootstrap wp js
		// here for each comment reply link of wordpress
		$( '.comment-reply-link' ).addClass( 'btn btn-primary' );

		// here for the submit button of the comment reply form
		$( '#commentsubmit' ).addClass( 'btn btn-primary' );

		// The WordPress Default Widgets
		// Now we'll add some classes for the wordpress default widgets - let's go

		// the search widget
		$( 'input.search-field' ).addClass( 'form-control' );
		$( 'input.search-submit' ).addClass( 'btn btn-default' );

		$( '.widget_rss ul' ).addClass( 'media-list' );

		$( '.widget_meta ul, .widget_recent_entries ul, .widget_archive ul, .widget_categories ul, .widget_nav_menu ul, .widget_pages ul' ).addClass( 'nav' );

		$( '.widget_recent_comments ul#recentcomments' ).css( 'list-style', 'none').css( 'padding-left', '0' );
		$( '.widget_recent_comments ul#recentcomments li' ).css( 'padding', '5px 15px');

		$( 'table#wp-calendar' ).addClass( 'table table-striped');
		// bootstrap wp js finished
		// owl 

		$('.site-logo').fadeIn( "slow" );

		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
				scrollTop: target.offset().top
				}, 1000);
				return false;
			}
			}
		});
		
			
	});// document ready
	
	
} )( jQuery );



