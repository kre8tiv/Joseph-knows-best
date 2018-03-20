<?php

/*********************
START FUNCTIONS
*********************/

add_action('after_setup_theme','kr8_startup', 15);
// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'kr8_theme_support',16 );


function kr8_startup() {

    // launching operation cleanup
    add_action('init', 'kr8_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'kr8_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'kr8_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'kr8_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'kr8_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'kr8_scripts_and_styles', 999);
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'kr8_ie_conditional', 10, 2 );

    // launching this stuff after theme setup
    add_action('after_setup_theme','kr8_theme_support');
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'kr8_register_sidebars' );
    // adding the kr8 search form (created in theme-sidebars.php)
    add_filter( 'get_search_form', 'kr8_wpsearch' );

    // cleaning up random code around images
    add_filter('the_content', 'kr8_filter_ptags_on_images');
    // cleaning up excerpt
    add_filter('excerpt_more', 'kr8_excerpt_more');
    
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


} /* end */


/*********************
CLEANING UP THE HEAD
*********************/

function kr8_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'kr8_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'kr8_remove_wp_ver_css_js', 9999 );

} /* end */

// remove WP version from RSS
function kr8_rss_version() { return ''; }

// remove WP version from scripts
function kr8_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function kr8_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function kr8_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function kr8_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function kr8_scripts_and_styles() {
  if (!is_admin()) {

    // modernizr (without media query polyfill)
    wp_register_script( 'kr8-modernizr', get_template_directory_uri() . '/lib/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
    wp_register_script( 'kr8-fancybox', get_template_directory_uri() . '/lib/js/libs/fancybox/jquery.fancybox.pack.js', array(), '2.1.4', false );
    wp_register_script( 'kr8-tabs', get_template_directory_uri() . '/lib/js/responsiveTabs.min.js', array(), '2.1.4', false );



    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
    wp_register_script( 'kr8-js', get_template_directory_uri() . '/lib/js/scripts.js', array( 'jquery' ), '', true );
    wp_register_script( 'kr8-waypoints-js', get_template_directory_uri() . '/lib/js/libs/waypoints.js', array( 'jquery' ), '', true );
    
        // register main stylesheet
    wp_register_style( 'kr8-stylesheet', get_template_directory_uri() . '/lib/css/style.css', array(), '', 'all' );
    wp_register_style( 'kr8-fontawesome', get_template_directory_uri() . '/lib/css/font-awesome.min.css', array(), '', 'all' );
    wp_register_style( 'kr8-fancycss', get_template_directory_uri() . '/lib/js/libs/fancybox/fancybox.min.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'kr8-ie-only', get_template_directory_uri() . '/lib/css/ie.css', array(), '' );

    // enqueue styles and scripts
    wp_enqueue_script( 'kr8-modernizr' );
    wp_enqueue_style( 'kr8-fontawesome' );
    wp_enqueue_style( 'kr8-stylesheet' );
    wp_enqueue_style( 'kr8-fancycss' );
    wp_enqueue_style( 'kr8-fancybuttoncss' );
    wp_enqueue_style('kr8-ie-only');
    /*
    I recommend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'kr8-waypoints-js' );
    wp_enqueue_script( 'kr8-js' );
    wp_enqueue_script( 'kr8-fancybox' );
    wp_enqueue_script( 'kr8-tabs' );
    
    

    

  }
}


// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function kr8_ie_conditional( $tag, $handle ) {
	if ( 'kr8-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}


/*********************
PERFORMANCE
*********************/

class WP_HTML_Compression {
    protected $compress_css = true;
    protected $compress_js = true;
    protected $info_comment = true;
    protected $remove_comments = true;
 
    protected $html;
    public function __construct($html) {
      if (!empty($html)) {
		    $this->parseHTML($html);
	    }
    }
    public function __toString() {
	    return $this->html;
    }
    protected function bottomComment($raw, $compressed) {
	    $raw = strlen($raw);
	    $compressed = strlen($compressed);		
	    $savings = ($raw-$compressed) / $raw * 100;		
	    $savings = round($savings, 2);		
	    return '<!-- HTML Minify | /snippets/html-minify/ | Größe reduziert um '.$savings.'% | Von '.$raw.' Bytes, auf '.$compressed.' Bytes -->';
    }
    protected function minifyHTML($html) {
	    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
	    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
	    $overriding = false;
	    $raw_tag = false;
	    $html = '';
	    foreach ($matches as $token) {
		    $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
		    $content = $token[0];
		    if (is_null($tag)) {
			    if ( !empty($token['script']) ) {
				    $strip = $this->compress_js;
			    }
			    else if ( !empty($token['style']) ) {
				    $strip = $this->compress_css;
			    }
			    else if ($content == '<!--wp-html-compression no compression-->') {
				    $overriding = !$overriding;
				    continue;
			    }
			    else if ($this->remove_comments) {
				    if (!$overriding && $raw_tag != 'textarea') {
					    $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
				    }
			    }
		    }
		    else {
			    if ($tag == 'pre' || $tag == 'textarea') {
				    $raw_tag = $tag;
			    }
			    else if ($tag == '/pre' || $tag == '/textarea') {
				    $raw_tag = false;
			    }
			    else {
				    if ($raw_tag || $overriding) {
					    $strip = false;
				    }
				    else {
					    $strip = true;
					    $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
					    $content = str_replace(' />', '/>', $content);
				    }
			    }
		    }
		    if ($strip) {
			    $content = $this->removeWhiteSpace($content);
		    }
		    $html .= $content;
	    }
	    return $html;
    }
    public function parseHTML($html) {
	    $this->html = $this->minifyHTML($html);
	    if ($this->info_comment) {
		    $this->html .= "\n" . $this->bottomComment($html, $this->html);
	    }
    }
    protected function removeWhiteSpace($str) {
	    $str = str_replace("\t", ' ', $str);
	    $str = str_replace("\n",  '', $str);
	    $str = str_replace("\r",  '', $str);
	    while (stristr($str, '  ')) {
		    $str = str_replace('  ', ' ', $str);
	    }
	    return $str;
    }
}
function wp_html_compression_finish($html) {
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
}
//add_action('get_header', 'wp_html_compression_start');


/*Kommentare deaktivieren */
function disable_comments_status()
	{
	return false;
	}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);
function disable_comments_post_types_support()
	{
	$post_types = get_post_types();
	foreach($post_types as $post_type)
		{
		if (post_type_supports($post_type, 'comments'))
			{
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
			}
		}
	}
add_action('admin_init', 'disable_comments_post_types_support');
function disable_comments_hide_existing_comments($comments)
	{
	$comments = array();
	return $comments;
	}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);
function disable_comments_admin_menu()
	{
	remove_menu_page('edit-comments.php');
	}
add_action('admin_menu', 'disable_comments_admin_menu');
function disable_menus_admin_bar_render()
	{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	}
add_action('wp_before_admin_bar_render', 'disable_menus_admin_bar_render');


/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function kr8_theme_support() {

	// wp thumbnails
	add_theme_support('post-thumbnails');

	// default thumb size
	add_image_size( 'thumbnail', 500, 500,true );
	add_image_size( 'medium', 400, 600,false );
	add_image_size( 'large', 1200, 1800, false );
	
	add_image_size( 'titelbild', 1200, 900, false );
	add_image_size( 'listenansicht', 350, 260, true );
	
	
	
	update_option('thumbnail_size_w', 500);
	update_option('thumbnail_size_h', 500);
	update_option('medium_size_w', 400);
	update_option('medium_size_h', 600);
	update_option('large_size_w', 1200);
	update_option('large_size_h', 1800);
	
	//add_image_size( 'slider', 300, 300, true  );



  

	// rss thingy
	add_theme_support('automatic-feed-links');

                

	// adding post format support
	
	add_theme_support( 'post-formats',
		array(
			//'aside',             // title less blurb
			//'gallery',           // gallery of images
			//'link',              // quick link to other site
			//'image',             // an image
			//'quote',             // a quick quote
			'status',            // a Facebook like status update
			//'video',             // video
			//'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'nav-main' => __( 'Hauptmenü', '' ),   // main
			'nav-footer' => __( 'Links in der Fußleiste', '' ), // secondary
			'nav-mobile' => __( 'Menü für Mobilgeräte', '' ), // social
			'nav-social' => __( 'Soziale Netzwerke', '' ) // social
		)
	);
} /* end kr8 theme support */




/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function kr8_nav_main() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container	
    	'menu_class' => 'navigation clearfix',         // adding custom nav class
    	'theme_location' => 'nav-main',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 3,                                   // limit the depth of the nav
    	'fallback_cb' => 'kr8_main_nav_fallback'      // fallback function
	));
} /* end kr8 main nav */

