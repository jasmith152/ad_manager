<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

//open database connection
include '../admin/dbconn.php';
$domainname = "raccfl.com";

$result = @mysql_query("SELECT * FROM tbl_ad WHERE id='$id'");
$row = mysql_fetch_array($result);

// Return html code
   if ($row["src_code"] != '') {
   	  $output = ("<a href='http://www.$domainname/admgr/ad_parse.php?id=" . $row["id"] . "' target='new'>");
	  $output = ($output . $row["src_code"]);
	  $output = ($output . "</a>");
   } else {
   	  $output = ("<a href='http://www.$domainname/admgr/ad_parse.php?id=" . $row["id"] . "' target='new'>");
	  $output = ($output . "<img src='http://www.$domainname/admgr/images/ads/" . $row["src"] . "' alt='" . $row["alt"] . "' border='0'></a>");
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Ad Preview</title>
</head>
<body><center>
<script language=javascript src="http://www.<?php echo $domainname ?>/admgr/ad_config_js.php?id=<?php echo $id ?>"></script>
<br><br><font face='arial' size='3'><b>Code for this Ad</b></font>
<br><textarea name='codewindow' cols='50' rows='5'>
<script language=javascript src="http://www.<?php echo $domainname ?>/admgr/ad_config_js.php?id=<?php echo $id ?>"></script>
</textarea>
<br><br><font face='arial' size='3'><b>Email Code for this Ad</b></font>
<br><textarea name='emailcodewindow' cols='50' rows='5'>
<?php echo $output ?></textarea>
</center>
</body>
</html>
