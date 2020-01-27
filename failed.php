<?php 
      
      include_once ("authconfig.php");
      include_once ("members/mysql.php");   

      
      head();
      stilefuori();
      body();
      menufuori();
      bodycontinua();
     ?>

	
		<br><br><br>
			<form name="Sample" method="post" action="<?php print $resultpage ?>">
  <table width="71%" border="0" align="right" cellpadding="0" cellspacing="0" >
    <tr> 
      <td colspan="2" bgcolor="#FFFFFF" valign="middle"> 
        <div align="center">
       <font color="RED" size="4"> LOGIN ERRATO:</font>
          <p align="left"><h4>Username:
            </p>
          </h4>
          <p align="left"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
            <input type="text" name="username" size="35" maxlength="15">
          </font></b></p>
        </div>    </td>
  </tr>
    <tr> 
      <td valign="middle" bgcolor="#FFFFFF"><h4>Password:</h4>
        <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <input type="password" name="password" size="35" maxlength="15">
        </font></b></p></td>
      <td width="79%" valign="middle"><p>&nbsp;</p>
        <p>&nbsp;</p></td>
  </tr>
   
    <tr valign="middle" bgcolor="#CCCCCC"> 
      <td colspan="2" bgcolor="#FFFFFF">
         
           <div align="center">
           
             <input type="reset" name="Clear" value="Annulla">&nbsp;&nbsp;&nbsp;
             <input type="submit" name="Login" value="Login">
           </div></td></tr>
</table>
</form>



<br><br><br><br><br><br><br><br>
	<br><hr>


<?   footer();   ?>
	
	