// the main menu
function kr8_nav_mobile() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container	
    	'menu_class' => 'navigation clearfix',         // adding custom nav class
    	'theme_location' => 'nav-mobile',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 3,                                   // limit the depth of the nav
	));
} /* end kr8 main nav */

// the footer menu (should you choose to use one)
function kr8_nav_footer() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                         // remove nav container
    	'menu_class' => 'navigation clearfix nav-footer',          // adding custom nav class
    	'theme_location' => 'nav-footer',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 1,                                   // limit the depth of the nav
    	'fallback_cb' => 'kr8_nav_footer_fallback'   // fallback function
	));
} /* end kr8 footer link */

// the social menu (should you choose to use one)
function kr8_nav_social() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                         // remove nav container
    	'menu_class' => 'navigation clearfix nav-social',          // adding custom nav class
    	'theme_location' => 'nav-social',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 1,                                   // limit the depth of the nav
    	'fallback_cb' => ''   // fallback function
	));
} /* end kr8 social link */




// this is the fallback for header menu
function kr8_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'navigation nav-fallback clearfix',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function kr8_nav_footer_fallback() {
	/* you can put a default here if you like */
}



/*********************
ADMIN PREVIEW
*********************/

//Editor-Stylesheet
function kr8_add_editor_styles() {
    add_editor_style( 'lib/css/editor.css' );
}
add_action( 'after_setup_theme', 'kr8_add_editor_styles' );


