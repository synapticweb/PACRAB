<?php

require_once 'setup.php';

function insert_data() {
	$report = new Report();
	$request = Flight::request();
	$params = $request->data;

	$report->setInstallationId($params["INSTALLATION_ID"]);
	$report->setReportId($params["REPORT_ID"]);
	$report->setAppVersionCode($params["APP_VERSION_CODE"]);
	$report->setAppVersionName($params["APP_VERSION_NAME"]);
	$report->setPackageName($params["PACKAGE_NAME"]);
	$report->setFilePath($params["FILE_PATH"]);
	$report->setPhoneModel($params["PHONE_MODEL"]);
	$report->setBrand($params["BRAND"]);
	$report->setProduct($params["PRODUCT"]);
	$report->setAndroidVersion($params["ANDROID_VERSION"]);
	$report->setBuild($params["BUILD"]);
	$report->setTotalMemSize($params["TOTAL_MEM_SIZE"]);
	$report->setAvailableMemSize($params["AVAILABLE_MEM_SIZE"]);
	$report->setBuildConfig($params["BUILD_CONFIG"]);
	$report->setCustomData($params["CUSTOM_DATA"]);
	$report->setIsSilent($params["IS_SILENT"]);
	$report->setStackTrace($params["STACK_TRACE"]);
	$report->setInitialConfiguration($params["INITIAL_CONFIGURATION"]);
	$report->setCrashConfiguration($params["CRASH_CONFIGURATION"]);
	$report->setDisplay($params["DISPLAY"]);
	$report->setUserComment($params["USER_COMMENT"]);
	$report->setUserEmail($params["USER_EMAIL"]);
	$report->setUserAppStartDate($params["USER_APP_START_DATE"]);
	$report->setUserCrashDate($params["USER_CRASH_DATE"]);
	$report->setDumpsysMeminfo($params["DUMPSYS_MEMINFO"]);
	$report->setLogcat($params["LOGCAT"]);
	$report->setDeviceFeatures($params["DEVICE_FEATURES"]);
	$report->setEnvironment($params["ENVIRONMENT"]);
	$report->setSharedPreferences($params["SHARED_PREFERENCES"]);
	$report->setDateReceived(date("Y-m-d H:i:s"));

	$report->save();

	echo 'data inserted';
}

Flight::route('POST /insert', 'insert_data');
Flight::route('/', function() {
	echo 'it works';
});

Flight::start();