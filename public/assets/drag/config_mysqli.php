<?php 

$db_host = 'localhost';
$db_name = 'drag';
$db_user = 'root';
$db_pwd  = '';

$rs = null;

$mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($mysqli->connect_errno) {
	print "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

function sqlQuery($sql, $key = NULL) {
	global $mysqli;	
	$db_result = $mysqli->query($sql);
	if (!$db_result) {
		print "SQL failed: (" . $mysqli->errno . ") " . $mysqli->error;
		exit();
	}
	$resultSet = Array();
	if ($db_result !== true) {
		while ($row = $db_result->fetch_row()) {
			if ($key !== NULL) {
				$resultSet[$row[$key]] = $row;
			}
			else {
				$resultSet[] = $row;
			}
		}
	}
	return $resultSet;
}


// commit transaction
function sqlCommit() {
	global $mysqli;
	// commit transaction
	if (!$mysqli->commit()) {
		print("Transaction commit failed\n");
		exit();
	}
	// close database connection
	$mysqli->close();
}


// print subjects
function subjects() {
	$subjects = sqlQuery('select sub_id, sub_name from redips_subject e 
	WHERE NOT EXISTS (SELECT * FROM redips_timetable r WHERE e.sub_id = r.sub_id ) order by e.sub_name;');
	
	foreach ($subjects as $subject) {
		$id   = $subject[0];
		$class = 'c'.$subject[0];
		$name = $subject[1];
		print "<tr><td class=\"dark\"><div id=\"$id\" class=\"redips-drag  $class\">$name</div></td></tr>\n";
	}
}



// create timetable row
function funil($name, $row) {

	$cols = sqlQuery("select t.sub_id, t.tbl_col, t.tbl_row, s.sub_name
		from redips_timetable t, redips_subject s
		where t.sub_id = s.sub_id and t.tbl_row = $row");		
	print '<tr>';
	print '<td class="redips-mark dark">'.$name.'</td>';
	for ($x = 1; $x <= 5; $x++) {
		print '<td>';

		foreach ($cols as $col) {
			if (($col[1])==($x)) {
				print "<div id=\"$col[0]\" class=\"redips-drag c$col[0]\">$col[3]</div>";
			}
		}	
		print '</td>';
	}
	print "</tr>\n";
}

?>