<?php

	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");

   if (!($check['team']=='Admin') && !($check['team']=='Moderatore') && !($check['team']=='Membro'))
  {
      echo 'You are not allowed to access this page.';
		exit();
  }
  
include ("mysql.php");

$queryd = "SELECT * FROM candidati  WHERE id= $id ";
$resultd = mysql_query($queryd, $db);
$rowd = mysql_fetch_array($resultd);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<title>Curriculum Vitae</title>

<style>
@media screen{
	body { background-color:#FFFFFF; font-family: Helvetica, Arial, Verdana, sans-serif; font-size:12px; }
		TD{ text-align : justify; line-height : 20px; font-family: Helvetica, Arial, Verdana, sans-serif; font-size:12px; padding-left: 10px; padding-right: 10px; vertical-align : top; padding-bottom: 5px; line-height : 14px; }
		.Title{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:16px; font-weight: bold; letter-spacing : 1px; border-right: 1px solid black; text-align : right; width : 200px; line-height : 20px; padding-left: 0px; }
		.TitleSmall{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:13px; font-weight: bold; border-right: 1px solid black; padding-left: 0px; text-align : right; width : 200px; line-height : 18px; }
		.SubTitle{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:14px; font-weight: bold; letter-spacing : 1px; border-right: 1px solid black; text-align : right; width : 200px; padding-left: 0px; }
		.NormalTitle{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:12px; border-right: 1px solid black; text-align : right; width : 200px; }
		.LanguageCell{ border-right: 1px solid black; border-bottom: 1px solid black; text-align : center; padding: 2px 4px 2px 4px; font-size: 12px; }
		.FCCV{ width : 170px; text-align: right; padding-right: 0px; }
		.LangPadd{ font-weight: bold; line-height : 19px;
	}
}
@media print{
	body { background-color: #FFFFFF; font-family: Helvetica, Arial, Verdana, sans-serif; font-size: 11px; }
		TD{ text-align: justify; line-height: 20px; font-family: Helvetica, Arial, Verdana, sans-serif; font-size: 11px; padding-left: 10px; padding-right: 10px; vertical-align: top; padding-bottom: 5px; line-height: 14px; }
		.Title{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:16px; font-weight: bold; letter-spacing : 1px; border-right: 1px solid black; text-align : right; width : 180px; line-height : 20px; padding-left: 0px; }
		.TitleSmall{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:12px; font-weight: bold; border-right: 1px solid black; padding-left: 0px; text-align : right; width : 180px; line-height : 18px; }
		.SubTitle{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:13px; font-weight: bold; letter-spacing : 1px; border-right: 1px solid black; text-align : right; width : 180px; padding-left: 0px; }
		.NormalTitle{ font-family: Helvetica, Arial, Verdana, sans-serif; font-size:11px; border-right: 1px solid black; text-align : right; width : 180px; padding-left: 0px; }
		.LanguageCell{ border-right: 1px solid black; border-bottom: 1px solid black; text-align : center; padding: 2px 2px 2px 2px; font-size: 9px; }
		.FCCV{ width : 150px; text-align: right; padding-right: 0px; }
		.LangPadd{ font-weight: bold; line-height : 19px;
	}
}
</style>


</head>
<body style="margin-left: 0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td rowspan="2" align="right" class="FCCV"><img src="images/cv_logo_small.gif" alt="" width="85" height="47" border="0"></td>
  <td width="5" style="width: 5px; padding-left: 0px; padding-right: 2px;"><img src="images/trasp.gif" alt="" width="1" height="28" border="0"></td>
	<td rowspan="2">&nbsp;</td>
</tr>
<tr>
	<td style="border-right: 1px solid black; border-top: 1px solid black;"><img src="images/trasp.gif" alt="" width="1" height="19" border="0"></td>
</tr>
<tr>
	<td colspan="2" class="Title">Curriculum Vitae <br>LOGO</td>
  <td>
  <br><br><br>  </td>
</tr>
<tr>
  <td colspan="2" class="TitleSmall">Informazioni personali</td>
  <td>&nbsp;</td>
</tr>
<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Cognome(i) / Nome(i)<br><br></td>
  <td><strong>
<?echo $rowd['cognome'] ;?>  &nbsp;&nbsp; <?echo $rowd['nome'] ;?></strong></td>
</tr>
<?
$queryp = "SELECT name FROM provincia  WHERE id= $rowd[provinciaid] ";
$resultp = mysql_query($queryp, $db);
$rowp = mysql_fetch_array($resultp);
?>

<tr>
  <td colspan="2" class="NormalTitle">Data di nascita<br><br></td>
  <td>
	<?echo conv_date($rowd['nascita']) ;?>	</td>
</tr>
<tr>

<tr>
  <td colspan="2" class="NormalTitle">Provincia<br><br></td>
  <td>
	<?echo $rowp['name'];?>  </td>
</tr>
<tr>
<?
$queryp = "SELECT name FROM comune WHERE id= $rowd[comuneid] ";
$resultp = mysql_query($queryp, $db);
$rowp = mysql_fetch_array($resultp);
?>
  <td colspan="2" class="NormalTitle">Comune / Area<br><br></td>
  <td>
	<?echo $rowp['name'] ;?> &nbsp;&nbsp;&nbsp; <?echo $rowd['area'] ;?> </td>
</tr>
<tr>
  <td colspan="2" class="NormalTitle">Telefono(i)<br><br></td>
  <td>
	<?echo $rowd['telefono'] ;?>	</td>
</tr>
<tr>

</tr>

<tr>
  <td colspan="2" class="NormalTitle">E-mail<br><br></td>
  <td>
	<?echo $rowd['email'] ;?>	</td>
</tr>


</tr>

<?


$query = "SELECT * FROM esperienze  WHERE id_candidato= $id ORDER BY data_assunzione DESC ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="TitleSmall">
  <? if ($totalrows=='0') {echo "&nbsp;";} 
     else { 
             echo"Esperienza professionale"; 
     if ($totalrows>1 && $mode!='all' )
              {echo "<a href='asm_curriculum.php?id=$id&mode=all'>+</a>";}
         }
  ?></td>

</tr>

<?



//tutte le esperienze
if ($mode=='all'){
$query = "SELECT * FROM esperienze  WHERE id_candidato= $id ORDER BY data_assunzione DESC ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
while($row = mysql_fetch_array($result)){ 
?>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>Nome Azienda</i></td>
  <td><?echo $row['nomeazienda'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Settore Meceologico</td>
  <td><?echo $row['settoremeceologico'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Dipendenti Candidato</td>
  <td><?echo $row['dipendenticandidato'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Compiti</td>
  <td><?echo $row['compiti'] ;?></td>
</tr>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Data Assunzione</td>
  <td><?echo conv_date($row['data_assunzione']) ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Tipo Contratto</td>
  <td><?echo $row['tipocontratto'] ;?></td>
</tr>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Livello</td>
  <td><?echo $row['livello'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Retribuzione</td>
  <td><?echo $row['retribuzione'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Benefits</td>
  <td><?echo $row['benefits'] ;?></td>
</tr>

<?
$collegamento=$row['id'];
$query2 = "SELECT * FROM ruoli  WHERE id_esperienze='$collegamento' ";
$result2 = mysql_query($query2, $db);
$totalrows = mysql_num_rows($result2);
if ($totalrows=='0'){}
else{
while ($row2 = mysql_fetch_array($result2)){
?>
<tr> <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Ruolo<br><br></td>
  <td><?echo $row2['descrizioneruolo'] ;?></td>
</tr>
<?
} //fine tuti ruoli
} //fine else

?>
<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>&nbsp;</i></td>
  <td>&nbsp;</td>
</tr>

<?
} //fine while esperienze

}
//altrimenti modo singolo esperienza
else{

$query = "SELECT * FROM esperienze  WHERE id_candidato= $id ORDER BY data_assunzione DESC ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows=='0'){}
else{

$row = mysql_fetch_array($result); 
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>Nome Azienda</i></td>
  <td><?echo $row['nomeazienda'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Settore Meceologico</td>
  <td><?echo $row['settoremeceologico'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Dipendenti Candidato</td>
  <td><?echo $row['dipendenticandidato'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Compiti</td>
  <td><?echo $row['compiti'] ;?></td>
</tr>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Data Assunzione</td>
  <td><?echo conv_date($row['data_assunzione']) ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Tipo Contratto</td>
  <td><?echo $row['tipocontratto'] ;?></td>
</tr>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Livello</td>
  <td><?echo $row['livello'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Retribuzione</td>
  <td><?echo $row['retribuzione'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Benefits</td>
  <td><?echo $row['benefits'] ;?></td>
</tr>

<?
$collegamento=$row['id'];
$query2 = "SELECT * FROM ruoli  WHERE id_esperienze='$collegamento' ";
$result2 = mysql_query($query2, $db);
$totalrows = mysql_num_rows($result2);
if ($totalrows=='0'){}
else{
while ($row2 = mysql_fetch_array($result2)){
?>
<tr> <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Ruolo<br><br></td>
  <td><?echo $row2['descrizioneruolo'] ;?></td>
</tr>



<?
}
}
}
}


$query = "SELECT * FROM titolostudio  WHERE id_candidato= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows=='0'){}
else{
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="TitleSmall">Istruzione e formazione</td>
  <td>&nbsp;</td>
</tr>
<?


while ($row = mysql_fetch_array($result)){
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>Descrizione Titolo Studio</i></td>
  <td><?echo $row['descrizionetitolostudio'] ;?></td>
</tr>
<tr>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Area Titolo Studio<br><br></td>
  <td><?echo $row['areatitolostudio'] ;?></td>
</tr>
<tr>

<?
$collegamento=$row['id'];
$query3 = "SELECT * FROM formazione WHERE id_titolostudio='$collegamento' ";
$result3 = mysql_query($query3, $db);
$totalrows = mysql_num_rows($result3);
if ($totalrows=='0'){}
else{
while ($row3 = mysql_fetch_array($result3)){
?>
<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Voto</td>
  <td><?echo $row3['voto'] ;?></td>
</tr>
<tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Voto Massimo</td>
  <td><?echo $row3['votomassimo'] ;?></td>
</tr>
<tr>
<?
  }
 }
}
}

$query = "SELECT * FROM conoscenzelingua  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows=='0'){}
else{
?>


<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="TitleSmall">Capacità e competenze<wbr> Linguistiche</td>
  <td>&nbsp;</td>
</tr>

<?

while ($row = mysql_fetch_array($result)){
?>
<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>Lingua</i></td>
  <td><?echo $row['lingua'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Livello Conosceze</td>
  <td><?echo $row['livelloconoscenza'] ;?><br></td>
</tr>

<?
}
}

$query = "SELECT * FROM conoscenzeinfo  WHERE candidato_id= $id ";
$result = mysql_query($query, $db);
$totalrows = mysql_num_rows($result);
if ($totalrows=='0'){}
else{
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="TitleSmall">Capacità e competenze<wbr> Informatiche</td>
  <td>&nbsp;</td>
</tr>
<?

while ($row = mysql_fetch_array($result)){
?>
<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle"><i>Software</i></td>
  <td><?echo $row['software'] ;?></td>
</tr>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="NormalTitle">Livello Conoscenza</td>
  <td><?echo $row['livelloconoscenza'] ;?><br></td>
</tr>

<?
}
}

if ($rowd['patenti'] ){
?>

<tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="TitleSmall">Altre Informazioni<br><br></td>
  <td>&nbsp;</td>
</tr>

<tr>
  <td colspan="2" class="NormalTitle">Patenti<br><br></td>
  <td>
	<?echo $rowd['patenti'] ;?>	</td>
</tr>
<?
}
?>


      <tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>   <td colspan="2" class="NormalTitle"><img src="images/trasp.gif" alt="" width="1" height="5" border="0"></td>   <td><img src="images/trasp.gif" alt="" width="10" height="5" border="0"></td></tr><tr>
  <td colspan="2" class="Title"><img src="images/trasp.gif" alt="" width="1" height="30" border="0"></td>
  <td>
	<em>L'utente ha espresso il proprio consenso al trattamento dei dati personali, ai sensi del Decreto Legislativo 196/2003 e successive integrazioni e modificazioni, in data 22/04/2007</em>
	</td>
</tr>
<tr>
  <td colspan="2" class="NormalTitle" style="font-style: italic;">Curriculum vitae di<br><strong> <?echo $rowd['nome'] ;?> &nbsp;&nbsp;<?echo $rowd['cognome'] ;?></strong></td>
  <td align="right" valign="top" style="text-align : right;"><img src="images/poweredbycvengine_small.gif" alt="" width="250" height="42" border="0"></td>
</tr>
</table>
</body>
</html>