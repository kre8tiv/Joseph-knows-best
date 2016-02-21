<?php
/*
Template Name: Archiv
*/
?>
<?php get_header(); ?>
			<section id="content"><div class="inner wrap clearfix">			
			<div id="main" class="ninecol first clearfix" role="main">

					     <?php while (have_posts()): the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" >
						
						    <header class="article-header">
							    <h1 class="page-title" itemprop="headline"><?php the_title(); ?><span class="hidden"><?php if( is_paged() ) { echo ' - Seite ' .$paged; }?></span></h1>
						    </header>
					
						    <section class="entry-content clearfix" itemprop="articleBody">
							    <?php the_content(); ?>
							    
							   <div class="archiv">
							   		
							   			<h2>Die letzten 30 Artikel</h2>
							   			<ul class="archiv-posts">
											<?php wp_get_archives('type=postbypost&limit=30'); ?>
										</ul>
							
										<h2>Sortiert nach Monaten</h2>
										<ul class="archiv-month">
											<?php wp_get_archives( array( 'type' => 'monthly')); ?>
										</ul>
							
										<h2>Sortiert nach Kategorien</h2>
										<ul class="archiv-cats">
											<?php wp_list_categories('title_li=&hierarchical=0'); ?>
										</ul>
							
										<h2>Sortiert nach Schlagwörtern</h2>
										<div class="archiv-tags">
											
											<?php wp_tag_cloud( array( 'separator' => ' / ') ); ?>
										</div>
							   
							   </div> 
							    
							</section>
						    
					
					    </article>
					
					    <?php endwhile; ?>
			
    		</div> 
    
			<?php get_sidebar(); ?>		
			</div></section>
			<?php get_footer(); ?>
