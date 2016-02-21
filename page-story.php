<?php
/*
Template Name: Story
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
						    

			<?php get_footer(); ?>