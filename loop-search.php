<?php while (have_posts()) : the_post(); ?>
<h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
<p><?php the_excerpt(); ?></p>
<?php endwhile; ?>
