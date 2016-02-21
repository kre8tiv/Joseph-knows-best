
<div id="main" class="ninecol first clearfix" role="main">


					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						    

					    <?php if ( has_post_thumbnail() ): ?>
							<div class="postimg">
								
									<a href="<?php echo $url ?>" class="fancybox" title="<?php echo $imgexc;?>"><?php the_post_thumbnail('titelbild');  ?></a>	
								
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
							    
							    <h1>
							    <?php the_title(); ?></h1>
								
								
						    </header>
					

										
										<section class="entry-content clearfix">
											
											
																		
											<div class="socialprofile">
											
												
											<?php $www =  get_post_meta( $post->ID, 'kr8mb_gli_contact_www', true );   
												if (! empty ($www )){ ?><a href="<?php echo $www; ?>"><span class="fa fa-globe"></span></a><?php } ?>	
												
											<?php $email =  get_post_meta( $post->ID, 'kr8mb_gli_contact_email', true );   
												if (! empty ($email )){ ?><a href="mailto:<?php echo $email; ?>"><span class="fa fa-envelope"></span></a><?php } ?>
													
											
											<?php $facebook =  get_post_meta( $post->ID, 'kr8mb_gli_contact_facebook', true );   
												if (! empty ($facebook )){ ?><a href="<?php echo $facebook; ?>"><span class="fa fa-facebook"></span></a><?php } ?>
											
											<?php $twitter =  get_post_meta( $post->ID, 'kr8mb_gli_contact_twitter', true );   
												if (! empty ($twitter )){ ?><a href="https://twitter.com/<?php echo $twitter; ?>"><span class="fa fa-twitter"></span></a><?php } ?>
											
																						
											</div>
											
											
																						
											<?php $anschrift =  get_post_meta( $post->ID, 'kr8mb_gli_contact_anschrift', true );   
												if (! empty ($anschrift )){ ?><div class="anschrift"><?php echo wpautop( $anschrift, $br = 1 ); ?></div><?php } ?>		
											


											
											
											
																						
											<?php the_content(); ?>

											
										</section>
										

						    

							
						   
						   
						    </article> 

</div>