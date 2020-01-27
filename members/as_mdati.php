<html>
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


if ($mode=='confermaelimina'){

head();
stile();
body();

if (($check['team']=='Admin'))        { menuadmin();}
if (($check['team']=='Moderatore'))    { menumod();}
if (($check['team']=='Membro'))       { menu();}


bodycontinua();

// di default elimina il cv
?>
<br><center>
<h2>Confermi l'eliminazione?</h2>

<br><br><br>
<?echo "<FORM METHOD=POST ACTION='as_mdati.php?mode=qelimina&id=$id'>";?>
<INPUT TYPE='submit' VALUE='>SI<'>&nbsp;&nbsp;&nbsp;



<input type=button value="<NO>" onClick="history.go(-1)">
<br><br><br><br><br><br><br>
<?
echo "<INPUT TYPE=\"HIDDEN\" NAME=\"id\" value='$id'>
      </FORM></center>";

footer();
}





// query eliminazione cv
if ($mode=='qelimina'){

//via le conoscenze info
$query = "DELETE FROM conoscenzeinfo  WHERE  candidato_id='$id' ";
if (mysql_query($query, $db)) {}
else { echo "Erorre 1"; }

//via altre conoscenze lingue
$query = "DELETE FROM conoscenzelingua  WHERE  candidato_id='$id' ";
if (mysql_query($query, $db)) {}
else { echo "Erorre 2"; }

//via colloqui
$query = "DELETE FROM colloqui  WHERE  candidato_id='$id' ";
if (mysql_query($query, $db)) {}
else {echo "Erorre 3";}

//via esperienza ma prima ruoli collegati
$query = "SELECT id FROM  esperienze WHERE  id_candidato='$id' ";
$result = mysql_query($query, $db);
if (mysql_query($query, $db)) {}
else { echo "Erorre 4"; }
//via ruoli
while ($row = mysql_fetch_array($result)){
$query2 = "DELETE FROM ruoli WHERE  id_esperienze='$row[id]' ";
if (mysql_query($query2, $db)) {}
else { echo "Erorre 5"; }
}
//infine elimino esperienze
$query = "DELETE FROM esperienze WHERE  id_candidato='$id' ";
if (mysql_query($query, $db)) {}
else { echo "Erorre 6"; } 

//titoli ma prima i voti dei titoli
$query = "SELECT id FROM titolostudio WHERE  id_candidato='$id' ";
$result = mysql_query($query, $db);
if (mysql_query($query, $db)) {}
else { echo "Erorre 7"; }
//per ogni titolo cerco le formazione e li elimino
while ($row = mysql_fetch_array($result)){
$query2 = "DELETE FROM formazione WHERE id_titolostudio='$row[id]' ";
if (mysql_query($query2, $db)) {}
else { echo "Erorre 8"; }
}
//infine elimino esperienze
$query = "DELETE FROM titolostudio WHERE  id_candidato='$id' ";
if (mysql_query($query, $db)) {}
else { echo "Erorre 9"; }

//via il canddiato infine
$query = "DELETE FROM candidati  WHERE id='$id' ";
if (mysql_query($query, $db)) {}
else { echo "Erorre 10"; }
// torno alla home
redirect("index.php");
}





// query modfica dati
if ($mode=='qmodifica'){

$nascita="$ANNODATANASCITA-$MESEDATANASCITA-$GIORNODATANASCITA";

if($si_comune=='on'){
//se si aggiungo questo nuovo comune sotto la provincia..
$query = "INSERT INTO comune (catid, name) VALUES ('$provincia','$nomecomune') ";
if (mysql_query($query, $db)) {}
else {echo "Erorre durante l'inserimento1";}

//seleziono l'id dell'area appena inserita
$query = "SELECT id FROM comune WHERE name='$nomecomune' ";
if (mysql_query($query, $db)) {}
else {echo "Erorre durante l'inserimento2";}

$result = mysql_query($query, $db);
$row = mysql_fetch_array($result);
$comune=$row['id'];
}

$ultimoagg=date("Y-m-d");

if ($provincia=='0' || $altro_p!='on'){
$provincia=$provincia_old;
if ($comune=='0' || $altro_c!='on' && $si_comune!='on') {$comune=$comune_old;}
}


if ($cognome=='' || $nome=='' || $ANNODATANASCITA=='' || $MESEDATANASCITA=='' || 
    $GIORNODATANASCITA==''){ echo " Campi Obbligatori vuoti! "; }

    else{    

        $query = "UPDATE candidati SET 
        cognome='$cognome',
        nome='$nome' , 
        nascita='$nascita',
        provinciaid='$provincia',
        comuneid='$comune',
        area='$area',
        telefono='$telefono',
        email='$email',
        preavviso='$preavviso',
        patenti='$patenti',
        allegato='$allegato',
        note='$note', 
        ultimamodifica='$ultimoagg'
        WHERE id='$id' ";
        }
        
if (mysql_query($query, $db)) {  redirect("as_pannello.php?id=$id"); }
else{echo "Erorre durante la modifica";}

}