//Custom Styles in Editor
function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


function kr8_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Absatz Einleitung',  
			'block' => 'p',  
			'classes' => 'intro',
			'wrapper' => false,
			
		),  
		array(  
			'title' => 'Link - Button',  
			'block' => 'span',  
			'classes' => 'button',
			'wrapper' => true,
		),
		array(  
			'title' => 'Überschrift - Kontrast',  
			'block' => 'span',  
			'classes' => 'kontrast',
			'wrapper' => true,
		),
		
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'kr8_mce_before_init_insert_formats' );  




/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using kr8_related_posts(); )
function kr8_related_posts() {
	echo '<section id="related-posts" class="posttab">';
	global $post;
	$categories = get_the_tags($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
			'tag__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 3, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
			);
        $related_posts = get_posts($args);
        if($related_posts) {
        	foreach ($related_posts as $post) : setup_postdata($post); ?>
	           	<?php get_template_part( 'content-list', get_post_format() ); ?>
	        <?php endforeach; }
	    else { 
		    
		    $args=array(
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 3, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
			);
			
			$all_posts = get_posts($args);
			if($all_posts) {
        	foreach ($all_posts as $post) : setup_postdata($post); ?>
	           	<?php get_template_part( 'content', get_post_format() ); ?>
	        <?php endforeach; }

		    
		    
		     }
	}
	wp_reset_query();
	echo '</section>';
} /* end kr8 related posts function */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using kr8_related_posts(); )
function kr8_newest_posts() {
	echo '<section id="newest-posts" class="posttab">';
	global $post;

		    
		    $args=array(
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 3, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
			);
			
			$all_posts = get_posts($args);
			if($all_posts) {
        	foreach ($all_posts as $post) : setup_postdata($post); ?>
	           	<?php get_template_part( 'content', get_post_format() ); ?>
	        <?php endforeach; }

		    
		    
	     
	
	wp_reset_query();
	echo '</section>';
} /* end kr8 related posts function */



/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function kr8_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ol class="kr8_page_navi clearfix">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = __( "Anfang", 'kr8theme' );
		echo '<li class="kr8pn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'"><span class="fa fa-angle-double-left"></span></a></li>';
	}
	echo '<li class="kr8pn-prev-link">';
	previous_posts_link('<span class="fa fa-angle-left"></span>');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="kr8pn-current">'.$i.'</li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="kr8pn-next-link">';
	next_posts_link('<span class="fa fa-angle-right"></span>');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = __( "Ende", 'kr8theme' );
		echo '<li class="kr8pn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'"><span class="fa fa-angle-double-right"></span></a></li>';
	}
	echo '</ol></nav>'.$after."";
} /* end page navi */


/*********************
IMAGES
*********************/





// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function kr8_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


//Lightbox Image-Link
add_filter('the_content', 'addlightboxrel_replace');
function addlightboxrel_replace ($content)
{	global $post;
	$postid = get_the_ID();
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1class="fancybox" rel="gallery'. $postid .'" href=$2$3.$4$5$6>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="fancybox" rel="gallery'. $postid .'"',$html);
    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);

/* 10px Image-Margins entfernen */
class fixImageMargins {
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'

    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();





/*********************
SOCIAL SHARE
*********************/
function kr8_socialshare() { ?>
	
    <div class="sharewrap">
		<p class="calltoshare">
			<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink() ?>" class="twitter" title="Artikel twittern" rel="nofollow"><i class="fa fa-twitter"></i><span>Twitter</span></a>
			<a href="whatsapp://send?abid=256&text=Schau%20Dir%20das%20mal%20an%3A%20<?php the_permalink(); ?>" class="whatsapp" title="Per WhatsApp verschicken" rel="nofollow"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a>
			<a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>" class="facebook" title="Auf Facebook teilen" rel="nofollow"><i class="fa fa-thumbs-o-up"></i><span>Facebook</span></a>
			<a href="https://plus.google.com/share?url=<?php the_permalink() ?>" class="google" rel="nofollow"><i class="fa fa-google-plus"></i><span>Google+</span></a>
			<a href="mailto:?subject=Das musst Du lesen: <?php echo rawurlencode(get_the_title()); ?>&body=Hey, schau Dir das mal den Artikel auf <?php bloginfo('name'); ?> an: <?php the_permalink(); ?>" title="Per E-Mail weiterleiten" class="email" rel="nofollow"><i class="fa fa-envelope"></i><span>E-Mail</span></a>
		</p>
	</div>	
	
	
	
<? }
						    
		



/*********************
RANDOM CLEANUP ITEMS
*********************/

// This removes the annoying […] to a Read More link
function kr8_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function kr8_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

/*Deregister Contact Form 7 Styles */
//add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
	function deregister_cf7_styles() {

		
			wp_deregister_style( 'contact-form-7' );
		
	}






?>