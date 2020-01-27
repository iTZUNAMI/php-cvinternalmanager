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
$software=$nuova_cinfo;
if ($software!='')
{$query ="INSERT INTO software_elenco (name) VALUES ('$software') "; mysql_query($query, $db);}
}

if ($software=='' || $livelloconoscenza=='') {echo "Campo Vuoto!  ";}
else
{$query = "INSERT INTO conoscenzeinfo (software, livelloconoscenza, candidato_id) 
VALUES ('$software', '$livelloconoscenza', '$id')";}


if (mysql_query($query, $db)) { 
     aggiorna($id);
     redirect ("as_pannello.php?id=$id"); }
else
    {echo "   Erorre durante l'inserimento";}

} 



//query modifica dati
if ($mode=='qmodifica'){

if ($altro=='on'){
$software=$nuova_cinfo;
if ($software!=''){ $query ="INSERT INTO software_elenco (name) VALUES ('$software') ";
                     mysql_query($query, $db);
                  }
              }

if ($software=='' || $livelloconoscenza=='') {echo "Campo Vuoto!  ";}
else
{
$query = "UPDATE conoscenzeinfo SET software='$software' , livelloconoscenza='$livelloconoscenza'
          WHERE candidato_id='$id' AND id='$cid' ";
}



if (mysql_query($query, $db))  { 
          aggiorna($id); 
          redirect("as_pannello.php?id=$id");
                               }
else
    {echo "Erorre durante la modifica";}

}




//form modifica dati
if ($mode=='modifica')
{
?>
 <form method="POST" name="modulo" ACTION="as_info.php?mode=qmodifica">
   <h2>Modifica Conoscenze Informatica</h2>
    <br>
    <br>
    <table width="402" border="0">
     <tr>
        <td width="213"><p><b>Software:</b></p>
    
          <select name="software" >
<?
$queryx = "SELECT * FROM conoscenzeinfo WHERE id='$cid'";  
$resultx = mysql_query($queryx, $db);
$rowx = mysql_fetch_array($resultx);
?>            
            <option> <? echo $rowx['software'] ?> </option>
             <option>  </option>
<? 
$query = "SELECT name FROM software_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
        {echo"<option>$row[name]</option>"; }
?>
 
          </select> 
         </td>
         <td width="179"><p><b>Livello Conoscenza:</p>
   
         <select name="livelloconoscenza" >
        <option> <? echo $rowx['livelloconoscenza'] ?> </option>
           <option>  </option>
           <option>Scarso</option>
           <option>Sufficiente</option>
           <option>Buono</option>
         </select>
         </td>
    </tr>
    <tr>
        <td>
          <p>
          <input type="checkbox"  name="altro" />
          altro:specificare 
          </p>
          <p>
          <input type="text" name="nuova_cinfo" />
          </p>
        </td>
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

<? }


//query eliminazione dati 
if ($mode=='elimina')
{

$query = "DELETE  FROM conoscenzeinfo  WHERE candidato_id=$id  AND id='$cid' ";


if (mysql_query($query, $db)) {  
                                aggiorna($id);
                                redirect ("as_pannello.php?id=$id"); }

else
                              {echo "Errore eliminazione!";}

}



// form aggiunta dati
if ($mode=='aggiungi'){

?>
 <form method="POST" name="modulo" ACTION="as_info.php?mode=qaggiungi">
    <h2>Inserisci Conoscenze Informatica</h2>
    <br><br>
    
    <table width="402" border="0">
      <tr>
        <td width="213"><p><b>Software:</b></p>
        <select name="software" >
        <option>  </option>
<? 

$query = "SELECT name FROM software_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
       {echo"<option>$row[name]</option>";}
?>
         </select> 
         </td>
         <td width="179"><p><b>Livello Conoscenza:</p>
   
           <select name="livelloconoscenza" >
           <option>  </option>
           <option>Scarso</option>
           <option>Sufficiente</option>
           <option>Buono</option>
           </select>      
         </td>
       </tr>
       <tr>
         <td>
          <p>
           <input type="checkbox"  name="altro" />
           altro:specificare 
          </p>
          <p>
           <input type="text" name="nuova_cinfo" />
          </p>
        </td>
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

