<?php
switch ($action) {
	case 'user_index': user_index();
		break;
	case 'user_insert': user_insert();
		break;
	case 'user_fm': user_fm();
		break;
	case 'user_update': user_update();
		break;
	case 'user_delete': user_delete();
		break;
	case 'user_bkdleall': user_bkdleall();
		break;
}	
?>