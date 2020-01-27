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

?>
<script language="javascript" type="text/javascript">
	function HideDiv(ID){
			document.getElementById(ID).style.display='none';
		}
		
		function ShowDiv(ID){
			document.getElementById(ID).style.display='';
		}
		
		function ShowHideDiv(ID){
			if(document.getElementById(ID).style.display==''){
				HideDiv(ID);
			}else{
				HideAll("cat",1);
				ShowDiv(ID);
			}
		}
		
		function HideAll(prefix,iterations){
			for (i=1;i<=iterations;i++){
				HideDiv(prefix+i);
			}
		}        
</script>
<?

//se appena inserito
if ($id=='ultimo'){
$ultimoid = "SELECT id FROM candidati ORDER BY id DESC LIMIT 0,1";
$ultimoid_riga = mysql_query($ultimoid, $db);
$row = mysql_fetch_array($ultimoid_riga);
$id=$row['id'];}

//altrimenti pannello per utente scelto da ricerca
else{
$ultimoid = "SELECT id FROM candidati WHERE id='$id'";
$ultimoid_riga = mysql_query($ultimoid, $db);
$row = mysql_fetch_array($ultimoid_riga);
$id=$row['id'];}

//menu
if (($check['team']=='Admin'))        { menuadminpan($id);}
if (($check['team']=='Moderatore'))    { menumodpan($id);}


//parte sotto menu
bodycontinua();
?>
<h2>Pannello Curriculum Vitae:</h2>
<br />

<?

$query = "SELECT * FROM candidati  WHERE id= $id ";
$result = mysql_query($query, $db);
$row = mysql_fetch_array($result);

echo "Ultima Modifica: ";
echo  conv_date($row['ultimamodifica']) ;


//riepilogo dati anagrafici
echo "
<br><br><h4>DATI ANAGRAFICI:</h4><b/><br>
<font color='#003366'>Nome:</font> $row[nome] <br>
<font color='#003366'>Cognome:</font> $row[cognome] <br>
<font color='#003366'>Data di Nascita:</font> ";
echo conv_date($row['nascita']) ;
echo " <br><font color='#003366'>Telefono:</font> $row[telefono] <br>
<font color='#003366'>Email:</font> $row[email] <br>
<font color='#003366'>Provincia:</font> ";
$queryp = "SELECT name FROM provincia  WHERE id= $row[provinciaid] ";
$resultp = mysql_query($queryp, $db);
$rowp = mysql_fetch_array($resultp);
echo "$rowp[name] <br>";
echo "
<font color='#003366'>Comune:</font> 
";
$queryp = "SELECT name FROM comune WHERE id= $row[comuneid] ";
$resultp = mysql_query($queryp, $db);
$rowp = mysql_fetch_array($resultp);
echo "$rowp[name] <br>";
echo "
<font color='#003366'>Area:</font> $row[area] <br>
<font color='#003366'>Periodo di Preavviso:</font> $row[preavviso] <br>
<font color='#003366'>Patenti:</font> $row[patenti] <br>
<font color='#003366'>Allegato:</font> $row[allegato] <br>
<font color='#003366'>Note:</font> $row[note] <br>
<br>
<a href='as_mdati.php?mode=modifica&id=$id'><img src='images/p_modifica.png' border='0'></a> <hr>
";

//conteggio conoscenze info cosi vedo se 0 nessuna intestazione, altrimenti ne basta 1 ovviamente
$query = "SELECT * FROM conoscenzeinfo  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows==0){}
else{echo "<br><h4><b>CONOSCENZE INFORMATICHE:</h4><br>";}

$query = "SELECT * FROM conoscenzeinfo  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
     while ($row = mysql_fetch_array($result)){
echo "<font color='#003366'>Software:</font> $row[software]<br>";
echo "<font color='#003366'>Livello Conoscenza:</font> $row[livelloconoscenza]<br>";
$software=$row['software'];
echo "<a href='as_info.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_info.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>
<br><hr> ";
}


