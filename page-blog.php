<?php
/*
Template Name: Artikel-Archiv
*/
?>
<?php get_header(); ?>
					
	
			
			
			<section id="content"><div class="inner wrap clearfix">
				
				
							<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
							<div class="archive-title ninecol first">
								 <h1><?php the_title(); ?></h1>
								 <?php the_excerpt(); ?>
							
							</div>
							<?php endwhile; ?>
				
				<div id="main" class="ninecol first clearfix" role="main">

					    <?php wp_reset_query(); ?>

    		
	
							<?php 
								
								if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
								elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
								else { $paged = 1; }
								
								$postsperpage = get_option('posts_per_page');
								$args = array(
								'category_name' => 'aktuelles',
								'posts_per_page' => $postsperpage,
								'paged' => $paged,
								'ignore_sticky_posts' => 1
							);
							query_posts($args);
						?>
					    		
					    <div class="list-article">
	
					
					    		
    		
    					<?php while ( have_posts() ) : the_post(); ?>
					    	<?php get_template_part( 'content-list', get_post_format() ); ?>
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
					
					

			
			
    		</div> <!-- end #main -->
					
			
					
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>