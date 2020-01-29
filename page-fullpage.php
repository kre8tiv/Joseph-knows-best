<?php
/*
Template Name: Einspaltig
*/
?>
<?php get_header(); ?>

			<section id="content"><div class="inner wrap clearfix">
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
							
							
							
					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
							<div class="introbg parallax" style="background-image:url(<?php echo $url ?>);"></div>
						<div id="single-intro" class="parallax" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<?php } ?>
					

					
					
					<div id="main" class="twelvecol first clearfix" role="main">


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
							
								   <header class="article-header">	
					
							    <h1><?php the_title(); ?></h1>
							    
						    </header>
					
						    <section class="entry-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>
							</section>
						    
						    
					
					    </article>
					    
					    <?php comments_template(); ?>
					
					    <?php endwhile; ?>
			
    		</div> 
    

				
			</div></section>
			<?php get_footer(); ?>
