<?php 

require_once 'inc/process.php';
require_once 'helper/helper.php';

if (isset($_GET['transf_id'])) {
	
	$process->store_to_temp_tbl($_GET['transf_id']);
}

?>