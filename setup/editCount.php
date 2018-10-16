<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		<?PHP 
			$q = $_GET['q'];
			$action = $_GET['action'];
			$r = $_GET['r'];
			$con = mysqli_connect("sql.njit.edu", "rjb57", "5julL6kuS");
			$myFile = fopen("../UPLOADS/Halloween.csv", "a") or die("Unable to open file!");
			if (!$con) {
				die('Could not connect: ' . mysqli_error($con));	
			}
			mysqli_select_db($con,"rjb57");
			if(strlen($q)>0 && strlen($action)>0){
				$sql = "UPDATE rjb57.count SET ".$q."=".$q." ".$action."1 WHERE idcount='Halloween';";
			  $result = mysqli_query($con,$sql);
        $totals = mysqli_query($con,"SELECT * FROM rjb57.count;");
        $totalsList = mysqli_fetch_array($totals);
				$text = $q.",".$totalsList[$q].",".$action.",".date("Ymd H:i:s")." UTC\n";
				fwrite($myFile, $text);
				fclose($myFile);
			}
			elseif (strlen($r)>0){
				$sql = "UPDATE rjb57.count SET guys='0',girls='0' WHERE idcount='Halloween';";
				fclose(fopen("../UPLOADS/Halloween.csv", "w"));
		  	$result = mysqli_query($con,$sql);
			}
			echo "<p>column call: ".$q."</p>";
			echo "<p>action call: ".$action."</p>";
			echo "<p>reset call: ".$r."</p>";

			mysqli_close($con);
			echo "<p>SQL: ".$sql."</p>";
		?>
	</body>
</html>
