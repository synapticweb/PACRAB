<!DOCTYPE html>
<?php
	/**
	* This template receives from controller the following variables:
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
	<?php
		define('ADITIONAL_PAGES', 2);  //The number of aditional pages to include above and below the current page.
		$pages_to_display = array(); 
		for($i = $page - ADITIONAL_PAGES; $i <= $page + ADITIONAL_PAGES; ++$i)
			if($i >= 1 && $i <= $num_pages)
				$pages_to_display[] = $i;
	?>

<?php if($page > 1): ?>
	<a href="<?php
			$previous = $page - 1;
			if($previous == 1) 
				echo '/';
			else
				echo '/page=' . $previous;
		?>">Previous</a>
<?php endif ?>

	<?php if($pages_to_display[0] > 1): ?>
		<a href="/" <?php if($page == 1) echo 'class="current-page"'?>>1</a>
	<?php endif ?>

	<?php if($pages_to_display[0] > 2):?>
		...
	<?php endif ?>

	<?php foreach($pages_to_display as $current_page): ?>
		<a href="
		<?php if($current_page == 1) 
				echo '/';
			else
				echo '/page=' . $current_page;
		?>" <?php if($page == $current_page) echo 'class="current-page"'?>><?php echo $current_page?></a>
	<?php endforeach ?>

	<?php if(end($pages_to_display) < $num_pages - 1): ?>
		...
	<?php endif ?>

	<?php if(end($pages_to_display) < $num_pages): ?>
		<a href="/page=<?php echo $num_pages ?>" <?php if($page == $num_pages) echo 'class="current-page"'?>><?php echo $num_pages ?></a>
	<?php endif ?>

	<?php if($page < $num_pages): ?>
		<a href="/page=<?php echo $page + 1 ?>">Next</a>
	<?php endif ?>
</div>
</div>

</body>
</html>