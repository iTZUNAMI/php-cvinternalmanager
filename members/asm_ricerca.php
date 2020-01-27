<?
	include_once ("../auth.php");
	include_once ("../authconfig.php");
	include_once ("../check.php");

   if (!($check['team']=='Admin') && !($check['team']=='Moderatore') && !($check['team']=='Membro'))
  {
      echo 'You are not allowed to access this page.';
		exit();
    }
include ("mysql.php");

head();
stile();
 








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
				HideAll("cat",2);
				ShowDiv(ID);
			}
		}
		
		function HideAll(prefix,iterations){
			for (i=1;i<=iterations;i++){
				HideDiv(prefix+i);
			}
		}        
</script>
</head>


<body>


<div id='page-container'>	
	<div id='top'>
		<a href='#'>Aiuto</a> | 
		<a href='#'>Contatti</a> 
		<div class='comment'>
		<form method='POST'  ACTION='asm_ricerca.php?mode=q1'> Ricerca Veloce Curriculum Vitae:  <input type='text' name='chiave' class='search' /> <input type='submit' value='Cerca' class='submit' /></form>
		</div>
	</div>
<?

if (($check['team']=='Admin'))        { menuricercaadmin();}
if (($check['team']=='Moderatore'))     { menuricercamod();}
if (($check['team']=='Membro'))        { menuricerca();}

bodycontinua();
?>
		

<div id='cat1' style='display: none'>
<form method="POST"  ACTION="asm_ricerca.php?mode=combo">
 <h2> Ricerca Candidato:</h2>
 <br><br>
    <table >
    <tr><td width="212">
 <p><font color='#003366'><b>Eta' :</b></font><br>
 <select name="eta" >
   <option>Qualsiasi</option>
   <option>Maggiore di</option>
   <option>Minore di</option>
 </select>
 <input type=text name=anni size=2 maxlength =2>
</p>
</td>
<td width="204" >
  <p><font color='#003366'><b>Titolo:</b></font><br>
    <select name="titolo" >
      <option>Qualsiasi</option>
      <? $query = "SELECT name FROM titoli_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </p>   </select>
 </td>
  </tr>
  <tr>
  
<td >
 <p><font color='#003366'><b>Provincia:</b></font><br>
<select name="provinciaid">
        <option value="0">Qualsiasi</option>
        <?
$result = mysql_query("SELECT id, name FROM provincia ORDER BY name ASC ") ;	
while ($row = mysql_fetch_assoc($result))
{

echo "<option value=\"";
echo $row['id'];
echo "\">";
echo $row['name'];
echo "</option>";
}
 ?>
</p>  </select>
    
</td>
  <td width="204" >
  <p><font color='#003366'><b>Area di Studio:</b></font>
    <select name="area_titolo" >
      <option>Qualsiasi</option>
      <? $query = "SELECT name FROM titoli_area_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
     </p></select>

 </td>


  </tr>
  <tr> 
<td>
  <p><font color='#003366'><b>Settore :</b></font></p>
    <input type=text name=settore> 
     <br><br><br>  <input type=submit value="Ricerca Candidati">
</td>

 <td>
  <p><font color='#003366'><b>Lingua: </b> </font> </p>
      <? 
      
     
      $query = "SELECT name FROM lingue_elenco";  
      $result = mysql_query($query, $db);

        
   while ($row = mysql_fetch_array($result)){
    
      echo"<input type='checkbox'  name='$row[name]' > $row[name] <br>";
    
    
      }?>

  </td> 
    </tr>

  </table>
</form>
</div>

        

        



		
        


<div id='cat2' style='display:'>

<?

