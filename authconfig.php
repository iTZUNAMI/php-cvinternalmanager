
<?
// ALL PATHS BELOW ARE RELATIVE TO THE DIRECTORY WHERE YOU HAVE INSTALLED vAuthenticate
$resultpage = "vAuthenticate.php";	// THIS IS THE PAGE THAT WOULD CHECK FOR AUTHENTICITY
$admin = "members/index.php";	// THIS IS THE PATH TO THE ADMIN INTERFACE
$success = "members/index.php";	// THIS IS THE PAGE TO BE SHOWN IF USER IS AUTHENTICATED
$failure = "failed.php";	// THIS IS THE PAGE TO BE SHOWN IF USERNAME-PASSWORD COMBINATION DOES NOT MATCH
	
// The $_SERVER['HTTP_HOST'] takes care of the root directory of the web server
// This makes it possible to implement the script even on IP-based systems.
// For name-based systems, just think of $_SERVER['HTTP_HOST'] as the domain name
// example: $_SERVER['HTTP_HOST'] will have to be www.yourdomain.com
// For IP-based systems, this will replace the IP address
// example: $_SERVER['HTTP_HOST'] will have to be 66.199.47.5
$changepassword = "http://" . $_SERVER['HTTP_HOST'] . "/chgpwd.php"; // Path to change password file
$login = "http://" . $_SERVER['HTTP_HOST'] . "/index.php"; // Path to page with the login box
$logout = "http://" . $_SERVER['HTTP_HOST'] . "/logout.php"; // Path to logout page

// DB SETTINGS
$dbhost = "localhost";	// Change this to the proper DB Host name
$dbusername = "root";	// Change this to the proper DB User
$dbpass = "";	// Change this to the proper DB User password
$dbname	= "test"; 	// Change this to the proper DB Name

?>
