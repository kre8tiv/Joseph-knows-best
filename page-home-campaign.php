<?php
/*
Template Name: Startseite - Kampagnen
*/
?>

			<?php get_header(); ?>	
			
			
				<?php if ( has_post_thumbnail() ): 
				
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$url = $thumb['0']; ?>
				<div class="fullpage parallax" style="background-image:url(<?php echo $url ?>);">
						<div class="introbg parallax fullpage" style="background-image:url(<?php echo $url ?>);"></div>

					
					
					<div class="story-intro">
							<div class="inner">
							<h1><?php the_title(); ?></h1>
							<p><?php the_excerpt(); ?></p>
							
							
				<?php $cta =  get_post_meta( $post->ID, 'kr8mb_page_campaign_cta', true );   
					if (! empty ($cta )){ ?><p class="cta"><?php echo $cta; ?></p><?php } ?>	


							
							</div>
					</div>
					

				</div>
				
								
			<?php endif; ?>
			
			
			<div class="inner wrap clearfix">	
				
				
					<div id="donatenow" class="clearfix">
						<h2>Spenden</h2>
						<a href="/spenden#betrag=100">100 €</a>
						<a href="/spenden#betrag=50">50 €</a>
						<a href="/spenden#betrag=20">20 €</a>
					</div>
					
					
				<div id="getmore">
						<h2>Erfahre mehr</h2>
						
						<div class="sidebar clearfix involvebar" role="complementary">
						<?php dynamic_sidebar('campaigntwo'); ?>
						</div>
						
				</div>	
						
				
			</div>
			

					
					
			
			<div id="teaser" class="parallax" style="background-image:url(<?php echo get_template_directory_uri(); ?>/lib/images/bg_trees.jpg);">
					<div class="inner wrap clearfix sylvia">
						<div class="josephbeuys">
							<?php dynamic_sidebar('hometeaser'); ?>
						</div>
					</div>
			</div>
			
			
				<section id="content"><div class="inner wrap clearfix">	
			
				
				
				<div id="getinvolved">
					<h2>Werde aktiv</h2>
					
					<div class="sidebar clearfix involvebar" role="complementary">
					<?php dynamic_sidebar('campaignone'); ?>
					</div>
					
				</div>	
			

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
	    				
	    				<?php echo do_shortcode('[wpcalendar anzahl="5" kat="kampagne"]'); ?>
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


