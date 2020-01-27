
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

if ($altro=='on'){
$lingua=$nuova_lingua;
if ($lingua!=''){$query ="INSERT INTO lingue_elenco (name) VALUES ('$lingua') ";
                 mysql_query($query, $db);}
}

if ($lingua=='' || $livelloconoscenza==''){ echo " Campo Vuoto! ";}

else{
     $query = "INSERT INTO conoscenzelingua (lingua, livelloconoscenza, candidato_id) 
               VALUES ('$lingua', '$livelloconoscenza', '$id')";}


if (mysql_query($query, $db)){
               aggiorna($id);
               redirect("as_pannello.php?id=$id"); }
else
    {echo "Erorre durante l'inserimento";}

} 




//query modfica dati
if ($mode=='qmodifica'){


if ($altro==on){$lingua=$nuova_lingua;
if ($lingua!=''){   $query ="INSERT INTO lingue_elenco (name) VALUES ('$lingua') ";
                     mysql_query($query, $db);
                }
}

if ($lingua=='' || $livelloconoscenza==''){ echo " Campo Vuoto! ";}

else{
      $query = "UPDATE conoscenzelingua SET lingua='$lingua' , livelloconoscenza='$livelloconoscenza'
                WHERE candidato_id='$id' AND id='$cid' ";
                
}

if (mysql_query($query, $db)) {
                               aggiorna($id);
                               redirect("as_pannello.php?id=$id"); 
                              }
else
                               {echo "Erorre durante la modifica";}

}


// form modifica dati
if ($mode=='modifica')
{

?>
 <form method="POST" name="modulo" ACTION="as_lingue.php?mode=qmodifica">
 <h2>Modifica Conoscenza Lingustica</h2>
  <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Lingua:</b><br />  
      <select name="lingua" >
<?
$queryx = "SELECT * FROM conoscenzelingua WHERE id='$cid'";  
$resultx = mysql_query($queryx, $db);
$rowx = mysql_fetch_array($resultx);
?>            
            <option> <? echo $rowx['lingua'] ?> </option>
            <option>  </option>
<? 

$query = "SELECT name FROM lingue_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
      {echo"<option>$row[name]</option>";}
 ?>
 </select>
        </p>
      </td>
    <td width="179"><p><b>Livello Conoscenza:</b><br />
         <select name="livelloconoscenza" >
         <option> <? echo $rowx['livelloconoscenza'] ?> </option>
           <option>  </option>
           <option>Scarso</option>
           <option>Sufficiente</option>
           <option>Buono</option>
           </select>  
        </p>
      </td>
  </tr>
<tr>
<td>
  <p>
    <input type="checkbox"  name="altro" />
    altro:specificare 
    </p>
  <p>
    <input type="text" name="nuova_lingua" />
  </p></td>
    <td>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
    </td>
</tr>
</table>

        <hr />
        <BR>
        
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"id\" value=$id>";?>  
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"cid\" value=$cid>";?>  
    
<input TYPE="submit" value="Modifica" >
<INPUT TYPE="reset" VALUE="Cancella!">
</FORM>

<? 
} 


//query eliminazione dati
if ($mode=='elimina'){

$query = "DELETE  FROM conoscenzelingua  WHERE candidato_id=$id  AND id='$cid' ";

if (mysql_query($query, $db)) {
                            redirect("as_pannello.php?id=$id"); }
else
                            {echo "Erorre durante eliminazione";}

}


// form aggiunta dati
if ($mode=='aggiungi'){

?>
 <form method="POST" name="modulo" ACTION="as_lingue.php?mode=qaggiungi">
  <h2>Inserisci Conoscenze Linguistica</h2>
  <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Lingua:</b><br />
       <select name="lingua" >
            <option>  </option>
<? 

$query = "SELECT name FROM lingue_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
      {echo"<option>$row[name]</option>";}
?>
 </select>
        </p>
      </td>
    <td width="179"><p><b>Livello Conoscenza:</b><br />
         <select name="livelloconoscenza" >
           <option>  </option>
           <option>Scarso</option>
           <option>Sufficiente</option>
           <option>Buono</option>
           </select>  
        </p>
      </td>
  </tr>
<tr>
<td>
  <p>
    <input type="checkbox"  name="altro" />
    altro:specificare 
    </p>
  <p>
    <input type="text" name="nuova_lingua" />
  </p></td>
    <td>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
    </td>
</tr>
</table>
            <hr />
        <BR>
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"id\" value=$id>";?>  
    
<input TYPE="submit" value="Aggiungi" >
<INPUT TYPE="reset" VALUE="Cancella!">
</FORM>

<?
}
 footer(); 
 
?>

