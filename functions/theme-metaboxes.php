<?php
	

add_action( 'add_meta_boxes', 'kr8mb_add' );
function kr8mb_add()
{
	
	global $post;
	$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
    add_meta_box( 'kr8mb_pers_contact', 'Kontaktdaten', 'kr8mb_pers_contact_cb', 'person', 'normal', 'high' );
    add_meta_box( 'kr8mb_pers_position', 'Infos & Ämter', 'kr8mb_pers_position_cb', 'person', 'normal', 'high' );
     add_meta_box( 'kr8mb_gli_contact', 'Kontaktdaten', 'kr8mb_gli_contact_cb', 'gliederung', 'normal', 'high' );
     if(!empty($post)) {
	 	if($pageTemplate == 'page-landingpage.php' ) {
	 		add_meta_box( 'kr8mb_page_themen', 'Kategorien', 'kr8mb_page_themen_cb', 'page', 'normal', '' );
   		}
   		
   		if($pageTemplate == 'page-landingpage-small.php' ) {
	 		add_meta_box( 'kr8mb_page_themen', 'Kategorien', 'kr8mb_page_themen_cb', 'page', 'normal', '' );
   		}
   	
   		if($pageTemplate == 'page-story.php' ) {
	 		add_meta_box( 'kr8mb_page_story', 'Inhalt', 'kr8mb_page_story_cb', 'page', 'normal', '' );
   		}
   	
   	 }
}




/** SEITEN: Themen **/
function kr8mb_page_themen_cb($post)
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $themenid = isset( $values['kr8mb_page_themen_id'] ) ? esc_attr( $values['kr8mb_page_themen_id'][0] ) : '';
    $formatid = isset( $values['kr8mb_page_format_id'] ) ? esc_attr( $values['kr8mb_page_format_id'][0] ) : '';


    
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <table class="form-table"><tbody>
    <tr>
	    <th scope="row"><label for="kr8mb_page_themen_id">Thema (Schlagwort)</label></th>
        <td><input type="text" name="kr8mb_page_themen_id" id="kr8mb_page_themen_id" value="<?php echo $themenid; ?>" /><br><span class="description">Der Slug der Schlagworte, die angezeigt werden sollen. <br>Mehrere Schlagworte durch Komma trennen, z.B. "umwelt,klima".</span></td>
        <th scope="row"><label for="kr8mb_page_format_id">Format (Kategorie)</label></th>
                <td><input type="text" name="kr8mb_page_format_id" id="kr8mb_page_format_id" value="<?php echo $formatid; ?>" /><br><span class="description">Der Slug der Kategorien, die angezeigt werden sollen. <br>Mehrere Kategorien durch Komma trennen, z.B. "presse,beschluesse".</span></td>
    </tr>
     
    </tbody></table>
    <?php    
}


add_action( 'save_post', 'kr8mb_page_themen_save' );
function kr8mb_page_themen_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
	if( isset( $_POST['kr8mb_page_themen_id'] ) )
        update_post_meta( $post_id, 'kr8mb_page_themen_id', wp_kses( $_POST['kr8mb_page_themen_id'], $allowed ) );
       
    if( isset( $_POST['kr8mb_page_format_id'] ) )
        update_post_meta( $post_id, 'kr8mb_page_format_id', wp_kses( $_POST['kr8mb_page_format_id'], $allowed ) );

  
                 
}



/** SEITEN: Story **/
function kr8mb_page_story_cb($post)
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $vz = isset( $values['kr8mb_page_story_vz'] ) ? esc_attr( $values['kr8mb_page_story_vz'][0] ) : '';


    
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <table class="form-table"><tbody>
    <tr>
	    <th scope="row"><label for="kr8mb_page_story_vz">Menüpunkte</label></th>
        <td><textarea type="text" name="kr8mb_page_story_vz" id="kr8mb_page_story_vz" rows="5" cols="50"><?php echo $vz; ?></textarea><br><span class="description">Menüelemente für das Inhaltsverzeichnis. Nutze: li a. </span></td>
    </tr>
     
    </tbody></table>
    <?php    
}


add_action( 'save_post', 'kr8mb_page_story_save' );
function kr8mb_page_story_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'li' => $default_attribs,
        'a' => array()
    );
    
        // now we can actually save the data
    $allowed = array( 
        'li' => array(),
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
	if( isset( $_POST['kr8mb_page_story_vz'] ) )
        update_post_meta( $post_id, 'kr8mb_page_story_vz', wp_kses( $_POST['kr8mb_page_story_vz'], $allowed ) );
  
                 
}


	

/** PERSONEN: Kontaktdaten **/

