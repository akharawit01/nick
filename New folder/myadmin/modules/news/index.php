<?php
switch ($action) {
	case 'news_index' : news_index();
		break;
	case 'news_delete' : news_delete();
		break;
	case 'news_bkdleall' : news_bkdleall();
		break;
	case 'news_bkdleall_index' : news_bkdleall_index();
		break;
	case 'news_hidden' : news_hidden();
		break;
	case 'news_hidden_index' : news_hidden_index();
		break;
	case 'news_insert_form' : news_insert_form();
		break;
	case 'news_insert' : news_insert();
		break;
	case 'news_edit_form' : news_edit_form();
		break;
	case 'news_delete_img' : news_delete_img();
		break;
	case 'news_edit' : news_edit();
		break;
}
?>