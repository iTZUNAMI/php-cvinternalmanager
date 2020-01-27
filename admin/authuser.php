
<?
	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");
	include_once ("../members/mysql.php");  
	if ($check["level"] != 1)
	{
		// Feel free to change the error message below. Just make sure you put a "\" before
		// any double quote.
		print "<font face=\"Arial, Helvetica, sans-serif\" size=\"5\" color=\"#FF0000\">";
		print "<b>Illegal Access</b>";
		print "</font><br>";
  		print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#000000\">";
		print "<b>You do not have permission to view this page.</b></font>";
		
		exit; // End program execution. This will disable continuation of processing the rest of the page.
	}	
	
	$user = new auth();
	
	$connection = mysql_connect($dbhost, $dbusername, $dbpass);
	$SelectedDB = mysql_select_db($dbname);
	$listteams = mysql_query("SELECT * from authteam");
	
?>
<?
// Get initial values from superglobal variables
// Let's see if the admin clicked a link to get here
// or was originally here already and just pressed 
// a button or clicked on the User List

if (isset($_POST['action'])) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$team = $_POST['team'];
	$level = $_POST['level'];
	$status = $_POST['status'];
	$action = $_POST['action'];
	$act = "";
}
elseif (isset($_GET['act']))
{
	$act = $_GET['act'];
	$action = "";
}
else
{
	$action = "";
	$username = "";
	$password = "";	
	$team = "";
	$level = "";
	$status = "";
	$action = "";
	$act = "";
}

$message = "";

// Aggiungi USER
if ($action == "Aggiungi") {
	$situation = $user->add_user($username, $password, $team, $level, $status);
	
	if ($situation == "blank username") {
		$message = "Campo username vuoto!.";
		$action = "";
	}
	elseif ($situation == "username exists") {
		$message = "Questo user esiste già.";
		$action = "";
	}
	elseif ($situation == "blank password") {
		$message = "La Password non puo' essere vuota per i nuovi utenti.";
		$action = "";
	}
	elseif ($situation == "blank level") {
		$message = "Il livello non puo' essere vuoto.";
		$action = "";
	}
	elseif ($situation == 1) {
		$message = "Utente aggiunto correttamente.";
	}
	else {
		$message = "";
	}
}

// Elimina USER
if ($action=="Elimina") {
	// Elimina record in authuser table
	$Elimina = $user->delete_user($username);
	
	// Elimina record in signup table
	$Eliminasignup =  mysql_query("Elimina FROM signup WHERE uname='$username'");

	if ($Elimina && $Eliminasignup) {
		$message = $Elimina;
	}
	else {
		$username = "";
		$password = "";
		$team = "Ungrouped";
		$level = "";
		$status = "active";
		$message = "Questo utente è stato eliminato.";
	}
}

// Modifica USER
if ($action == "Modifica") {
	$update = $user->modify_user($username, $password, $team, $level, $status);

	if ($update==1) {
		$message = "Dettagli aggiornati correttamente.";
	}
	elseif ($update == "blank level") {
		$message = "Campo livello non puo' essere vuoto.";
		$action = "";
	}
	elseif ($update == "sa cannot be inactivated") {
		$message = "This user cannot be inactivated.";
		$action = "";
	}
	elseif ($update == "admin cannot be inactivated") {
		$message = "This user cannot be inactivated";
		$action = "";
	}
	else {
		$message = "";
	}
}

// EDIT USER (accessed from clicking on username links)
if ($act == "Edit") 
{
    $username = $_GET['username'];
	$listusers = mysql_query("SELECT * from authuser where uname='$username'");
	$rows = mysql_fetch_array($listusers);
	$username = $rows["uname"];
	$password = "";
	$team = $rows["team"];
	$level = $rows["level"];
	$status = $rows["status"];

	$message = "Modifica campi utente.";
}

// CLEAR FIELDS
if ($action == "Aggiungi Nuovo") {
	$username = "";
	$password = "";
	$team = "Ungrouped";
	$level = "";
	$status = "active";
	$message = "Inserisci nuovo utente.";
}



head();
stilefuoriadmin();
body();
    
menufuoriadmin();
		

bodycontinua();

?>

