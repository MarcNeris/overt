<?php
include('config_mysqli.php');
sqlQuery('start transaction');
sqlQuery('delete from redips_timetable');
$arr = @$_REQUEST['p'];

print_r($arr);
if (is_array($arr)) {
	foreach ($arr as $p) {
		list($sub_id, $row, $col) = explode('_', $p);
		$sub_id = substr($sub_id, 0, 2);
		@sqlQuery("insert into redips_timetable (sub_id, tbl_row, tbl_col) values ('$sub_id', $row, $col)");
	}
}
@sqlCommit();
//header('location: index.php');
?>