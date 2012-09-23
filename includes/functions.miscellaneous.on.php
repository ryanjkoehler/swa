<?php 




function all_my_customs($id = 0){
    //if we want to run this function on a page of our choosing them the next section is skipped.
    //if not it grabs the ID of the current page and uses it from now on.
    if ($id == 0) :
        global $wp_query;
        $content_array = $wp_query->get_queried_object();
        $id = $content_array->ID;
    endif;   

    //knocks the first 3 elements off the array as they are WP entries and i dont want them.
    $first_array = array_slice(get_post_custom_keys($id), 3);

    //first loop puts everything into an array, but its badly composed
    foreach ($first_array as $key => $value) :
           $second_array[$value] =  get_post_meta($id, $value, FALSE);

            //so the second loop puts the data into a associative array
            foreach($second_array as $second_key => $second_value) :
                       $result[$second_key] = $second_value[0];
            endforeach;
     endforeach;

    //and returns the array.
    return $result;
}






// http://stylizedweb.com/2010/08/16/use-the-link-description-in-wordpress-3-0-menus/

class EPI_menu_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		// $class_names = '';
		$class_names = ' class="'.$class_names.'"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $item->description ? '<br><span class="menu-sub">' . $item->description . '</span>' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}