</table><br>&nbsp;
<table width="95%" border="0" cellspacing="0" cellpAggiungiing="0" align="left">
  <tr valign="top"> 
    <td width="55%"> 
      
	  <form name="AggiungiUser" method="Post" action="authuser.php">
	    <table width="95%" border="1" cellspacing="0" cellpAggiungiing="0" align="center" bordercolor="#000000">
          <tr>
            <td bgcolor="#990000"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFCC">Messaggi:</font></b></td>
          </tr>
          <tr>
            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#0000FF">
              <?
		  	if ($message) {
			 	print $message;
		  	}
			else {
				print "<BR>&nbsp;";
			}
		  ?>
            </font></td>
          </tr>
        </table>
	    <p>&nbsp;</p>
	    <table width="95%" border="1" cellspacing="0" cellpAggiungiing="0" align="center" bordercolor="#000000">
          <tr bgcolor="#000000"> 
            <td colspan="2" bgcolor="#A3BB90"> 
            <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3" color="#FFFFCC"><b>DETTAGLI UTENTE </b></font></div>            </td>
          </tr>
          <tr valign="middle"> 
            <td width="27%" bgcolor="#DFEBD5"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Username</font></b></td>
            <td width="73%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp; 
              <?   
			  	if (($action == "Modifica") || ($action=="Aggiungi") || ($act=="Edit")) {
					print "<input type=\"hidden\" name=\"username\" value=\"$username\">"; 
					print "<font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#006666\" size=\"2\">$username</font>";
				}
				else {	
					print "<input type=\"text\" name=\"username\" size=\"15\" maxlength=\"15\" value=\"$username\">"; 
				}
				
			  ?>
              </font></td>
          </tr>
          <tr valign="middle"> 
            <td width="27%" bgcolor="#DFEBD5"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Password</font></b></td>
            <td width="73%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp; 
              <? print "<input type=\"password\" name=\"password\" size=\"20\" maxlength=\"15\" value=\"$password\">"; ?>
              </font></td>
          </tr>
          <tr valign="middle"> 
            <td width="27%" bgcolor="#DFEBD5"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">&nbsp;</font></td>
            <td width="73%">Lascia questo campo vuoto se non vuoi cambiargli la password <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000099">&nbsp; 
              </font></td>
          </tr>
          <tr valign="middle"> 
            <td width="27%" bgcolor="#DFEBD5"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gruppo</font></strong></td>
            <td width="73%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp; 
              <select name="team">
                <?
			  	// DISPLAY TEAMS
			  	$row = mysql_fetch_array($listteams);
			  	while ($row) {
					$teamlist = $row["teamname"];
					
					if ($team == $teamlist) {
						print "<option value=\"$teamlist\" SELECTED>" . $row["teamname"] . "</option>";
					}
					else {
						print "<option value=\"$teamlist\">" . $row["teamname"] . "</option>";
					}
					$row = mysql_fetch_array($listteams);
				}
			  ?>
              </select>
              <? 
              if ($level==""){$level=4;}
              print "<input type=\"hidden\" name=\"level\" size=\"4\" maxlength=\"4\" value=\"$level\">"; ?></font></td>
          </tr>
          <tr valign="middle"> 
         
          </tr>
          <tr valign="middle"> 
            <td width="27%" bgcolor="#DFEBD5"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Stato</font></b></td>
            <td width="73%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp; 
              <select name="status">
                <?
			  	// ACTIVE / INACTIVE
				if ($status == "inactive") {
					print "<option value=\"active\">Active</option>";
                	print "<option value=\"inactive\" selected>Inactive</option>";
				}
				else {
					print "<option value=\"active\" selected>Active</option>";
                	print "<option value=\"inactive\">Inactive</option>";
				}
              
			  ?>
              </select>
              </font></td>
          </tr>
          <tr bgcolor="#CCCCCC" valign="middle"> 
            <td colspan="2" bgcolor="#FFFFFF"> 
              <div align="center"><font size="2"><font size="2"><font size="2"><font face="Verdana, Arial, Helvetica, sans-serif"> 
                <?
					
				if (($action=="Aggiungi") || ($action == "Modifica") || ($act=="Edit")) {
					print "<input type=\"submit\" name=\"action\" value=\"Aggiungi Nuovo\"> ";
					print "<input type=\"submit\" name=\"action\" value=\"Modifica\"> ";
					print "<input type=\"submit\" name=\"action\" value=\"Elimina\"> ";
				}
				else {
					print "<input type=\"submit\" name=\"action\" value=\"Aggiungi\"> ";
                }
				
				?>
                <input type="reset" name="Reset" value="Azzera">
            </font></font></font></font></div>            </td>
          </tr>
        </table>
	  </form>
	  

      <p>&nbsp;</p>
      <table width="95%" border="1" cellspacing="0" cellpAggiungiing="0" align="center" bordercolor="#000000">
        <tr bgcolor="#000000">
          <td colspan="5" bgcolor="#A3BB90"><div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFCC"><b>LISTA UTENTI </b></font></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="20%"><div align="center"><font size="1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Username</font></b></font></div></td>
          <td width="25%"><div align="center"><font size="1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Gruppo</font></b></font></div></td>
          <td width="15%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Stato</b></font></div></td>
          <td width="30%"><div align="center"><font size="1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Ultimo Login </font></b></font></div></td>
          <td width="10%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>N Volte Login </b></font></div></td>
        </tr>
        <?
	// Fetch rows from AuthUser table and display ALL users
	// OLD CODE - DO NOT REMOVE
	// $result = mysql_db_query($dbname, "SELECT * FROM authuser ORDER BY id");
	
	// REVISED CODE
	$result = mysql_query("SELECT * FROM authuser ORDER BY id");
	
	$row = mysql_fetch_array($result);
	while ($row) {  		
		print "<tr>"; 
        print "  <td width=\"20%\">";
        print "    <div align=\"left\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">";
		print "		<a href=\"authuser.php?act=Edit&username=".$row['uname']."\">";
		print 		$row['uname'];
		print "		</a>";
		print "	   </font></div>";
        print "  </td>";
        print "  <td width=\"25%\">";
        print "    <div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">".$row['team']."</font></div>";
        print "  </td>";
        print "  <td width=\"15%\">";
        print "    <div align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">".($row['status'])."</font></div>";
        print "  </td>";
        print "  <td width=\"30%\">";
        print "    <div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">".$row['lastlogin']."</font></div>";
        print "  </td>";
        print "  <td width=\"10%\">";
        print "    <div align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">".($row['logincount'])."</font></div>";
        print "  </td>";
        print "</tr>";
		
		$row = mysql_fetch_array($result);
	}
?>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>    </td>
   
  </tr>
</table>

<?

 footer(); 


?>
