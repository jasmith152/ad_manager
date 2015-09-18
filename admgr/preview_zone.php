<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Zone Preview</title>
</head>
<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

$domainname = "raccfl.com";
?>
<body><center>
<script language=javascript src="http://www.<?php echo $domainname ?>/admgr/ad_config_js.php?zoneid=<?php echo $id ?>"></script><br>
<script language=javascript src="http://www.<?php echo $domainname ?>/admgr/ad_config_js.php?zoneid=<?php echo $id ?>"></script>
<br><br><font face='arial' size='3'><b>Code for this Zone</b></font>
<br><textarea name='codewindow' cols='50' rows='5'>
<script language=javascript src="http://www.<?php echo $domainname ?>/admgr/ad_config_js.php?zoneid=<?php echo $id ?>"></script>
</textarea>
</center>
</body>
</html>
