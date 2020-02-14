<!DOCTYPE html>
<html>
<head>
	<title>ACRAB main screen</title>
</head>

<body>
	<h1>Crashes by date</h1>

	<?php foreach ($days as $day) : ?>
		<div class="day-box">
		<?php $date = new DateTime($day->getStartDate()) ?>
			<h2><?php echo $date->format('j F Y')?></h2>
			<hr/>
			
				<?php foreach($day->getDevicesInfo() as $device_info): ?>
					<div class="device-box">
						<a href="/installation_id=<?php echo $device_info->getInstallationId()?>&string_identifier=<?php echo $device_info->getIdentifierString()?>&start_date=<?php echo $day->getStartDate()?>&end_date=<?php echo $day->getEndDate()?>">
							<?php echo $device_info->getIdentifierString()?></a>
							<?php echo $device_info->getNumReports() ?>
					</div>
				<?php endforeach ?>
		</div>
	<?php endforeach ?>

<div id="footer">
<?php if($prev_offset != -1): ?>
	<a href="/offset=<?php echo $prev_offset?>">Previous</a>
	<a href="/">Home</a>
<?php endif ?>
<?php if($next_offset != -1): ?>
	<a href="/offset=<?php echo $next_offset ?>">Next</a>
<?php endif ?>
</div>
</div>

</body>
</html>