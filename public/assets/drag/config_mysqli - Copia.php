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
	WHERE NOT EXISTS (SELECT * FROM redips_timetable r WHERE e.sub_id = r.sub_id);');
	
	foreach ($subjects as $subject) {
		$id   = $subject[0];
		$class = 'c'.$subject[0];
		$name = $subject[1];
		print "<tr><td class=\"dark\"><div id=\"$id\" class=\"redips-drag  $class\">$name</div></td></tr>\n";
	}
}



// create timetable row
function timetable($hour, $row) {
	global $rs;
	if ($rs === null) {
		$rs = sqlQuery("select concat(t.tbl_row,'_',t.tbl_col) as pos, t.tbl_id, t.sub_id, s.sub_name
						from redips_timetable t, redips_subject s
						where t.sub_id = s.sub_id", 0);
						print_r($rs);
	}
	print '<tr>';
	print '<td class="redips-mark dark">' . $hour . '</td>';
	for ($col = 1; $col <= 5; $col++) {
		print '<td>';
		$pos = $row . '_' . $col;
		if (array_key_exists($pos, $rs)) {
			$elements = $rs[$pos];
			//$id = $elements[2] . 'b' . $elements[1];
			$id = $elements[2];
			$name = $elements[3];
			$class = 'c'.$elements[2];
			print "<div id=\"$id\" class=\"redips-drag $class\">$name</div>";
		}
		print '</td>';
	}
	print "</tr>\n";
}

?>