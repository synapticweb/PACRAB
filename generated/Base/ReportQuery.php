<?php

namespace Base;

use \Report as ChildReport;
use \ReportQuery as ChildReportQuery;
use \Exception;
use \PDO;
use Map\ReportTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'report' table.
 *
 *
 *
 * @method     ChildReportQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildReportQuery orderByAndroidVersion($order = Criteria::ASC) Order by the android_version column
 * @method     ChildReportQuery orderByApplicationLog($order = Criteria::ASC) Order by the application_log column
 * @method     ChildReportQuery orderByAppVersionCode($order = Criteria::ASC) Order by the app_version_code column
 * @method     ChildReportQuery orderByAppVersionName($order = Criteria::ASC) Order by the app_version_name column
 * @method     ChildReportQuery orderByAvailableMemSize($order = Criteria::ASC) Order by the available_mem_size column
 * @method     ChildReportQuery orderByBrand($order = Criteria::ASC) Order by the brand column
 * @method     ChildReportQuery orderByBuild($order = Criteria::ASC) Order by the build column
 * @method     ChildReportQuery orderByBuildConfig($order = Criteria::ASC) Order by the build_config column
 * @method     ChildReportQuery orderByCrashConfiguration($order = Criteria::ASC) Order by the crash_configuration column
 * @method     ChildReportQuery orderByCustomData($order = Criteria::ASC) Order by the custom_data column
 * @method     ChildReportQuery orderByDateReceived($order = Criteria::ASC) Order by the date_received column
 * @method     ChildReportQuery orderByDeviceFeatures($order = Criteria::ASC) Order by the device_features column
 * @method     ChildReportQuery orderByDeviceId($order = Criteria::ASC) Order by the device_id column
 * @method     ChildReportQuery orderByDisplay($order = Criteria::ASC) Order by the display column
 * @method     ChildReportQuery orderByDropbox($order = Criteria::ASC) Order by the dropbox column
 * @method     ChildReportQuery orderByDumpsysMeminfo($order = Criteria::ASC) Order by the dumpsys_meminfo column
 * @method     ChildReportQuery orderByEnvironment($order = Criteria::ASC) Order by the environment column
 * @method     ChildReportQuery orderByEventslog($order = Criteria::ASC) Order by the eventslog column
 * @method     ChildReportQuery orderByFilePath($order = Criteria::ASC) Order by the file_path column
 * @method     ChildReportQuery orderByInitialConfiguration($order = Criteria::ASC) Order by the initial_configuration column
 * @method     ChildReportQuery orderByInstallationId($order = Criteria::ASC) Order by the installation_id column
 * @method     ChildReportQuery orderByIsSilent($order = Criteria::ASC) Order by the is_silent column
 * @method     ChildReportQuery orderByLogcat($order = Criteria::ASC) Order by the logcat column
 * @method     ChildReportQuery orderByMediaCodecList($order = Criteria::ASC) Order by the media_codec_list column
 * @method     ChildReportQuery orderByPackageName($order = Criteria::ASC) Order by the package_name column
 * @method     ChildReportQuery orderByPhoneModel($order = Criteria::ASC) Order by the phone_model column
 * @method     ChildReportQuery orderByProduct($order = Criteria::ASC) Order by the product column
 * @method     ChildReportQuery orderByRadiolog($order = Criteria::ASC) Order by the radiolog column
 * @method     ChildReportQuery orderByReportId($order = Criteria::ASC) Order by the report_id column
 * @method     ChildReportQuery orderBySettingsGlobal($order = Criteria::ASC) Order by the settings_global column
 * @method     ChildReportQuery orderBySettingsSecure($order = Criteria::ASC) Order by the settings_secure column
 * @method     ChildReportQuery orderBySettingsSystem($order = Criteria::ASC) Order by the settings_system column
 * @method     ChildReportQuery orderBySharedPreferences($order = Criteria::ASC) Order by the shared_preferences column
 * @method     ChildReportQuery orderByStackTrace($order = Criteria::ASC) Order by the stack_trace column
 * @method     ChildReportQuery orderByStackTraceHash($order = Criteria::ASC) Order by the stack_trace_hash column
 * @method     ChildReportQuery orderByThreadDetails($order = Criteria::ASC) Order by the thread_details column
 * @method     ChildReportQuery orderByTotalMemSize($order = Criteria::ASC) Order by the total_mem_size column
 * @method     ChildReportQuery orderByUserAppStartDate($order = Criteria::ASC) Order by the user_app_start_date column
 * @method     ChildReportQuery orderByUserComment($order = Criteria::ASC) Order by the user_comment column
 * @method     ChildReportQuery orderByUserCrashDate($order = Criteria::ASC) Order by the user_crash_date column
 * @method     ChildReportQuery orderByUserEmail($order = Criteria::ASC) Order by the user_email column
 *
 * @method     ChildReportQuery groupById() Group by the id column
 * @method     ChildReportQuery groupByAndroidVersion() Group by the android_version column
 * @method     ChildReportQuery groupByApplicationLog() Group by the application_log column
 * @method     ChildReportQuery groupByAppVersionCode() Group by the app_version_code column
 * @method     ChildReportQuery groupByAppVersionName() Group by the app_version_name column
 * @method     ChildReportQuery groupByAvailableMemSize() Group by the available_mem_size column
 * @method     ChildReportQuery groupByBrand() Group by the brand column
 * @method     ChildReportQuery groupByBuild() Group by the build column
 * @method     ChildReportQuery groupByBuildConfig() Group by the build_config column
 * @method     ChildReportQuery groupByCrashConfiguration() Group by the crash_configuration column
 * @method     ChildReportQuery groupByCustomData() Group by the custom_data column
 * @method     ChildReportQuery groupByDateReceived() Group by the date_received column
 * @method     ChildReportQuery groupByDeviceFeatures() Group by the device_features column
 * @method     ChildReportQuery groupByDeviceId() Group by the device_id column
 * @method     ChildReportQuery groupByDisplay() Group by the display column
 * @method     ChildReportQuery groupByDropbox() Group by the dropbox column
 * @method     ChildReportQuery groupByDumpsysMeminfo() Group by the dumpsys_meminfo column
 * @method     ChildReportQuery groupByEnvironment() Group by the environment column
 * @method     ChildReportQuery groupByEventslog() Group by the eventslog column
 * @method     ChildReportQuery groupByFilePath() Group by the file_path column
 * @method     ChildReportQuery groupByInitialConfiguration() Group by the initial_configuration column
 * @method     ChildReportQuery groupByInstallationId() Group by the installation_id column
 * @method     ChildReportQuery groupByIsSilent() Group by the is_silent column
 * @method     ChildReportQuery groupByLogcat() Group by the logcat column
 * @method     ChildReportQuery groupByMediaCodecList() Group by the media_codec_list column
 * @method     ChildReportQuery groupByPackageName() Group by the package_name column
 * @method     ChildReportQuery groupByPhoneModel() Group by the phone_model column
 * @method     ChildReportQuery groupByProduct() Group by the product column
 * @method     ChildReportQuery groupByRadiolog() Group by the radiolog column
 * @method     ChildReportQuery groupByReportId() Group by the report_id column
 * @method     ChildReportQuery groupBySettingsGlobal() Group by the settings_global column
 * @method     ChildReportQuery groupBySettingsSecure() Group by the settings_secure column
 * @method     ChildReportQuery groupBySettingsSystem() Group by the settings_system column
 * @method     ChildReportQuery groupBySharedPreferences() Group by the shared_preferences column
 * @method     ChildReportQuery groupByStackTrace() Group by the stack_trace column
 * @method     ChildReportQuery groupByStackTraceHash() Group by the stack_trace_hash column
 * @method     ChildReportQuery groupByThreadDetails() Group by the thread_details column
 * @method     ChildReportQuery groupByTotalMemSize() Group by the total_mem_size column
 * @method     ChildReportQuery groupByUserAppStartDate() Group by the user_app_start_date column
 * @method     ChildReportQuery groupByUserComment() Group by the user_comment column
 * @method     ChildReportQuery groupByUserCrashDate() Group by the user_crash_date column
 * @method     ChildReportQuery groupByUserEmail() Group by the user_email column
 *
 * @method     ChildReportQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReportQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReportQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReportQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReportQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReportQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReport findOne(ConnectionInterface $con = null) Return the first ChildReport matching the query
 * @method     ChildReport findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReport matching the query, or a new ChildReport object populated from the query conditions when no match is found
 *
 * @method     ChildReport findOneById(int $id) Return the first ChildReport filtered by the id column
 * @method     ChildReport findOneByAndroidVersion(string $android_version) Return the first ChildReport filtered by the android_version column
 * @method     ChildReport findOneByApplicationLog(string $application_log) Return the first ChildReport filtered by the application_log column
 * @method     ChildReport findOneByAppVersionCode(string $app_version_code) Return the first ChildReport filtered by the app_version_code column
 * @method     ChildReport findOneByAppVersionName(string $app_version_name) Return the first ChildReport filtered by the app_version_name column
 * @method     ChildReport findOneByAvailableMemSize(string $available_mem_size) Return the first ChildReport filtered by the available_mem_size column
 * @method     ChildReport findOneByBrand(string $brand) Return the first ChildReport filtered by the brand column
 * @method     ChildReport findOneByBuild(string $build) Return the first ChildReport filtered by the build column
 * @method     ChildReport findOneByBuildConfig(string $build_config) Return the first ChildReport filtered by the build_config column
 * @method     ChildReport findOneByCrashConfiguration(string $crash_configuration) Return the first ChildReport filtered by the crash_configuration column
 * @method     ChildReport findOneByCustomData(string $custom_data) Return the first ChildReport filtered by the custom_data column
 * @method     ChildReport findOneByDateReceived(string $date_received) Return the first ChildReport filtered by the date_received column
 * @method     ChildReport findOneByDeviceFeatures(string $device_features) Return the first ChildReport filtered by the device_features column
 * @method     ChildReport findOneByDeviceId(string $device_id) Return the first ChildReport filtered by the device_id column
 * @method     ChildReport findOneByDisplay(string $display) Return the first ChildReport filtered by the display column
 * @method     ChildReport findOneByDropbox(string $dropbox) Return the first ChildReport filtered by the dropbox column
 * @method     ChildReport findOneByDumpsysMeminfo(string $dumpsys_meminfo) Return the first ChildReport filtered by the dumpsys_meminfo column
 * @method     ChildReport findOneByEnvironment(string $environment) Return the first ChildReport filtered by the environment column
 * @method     ChildReport findOneByEventslog(string $eventslog) Return the first ChildReport filtered by the eventslog column
 * @method     ChildReport findOneByFilePath(string $file_path) Return the first ChildReport filtered by the file_path column
 * @method     ChildReport findOneByInitialConfiguration(string $initial_configuration) Return the first ChildReport filtered by the initial_configuration column
 * @method     ChildReport findOneByInstallationId(string $installation_id) Return the first ChildReport filtered by the installation_id column
 * @method     ChildReport findOneByIsSilent(string $is_silent) Return the first ChildReport filtered by the is_silent column
 * @method     ChildReport findOneByLogcat(string $logcat) Return the first ChildReport filtered by the logcat column
 * @method     ChildReport findOneByMediaCodecList(string $media_codec_list) Return the first ChildReport filtered by the media_codec_list column
 * @method     ChildReport findOneByPackageName(string $package_name) Return the first ChildReport filtered by the package_name column
 * @method     ChildReport findOneByPhoneModel(string $phone_model) Return the first ChildReport filtered by the phone_model column
 * @method     ChildReport findOneByProduct(string $product) Return the first ChildReport filtered by the product column
 * @method     ChildReport findOneByRadiolog(string $radiolog) Return the first ChildReport filtered by the radiolog column
 * @method     ChildReport findOneByReportId(string $report_id) Return the first ChildReport filtered by the report_id column
 * @method     ChildReport findOneBySettingsGlobal(string $settings_global) Return the first ChildReport filtered by the settings_global column
 * @method     ChildReport findOneBySettingsSecure(string $settings_secure) Return the first ChildReport filtered by the settings_secure column
 * @method     ChildReport findOneBySettingsSystem(string $settings_system) Return the first ChildReport filtered by the settings_system column
 * @method     ChildReport findOneBySharedPreferences(string $shared_preferences) Return the first ChildReport filtered by the shared_preferences column
 * @method     ChildReport findOneByStackTrace(string $stack_trace) Return the first ChildReport filtered by the stack_trace column
 * @method     ChildReport findOneByStackTraceHash(string $stack_trace_hash) Return the first ChildReport filtered by the stack_trace_hash column
 * @method     ChildReport findOneByThreadDetails(string $thread_details) Return the first ChildReport filtered by the thread_details column
 * @method     ChildReport findOneByTotalMemSize(string $total_mem_size) Return the first ChildReport filtered by the total_mem_size column
 * @method     ChildReport findOneByUserAppStartDate(string $user_app_start_date) Return the first ChildReport filtered by the user_app_start_date column
 * @method     ChildReport findOneByUserComment(string $user_comment) Return the first ChildReport filtered by the user_comment column
 * @method     ChildReport findOneByUserCrashDate(string $user_crash_date) Return the first ChildReport filtered by the user_crash_date column
 * @method     ChildReport findOneByUserEmail(string $user_email) Return the first ChildReport filtered by the user_email column *

 * @method     ChildReport requirePk($key, ConnectionInterface $con = null) Return the ChildReport by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOne(ConnectionInterface $con = null) Return the first ChildReport matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReport requireOneById(int $id) Return the first ChildReport filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByAndroidVersion(string $android_version) Return the first ChildReport filtered by the android_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByApplicationLog(string $application_log) Return the first ChildReport filtered by the application_log column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByAppVersionCode(string $app_version_code) Return the first ChildReport filtered by the app_version_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByAppVersionName(string $app_version_name) Return the first ChildReport filtered by the app_version_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByAvailableMemSize(string $available_mem_size) Return the first ChildReport filtered by the available_mem_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByBrand(string $brand) Return the first ChildReport filtered by the brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByBuild(string $build) Return the first ChildReport filtered by the build column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByBuildConfig(string $build_config) Return the first ChildReport filtered by the build_config column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByCrashConfiguration(string $crash_configuration) Return the first ChildReport filtered by the crash_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByCustomData(string $custom_data) Return the first ChildReport filtered by the custom_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDateReceived(string $date_received) Return the first ChildReport filtered by the date_received column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDeviceFeatures(string $device_features) Return the first ChildReport filtered by the device_features column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDeviceId(string $device_id) Return the first ChildReport filtered by the device_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDisplay(string $display) Return the first ChildReport filtered by the display column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDropbox(string $dropbox) Return the first ChildReport filtered by the dropbox column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByDumpsysMeminfo(string $dumpsys_meminfo) Return the first ChildReport filtered by the dumpsys_meminfo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByEnvironment(string $environment) Return the first ChildReport filtered by the environment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByEventslog(string $eventslog) Return the first ChildReport filtered by the eventslog column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByFilePath(string $file_path) Return the first ChildReport filtered by the file_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByInitialConfiguration(string $initial_configuration) Return the first ChildReport filtered by the initial_configuration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByInstallationId(string $installation_id) Return the first ChildReport filtered by the installation_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByIsSilent(string $is_silent) Return the first ChildReport filtered by the is_silent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByLogcat(string $logcat) Return the first ChildReport filtered by the logcat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByMediaCodecList(string $media_codec_list) Return the first ChildReport filtered by the media_codec_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByPackageName(string $package_name) Return the first ChildReport filtered by the package_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByPhoneModel(string $phone_model) Return the first ChildReport filtered by the phone_model column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByProduct(string $product) Return the first ChildReport filtered by the product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByRadiolog(string $radiolog) Return the first ChildReport filtered by the radiolog column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByReportId(string $report_id) Return the first ChildReport filtered by the report_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneBySettingsGlobal(string $settings_global) Return the first ChildReport filtered by the settings_global column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneBySettingsSecure(string $settings_secure) Return the first ChildReport filtered by the settings_secure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneBySettingsSystem(string $settings_system) Return the first ChildReport filtered by the settings_system column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneBySharedPreferences(string $shared_preferences) Return the first ChildReport filtered by the shared_preferences column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByStackTrace(string $stack_trace) Return the first ChildReport filtered by the stack_trace column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByStackTraceHash(string $stack_trace_hash) Return the first ChildReport filtered by the stack_trace_hash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByThreadDetails(string $thread_details) Return the first ChildReport filtered by the thread_details column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByTotalMemSize(string $total_mem_size) Return the first ChildReport filtered by the total_mem_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByUserAppStartDate(string $user_app_start_date) Return the first ChildReport filtered by the user_app_start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByUserComment(string $user_comment) Return the first ChildReport filtered by the user_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByUserCrashDate(string $user_crash_date) Return the first ChildReport filtered by the user_crash_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReport requireOneByUserEmail(string $user_email) Return the first ChildReport filtered by the user_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReport[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReport objects based on current ModelCriteria
 * @method     ChildReport[]|ObjectCollection findById(int $id) Return ChildReport objects filtered by the id column
 * @method     ChildReport[]|ObjectCollection findByAndroidVersion(string $android_version) Return ChildReport objects filtered by the android_version column
 * @method     ChildReport[]|ObjectCollection findByApplicationLog(string $application_log) Return ChildReport objects filtered by the application_log column
 * @method     ChildReport[]|ObjectCollection findByAppVersionCode(string $app_version_code) Return ChildReport objects filtered by the app_version_code column
 * @method     ChildReport[]|ObjectCollection findByAppVersionName(string $app_version_name) Return ChildReport objects filtered by the app_version_name column
 * @method     ChildReport[]|ObjectCollection findByAvailableMemSize(string $available_mem_size) Return ChildReport objects filtered by the available_mem_size column
 * @method     ChildReport[]|ObjectCollection findByBrand(string $brand) Return ChildReport objects filtered by the brand column
 * @method     ChildReport[]|ObjectCollection findByBuild(string $build) Return ChildReport objects filtered by the build column
 * @method     ChildReport[]|ObjectCollection findByBuildConfig(string $build_config) Return ChildReport objects filtered by the build_config column
 * @method     ChildReport[]|ObjectCollection findByCrashConfiguration(string $crash_configuration) Return ChildReport objects filtered by the crash_configuration column
 * @method     ChildReport[]|ObjectCollection findByCustomData(string $custom_data) Return ChildReport objects filtered by the custom_data column
 * @method     ChildReport[]|ObjectCollection findByDateReceived(string $date_received) Return ChildReport objects filtered by the date_received column
 * @method     ChildReport[]|ObjectCollection findByDeviceFeatures(string $device_features) Return ChildReport objects filtered by the device_features column
 * @method     ChildReport[]|ObjectCollection findByDeviceId(string $device_id) Return ChildReport objects filtered by the device_id column
 * @method     ChildReport[]|ObjectCollection findByDisplay(string $display) Return ChildReport objects filtered by the display column
 * @method     ChildReport[]|ObjectCollection findByDropbox(string $dropbox) Return ChildReport objects filtered by the dropbox column
 * @method     ChildReport[]|ObjectCollection findByDumpsysMeminfo(string $dumpsys_meminfo) Return ChildReport objects filtered by the dumpsys_meminfo column
 * @method     ChildReport[]|ObjectCollection findByEnvironment(string $environment) Return ChildReport objects filtered by the environment column
 * @method     ChildReport[]|ObjectCollection findByEventslog(string $eventslog) Return ChildReport objects filtered by the eventslog column
 * @method     ChildReport[]|ObjectCollection findByFilePath(string $file_path) Return ChildReport objects filtered by the file_path column
 * @method     ChildReport[]|ObjectCollection findByInitialConfiguration(string $initial_configuration) Return ChildReport objects filtered by the initial_configuration column
 * @method     ChildReport[]|ObjectCollection findByInstallationId(string $installation_id) Return ChildReport objects filtered by the installation_id column
 * @method     ChildReport[]|ObjectCollection findByIsSilent(string $is_silent) Return ChildReport objects filtered by the is_silent column
 * @method     ChildReport[]|ObjectCollection findByLogcat(string $logcat) Return ChildReport objects filtered by the logcat column
 * @method     ChildReport[]|ObjectCollection findByMediaCodecList(string $media_codec_list) Return ChildReport objects filtered by the media_codec_list column
 * @method     ChildReport[]|ObjectCollection findByPackageName(string $package_name) Return ChildReport objects filtered by the package_name column
 * @method     ChildReport[]|ObjectCollection findByPhoneModel(string $phone_model) Return ChildReport objects filtered by the phone_model column
 * @method     ChildReport[]|ObjectCollection findByProduct(string $product) Return ChildReport objects filtered by the product column
 * @method     ChildReport[]|ObjectCollection findByRadiolog(string $radiolog) Return ChildReport objects filtered by the radiolog column
 * @method     ChildReport[]|ObjectCollection findByReportId(string $report_id) Return ChildReport objects filtered by the report_id column
 * @method     ChildReport[]|ObjectCollection findBySettingsGlobal(string $settings_global) Return ChildReport objects filtered by the settings_global column
 * @method     ChildReport[]|ObjectCollection findBySettingsSecure(string $settings_secure) Return ChildReport objects filtered by the settings_secure column
 * @method     ChildReport[]|ObjectCollection findBySettingsSystem(string $settings_system) Return ChildReport objects filtered by the settings_system column
 * @method     ChildReport[]|ObjectCollection findBySharedPreferences(string $shared_preferences) Return ChildReport objects filtered by the shared_preferences column
 * @method     ChildReport[]|ObjectCollection findByStackTrace(string $stack_trace) Return ChildReport objects filtered by the stack_trace column
 * @method     ChildReport[]|ObjectCollection findByStackTraceHash(string $stack_trace_hash) Return ChildReport objects filtered by the stack_trace_hash column
 * @method     ChildReport[]|ObjectCollection findByThreadDetails(string $thread_details) Return ChildReport objects filtered by the thread_details column
 * @method     ChildReport[]|ObjectCollection findByTotalMemSize(string $total_mem_size) Return ChildReport objects filtered by the total_mem_size column
 * @method     ChildReport[]|ObjectCollection findByUserAppStartDate(string $user_app_start_date) Return ChildReport objects filtered by the user_app_start_date column
 * @method     ChildReport[]|ObjectCollection findByUserComment(string $user_comment) Return ChildReport objects filtered by the user_comment column
 * @method     ChildReport[]|ObjectCollection findByUserCrashDate(string $user_crash_date) Return ChildReport objects filtered by the user_crash_date column
 * @method     ChildReport[]|ObjectCollection findByUserEmail(string $user_email) Return ChildReport objects filtered by the user_email column
 * @method     ChildReport[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReportQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ReportQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Report', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReportQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReportQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReportQuery) {
            return $criteria;
        }
        $query = new ChildReportQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReport|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReportTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReportTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReport A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, android_version, application_log, app_version_code, app_version_name, available_mem_size, brand, build, build_config, crash_configuration, custom_data, date_received, device_features, device_id, display, dropbox, dumpsys_meminfo, environment, eventslog, file_path, initial_configuration, installation_id, is_silent, logcat, media_codec_list, package_name, phone_model, product, radiolog, report_id, settings_global, settings_secure, settings_system, shared_preferences, stack_trace, stack_trace_hash, thread_details, total_mem_size, user_app_start_date, user_comment, user_crash_date, user_email FROM report WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReport $obj */
            $obj = new ChildReport();
            $obj->hydrate($row);
            ReportTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildReport|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReportTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReportTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ReportTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ReportTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the android_version column
     *
     * Example usage:
     * <code>
     * $query->filterByAndroidVersion('fooValue');   // WHERE android_version = 'fooValue'
     * $query->filterByAndroidVersion('%fooValue%', Criteria::LIKE); // WHERE android_version LIKE '%fooValue%'
     * </code>
     *
     * @param     string $androidVersion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByAndroidVersion($androidVersion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($androidVersion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_ANDROID_VERSION, $androidVersion, $comparison);
    }

    /**
     * Filter the query on the application_log column
     *
     * Example usage:
     * <code>
     * $query->filterByApplicationLog('fooValue');   // WHERE application_log = 'fooValue'
     * $query->filterByApplicationLog('%fooValue%', Criteria::LIKE); // WHERE application_log LIKE '%fooValue%'
     * </code>
     *
     * @param     string $applicationLog The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByApplicationLog($applicationLog = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($applicationLog)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_APPLICATION_LOG, $applicationLog, $comparison);
    }

    /**
     * Filter the query on the app_version_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAppVersionCode('fooValue');   // WHERE app_version_code = 'fooValue'
     * $query->filterByAppVersionCode('%fooValue%', Criteria::LIKE); // WHERE app_version_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $appVersionCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByAppVersionCode($appVersionCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($appVersionCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_APP_VERSION_CODE, $appVersionCode, $comparison);
    }

    /**
     * Filter the query on the app_version_name column
     *
     * Example usage:
     * <code>
     * $query->filterByAppVersionName('fooValue');   // WHERE app_version_name = 'fooValue'
     * $query->filterByAppVersionName('%fooValue%', Criteria::LIKE); // WHERE app_version_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $appVersionName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByAppVersionName($appVersionName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($appVersionName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_APP_VERSION_NAME, $appVersionName, $comparison);
    }

    /**
     * Filter the query on the available_mem_size column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailableMemSize('fooValue');   // WHERE available_mem_size = 'fooValue'
     * $query->filterByAvailableMemSize('%fooValue%', Criteria::LIKE); // WHERE available_mem_size LIKE '%fooValue%'
     * </code>
     *
     * @param     string $availableMemSize The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByAvailableMemSize($availableMemSize = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($availableMemSize)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_AVAILABLE_MEM_SIZE, $availableMemSize, $comparison);
    }

    /**
     * Filter the query on the brand column
     *
     * Example usage:
     * <code>
     * $query->filterByBrand('fooValue');   // WHERE brand = 'fooValue'
     * $query->filterByBrand('%fooValue%', Criteria::LIKE); // WHERE brand LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brand The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByBrand($brand = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brand)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_BRAND, $brand, $comparison);
    }

    /**
     * Filter the query on the build column
     *
     * Example usage:
     * <code>
     * $query->filterByBuild('fooValue');   // WHERE build = 'fooValue'
     * $query->filterByBuild('%fooValue%', Criteria::LIKE); // WHERE build LIKE '%fooValue%'
     * </code>
     *
     * @param     string $build The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByBuild($build = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($build)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_BUILD, $build, $comparison);
    }

    /**
     * Filter the query on the build_config column
     *
     * Example usage:
     * <code>
     * $query->filterByBuildConfig('fooValue');   // WHERE build_config = 'fooValue'
     * $query->filterByBuildConfig('%fooValue%', Criteria::LIKE); // WHERE build_config LIKE '%fooValue%'
     * </code>
     *
     * @param     string $buildConfig The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByBuildConfig($buildConfig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buildConfig)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_BUILD_CONFIG, $buildConfig, $comparison);
    }

    /**
     * Filter the query on the crash_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByCrashConfiguration('fooValue');   // WHERE crash_configuration = 'fooValue'
     * $query->filterByCrashConfiguration('%fooValue%', Criteria::LIKE); // WHERE crash_configuration LIKE '%fooValue%'
     * </code>
     *
     * @param     string $crashConfiguration The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByCrashConfiguration($crashConfiguration = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($crashConfiguration)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_CRASH_CONFIGURATION, $crashConfiguration, $comparison);
    }

    /**
     * Filter the query on the custom_data column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomData('fooValue');   // WHERE custom_data = 'fooValue'
     * $query->filterByCustomData('%fooValue%', Criteria::LIKE); // WHERE custom_data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $customData The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByCustomData($customData = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($customData)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_CUSTOM_DATA, $customData, $comparison);
    }

    /**
     * Filter the query on the date_received column
     *
     * Example usage:
     * <code>
     * $query->filterByDateReceived('2011-03-14'); // WHERE date_received = '2011-03-14'
     * $query->filterByDateReceived('now'); // WHERE date_received = '2011-03-14'
     * $query->filterByDateReceived(array('max' => 'yesterday')); // WHERE date_received > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateReceived The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDateReceived($dateReceived = null, $comparison = null)
    {
        if (is_array($dateReceived)) {
            $useMinMax = false;
            if (isset($dateReceived['min'])) {
                $this->addUsingAlias(ReportTableMap::COL_DATE_RECEIVED, $dateReceived['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateReceived['max'])) {
                $this->addUsingAlias(ReportTableMap::COL_DATE_RECEIVED, $dateReceived['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DATE_RECEIVED, $dateReceived, $comparison);
    }

    /**
     * Filter the query on the device_features column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceFeatures('fooValue');   // WHERE device_features = 'fooValue'
     * $query->filterByDeviceFeatures('%fooValue%', Criteria::LIKE); // WHERE device_features LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deviceFeatures The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDeviceFeatures($deviceFeatures = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceFeatures)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DEVICE_FEATURES, $deviceFeatures, $comparison);
    }

    /**
     * Filter the query on the device_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviceId('fooValue');   // WHERE device_id = 'fooValue'
     * $query->filterByDeviceId('%fooValue%', Criteria::LIKE); // WHERE device_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deviceId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDeviceId($deviceId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deviceId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DEVICE_ID, $deviceId, $comparison);
    }

    /**
     * Filter the query on the display column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplay('fooValue');   // WHERE display = 'fooValue'
     * $query->filterByDisplay('%fooValue%', Criteria::LIKE); // WHERE display LIKE '%fooValue%'
     * </code>
     *
     * @param     string $display The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDisplay($display = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($display)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DISPLAY, $display, $comparison);
    }

    /**
     * Filter the query on the dropbox column
     *
     * Example usage:
     * <code>
     * $query->filterByDropbox('fooValue');   // WHERE dropbox = 'fooValue'
     * $query->filterByDropbox('%fooValue%', Criteria::LIKE); // WHERE dropbox LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dropbox The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDropbox($dropbox = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dropbox)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DROPBOX, $dropbox, $comparison);
    }

    /**
     * Filter the query on the dumpsys_meminfo column
     *
     * Example usage:
     * <code>
     * $query->filterByDumpsysMeminfo('fooValue');   // WHERE dumpsys_meminfo = 'fooValue'
     * $query->filterByDumpsysMeminfo('%fooValue%', Criteria::LIKE); // WHERE dumpsys_meminfo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dumpsysMeminfo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByDumpsysMeminfo($dumpsysMeminfo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dumpsysMeminfo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_DUMPSYS_MEMINFO, $dumpsysMeminfo, $comparison);
    }

    /**
     * Filter the query on the environment column
     *
     * Example usage:
     * <code>
     * $query->filterByEnvironment('fooValue');   // WHERE environment = 'fooValue'
     * $query->filterByEnvironment('%fooValue%', Criteria::LIKE); // WHERE environment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $environment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByEnvironment($environment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($environment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_ENVIRONMENT, $environment, $comparison);
    }

    /**
     * Filter the query on the eventslog column
     *
     * Example usage:
     * <code>
     * $query->filterByEventslog('fooValue');   // WHERE eventslog = 'fooValue'
     * $query->filterByEventslog('%fooValue%', Criteria::LIKE); // WHERE eventslog LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventslog The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByEventslog($eventslog = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventslog)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_EVENTSLOG, $eventslog, $comparison);
    }

    /**
     * Filter the query on the file_path column
     *
     * Example usage:
     * <code>
     * $query->filterByFilePath('fooValue');   // WHERE file_path = 'fooValue'
     * $query->filterByFilePath('%fooValue%', Criteria::LIKE); // WHERE file_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $filePath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByFilePath($filePath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($filePath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_FILE_PATH, $filePath, $comparison);
    }

    /**
     * Filter the query on the initial_configuration column
     *
     * Example usage:
     * <code>
     * $query->filterByInitialConfiguration('fooValue');   // WHERE initial_configuration = 'fooValue'
     * $query->filterByInitialConfiguration('%fooValue%', Criteria::LIKE); // WHERE initial_configuration LIKE '%fooValue%'
     * </code>
     *
     * @param     string $initialConfiguration The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByInitialConfiguration($initialConfiguration = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($initialConfiguration)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_INITIAL_CONFIGURATION, $initialConfiguration, $comparison);
    }

    /**
     * Filter the query on the installation_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInstallationId('fooValue');   // WHERE installation_id = 'fooValue'
     * $query->filterByInstallationId('%fooValue%', Criteria::LIKE); // WHERE installation_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $installationId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByInstallationId($installationId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($installationId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_INSTALLATION_ID, $installationId, $comparison);
    }

    /**
     * Filter the query on the is_silent column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSilent('fooValue');   // WHERE is_silent = 'fooValue'
     * $query->filterByIsSilent('%fooValue%', Criteria::LIKE); // WHERE is_silent LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isSilent The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByIsSilent($isSilent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isSilent)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_IS_SILENT, $isSilent, $comparison);
    }

    /**
     * Filter the query on the logcat column
     *
     * Example usage:
     * <code>
     * $query->filterByLogcat('fooValue');   // WHERE logcat = 'fooValue'
     * $query->filterByLogcat('%fooValue%', Criteria::LIKE); // WHERE logcat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $logcat The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByLogcat($logcat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($logcat)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_LOGCAT, $logcat, $comparison);
    }

    /**
     * Filter the query on the media_codec_list column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaCodecList('fooValue');   // WHERE media_codec_list = 'fooValue'
     * $query->filterByMediaCodecList('%fooValue%', Criteria::LIKE); // WHERE media_codec_list LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediaCodecList The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByMediaCodecList($mediaCodecList = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediaCodecList)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_MEDIA_CODEC_LIST, $mediaCodecList, $comparison);
    }

    /**
     * Filter the query on the package_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageName('fooValue');   // WHERE package_name = 'fooValue'
     * $query->filterByPackageName('%fooValue%', Criteria::LIKE); // WHERE package_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $packageName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByPackageName($packageName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($packageName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_PACKAGE_NAME, $packageName, $comparison);
    }

    /**
     * Filter the query on the phone_model column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneModel('fooValue');   // WHERE phone_model = 'fooValue'
     * $query->filterByPhoneModel('%fooValue%', Criteria::LIKE); // WHERE phone_model LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneModel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByPhoneModel($phoneModel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneModel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_PHONE_MODEL, $phoneModel, $comparison);
    }

    /**
     * Filter the query on the product column
     *
     * Example usage:
     * <code>
     * $query->filterByProduct('fooValue');   // WHERE product = 'fooValue'
     * $query->filterByProduct('%fooValue%', Criteria::LIKE); // WHERE product LIKE '%fooValue%'
     * </code>
     *
     * @param     string $product The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByProduct($product = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($product)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_PRODUCT, $product, $comparison);
    }

    /**
     * Filter the query on the radiolog column
     *
     * Example usage:
     * <code>
     * $query->filterByRadiolog('fooValue');   // WHERE radiolog = 'fooValue'
     * $query->filterByRadiolog('%fooValue%', Criteria::LIKE); // WHERE radiolog LIKE '%fooValue%'
     * </code>
     *
     * @param     string $radiolog The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByRadiolog($radiolog = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($radiolog)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_RADIOLOG, $radiolog, $comparison);
    }

    /**
     * Filter the query on the report_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReportId('fooValue');   // WHERE report_id = 'fooValue'
     * $query->filterByReportId('%fooValue%', Criteria::LIKE); // WHERE report_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reportId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByReportId($reportId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_REPORT_ID, $reportId, $comparison);
    }

    /**
     * Filter the query on the settings_global column
     *
     * Example usage:
     * <code>
     * $query->filterBySettingsGlobal('fooValue');   // WHERE settings_global = 'fooValue'
     * $query->filterBySettingsGlobal('%fooValue%', Criteria::LIKE); // WHERE settings_global LIKE '%fooValue%'
     * </code>
     *
     * @param     string $settingsGlobal The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterBySettingsGlobal($settingsGlobal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settingsGlobal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_SETTINGS_GLOBAL, $settingsGlobal, $comparison);
    }

    /**
     * Filter the query on the settings_secure column
     *
     * Example usage:
     * <code>
     * $query->filterBySettingsSecure('fooValue');   // WHERE settings_secure = 'fooValue'
     * $query->filterBySettingsSecure('%fooValue%', Criteria::LIKE); // WHERE settings_secure LIKE '%fooValue%'
     * </code>
     *
     * @param     string $settingsSecure The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterBySettingsSecure($settingsSecure = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settingsSecure)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_SETTINGS_SECURE, $settingsSecure, $comparison);
    }

    /**
     * Filter the query on the settings_system column
     *
     * Example usage:
     * <code>
     * $query->filterBySettingsSystem('fooValue');   // WHERE settings_system = 'fooValue'
     * $query->filterBySettingsSystem('%fooValue%', Criteria::LIKE); // WHERE settings_system LIKE '%fooValue%'
     * </code>
     *
     * @param     string $settingsSystem The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterBySettingsSystem($settingsSystem = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($settingsSystem)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_SETTINGS_SYSTEM, $settingsSystem, $comparison);
    }

    /**
     * Filter the query on the shared_preferences column
     *
     * Example usage:
     * <code>
     * $query->filterBySharedPreferences('fooValue');   // WHERE shared_preferences = 'fooValue'
     * $query->filterBySharedPreferences('%fooValue%', Criteria::LIKE); // WHERE shared_preferences LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sharedPreferences The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterBySharedPreferences($sharedPreferences = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sharedPreferences)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_SHARED_PREFERENCES, $sharedPreferences, $comparison);
    }

    /**
     * Filter the query on the stack_trace column
     *
     * Example usage:
     * <code>
     * $query->filterByStackTrace('fooValue');   // WHERE stack_trace = 'fooValue'
     * $query->filterByStackTrace('%fooValue%', Criteria::LIKE); // WHERE stack_trace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $stackTrace The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByStackTrace($stackTrace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stackTrace)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_STACK_TRACE, $stackTrace, $comparison);
    }

    /**
     * Filter the query on the stack_trace_hash column
     *
     * Example usage:
     * <code>
     * $query->filterByStackTraceHash('fooValue');   // WHERE stack_trace_hash = 'fooValue'
     * $query->filterByStackTraceHash('%fooValue%', Criteria::LIKE); // WHERE stack_trace_hash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $stackTraceHash The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByStackTraceHash($stackTraceHash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($stackTraceHash)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_STACK_TRACE_HASH, $stackTraceHash, $comparison);
    }

    /**
     * Filter the query on the thread_details column
     *
     * Example usage:
     * <code>
     * $query->filterByThreadDetails('fooValue');   // WHERE thread_details = 'fooValue'
     * $query->filterByThreadDetails('%fooValue%', Criteria::LIKE); // WHERE thread_details LIKE '%fooValue%'
     * </code>
     *
     * @param     string $threadDetails The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByThreadDetails($threadDetails = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($threadDetails)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_THREAD_DETAILS, $threadDetails, $comparison);
    }

    /**
     * Filter the query on the total_mem_size column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalMemSize('fooValue');   // WHERE total_mem_size = 'fooValue'
     * $query->filterByTotalMemSize('%fooValue%', Criteria::LIKE); // WHERE total_mem_size LIKE '%fooValue%'
     * </code>
     *
     * @param     string $totalMemSize The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByTotalMemSize($totalMemSize = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalMemSize)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_TOTAL_MEM_SIZE, $totalMemSize, $comparison);
    }

    /**
     * Filter the query on the user_app_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUserAppStartDate('fooValue');   // WHERE user_app_start_date = 'fooValue'
     * $query->filterByUserAppStartDate('%fooValue%', Criteria::LIKE); // WHERE user_app_start_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userAppStartDate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByUserAppStartDate($userAppStartDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userAppStartDate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_USER_APP_START_DATE, $userAppStartDate, $comparison);
    }

    /**
     * Filter the query on the user_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByUserComment('fooValue');   // WHERE user_comment = 'fooValue'
     * $query->filterByUserComment('%fooValue%', Criteria::LIKE); // WHERE user_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userComment The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByUserComment($userComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userComment)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_USER_COMMENT, $userComment, $comparison);
    }

    /**
     * Filter the query on the user_crash_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUserCrashDate('fooValue');   // WHERE user_crash_date = 'fooValue'
     * $query->filterByUserCrashDate('%fooValue%', Criteria::LIKE); // WHERE user_crash_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userCrashDate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByUserCrashDate($userCrashDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userCrashDate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_USER_CRASH_DATE, $userCrashDate, $comparison);
    }

    /**
     * Filter the query on the user_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUserEmail('fooValue');   // WHERE user_email = 'fooValue'
     * $query->filterByUserEmail('%fooValue%', Criteria::LIKE); // WHERE user_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userEmail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function filterByUserEmail($userEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userEmail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReportTableMap::COL_USER_EMAIL, $userEmail, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReport $report Object to remove from the list of results
     *
     * @return $this|ChildReportQuery The current query, for fluid interface
     */
    public function prune($report = null)
    {
        if ($report) {
            $this->addUsingAlias(ReportTableMap::COL_ID, $report->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the report table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReportTableMap::clearInstancePool();
            ReportTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReportTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReportTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReportTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReportQuery
