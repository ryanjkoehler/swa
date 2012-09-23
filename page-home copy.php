<?php
/**
* Description of Template goes here
*
Template Name: Home
*/

?>

<?php get_header(); ?>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>



	<div id="intro"><?php the_content(); ?></div>
	<div id="intro-quote"><blockquote style="margin-top: 0px">
<!--			<p><em>&ldquo;…the best resource of information on the economic condition of American workers.&rdquo;</em></p>
		<p style="padding-top:16px; line-height:18px;">Ray Marshall <br />U.S. Secretary of Labor, 1977-1981</p> -->
		
		<!-- <p>		<span style="font-size:10px; color: #006699; font-weight: bold;">NEW</span> | <span style="font-size:12px;">April 1, 2011 </span><br />
		<p style="margin: 4px 8px;">
	See the latest labor market numbers, updated every month as new data becomes available, on 
		<em>State of Working America</em>'s <a href="http://www.stateofworkingamerica.org/charts/subject/18">Economy Track &raquo;</a>
		</p> -->
		
		<?php // get_post_custom_values('callout_text', $post_id); ?> 
		<!-- <?php $callout = get_post_meta($post_id, 'Callout Text', true); echo $callout; echo "hello"; ?>  -->
		
		<?php echo get_post_meta($post->ID, 'Callout Text', true) ?>


<?php if ( is_user_logged_in() ) { ?><?php } ?>	
		<p class="front-accent">
<?php $the_query = new WP_Query( 'post_type=page&post_parent=839&posts_per_page=1&orderby=date&order=desc' );
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<span class="black small">Updated <?php echo get_the_date(); ?>:</span>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?> &raquo;</a> 
<?php endwhile; wp_reset_postdata(); ?>


		</p>

	

		</blockquote>

	</div>
</div>

<?php endwhile; endif; ?>





<div id="aside">

<?php include( get_stylesheet_directory() . '/sidebar-explore.php'); ?>

</div>
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
</div>		
    
<?php get_footer(); ?>