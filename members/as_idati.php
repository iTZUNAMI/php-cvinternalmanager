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

?>



<h2>Riepilogo:</h2><br /><br>
<h4>Dati Anagrafici</h4> <br>


<?
if ($mode=='riepilogo'){



//seleziono nome provincia fini grafici riepilogo

$query = "SELECT name FROM provincia  WHERE id='$provincia' ";
$result=mysql_query($query, $db);
$row = mysql_fetch_array($result);
$nomeprovincia = $row['name'];


//seleziono nome comune da casella di prima se true
if($si_comune=='on')
{$nomecomune=$nuovo_comune;}
//altrimenti il comune è gia nella lista e lo seleziono il nome graficamente x riepilogo
else{
$query = "SELECT name FROM comune WHERE id='$comune' ";
$result=mysql_query($query, $db);
$row = mysql_fetch_array($result);
$nomecomune=$row['name'];
}
?>  
<FORM METHOD=POST ACTION="as_idati.php?mode=qdati">
<?

$controlla=0;

echo "
<b>Nome:</b> $nome  "; if ($nome==""){echo "<font color='RED'><i>Obbligatorio</i></font>"; $controlla=1;}   
echo "<br> 
<b>Cognome:</b> $cognome "; if ($cognome==""){echo "<font color='RED'><i>Obbligatorio</i></font>"; $controlla=1;} 
 echo " <br>
<b>Data di Nascita:</b> $GIORNODATANASCITA/$MESEDATANASCITA/$ANNODATANASCITA ";
if ($GIORNODATANASCITA==""){echo "<font color='RED'><i>Giorno non corretto </i></font>"; $controlla=1;} 
if ($MESEDATANASCITA==""){echo "<font color='RED'><i>Mese non corretto </i></font>"; $controlla=1;} 
if ($ANNODATANASCITA==""){echo "<font color='RED'><i>Anno non corretto </i></font>";$controlla=1;} 
if ( $ANNODATANASCITA <1900 || $ANNODATANASCITA >2050 )
{ echo "<font color='RED'><i> Data improbabile</i></font>"; $controlla=1; }
 
echo " <br>
<b>Telefono:</b> $telefono "; 
if ($telefono==""){echo "<font color='RED'><i>Obbligatorio</i></font>"; $controlla=1;} 
 echo "<br>
<b>Email:</b> $email <br>
<b>Provincia:</b>  $nomeprovincia <br>
<b>Comune:</b>  $nomecomune<br>
<b>Area:</b> $area <br>
<b>Periodo di Preavviso:</b> $preavviso <br>
<b>Patenti:</b> $patenti <br>
<b>Allegato:</b> $allegato <br>
<b>Note:</b> $note <br>
";

echo "<INPUT TYPE=\"HIDDEN\" NAME=\"nome\" value='$nome'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"cognome\" value='$cognome'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"GIORNODATANASCITA\" value='$GIORNODATANASCITA'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"MESEDATANASCITA\" value='$MESEDATANASCITA'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"ANNODATANASCITA\" value='$ANNODATANASCITA'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"telefono\" value='$telefono'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"email\" value='$email'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"provincia\" value='$provincia'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"comune\" value='$comune'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"area\" value='$area'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"si_comune\" value='$si_comune'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"nomecomune\" value='$nomecomune'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"preavviso\" value='$preavviso'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"patenti\" value='$patenti'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"allegato\" value='$allegato'>";
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"note\" value='$note'>";

?>

<center>
<input type=button value="<Indietro" onClick="history.go(-1)">&nbsp;&nbsp;&nbsp;&nbsp;
<?
if ($controlla==1)
{}
else
{echo"<INPUT TYPE='submit' VALUE='Avanti>'>";}
?>
</center>
</FORM>
<?
}

 


if ($mode=='qdati'){
//codifica in mysql data americana
$nascita="$ANNODATANASCITA-$MESEDATANASCITA-$GIORNODATANASCITA";


if($si_comune=='on'){
//se si aggiungo questo nuovo comune sotto la provincia..
$query = "INSERT INTO comune (catid, name) VALUES ('$provincia','$nomecomune') ";
if (mysql_query($query, $db))
{ }
else
{echo "Erorre durante l'inserimento1";}

//seleziono l'id dell'area appena inserita
$query = "SELECT id FROM comune WHERE name='$nomecomune' ";
if (mysql_query($query, $db))
{ }
else
{echo "Erorre durante l'inserimento2";}
$result = mysql_query($query, $db);
$row = mysql_fetch_array($result);
$comune=$row['id'];
}

$ultimoagg=date("Y-m-d");


$query = "INSERT INTO candidati (nome, cognome, nascita, provinciaid, comuneid, area, telefono, email, preavviso, patenti, allegato, note, ultimamodifica) 
VALUES ('$nome', '$cognome', '$nascita', '$provincia', '$comune', '$area', '$telefono', '$email', 
'$preavviso',  '$patenti', '$allegato', '$note', '$ultimoagg')";


if (mysql_query($query, $db))
{ redirect("as_pannello.php?id=ultimo"); }
else
{echo "Erorre durante l'inserimento3<br>";}




}

footer(); 

mysql_close($db); 

?>