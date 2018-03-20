<?php 

//Alle Bildgrößen Verfügbar machen
add_filter( 'image_size_names_choose', 'sir_image_sizes_choose' );

function sir_image_sizes_choose( $Sizes ) {
    global $_wp_additional_image_sizes;

    $CustomSizes = array();

    foreach ( $_wp_additional_image_sizes as $Key => $Value ) {
        $CustomSizes[ $Key ] = ucwords( str_replace( '-', ' ', $Key ) );
    }

    return array_merge( $CustomSizes, $Sizes  );
}
	
// sidebars
if ( function_exists('register_sidebars') )
	register_sidebars(0);

if (!function_exists('kr8_register_sidebars')) {
	function kr8_register_sidebars() {
		if ( function_exists('register_sidebar') ) {

			register_sidebar(array(
				'name' => 'Infospalte',
				'description'   => 'Infospalte für Widgets. Wird auf den meisten Seiten angezeigt.',
				'id' => 'infospalte',
				'before_widget' => "\n\t\t" . '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => "\n\t" . '<h3 class="widgettitle">',
				'after_title' => '</h3>',
			));

			
			register_sidebar(array(
				'name' => 'Startseite - Artikel',
				'description'   => 'Artikel auf der Startseite',
				'id' => 'hometeaser',
				'before_widget' => "\n\t\t" . '<article id="%1$s" class="clearfix %2$s">',
				'after_widget' => '</article>',
				'before_title' => "\n\t" . '<h1>',
				'after_title' => '</h1>',
			));
			
			
			
			register_sidebar(array(
				'name' => 'Kampagnenseite - Actionbox',
				'description'   => 'Drei Widgets: Werde aktiv',
				'id' => 'campaignone',
				'before_widget' => "\n\t\t" . '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => "\n\t" . '<h3>',
				'after_title' => '</h3>',
			));	
			
			register_sidebar(array(
				'name' => 'Kampagnenseite - Infobox',
				'description'   => 'Drei Widgets: Erfahre mehr',
				'id' => 'campaigntwo',
				'before_widget' => "\n\t\t" . '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => "\n\t" . '<h3>',
				'after_title' => '</h3>',
			));				
			
			
			register_sidebar(array(
				'name' => 'Startseite - Infoleiste',
				'description'   => 'Infospalte der Startseite',
				'id' => 'hometwo',
				'before_widget' => "\n\t\t" . '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => "\n\t" . '<h3>',
				'after_title' => '</h3>',
			));			
		
			
			register_sidebar(array(
				'name' => 'Presse',
				'description'   => 'Widgets in der Kategory Presse',
				'id' => 'presse',
				'before_widget' => "\n\t\t" . '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => "\n\t" . '<h3 class="widgettitle">',
				'after_title' => '</h3>',
			));
			
			register_sidebar(array(
				'name' => 'Fussleiste',
				'description'   => 'Platz für Widgets in der Fußleiste.',
				'id' => 'fussleiste',
				'before_widget' => "\n\t\t" . '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => "\n\t" . '<h3 class="widgettitle">',
				'after_title' => '</h3>',
			));

			
			
		}
	}
	
	
}


/************* SEARCH FORM LAYOUT *****************/

function kr8_wpsearch($form) {
        $form = '<section class="suche"><h6 class="unsichtbar">Suchformular</h6><form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
    <span class="searchlabel"><label for="search">Der Suchbegriff nach dem die Website durchsucht werden soll.</label></span>
    <input type="text" name="s" class="seachphrase" value="' . get_search_query() . '" placeholder="Suchbegriff eingeben ..." aria-labelledby="suche searchlabel"/>
    <button type="submit" class="button-submit">
                <span class="fa fa-search"></span> <span class="text">Suchen</span>
            </button>
    </form></section>';
    return $form;
} 


