<!DOCTYPE html>
<?php
	/**
	* This template receives from controller the following variables:
	*	- $packagesInfo: an array containing the number of reports for each package indexed with the package name.
	* 	- $days: An array of Day objects to be displayed
	*	- $page: the number of the current page
	*	- $num_pages: the total number of pages
	*/
?>
<html>
<head>
	<title>ACRAB main screen</title>
	<link rel="stylesheet" type="text/css" href="css/main-view.css">
</head>
	
<body>
	<div id="filtering">
		<p id="filter-status">
			<?php if(isset($_SESSION[FILTER])): ?>
				Reports are filtered by <?php echo $_SESSION[FILTER] ?>
			<?php else:?>
					Reports are unfiltered.
			<?php endif ?>
		</p>
		<p id="select-filter">
			<form action="<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/setfilter" ?>" method="POST">
				
				<?php if(count($packagesInfo) < 2 )
						  $disabled = true;
						  	else
						  $disabled = false
				?>

				<label for="<?php echo FILTER?>">Filter by:</label>

				<select name="<?php echo FILTER?>" <?php if($disabled) echo 'disabled="disabled"'?> >
					<?php foreach($packagesInfo as $package => $count) :?>
						<option value="<?php echo $package?>"><?php echo $package . "(" . $count . ")" ?></option>
					<?php endforeach ?>
					
					<?php if(isset($_SESSION[FILTER])) : ?>
						<option value="<?php echo REMOVE_FILTERING ?>">Unfiltered (all)</option>
					<?php endif ?>
				</select>
				<br/>
				<input type="submit" value="Filter" <?php if($disabled) echo 'disabled="disabled"'?> />
		</p>
	</div>
	
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
	<?php if($newerThan != null) : ?>
		<a href="/">Home</a>
		<a href="/newerThan=<?php echo $newerThan?>&olderThan=null">Previous</a>
	<?php endif ?>

	<?php if($olderThan != null) : ?>
		<a href="/newerThan=null&olderThan=<?php echo $olderThan ?>">Next</a>
	<?php endif ?>

</div>

</body>
</html>