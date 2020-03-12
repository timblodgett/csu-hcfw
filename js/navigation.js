jQuery(document).ready(function($) {

	if ( '#site-navigation'.length > 0 ) {
		var mainMenu = $('#primary-menu');
		mainMenu.attr( 'aria-expanded', 'false' );

		var button = $('#primary-menu-toggle');
		button.attr( 'aria-expanded', 'false' );

		button.click(function() {
			if ( button.attr( 'aria-expanded' ) == 'true' ) {
				button.attr( 'aria-expanded', 'false' );
				mainMenu.attr( 'aria-expanded', 'false' );
			} else {
				button.attr( 'aria-expanded', 'true' );
				mainMenu.attr( 'aria-expanded', 'true' );
			}
		});

		var mainMenuHasChild = '.main-navigation .menu-item-has-children';
		var mainMenuHasChildLink = '.main-navigation .menu-item-has-children > a';

		$(mainMenuHasChildLink).attr( 'aria-haspopup', 'true' ).attr( 'aria-expanded', 'false' );

		$(mainMenuHasChildLink).click(function(e) {
			e.preventDefault();

			if ( $(this).parent().hasClass('open') ) {
				$(this).attr('aria-expanded', 'false').parent().removeClass('open');
			} else {
				$(this).attr('aria-expanded', 'true').parent().addClass('open');
			}
		});
	}

});
