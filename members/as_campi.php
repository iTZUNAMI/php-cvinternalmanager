
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
//parte sopra
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
				HideAll("cat",5);
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



<?

body();

if (($check['team']=='Admin'))        { menucampiadmin();}
if (($check['team']=='Moderatore'))     { menucampimod();}
if (($check['team']=='Membro'))        { menu();}

bodycontinua();


//GESTIONE SOFTWARE
if ($mode=='qelimina_info'){

$query = "DELETE  FROM software_elenco WHERE name='$val_elimina' ";
if (mysql_query($query, $db)) {redirect("as_campi.php"); }
else {echo "Erorre";}
}


if ($mode=='qaggiungi_info'){
if($val_nuovo!=""){

$query = "INSERT INTO software_elenco (name) VALUES ('$val_nuovo') ";
if (mysql_query($query, $db))
{redirect("as_campi.php"); } else {echo "Erorre";}}


else{echo "<font color='RED'>Campo Inserimento Vuoto!!</font>";}
}



//GESTIONE LINGUE
if ($mode=='qelimina_lingue'){

$query = "DELETE  FROM lingue_elenco WHERE name='$val_elimina' ";
if (mysql_query($query, $db)) {redirect("as_campi.php"); }
else {echo "Erorre";}
}


if ($mode=='qaggiungi_lingue'){
if($val_nuovo!=""){

$query = "INSERT INTO lingue_elenco (name) VALUES ('$val_nuovo') ";
if (mysql_query($query, $db))
{redirect("as_campi.php"); } else {echo "Erorre";}}


else{echo "<font color='RED'>Campo Inserimento Vuoto!!</font>";}
}


//GESTIONE TITOLI
if ($mode=='qelimina_titolo'){

$query = "DELETE  FROM titoli_elenco WHERE name='$val_elimina' ";
if (mysql_query($query, $db)) {redirect("as_campi.php"); }
else {echo "Erorre";}
}


if ($mode=='qaggiungi_titolo'){
if($val_nuovo!=""){

$query = "INSERT INTO titoli_elenco (name) VALUES ('$val_nuovo') ";
if (mysql_query($query, $db))
{redirect("as_campi.php"); } else {echo "Erorre";}}


else{echo "<font color='RED'>Campo Inserimento Vuoto!!</font>";}
}


//GESTIONE TITOLI AREA
if ($mode=='qelimina_titolo_area'){

$query = "DELETE  FROM titoli_area_elenco WHERE name='$val_elimina' ";
if (mysql_query($query, $db)) {redirect("as_campi.php"); }
else {echo "Erorre";}
}


if ($mode=='qaggiungi_titolo_area'){
if($val_nuovo!=""){

$query = "INSERT INTO titoli_area_elenco (name) VALUES ('$val_nuovo') ";
if (mysql_query($query, $db))
{redirect("as_campi.php"); } else {echo "Erorre";}}


else{echo "<font color='RED'>Campo Inserimento Vuoto!!</font>";}
}

//GESTIONE COMUNI
if ($mode=='qelimina_comune'){

$query = "DELETE  FROM comune WHERE name='$val_elimina' ";
if (mysql_query($query, $db)) {redirect("as_campi.php"); }
else {echo "Erorre";}
}

?>


  
<div id='cat1' style='display: none'>
<h2>Gestione Campi:</h2>
  <br><br>
    <table width="402" border="0">
    <tr>
      <td width="213"><p><h4>Software:</h4></p><br>
 <form method="POST" name="modulo" ACTION="as_campi.php?mode=qelimina_info" >
  <select name="val_elimina" >
            <option>  </option>
         <? $query = "SELECT name FROM software_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </select> 
<input TYPE="submit" value="Elimina"  >
      </td>
   </tr>
 </FORM>
 

<form method="POST" name="modulo" ACTION="as_campi.php?mode=qaggiungi_info" >
 <tr><td><p><br>Nuovo:specificare </p>
  <p>
<input type="text" name="val_nuovo" />
<input TYPE="submit" value="Aggiungi"  >
  </p>
  </td></tr>
</table>
<hr /><BR>
</FORM>

 </div>


<div id='cat2' style='display: none'>
<h2>Gestione Campi:</h2>
  <br><br>
    <table width="402" border="0">
    <tr>
      <td width="213"><p><h4>Lingue:</h4></p><br>
 <form method="POST" name="modulo" ACTION="as_campi.php?mode=qelimina_lingue" >
  <select name="val_elimina" >
            <option>  </option>
         <? $query = "SELECT name FROM lingue_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </select> 
<input TYPE="submit" value="Elimina"  >
      </td>
   </tr>
 </FORM>


 
<form method="POST" name="modulo" ACTION="as_campi.php?mode=qaggiungi_lingue" >
 <tr><td><p><br>Nuova:specificare </p>
  <p>
<input type="text" name="val_nuovo" />
<input TYPE="submit" value="Aggiungi"  >
  </p>
  </td></tr>
</table>
<hr /><BR>
</FORM>

</div>


<div id='cat3' style='display: none'>
<h2>Gestione Campi:</h2>
  <br><br>
    <table width="402" border="0">
    <tr>
      <td width="213"><p><h4>Titoli:</h4></p><br>
 <form method="POST" name="modulo" ACTION="as_campi.php?mode=qelimina_titolo" >
  <select name="val_elimina" >
            <option>  </option>
         <? $query = "SELECT name FROM titoli_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </select> 
<input TYPE="submit" value="Elimina"  >
      </td>
   </tr>
 </FORM>


<form method="POST" name="modulo" ACTION="as_campi.php?mode=qaggiungi_titolo" >
 <tr><td><p><br>Nuovo:specificare </p>
  <p>
<input type="text" name="val_nuovo" />
<input TYPE="submit" value="Aggiungi"  >
  </p>
  </td></tr>
</table>
<hr /><BR>
</FORM>

</div>


<div id='cat4' style='display: none'>
<h2>Gestione Campi:</h2>
  <br><br>
    <table width="402" border="0">
    <tr>
      <td width="213"><p><h4>Titoli-Area:</h4></p><br>
 <form method="POST" name="modulo" ACTION="as_campi.php?mode=qelimina_titolo_area" >
  <select name="val_elimina" >
            <option>  </option>
         <? $query = "SELECT name FROM titoli_area_elenco";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </select> 
<input TYPE="submit" value="Elimina"  >
      </td>
   </tr>
 </FORM>



<form method="POST" name="modulo" ACTION="as_campi.php?mode=qaggiungi_titolo_area" >
 <tr><td><p><br>Nuovo:specificare </p>
  <p>
<input type="text" name="val_nuovo" />
<input TYPE="submit" value="Aggiungi"  >
  </p>
  </td></tr>
</table>
<hr /><BR>
</FORM>

</div>


<div id='cat5' style='display: none'>
<h2>Gestione Campi:</h2>
  <br><br>
    <table width="402" border="0">
    <tr>
      <td width="213"><p><h4>Comuni:</h4></p><br>
 <form method="POST" name="modulo" ACTION="as_campi.php?mode=qelimina_comune" >
  <select name="val_elimina" >
            <option>  </option>
         <? $query = "SELECT name FROM comune";  
            $result = mysql_query($query, $db);
             while ($row = mysql_fetch_array($result)){
             echo"<option>$row[name]</option>";}
         ?>
  </select> 
<input TYPE="submit" value="Elimina"  >
      </td>
   </tr>
 </FORM>


</table>
 </div>



			
			
<?
 footer(); 
?>

