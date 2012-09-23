<?php 

function selectlist($tax){
	$terms = get_terms("$tax", array(
		'parent' => 0,
		));

	if(count($terms) > 0){
	    echo '';
	    foreach ($terms as $term) {
	    	if (in_array($term->slug, array('appendix', 'overview', 'inequality')))
	    		continue;
	      	echo '<option value="'.$term->slug.'">'. $term->name . '</option>';     
	    }
	}
} 

?>

<form id="explore" accept-charset="utf-8" action="/explore" method="get" enctype="multipart/form-data" onsubmit="return validate_form(this)">

	<h3><span>Explore</span> Our Charts</h3>

	<h4>Subject</h4>
	<!-- <input type="hidden" id="ExploreSubject_" value="" name="data[Explore][Subject]" /> -->
	<select id="ExploreSubject" name="subject">
		<option value="0">Select A Subject</option>
		<?php selectlist('subject'); ?>
	</select>  

	<h4>Demographic</h4>
	<!-- <input type="hidden" id="ExploreDemographic_" value="" name="data[Explore][Demographic]"/> -->
	<select id="ExploreDemographic" name="demographic">
		<option value="0">Select A Demographic</option>
		<?php selectlist('demographic'); ?>
	</select>

	<p class="error">Select a subject or demographic</p>

	<input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/btn-submit.png" alt="Submit form"/>
			
</form>