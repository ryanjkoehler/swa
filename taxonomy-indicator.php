<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php get_header(); ?>

<?php if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $taxonomy = $term->taxonomy; // This is the Taxonomy Title
	$taxonomy_term = $term->name; 
} ?>

<h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2> 
<div id="intro">
<h1><?php echo $taxonomy_term; /*** This is the term you're looking at -- such as "Health" or "Race & Ethnicity" ***/ ?></h1>
</div>



<?php 

function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}



$slug = get_queried_object()->slug;
// echo $slug;
$query = new WP_Query( "pagename=national-jobs" );
while ( $query->have_posts() ) : $query->the_post(); ?>

	<?php the_content(); ?>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>


<?php get_template_part('loop', 'charts') ?>

</div>



<?php get_sidebar() ?>
    
<?php get_footer(); ?>