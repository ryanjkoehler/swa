<?php
/**
* Description of Template goes here
*
Template Name: Explore
*/

?>


<?php get_header(); ?>




<div id="intro">


	<h1>Advanced Search</h1>






		<form id="SearchAsearchForm" method="post" action="/charts/asearch" accept-charset="utf-8">
			<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
			<div class="input text"><label for="SearchQ" class="hidden">Search Keywords</label><input name="data[Search][q]" type="text" class="search-text" placeholder="Search" id="SearchQ"></div>				

			<div class="check-list">
				<h3>Demographic</h3>                    
				<p class="hidden"><input type="hidden" name="data[Search][Demographic]" value="" id="SearchDemographic"></p>
				<ul>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="1" id="SearchDemographic1"><label for="SearchDemographic1">Race &amp; Ethnicity</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="2" id="SearchDemographic2"><label for="SearchDemographic2">Gender</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="3" id="SearchDemographic3"><label for="SearchDemographic3">Age</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="4" id="SearchDemographic4"><label for="SearchDemographic4">Family Type</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="5" id="SearchDemographic5"><label for="SearchDemographic5">Union Membership</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="6" id="SearchDemographic6"><label for="SearchDemographic6">Immigration Status</label></li>
								<li><input type="checkbox" name="data[Search][Demographic][]" value="7" id="SearchDemographic7"><label for="SearchDemographic7">Education Level</label></li>
							</ul>
			</div>	
			
			<div class="check-list">
				<h3>Subject</h3>                    
				<p class="hidden"><input type="hidden" name="data[Search][Subject]" value="" id="SearchSubject"></p>
				<ul>
								<li><input type="checkbox" name="data[Search][Subject][]" value="8" id="SearchSubject8"><label for="SearchSubject8">Poverty</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="9" id="SearchSubject9"><label for="SearchSubject9">Income</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="10" id="SearchSubject10"><label for="SearchSubject10">Wages</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="11" id="SearchSubject11"><label for="SearchSubject11">Health</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="12" id="SearchSubject12"><label for="SearchSubject12">Jobs</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="14" id="SearchSubject14"><label for="SearchSubject14">Wealth</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="15" id="SearchSubject15"><label for="SearchSubject15">International</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="16" id="SearchSubject16"><label for="SearchSubject16">Mobility</label></li>
								<li><input type="checkbox" name="data[Search][Subject][]" value="18" id="SearchSubject18"><label for="SearchSubject18">Economy Track</label></li>
							</ul>
			</div>	
			<input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/btn-submit.png" id="adv-search-submit" alt="Search button">		

		</form>	










</div>



<?php get_sidebar() ?>

<?php get_footer(); ?>