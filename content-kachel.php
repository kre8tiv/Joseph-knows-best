
					    
					    
					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
						<div class="introbg background parallax-window fullpage" style="background-image:url(<?php echo $url ?>);" data-parallax="scroll" data-image-src="<?php echo $url ?>"></div>
						<div id="single-intro" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<?php } ?>


						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
			
	
	
							<?php if ( has_post_thumbnail() ): ?>
								
							<div class="postimg">	
								

								
								
								<?php 
									$imgexc = get_post(get_post_thumbnail_id())->post_excerpt;
									if ($imgexc != "") {
										?><p class="wp-caption-text"><a href="<?php echo $url ?>" class="fancybox" title="<?php echo $imgexc;?>"><i class="fa fa-picture-o"></i> <?php echo $imgexc;?></a></p><?php 
									} ?>
									
							</div>
							<?php endif; ?>
							 
								 
									 <header class="article-header">
										 <?php the_tags('<p class="subhead">',' ','</p>'); ?>							
										 <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1> 
									</header>
									
								
									<section class="entry-content"><?php the_excerpt(); ?></section>
								

								</article> 					    
				
				