
					    
					    



 <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix postlist'); ?> role="article">
								    <?php if ( has_post_thumbnail() ): ?>
											<a href="	<?php the_permalink(); ?>" class="postimglist"><?php the_post_thumbnail('listenansicht');  ?></a>
									<?php endif; ?>								 
								 
									 <header class="article-header">
										 
										 
										
										 <?php 	$posttags = get_the_tags();
											 	if ($posttags) {
											 		?><p class="subhead"><?php
											 		foreach($posttags as $tag) {
											 		echo '' .$tag->name. ' '; 
										  			}
										  		?></p><?php	
												}
										?>							 							
										 <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2> 
									</header>
																		
								
									<section class="article-teaser"><?php the_excerpt(); ?></section>
								

								</article> 						    
				