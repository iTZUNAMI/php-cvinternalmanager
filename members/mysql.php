<?
//configurazione della connessione al database

$db_host="localhost";
$db_user="root";
$db_password="";
$db = mysql_connect($db_host, $db_user, $db_password);
if ($db == FALSE)
die ("Errore nella connessione. Verificare i parametri nel file mysql.php");
$db_name="test";
mysql_select_db($db_name, $db)
or die ("Errore nella selezione del database. Verificare i parametri nel file mysql.php");

function aggiorna ($id){
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="test";
$db = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db($db_name, $db);
$last=date("Y-m-d");
$query2= " UPDATE candidati SET ultimamodifica='$last' WHERE id='$id' ";
 mysql_query($query2, $db);
}


// variabili e modi globali



// ricerca

if (isset($_REQUEST['mode'])) $mode = $_REQUEST['mode'];
else $mode=NULL;

if (isset($_REQUEST['lingua'])) $lingua = $_REQUEST['lingua'];
else $lingua=NULL;

if (isset($_REQUEST['settore'])) $settore = $_REQUEST['settore'];
else $settore=NULL;


if (isset($_REQUEST['area_titolo'])) $area_titolo = $_REQUEST['area_titolo'];
else $area_titolo=NULL;

if (isset($_REQUEST['titolo'])) $titolo = $_REQUEST['titolo'];
else $titolo=NULL;

if (isset($_REQUEST['provinciaid'])) $provinciaid = $_REQUEST['provinciaid'];
else $provinciaid=NULL;

if (isset($_REQUEST['eta'])) $eta = $_REQUEST['eta'];
else $eta=NULL;

if (isset($_REQUEST['select'])) $select = $_REQUEST['select'];
else $select=NULL;

if (isset($_REQUEST['left '])) $left = $_REQUEST['left'];
else $left=NULL;


//riepilogo inserimento

if (isset($_REQUEST['provincia'])) $provincia = $_REQUEST['provincia'];
else $provincia=NULL;

if (isset($_REQUEST['result'])) $result = $_REQUEST['result'];
else $result=NULL;


if (isset($_REQUEST['result'])) $result = $_REQUEST['result'];
else $result=NULL;

if (isset($_REQUEST['si_comune'])) $si_comune = $_REQUEST['si_comune'];
else $si_comune=NULL;


if (isset($_REQUEST['nuovo_comune'])) $nuovo_comune = $_REQUEST['nuovo_comune'];
else $nuovo_comune=NULL;

if (isset($_REQUEST['nomecomune'])) $nomecomune = $_REQUEST['nomecomune'];
else $nomecomune=NULL;

if (isset($_REQUEST['comune'])) $comune = $_REQUEST['comune'];
else $comune=NULL;

if (isset($_REQUEST['altro_p'])) $altro_p = $_REQUEST['altro_p'];
else $altro_p=NULL;

if (isset($_REQUEST['altro_c'])) $altro_c = $_REQUEST['altro_c'];
else $altro_c=NULL;

if (isset($_REQUEST['provincia_old'])) $provincia_old = $_REQUEST['provincia_old'];
else $provincia_old=NULL;

if (isset($_REQUEST['comune_old'])) $comune_old = $_REQUEST['comune_old'];
else $comune_old=NULL;


if (isset($_REQUEST['nome'])) $nome = $_REQUEST['nome'];
else $nome=NULL;


if (isset($_REQUEST['cognome'])) $cognome = $_REQUEST['cognome'];
else $cognome=NULL;


if (isset($_REQUEST['GIORNODATANASCITA'])) $GIORNODATANASCITA = $_REQUEST['GIORNODATANASCITA'];
else $GIORNODATANASCITA=NULL;

if (isset($_REQUEST['MESEDATANASCITA'])) $MESEDATANASCITA = $_REQUEST['MESEDATANASCITA'];
else $MESEDATANASCITA=NULL;

if (isset($_REQUEST['ANNODATANASCITA'])) $ANNODATANASCITA = $_REQUEST['ANNODATANASCITA'];
else $ANNODATANASCITA=NULL;



if (isset($_REQUEST['telefono'])) $telefono = $_REQUEST['telefono'];
else $telefono=NULL;


if (isset($_REQUEST['email'])) $email = $_REQUEST['email'];
else $email=NULL;


if (isset($_REQUEST['area'])) $area = $_REQUEST['area'];
else $area=NULL;




if (isset($_REQUEST['preavviso'])) $preavviso = $_REQUEST['preavviso'];
else $preavviso=NULL;

if (isset($_REQUEST['patenti'])) $patenti = $_REQUEST['patenti'];
else $patenti=NULL;

if (isset($_REQUEST['allegato'])) $allegato = $_REQUEST['allegato'];
else $allegato=NULL;



