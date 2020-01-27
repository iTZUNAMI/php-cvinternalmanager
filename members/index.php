
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
body();


if (($check['team']=='Admin'))        { menuadmin();}
if (($check['team']=='Moderatore'))    { menumod();}
if (($check['team']=='Membro'))       { menu();}

//parte sotto menu
bodycontinua();
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br>
			
			
<?
 footer(); 
?>

