<?php
/**
* Description of Template goes here
*
Template Name: Explore
*/

?>


<?php get_header(); ?>

<?php 
// global $wp_query;
// $term = $wp_query->get_queried_object();
// $taxonomy = $term->taxonomy; // This is the Taxonomy Title
// $taxonomy_term = $term->name; 
// 


//print_r($wp_query);
//var_dump(get_defined_vars());

$getsubject = htmlspecialchars($_GET["subject"]);
$getdemographic = htmlspecialchars($_GET["demographic"]);
$getsearch = htmlspecialchars($_GET["searchterm"]);

// echo $getsubject;
// echo $getdemographic;

if(!empty($getsubject) && !empty($getdemographic)) { $and = " and "; }

$propersubject = get_term_by( 'slug', $getsubject, 'subject');
//echo $propersubject->name;
$properdemographic = get_term_by( 'slug', $getdemographic, 'demographic');
//echo $properdemographic->name;

?>

<!-- <h2 class="sp-header"><?php echo $taxonomy; /*** This is the title of the taxonomy -- such as "Subjects" or "Demographics" ***/ ?></h2>  -->
<div id="intro">

<?php if ( $getsearch ) { ?>

<h1>Chart results for "<?php echo $getsearch; ?>" in <?php echo $propersubject->name . $and . $properdemographic->name; ?></h1>

<?php } else { ?>

<h1>Chart results for <?php echo $propersubject->name . $and . $properdemographic->name; ?></h1>

<?php } ?>

</div>
<?php 

// $wp_query = new WP_Query( "subject=$getsubject&demographic=$getdemographic&posts_per_page=-1&post_type=post,chart&s=$getsearch" );
$wp_query = new WP_Query( array(
		"subject" => $getsubject,
		"demographic" => $getdemographic,
		"orderby" => 'title',
		"order" => 'asc',
		"posts_per_page" => -1,
		"post_type" => array('post', 'chart'),
	));

 ?>		

	<?php get_template_part( 'loop', 'charts-new' ); ?>
</div>


<?php get_sidebar() ?>
<?php get_footer(); ?>