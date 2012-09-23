<?php 

/****************************************************
http://wpsnipp.com/index.php/excerpt/enable-tinymce-editor-for-post-the_excerpt/
Author: Kevin Chard
August 1, 2011
****************************************************/

function tinymce_excerpt_js_wpsnipp(){ ?>
<script type="text/javascript">
	jQuery(document).ready( tinymce_excerpt );
            function tinymce_excerpt() {
		jQuery("#excerpt").addClass("mceEditor");
		tinyMCE.execCommand("mceAddControl", false, "excerpt");
	    }
</script>
<?php }
add_action( 'admin_head-post.php', 'tinymce_excerpt_js_wpsnipp');
add_action( 'admin_head-post-new.php', 'tinymce_excerpt_js_wpsnipp');
function tinymce_css_wpsnipp(){ ?>
<style type='text/css'>
	    #postexcerpt .inside{margin:0;padding:0;background:#fff;}
	    #postexcerpt .inside p{padding:0px 0px 5px 10px;}
	    #postexcerpt #excerpteditorcontainer { border-style: solid; padding: 0; }
</style>
<?php }
add_action( 'admin_head-post.php', 'tinymce_css_wpsnipp');
add_action( 'admin_head-post-new.php', 'tinymce_css_wpsnipp');