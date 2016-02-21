
		<article id="post-<?php the_ID(); ?>" <?php post_class('postlist-small'); ?>>
			
			<header><p class="artikelinfo"><time datetime="<?php the_time('c'); ?>"><?php the_time('j. F Y'); ?></time></p>
				<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"> <?php 	$posttags = get_the_tags();
											 	$count=0;
											 	if ($posttags) {
											 		?><span><?php
											 		foreach($posttags as $tag) {
												 		$count++;
												 			if (1 == $count) {
												 		echo '' .$tag->name. ' '; 
										  			} }
										  		?></span><?php	
												}?>				 <?php the_title(); ?></a></h2>
			</header>
			<aside>
				
			</aside>
				
			 
		
		</article>
		