if (isset($_REQUEST['note'])) $note = $_REQUEST['note'];
else $note=NULL;

// pannello

if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
else $id=NULL;

// infor

if (isset($_REQUEST['altro'])) $altro = $_REQUEST['altro'];
else $altro=NULL;

if (isset($_REQUEST['altro2'])) $altro2 = $_REQUEST['altro2'];
else $altro2=NULL;

if (isset($_REQUEST['descrizionetitolostudio'])) $descrizionetitolostudio = $_REQUEST['descrizionetitolostudio'];
else $descrizionetitolostudio=NULL;

if (isset($_REQUEST['nuovo_titolo'])) $nuovo_titolo = $_REQUEST['nuovo_titolo'];
else $nuovo_titolo=NULL;

if (isset($_REQUEST['nuovo_area_titolo'])) $nuovo_area_titolo = $_REQUEST['nuovo_area_titolo'];
else $nuovo_area_titolo=NULL;

if (isset($_REQUEST['areatitolostudio'])) $areatitolostudio = $_REQUEST['areatitolostudio'];
else $areatitolostudio=NULL;

if (isset($_REQUEST['cid'])) $cid = $_REQUEST['cid'];
else $cid=NULL;


// campi

if (isset($_REQUEST['val_elimina'])) $val_elimina = $_REQUEST['val_elimina'];
else $val_elimina=NULL;


if (isset($_REQUEST['val_nuovo'])) $val_nuovo = $_REQUEST['val_nuovo'];
else $val_nuovo=NULL;

if (isset($_REQUEST['val_elimina'])) $val_elimina = $_REQUEST['val_elimina'];
else $val_elimina=NULL;



//lingua
if (isset($_REQUEST['nuova_lingua'])) $nuova_lingua = $_REQUEST['nuova_lingua'];
else $nuova_lingua=NULL;

if (isset($_REQUEST['livelloconoscenza'])) $livelloconoscenza = $_REQUEST['livelloconoscenza'];
else $livelloconoscenza=NULL;

if (isset($_REQUEST['query'])) $query = $_REQUEST['query'];
else $query=NULL;


// esperinze
if (isset($_REQUEST['nomeazienda'])) $nomeazienda = $_REQUEST['nomeazienda'];
else $nomeazienda=NULL;

if (isset($_REQUEST['settoremeceologico'])) $settoremeceologico = $_REQUEST['settoremeceologico'];
else $settoremeceologico=NULL;


if (isset($_REQUEST['dipendenticandidato'])) $dipendenticandidato = $_REQUEST['dipendenticandidato'];
else $dipendenticandidato=NULL;

if (isset($_REQUEST['compiti'])) $compiti = $_REQUEST['compiti'];
else $compiti=NULL;


if (isset($_REQUEST['datag_assunzione'])) $datag_assunzione = $_REQUEST['datag_assunzione'];
else $datag_assunzione=NULL;

if (isset($_REQUEST['datam_assunzione'])) $datam_assunzione = $_REQUEST['datam_assunzione'];
else $datam_assunzione=NULL;

if (isset($_REQUEST['dataa_assunzione'])) $dataa_assunzione = $_REQUEST['dataa_assunzione'];
else $dataa_assunzione=NULL;


if (isset($_REQUEST['tipocontratto'])) $tipocontratto = $_REQUEST['tipocontratto'];
else $tipocontratto=NULL;

if (isset($_REQUEST['livello'])) $livello = $_REQUEST['livello'];
else $livello=NULL;

if (isset($_REQUEST['retribuzione'])) $retribuzione = $_REQUEST['retribuzione'];
else $retribuzione=NULL;

if (isset($_REQUEST['benefits'])) $benefits = $_REQUEST['benefits'];
else $benefits=NULL;


// colloqui
if (isset($_REQUEST['GIORNODATANASCITA'])) $GIORNODATANASCITA = $_REQUEST['GIORNODATANASCITA'];
else $GIORNODATANASCITA=NULL;

if (isset($_REQUEST['MESEDATANASCITA'])) $MESEDATANASCITA = $_REQUEST['MESEDATANASCITA'];
else $MESEDATANASCITA=NULL;

if (isset($_REQUEST['ANNODATANASCITA'])) $benefits = $_REQUEST['ANNODATANASCITA'];
else $ANNODATANASCITA=NULL;



if (isset($_REQUEST['posizioneproposta'])) $posizioneproposta = $_REQUEST['posizioneproposta'];
else $posizioneproposta=NULL;

if (isset($_REQUEST['azienda'])) $azienda = $_REQUEST['azienda'];
else $azienda=NULL;

if (isset($_REQUEST['aspetticomportamentali'])) $aspetticomportamentali = $_REQUEST['aspetticomportamentali'];
else $aspetticomportamentali=NULL;


