


					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
							<div class="introbg parallax" style="background-image:url(<?php echo $url ?>);"></div>
						<div id="single-intro" class="parallax" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<?php } ?>
					

					
					
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
							
								   <header class="article-header">	
									   
									   
									   
							    			
										 <?php 	$posttags = get_the_tags();
											 	$count=0;
											 	if ($posttags) {
											 		?><p class="subhead"><?php
											 		foreach($posttags as $tag) {
												 		$count++;
												 			if (1 == $count) {
												 		echo '' .$tag->name. ' '; 
										  			} }
										  		?></p><?php	
												}?>						
							    <h1>1<?php the_title(); ?></h1>
							    
						    </header>

					
						    
						    		<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>		
										 <section class="entry-content clearfix">
											<?php the_excerpt(); ?>
										</section> 
							
										<?php else : ?>
										
										<section class="entry-content clearfix">											
											<?php the_content(); ?>
											<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Seiten:', 'kr8' ), 'after' => '</div>' ) ); ?>
										</section>
										
										<?php endif; ?>
						    
						   
						   <!-- Autor -->
							<?php if ( get_post_format() ) : ?>	
							<?php else: ?>
								<?php if ( get_the_author_meta( 'description' ) ) : ?>
								<div class="author cleafix">
										
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
										<div class="author-description">
											<h3><?php the_author_posts_link(); ?></h3>
											<p><?php the_author_meta( 'description' ); ?></p>
										</div>		
									</div>
								<?php endif; ?>
							<?php endif; ?>
						   
						   <footer>
							    <p class="byline">Veröffentlicht am <time class="updated" datetime="<?php echo the_time('c'); ?>"><?php the_time('j. F Y')?>.</time></p>
						   </footer>
						   
						   <?php if (function_exists('kr8_socialshare')) { ?>
						        <?php kr8_socialshare(); ?>
					        <?php } ?>
						   
						   
						    </article> 
						   
						   
						   

							
							
							<?php comments_template( '', true ); ?>


					</div>
						    