//conteggio conoscenze lingue cosi vedo se 0 nessuna intestazione, altrimenti ne basta 1 ovviamente
$query = "SELECT * FROM conoscenzelingua  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows==0){}
else{echo "<br><br><h4>CONOSCENZE LINGUISTICHE:</h4><br>";}

$query = "SELECT * FROM conoscenzelingua  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result)){
echo "<font color='#003366'>Lingua:</font> $row[lingua]<br>";
echo "<font color='#003366'>Livello Conosceze:</font> $row[livelloconoscenza]<br>";
echo "<a href='as_lingue.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_lingue.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>
<br><hr>";
}

//conteggio colloqui cosi vedo se 0 nessuna intestazione, altrimenti ne basta 1 ovviamente
$query = "SELECT * FROM colloqui  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows==0){}
else{echo "<br><br><h4>COLLOUI SOSTENUTI:</h4><br>";}

$query = "SELECT * FROM colloqui  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
while ($row = mysql_fetch_array($result)){
echo "<font color='#003366'>Data Colloquio:</font>";
echo conv_date ($row['datacolloquio']) ;
echo "<br><font color='#003366'>Posizione Proposta:</font> $row[posizioneproposta]<br>";
echo "<font color='#003366'>Azienda:</font> $row[azienda]<br>";
echo "<font color='#003366'>Aspetti Comportamentali:</font> $row[aspetticomportamentali]<br>";
echo "<font color='#003366'>Coerenza con Ruolo:</font> $row[coerenzaconruolo]<br>";
echo "<font color='#003366'>Part-Time:</font> $row[parttime]<br>";
echo "<font color='#003366'>Tempo Determinato:</font> $row[tempodeterminato]<br>";
echo "<font color='#003366'>Disponibile a Trasferte:</font> $row[trasferte]<br>";
echo "<font color='#003366'>Valutazione:</font> $row[valutazione]<br>";
echo "<font color='#003366'>Verifica Conoscenze:</font> $row[verifica_conoscenze]<br>";
echo "<font color='#003366'>Verifica Abilita:</font> $row[verifica_abilita]<br>";
echo "<font color='#003366'>Verifica Motivazioni:</font> $row[verifica_motivazioni]<br>";
echo "<a href='as_colloqui.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_colloqui.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>
<br><hr>";
}




//conteggio esperienze osi vedo se 0 nessuna intestazione, altrimenti ne basta 1 ovviamente
$query = "SELECT * FROM esperienze  WHERE id_candidato= $id ORDER BY data_assunzione DESC";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows==0){}
else{echo "<br><h4>ESPERIENZE LAVORATIVE:</h4><br>";
if ($totalrows==1){}
else{
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366"><i>Mostra Tutti</i></font></a><br><hr><br><?
}
$row = mysql_fetch_array($result);
echo "<font color='#003366'>Nome Azienda:</font> $row[nomeazienda]<br>";
echo "<font color='#003366'>Settore Meceologico:</font> $row[settoremeceologico]<br>";
echo "<font color='#003366'>Dipendenti Candidato:</font> $row[dipendenticandidato]<br>";
echo "<font color='#003366'>Compiti:</font> $row[compiti]<br><font color='#003366'>Data Assunzione:</font>";
echo conv_date($row['data_assunzione']) ;
echo "<br><font color='#003366'>Tipo Contratto:</font> $row[tipocontratto]<br>";
echo "<font color='#003366'>Livello:</font> $row[livello]<br>";
echo "<font color='#003366'>Retribuzione:</font> $row[retribuzione]<br>";
echo "<font color='#003366'>Benefits:</font> $row[benefits]<br>";
echo "<a href='as_esperienze_ruolo.php?mode=aggiungi&vecchioid=$id&id_e=$row[id]'><img src='images/p_ruolo.png' border='0'></a>&nbsp;&nbsp;&nbsp;";
echo "<a href='as_esperienze.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_esperienze.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>";
$collegamento=$row['id'];
$query2 = "SELECT * FROM ruoli  WHERE id_esperienze='$collegamento' ";
$result2 = mysql_query($query2, $db);
$totalrows = mysql_num_rows($result2);
if ($totalrows==0){echo "<br><hr>";}
else{
while ($row2 = mysql_fetch_array($result2)){
echo "<font color='#003366'>Ruolo:</font> $row2[descrizioneruolo] ";
echo "<a href='as_esperienze_ruolo.php?mode=elimina&vecchioid=$id&cid=$row2[id]'><img src='images/p_elimina.png' border='0'></a><br>";}
echo "<br><hr>";}
}