if (isset($_REQUEST['coerenzaconruolo'])) $coerenzaconruolo = $_REQUEST['coerenzaconruolo'];
else $coerenzaconruolo=NULL;

if (isset($_REQUEST['trasferte'])) $trasferte = $_REQUEST['trasferte'];
else $trasferte=NULL;

if (isset($_REQUEST['parttime'])) $parttime = $_REQUEST['parttime'];
else $parttime=NULL;

if (isset($_REQUEST['tempodeterminato'])) $tempodeterminato = $_REQUEST['tempodeterminato'];
else $tempodeterminato=NULL;

if (isset($_REQUEST['valutazione'])) $valutazione = $_REQUEST['valutazione'];
else $valutazione=NULL;

if (isset($_REQUEST['valutazione'])) $valutazione = $_REQUEST['valutazione'];
else $valutazione=NULL;

if (isset($_REQUEST['verifica_conoscenze'])) $verifica_conoscenze = $_REQUEST['verifica_conoscenze'];
else $verifica_conoscenze=NULL;

if (isset($_REQUEST['verifica_abilita'])) $verifica_abilita = $_REQUEST['verifica_abilita'];
else $verifica_abilita=NULL;

if (isset($_REQUEST['verifica_motivazioni'])) $verifica_motivazioni = $_REQUEST['verifica_motivazioni'];
else $verifica_motivazioni=NULL;


// titolo


if (isset($_REQUEST['id_e'])) $id_e = $_REQUEST['id_e'];
else $id_e=NULL;

if (isset($_REQUEST['vecchioid'])) $vecchioid = $_REQUEST['vecchioid'];
else $vecchioid=NULL;

if (isset($_REQUEST['voto'])) $voto = $_REQUEST['voto'];
else $voto=NULL;

if (isset($_REQUEST['votomassimo'])) $votomassimo = $_REQUEST['votomassimo'];
else $votomassimo=NULL;


if (isset($_REQUEST['software'])) $software = $_REQUEST['software'];
else $software=NULL;

// ruoli
if (isset($_REQUEST['ruolo'])) $ruolo = $_REQUEST['ruolo'];
else $ruolo=NULL;


// ricerca q1

if (isset($_REQUEST['chiave'])) $chiave = $_REQUEST['chiave'];
else $chiave=NULL;















function redirect($url, $seconds = FALSE)
{
    if (!headers_sent() && $seconds == FALSE)
    {
        header("Location: " . $url);
    }
    else
    {
        if ($seconds == FALSE)
        {
            $seconds = "0";
        }
        echo "<meta http-equiv=\"refresh\" content=\"$seconds;url=$url\">";
    }
}





//funzione che converte la data da america a normale
function conv_date ($data)
{
  list ($y, $m, $d) = explode ("-", $data);
  return "$d/$m/$y";
}



//menu utente
function menu(){
echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
		
        </div>";
}

//menu mod
function menumod(){
echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
		
        </div>";
}

// menu admin
function menuadmin(){
echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='../admin/authuser.php'>GESTIONE UTENTI</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
		
        </div>";
}
//menu admin pannello utente
function menuadminpan($id){
echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='../admin/authuser.php'>GESTIONE UTENTI</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li><a href='asm_curriculum.php?id=$id'>Visualizza Curriculum</a></li>

<li><a href='as_mdati.php?mode=confermaelimina&id=$id'>Elimina Curriculum</a></li><br><br>

<li><a href='as_titolo.php?mode=aggiungi&id=$id'>Aggiungi Titolo</a></li>

<li><a href='as_info.php?mode=aggiungi&id=$id'>Conoscenza Informatica</a></li>

<li><a href='as_lingue.php?mode=aggiungi&id=$id'>Conoscenza Linguistica</a></li>

<li><a href='as_esperienze.php?mode=aggiungi&id=$id'>Aggiungi Esperienza</a></li>

<li><a href='as_colloqui.php?mode=aggiungi&id=$id'>Aggiungi Colloquio</a></li>
</ul>   ";
}

//menu mod pannello utente
function menumodpan($id){
echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li><a href='asm_curriculum.php?id=$id'>Visualizza Curriculum</a></li>

<li><a href='as_mdati.php?mode=confermaelimina&id=$id'>Elimina Curriculum</a></li><br><br>

<li><a href='as_titolo.php?mode=aggiungi&id=$id'>Aggiungi Titolo</a></li>

<li><a href='as_info.php?mode=aggiungi&id=$id'>Conoscenza Informatica</a></li>

<li><a href='as_lingue.php?mode=aggiungi&id=$id'>Conoscenza Linguistica</a></li>

<li><a href='as_esperienze.php?mode=aggiungi&id=$id'>Aggiungi Esperienza</a></li>

<li><a href='as_colloqui.php?mode=aggiungi&id=$id'>Aggiungi Colloquio</a></li>
</ul>   ";
}

