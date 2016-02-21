<?php
/*
Template Name: Listenansicht
*/
?>
<?php get_header(); ?>
					
					
			<section id="content"><div class="inner wrap clearfix">					

							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
							<div class="archive-title ninecol first">
								 <h1><?php the_title(); ?></h1>
								 <?php the_excerpt(); ?>
							
							</div>
							
							
					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
						<div class="introbg background parallax-window" id="start" style="background-image:url(<?php echo $url ?>);" data-parallax="scroll" data-image-src="<?php echo $url ?>"></div>
						<div id="single-intro" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<? } ?>
					

					
					
					<div id="main" class="ninecol first clearfix" role="main">


					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix postsingle'); ?> role="article">
						
						
	
	
							<?php if ( has_post_thumbnail() ): ?>
								
							<div class="postimg">	
								
								<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
								$url = $thumb['0']; ?>
								
								
								<?php 
									$imgexc = get_post(get_post_thumbnail_id())->post_excerpt;
									if ($imgexc != "") {
										?><p class="wp-caption-text"><a href="<?php echo $url ?>" class="fancybox" title="<?php echo $imgexc;?>"><i class="fa fa-picture-o"></i> <?php echo $imgexc;?></a></p><?php 
									} ?>
									
							</div>
							<?php endif; ?>


					

										
										<section class="entry-content clearfix">											
											<?php the_content(); ?>
											<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Seiten:', 'kr8' ), 'after' => '</div>' ) ); ?>
										</section>
										

						    
						   

					</article>
							
							
							 <?php comments_template(); ?>


					</div>

							
		
							
		
							<?php endwhile; ?>
					
									
			
					
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>