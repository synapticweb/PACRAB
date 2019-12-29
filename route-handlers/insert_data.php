<?php

function insert_data() {
	$report = new Report();
	$request = Flight::request();
	$post_data = $request->data->getData();

	if(array_key_exists("INSTALLATION_ID", $post_data)) 
		$report->setInstallationId($post_data["INSTALLATION_ID"]);
	else 
		return ;
			
	if(array_key_exists("REPORT_ID", $post_data))
		$report->setReportId($post_data["REPORT_ID"]);
	if(array_key_exists("APP_VERSION_CODE", $post_data))
		$report->setAppVersionCode($post_data["APP_VERSION_CODE"]);
	if(array_key_exists("APP_VERSION_NAME", $post_data))
		$report->setAppVersionName($post_data["APP_VERSION_NAME"]);
	if(array_key_exists("PACKAGE_NAME", $post_data))
		$report->setPackageName($post_data["PACKAGE_NAME"]);
	if(array_key_exists("FILE_PATH", $post_data))
		$report->setFilePath($post_data["FILE_PATH"]);
	if(array_key_exists("PHONE_MODEL", $post_data))
		$report->setPhoneModel($post_data["PHONE_MODEL"]);
	if(array_key_exists("BRAND", $post_data))
		$report->setBrand($post_data["BRAND"]);
	if(array_key_exists("PRODUCT", $post_data))
		$report->setProduct($post_data["PRODUCT"]);
	if(array_key_exists("ANDROID_VERSION", $post_data))
		$report->setAndroidVersion($post_data["ANDROID_VERSION"]);
	if(array_key_exists("BUILD", $post_data))
		$report->setBuild($post_data["BUILD"]);
	if(array_key_exists("TOTAL_MEM_SIZE", $post_data))
		$report->setTotalMemSize($post_data["TOTAL_MEM_SIZE"]);
	if(array_key_exists("AVAILABLE_MEM_SIZE", $post_data))
		$report->setAvailableMemSize($post_data["AVAILABLE_MEM_SIZE"]);
	if(array_key_exists("BUILD_CONFIG", $post_data))
		$report->setBuildConfig($post_data["BUILD_CONFIG"]);
	if(array_key_exists("CUSTOM_DATA", $post_data))
		$report->setCustomData($post_data["CUSTOM_DATA"]);
	if(array_key_exists("IS_SILENT", $post_data))
		$report->setIsSilent($post_data["IS_SILENT"]);
	if(array_key_exists("STACK_TRACE", $post_data))
		$report->setStackTrace($post_data["STACK_TRACE"]);
	if(array_key_exists("INITIAL_CONFIGURATION", $post_data))
		$report->setInitialConfiguration($post_data["INITIAL_CONFIGURATION"]);
	if(array_key_exists("CRASH_CONFIGURATION", $post_data))
		$report->setCrashConfiguration($post_data["CRASH_CONFIGURATION"]);
	if(array_key_exists("DISPLAY", $post_data))
		$report->setDisplay($post_data["DISPLAY"]);
	if(array_key_exists("USER_COMMENT", $post_data))
		$report->setUserComment($post_data["USER_COMMENT"]);
	if(array_key_exists("USER_EMAIL", $post_data))
		$report->setUserEmail($post_data["USER_EMAIL"]);
	if(array_key_exists("USER_APP_START_DATE", $post_data))
		$report->setUserAppStartDate($post_data["USER_APP_START_DATE"]);
	if(array_key_exists("USER_CRASH_DATE", $post_data))
		$report->setUserCrashDate($post_data["USER_CRASH_DATE"]);
	if(array_key_exists("DUMPSYS_MEMINFO", $post_data))
		$report->setDumpsysMeminfo($post_data["DUMPSYS_MEMINFO"]);
	if(array_key_exists("LOGCAT", $post_data))
		$report->setLogcat($post_data["LOGCAT"]);
	if(array_key_exists("DEVICE_FEATURES", $post_data))
		$report->setDeviceFeatures($post_data["DEVICE_FEATURES"]);
	if(array_key_exists("ENVIRONMENT", $post_data))
		$report->setEnvironment($post_data["ENVIRONMENT"]);
	if(array_key_exists("SHARED_PREFERENCES", $post_data))
		$report->setSharedPreferences($post_data["SHARED_PREFERENCES"]);

	$report->setDateReceived(date("Y-m-d H:i:s"));

	$report->save();
}