function kr8mb_pers_contact_cb($post)
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $www = isset( $values['kr8mb_pers_contact_www'] ) ? esc_attr( $values['kr8mb_pers_contact_www'][0] ) : '';
    $email = isset( $values['kr8mb_pers_contact_email'] ) ? esc_attr( $values['kr8mb_pers_contact_email'][0] ) : '';
	$facebook = isset( $values['kr8mb_pers_contact_facebook'] ) ? esc_attr( $values['kr8mb_pers_contact_facebook'][0] ) : '';
	$twitter = isset( $values['kr8mb_pers_contact_twitter'] ) ? esc_attr( $values['kr8mb_pers_contact_twitter'][0] ) : '';
	$anschrift = isset( $values['kr8mb_pers_contact_anschrift'] ) ? esc_html( $values['kr8mb_pers_contact_anschrift'][0] ) : '';
	$telefon = isset( $values['kr8mb_pers_contact_telefon'] ) ? esc_html( $values['kr8mb_pers_contact_telefon'][0] ) : '';
	$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
	$check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : '';

    
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <table class="form-table"><tbody>
    <tr>
	    <th scope="row"><label for="kr8mb_pers_contact_www">Website</label></th>
        <td><input type="text" name="kr8mb_pers_contact_www" id="kr8mb_pers_contact_www" value="<?php echo $www; ?>" /><br><span class="description">Inklusive http:// Beispiel: http://domain.de.</span></td>

	    <th scope="row"><label for="kr8mb_pers_contact_email">E-Mail</label></th>
        <td><input type="text" name="kr8mb_pers_contact_email" id="kr8mb_pers_contact_email" value="<?php echo $email; ?>" /><br><span class="description">vorname.nachname@domain.de</span></td>
    </tr>
    <tr>
	    <th scope="row"><label for="kr8mb_pers_contact_facebook">Facebook</label></th>
        <td><input type="text" name="kr8mb_pers_contact_facebook" id="kr8mb_pers_contact_facebook" value="<?php echo $facebook; ?>" /><br><span class="description">Vollständiger Link zum Facebook-Profil, inkl. http://</span></td>
	    <th scope="row"><label for="kr8mb_pers_contact_twitter">Twitter</label></th>
        <td><input type="text" name="kr8mb_pers_contact_twitter" id="kr8mb_pers_contact_twitter" value="<?php echo $twitter; ?>" /><br><span class="description">Nur der Twitter-Nutzername ohne @, z.b. gruenenrw.</span></td>
    </tr>    
    <tr>
	    <th scope="row"><label for="kr8mb_pers_contact_anschrift">Anschrift</label></th>
        <td><textarea name="kr8mb_pers_contact_anschrift" id="kr8mb_pers_contact_anschrift"><?php echo $anschrift; ?></textarea><br><span class="description">Platz für Anschrift, Telefon, Fax, etc.</span></td>
        <th scope="row"><label for="kr8mb_pers_contact_telefon">Telefon</label></th>
        <td><input type="text" name="kr8mb_pers_contact_telefon" id="kr8mb_pers_contact_telefon" value="<?php echo $telefon; ?>" /><br><span class="description">Telefonnummer, Form: +49 (211) 222 333 -11</span></td>
    </tr>
     
    </tbody></table>
    <?php    
}




