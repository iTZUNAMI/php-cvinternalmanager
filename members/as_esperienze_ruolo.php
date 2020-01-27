
<?php
	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");

   if (!($check['team']=='Admin') && !($check['team']=='Moderatore'))
   {
        echo 'You are not allowed to access this page.';
		exit();
    }
include ("mysql.php");


head();
stile();
body();


if (($check['team']=='Admin'))        { menuadmin();}
if (($check['team']=='Moderatore'))    { menumod();}
if (($check['team']=='Membro'))       { menu();}


bodycontinua();


//query aggiunta dati
if ($mode=='qaggiungi')
{
$query = "INSERT INTO ruoli (descrizioneruolo, id_esperienze) 
VALUES ('$ruolo' , '$id_e')";
if (mysql_query($query, $db)) { redirect ("as_pannello.php?id=$vecchioid"); }
else {echo "Erorre durante l'inserimento";}
} 

// eliminazione ruolo 
if ($mode=='elimina')
{
$query = "DELETE FROM ruoli WHERE id='$cid' ";
if (mysql_query($query, $db)) {redirect ("as_pannello.php?id=$vecchioid"); }
else {echo "Erorre durante l'inserimento";}
}

// form aggiunta ruolo
if ($mode=='aggiungi'){
?>
 <form method="POST" name="modulo" ACTION="as_esperienze_ruolo.php?mode=qaggiungi">
  <h2>Inserisci Ruolo dell'esperienza:</h2>
  <br><br>
      <table width="402" border="0">
       <tr>
         <td width="213">
         <p><b>Ruolo:</b></p><br />
         <textarea name="ruolo" cols="20" rows="3"></textarea> 
        </td>
       </tr>
       </table>
       <hr />
       <BR>
       
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"id_e\" value=$id_e>";?>  
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"vecchioid\" value=$vecchioid>";?>  
 
<input TYPE="submit" value="Aggiungi" >
<INPUT TYPE="reset" VALUE="Cancella!">
</FORM>

<?
}
 footer(); 
?>

