
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

if ($altro=='on'){
$descrizionetitolostudio=$nuovo_titolo;
if ($descrizionetitolostudio!=''){
                    $query ="INSERT INTO titoli_elenco (name) VALUES ('$descrizionetitolostudio') ";
                    mysql_query($query, $db);
                                 }
}

if ($altro2=='on'){
$areatitolostudio=$nuovo_area_titolo;
if ($areatitolostudio!=''){
                $query ="INSERT INTO titoli_area_elenco (name) VALUES ('$areatitolostudio') ";
                mysql_query($query, $db);
                          }
}

if ($descrizionetitolostudio=='' || $areatitolostudio==''){echo "Campo Vuoto! "; }
else{
        $query= "INSERT INTO titolostudio (descrizionetitolostudio,areatitolostudio, id_candidato) 
         VALUES ('$descrizionetitolostudio', '$areatitolostudio','$id')";
    }


if (mysql_query($query, $db))  { 
                        aggiorna($id);
                        redirect("as_pannello.php?id=$id");}                  
else  {echo "Erorre durante l'inserimento";}

} 


//query modifica dati
if ($mode=='qmodifica'){

if ($altro=='on'){
$descrizionetitolostudio=$nuovo_titolo;
if ($descrizionetitolostudio!=''){
                $query ="INSERT INTO titoli_elenco (name) VALUES ('$descrizionetitolostudio') ";
                mysql_query($query, $db);
                                 }
}

if ($altro2=='on'){
$areatitolostudio=$nuovo_area_titolo;
if ($areatitolostudio!=''){
                $query ="INSERT INTO titoli_area_elenco (name) VALUES ('$areatitolostudio') ";
                 mysql_query($query, $db);
                          }
}

if ($descrizionetitolostudio=='' || $areatitolostudio==''){echo "Campo Vuoto! "; }
else{
        $query = "UPDATE titolostudio SET descrizionetitolostudio='$descrizionetitolostudio' , 
        areatitolostudio='$areatitolostudio' WHERE id_candidato='$id' AND id='$cid' ";
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
 <form method="POST" name="modulo" ACTION="as_titolo.php?mode=qmodifica">
 <h2>Modifica Titolo Studio:</h2>
     <br><br>
      <table width="402" border="0">
        <tr>
          <td width="213"><p><b>Descrizione Titolo Studio:</b></p><br />
            <select name="descrizionetitolostudio" > 
<?
$queryx = "SELECT * FROM titolostudio WHERE id='$cid'";  
$resultx = mysql_query($queryx, $db);
$rowx = mysql_fetch_array($resultx);
?>            
            <option> <? echo $rowx['descrizionetitolostudio'] ?> </option>
            <option>  </option>            
        
<? 

$query = "SELECT name FROM titoli_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
      {echo"<option>$row[name]</option>";}
?>
              </select>
          </td>
          <td width="179"><p><b>Area Titolo Studio:</b></p><br />
            <select name="areatitolostudio" >
             <option> <? echo $rowx['areatitolostudio'] ?> </option>
                  <option>  </option>
<? 
$query = "SELECT name FROM titoli_area_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
    {echo"<option>$row[name]</option>";}
 ?>
           </select>
         </td>
       <tr>
       <td><br>
        <input type="checkbox"  name="altro" />
        altro:specificare<br>
        <input type="text" name="nuovo_titolo" />
       </td>
       
    <td>
         <br>
        <input type="checkbox"  name="altro2" />
        altro:specificare<br>
        <input type="text" name="nuovo_area_titolo" />
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
$query = "DELETE  FROM titolostudio WHERE id_candidato='$id'  AND id='$cid' ";

if (mysql_query($query, $db)) {       
                                    aggiorna($id);
                                    redirect("as_pannello.php?id=$id"); }
else
                             {echo "Erorre durante l'inserimento";}
}


//form aggiunta dati
if ($mode=='aggiungi'){


  
?>
 <form method="POST" name="modulo" ACTION="as_titolo.php?mode=qaggiungi">
 <h2>Inserisci Titolo Studio:</h2>
   <br><br>
    <table width="402" border="0">
  <tr>
    <td width="213"><p><b>Descrizione Titolo Studio:</b></p><br />
           <select name="descrizionetitolostudio" >       
               <option>  </option>
<? 
$query = "SELECT name FROM titoli_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
       {echo"<option>$row[name]</option>";}
?>
           </select>
     </td>
     <td width="179"><p><b>Area Titolo Studio:</b></p><br />
            <select name="areatitolostudio" >
                        <option>  </option>
<? 
$query = "SELECT name FROM titoli_area_elenco";  
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result))
     {echo"<option>$row[name]</option>";}
 ?>
            </select>
       </td>
  </tr>
  <tr>
       <td><br>
        <input type="checkbox"  name="altro" />
        altro:specificare<br>
        <input type="text" name="nuovo_titolo" />
       </td>
       
    <td>
         <br>
        <input type="checkbox"  name="altro2" />
        altro:specificare<br>
        <input type="text" name="nuovo_area_titolo" />
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

