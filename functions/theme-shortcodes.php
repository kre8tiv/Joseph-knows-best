<?php

//SHORTCODES
function kr8_sitemap() {

//get current page ID
$the_id = get_the_ID();

	$smargs = array(
		'child_of'     => $the_id,
		'title_li'     => '',
		'parent'       => $the_id,
		'sort_order'	=> 'ASC',
		'sort_column'	=> 'menu_order'
	);

	$smitem = get_pages( $smargs );



foreach($smitem as $value){

	$thumb = get_the_post_thumbnail( $value->ID, 'thumbnail', $attr = '' );
	$children .= "<li>";
	$children .= "<a href='" . $value->post_name . "' >" . $thumb . "</a>";
	$children .= "<p><a href='" . $value->post_name . "' >" .  $value->post_title . "</a>";
	$children .= "<span>" .  $value->post_excerpt . "</span></p>";
	$children .= "</li>";
} 


 return '<nav><ul class="sitemap sitemap-thumb">' . $children . '</ul></nav>';



}
add_shortcode('unterseiten', 'kr8_sitemap');


//Excerpt for Pages
add_post_type_support( 'page', 'excerpt' );


//Tabs for Editor ***************
function tabs_shortcode( $atts, $content = null ) {
	
	if ( comments_open() || have_comments() ) {
		return '<div class="responsive-tabs content-tabs">' . do_shortcode($content) . '</div>';
	}
	else {
		
		return '<div class="responsive-tabs content-tabs">' . do_shortcode($content) . '</div><script>jQuery(document).ready(function() { RESPONSIVEUI.responsiveTabs(); }) </script>';
		
	}
}
add_shortcode( 'tabs', 'tabs_shortcode' );

function tab_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
      'title' => 'Titel anpassen',
   ), $atts));
	return '<h2>' .$title .'</h2><div>' . do_shortcode($content) . '</div>';
}
add_shortcode( 'tab', 'tab_shortcode' );



add_filter("the_content", "the_content_filter");

function the_content_filter($content) {

	// array of custom shortcodes requiring the fix 
	$block = join("|",array("col","tabs","tab"));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

	return $rep;

}








//Query Heads ***************



function person_mandat($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_listenplatz',
							'abteilung' => $abteilung,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_listenplatz',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="personen-list mandate-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-person-mandat', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("mandate", "person_mandat");



function person_liste($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_listenplatz',
							'abteilung' => $abteilung,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_listenplatz',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="personen-list mandate-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-person-landesliste', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("landesliste", "person_liste");


function person_vorstand($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_sortierung',
							'abteilung' => $abteilung,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_sortierung',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="personen-list mandate-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-person-vorstand', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("vorstand", "person_vorstand");



function person_glv($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_sortierung',
							'abteilung' => $abteilung,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_sortierung',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="personen-list mandate-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-person-glv', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("glv", "person_glv");


function person_team($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_sortierung',
							'abteilung' => $abteilung,
							
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_sortierung',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}
	
	$wp_query->query($args);
	ob_start();
	?>
	
	<section class="personen-list team-list clearfix">
	
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	
		<?php get_template_part( 'content-person-team', '' ); ?>
	
	<?php endwhile; ?>

	</section>


	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("team", "person_team");




function person_kontakt($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"person" => '',
		"abteilung" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($person)){
			$person = explode(',', $person);
			$args = array(
							'post_type' => 'person',
							'post__in' => $person,
							'order' => 'ASC',
							'orderby' => 'meta_value',
							'meta_key' => 'kr8mb_pers_pos_listenplatz',
							'abteilung' => $abteilung,
							
			);
	}
	else {
		
			$args = array(
					'post_type' => 'person',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kr8mb_pers_pos_listenplatz',
					'abteilung' => $abteilung,
					'posts_per_page' => -1,
			);
		
	}
	
	$wp_query->query($args);
	ob_start();
	?>
	
	<section class="personen-list kontakt-list clearfix">
	
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
	
		<?php get_template_part( 'content-person-kontakt', '' ); ?>
	
	<?php endwhile; ?>

	</section>


	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("kontakt", "person_kontakt");




//Query Structure ***************



function gliederung_kve($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"gliederung" => '',
		"struktur" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($gliederung)){
			$gliederung = explode(',', $gliederung);
			$args = array(
							'post_type' => 'gliederung',
							'post__in' => $gliederung,
							'order' => 'ASC',
							'orderby' => 'title',
							'struktur' => $struktur,
							'posts_per_page' => -1,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'gliederung',
					'order' => 'ASC',
					'orderby' => 'title',
					'struktur' => $struktur,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="gliederungen-list kve-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-gliederung-kve', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("gliederungen", "gliederung_kve");



function gliederung_lagen($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"gliederung" => '',
		"struktur" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();

	if(!empty($gliederung)){
			$gliederung = explode(',', $gliederung);
			$args = array(
							'post_type' => 'gliederung',
							'post__in' => $gliederung,
							'order' => 'ASC',
							'orderby' => 'title',
							'struktur' => $struktur,
							'posts_per_page' => -1,
			);
	}
	else {
		
			$args = array(
					'post_type' => 'gliederung',
					'order' => 'ASC',
					'orderby' => 'title',
					'struktur' => $struktur,
					'posts_per_page' => -1,
			);
		
	}	
	$wp_query->query($args);
	ob_start();

	?>
	
	<section class="gliederungen-list lagen-list clearfix">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php get_template_part( 'content-gliederung-lagen', '' ); ?>
	<?php endwhile; ?>
	</section>



	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("arbeitsgemeinschaften", "gliederung_lagen");


//PARALLAX ***************
function section_shortcode( $atts ) {
	
		   
		extract(shortcode_atts(array(
			"vollbild" => '',
			"hintergrundfarbe" => '',
			"schriftfarbe" => '',
			"id" => '',
			"bgscroll" => '',
			"hintergrundbild" => ''
		), $atts));
	

		if ($vollbild !== '') {
			$class1 .= 'fullpage';
		} else {
					$class1 .= 'textblock ';
		}
		
		if ($bgscroll !== '') {
			$class3 .= 'bgscroll';
		}
		
		if ($hintergrundbild !== '') {
			$class2 .= 'parallax';

		}
		
		return '</div></article><article id="'.$id.'" class="'.$class1.' '.$class2.' '.$class3.'" style="background-color:#'.$hintergrundfarbe.';color:#'.$schriftfarbe.'; background-image: url('.$hintergrundbild.');"><div class="inner">';

}
add_shortcode( 'parallax', 'section_shortcode' );


//ICON ***************
function icon_shortcode( $atts ) {
	
		   
		extract(shortcode_atts(array(
			"symbol" => 'fa-rocket',
			"groesse" => 'fa-4x',
		), $atts));

		
		return '<p class="icon"><span class="fa '.$symbol.' '.$groesse.'"></span></p>';

}
add_shortcode( 'icon', 'icon_shortcode' );


function section_abstand( $atts ) {
	


		
		return '<div class="abstand"></div>';

}
add_shortcode( 'abstand', 'section_abstand' );


//INFOBOX ***************
function infobox_shortcode( $atts, $content = null ) {
	
		   
		extract(shortcode_atts(array(
			"title" => 'Infobox',
		), $atts));

		
		return '<div class="infobox"><h3>'.$title.'</h3>'.$content.'</div>';

}
add_shortcode( 'infobox', 'infobox_shortcode' );

//BOXEN ***************
function colorbox_shortcode( $atts, $content = null ) {
	
		   

		
		return '<div class="colorbox">'.$content.'</div>';

}
add_shortcode( 'box', 'colorbox_shortcode' );




?>
