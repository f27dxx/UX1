<?php
//filters input to avoid injection
function inputFilter($data) {
	$data = trim($data);
	$data= stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
