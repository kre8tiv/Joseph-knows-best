<?php get_header(); ?>
			
			<section id="content"><div class="inner wrap clearfix">
			
			
					
							<div class="archive-title ninecol first">
								 <h1>Suche</h1>
								 <p><span>Suchergebnisse für:</span> <?php echo esc_attr(get_search_query()); ?></p>
							</div>
			
					<div id="main" class="ninecol first clearfix" role="main">
							<?php get_search_form(); ?>

							<div class="list-article">

					    
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    	<?php get_template_part( 'content-list', get_post_type() ); ?>
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
					
    					    <article id="post-not-found" <?php post_class('clearfix postlist'); ?>>
    					    	<header class="article-header">
    					    		<h2>Keine Ergebnisse.</h2>
    					    	</header>
    					    	<section class="entry-content">
    					    		<p>Es konnte kein Inhalt mit dem verwendeten Suchbegriff gefunden werden.</p>
    					    	</section>

    					    </article>
					</div>
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
    			

					
									
			
					
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>