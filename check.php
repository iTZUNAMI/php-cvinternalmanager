
<?
    // Check if the cookies are set
    // This removes some notices (undefined index)
    if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD']))
    {
        // Get values from superglobal variables
        $USERNAME = $_COOKIE['USERNAME'];
        $PASSWORD = $_COOKIE['PASSWORD'];

        $CheckSecurity = new auth();
        $check = $CheckSecurity->page_check($USERNAME, $PASSWORD);
    }
    else
    {
        $check = false;
    }

	if ($check == false)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.

		// REDIRECT BACK TO LOGIN PAGE
        // REMOVE BLOCK IF NOT BEING USED
		   print "<br>";


		   ?>
              <HEAD>
			           <SCRIPT language="JavaScript1.1">
			           <!--
				           location.replace("<? echo $login; ?>");
                       //-->
                       </SCRIPT>
              </HEAD>
            <?
		// END OF REDIRECTION BLOCK
		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}	

?>
