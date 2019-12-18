<?php
	// ngăn ngừa access từ bên ngoài.
	if (!defined('WP_UNINSTALL_PLUGIN'))
		exit();
	
	// xóa menu page
	remove_menu_page('quang-counter-plugin');