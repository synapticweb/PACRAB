<?php 
define("MIN_LENGTH_TEXTAREA", 20);
define("MIN_LENGTH_NO_FORMAT", 1)
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Report <?php echo $report->getReportId()?></title>
	<link rel="stylesheet" type="text/css" href="css/show-reports.css">
</head>
<body>
	<h1>Report <?php echo $report->getReportId()?></h1>

	<div id="main-container">

		<div class="field-box">
			<div class="field-name">Date and time of report</div>
			<div class="field_value">
				<?php $field = $report->getDateReceived()->format('Y-m-d H:i:s');
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>


		<div class="field-box">
			<div class="field-name">Installation id</div>
			<div class="field_value"><a href="/installation_id=<?php echo $report->getInstallationId()?>">
				<?php echo $report->getInstallationId()?></a>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">App version code</div>
			<div class="field-value">
				<?php $field = $report->getAppVersionCode();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">App version name</div>
			<div class="field-value">
				<?php $field = $report->getAppVersionName();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Package name</div>
			<div class="field-value">
				<?php $field = $report->getPackageName();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">File path</div>
			<div class="field-value">
				<?php $field = $report->getFilePath();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Phone model</div>
			<div class="field-value">
				<?php $field = $report->getPhoneModel();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Brand</div>
			<div class="field-value">
				<?php $field = $report->getBrand();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Product</div>
			<div class="field-value">
				<?php $field = $report->getProduct();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Android version</div>
			<div class="field-value">
				<?php $field = $report->getAndroidVersion();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Build</div>
			<div class="field-value">
			<?php $field = $report->getBuild() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Total memory size</div>
			<div class="field-value">
				<?php $field = $report->getTotalMemSize();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>	

		<div class="field-box">
			<div class="field-name">Available mem size</div>
			<div class="field-value">
				<?php $field = $report->getAvailableMemSize();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Build Config</div>
			<div class="field-value">
			<?php $field = $report->getBuildConfig() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Custom data</div>
			<div class="field-value">
			<?php $field = $report->getCustomData() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Is silent</div>
			<div class="field-value">
				<?php $field = $report->getIsSilent();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>
		<div class="field-box">
			<div class="field-name">Stack trace</div>
			<div class="field-value">
			<?php $field = $report->getStackTrace() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Initial configuration</div>
			<div class="field-value">
			<?php $field = $report->getInitialConfiguration() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Crash configuration</div>
			<div class="field-value">
			<?php $field = $report->getCrashConfiguration() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Display</div>
			<div class="field-value">
			<?php $field = $report->getDisplay() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>
		<div class="field-box">
			<div class="field-name">User comment</div>
			<div class="field-value">
				<?php $field = $report->getUserComment();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>
		<div class="field-box">
			<div class="field-name">User email</div>
			<div class="field-value">
				<?php $field = $report->getUserEmail();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>
	
		<div class="field-box">
			<div class="field-name">User app start date</div>
			<div class="field-value">
				<?php $field = $report->getUserAppStartDate();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>
	
		<div class="field-box">
			<div class="field-name">User crash date</div>
			<div class="field-value">
				<?php $field = $report->getUserCrashDate();
						if(strlen($field) >= MIN_LENGTH_NO_FORMAT)
							echo $field;
						else
							echo 'N/A';
				?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Dumpsys meminfo</div>
			<div class="field-value">
			<?php $field = $report->getDumpsysMeminfo() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>
		<div class="field-box">
			<div class="field-name">Logcat</div>
			<div class="field-value">
			<?php $field = $report->getLogcat() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Device features</div>
			<div class="field-value">
			<?php $field = $report->getDeviceFeatures() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>
		<div class="field-box">
			<div class="field-name">Environment</div>
			<div class="field-value">
			<?php $field = $report->getEnvironment() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>

		<div class="field-box">
			<div class="field-name">Shared preferences</div>
			<div class="field-value">
			<?php $field = $report->getSharedPreferences() ?>
				<?php if(strlen($field) > MIN_LENGTH_TEXTAREA ): ?>
					<textarea readonly="readonly"><?php echo $field ?></textarea>
				<?php elseif (strlen($field) == 0):?>
					<?php echo 'N/A' ?>
				<?php else :?>
					<?php echo $field ?>
			<?php endif ?>
			</div>
		</div>
	</div>

</body>
</html>