echo"<div id='cat1' style='display: none'>";
while ($row = mysql_fetch_array($result)){
echo "<font color='#003366'>Nome Azienda:</font> $row[nomeazienda]<br>";
echo "<font color='#003366'>Settore Meceologico:</font> $row[settoremeceologico]<br>";
echo "<font color='#003366'>Dipendenti Candidato:</font> $row[dipendenticandidato]<br>";
echo "<font color='#003366'>Compiti:</font> $row[compiti]<br><font color='#003366'>Data Assunzione:</font>";
echo conv_date($row['data_assunzione']) ;
echo "<br><font color='#003366'>Tipo Contratto:</font> $row[tipocontratto]<br>";
echo "<font color='#003366'>Livello:</font> $row[livello]<br>";
echo "<font color='#003366'>Retribuzione:</font> $row[retribuzione]<br>";
echo "<font color='#003366'>Benefits:</font> $row[benefits]<br>";
echo "<a href='as_esperienze_ruolo.php?mode=aggiungi&vecchioid=$id&id_e=$row[id]'><img src='images/p_ruolo.png' border='0'></a>&nbsp;&nbsp;&nbsp;";
echo "<a href='as_esperienze.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_esperienze.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>";
$collegamento=$row['id'];
$query2 = "SELECT * FROM ruoli  WHERE id_esperienze='$collegamento' ";
$result2 = mysql_query($query2, $db);
$totalrows = mysql_num_rows($result2);
if ($totalrows==0){echo "<br><hr>";}
else{
while ($row2 = mysql_fetch_array($result2)){
echo "<font color='#003366'>Ruolo:</font> $row2[descrizioneruolo] ";
echo "<a href='as_esperienze_ruolo.php?mode=elimina&vecchioid=$id&cid=$row2[id]'><img src='images/p_elimina.png' border='0'></a><br>";}
echo "<br><hr>";}
}
echo "</div>";


//conteggio titoli studio cosii vedo se 0 nessuna intestazione, altrimenti ne basta 1 ovviamente
$query = "SELECT * FROM titolostudio  WHERE id_candidato= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows==0){}
else{echo "<br><h4>TITOLI DI STUDIO:</h4><br>";}
while ($row = mysql_fetch_array($result)){
echo "<font color='#003366'>Descrizione Titolo Studio:</font> $row[descrizionetitolostudio]<br>";
echo "<font color='#003366'>Area Titolo Studio:</font> $row[areatitolostudio]<br>";
echo "<a href='as_titolo_voto.php?mode=aggiungi&vecchioid=$id&id_e=$row[id]'><img src='images/p_voto.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_titolo.php?mode=modifica&id=$id&cid=$row[id]'><img src='images/p_modifica.png' border='0'></a>&nbsp;&nbsp;";
echo "<a href='as_titolo.php?mode=elimina&id=$id&cid=$row[id]'><img src='images/p_elimina.png' border='0'></a><br>";
$collegamento=$row['id'];
$query3 = "SELECT * FROM formazione WHERE id_titolostudio='$collegamento' ";
$result3 = mysql_query($query3, $db);
$totalrows = mysql_num_rows($result3);
if ($totalrows==0){echo "<br><hr>";}
else{
while ($row3 = mysql_fetch_array($result3)){
echo "<font color='#003366'>Voto:</font> $row3[voto] ";
echo "<font color='#003366'>Voto Massimo:</font> $row3[votomassimo]  ";
echo "<a href='as_titolo_voto.php?mode=elimina&vecchioid=$id&cid=$row3[id]'><img src='images/p_elimina.png' border='0'></a><br>";
}
echo "<br><hr>";}
}



footer(); 



?>