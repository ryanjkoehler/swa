<?php 

/**
 * Enqueue the EPI Docraptor javascript file
 */

add_action('admin_enqueue_scripts', 'epi_register_admin_js');

function epi_register_admin_js(){
	wp_register_script('epi-docraptor', get_template_directory_uri() . '/includes-js/epi.docraptor.on.js');
	wp_enqueue_script('epi-docraptor');
}


/**
 * Add the 'Generate PDF' metabox
 */

add_action( 'add_meta_boxes', 'cd_meta_box_add_generatePDF' );

function cd_meta_box_add_generatePDF() {
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'publication', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'page', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'chart', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'blog', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'event', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'test', 'side', 'low' );
  add_meta_box( 'metabox-generate-pdf', 'Generate PDF', 'metabox_generate_pdf', 'multimedia', 'side', 'low' );
}



/**
 * Metabox: Generate a PDF from the post edit page and save it to a custom field
 * @uses docraptor
 */

function metabox_generate_pdf() { ?>

		<!-- <a href="#" class="button-secondary" onclick="hey.docraptor.iframe( '<?php echo hey_printURL(); ?>', jQuery('#is-pdf-final').is(':checked') );">Generate PDF</a>  -->
		<!-- <a href="#" class="button-secondary" onclick="hey.docraptor.ajax( {content: '<?php echo hey_printURL(); ?>', test: jQuery('#is-pdf-final').is(':checked')} );">Generate PDF</a>  -->
		<a href="#" class="button-secondary" onclick="hey.docraptor.iframe2( {content: '<?php echo hey_printURL(); ?>', test: !jQuery('#is-pdf-final').is(':checked'), savepdf: jQuery('#save-pdf').is(':checked'), postID: <?php echo get_the_id(); ?>, ajaxurl: '<?php echo get_template_directory_uri(); ?>/functions/ajax.docraptor.php' } );">Generate PDF</a> 
		<!-- <span class="blinking">Blinking test</span> -->
		<input id="is-pdf-final" type="checkbox" value="final" />
		<label for="is-pdf-final">Final</label> | 
		<input id="save-pdf" type="checkbox" value="final" />
		<label for="save-pdf">Save to post</label>
		<p>
			<input class="widefat" type="text" name="pdf_url" id="pdf_url" value="<?php echo esc_attr( get_post_meta( get_the_id(), 'pdf_url', true ) ); ?>" size="30" />
		</p>
		
		<div id="docraptor-ajax-reply"></div>
		
		<p>Make sure to save first.</p>

<?php 

}




/* Meta box setup function. */
// function smashing_post_meta_boxes_setup() {
// 
// 	/* Add meta boxes on the 'add_meta_boxes' hook. */
// 	// add_action( 'add_meta_boxes', 'smashing_add_post_meta_boxes' );
// 
// 	/* Save post meta on the 'save_post' hook. */
// 	add_action( 'save_post', 'smashing_save_post_class_meta', 10, 2 );
// }

add_action( 'save_post', 'smashing_save_post_class_meta_pdfurl', 10, 2 );


/* Save the meta box's post metadata. */
function smashing_save_post_class_meta_pdfurl( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	// if ( !isset( $_POST['smashing_post_class_nonce'] ) || !wp_verify_nonce( $_POST['smashing_post_class_nonce'], basename( __FILE__ ) ) )
	// 	return $post_id;

	if ( !isset( $_POST['pdf_url'] ) )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['pdf_url'] ) ? $_POST['pdf_url'] : '' );

	/* Get the meta key. */
	$meta_key = 'pdf_url';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );



	/****************************************************
	FUTURE: In the next two scenarios, we should add a new custom field with past versions.
		pdf_location always has one URL
		All past URLs go to a separate custom field (maybe JSON)
	****************************************************/
	
	

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
}
