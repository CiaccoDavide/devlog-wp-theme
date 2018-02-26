/** JS Logics */
(function($){
	
	/** Drop Downs */
	function pranaMenu() {
		
		/** Superfish Menu */
		$( '.menu ul' ).supersubs({			
			minWidth: 12,
			maxWidth: 25,
			extraWidth: 0			
		}).superfish({		
			delay: 1200, 
			autoArrows: false,
			dropShadows: false		
		});
		
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		pranaMenu();
	});
	
	/** jQuery Windows Load */
	$(window).load(function(){
	});

})(jQuery);