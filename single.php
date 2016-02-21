<?php get_header(); ?>
					
			<section id="content"><div class="inner wrap clearfix">
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
							<?php get_template_part( 'content-single', get_post_type() ); ?>
		
							
		
							<?php endwhile; ?>
					
									
			
					
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>