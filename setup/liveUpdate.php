<?php
	$q = $_GET['q'];
	$con = mysqli_connect("sql.njit.edu", "rjb57", "5julL6kuS");
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));	
	}
	mysqli_select_db($con,"rjb57");
	$sql = "SELECT ".$q." FROM rjb57.count;";
	$mysqlresult = mysqli_query($con,$sql);
	$result = mysqli_fetch_row($mysqlresult);
	echo $result[0];
	mysqli_close($con);
?>