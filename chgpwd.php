
<?
	include_once ("auth.php");
	include_once ("authconfig.php");
	include_once ("check.php");
    include_once ("members/mysql.php");    
    
head();     
stilefuori();
body();
menufuori();
bodycontinua();
?>



<p align="center"><b><font face="Arial">Cambia Password</font></b></p>
<div align="center">
  <center>
  <form method="POST" action="chgpwd.php">
  <table border="0" cellpadding="0" cellspacing="0" width="32%">

    
    <tr>
      <td width="0%"  bgcolor="#FFFFFF"><div align="left"></div></td>
      <td width="100%"  bgcolor="#FFFFFF"><p><b><font size="2" face="Arial"> Vecchia :
        &nbsp;</font></b></p>
        <p><b><font size="2" face="Arial">
          <input type="password" name="oldpasswd" size="25" />
        </font></b></p></td>
    </tr>
    
    <tr>
      <td  bgcolor="#FFFFFF"><div align="left"></div></td>
      <td  bgcolor="#FFFFFF">
       
        <p><b><font size="2" face="Arial">Nuova:</font></b></p>
        <p><b><font size="2" face="Arial">
          <input type="password" name="newpasswd" size="25" />
        </font></b></p>
        </td>
    </tr>
    
    <tr>
      <td  bgcolor="#FFFFFF"><div align="left"></div></td>
      <td  bgcolor="#FFFFFF">
        <p><b><font size="2" face="Arial"> Conferma :       
  &nbsp;&nbsp;&nbsp;&nbsp;</font></b> </p>
        <p>
          <input type="password" name="confirmpasswd" size="25" />
        </p></td>
    </tr>
 
    <tr>
      <td colspan="2" bgcolor="#FFFFFF">
        <div align="right">
          <input type="submit" value="Cambia" name="submit">
          <input type="reset" value="Annulla" name="reset">
        </div></td>
    </tr>
 
  </table>      
  </form>
  </center>
</div>

<? 
	// Get global variable values if there are any
	if (isset($_POST['submit']))
	{
		$USERNAME = $_COOKIE['USERNAME'];
		$PASSWORD = $_COOKIE['PASSWORD'];
		$submit = $_POST['submit'];
		$oldpasswd = $_POST['oldpasswd'];
		$newpasswd = $_POST['newpasswd'];
		$confirmpasswd = $_POST['confirmpasswd'];
    }
	else
	{
		$submit = "";
	}

	$user = new auth();
	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
	
	// REVISED CODE
	$SelectedDB = mysql_select_db($dbname);
	$userdata = mysql_query("SELECT * FROM authuser WHERE uname='$USERNAME' and passwd='$PASSWORD'");
	
	if ($submit)
	{
		// Check if Old password is the correct
		if ($oldpasswd != $PASSWORD)
		{
			print "<p align=\"center\">";
			print "	<font face=\"Arial\" color=\"#FF0000\">";
			print "		<b>La vecchia password e' sbagliata!</b>";
			print "	</font>";
			print "</p>";
           footer();
			exit;
		}
		
		// Check if New password if blank
		if (trim($newpasswd) == "")
		{
			print "<p align=\"center\">";
			print "	<font face=\"Arial\" color=\"#FF0000\">";
			print "		<b>La nuova password non puo' essere vuota!</b>";
			print "	</font>";
			print "</p>";
             footer();
			exit;
		}
				
		// Check if New password is confirmed
		if ($newpasswd != $confirmpasswd)
		{
			print "<p align=\"center\">";
			print "	<font face=\"Arial\" color=\"#FF0000\">";
			print "		<b>Nuova password non confermata!</b>";
			print "	</font>";
			print "</p>";
			exit;
		}
		
		// If everything is ok, use auth class to modify the record
		$update = $user->modify_user($USERNAME, $newpasswd, $check["team"], $check["level"], $check["status"]);
		if ($update) {
			print "<p align=\"center\">";
			print "	<font face=\"Arial\" color=\"#FF0000\">";
			print "		<b>Password Cambiata!</b><br>";
			print "		Devi riloggarti per rendere effettivi i cambiamenti. <BR>";
			print "		Click <a href=\"index.php\">HOME</a>";
			print "	</font>";
             footer();
			print "</p>";
		}
		
	}	// end - new password field is not empty
    
    
    footer();   
?>


