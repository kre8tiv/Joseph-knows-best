
					    
					    



								 <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								    <?php if ( has_post_thumbnail() ): ?>
											<a href="<?php the_permalink(); ?>" class="postimglist"><?php the_post_thumbnail('titelbild');  ?></a>
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
										 <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1> 
									</header>
																		
								
									<section class="article-teaser"><?php the_excerpt(); ?></section>
								

								</article> 					    
				