<?php
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Custom Theme Settings',
		'menu_title'	=> 'Custom Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Custom Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}


function hide_wp_editor() {
	if ( basename( get_page_template() ) == 'events.php' ) {
		remove_post_type_support( 'page', 'editor' );
	}
}
add_action( 'do_meta_boxes', 'hide_wp_editor' );


function get_csu_time_format( $start, $end ) {
	if ( !$start ) {
		$time = __( 'TBD', 'csu-hcfw' );
	} else {
		$start = get_named_time($start);

		if ( !$end ) {
			if ( is_numeric($start) ) {
				$time = ( date( 'i', $start ) == '00' )
						? date( 'g a', $start )
						: date( 'g:i a', $start );
			} else {
				$time = $start;
			}
		} else {
			$end = get_named_time($end);

			if ( !is_numeric($start) || !is_numeric($end) ) {
				if ( is_numeric($start) ) {
					$start = date( 'g a', $start );
				}

				if ( is_numeric($end) ) {
					$end = date( 'g a', $end );
				}

				$time = $start.' - '.$end;
			} else {
				$alt_start = ( date( 'i', $start ) == '00' )
							  ? date( 'g', $start )
							  : date( 'g:i', $start );
				$start = ( date( 'i', $start ) == '00' )
						 ? date( 'g a', $start )
						 : date( 'g:i a', $start );
				$end = ( date( 'i', $end ) == '00' )
					  ? date( 'g a', $end )
					  : date( 'g:i a', $end );

				$time = ( date( 'a', strtotime($start) ) == date( 'a', strtotime($end) ) )
						? $alt_start.' - '.$end
						: $start.' - '.$end;
			}
		}
	}

	return $time;
}

function get_hcfw_time_format( $start, $end ) {
	if ( !$start ) {
		$time = __( 'TBD', 'csu-hcfw' );
	} else {
		$start = get_named_time($start);

		if ( !$end ) {
			if ( is_numeric($start) ) {
				$time = ( date( 'i', $start ) == '00' )
						? date( 'g a', $start )
						: date( 'g:i a', $start );
			} else {
				$time = $start;
			}
		} else {
			$end = get_named_time($end);

			if ( is_numeric($start) ) {
				$start = ( date( 'i', $start ) == '00' )
						 ? date( 'g a', $start )
						 : date( 'g:i a', $start );
			}

			if ( is_numeric($end) ) {
				$end = ( date( 'i', $end ) == '00' )
					  ? date( 'g a', $end )
					  : date( 'g:i a', $end );
			}

			$time = $start . '<span class="time-divider"> to </span>' . $end;
		}
	}

	return $time;
}

function get_named_time( $time ) {
	switch ( date( 'H:i', strtotime($time) ) ) {
		case '00:00':
			$time = 'Midnight';
			break;
		case '12:00':
			$time = 'Noon';
			break;
		default:
			$time = strtotime($time);
	}

	return $time;
}
