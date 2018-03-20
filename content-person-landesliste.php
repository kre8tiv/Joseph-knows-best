								 <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								    <?php if ( has_post_thumbnail() ): ?>
											<?php the_post_thumbnail('thumbnail');  ?>
									<?php endif; ?>								 
								 
									<?php
									$nr =  get_post_meta( $post->ID, 'kr8mb_pers_pos_listenplatz', true );
									$email =  get_post_meta( $post->ID, 'kr8mb_pers_contact_email', true ); 
									$www =  get_post_meta( $post->ID, 'kr8mb_pers_contact_www', true );  
									$facebook =  get_post_meta( $post->ID, 'kr8mb_pers_contact_facebook', true );  
									$twitter =  get_post_meta( $post->ID, 'kr8mb_pers_contact_twitter', true ); 
									$instagram =  get_post_meta( $post->ID, 'kr8mb_pers_contact_instagram', true );
									$wahlkreis =  get_post_meta( $post->ID, 'kr8mb_pers_pos_wahlkreis', true ); 
									$motivation =  get_post_meta( $post->ID, 'kr8mb_pers_motivation', true ); 
									$details =  get_post_meta( $post->ID, 'kr8mb_pers_pos_details', true );
									 ?>
								 
									 <?php if (! empty ($nr )){ ?><p class="listenplatz"><?php echo $nr; ?></p><?php } ?>
									 <header class="article-header">							
										 <h3><?php the_title(); ?></h3>
									</header>
																	
								
									<section class="entry-content">
										
										
										<?php if (! empty ($wahlkreis )){ ?><p class="short"><?php echo $wahlkreis; ?></p><?php } ?>
										
										<?php if (! empty ($motivation )){ ?><p class="motivation"><?php echo $motivation; ?></p><?php } ?>
										
										<p class="contact">
											<?php if (! empty ($www )){ ?><a href="<?php echo $www; ?>" title="Zur Website von <?php the_title(); ?>"><i class="fa fa-globe"></i></a><?php } ?>
											<?php if (! empty ($facebook )){ ?><a href="<?php echo $facebook; ?>" title="Zum Facebook-Profil von <?php the_title(); ?>"><i class="fa fa-thumbs-o-up"></i></a><?php } ?>
											<?php if (! empty ($twitter )){ ?><a href="https://twitter.com/<?php echo $twitter; ?>" title="Zum Twitter-Acccount von <?php the_title(); ?>"><i class="fa fa-twitter"></i></a><?php } ?>
											<?php if (! empty ($instagram )){ ?><a href="<?php echo $instagram; ?>" title="Zum Instagram-Acccount von <?php the_title(); ?>"><i class="fa fa-instagram"></i></a><?php } ?>
											<?php if (! empty ($email )){ ?><a href="mailto:<?php echo $email; ?>" title="Schreibe <?php the_title(); ?> eine E-Mail"><i class="fa fa-envelope-o"></i></a><?php } ?>
											
										</p>
										<?php if ( $details == "yes"){ ?><p class="details"><a href="<?php the_permalink(); ?>" title="Mehr Details über <?php the_title(); ?>">Details »</a></p><?php } ?>
									
									</section>
								

								</article> 	