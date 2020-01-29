<?php
/*
Template Name: Startseite aktuellen Mitteilungen, Terminen und PMs
*/
?>

			<?php get_header(); ?>	
			<section id="content"><div class="inner wrap clearfix">			
			<?php if (!is_paged()) { ?>
			
			
					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
							<div class="introbg parallax fullpage" style="background-image:url(<?php echo $url ?>);"></div>
						<div id="single-intro" class="parallax" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<?php } ?>

					
					
			
			
				<div id="teaser" class="clearfix">
				<div class="josephbeuys">
					<?php dynamic_sidebar('hometeaser'); ?>
				</div>
				
					

			</div>
			<?php } ?>
			
			
			<!-- <section class="actionbox clearfix">
			<?php /* dynamic_sidebar('homeone'); */ ?>
			</section>
			-->
			

			<div class="ninecol first clearfix" role="main">
				<div class="responsive-tabs home-tabs">
					
					<h2><span>Aktuelles</span></h2>
					<div class="tab clearfix">
					
						
						<?php wp_reset_query(); ?>

    		
	
							<?php 
								$postsperpage = get_option('posts_per_page');
								$args = array(
								'posts_per_page' => 3,
								'post__in'  => get_option( 'sticky_posts' ),
								'posts_per_page' => $postsperpage,
								'ignore_sticky_posts' => 1
							);
							query_posts($args);
						?>
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list', get_post_format() ); ?>
					    <?php endwhile; ?>	
					   
					
					<p><span class="button"><a href="archiv">Alle Nachrichten im Archiv »</a></span></p>
			
			
    				</div>
    				<h2><span>Termine</span></h2>
    				<div class="tab clearfix">
	    				
	    				<?php echo do_shortcode('[wpcalendar anzahl="5"]'); ?>
					</div>
					
					<h2><span>Presse</span></h2>
    				<div class="tab clearfix">
	    				
						<?php wp_reset_query(); ?>

    		
					    
						<?php 
							$postsperpage = get_option('posts_per_page');		
							query_posts('posts_per_page=7&ignore_sticky_posts=1&category_name=presse'); 
							?>
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list-small', get_post_format() ); ?>
					    <?php endwhile; ?>	
					   

					</div>
					

					
					
				</div>
			</div>
			<script>jQuery(document).ready(function() { RESPONSIVEUI.responsiveTabs(); }) </script>
			
			<div id="sidebar1" class="sidebar threecol last clearfix homebar" role="complementary">
			<?php dynamic_sidebar('hometwo'); ?>
			</div>
			
				
			</div></section>
			<?php get_footer(); ?>


