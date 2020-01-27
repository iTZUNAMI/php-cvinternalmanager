
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
$data="$ANNODATANASCITA-$MESEDATANASCITA-$GIORNODATANASCITA";
$query = "INSERT INTO colloqui (
datacolloquio, posizioneproposta, azienda, aspetticomportamentali, coerenzaconruolo, valutazione,
verifica_conoscenze, verifica_abilita, verifica_motivazioni,trasferte, parttime, tempodeterminato, candidato_id) 
VALUES ('$data', '$posizioneproposta', '$azienda', '$aspetticomportamentali', '$coerenzaconruolo', '$valutazione', '$verifica_conoscenze', '$verifica_abilita','$verifica_motivazioni', '$trasferte', '$parttime', '$tempodeterminato', '$id')";

if (mysql_query($query, $db)){ 
aggiorna($id);
redirect("as_pannello.php?id=$id"); }
else {echo "Erorre durante l'inserimento";}
} 


// query modifica dati
if ($mode=='qmodifica'){

$data="$ANNODATANASCITA-$MESEDATANASCITA-$GIORNODATANASCITA";

$query = "UPDATE colloqui SET 
datacolloquio='$data' , 
posizioneproposta='$posizioneproposta',
azienda='$azienda',
aspetticomportamentali='$aspetticomportamentali',
coerenzaconruolo='$coerenzaconruolo',
trasferte='$trasferte', 
parttime='$parttime', 
tempodeterminato='$tempodeterminato',
valutazione='$valutazione',
verifica_conoscenze='$verifica_conoscenze',
verifica_abilita='$verifica_abilita',
verifica_motivazioni='$verifica_motivazioni'
WHERE candidato_id='$id' AND id='$cid' ";

if (mysql_query($query, $db)){
aggiorna($id);
redirect("as_pannello.php?id=$id"); }
else{echo "Erorre durante la modifica";}
}




