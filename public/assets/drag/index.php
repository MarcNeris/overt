<?php 
include('config_mysqli.php');
?>

<html>
	<head>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="redips-drag-min.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<div id="main_container">
			<!-- tables inside this DIV could have draggable content -->
			<div id="redips-drag">
	
				<!-- left container -->
				<div id="left">
					<table id="table1">
						<colgroup>
							<col width="102"/>
						</colgroup>
						<tbody>
							<tr><td class="redips-drag dark" title="Trash"><br>Suspects</td></tr>
							
						</tbody>
					</table>
				</div><!-- left container -->
				
				<!-- right container -->
				<div id="right">
					<table id="table2">
						<colgroup>
							<col width="50"/>
							<col width="100"/>
							<col width="100"/>
							<col width="100"/>
							<col width="100"/>
							<col width="100"/>
						</colgroup>
						<tbody>
							<tr>
								<!-- if checkbox is checked, clone school subjects to the whole table row  -->
								<td class="redips-mark dark">ForeCast</td>
								<td class="redips-mark dark">Suspect</td>
								<td class="redips-mark dark">Prospect</td>
								<td class="redips-mark dark">Proposta</td>
								<td class="redips-mark dark">Negociação</td>
								<td class="redips-mark dark">Fechamento</td>
							</tr>
													
						</tbody>
					</table>
				</div><!-- right container -->
			</div><!-- drag container -->
			<br/>
			<div id="message"></div>
		</div><!-- main container -->
	</body>
</html>