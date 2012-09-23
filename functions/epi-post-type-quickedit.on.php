<?php

// Display the post type on the post list table
function post_type_add_post_columns($columns) {
	$columns['post_type_set_col'] = 'Post Type';
	return $columns;
}

function post_type_render_post_columns($column_name, $id) {
	switch ($column_name) {
	case 'post_type_set_col':
		// show widget set
		$post_type = get_post_type( $id );
		$widget_set = NULL;
		if ($post_type) 
			echo $post_type;
		else 
			echo 'None';				
	break;
	}
}

// Add the function to display the post type field in each post type excluding attachment, revision, nav_menu_item
$post_types_init = get_post_types('','names');
foreach($post_types_init as $post_type){
	
	if($post_type == 'post'){
		
		add_filter('manage_posts_columns', 'post_type_add_post_columns');
		add_action('manage_posts_custom_column', 'post_type_render_post_columns', 10, 2); 
	
	} else if($post_type == 'page'){
		
		add_filter('manage_pages_columns', 'post_type_add_post_columns');
		add_action('manage_pages_custom_column', 'post_type_render_post_columns', 10, 2);
	
	} else if( $post_type != 'attachment' && $post_type != 'revision' && $post_type != 'nav_menu_item') {
		
		//add_filter('manage_'.$post_type.'_columns', 'post_type_add_post_columns');
		//add_action('manage_'.$post_type.'_posts_custom_column', 'post_type_render_post_columns', 10, 2);
	
	}
}

// Quick Edit Individual
add_action('quick_edit_custom_box',  'post_type_add_quick_edit', 10, 2);
function post_type_add_quick_edit($column_name, $current_post_type) {
	if ($column_name != 'post_type_set_col') return;
	?>
    <fieldset class="inline-edit-col-left">
	<div class="inline-edit-col">
		<span class="title">Post Type</span>
		<input type="hidden" name="post_type_web55_noncename" id="post_type_web55_noncename" value="" />
		<?php // Get all post type
			global $post; 
			$post_types = get_post_types('','names');
		?>
		<select name='post_type_set' id='post_type_set'>
			<?php 
			foreach ($post_types as $post_type) {
				if($post_type == $current_post_type) 
					$selected = "selected ='selected'";
				else $selected = '';
				echo "<option class='post-type-option' value='$post_type' >$post_type</option>\n";
			}
		        ?>
		</select>
	</div>
    </fieldset>
	<?php
}


// Quick Edit Bulk
add_action('bulk_edit_custom_box',  'post_type_bulk_add_quick_edit', 10, 2);
function post_type_bulk_add_quick_edit($column_name, $current_post_type) {
	if ($column_name != 'post_type_set_col') return;
	?>
    <fieldset class="inline-edit-col-left">
	<div class="inline-edit-col">
		<script type="text/javascript">
		<!--
		function set_inline_post_type_set(postTypeSet, nonce) {
			// revert Quick Edit menu so that it refreshes properly
			var ptInput = jQuery('#post_type_set');
			var nonceInput = document.getElementById('post_type_web55_noncename');
			nonceInput.value = nonce;
			// check option manually
			ptInput.find('option').each(function(){
				var value = jQuery(this).val()
				if(value == 'attachment' ||value == 'revision' || value == 'nav_menu_item'){
					jQuery(this).remove()
				} else if (value == postTypeSet) { 
					jQuery(this).replaceWith("<option class='post-type-option' value='"+postTypeSet+"' selected='selected' >&mdash; No Change &mdash;</option>"); 
				} else {
					jQuery(this).replaceWith("<option class='post-type-option' value='"+value+"' >"+value+"</option>"); 
				}

			});
		}
		set_inline_post_type_set('-1', '');
		//-->
		</script>	
		<span class="title">Post Type</span>
		<input type="hidden" name="post_type_web55_noncename" id="post_type_web55_noncename" value="" />
		<?php // Get all post type
			global $post; 
			$post_types = get_post_types('','names');
		?>
		<select name='post_type_set' id='post_type_set'>
			<option class='post-type-option' value='-1' >none</option>
			<?php 
			foreach ($post_types as $post_type) {
				if($post_type == $current_post_type) 
					$selected = "selected ='selected'";
				else $selected = '';
				echo "<option class='post-type-option' value='$post_type' >$post_type</option>\n";
			}
		        ?>
		</select>
	</div>
    </fieldset>
	<?php
}

// Add to our admin_init function
add_action('save_post', 'post_type_save_quick_edit_data');
function post_type_save_quick_edit_data($post_id) {
	
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	// to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;	
	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	}	
	
	// OK, we're authenticated: we need to find and save the data
	$post = get_post($post_id);
	if (isset($_POST['post_type_set']) && ($post->post_type != 'revision')) {
		$post_type_set_name = esc_attr($_POST['post_type_set']);
		$post_type_current	= get_post_type($post_id);;
		if ($post_type_set_name && $post_type_set_name != $post_type_current)
			set_post_type( $post_id, $post_type_set_name);	
	}
			
	return $post_type_set_name;	
}


// Javascript for individual post type editing..
add_action('admin_footer', 'post_type_quick_edit_javascript');
function post_type_quick_edit_javascript() {
	global $current_screen;
	
	$continue_script = false;
	$post_types = get_post_types('','names');
	if(in_array($current_screen->post_type, $post_types)) $continue_script = true;
	
	if ( !$continue_script ) return; 
 
	?>
	<script type="text/javascript">
	<!--
	function set_inline_post_type_set(postTypeSet, nonce) {
		// revert Quick Edit menu so that it refreshes properly
		inlineEditPost.revert();
		var ptInput = jQuery('#post_type_set');
		var nonceInput = document.getElementById('post_type_web55_noncename');
		nonceInput.value = nonce;
		// check option manually
		ptInput.find('option').each(function(){
			var value = jQuery(this).val()
			if(value == 'attachment' ||value == 'revision' || value == 'nav_menu_item'){
				jQuery(this).remove()
			} else if (value == postTypeSet) { 
				jQuery(this).replaceWith("<option class='post-type-option' value='"+postTypeSet+"' selected='selected' >"+postTypeSet+"</option>"); 
			} else {
				jQuery(this).replaceWith("<option class='post-type-option' value='"+value+"' >"+value+"</option>"); 
			}

		});
	}
	//-->
	</script>
	<?php
}

// Add js event listener click on wp edit link for post, page, and custom post type
add_filter('post_row_actions', 'post_type_expand_quick_edit_link', 10, 2);
add_filter('page_row_actions', 'post_type_expand_quick_edit_link', 10, 2);
function post_type_expand_quick_edit_link($actions, $post) {
	global $current_screen;
	
	$continue_script = false;
	$post_types = get_post_types('','names');
	if(in_array($current_screen->post_type, $post_types)) $continue_script = true;

	if ( !$continue_script ) return; 
 
	$nonce = wp_create_nonce( 'post_type_set'.$post->ID);
	$post_type_name = get_post_type( $post->ID);	
	$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
	$actions['inline hide-if-no-js'] .= esc_attr( __( 'Edit this item inline' ) ) . '" ';
	$actions['inline hide-if-no-js'] .= " onclick=\"set_inline_post_type_set('{$post_type_name}', '{$nonce}')\">"; 
	$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );
	$actions['inline hide-if-no-js'] .= '</a>';
	return $actions;	
}

?>