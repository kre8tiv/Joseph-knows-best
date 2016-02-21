					    
					<?php if ( has_post_thumbnail() ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0']; ?>
						<div class="introbg background parallax-window fullpage" style="background-image:url(<?php echo $url ?>);" data-parallax="scroll" data-image-src="<?php echo $url ?>"></div>
						<div id="single-intro" style="background-image:url(<?php echo $url ?>);"></div>
					<?php  } else { ?>
						
						
					<? } ?>


						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix inner'); ?> role="article">
			
	
							 
								 
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
										 <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1> 
									</header>
									
								
									<section class="entry-content"><?php the_excerpt(); ?></section>
								

								</article> 					    
				
				