// funzione head dell'html
function head(){
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
	'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
	<title>Gestione Curriculum Vitae</title>
	<meta http-equiv='Content-Language' content='it' />
	<meta name='description' content='Curriculum Vitae' />
	<meta name='keywords' content='Gestione Curriculum Vitae' /> ";
}
    
// stile css  
 function stile(){  
 echo " <style type='text/css' media='all'>@import 'images/style.css';</style> ";}

// stile css utente non loggato
function stilefuori() {  
echo " <style type='text/css' media='all'>@import 'members/images/style.css';</style> ";}

//stile admin css fuori
function stilefuoriadmin() {  
echo " <style type='text/css' media='all'>@import '../members/images/style.css';</style> ";}

//funzione body con ricerca in alto  
function body(){
echo "
</head>
<body>
<div id='page-container'>	
	<div id='top'>
		<a href='#'>Aiuto</a> | 
		<a href='#'>Contatti</a> 
		<div class='comment'>
		<form method='POST'  ACTION='asm_ricerca.php?mode=q1'> Ricerca Veloce Curriculum Vitae:  <input type='text' name='chiave' class='search' /> <input type='submit' value='Cerca' class='submit' /></form>
		</div>
	</div> ";
}	

// funzione che conlcude il body ma dopo la scelta del menu laterale..
function bodycontinua(){
echo "	
</div>
	<div id='content'>
		<div class='padding'>";
}


//funzione finale per link sotto e immagini
function footer(){
echo "	</div>
	</div>
	
	<div id='prefooter'>
	
	  
	</div>
	
	<div id='footer'>
		<a href='#'>Home</a> | 
		<a href='#'>Contatti</a> | 
		<a href='#'>Mappa del sistema</a> | 
		<a href='#'>Domande Frequenti</a> | 
	
	<br />
	 Sistema gestione Curriculum
	</div>
</div>
</body>
</html>";
}

//meun fuori per cambio pass
function menufuori(){
echo "<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='#'>Aiuto</a></li>
			</ul>
		</div>
     ";
}

//menu fuori admin
function menufuoriadmin(){
echo "<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='../members/index.php'>Home</a></li>
            <li><a href='#'>Aiuto</a></li>
			</ul>
		</div>
     ";
}

//menu ricerca admin 
function menuricercaadmin() {
echo "	<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='../admin/authuser.php'>GESTIONE UTENTI</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li>
";
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366">Ricerca Avanzata</font></a><br><?
echo "
</li>
<li>
";
?><a href="asm_ricerca.php?mode=ultimi"><font color="#003366">Curriculum Recenti</font></a><br><?
echo "
</li>
</ul>";

}


//menu ricerca utente
function menuricerca() {

echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li>
";
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366">Ricerca Avanzata</font></a><br><?
echo "
</li>
<li>
";
?><a href="asm_ricerca.php?mode=ultimi"><font color="#003366">Curriculum Recenti</font></a><br><?
echo "
</li>
</ul>";

}

//menu ricerca mod
function menuricercamod() {

echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li>
";
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366">Ricerca Avanzata</font></a><br><?
echo "
</li>
<li>
";
?><a href="asm_ricerca.php?mode=ultimi"><font color="#003366">Curriculum Recenti</font></a><br><?
echo "
</li>
</ul>";

}



//menu gestione campi admin
function menucampiadmin() {

echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='../admin/authuser.php'>GESTIONE UTENTI</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li>
";
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366">Software</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat2');"><font color="#003366">Lingue</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat3');"><font color="#003366">Titoli</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat4');"><font color="#003366">Titoli - Area</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat5');"><font color="#003366">Comuni</font></a><br><?
echo "
</li>
";

}

//menu gestione campi mod
function menucampimod() {

echo "		<div id='sidebar-a'>
		<div class='padding'>
			<ul id='menu'>
			<li><a href='index.php'>Home</a></li>
            <li><a href='asm_ricerca.php'>Ricerca Avanzata</a></li>
            <li><a href='as_dati.php'>Nuovo Curriculum</a></li>
            <li><a href='as_campi.php'>Gestione Campi</a></li>
			<li><a href='../chgpwd.php'>Cambio Password</a></li>
            <li><a href='../logout.php'>Esci</a></li>
			</ul>
         </div>
            
<ul id='menu2'>
<li>
";
?><a href="javascript:ShowHideDiv('cat1');"><font color="#003366">Software</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat2');"><font color="#003366">Lingue</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat3');"><font color="#003366">Titoli</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat4');"><font color="#003366">Titoli - Area</font></a><br><?
echo "
</li>
<li>
";
?><a href="javascript:ShowHideDiv('cat5');"><font color="#003366">Comuni</font></a><br><?
echo "
</li>
";

}








?>