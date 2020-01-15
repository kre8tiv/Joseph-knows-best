<?php
/*
Template Name: Landingpage
*/
?>
<?php get_header(); ?>

	<?php 	$themen =  get_post_meta( $post->ID, 'kr8mb_page_themen_id', true );  
			$format =  get_post_meta( $post->ID, 'kr8mb_page_format_id', true );  ?> 
			
	<section id="content"><div class="inner wrap clearfix">			
			
		<?php if ( has_post_thumbnail() ) {
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url = $thumb['0']; ?>
				<div class="introbg parallax" style="background-image:url(<?php echo $url; ?>);"></div>
				<div id="landing-intro" class="parallax" style="background-image:url(<?php echo $url; ?>);">
		<?php  } else { ?>
				<div id="landing-intro" >
		<?php } ?>
					
					<div  class="landing-teaser twelvecol first clearfix">
						<header>
							<h1 class="landing-title" itemprop="headline"><span><?php the_title(); ?><span class="hidden"><?php if( is_paged() ) { echo ' - Seite ' .$paged; }?></span></span></h1>
						</header>				
					</div>
				</div>
			
				<div class="twelvecol first">
					
					<?php if (!is_paged()) { ?>
					
						<div id="main" role="main" class="clearfix">
						
							<?php while (have_posts()): the_post(); ?>
						
								<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
									<section class="entry-content clearfix" itemprop="articleBody">
										<?php the_content(); ?>
									</section>
									
								</article>
									
							<?php endwhile; ?>
							
						</div>
						
					<?php } ?> 
				
					<?php if ($themen !="") { ?>
					
						<div class="clearfix landingnews">
								
							<?php wp_reset_query(); ?>
		
							<?php 	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
									elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
									else { $paged = 1; }
									
									$postsperpage = get_option('posts_per_page');
									
									query_posts('tag=' . $themen . '&posts_per_page='. $postsperpage .'&paged=' . $paged . '&category_name=' . $format);  ?>
										
							<?php while ( have_posts() ) : the_post(); ?>
								
								<?php get_template_part( 'content-list', get_post_format() ); ?>
									
							<?php endwhile; ?>	
							
						</div>
						
						<?php if (function_exists('kr8_page_navi')) { ?>
							<?php kr8_page_navi(); ?>
						<?php } else { ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link(__('&laquo; Ältere Beiträge', "kr8theme")) ?></li>
									<li class="next-link"><?php previous_posts_link(__('Neuere Beiträge &raquo;', "kr8theme")) ?></li>
								</ul>
							</nav>
						<?php } ?>
					
					<?php } ?> 
					
				</div> <!-- end #main -->

			</div>
	
	</section>
		
<?php get_footer(); ?>