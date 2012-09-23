<?php
/*
Template Name: Economic Indicators Template
*/
?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>


<?php require_once('./simplepie/simplepie.inc'); 
 
// Set time zone (needs to be set before calling PHP date() or SimplePIE get_date())
date_default_timezone_set('America/New_York');

// We'll process this feed with all of the default options.
$feed = new SimplePie();
 
// Set which feed to process.
$feed->set_feed_url( get_post_meta($post->ID, 'RSS_Feed', true) );
$feed->set_item_limit( 3 );
$feed->get_item_quantity( 3 );
$feed->enable_cache(false);

// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

?>



<h2 class="sp-header">Economic Indicators</h2> 
<div id="intro">
<h1 class="indicator-h1 chart-icon-pre"><?php the_title(); ?></h1>

<div class="box-updated">

<?php 
    $items = $feed->get_items( 0, 1 );
?>

    <div>
        <strong>Updated:</strong> <?php echo get_the_date( 'F j, Y' ); ?>
        <!-- <strong>Updated:</strong> <?php echo $items[0]->get_date('F j, Y'); ?> -->
    </div> 

<?php 

$next_update = get_post_meta($post->ID, 'Next_Update', true);
$next_update_is_future = strtotime($next_update) > time();

if ( $next_update && $next_update_is_future ): ?>
    <div>
        <strong>Next data release:</strong>  <?php echo $next_update; ?>
    </div>
<?php endif ?>
   
</div>

<div class="indicators-content">
    <?php the_excerpt(); ?>
</div>

<?php  endwhile; endif; ?>


<!-- <h3>Read the companion report on epi.org</h3> -->



    <?php
    /*
    Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
    */
    foreach ($feed->get_items( 0, 1 ) as $item):
    ?>


     <!-- <h3>Updated <?php echo $item->get_date('F j, Y'); ?> | <em><a href="<?php echo $item->get_permalink(); ?>">Read the full report from EPI »</a></em></h3> -->

<div class="indicator-box">
        <div class="item">
            <!-- <h2><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2> -->
            <p>
	<span class="ei-title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></span> 
            <span class="ei-date">| <?php echo $item->get_date('g:i a, F j, Y'); ?></span>
			<br>
            <?php echo $item->get_description(); ?></p>
			<!-- <p class="ei-readmore"><em><a href="<?php echo $item->get_permalink(); ?>">Read the full report from EPI »</a></em></p> -->
        </div>
 </div>

 <div class="indicator-below">
	Posted <?php echo $item->get_date('F j, Y'); ?> | 
	<em><a href="<?php echo $item->get_permalink(); ?>">Read the full report from EPI »</a></em>
 </div>
    <?php endforeach; ?>




<?php the_content(); ?>






<?php

$slug = get_queried_object()->post_name;


/* get_template_part( 'loop' ) only seems to work if the query is in $wp_query */
$temp_query = clone $wp_query; 

// $wp_query = new WP_Query( "indicator=$slug&post_type=post&posts_per_page=-1" );
$wp_query = new WP_Query(array(
        "indicator" => $slug,
        "post_type" => array('post','chart'),
        "posts_per_page" => -1,
    ));

get_template_part('loop', 'charts');

$wp_query = clone $temp_query;


?>


<!-- <h2>Previous <?php strtolower(the_title()); ?> reports</h2> -->
<h2>Previous reports</h2>
    <?php
    /*
    Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
    */
    foreach ($feed->get_items( 1, 3 ) as $item):
    ?>

        <div class="item">
            <h4><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h4>
            <!-- <p><?php echo $item->get_description(); ?></p> -->
            <p><small>Posted on <?php echo $item->get_date('F j, Y | g:i a'); ?></small></p>
        </div>
 
    <?php endforeach; ?>




</div></div>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>