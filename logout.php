<?

	// Destroy Sessions
	setcookie ("USERNAME", "");
	setcookie ("PASSWORD", "");	
	include_once ("authconfig.php");
    include_once ("members/mysql.php");
    
   header("location: index.php");
?>




