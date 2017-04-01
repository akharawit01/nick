<?php
	ob_start();
	session_start();
	$Line = $_GET["Line"];
	unset($_SESSION["strProductID"][$Line]);
	unset($_SESSION["strQty"][$Line]);
?>
<script>window.history.back();</script>
