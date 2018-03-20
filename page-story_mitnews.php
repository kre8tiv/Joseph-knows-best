<?php
/*
Template Name: Story mit aktuellen Tabs
*/
?>
			<?php get_header(); ?>
			
			
			<?php if ( has_post_thumbnail() ): 
				
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$url = $thumb['0']; ?>
				<div class="fullpage parallax" style="background-image:url(<?php echo $url ?>);" data-parallax="scroll" data-image-src="<?php echo $url ?>">
					
					
					<div class="story-intro">
							<div class="inner">
							<h1><?php the_title(); ?></h1>
							<p><?php the_excerpt(); ?></p>
							</div>
					</div>
					

				</div>
				
				<?php $vz =  get_post_meta( $post->ID, 'kr8mb_page_story_vz', true );   
					if (! empty ($vz )){ ?><nav class="inhaltvz"><h6 class="hidden">Inhaltsverzeichnis dieses Artikels</h6><ul><?php echo $vz; ?></ul></nav><?php } ?>	

				
			<?php endif; ?>
			
							
					<?php while (have_posts()): the_post(); ?>
					
					    <article id="inhalt"><div class="inner">
													    <?php the_content(); ?>


				
					    </div></article>	
			 <?php endwhile; ?>
			 			    
			 <section id="content"><div class="inner wrap clearfix">			
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