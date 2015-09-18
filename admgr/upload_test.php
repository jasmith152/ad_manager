<?php
if (!$action){
echo "<form enctype='multipart/form-data' action='upload_test.php' method='POST'>\n";
echo "<input type='hidden' name='action' value='upload'>\n";
echo "<input type='hidden' name='MAX_FILE_SIZE' value='40000'>\n";
echo "Send this file: <input name='userfile' type='file'><br>\n";
echo "<input type='submit' value='Send File'>\n";
echo "</form>\n";
}else{
$uploaddir = '/usr/local/www/vhosts/nccentral.com/ad_mgr/images/ads/';
$uploadfile = $uploaddir. $_FILES['userfile']['name'];

print "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    print "File is valid, and was successfully uploaded. ";
    print "Here's some more debugging info:\n";
    print_r($_FILES);
} else {
    print "Possible file upload attack!  Here's some debugging info:\n";
    print_r($_FILES);
}
print "</pre>";
echo "<img src='images/ads/".$_FILES['userfile']['name']."' border='0'>\n";
}
?>