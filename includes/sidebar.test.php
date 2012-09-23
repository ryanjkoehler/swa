<?php 

add_action('get_sidebar', 'epi_sidebar_logic');

function epi_sidebar_logic($sidebar) {

	if (is_user_logged_in() && isset($_GET['jump2012'])) {
		echo '<!---------SIDEBAR-------' . $sidebar . '-->';
		return 'jumpdrive';
	}
		

	return $sidebar;
}