				<?php get_header(); ?>
			<section id="content"><div class="inner wrap clearfix">				
				<div class="archive-title ninecol first">
						    <h1><?php single_cat_title(); ?><span class="hidden"><?php if( is_paged() ) { echo ' - Seite ' .$paged; }?></span></h1>


						    
						    <?php echo category_description(); ?>
				</div>

				
				<div id="main" class="ninecol first clearfix" role="main">
					
					    <div class="list-article">
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    
					    <?php get_template_part( 'content-list-small', get_post_type() ); ?>
					    		
					
					    <?php endwhile; ?>	
					</div>					
					        <?php if (function_exists('kr8_page_navi')) { ?>
						        <?php kr8_page_navi(); ?>
					        <?php } else { ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(__('&laquo; Ältere Beiträge', "kr8theme")) ?></li>
								        <li class="next-link"><?php previous_posts_link(__('Neuere Beiträge &raquo;', "kr8theme")) ?></li>
							        </ul>
					    	    </nav>
					        <?php } ?>
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    						    <header class="article-header">
    							    <h1><?php _e("Oops, Post Not Found!", "kr8theme"); ?></h1>
    					    	</header>
    						    <section class="entry-content">
    							    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "kr8theme"); ?></p>
        						</section>
    	    					<footer class="article-footer">
    		    				    <p><?php _e("This is the error message in the archive.php template.", "kr8theme"); ?></p>
    			    			</footer>
    				    	</article>
					
					    <?php endif; ?>
			
			
    		</div> <!-- end #main -->
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>
