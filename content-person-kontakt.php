								 <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								    <?php if ( has_post_thumbnail() ): ?>
											<?php the_post_thumbnail('thumbnail');  ?>
									<?php endif; ?>								 
								 
									<?php
									$amt =  get_post_meta( $post->ID, 'kr8mb_pers_pos_amt', true );
									$email =  get_post_meta( $post->ID, 'kr8mb_pers_contact_email', true ); 
									$telefon =  get_post_meta( $post->ID, 'kr8mb_pers_contact_telefon', true );  
									 ?>
								 
									 <header class="article-header">							
										 <h3><?php the_title(); ?></h3>
									</header>
																	
								
									<section class="entry-content">
										
										<?php if (! empty ($amt )){ ?><p class="funktion"><?php echo $amt; ?></p><?php } ?>
										<?php if (! empty ($email )){ ?><p><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $email; ?>" title="Schreibe <?php the_title(); ?> eine E-Mail"><?php echo $email; ?></a></p><?php } ?>
										<?php if (! empty ($telefon )){ ?><p><i class="fa fa-phone"></i> <?php echo $telefon; ?></p><?php } ?>
									
									</section>
								

								</article> 	