/************* SOCIAL MEDIA WIDGET *****************/
 class kr8_socialmedia extends WP_Widget {

	function kr8_socialmedia() {
		$widget_ops = array('description' => 'Links zu deinen Profilen in den Sozialen Netzwerken.');

		parent::WP_Widget(false, __('Social Media Links'),$widget_ops);
	}

	function widget($args, $instance) {  
		extract( $args );
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$flickr = $instance['flickr'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$pinterest = $instance['pinterest'];
		$soundcloud = $instance['soundcloud'];
		$foursquare = $instance['foursquare'];
		$xing = $instance['xing'];
		$tumblr = $instance['tumblr'];
		$rss = $instance['rss'];
		$rsscomments = $instance['rsscomments'];
		
		
		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widgettitle">'.$title.'</h3>'; ?>

        <ul class="sociallinks">
			<?php 
			if($twitter != '') {
				echo '<li><a href="https://twitter.com/'.$twitter.'" title="Twitter"><span class="fa fa-fw fa-twitter"></span><span class="hidden">Twitter</span></a></li>';
			}
			?>

			<?php 
			if($facebook != '') {
				echo '<li><a href="'.$facebook.'"title="Facebook"><span class="fa fa-fw fa-facebook"></span><span class="hidden">Facebook</span></a></li>';
			}
			?>

			<?php 
			if($googleplus != '') {
				echo '<li><a href="'.$googleplus.'" title="Google+"><span class="fa fa-fw fa-google-plus"></span><span class="hidden">Google+</span></a></li>';
			}
			?>

			<?php if($flickr != '') {
				echo '<li><a href="'.$flickr.'" title="Flickr"><span class="fa fa-fw fa-flickr"></span><span class="hidden">Flickr</span></a></li>';
			}
			?>
			
			<?php if($instagram != '') {
				echo '<li><a href="'.$instagram.'" title="Instagram"><span class="fa fa-fw fa-instagram"></span><span class="hidden">Instagram</span></a></li>';
			}
			?>

			<?php if($youtube != '') {
				echo '<li><a href="'.$youtube.'" title="YouTube"><span class="fa fa-fw fa-youtube"></span><span class="hidden">YouTube</span></a></li>';
			}
			?>

			<?php if($vimeo != '') {
				echo '<li><a href="'.$vimeo.'" title="Vimeo"><span class="fa fa-fw fa-vimeo-square"></span><span class="hidden">Vimeo</span></a></li>';
			}
			?>

			<?php if($soundcloud != '') {
				echo '<li><a href="'.$soundcloud.'" title="Soundcloud"><span class="fa fa-fw fa-soundcloud"></span><span class="hidden">Soundcloud</span></a></li>';
			}
			?>

			<?php if($foursquare != '') {
				echo '<li><a href="'.$foursquare.'" title="Foursquare"><span class="fa fa-fw fa-foursquare"></span><span class="hidden">Foursquare</span></a></li>';
			}
			?>
			
			<?php if($pinterest != '') {
				echo '<li><a href="'.$pinterest.'" title="Pinterst"><span class="fa fa-fw fa-pinterest"></span><span class="hidden">Pinterest</span></a></li>';
			}
			?>

			<?php if($xing != '') {
				echo '<li><a href="'.$xing.'" title="Xing"><span class="fa fa-fw fa-xing"></span><span class="hidden">Xing</span></a></li>';
			}
			?>
			
			<?php if($tumblr != '') {
				echo '<li><a href="'.$tumblr.'" title="Tumblr"><span class="fa fa-fw fa-tumblr"></span><span class="hidden">Tumblr</span></a></li>';
			}
			?>
    
			<?php if($rss != '') {
				echo '<li><a href="'.$rss.'" title="RSS Feed"><span class="fa fa-fw fa-rss"></span><span class="hidden">RSS Feed</span></a></li>';
			}
			?>

			<?php if($rsscomments != '') {
				echo '<li><a href="'.$rsscomments.'" title="RSS Comments"><span class="fa fa-fw fa-comments-o"></span><span class="hidden">RSS Comments</span></a></li>';
			}
			?>

		</ul><!-- end .sociallinks -->

	   <?php			
	   echo $after_widget;
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) { 
		$title = esc_attr($instance['title']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$googleplus = esc_attr($instance['googleplus']);
		$flickr = esc_attr($instance['flickr']);
		$instagram = esc_attr($instance['instagram']);
		$youtube = esc_attr($instance['youtube']);
		$vimeo = esc_attr($instance['vimeo']);
		$pinterest = esc_attr($instance['pinterest']);
		$soundcloud = esc_attr($instance['soundcloud']);
		$foursquare = esc_attr($instance['foursquare']);
		$tumblr = esc_attr($instance['tumblr']);
		$xing = esc_attr($instance['xing']);
		$rss = esc_attr($instance['rss']);
		$rsscomments = esc_attr($instance['rsscomments']);

		
		?>

		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter-Benutzername:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $googleplus; ?>" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
        </p>
		  
		 <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instagram; ?>" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('Soundcloud URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('soundcloud'); ?>" value="<?php echo $soundcloud; ?>" class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('Foursquare URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('foursquare'); ?>" value="<?php echo $foursquare; ?>" class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" />
        </p>


		<p>
            <label for="<?php echo $this->get_field_id('xing'); ?>"><?php _e('Xing URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('xing'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
        </p>
		
				
		
		<p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS-Feed URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>
		
		<p>
            <label for="<?php echo $this->get_field_id('rsscomments'); ?>"><?php _e('RSS for Comments URL:'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rsscomments'); ?>" value="<?php echo $rsscomments; ?>" class="widefat" id="<?php echo $this->get_field_id('rsscomments'); ?>" />
        </p>

       
		<?php
	}
} 




/************* TEASER ARTIKEL WIDGET *****************/

class kr8_teaserarticle extends WP_Widget 
{

	//Einstellungen
	public function __construct() 
	{
		parent::__construct(
			'kr8_teaserarticle',
			'Teaser',
			array(
				'description' => 'Artikel zur Anzeige'
			)
	    );
	}

	//Admin Area
	public function form($instance) 
		{
			$defaults = array(
				'title' => '',
				'day_interval' => '30', 
				'limit' => '5'
		    );
		    $instance = wp_parse_args((array)$instance, $defaults);
	
		    $title = $instance['title'];
		    $url = $instance['url'];
		    $subhead = $instance['subhead'];
		    $desc = $instance['desc'];
		    $image_id = $instance['image_id'];
		    $image_size = $instance['image_size'];
		    $image_url = $instance['image_url'];
		    
		    ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo 'Titel:'; ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php echo 'URL:'; ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('subhead'); ?>"><?php echo 'Dachzeile:'; ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('subhead'); ?>" name="<?php echo $this->get_field_name('subhead'); ?>" type="text" value="<?php echo esc_attr($subhead); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('desc'); ?>"><?php echo 'Beschreibung:'; ?></label> 
				<textarea  class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_attr($desc); ?></textarea>

			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'image_id' ); ?>"><?php echo 'Bild:'; ?></label> 	
				<input class="title_image" id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" value="<?php echo $image_id ?>" type="hidden">
				
				
				<button id="title_image_button" class="button" onclick="image_button_click('Bild auswählen','Bild wählen','image','image_id_preview','<?php echo $this->get_field_id( 'image_id' );  ?>');">Aus Medien-DB wählen</button>
										
			</p>

					
		
				<p><label for="<?php echo $this->get_field_id('image_size'); ?>">Größe:</label>
					<select name="<?php echo $this->get_field_name('image_size'); ?>" id="<?php echo $this->get_field_id('image_size'); ?>" onChange="imageWidget.toggleSizes( '<?php echo $this->id; ?>', '<?php echo $id_prefix; ?>' );">
						<?php
						// Note: this is dumb. We shouldn't need to have to do this. There should really be a centralized function in core code for this.
						$possible_sizes = apply_filters( 'image_size_names_choose', array(
							'full'      => __('Full Size', 'image_widget'),
							'thumbnail' => __('Thumbnail', 'image_widget'),
							'medium'    => __('Medium', 'image_widget'),
							'large'     => __('Large', 'image_widget'),
						) );

		
						foreach( $possible_sizes as $size_key => $size_label ) { ?>
							<option value="<?php echo $size_key; ?>"<?php selected( $instance['image_size'], $size_key ); ?>><?php echo $size_label; ?></option>
							<?php } ?>
					</select>

				<?php $imgparse= wp_get_attachment_image_src( $image_id, $image_size, false); 
				
				$img_url = $imgparse[0];
					
				?> 
				<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="hidden" value="<?php echo $img_url; ?>" />
				</p>
				<p>
				<?php 
					if ($image_id!='') echo '<img src="' . $imgparse[0] . '" style="max-width:100%;height:auto;">';
				?>
				</p>
							
				<p>
					<input class="checkbox" type="checkbox" <?php checked($instance['show_desc'], 'on'); ?> id="<?php echo $this->get_field_id('show_desc'); ?>" name="<?php echo $this->get_field_name('show_desc'); ?>" /> 
					<label for="<?php echo $this->get_field_id('show_desc'); ?>">Überschrift in Desktop-Version ausblenden.</label>
				</p>


			
			

			<script>
				
					var frame;
				 
				 	function image_button_click(dialog_title, button_text, library_type, preview_id, control_id) {
				        
				        event.preventDefault();
				 
				        //If the uploader object has already been created, reopen the dialog
				        //if (custom_uploader) {
				         //   custom_uploader.open();
				        //    return;
				        //}
				 		
				        //Extend the wp.media object
				        frame = wp.media.frames.file_frame = wp.media({
				            title: dialog_title,
				            button: {
				                text: button_text
				            },
							//library : { type : library_type }, 
							library : { type : 'image' },  
							//frame:      'post',        
				            multiple: false
				        });

				        
				        
				        //When a file is selected, grab the URL and set it as the text field's value
				        frame.on('close', function() {
				            
				            attachment = frame.state().get('selection').first().toJSON();
				            //attachment = custom_uploader.state().get('selection').toJSON();
				            jQuery('#' + control_id).val(attachment.id);
				            
				            var html = '';
				            
				            if (library_type=='image') {
				            	html = '<img src="' + attachment.url + '">';
				            }
				            
				            if (library_type=='video') {
				            	html = '<video autoplay loop><source src="' + attachment.url + '" type="video/' + get_extension( attachment.url ) + '" /></video>';
				            }
				            
				            jQuery('#' + preview_id).empty();
				            jQuery('#' + preview_id).append(html);
				        });
				        
       
				 		
				 		//Open the uploader dialog
				        frame.open();
				        return false;
				        
				    }
				    
				    function get_extension( url ){			    
				    	return url.substr((url.lastIndexOf('.') + 1));				    
				    }
					
		</script>			

			<?php
		}

	//Save Data
	public function update($new_instance, $old_instance) 
		{
			$instance = array();
			
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['url'] = strip_tags($new_instance['url']);
			$instance['subhead'] = strip_tags($new_instance['subhead']);
			$instance['desc'] = strip_tags($new_instance['desc']);
			$instance['image_id'] = strip_tags($new_instance['image_id']);
			$instance['image_size'] = strip_tags($new_instance['image_size']);
			$instance['image_url'] = strip_tags($new_instance['image_url']);
			$instance['show_desc'] = $new_instance['show_desc'];
	
			return $instance;
		}


	//Frontend Output
	public function widget($args, $instance) 
		{
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$url = $instance['url'];
			$subhead = $instance['subhead'];
			$desc = $instance['desc'];
			$img = $instance['image_url'];
			$show_desc = $instance['show_desc'] ? 'true' : 'false';
	
			echo $before_widget;
			
			
			if('on' == $instance['show_desc'] ) {
								echo '<div class="nodesc">';
			}

						
			if(!empty($img))
			{
				if(!empty($url)) { echo '<a href="'. $url .'" title="'.$title.'" class="postimglist">';}
				echo '<img src="'. $img .'" alt="'. $title .'" class="wp-post-image">';
				if(!empty($url)) { echo '</a>';}
			}
			
			

			if(!empty($subhead))
			{
				echo '<p class="subhead">'. $subhead .'</p>';
			}
			
			if(!empty($title))
			{
				echo $before_title;
				if(!empty($url)) { echo '<a href="'. $url .'" title="'.$title.'">';}
				echo $title;
				if(!empty($url)) { echo '</a>';}
				echo $after_title;
			}
			

			
			if(!empty($desc))
			{
				echo '<p>'. $desc .'</p>';
			}
			
			if('on' == $instance['show_desc'] ) {
								echo '</div>';
			}

			
						
			echo $after_widget;
		}
}

add_action( 'widgets_init', function(){
     register_widget('kr8_teaserarticle');
     register_widget('kr8_socialmedia');
});






?>