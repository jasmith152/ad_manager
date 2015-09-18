<?php
$cfgProgDir = 'phpSecurePages/';
include($cfgProgDir . "secure.php");

// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
  <title>Ad Manager - Create Advertiser</title>
</head>
<body bgcolor="#ffffff">
<div align="center">
<table border="0" cellpadding="2" cellspacing="4" width="400">
 <tr bgcolor="#FFFFFF">
  <td><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">
<!-- Begin Content -->
<?php
if (!$submitclient){
?>
<form action="<?=$PHP_SELF?>" name="addform" id="addform" method="post">
<table border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Create Ad Client</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Client Name</b></font></td>
  <td width="70%"><input type="text" name="c_name" id="c_name" size="20"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Phone</b></font></td>
  <td><input type="text" name="c_phone" id="c_phone" size="20"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Email</b></font></td>
  <td><input type="text" name="c_email" id="c_email" size="20"></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitclient" id="submitclient" value="Create Ad Client">
  </td>
 </tr>
</table>
</form>
<?
}else{
  //Include Db connection script
  include 'dbconn.php';

  // Insert the record
  $sql = "INSERT INTO tbl_adclient SET
		  c_name='$c_name',
		  c_phone='$c_phone',
		  c_email='$c_email'";
  if (@mysql_query($sql)) { 
    echo("<center>Your ad client has been created.</center>"); 
  } else { 
    echo("<p>Error creating ad client: " . mysql_error() . "</p>"); 
  }
}
include 'footer.htm';
?>
<!-- End Content -->
   </font></td>
 </tr>
</table>
</div>
</body>
</html>
