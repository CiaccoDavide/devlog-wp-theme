(function($){
	
	/** Options Tabs */
	function pranaOptionsTabs() {
		
		var relid = $.cookie( 'prana_tab_relid' );
		
		if( relid >= 1  ) {
			pranaOptionsTabControl( relid );
		} else {
			pranaOptionsTabControl( 0 );
		}
		
		$( '.prana-group-tab-link-a' ).click( function() {
			
			relid = $(this).attr( 'data-rel' );
			$.cookie( 'prana_tab_relid', relid );
			pranaOptionsTabControl( relid );		
			
		});
		
	}
	
	function pranaOptionsTabControl( relid ) {
		
		$( '.prana-group-tab' ).each( function() {
				
			if( $(this).attr( 'id' ) == relid + '_section_group' ) {					
				$(this).delay( 400 ).fadeIn( 1200 );				
			} else{					
				$(this).fadeOut( 'fast' );
			}
			
		});
		
		$( '.prana-group-tab-link-li' ).each( function() {
			
			if( $(this).attr('id') != relid + '_section_group_li' && $(this).hasClass( 'active' ) ) {					
				$(this).removeClass( 'active' );				
			}
			
			if( $(this).attr('id') == relid + '_section_group_li' ) {					 
				 $(this).addClass('active');				
			}
		
		});
		
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){		
		pranaOptionsTabs();		
	});

	/** jQuery Windows Load */
	$(window).load(function(){
	});	

})(jQuery);