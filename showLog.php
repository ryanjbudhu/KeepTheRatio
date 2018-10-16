<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Halloween Log</title>
	</head>
	<body>
		<table>
		<tr>
			<td>Sex</td>
      <td>Total</td>
			<td>Action</td>
			<td>Time</td>
		</tr>
		<?php
			$fp = fopen ( "UPLOADS/Halloween.csv" , "r" );
			while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) {
				$i = 0;
				echo "<tr>";
				foreach($data as $row) {
				   echo "<td>" . $row . "</td>";
				   $i++ ;
				}
				echo "/<tr>";
			}
			fclose ( $fp );
			?>
		</table>
	</body>
</html>
