<?php
/*
	представление страницы "таблица стран"
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/headerView.php';
?>
	<section id="table">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="sect1__h2">table</h1>
				</div>
				<div class="col-12">
<?php
if ( $tableArray['code'] === 200 && $tableArray['result'] !== [] ){
?>
					<table>
						<thead>
							<tr>
								<th class="table__th">country</th>
								<th class="table__th">number of people</th>
							</tr>
						</thead>
						<tbody>
<?php
	
	foreach ( $tableArray['result'] as $tableItem ){
?>
							<tr>
								<td class="table__td"><?php echo htmlspecialchars($tableItem[0]) ?></td>
								<td class="table__td table__td-right"><?php echo number_format($tableItem[1], 0, '', ' '); ?></td>
							</tr>
<?php	
	}
?>
						</tbody>
					</table>
<?php
} else if ( $tableArray['result'] === [] ){
?>
					<h2>Countries Not Found</h2>
<?php	
} else {
?>
					<h2>SQL error</h2>
<?php	
}
?>
				</div>
			</div>
		</div>
	</section>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/footerView.php';
