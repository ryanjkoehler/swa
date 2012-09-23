<?php 
//remove default metabox
//change TAXONOMY_NAME to your taxonomy name
add_action( 'admin_menu' , 'remove_post_custom_fields' );
function remove_post_custom_fields() {
    remove_meta_box( 'issuediv' , 'post' , 'normal' ); 
}



//add our custom meta box
add_action( 'add_meta_boxes', 'my_add_custom_box' );

 function my_add_custom_box() {
    add_meta_box( 
//      'myplugin_sectionid',
        'tagsdiv-issue',
        __( 'New and Improved Issue Tags', 'textdomain' ),
        'tags_like_custom_tax',
        'post' 
    );
 }

 //call back function to display the metabox
 //change TAXONOMY_NAME to your taxonomy name 
 function tags_like_custom_tax(){
     $tax_name = 'issue';
     global $post;
     $taxonomy = get_taxonomy($tax_name);
     $disabled = !current_user_can($taxonomy->cap->assign_terms) ? 'disabled="disabled"' : '';
     ?>
     <div class="tagsdiv" id="<?php echo $tax_name; ?>">
        <div class="jaxtag">
            <div class="nojs-tags hide-if-js">
                <p><?php echo $taxonomy->labels->add_or_remove_items; ?></p>
                <textarea name="<?php echo "tax_input[$tax_name]"; ?>" rows="3" cols="20" class="the-tags" id="tax-input-<?php echo $tax_name; ?>" <?php echo $disabled; ?>><?php echo get_terms_to_edit( $post->ID, $tax_name ); // textarea_escaped by esc_attr() ?></textarea>
            </div>
            <?php if ( current_user_can($taxonomy->cap->assign_terms) ) { ?>
            <div class="ajaxtag hide-if-no-js">
                <label class="screen-reader-text" for="new-tag-<?php echo $tax_name; ?>"><?php echo $taxonomy->labels->name; ?></label>
                <div class="taghint"><?php echo $taxonomy->labels->add_new_item; ?></div>
                <p><input type="text" id="new-tag-<?php echo $tax_name; ?>" name="newtag[<?php echo $tax_name; ?>]" class="newtag form-input-tip" size="16" autocomplete="off" value="" />
                <input type="button" class="button tagadd" value="<?php esc_attr_e('Add'); ?>" tabindex="3" /></p>
            </div>
            <p class="howto"><?php echo esc_attr( $taxonomy->labels->separate_items_with_commas ); ?></p>
            <?php } ?>
        </div>
        <div class="tagchecklist"></div>
    </div>
          <?php if ( current_user_can($taxonomy->cap->assign_terms) ) { ?>
            <p class="hide-if-no-js"><a href="#titlediv" class="tagcloud-link" id="link-<?php echo $tax_name; ?>"><?php echo $taxonomy->labels->choose_from_most_used; ?></a></p>
          <?php } 
}
