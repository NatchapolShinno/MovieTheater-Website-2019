
<?php 
	$query = "SELECT * FROM `branch`";


	print "
	<script>
		table, th, td {
			padding: 10px;
			color: white;
			background-color: #4CAF50;
		}

	</script>
	";

	//extract field names first
	$field_names = $db->query($query);
	$row = $field_names->fetch(PDO::FETCH_ASSOC);

	print "<tr> \n";
	foreach ($row as $field => $value)
		{
		print "<th>$field</th> \n";
		}
	print "</tr> \n";

	//extract data
	$data = $db->query($query);
	$data->setFetchMode(PDO::FETCH_ASSOC);

	foreach($data as $row)
		{
		print "<tr> \n";
		foreach ($row as $name => $value)
			{
			print "<td>$value</td> \n";
			}
		print "</tr> \n";
		}
?>