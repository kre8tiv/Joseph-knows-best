<?php
/*
Template Name: Startseite mit Sticky-Posts
*/
?>

			<?php get_header(); ?>	
			<section id="content"><div class="inner wrap clearfix">			
			<?php if (!is_paged()) { ?>
				<div id="teaser" class="clearfix">
				
					<div class="josephbeuys clearfix">
						<?php $args = array(
								'posts_per_page' => 3,
								'post__in'  => get_option( 'sticky_posts' ),
								'ignore_sticky_posts' => 1
							);
							query_posts($args);
						?>
						<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list-home', get_post_format() ); ?>
					    <?php endwhile; ?>	
					 
					</div>
					
				
					

			</div>
			<?php } ?>
			
			<section class="actionbox clearfix">
			<?php dynamic_sidebar('homeone'); ?>
			</section>
			
			

			<div class="ninecol first clearfix" role="main">
				<div class="responsive-tabs home-tabs">
					
					<h2><span>Aktuelles</span></h2>
					<div class="tab clearfix">
					
						
						<?php wp_reset_query(); ?>

    		
					    
						<?php 
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
							elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }
							$postsperpage = get_option('posts_per_page');
							
							query_posts('posts_per_page='. $postsperpage .'&ignore_sticky_posts=1&paged=' . $paged); 
							?>
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list', get_post_format() ); ?>
					    <?php endwhile; ?>	
					   

			
			
    				</div>
    				<h2><span>Termine</span></h2>
    				<div class="tab clearfix">
	    				
	    				<?php echo do_shortcode('[wpcalendar]'); ?>
					</div>
					
					<h2><span>Presse</span></h2>
    				<div class="tab clearfix">
	    				
						<?php wp_reset_query(); ?>

    		
					    
						<?php 
							$postsperpage = get_option('posts_per_page');		
							query_posts('posts_per_page=20&ignore_sticky_posts=1&category_name=presse'); 
							?>
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list-small', get_post_format() ); ?>
					    <?php endwhile; ?>	
					   

					</div>
					
					<h2><span>Beschlüsse</span></h2>
    				<div class="tab clearfix">
	    				
						<?php wp_reset_query(); ?>

    		
					    
						<?php 
							$postsperpage = get_option('posts_per_page');		
							query_posts('posts_per_page=20&ignore_sticky_posts=1&category_name=beschluesse'); 
							?>
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list-small', get_post_format() ); ?>
					    <?php endwhile; ?>	
					</div>
					
					
				</div>
			</div>
			<script>jQuery(document).ready(function() { RESPONSIVEUI.responsiveTabs(); }) </script>
			
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>


