<?php 

// echo password_hash('novaliches' , PASSWORD_DEFAULT);



function isLoggedIn(){
	if (isset($_SESSION['user_id']) AND isset($_SESSION['user_name']) AND isset($_SESSION['user_branch'])) {
		return true;
	}else{
		return false;
	}
}

// echo rand(0,999) . Date('Y') . rand(0,999) .   Date('d') ;
// echo rand(0,999) . Date('Y') . rand(0,999) .   Date('d');


function dd($arr){
	echo "<pre>" . print_r($arr, true) . "</pre>";
	
}

function setMessage($message,$type){
	echo '<div class="alert alert-'.$type.'" id="alert_message">'.ucwords($message).'</div>';
}


?>