// form modifica dati
if ($mode=='modifica')
{

?>
  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name='description' content='Curriculum Vitae' />
	<meta name='keywords' content='Gestione Curriculum Vitae' /> 
    <style type="text/css" media="all">@import "images/style.css";</style>
    
    <script language="JavaScript" type="text/javascript" src="ajax_search.js"></script>

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



<script language="javascript">
// Chained Menu

// Copyright Xin Yang 2004
// Web Site: www.yxScripts.com
// EMail: m_yangxin@hotmail.com
// Last Updated: 2004-08-23

// This script is free as long as the copyright notice remains intact.

var _disable_empty_list=false;
var _hide_empty_list=false;

// ------

///// DynamicDrive.com added function/////////////

var onclickaction="alert"

function goListGroup(){
for (i=arguments.length-1;i>=0; i--){
if (arguments[i].selectedIndex!=-1){
var selectedOptionvalue=arguments[i].options[arguments[i].selectedIndex].value
if (selectedOptionvalue!=""){
if (onclickaction=="alert")
alert(selectedOptionvalue)
else if (newwindow==1)
window.open(selectedOptionvalue)
else
window.location=selectedOptionvalue
break
}
}
}
}

///// END DynamicDrive.com added function//////


if (typeof(disable_empty_list)=="undefined") { disable_empty_list=_disable_empty_list; }
if (typeof(hide_empty_list)=="undefined") { hide_empty_list=_hide_empty_list; }

var cs_goodContent=true, cs_M="M", cs_L="L", cs_curTop=null, cs_curSub=null;

function cs_findOBJ(obj,n) {
  for (var i=0; i<obj.length; i++) {
    if (obj[i].name==n) { return obj[i]; }
  }
  return null;
}
function cs_findContent(n) { return cs_findOBJ(cs_content,n); }

function cs_findM(m,n) {
  if (m.name==n) { return m; }

  var sm=null;
  for (var i=0; i<m.items.length; i++) {
    if (m.items[i].type==cs_M) {
      sm=cs_findM(m.items[i],n);
      if (sm!=null) { break; }
    }
  }
  return sm;
}
function cs_findMenu(n) { return (cs_curSub!=null && cs_curSub.name==n)?cs_curSub:cs_findM(cs_curTop,n); }

function cs_contentOBJ(n,obj){ this.name=n; this.menu=obj; this.lists=new Array(); this.cookie=""; }; cs_content=new Array();
function cs_topmenuOBJ(tm) { this.name=tm; this.items=new Array(); this.df=0; this.addM=cs_addM; this.addL=cs_addL; }
function cs_submenuOBJ(dis,link,sub) {
  this.name=sub;
  this.type=cs_M; this.dis=dis; this.link=link; this.df=0;

  var x=cs_findMenu(sub);
  this.items=x==null?new Array():x.items;

  this.addM=cs_addM; this.addL=cs_addL;
}
function cs_linkOBJ(dis,link) { this.type=cs_L; this.dis=dis; this.link=link; }

function cs_addM(dis,link,sub) { this.items[this.items.length]=new cs_submenuOBJ(dis,link,sub); }
function cs_addL(dis,link) { this.items[this.items.length]=new cs_linkOBJ(dis,link); }

function cs_showMsg(msg) { window.status=msg; }
function cs_badContent(n) { cs_goodContent=false; cs_showMsg("["+n+"] Not Found."); }

function cs_optionOBJ(text,value) { this.text=text; this.value=value; }
function cs_emptyList(list) { for (var i=list.options.length-1; i>=0; i--) { list.options[i]=null; } }
function cs_refreshList(list,opt,df) {
  cs_emptyList(list);

  for (var i=0; i<opt.length; i++) {
    list.options[i]=new Option(opt[i].text, opt[i].value);
  }

  if (opt.length>0) {
    list.selectedIndex=df;
  }
}
function cs_getOptions(menu) {
  var opt=new Array();
  for (var i=0; i<menu.items.length; i++) {
    opt[i]=new cs_optionOBJ(menu.items[i].dis, menu.items[i].link);
  }
  return opt;
}
function cs_updateListGroup(content,idx,sidx,mode) {
  var i=0, curItem=null, menu=content.menu;

  while (i<idx) {
    menu=menu.items[content.lists[i++].selectedIndex];
  }

  if (menu.items[sidx].type==cs_M && idx<content.lists.length-1) {
    var df=cs_getIdx(mode,content.cookie,idx+1,menu.items[sidx].df);

    cs_refreshList(content.lists[idx+1], cs_getOptions(menu.items[sidx]), df);
    if (content.cookie) {
      cs_setCookie(content.cookie+"_"+(idx+1),df);
    }

    if (idx+1<content.lists.length) {
      if (disable_empty_list) {
        content.lists[idx+1].disabled=false;
      }
      if (hide_empty_list) {
        content.lists[idx+1].style.display="";
      }

      cs_updateListGroup(content,idx+1,df,mode);
    }
  }
  else {
    for (var s=idx+1; s<content.lists.length; s++) {
      cs_emptyList(content.lists[s]);

      if (disable_empty_list) {
        content.lists[s].disabled=true;
      }
      if (hide_empty_list) {
        content.lists[s].style.display="none";
      }

      if (content.cookie) {
        cs_setCookie(content.cookie+"_"+s,"");
      }
    }
  }
}
function cs_initListGroup(content,mode) {
  var df=cs_getIdx(mode,content.cookie,0,content.menu.df);

  cs_refreshList(content.lists[0], cs_getOptions(content.menu), df);
  if (content.cookie) {
    cs_setCookie(content.cookie+"_"+0,df);
  }

  cs_updateListGroup(content,0,df,mode);
}

function cs_updateList() {
  var content=this.content;
  for (var i=0; i<content.lists.length; i++) {
    if (content.lists[i]==this) {
      if (content.cookie) {
        cs_setCookie(content.cookie+"_"+i,this.selectedIndex);
      }

      if (i<content.lists.length-1) {
        cs_updateListGroup(content,i,this.selectedIndex,"");
      }
    }
  }
}

function cs_getIdx(mode,name,idx,df) {
  if (mode) {
    var cs_idx=cs_getCookie(name+"_"+idx);
    if (cs_idx!="") {
      df=parseInt(cs_idx);
    }
  }
  return df;
}

function _setCookie(name, value) {
  document.cookie=name+"="+value;
}
function cs_setCookie(name, value) {
  setTimeout("_setCookie('"+name+"','"+value+"')",0);
}

function cs_getCookie(name) {
  var cookieRE=new RegExp(name+"=([^;]+)");
  if (document.cookie.search(cookieRE)!=-1) {
    return RegExp.$1;
  }
  else {
    return "";
  }
}

// ----
function addListGroup(n,tm) {
  if (cs_goodContent) {
    cs_curTop=new cs_topmenuOBJ(tm); cs_curSub=null;

    var c=cs_findContent(n);
    if (c==null) {
      cs_content[cs_content.length]=new cs_contentOBJ(n,cs_curTop);
    }
    else {
      delete(c.menu); c.menu=cs_curTop;
    }
  }
}

function addList(n,dis,link,sub,df) {
  if (cs_goodContent) {
    cs_curSub=cs_findMenu(n);

    if (cs_curSub!=null) {
      cs_curSub.addM(dis,link||"",sub);
      if (typeof(df)!="undefined") { cs_curSub.df=cs_curSub.items.length-1; }
    }
    else {
      cs_badContent(n);
    }
  }
}

function addOption(n,dis,link,df) {
  if (cs_goodContent) {
    cs_curSub=cs_findMenu(n);

    if (cs_curSub!=null) {
      cs_curSub.addL(dis,link||"");
      if (typeof(df)!="undefined") { cs_curSub.df=cs_curSub.items.length-1; }
    }
    else {
      cs_badContent(n);
    }
  }
}

function initListGroup(n) {
  var _content=cs_findContent(n), count=0;
  if (_content!=null) {
    content=new cs_contentOBJ("cs_"+n,_content.menu);
    cs_content[cs_content.length]=content;

    for (var i=1; i<initListGroup.arguments.length; i++) {
      if (typeof(arguments[i])=="object" && arguments[i].tagName && arguments[i].tagName=="SELECT") {
        content.lists[count]=arguments[i];

        arguments[i].onchange=cs_updateList;
        arguments[i].content=content; arguments[i].idx=count++;
      }
      else if (typeof(arguments[i])=="string" && /^[a-zA-Z_]\w*$/.test(arguments[i])) {
        content.cookie=arguments[i];
      }
    }

    if (content.lists.length>0) {
      cs_initListGroup(content,content.cookie);
    }
  }
}

function resetListGroup(n) {
  var content=cs_findContent("cs_"+n);
  if (content!=null && content.lists.length>0) {
    cs_initListGroup(content,"");
  }
}
// ------

</script>
<script language="javascript">
//var hide_empty_list=true; //uncomment this line to hide empty selection lists
var disable_empty_list=true; //uncomment this line to disable empty selection lists

var onclickaction="alert" //set to "alert" or "goto". Former is for debugging purposes, to tell you the value of the final selected list that will be used as the destination URL. Set to "goto" when below configuration is all set up as desired. 

var newwindow=0 //Open links in new window or not? 1=yes, 0=no.

/////DEFINE YOUR MENU LISTS and ITEMS below/////////////////

addListGroup("chainedmenu", "First-Select");

addOption("First-Select", "Seleziona", "", 1); //HEADER OPTION

<?php
$result = mysql_query("SELECT id, name FROM provincia ORDER BY name ASC ") ;	
while ($row = mysql_fetch_assoc($result))
{

echo "addList(\"First-Select\", \"";
echo $row['name'];
echo "\", \"";
echo $row['id'];
echo "\", \"";
echo $row['id'];
echo "\");\n";
} 
?>

<?php
$result2 = mysql_query("SELECT id, catid, name FROM comune ORDER BY name ASC ") ;	
while ($row2 = mysql_fetch_assoc($result2))
{

echo "addOption(\"";
echo $row2['catid'];
echo "\", \"";
echo $row2['name'];
echo "\", \"";
echo $row2['id'];
echo "\");\n";
} 
?>
</script>


</head>


<body onLoad="initListGroup('chainedmenu', document.modulo.provincia, document.modulo.comune, 'saveit')">



<div id="page-container">	
	<div id="top">
		<a href="#">Aiuto</a> | 
		<a href="#">Contatti</a> 
		<div class="comment">
		 Ricerca Veloce Curriculum Vitae: <input type="text" name="search" class="search" /> <input type="submit" value="Cerca" class="submit" />
		</div>
	</div>
<?

if (($check['team']=='Admin'))        { menuadmin();}
if (($check['team']=='Moderatore'))    { menumod();}

?>

		<div id="hrgreen"></div>
	
		<p>
	
        <br>

<div id="cat1" style="display: none">
<p>La Provincia e il Comune rimangono gli stessi di prima se non si agisce sul menu</p>
</div>


		</p>
	</div>
	
	<div id="contentx">
		<div class="padding">
        <br>
<?
$query2 = "SELECT * FROM candidati WHERE id ='$id' ";
$result2 = mysql_query($query2, $db);
$row2 = mysql_fetch_array($result2);
if (mysql_query($query2, $db)) {}
else {echo "Erorre ";}
?>			
            <h4>Modifica Dati Anagrafici</h4><br>
			<form method="POST" name="modulo" ACTION="as_mdati.php?mode=qmodifica">
        <table border="0">
  <tr>
    <td width="214"><small><b>Nome:  </b></small><br />
       <input type="text" name="nome"size=20 value="<? echo $row2['nome'];?>"/></p>
      <p>&nbsp;</p></td>
    <td width="200"><p><small><b>Cognome:</b></small><br />
        <input type="text" name="cognome" size=20 value="<? echo $row2['cognome'];?>"/>
    </p>
      <p>&nbsp; </p></td>
  </tr>
  <tr>
    <td><small><b>Data di Nascita : </b></small>
      <br />
       <? list ($y, $m, $d) = explode ("-", $row2['nascita']);?>
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
    </p>
      <p>&nbsp; </p>
    <td><small><b>Telefono:</b></small><br />
        <input type="text" name="telefono" size=20 value="<? echo $row2['telefono'];?>"/>
    </p>
      <p>&nbsp; </p></td>
  </tr>  
  <tr>
    <td><small><b>E-Mail:</b></small><br />
        <input type="text" name="email" size=20 value="<? echo $row2['email'];?>"/>
    </p>
      <p>&nbsp;</p></td>
    <td><p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><small><b>Provincia: (
    <? 
$query = "SELECT name FROM provincia  WHERE id='$row2[provinciaid]' ";
$result = mysql_query($query, $db); $row = mysql_fetch_array($result);
echo $row['name'];  
    ?>
    )</b> </small><a href="javascript:ShowHideDiv('cat1');"> ?</a><br />
     <p>
          <input type="checkbox"  name="altro_p" />
          <b><small>altro: selezionare</small></b>
          </p>
      <select name="provincia">
        <option value="0"></option>
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
      </select></td>
    <td><small><b>Comune: (
    <? 
$query = "SELECT name FROM comune  WHERE id='$row2[comuneid]' ";
$result = mysql_query($query, $db); $row = mysql_fetch_array($result);
echo $row['name'];  
    ?>
    )</b> </small><a href="javascript:ShowHideDiv('cat1');"> ?</a><br />
     <p>
          <input type="checkbox"  name="altro_c" />
          <b><small>altro: selezionare</small></b>
      </p>
      <select name="comune">
        <option value="0">(Choose)</option>
        <?
$result2 = mysql_query("SELECT id, name FROM comune ORDER BY name ASC ") ;	
while ($row2 = mysql_fetch_assoc($result2))
{

echo "<option value=\"";
echo $row2['id'];
echo "\">";
echo $row2['name'];
echo "</option>";
} 
?>
      </select></td>
  </tr>
  <tr>
 <?
$query2 = "SELECT * FROM candidati WHERE id ='$id' ";
$result2 = mysql_query($query2, $db);
$row2 = mysql_fetch_array($result2);
if (mysql_query($query2, $db)) { }
else
{echo "Erorre durante l'inserimento2";}
?>		
   <td>
     <p>&nbsp;       </p>
     <p>
       <input type="checkbox"  name="si_comune" />
       <small>Se non presente il comune:</small>     </p>
     <p>&nbsp;</p></td>
 
    <td><p>&nbsp;
      </p>
      <p>
        <input type="text" name="nomecomune" />
       </p>
      <p>&nbsp; </p></td>
 </tr>
  <tr>
      <td>  <p><b><small>Area Citta': </small></b></p>
				<input type="text" id="txtSearch" name="area" alt="Search Criteria" onkeyup="searchSuggest();" autocomplete="off" value="<?echo $row2['area'];?>"/>
			
				<div id="search_suggest">
				</div>
			</td>
     <td>&nbsp;</td>
  </tr>

  <tr>
    <td><p><b><small>Periodi di Preavviso:</small></b><br />
        <textarea name="preavviso" rows="3"><? echo $row2['preavviso'];?></textarea>
    </p>      </td>
    <td><p>&nbsp;</p>
      <p><strong><small>Patenti :</small></strong>
          <textarea name="patenti" rows="3"><? echo $row2['patenti'];?></textarea>
      </p>
      <p>&nbsp;</p></td>
  </tr>
    <tr>
     <td><p><b><small>Allegato:</small></b><br />
        <textarea name="allegato" cols="20"><? echo $row2['allegato'];?></textarea>
    </p>
      <p>&nbsp; </p></td>
    <td><p><b><small>Note:</small></b><br />
        <textarea name="note" cols="20"><? echo $row2['note'];?></textarea>
    </p>
      <p>&nbsp; </p></td>
  </tr>
  <tr>
    <td><input name="reset" type="reset" value="Cancella!" /></td>
    <td><div align="right">
      <input class="form_button" name="submit" type=submit value="Modifica" />
    </div></td>
  </tr>
</table>
        <BR>&nbsp;&nbsp; &nbsp;&nbsp;
        <? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"id\" value=$id>";?>
        <? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"provincia_old\" value=$row2[provinciaid]>";?>  
        <? echo "<INPUT TYPE=\"HIDDEN\" NAME=\"comune_old\" value=$row2[comuneid]>";?>          
			</FORM>
 </small>
		
<?
footer();
}
?>