add_action( 'save_post', 'kr8mb_pers_contact_save' );
function kr8mb_pers_contact_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
	if( isset( $_POST['kr8mb_pers_contact_www'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_www', wp_kses( $_POST['kr8mb_pers_contact_www'], $allowed ) );
	if( isset( $_POST['kr8mb_pers_contact_email'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_email', wp_kses( $_POST['kr8mb_pers_contact_email'], $allowed ) );
	if( isset( $_POST['kr8mb_pers_contact_facebook'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_facebook', wp_kses( $_POST['kr8mb_pers_contact_facebook'], $allowed ) );
    if( isset( $_POST['kr8mb_pers_contact_twitter'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_twitter', wp_kses( $_POST['kr8mb_pers_contact_twitter'], $allowed ) );
    if( isset( $_POST['kr8mb_pers_contact_telefon'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_telefon', wp_kses( $_POST['kr8mb_pers_contact_telefon'], $allowed ) );  
    if( isset( $_POST['kr8mb_pers_contact_anschrift'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_contact_anschrift', esc_html( $_POST['kr8mb_pers_contact_anschrift'] ) );   
        
                 
}




/** PERSONEN: Positionen **/

function kr8mb_pers_position_cb($post)
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $excerpt = isset( $values['kr8mb_pers_excerpt'] ) ? esc_html( $values['kr8mb_pers_excerpt'][0] ) : '';
    $amt = isset( $values['kr8mb_pers_pos_amt'] ) ? esc_attr( $values['kr8mb_pers_pos_amt'][0] ) : '';
    $listenplatz = isset( $values['kr8mb_pers_pos_listenplatz'] ) ? esc_attr( $values['kr8mb_pers_pos_listenplatz'][0] ) : '';
    $sortierung = isset( $values['kr8mb_pers_pos_sortierung'] ) ? esc_attr( $values['kr8mb_pers_pos_sortierung'][0] ) : '';
    $wahlkreis = isset( $values['kr8mb_pers_pos_wahlkreis'] ) ? esc_attr( $values['kr8mb_pers_pos_wahlkreis'][0] ) : '';
    $kr8mb_pers_pos_details = $custom["kr8mb_pers_pos_details"][0];


    
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <table class="form-table"><tbody>
    <tr>
	    <th scope="row"><label for="kr8mb_pers_excerpt">Kurzbeschreibung</label></th>
        <td><textarea name="kr8mb_pers_excerpt" id="kr8mb_pers_excerpt"><?php echo $excerpt; ?></textarea><br><span class="description">Kurzbeschreibung, im Idealfall in 140 Zeichen.</span></td>
    </tr>
    <tr>
	    <th scope="row"><label for="kr8mb_pers_pos_amt">Amt/Mandat</label></th>
        <td><input type="text" name="kr8mb_pers_pos_amt" id="kr8mb_pers_pos_amt" value="<?php echo $amt; ?>" /><br><span class="description">Sprecherfunktion, o.Ä.</span></td>

	    <th scope="row"><label for="kr8mb_pers_pos_listenplatz">Listenplatz</label></th>
        <td><input type="text" name="kr8mb_pers_pos_listenplatz" id="kr8mb_pers_pos_listenplatz" value="<?php echo $listenplatz; ?>" /><br><span class="description">Der Listenplatz, z.B. "02", "10", "43". Mandate werden danach sortiert.</span></td>
    </tr>
     <tr>
	    <th scope="row"><label for="kr8mb_pers_pos_wahlkreis">Wahlkreis</label></th>
        <td><input type="text" name="kr8mb_pers_pos_wahlkreis" id="kr8mb_pers_pos_wahlkreis" value="<?php echo $wahlkreis; ?>" /><br><span class="description">z.B. "Aachen II".</span></td>

	    <th scope="row"><label for="kr8mb_pers_pos_details">Link zur Detailseite</label></th>
        <td><input type="checkbox" name="kr8mb_pers_pos_details" id="kr8mb_pers_pos_details" value="yes" <?php if ( isset ( $values['kr8mb_pers_pos_details'] ) ) checked( $values['kr8mb_pers_pos_details'][0], 'yes' ); ?> /><br><span class="description">Link zur Detailseite in der Übersicht anzeigen.</span></td>
    </tr>
    
         <tr>
	    <th scope="row"><label for="kr8mb_pers_pos_sortierung">Sortierung</label></th>
        <td><input type="text" name="kr8mb_pers_pos_sortierung" id="kr8mb_pers_pos_sortierung" value="<?php echo $sortierung; ?>" /><br><span class="description">Sortierung für MA und Vorstand, z.B. "02", "10", "43".</span></td>


            


    </tr>
    
    </tbody></table>
    <?php    
}



add_action( 'save_post', 'kr8mb_pers_position_save' );
function kr8mb_pers_position_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
	if( isset( $_POST['kr8mb_pers_excerpt'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_excerpt', esc_html( $_POST['kr8mb_pers_excerpt'] ) );   

	if( isset( $_POST['kr8mb_pers_pos_amt'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_pos_amt', wp_kses( $_POST['kr8mb_pers_pos_amt'], $allowed ) );
	if( isset( $_POST['kr8mb_pers_pos_listenplatz'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_pos_listenplatz', wp_kses( $_POST['kr8mb_pers_pos_listenplatz'], $allowed ) );
    if( isset( $_POST['kr8mb_pers_pos_wahlkreis'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_pos_wahlkreis', wp_kses( $_POST['kr8mb_pers_pos_wahlkreis'], $allowed ) );
    if( isset( $_POST[ 'kr8mb_pers_pos_details' ] ) ) {
		    update_post_meta( $post_id, 'kr8mb_pers_pos_details', 'yes' );
		} else {
		    update_post_meta( $post_id, 'kr8mb_pers_pos_details', 'no' );
		}   
	if( isset( $_POST['kr8mb_pers_pos_sortierung'] ) )
        update_post_meta( $post_id, 'kr8mb_pers_pos_sortierung', wp_kses( $_POST['kr8mb_pers_pos_sortierung'], $allowed ) );
    
    
    

}




/** GLIEDERUNGEN: Kontaktdaten **/

function kr8mb_gli_contact_cb($post)
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $www = isset( $values['kr8mb_gli_contact_www'] ) ? esc_attr( $values['kr8mb_gli_contact_www'][0] ) : '';
    $email = isset( $values['kr8mb_gli_contact_email'] ) ? esc_attr( $values['kr8mb_gli_contact_email'][0] ) : '';
	$facebook = isset( $values['kr8mb_gli_contact_facebook'] ) ? esc_attr( $values['kr8mb_gli_contact_facebook'][0] ) : '';
	$twitter = isset( $values['kr8mb_gli_contact_twitter'] ) ? esc_attr( $values['kr8mb_gli_contact_twitter'][0] ) : '';
	$anschrift = isset( $values['kr8mb_gli_contact_anschrift'] ) ? esc_html( $values['kr8mb_gli_contact_anschrift'][0] ) : '';
	$telefon = isset( $values['kr8mb_gli_contact_telefon'] ) ? esc_html( $values['kr8mb_gli_contact_telefon'][0] ) : '';
	$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
	$check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'][0] ) : '';

    
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <table class="form-table"><tbody>
    <tr>
	    <th scope="row"><label for="kr8mb_gli_contact_www">Website</label></th>
        <td><input type="text" name="kr8mb_gli_contact_www" id="kr8mb_gli_contact_www" value="<?php echo $www; ?>" /><br><span class="description">Inklusive http:// Beispiel: http://domain.de.</span></td>

	    <th scope="row"><label for="kr8mb_gli_contact_email">E-Mail</label></th>
        <td><input type="text" name="kr8mb_gli_contact_email" id="kr8mb_gli_contact_email" value="<?php echo $email; ?>" /><br><span class="description">vorname.nachname@domain.de</span></td>
    </tr>
    <tr>
	    <th scope="row"><label for="kr8mb_gli_contact_facebook">Facebook</label></th>
        <td><input type="text" name="kr8mb_gli_contact_facebook" id="kr8mb_gli_contact_facebook" value="<?php echo $facebook; ?>" /><br><span class="description">Vollständiger Link zum Facebook-Profil, inkl. http://</span></td>
	    <th scope="row"><label for="kr8mb_gli_contact_twitter">Twitter</label></th>
        <td><input type="text" name="kr8mb_gli_contact_twitter" id="kr8mb_gli_contact_twitter" value="<?php echo $twitter; ?>" /><br><span class="description">Nur der Twitter-Nutzername ohne @, z.b. gruenenrw.</span></td>
    </tr>    
    <tr>
	    <th scope="row"><label for="kr8mb_gli_contact_anschrift">Anschrift</label></th>
        <td><textarea name="kr8mb_gli_contact_anschrift" id="kr8mb_gli_contact_anschrift"><?php echo $anschrift; ?></textarea><br><span class="description">Platz für Anschrift, Telefon, Fax, etc.</span></td>
        <th scope="row"><label for="kr8mb_gli_contact_telefon">Telefon</label></th>
        <td><input type="text" name="kr8mb_gli_contact_telefon" id="kr8mb_gli_contact_telefon" value="<?php echo $telefon; ?>" /><br><span class="description">Telefonnummer, Form: +49 (211) 222 333 -11</span></td>
    </tr>
     
    </tbody></table>
    <?php    
}




add_action( 'save_post', 'kr8mb_gli_contact_save' );
function kr8mb_gli_contact_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
	if( isset( $_POST['kr8mb_gli_contact_www'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_www', wp_kses( $_POST['kr8mb_gli_contact_www'], $allowed ) );
	if( isset( $_POST['kr8mb_gli_contact_email'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_email', wp_kses( $_POST['kr8mb_gli_contact_email'], $allowed ) );
	if( isset( $_POST['kr8mb_gli_contact_facebook'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_facebook', wp_kses( $_POST['kr8mb_gli_contact_facebook'], $allowed ) );
    if( isset( $_POST['kr8mb_gli_contact_twitter'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_twitter', wp_kses( $_POST['kr8mb_gli_contact_twitter'], $allowed ) );
    if( isset( $_POST['kr8mb_gli_contact_telefon'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_telefon', wp_kses( $_POST['kr8mb_gli_contact_telefon'], $allowed ) );  
    if( isset( $_POST['kr8mb_gli_contact_anschrift'] ) )
        update_post_meta( $post_id, 'kr8mb_gli_contact_anschrift', esc_html( $_POST['kr8mb_gli_contact_anschrift'] ) );   
        
                 
}


