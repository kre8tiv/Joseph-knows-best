<?php


//************KÖPFE************//

add_action( 'init', 'create_heads' );
function create_heads() {
  $labels = array(
    'name' => _x('Personen', 'post type general name'),
    'singular_name' => _x('Person', 'post type singular name'),
    'add_new' => _x('Neue hinzufügen', 'Personen'),
    'add_new_item' => __('Neue Person hinzufügen'),
    'edit_item' => __('Person bearbeiten'),
    'new_item' => __('Neue Person'),
    'view_item' => __('Person anschauen'),
    'search_items' => __('Person suchen'),
    'not_found' =>  __('Keine Person gefunden'),
    'not_found_in_trash' => __('Keine Person im Papierkorb gefunden'),
    'parent_item_colon' => ''
  );
 
  $supports = array('title', 'editor', 'revisions', 'thumbnail');
 
  register_post_type( 'person',
    array(
      'labels' => $labels,
      'public' => true,
      'menu_icon' => 'dashicons-id-alt',
      'supports' => $supports
    )
  );
}


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_heads_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_heads_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Abteilungen', 'taxonomy general name' ),
		'singular_name'     => _x( 'Abteilung', 'taxonomy singular name' ),
		'search_items'      => __( 'Abteilungen suchen' ),
		'all_items'         => __( 'Alle Abteilungen' ),
		'parent_item'       => __( 'Übergeordnete Abteilung' ),
		'parent_item_colon' => __( 'Übergeordnete Abteilung:' ),
		'edit_item'         => __( 'Abteilung bearbeiten' ),
		'update_item'       => __( 'Abteilung aktualisieren' ),
		'add_new_item'      => __( 'Abteilung anlegen' ),
		'new_item_name'     => __( 'Name der Abteilung' ),
		'menu_name'         => __( 'Abteilungen' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'abteilung' ),
	);

	register_taxonomy( 'abteilung', array( 'person' ), $args );

}



//************GLIEDERUNGEN************//

add_action( 'init', 'create_structure' );
function create_structure() {
  $labels = array(
    'name' => _x('Gliederungen', 'post type general name'),
    'singular_name' => _x('Gliederung', 'post type singular name'),
    'add_new' => _x('Neue hinzufügen', 'Personen'),
    'add_new_item' => __('Neue Gliederung hinzufügen'),
    'edit_item' => __('Gliederung bearbeiten'),
    'new_item' => __('Neue Gliederung'),
    'view_item' => __('Gliederung anschauen'),
    'search_items' => __('Gliederung suchen'),
    'not_found' =>  __('Keine Gliederung gefunden'),
    'not_found_in_trash' => __('Keine Gliederung im Papierkorb gefunden'),
    'parent_item_colon' => ''
  );
 
  $supports = array('title', 'editor', 'revisions','excerpt');
 
  register_post_type( 'gliederung',
    array(
      'labels' => $labels,
      'public' => true,
      'menu_icon' => 'dashicons-store',
      'supports' => $supports
    )
  );
}


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_structure_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_structure_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Strukturen', 'taxonomy general name' ),
		'singular_name'     => _x( 'Struktur', 'taxonomy singular name' ),
		'search_items'      => __( 'Suche Struktur' ),
		'all_items'         => __( 'Alle Strukturen' ),
		'parent_item'       => __( 'Übergeordnete Struktur' ),
		'parent_item_colon' => __( 'Übergeordnete Strukture:' ),
		'edit_item'         => __( 'Struktur bearbeiten' ),
		'update_item'       => __( 'Struktur aktualisieren' ),
		'add_new_item'      => __( 'Struktur hinzufügen' ),
		'new_item_name'     => __( 'Name  der Struktur' ),
		'menu_name'         => __( 'Strukturen' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'struktur' ),
	);

	register_taxonomy( 'struktur', array( 'gliederung' ), $args );

}


?>