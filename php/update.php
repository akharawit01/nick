<?php
	ob_start();
	session_start();
	$Line = $_GET["Line"];
	$_SESSION["strQty"][$Line] = $_GET["qty"];
?>
<script>window.history.back();</script>
