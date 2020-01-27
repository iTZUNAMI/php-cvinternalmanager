
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


// query aggiunta dati
if ($mode=='qaggiungi')
{



$data="$dataa_assunzione-$datam_assunzione-$datag_assunzione";

$query = "INSERT INTO esperienze (nomeazienda, settoremeceologico, dipendenticandidato , compiti , data_assunzione , tipocontratto, livello , retribuzione, benefits, id_candidato) 
VALUES ('$nomeazienda', '$settoremeceologico', '$dipendenticandidato', '$compiti', '$data', '$tipocontratto', '$livello', '$retribuzione','$benefits','$id')";

if (mysql_query($query, $db)){ 
aggiorna($id);
redirect("as_pannello.php?id=$id");}
else {echo "Erorre durante l'inserimento";}

} 


// query modifica dati
if ($mode=='qmodifica'){

$data="$dataa_assunzione-$datam_assunzione-$datag_assunzione";

$query = "
UPDATE esperienze SET 
nomeazienda='$nomeazienda' , 
settoremeceologico='$settoremeceologico',
dipendenticandidato='$dipendenticandidato',
compiti='$compiti',
data_assunzione='$data',
tipocontratto='$tipocontratto',
livello='$livello',
retribuzione='$retribuzione',
benefits='$benefits'
WHERE id_candidato='$id' AND id='$cid' ";


if (mysql_query($query, $db)){
aggiorna($id);
redirect("as_pannello.php?id=$id"); }
else{echo "Erorre durante la modifica";}
}



//form modifica dati
if ($mode=='modifica')
{
$query = "SELECT * FROM esperienze  WHERE id_candidato='$id'  AND id='$cid' ";
$result = mysql_query($query, $db);
$row = mysql_fetch_array($result);
if (mysql_query($query, $db)) {}
else {echo "Erorre";}

?>
 <form method="POST" name="modulo" ACTION="as_esperienze.php?mode=qmodifica">
 <h2>Modifica Esperienza Lavorativa:</h2>
 <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Nome Azienda:</b><br />
        <textarea name="nomeazienda" cols="20" rows="3" ><?echo $row['nomeazienda'];?></textarea>
    </p>
     </td>
    <td width="179"><p><b>Settore Meceologico:</b><br />
        <textarea name="settoremeceologico" cols="20" rows="3"><?echo $row['settoremeceologico'];?></textarea>
    </p>
    </td>
  </tr>
  <tr>
    <td><b>Dipendenti Candidato:</b><br />
      <textarea name="dipendenticandidato" cols="20" rows="3"><?echo $row['dipendenticandidato'];?></textarea></td>
    <td><b>Compiti:</b><br />
      <textarea name="compiti" cols="20" rows="3"><?echo $row['compiti'];?></textarea></td>
  </tr>
  <tr>
    <td><p><b>Data Assunzione:</b></p>
      <p>
      <? list ($y, $m, $d) = explode ("-", $row['data_assunzione']);?>
        <select name="datag_assunzione" >
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
        <select name="datam_assunzione" >
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
        <input name="dataa_assunzione" value="<?echo $y;?>" maxlength="4"  size="4" type="text" />
      </p></td>
    <td><b>Tipo Contratto:</b><br />
      <textarea name="tipocontratto" cols="20" rows="3"><?echo $row['tipocontratto'];?></textarea></td>
  </tr>
  <tr>
    <td><b>Livello:</b><br />
      <textarea name="livello" cols="20" rows="3"><?echo $row['livello'];?></textarea></td>
    <td><b>Retribuzione:</b><br />
      <textarea name="retribuzione" cols="20" rows="3"><?echo $row['retribuzione'];?></textarea></td>
  </tr>
  <tr>
  <td><b>Benefits:</b><br />
      <textarea name="benefits" cols="20" rows="3"><?echo $row['benefits'];?></textarea></td>
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
<? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"cid\" value=$cid>";?>  
    
<input TYPE="submit" value="Modifica" >
<INPUT TYPE="reset" VALUE="Cancella!">
</FORM>

<? } 


// query eliminazione dati
if ($mode=='elimina')
{
$query = "DELETE  FROM esperienze  WHERE id_candidato='$id'  AND id='$cid' ";
if (mysql_query($query, $db)) {redirect("as_pannello.php?id=$id"); }
else {echo "Erorre durante l'inserimento";}
}




// form aggiunta dati
if ($mode=='aggiungi'){
?>
 <form method="POST" name="modulo" ACTION="as_esperienze.php?mode=qaggiungi">
 <h2>Inserisci Esperienza Lavorativa:</h2>
 <br><br>
    <p><table width="402" border="0">
  <tr>
    <td width="213"><p><b>Nome Azienda:</b><br />
        <textarea name="nomeazienda" cols="20" rows="3"></textarea>
</p>      </td>
    <td width="179"><p><b>Settore Meceologico:</b><br />
        <textarea name="settoremeceologico" cols="20" rows="3"></textarea>
    </p>      </td>
  </tr>
  <tr>
    <td><b>Dipendenti Candidato:</b><br />
      <textarea name="dipendenticandidato" cols="20" rows="3"></textarea></td>
    <td><b>Compiti:</b><br />
      <textarea name="compiti" cols="20" rows="3"></textarea></td>
  </tr>
  <tr>
    <td><p><b>Data Assunzione:</b></p>
      <p>
        <select name="datag_assunzione" >
          <option> </option>
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
        
        
        <select name="datam_assunzione" >
          <option> </option>
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
        
        
        <input name="dataa_assunzione" value="" maxlength="4"  size="4" type="text" />
      </p></td>
    <td><b>Tipo Contratto:</b><br />
      <textarea name="tipocontratto" cols="20" rows="3"></textarea></td>
  </tr>
  <tr>
    <td><b>Livello:</b><br />
      <textarea name="livello" cols="20" rows="3"></textarea></td>
    <td><b>Retribuzione:</b><br />
      <textarea name="retribuzione" cols="20" rows="3"></textarea></td>
  </tr>
  <tr>
  <td><b>Benefits:</b><br />
      <textarea name="benefits" cols="20" rows="3"></textarea></td>
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

