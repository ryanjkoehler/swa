<?php


// 
// add_action('template_redirect', 'seach_query_is_title');
// 
// function seach_query_is_title() {
// 	if (is_search()) {
// 		global $wp_query;
// 		if ( get_page_by_title( get_search_query(), 'OBJECT', 'post' ) ) {
// 			wp_redirect( get_permalink( get_page_by_title( get_search_query() )->ID ) );
// 		}
// 		elseif ( get_page_by_title( get_search_query(), 'OBJECT', 'page' ) ) {
// 			wp_redirect( get_permalink( get_page_by_title( get_search_query() )->ID ) );
// 		}
// 	}
// }


//  I think this is unused and can be deleted.

/**
 * Upcoming_Posts widget class
 */
class SWA_Explore_Charts_Widget extends WP_Widget {
    function SWA_Explore_Charts_Widget() {
        $widget_ops = array('classname' => 'widget_upcoming_entries', 'description' => __( "List scheduled/upcoming posts", 'upcoming_posts_widget') );
        $this->WP_Widget('upcoming-posts', __('Upcoming Posts', 'upcoming_posts_widget'), $widget_ops);
    }
 
    function widget($args, $instance) {
        extract($args);
 
        $title = empty($instance['title']) ? __('Upcoming Posts', 'upcoming_posts_widget') : apply_filters('widget_title', $instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 10;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 15 )
            $number = 15;
 
        $queryArgs = array(
            'showposts'         => $number,
            'what_to_show'      => 'posts',
            'nopaging'          => 0,
            'post_status'       => 'future',
            'caller_get_posts'  => 1,
            'order'             => 'ASC'
        );
 
        $r = new WP_Query($queryArgs);
        if ($r->have_posts()) :
    ?>
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <ul>
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        <li><?php if ( get_the_title() ) the_title(); else the_ID(); ?><?php edit_post_link('e',' (',')'); ?></li>
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
    <?php
        endif;
        wp_reset_query();  // Restore global post data stomped by the_post().
    }
 
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
 
        return $instance;
    }
 
    function form( $instance ) {
        $title = attribute_escape($instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 5;
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
 
        <p><label for="<?php echo $this->get_field_id('number'); ?>">
        <?php _e('Number of posts to show:'); ?>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></label>
        <br /><small><?php _e('(at most 15)'); ?></small></p>
    <?php
    }
}
function registerSWA_Explore_Charts_Widget() {
    register_widget('SWA_Explore_Charts_Widget');
}
add_action('widgets_init', 'registerSWA_Explore_Charts_Widget');















?>