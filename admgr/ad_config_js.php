<?php
// Establish GET & POST variables
import_request_variables("gp");
$PHP_SELF = $_SERVER['PHP_SELF'];

		 //open database connection
		 include '../admin/dbconn.php';
		 
		 //set variables
		 $today = date("Y-m-d");

	//Open db records for displaying appropriate ad
		 //Create loop for pulling multiple ads
		 for ($i = 1; $i <= $ads; $i++) {
     //check to see if specific ad is requested
		 if (!$zoneid) {
		 	//check to see if any ad is requested
			If ($id){
		 	$result_specific = @mysql_query("SELECT * FROM tbl_ad WHERE id='$id'");
			$row_specific = mysql_fetch_array($result_specific);
			if ($row_specific["e_date"] < $today) {
			   $sql_exp = "UPDATE tbl_ad SET active='F' WHERE id='" . $row_specific["id"] . "'";
			   @mysql_query($sql_exp);
			   $gen_type = ("generic_" . $type);
			   $result_generic = @mysql_query("SELECT * FROM tbl_ad WHERE name='$gen_type'");
			   $row = mysql_fetch_array($result_generic);
			} else {
			   $row = $row_specific;
			}
			if ($row_specific["active"] == 'F') {
			   $gen_type = ("generic_" . $type);
			   $result_generic = @mysql_query("SELECT * FROM tbl_ad WHERE name='$gen_type'");
			   $row = mysql_fetch_array($result_generic);
			} else {
			   $row = $row_specific;
			}
			}Else{
			   echo "No ad specified.";
			   exit();
			}
		 } else {
		    //echo "got a zoneid.<br>\n";
			//--select next rotating ad in zone
			$zone_result = @mysql_query("SELECT z_name, type FROM tbl_zone WHERE id='$zoneid'");
			$zone_row = @mysql_fetch_array($zone_result);
			$initial_result = @mysql_query("SELECT * FROM tbl_ad WHERE active='T' AND post='F' AND zone='" . $zone_row['z_name'] . "' LIMIT 1");
			//check to see if all ads were posted
			if (mysql_num_rows($initial_result) == 0) {
			   mysql_query("UPDATE tbl_ad SET post='F' WHERE(post='T' AND zone='" . $zone_row['z_name'] . "')");
			   mysql_query("UPDATE tbl_ad SET active='F' WHERE(e_date < '$today')");
			   $post_result = @mysql_query("SELECT * FROM tbl_ad WHERE active='T' AND post='F' AND zone='" . $zone_row['z_name'] . "' LIMIT 1");
			   if (mysql_num_rows($post_result) == 0) {
				  $gen_type = ("generic_" . $type);
				  $result_generic = @mysql_query("SELECT * FROM tbl_ad WHERE name='" . $gen_type . "'");
			   $row = mysql_fetch_array($result_generic);
			   } else {
			   $row = mysql_fetch_array($post_result);
			   }
			} else {
			$row = mysql_fetch_array($initial_result);
			}
		 }
		 
	//Count the Hit
		 $month = abs(date("m"));
		 //echo($row["reset"] . "<br>");
		 //echo(date("Y-m-d") . "<br>");

		 //Reset the hits field if this is a new month
		 if (substr($row["reset"], 0, 7) != (date("Y-m"))) {
			//reset hits field for this month
			$sql3 = "UPDATE tbl_ad SET hits_" . $month . "='0' WHERE id='" . $row["id"] . "'";
			@mysql_query($sql3);
			
			//reset clicks field for this month
			$sql4 = "UPDATE tbl_ad SET clicks_" . $month . "='0' WHERE id='" . $row["id"] . "'";
			@mysql_query($sql4);
			
			//Set reset field to todays date
			$sql5 = "UPDATE tbl_ad SET reset='" . date("Y-m-d") . "' WHERE id='" . $row["id"] . "'";
			mysql_query($sql5);
			
			//count this hit
			$hits_m = '1';
			//echo("Hits & Clicks reset!<br>");
		 } else {
		    $hits_m = (($row[10+$month]) + 1);
		 }
		 $sql2 = "UPDATE tbl_ad SET hits_" . $month . "='" . $hits_m . "' WHERE id='" . $row["id"] . "'";
		 @mysql_query($sql2);
		 
		 $hits = ($row["hits_1"] + $row["hits_2"] + $row["hits_3"] + $row["hits_4"] + $row["hits_5"] + $row["hits_6"]);
		 $hits = ($hits + $row["hits_7"] + $row["hits_8"] + $row["hits_9"] + $row["hits_10"] + $row["hits_11"] + $row["hits_12"]);
		 $sql1 = "UPDATE tbl_ad SET hits='" . $hits . "' WHERE id='" . $row["id"] . "'";
		 @mysql_query($sql1);
		 
		 //echo("hits='" . $hits . "'<br>");
		 //echo("clicks='" . $row["clicks"] . "'<br>");
		 
	//Set ad as Posted
		 $sql6 = "UPDATE tbl_ad SET post='T' WHERE id='" . $row["id"] . "'";
		 @mysql_query($sql6);
		 
   //Check for container
   switch ($ad_container) {
      case 'p':
       $output .= "<p align='center'>";
      break;
      default:
      break;
   }
   // Return html code
   if ($row["src_code"] != '') {
   	  $output .= "<a href='http://www.raccfl.com/admgr/ad_parse.php?id=" . $row["id"] . "' target='_blank'>";
	    $output .= $row["src_code"];
	    $output .= "</a>";
   } else {
   	  $output .= "<a href='http://www.raccfl.com/admgr/ad_parse.php?id=" . $row["id"] . "' target='_blank'>";
	    $output .= "<img src='http://www.raccfl.com/admgr/images/ads/" . $row["src"] . "' alt='" . $row["alt"] . "' border='0'></a>";
   }
   //Close any containers
   switch ($ad_container) {
      case 'p':
       $output .= "</p>";
      break;
      case 'b':
       $output .= "<br />";
      break;
      default:
      break;
   }
	 //Close the loop for multiple ads
   }
	
?>
document.write("<?php echo $output; ?>");