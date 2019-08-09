<?php 
require_once 'connection.php';
$process = new Process();

if (isset($_POST['search_isset'])) {
	$search_value = $_POST['search_value'];

	$process->search($search_value);

}

if (isset($_POST['search_isset_history'])) {
	$search_value = $_POST['search_value'];

	$process->search_history($search_value);

}





if (isset($_POST['approve_isset'])) {
	$id = $_POST['id'];

	$process->approved_request($id);

}

if (isset($_POST['transfer'])) {

	$process->transfer_process();
	
}

?>