//form modifica dati
if ($mode=='modifica')
{
$query = "SELECT * FROM colloqui  WHERE candidato_id='$id'  AND id='$cid' ";
$result = mysql_query($query, $db);
$row = mysql_fetch_array($result);
if (mysql_query($query, $db)) {}
else {echo "Erorre ";}
 
?>
 <form method="POST" name="modulo" ACTION="as_colloqui.php?mode=qmodifica">
 <h2>Modifica Conoscenza Lingustica</h2>
 <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Data</b></p>
      <p>
          <? list ($y, $m, $d) = explode ("-", $row['datacolloquio']);?>
          <select name="GIORNODATANASCITA" >
            <option><?echo $d;?></option>
            <option>  </option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
              </select> 
        
        <select name="MESEDATANASCITA" >
           <option><?echo $m;?></option>
            <option>  </option>
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select> 
        
          <input name="ANNODATANASCITA" value="<?echo $y;?>" maxlength="4"  size="4" type="text">     
      </p></td>
    <td width="179"><p><b>Posizione Proposta:</b><br />
        <textarea name="posizioneproposta" cols="20" rows="2"><?echo $row['posizioneproposta'];?></textarea>
    </p>      </td>
  </tr>
  <tr>
    <td><b>azienda:</b><br />
      <textarea name="azienda" cols="20" rows="3"><?echo $row['azienda'];?></textarea></td>
    <td><b>aspetticomportamentali:</b><br />
      <textarea name="aspetticomportamentali" cols="20" rows="3"><?echo $row['aspetticomportamentali'];?></textarea></td>
  </tr>
  <tr>
    <td><p><b>Disponibile a trasferte:</b></p>
      <p> Si
        <input type="radio" value="Si" name="trasferte" />
  &nbsp;&nbsp;
        No
        <input type="radio" value="No" name="trasferte" />
      </p></td>
    <td><p><b>Part-Time:</b></p>
      <p> Si
          <input type="radio" value="Si" name="parttime" />
  &nbsp;&nbsp;
        No
        <input type="radio" value="No" name="parttime" />
      </p></td>
  </tr>
  
   <tr>
    <td><p><b>Verifica Conoscenze:</b><br />
        <textarea name="verifica_conoscenze" cols="20" rows="3"><?echo $row['verifica_conoscenze'];?></textarea>
      </p>
      <p><br />
        </p>      </td>
    <td><p><b>Tempo Determinato: </b></p>
      <p>Si
        <input type="radio" value="Si" name="tempodeterminato" />
No
<input type="radio" value="No" name="tempodeterminato" />
</p>      </td>
  </tr>
  
  <tr>
  <td><strong>V</strong><b>erifica Abilita' :</b><br />
        <textarea name="verifica_abilita" cols="20" rows="3"><?echo $row['verifica_abilita'];?></textarea>      </td>  
  <td><b>Verifica Motivazioni :</b><br />
    <textarea name="verifica_motivazioni" cols="20" rows="3"><?echo $row['verifica_motivazioni'];?></textarea></td>
  </tr>
  
  <tr>
    <td><b>Valutazione:</b><br />
      <textarea name="valutazione" cols="20" rows="3"><?echo $row['valutazione'];?></textarea></td>
    <td><b>Coerenza con Ruolo:</b><br />
      <textarea name="coerenzaconruolo" cols="20" rows="3"><?echo $row['coerenzaconruolo'];?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
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

// query eliminaazione
if ($mode=='elimina')
{
$query = "DELETE  FROM colloqui  WHERE candidato_id=$id  AND id='$cid' ";
if (mysql_query($query, $db)){redirect("as_pannello.php?id=$id"); }
else{echo "Erorre durante l'inserimento";}
}



//form dati aggiunta
if ($mode=='aggiungi'){

?>
 <form method="POST" name="modulo" ACTION="as_colloqui.php?mode=qaggiungi">
 <h2>Inserisci Colloqui:</h2>
 <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Data Colloquio:</b></p>
      <p>
          <select name="GIORNODATANASCITA" >
            <option>  </option>
            <option>01</option>    
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
              </select> 
        
        <select name="MESEDATANASCITA" >
          <option>  </option>
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select> 
        
          <input name="ANNODATANASCITA" value="" maxlength="4"  size="4" type="text">     
      </p></td>
    <td width="179"><p><b>Posizione Proposta:</b><br />
        <textarea name="posizioneproposta" cols="20" rows="2"></textarea>
    </p>      </td>
  </tr>
  <tr>
    <td><b>Azienda:</b><br />
      <textarea name="azienda" cols="20" rows="2"></textarea></td>
    <td><b>Aspetti Comportamentali:</b><br />
      <textarea name="aspetticomportamentali" cols="20"></textarea></td>
  </tr>
  <tr>
    <td><p><b>Disponibile a trasferte:</b></p>
      <p> Si
        <input type="radio" value="Si" name="trasferte" />
  &nbsp;&nbsp;
        No
        <input type="radio" value="No" name="trasferte" />
      </p></td>
    <td><p><b>Part-Time:</b></p>      
      <p> Si
          <input type="radio" value="Si" name="parttime" />
  &nbsp;&nbsp;
        No
        <input type="radio" value="No" name="parttime" />
      </p></td>
  </tr>
    <tr>
    <td><p><b>Verifica Conoscenze:</b><br />
        <textarea name="verifica_conoscenze" cols="20" rows="2"></textarea>
        <br />
      </p>      </td>
    <td><p><b>Tempo Determinato:</b></p>
      <p> Si
          <input type="radio" value="Si" name="tempodeterminato" />
        No
        <input type="radio" value="No" name="tempodeterminato" />
      </p></td>
  </tr>
  
  <tr>
  <td><p><b>Verifica Abilita':</b><br />
      <textarea name="verifica_abilita" cols="20" rows="2"></textarea>
  </p></td>  
	  <td><b>Verifica Motivazioni:</b><br />
        <textarea name="verifica_motivazioni" cols="20" rows="2"></textarea></td>
  </tr>
  
  
  <tr>
    <td><b>Valutazione:</b><br />
      <textarea name="valutazione" cols="20" rows="2"></textarea></td>
    <td><b>Coerenza con ruolo:</b><br />
      <textarea name="coerenzaconruolo" cols="20" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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

