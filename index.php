<?php get_header(); ?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>


<?php the_content(); ?>


<?php endwhile; endif; ?>
					
					
<?php if (is_front_page()) {?>
	<div id="intro">
			<p>
	The State of Working America, an ongoing analysis published since 1988 by the Economic Policy Institute, includes a wide variety of data on family incomes, wages, jobs, unemployment, wealth, and poverty that allow for a clear, unbiased understanding of the economy&rsquo;s effect on the living standards of working Americans.</p>
		</div><!-- /.intro-->
	<div id="intro-quote">
		<blockquote style="margin-top: 0px">
<!--			<p><em>&ldquo;…the best resource of information on the economic condition of American workers.&rdquo;</em></p>
		<p style="padding-top:16px; line-height:18px;">Ray Marshall <br />U.S. Secretary of Labor, 1977-1981</p> -->
		
		<p>
			<span style="font-size:10px; color: #006699; font-weight: bold;">NEW</span> | <span style="font-size:12px;">November 4, 2011 </span><br />
	
			<!-- <span style="font-size:15px; font-weight: bold;"><strong><em>Economy Track </em></strong></span></p> -->

		<p style="margin: 4px 8px;">
	See the latest labor market numbers, updated every month as new data becomes available, on 
		<em>State of Working America</em>'s <a href="http://www.stateofworkingamerica.org/charts/subject/18">Economic Indicators &raquo;</a>
		
		</p>
		
		</blockquote>
	
	</div><!-- /.intro-quote-->
</div><!-- /.????-->

<div id="aside">
	<form id="explore" accept-charset="utf-8" action="/charts/explore" method="post" enctype="multipart/form-data" onsubmit="return validate_form(this)">
	<h3><span>Explore</span> Our Charts</h3>
	<h4>Subject</h4>
	<input type="hidden" id="ExploreSubject_" value="" name="data[Explore][Subject]" />
	<select id="ExploreSubject" name="data[Explore][Subject][id]">
		<option value="0">Select A Subject</option>
					<option value="18">Economy Track</option>
					<option value="11">Health</option>
					<option value="9">Income</option>
					<option value="15">International</option>
					<option value="12">Jobs</option>
					<option value="16">Mobility</option>
					<option value="8">Poverty</option>
					<option value="10">Wages</option>
					<option value="14">Wealth</option>
			</select>  
	<h4>Demographic</h4>
	<input type="hidden" id="ExploreDemographic_" value="" name="data[Explore][Demographic]"/>
	<select id="ExploreDemographic" name="data[Explore][Demographic][id]">
		<option value="0">Select A Demographic</option>
					<option value="3">Age</option>
					<option value="7">Education Level</option>
					<option value="4">Family Type</option>
					<option value="2">Gender</option>
					<option value="6">Immigration Status</option>
					<option value="1">Race & Ethnicity</option>
					<option value="5">Union Membership</option>
			</select>
	<p class="error">Select a subject or demographic</p>
	<input type="image" src="<?php echo get_stylesheet_directory_uri() ?>/img/form/btn-submit.png" alt="Submit form"/>				
</form></div><!-- /.aside -->
<div id="slideshow">
	<ol id="slides">
		<li class="slide static-slide clearfix" id="slide-1">
			<div>
				<h3><a href="/pages/interactive">Interactive feature</a></h3>
				<h4>When income grows, who gains?</h4>
				<a href="/pages/interactive"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/accordion/feature_promo_interactive.jpg" alt="#"/></a>
				<p>Chart the growth in U.S. household income since 1917—and see how the growth has been shared between the Top 10% and the Bottom 90% of Americans.</p>
<ul>		<li>Between 1948 and 1979 the richest 10% accounted for a third of average income growth – matching their share in 1948 and keeping the income distribution stable for these three decades.</li>
				<li>Between 1979 and 2007 the richest 10% accounted for a full 91% of average income growth.</li>
				</ul>
				<a href="/pages/interactive">When income grows, who gains? &raquo;</a>			</div>
		</li>
		<li class="slide clearfix" id="slide-2">
			<div>
				<h3><a href="/features/view/2">The Great Recession</a></h3>
				<h4>Officially ended in 2009, but workers will struggle for years to come</h4>
				<a href="/features/view/2"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/accordion/recession.png" alt="#"/></a>
				<p>A historical context for the damage done and the long aftermath ahead.</p>
				<ul>
					<li>Single largest increase in the unemployment rate since 1948</li>
					<li>Unemployment stubbornly high many months into the official recovery</li>
					<li>Median family incomes lower in 2009 than they have been since 1997</li>
				</ul>
				<a href="/features/view/2">More about The Great Recession &raquo;</a>			</div>
		</li>
		<li class="slide clearfix" id="slide-3">
			<div>
				<h3><a href="/features/view/3">The Economic Landscape</a></h3>
				<h4>Economic outcomes began changing radically in the 1970s, but why?</h4>
				<a href="/features/view/3"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/accordion/economic.png" alt="#"/></a>
				<ul>
					<li>The policy commitment to low unemployment rates was traded for one of low inflation rates</li>
					<li>The U.S. and a much poorer global economy became more tightly integrated</li>
					<li>Key labor market institutions (minimum wage, right to organize unions) have been undermined.</li>
				</ul>
				<a href="/features/view/3">More about The Economic Landscape &raquo;</a>			</div>
		</li>
		<li class="slide clearfix" id="slide-4">
			<div>
				<a href="/features/view/1"><h3>Inequality</h3></a>
				<h4>Economy already failing most families for decades before Great Recession</h4>
				<a href="/features/view/1"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/accordion/inequality.png" alt="#"/></a>
				<p>Stratospheric gains at top pull overall averages up, but leave low- and moderate-income families struggling.</p>
				<ul>
					<li>Between 1979 and 2007, the richest 10% of families claimed almost two-thirds of all income growth</li>
					<li>More-equitable growth would have gained median families $9,000 in annual income</li>
					<li>Poverty could have been eradicated by the mid-1980s</li>
				</ul>
				<a href="/features/view/1">More about Inequality &raquo;</a>			</div>
		</li>
	</ol>
</div>	<!-- /.slideshow -->
    	</div>
<?php } else {?>
<?php } ?>

<?php get_footer(); ?>