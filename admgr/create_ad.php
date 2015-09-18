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
  <title>Ad Manager - Create Ad</title>
</head>
<body bgcolor="#ffffff">
<div align="center">
<table border="0" cellpadding="2" cellspacing="4" width="400">
 <tr bgcolor="#FFFFFF">
  <td><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular" size="2">
<!-- Begin Content -->
<?
//Include Db connection script
include 'dbconn.php';

if (!$submitad){
$result_owner = @mysql_query("SELECT c_name FROM tbl_adclient ORDER BY c_name");
$result_zone = @mysql_query("SELECT z_name FROM tbl_zone ORDER BY z_name");
?>
<form action="<?=$PHP_SELF?>" enctype="multipart/form-data" name="addform" id="addform" method="POST">
<table width="60%" border="0" cellpadding="2" cellspacing="2" align="center">
 <tr>
  <td colspan="2" align="center"><font face="arial" color="#000000" size="4"><b>Create New Ad</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC" width="30%"><font face="arial" color="#000000" size="3"><b>Ad Name</b></font></td>
  <td width="70%"><input type="text" name="name" id="name" size="20"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Zone</b></font></td>
  <td><select name="zone" id="zone">
   <option>No Zone</option>
   <?php while ( $row_zone = mysql_fetch_array($result_zone) ) {
   		 echo("<option>".$row_zone["z_name"]."</option>");
   }?>
  </select></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Type</b></font></td>
  <td><font face="arial" color="#000000" size="3">
   <input type="radio" name="type" id="type" value="banner" checked>Banner<br>
   <input type="radio" name="type" id="type" value="button">Button<br>
   <input type="radio" name="type" id="type" value="text">Text</font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Owner</b></font></td>
  <td><select name="owner" id="owner">
   <option>Select Ad Client...</option>
   <?php while ( $row_owner = mysql_fetch_array($result_owner) ) {
   		 echo("<option>".$row_owner["c_name"]."</option>");
   }?>
  </select></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Expiration Date</b></font></td>
  <td><font face="arial" color="#000000" size="2">Month:<select name="e_date_m" id="e_date_m">
   <?php echo("<option>".date("m")."</option>");
   include 'monthlist.htm';?>
   </select>&nbsp;
   Date:<select name="e_date_d" id="e_date_d">
   <?php echo("<option>".date("d")."</option>");
   include 'datelist.htm';?>
   </select>&nbsp;
   Year:<select name="e_date_y" id="e_date_y">
   <?php //echo("<option>".(date("Y")+1)."</option>");
   //include 'yearlist.htm';
   for ($y=0; $y<=5; $y++) {
      echo "<option>".(date("Y")+$y)."</option>";
   }
   ?>
   </select></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Image</b></font></td>
  <td><input type="file" name="src" id="src" size="20"><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
   Images more than 512kb may not be used.</i></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>Alt Text</b></font></td>
  <td><input type="text" name="alt" id="alt" size="20"></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>URL</b></font></td>
  <td><input type="text" name="href" id="href" size="20"><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
   Must use the following format: http://www.mydomain.com</i></font></td>
 </tr>
 <tr>
  <td bgcolor="#CCCCCC"><font face="arial" color="#000000" size="3"><b>HTML</b></font></td>
  <td><font face="arial" color="#000000" size="2"><b>Only used for HTML ads, not for additional code.</b></font><br>
   <textarea name="src_code" id="src_code" cols="40" rows="4"></textarea><br><font face="arial" color="#000000" size="2"><i><b>Note: </b>
    The "a href" tag will be added to the code entered above for tracking purposes. Be sure to include your URL in the URL field.</i></font></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <input type="submit" name="submitad" id="submitad" value="Create Ad">
  </td>
 </tr>
</table>
</form>
<?
}else{
  // Generate Id
  $id = md5 (uniqid (rand()));
  
  // Set start & end dates
  $today = date("Y-m-d");
  $e_date = ($e_date_y."-".$e_date_m."-".$e_date_d);
  
  // Grab uploaded image
  if (!empty($_FILES['src']['name'])) {
  	  $upload_allowed = "1";
  	  $maxsize = "512000";
  	  if ($_FILES['src']['size']>$maxsize) {
  	  	$upload_allowed = "0";
  	  	echo "File size is too big: ".$_FILES['src']['size']."\n";
  	  }
  	  $type_allowed = strpos(($_FILES['src']['type']), 'image');
  	  if ($type_allowed===false) {
  	  	$upload_allowed = "0";
  	  	echo "File type not allowed: $type_allowed\n";
  	  }
  	  $uploaddir = '/home/hcparade/public_html/admgr/images/ads/';
      $uploadfile = $uploaddir. $_FILES['src']['name'];
      $img_name = $_FILES['src']['name'];

      if ((move_uploaded_file($_FILES['src']['tmp_name'], $uploadfile)) && ($upload_allowed=="1")) {
          print "<pre>";
      	  print "File is valid, and was successfully uploaded. ";
          print "Here's some more debugging info:\n";
          print_r($_FILES);
          print "</pre>";
          shell_exec('chmod a+r images/ads/'.$img_name);
      } else {
          print "<pre>";
          print "Possible file upload attack!  Here's some debugging info:\n";
          print "upload_allowed: $upload_allowed\n";
          print_r($_FILES);
          print "</pre>";
          exit;
      }
  }
  
  // Insert the record
  $sql = "INSERT INTO tbl_ad SET
          id='$id',
		  name='".addslashes($name)."',
		  zone='".addslashes($zone)."',
		  type='$type',
		  owner='".addslashes($owner)."',
		  s_date='$today',
		  e_date='$e_date',
		  src_code='".addslashes($src_code)."',
		  src='".addslashes($img_name)."',
		  alt='".addslashes($alt)."',
		  href='$href',
		  reset='$today'";
  if (mysql_query($sql)) { 
    echo("<center>Your ad has been created.</center>"); 
  } else { 
    echo("<p>Error creating ad: " . mysql_error() . "</p>"); 
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
