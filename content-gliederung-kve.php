								 <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								    <?php if ( has_post_thumbnail() ): ?>
											<?php the_post_thumbnail('person');  ?>
									<?php endif; ?>								 
								 
									<?php
									$email =  get_post_meta( $post->ID, 'kr8mb_gli_contact_email', true ); 
									$www =  get_post_meta( $post->ID, 'kr8mb_gli_contact_www', true );  
									$facebook =  get_post_meta( $post->ID, 'kr8mb_gli_contact_facebook', true );  
									$twitter =  get_post_meta( $post->ID, 'kr8mb_gli_contact_twitter', true ); 

									 ?>
								 
									 <header class="article-header">							
										 <h2><?php if (! empty ($www )){ ?><a href="<?php echo $www; ?>" title="Zur Website von <?php the_title(); ?>"><?php } ?><?php the_title(); ?><?php if (! empty ($www )){ ?></a><?php } ?></h2>
									</header>
																	
								
									<section class="entry-content">

										<p class="contact">
											<?php if (! empty ($www )){ ?><a href="<?php echo $www; ?>" title="Zur Website von <?php the_title(); ?>"><i class="fa fa-globe"></i></a><?php } ?>
											<?php if (! empty ($email )){ ?><a href="mailto:<?php echo $email; ?>" title="Schreibe <?php the_title(); ?> eine E-Mail"><i class="fa fa-envelope-o"></i></a><?php } ?>
											<?php if (! empty ($facebook )){ ?><a href="<?php echo $facebook; ?>" title="Zum Facebook-Profil von <?php the_title(); ?>"><i class="fa fa-thumbs-o-up"></i></a><?php } ?>
											<?php if (! empty ($twitter )){ ?><a href="https://twitter.com/<?php echo $twitter; ?>" title="Zum Twitter-Acccount von <?php the_title(); ?>"><i class="fa fa-twitter"></i></a><?php } ?>
											
											
										</p>
									
									</section>
								

								</article> 	