if ($mode=='combo')
{
$where="";
$andtitolo="";
$andsettore="";
$andlingua="";
$andprovincia="";
$andarea_titolo="";


//lingua

// in $c tengo il num corrispodente alla lingua dalla query

//se tutti checkbox vuoti..
if($lingua=='Qualsiasi') {$andlingua="";}
else{
//altrimenti per ogni devo fare left join di ogni lingua
   $query = "SELECT name FROM lingue_elenco";  
    $result = mysql_query($query, $db);
   //numero lingue selezionate nel checkbox e quindi numero di volte da ripetere 
    $i=1;

while ($row = mysql_fetch_array($result)){
//devo inizializzare ogni variabile $$row['name']


$linguaz=$$row['name'];

if ($linguaz=='on'){
    $andlingua .= " AND c$i.lingua='$linguaz'";
    $i++;
    
    }
    }
}

//settore
if ($settore=="") { $andsettore="$andlingua";}
else{
$andsettore=" AND es.settoremeceologico LIKE '%$settore%' $andlingua";
}



//area titolo studio
if ($area_titolo=='Qualsiasi') {$andarea_titolo="$andsettore";}
else{
$andarea_titolo=" AND ts.areatitolostudio='$area_titolo' $andsettore ";
}

//titolo
if ($titolo=='Qualsiasi') {$andtitolo="$andarea_titolo";}
else{
$andtitolo=" AND ts.descrizionetitolostudio ='$titolo' $andarea_titolo ";
}


//provincia
if ($provinciaid==0) {$andprovincia="$andtitolo";}
else{
    $andprovincia=" AND c.provinciaid='$provinciaid' $andtitolo ";

}


//eta
if ($eta=='Qualsiasi') { 
$where="WHERE YEAR(CURRENT_DATE) - YEAR(nascita) >=18 $andprovincia";
}

if ($eta=="Maggiore di") {
$where="WHERE YEAR(CURRENT_DATE) - YEAR(nascita)  >= '$anni' $andprovincia";
}

if ($eta=="Minore di") {
$where="WHERE YEAR(CURRENT_DATE) - YEAR(nascita)  <= '$anni' $andprovincia";
}

$z=1;
while($z<$i){
$select .= "c$z.lingua, ";
$z++;
}

$z=1;
while($z<$i){
$left .= "left join conoscenzelingua as c$z on c.id=c$z.candidato_id ";
$z++;
}


$query = "SELECT c.id,c.nome, c.cognome,c.provinciaid,c.comuneid,c.telefono, YEAR(nascita) as datay, 

$select 

ts.descrizionetitolostudio, 
es.settoremeceologico
FROM candidati as c
 
$left

left join titolostudio as ts on c.id=ts.id_candidato
left join esperienze as es on c.id=es.id_candidato
$where
GROUP BY c.nome, c.cognome, datay, telefono LIMIT 0,50
";
$result = mysql_query($query, $db);



echo "
<table>
<tr>
<td></td>
";
if (($check['team']!='Membro')) {echo"<td></td><td></td>";}
echo "
<td><font color='#003366'><b>Nome:</b></font><br><hr></td> 
<td><font color='#003366'><b>Cognome:</b></font><br><hr></td> 
<td ><font color='#003366'><b>Eta' :</b></font><br><hr></td> 
<td><font color='#003366'><b>Provincia:</b></font><br><hr></td>
<td><font color='#003366'><b>Comune:</b></font><br><hr></td> 
</tr>";
while ($row = mysql_fetch_array($result))
{
$queryc = "SELECT id FROM colloqui  WHERE candidato_id='$row[id]' ";
$resultc = mysql_query($queryc, $db);
$totalrowsc = mysql_num_rows($resultc);
 
$query2 = "SELECT name FROM provincia WHERE id ='$row[provinciaid]'";
$result2 = mysql_query($query2, $db);
$row2 = mysql_fetch_array($result2);

$query3 = "SELECT name FROM comune WHERE id ='$row[comuneid]'";
$result3 = mysql_query($query3, $db);
$row3 = mysql_fetch_array($result3);
$eta=date("Y")-$row['datay'];
echo " <tr>
<td><a href='asm_curriculum.php?id=$row[id]'><img src='images/word.gif' title='Visualizza' border='0'></a></td>";
if (($check['team']!='Membro')) 
{
echo"<td><a href='as_pannello.php?id=$row[id]'><img src='images/edit.gif' title='Modifica' border='0'></a></td>";

if ($totalrowsc==0){
echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/no_colloqui.gif' border='0' title='Inserisci'></a></td>";}
else 
{echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/si_colloqui.gif' border='0' title='$totalrowsc colloqui '></a></td>";}


}
echo "
 <td>$row[nome]</td> 
 <td>$row[cognome]</td>  
 <td>$eta</td>  
 <td>$row2[name] </td>
 <td>$row3[name] </td>
 </tr>
<tr><td></td></tr>
  "; }
echo "</table>";
}










// ricerca per nome o cognome
if ($mode=='q1')
{

$keys = explode (",", $chiave);

$query = "";
reset ($keys);
while (list(,$parola) = each ($keys))
{ $parola = trim($parola);
if ($parola != "")
$query .= "nome LIKE '%$parola%' OR cognome LIKE '%$parola%'  OR ";
}
$query .= "0";

$query = "SELECT id, nome, cognome, YEAR(nascita) as datay, provinciaid, comuneid
  FROM candidati  WHERE " . $query;
$result = mysql_query($query, $db);
echo "
<table>
<tr>
<td></td>
";
if (($check['team']!='Membro')) {echo"<td></td><td></td>";}
echo "
<td><font color='#003366'><b>Nome:</b></font><br><hr></td> 
<td><font color='#003366'><b>Cognome:</b></font><br><hr></td> 
<td ><font color='#003366'><b>Eta' :</b></font><br><hr></td> 
<td><font color='#003366'><b>Provincia:</b></font><br><hr></td>
<td><font color='#003366'><b>Comune:</b></font><br><hr></td> 
</tr>";
while ($row = mysql_fetch_array($result))
{

$queryc = "SELECT id FROM colloqui  WHERE candidato_id='$row[id]' ";
$resultc = mysql_query($queryc, $db);
$totalrowsc = mysql_num_rows($resultc);


$query2 = "SELECT name FROM provincia WHERE id ='$row[provinciaid]'";
$result2 = mysql_query($query2, $db);
$row2 = mysql_fetch_array($result2);

$query3 = "SELECT name FROM comune WHERE id ='$row[comuneid]'";
$result3 = mysql_query($query3, $db);
$row3 = mysql_fetch_array($result3);
$eta=date("Y")-$row['datay'];
echo " <tr>
<td><a href='asm_curriculum.php?id=$row[id]'><img src='images/word.gif' title='Visualizza' border='0'></a></td>";
if (($check['team']!='Membro')) 
{
echo"<td><a href='as_pannello.php?id=$row[id]'><img src='images/edit.gif' title='Modifica' border='0'></a></td>";

if ($totalrowsc==0){
echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/no_colloqui.gif' border='0' title='Inserisci'></a></td>";}
else 
{echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/si_colloqui.gif' border='0' title='$totalrowsc colloqui '></a></td>";}
}

echo "
 <td>$row[nome]</td> 
 <td>$row[cognome]</td>  
 <td>$eta</td>  
 <td>$row2[name] </td>
 <td>$row3[name] </td>
 </tr>
<tr><td></td></tr>
  "; }
echo "</table>";


}









// cv recenti
if ($mode=='ultimi')
{

$query = "SELECT *, YEAR(nascita) as datay FROM candidati ORDER BY id DESC LIMIT 0,20 ";
$result = mysql_query($query, $db);
echo "
<table>
<tr>
<td></td>
";
if (($check['team']!='Membro')) {echo"<td></td><td></td>";}
echo "
<td><font color='#003366'><b>Nome:</b></font><br><hr></td> 
<td><font color='#003366'><b>Cognome:</b></font><br><hr></td> 
<td ><font color='#003366'><b>Eta' :</b></font><br><hr></td> 
<td><font color='#003366'><b>Provincia:</b></font><br><hr></td>
<td><font color='#003366'><b>Comune:</b></font><br><hr></td> 
</tr>";
while ($row = mysql_fetch_array($result))
{

$queryc = "SELECT id FROM colloqui  WHERE candidato_id='$row[id]' ";
$resultc = mysql_query($queryc, $db);
$totalrowsc = mysql_num_rows($resultc);


$query2 = "SELECT name FROM provincia WHERE id ='$row[provinciaid]'";
$result2 = mysql_query($query2, $db);
$row2 = mysql_fetch_array($result2);

$query3 = "SELECT name FROM comune WHERE id ='$row[comuneid]'";
$result3 = mysql_query($query3, $db);
$row3 = mysql_fetch_array($result3);
$eta=date("Y")-$row['datay'];
echo " <tr>
<td><a href='asm_curriculum.php?id=$row[id]'><img src='images/word.gif' title='Visualizza' border='0'></a></td>";
if (($check['team']!='Membro')) 
{
echo"<td><a href='as_pannello.php?id=$row[id]'><img src='images/edit.gif' title='Modifica' border='0'></a></td>";

if ($totalrowsc==0){
echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/no_colloqui.gif' border='0' title='Inserisci'></a></td>";}
else 
{echo"<td><a href='as_colloqui.php?mode=aggiungi&id=$row[id]'><img src='images/si_colloqui.gif' border='0' title='$totalrowsc colloqui '></a></td>";}
}

echo "
 <td>$row[nome]</td> 
 <td>$row[cognome]</td>  
 <td>$eta</td>  
 <td>$row2[name] </td>
 <td>$row3[name] </td>
 </tr>
<tr><td></td></tr>
  "; }
echo "</table>";


}
?>

</div>



<?



footer();

?>

