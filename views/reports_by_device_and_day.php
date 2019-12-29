<!DOCTYPE html>
<html>
<head>
	<title>Reports produced by <?php echo $identifier_string?></title>
</head>
<body>
	<?php $date = new DateTime($date) ?>
	<h1>Reports produced by device <?php echo $identifier_string ?> (Installation id: <?php echo $installation_id ?>) in <?php echo $date->format('j F Y')?>: </h1>

	<?php foreach($pks_ids_dates as $pk_id_date): ?>
		<div class="report_box">
			<a href="/report=<?php echo $pk_id_date['id']?>"><?php echo $pk_id_date['report_id']?></a>
			<?php $time = new DateTime($pk_id_date['date_received'])?>
			<?php echo $time->format('G:i:s') ?>
		</div>
	<?php endforeach ?>
</body>
</html>