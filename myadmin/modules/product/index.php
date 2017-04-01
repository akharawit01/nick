<?php
switch ($action) {
	case 'product_index' : product_index();
		break;
	case 'product_delete' : product_delete();
		break;
	case 'product_bkdleall' : product_bkdleall();
		break;
	case 'product_bkdleall_index' : product_bkdleall_index();
		break;
	case 'product_hidden' : product_hidden();
		break;
	case 'product_hidden_index' : product_hidden_index();
		break;
	case 'product_insert_form' : product_insert_form();
		break;
	case 'product_insert' : product_insert();
		break;
	case 'product_edit_form' : product_edit_form();
		break;
	case 'product_delete_img' : product_delete_img();
		break;
	case 'product_edit' : product_edit();
		break;
}
?>