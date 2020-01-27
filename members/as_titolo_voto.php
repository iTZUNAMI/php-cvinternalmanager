<?
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


//query inserimento dati
if ($mode=='qaggiungi')
{
if ($voto=='' || $votomassimo=='') { echo "Campi Vuoti! ";}

else{
      $query = "INSERT INTO formazione (voto, votomassimo, id_titolostudio) 
       VALUES ('$voto', '$votomassimo' , '$id_e')";
    }
    
if (mysql_query($query, $db))
            { redirect ("as_pannello.php?id=$vecchioid"); }
else
            {echo "Erorre durante l'inserimento";}

} 


 
// eliminazione voto
if ($mode=='elimina')
{

$query = "DELETE  FROM formazione  WHERE  id='$cid' ";

if (mysql_query($query, $db))
                    {redirect ("as_pannello.php?id=$vecchioid"); }
else
                    {echo "Erorre durante l'inserimento";}

}


// form aggiunta dati
if ($mode=='aggiungi'){

?>
 <form method="POST" name="modulo" ACTION="as_titolo_voto.php?mode=qaggiungi">
  <h2>Inserisci Votazione del Titolo:</h2>
    <br><br>
   <table width="402" border="0">
     <tr>
       <td width="213"><p><b>Voto:</b></p>
         <textarea name="voto" cols="20" rows="1"></textarea>
       </td>
       <td width="213"><p><b>Voto Massimo:</b></p>
        <textarea name="votomassimo" cols="20" rows="1"></textarea>
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

