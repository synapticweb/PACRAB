<?php

namespace Map;

use \Report;
use \ReportQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'report' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ReportTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReportTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'report';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Report';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Report';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 42;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 42;

    /**
     * the column name for the id field
     */
    const COL_ID = 'report.id';

    /**
     * the column name for the android_version field
     */
    const COL_ANDROID_VERSION = 'report.android_version';

    /**
     * the column name for the application_log field
     */
    const COL_APPLICATION_LOG = 'report.application_log';

    /**
     * the column name for the app_version_code field
     */
    const COL_APP_VERSION_CODE = 'report.app_version_code';

    /**
     * the column name for the app_version_name field
     */
    const COL_APP_VERSION_NAME = 'report.app_version_name';

    /**
     * the column name for the available_mem_size field
     */
    const COL_AVAILABLE_MEM_SIZE = 'report.available_mem_size';

    /**
     * the column name for the brand field
     */
    const COL_BRAND = 'report.brand';

    /**
     * the column name for the build field
     */
    const COL_BUILD = 'report.build';

    /**
     * the column name for the build_config field
     */
    const COL_BUILD_CONFIG = 'report.build_config';

    /**
     * the column name for the crash_configuration field
     */
    const COL_CRASH_CONFIGURATION = 'report.crash_configuration';

    /**
     * the column name for the custom_data field
     */
    const COL_CUSTOM_DATA = 'report.custom_data';

    /**
     * the column name for the date_received field
     */
    const COL_DATE_RECEIVED = 'report.date_received';

    /**
     * the column name for the device_features field
     */
    const COL_DEVICE_FEATURES = 'report.device_features';

    /**
     * the column name for the device_id field
     */
    const COL_DEVICE_ID = 'report.device_id';

    /**
     * the column name for the display field
     */
    const COL_DISPLAY = 'report.display';

    /**
     * the column name for the dropbox field
     */
    const COL_DROPBOX = 'report.dropbox';

    /**
     * the column name for the dumpsys_meminfo field
     */
    const COL_DUMPSYS_MEMINFO = 'report.dumpsys_meminfo';

    /**
     * the column name for the environment field
     */
    const COL_ENVIRONMENT = 'report.environment';

    /**
     * the column name for the eventslog field
     */
    const COL_EVENTSLOG = 'report.eventslog';

    /**
     * the column name for the file_path field
     */
    const COL_FILE_PATH = 'report.file_path';

    /**
     * the column name for the initial_configuration field
     */
    const COL_INITIAL_CONFIGURATION = 'report.initial_configuration';

    /**
     * the column name for the installation_id field
     */
    const COL_INSTALLATION_ID = 'report.installation_id';

    /**
     * the column name for the is_silent field
     */
    const COL_IS_SILENT = 'report.is_silent';

    /**
     * the column name for the logcat field
     */
    const COL_LOGCAT = 'report.logcat';

    /**
     * the column name for the media_codec_list field
     */
    const COL_MEDIA_CODEC_LIST = 'report.media_codec_list';

    /**
     * the column name for the package_name field
     */
    const COL_PACKAGE_NAME = 'report.package_name';

    /**
     * the column name for the phone_model field
     */
    const COL_PHONE_MODEL = 'report.phone_model';

    /**
     * the column name for the product field
     */
    const COL_PRODUCT = 'report.product';

    /**
     * the column name for the radiolog field
     */
    const COL_RADIOLOG = 'report.radiolog';

    /**
     * the column name for the report_id field
     */
    const COL_REPORT_ID = 'report.report_id';

    /**
     * the column name for the settings_global field
     */
    const COL_SETTINGS_GLOBAL = 'report.settings_global';

    /**
     * the column name for the settings_secure field
     */
    const COL_SETTINGS_SECURE = 'report.settings_secure';

    /**
     * the column name for the settings_system field
     */
    const COL_SETTINGS_SYSTEM = 'report.settings_system';

    /**
     * the column name for the shared_preferences field
     */
    const COL_SHARED_PREFERENCES = 'report.shared_preferences';

    /**
     * the column name for the stack_trace field
     */
    const COL_STACK_TRACE = 'report.stack_trace';

    /**
     * the column name for the stack_trace_hash field
     */
    const COL_STACK_TRACE_HASH = 'report.stack_trace_hash';

    /**
     * the column name for the thread_details field
     */
    const COL_THREAD_DETAILS = 'report.thread_details';

    /**
     * the column name for the total_mem_size field
     */
    const COL_TOTAL_MEM_SIZE = 'report.total_mem_size';

    /**
     * the column name for the user_app_start_date field
     */
    const COL_USER_APP_START_DATE = 'report.user_app_start_date';

    /**
     * the column name for the user_comment field
     */
    const COL_USER_COMMENT = 'report.user_comment';

    /**
     * the column name for the user_crash_date field
     */
    const COL_USER_CRASH_DATE = 'report.user_crash_date';

    /**
     * the column name for the user_email field
     */
    const COL_USER_EMAIL = 'report.user_email';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'AndroidVersion', 'ApplicationLog', 'AppVersionCode', 'AppVersionName', 'AvailableMemSize', 'Brand', 'Build', 'BuildConfig', 'CrashConfiguration', 'CustomData', 'DateReceived', 'DeviceFeatures', 'DeviceId', 'Display', 'Dropbox', 'DumpsysMeminfo', 'Environment', 'Eventslog', 'FilePath', 'InitialConfiguration', 'InstallationId', 'IsSilent', 'Logcat', 'MediaCodecList', 'PackageName', 'PhoneModel', 'Product', 'Radiolog', 'ReportId', 'SettingsGlobal', 'SettingsSecure', 'SettingsSystem', 'SharedPreferences', 'StackTrace', 'StackTraceHash', 'ThreadDetails', 'TotalMemSize', 'UserAppStartDate', 'UserComment', 'UserCrashDate', 'UserEmail', ),
        self::TYPE_CAMELNAME     => array('id', 'androidVersion', 'applicationLog', 'appVersionCode', 'appVersionName', 'availableMemSize', 'brand', 'build', 'buildConfig', 'crashConfiguration', 'customData', 'dateReceived', 'deviceFeatures', 'deviceId', 'display', 'dropbox', 'dumpsysMeminfo', 'environment', 'eventslog', 'filePath', 'initialConfiguration', 'installationId', 'isSilent', 'logcat', 'mediaCodecList', 'packageName', 'phoneModel', 'product', 'radiolog', 'reportId', 'settingsGlobal', 'settingsSecure', 'settingsSystem', 'sharedPreferences', 'stackTrace', 'stackTraceHash', 'threadDetails', 'totalMemSize', 'userAppStartDate', 'userComment', 'userCrashDate', 'userEmail', ),
        self::TYPE_COLNAME       => array(ReportTableMap::COL_ID, ReportTableMap::COL_ANDROID_VERSION, ReportTableMap::COL_APPLICATION_LOG, ReportTableMap::COL_APP_VERSION_CODE, ReportTableMap::COL_APP_VERSION_NAME, ReportTableMap::COL_AVAILABLE_MEM_SIZE, ReportTableMap::COL_BRAND, ReportTableMap::COL_BUILD, ReportTableMap::COL_BUILD_CONFIG, ReportTableMap::COL_CRASH_CONFIGURATION, ReportTableMap::COL_CUSTOM_DATA, ReportTableMap::COL_DATE_RECEIVED, ReportTableMap::COL_DEVICE_FEATURES, ReportTableMap::COL_DEVICE_ID, ReportTableMap::COL_DISPLAY, ReportTableMap::COL_DROPBOX, ReportTableMap::COL_DUMPSYS_MEMINFO, ReportTableMap::COL_ENVIRONMENT, ReportTableMap::COL_EVENTSLOG, ReportTableMap::COL_FILE_PATH, ReportTableMap::COL_INITIAL_CONFIGURATION, ReportTableMap::COL_INSTALLATION_ID, ReportTableMap::COL_IS_SILENT, ReportTableMap::COL_LOGCAT, ReportTableMap::COL_MEDIA_CODEC_LIST, ReportTableMap::COL_PACKAGE_NAME, ReportTableMap::COL_PHONE_MODEL, ReportTableMap::COL_PRODUCT, ReportTableMap::COL_RADIOLOG, ReportTableMap::COL_REPORT_ID, ReportTableMap::COL_SETTINGS_GLOBAL, ReportTableMap::COL_SETTINGS_SECURE, ReportTableMap::COL_SETTINGS_SYSTEM, ReportTableMap::COL_SHARED_PREFERENCES, ReportTableMap::COL_STACK_TRACE, ReportTableMap::COL_STACK_TRACE_HASH, ReportTableMap::COL_THREAD_DETAILS, ReportTableMap::COL_TOTAL_MEM_SIZE, ReportTableMap::COL_USER_APP_START_DATE, ReportTableMap::COL_USER_COMMENT, ReportTableMap::COL_USER_CRASH_DATE, ReportTableMap::COL_USER_EMAIL, ),
        self::TYPE_FIELDNAME     => array('id', 'android_version', 'application_log', 'app_version_code', 'app_version_name', 'available_mem_size', 'brand', 'build', 'build_config', 'crash_configuration', 'custom_data', 'date_received', 'device_features', 'device_id', 'display', 'dropbox', 'dumpsys_meminfo', 'environment', 'eventslog', 'file_path', 'initial_configuration', 'installation_id', 'is_silent', 'logcat', 'media_codec_list', 'package_name', 'phone_model', 'product', 'radiolog', 'report_id', 'settings_global', 'settings_secure', 'settings_system', 'shared_preferences', 'stack_trace', 'stack_trace_hash', 'thread_details', 'total_mem_size', 'user_app_start_date', 'user_comment', 'user_crash_date', 'user_email', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AndroidVersion' => 1, 'ApplicationLog' => 2, 'AppVersionCode' => 3, 'AppVersionName' => 4, 'AvailableMemSize' => 5, 'Brand' => 6, 'Build' => 7, 'BuildConfig' => 8, 'CrashConfiguration' => 9, 'CustomData' => 10, 'DateReceived' => 11, 'DeviceFeatures' => 12, 'DeviceId' => 13, 'Display' => 14, 'Dropbox' => 15, 'DumpsysMeminfo' => 16, 'Environment' => 17, 'Eventslog' => 18, 'FilePath' => 19, 'InitialConfiguration' => 20, 'InstallationId' => 21, 'IsSilent' => 22, 'Logcat' => 23, 'MediaCodecList' => 24, 'PackageName' => 25, 'PhoneModel' => 26, 'Product' => 27, 'Radiolog' => 28, 'ReportId' => 29, 'SettingsGlobal' => 30, 'SettingsSecure' => 31, 'SettingsSystem' => 32, 'SharedPreferences' => 33, 'StackTrace' => 34, 'StackTraceHash' => 35, 'ThreadDetails' => 36, 'TotalMemSize' => 37, 'UserAppStartDate' => 38, 'UserComment' => 39, 'UserCrashDate' => 40, 'UserEmail' => 41, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'androidVersion' => 1, 'applicationLog' => 2, 'appVersionCode' => 3, 'appVersionName' => 4, 'availableMemSize' => 5, 'brand' => 6, 'build' => 7, 'buildConfig' => 8, 'crashConfiguration' => 9, 'customData' => 10, 'dateReceived' => 11, 'deviceFeatures' => 12, 'deviceId' => 13, 'display' => 14, 'dropbox' => 15, 'dumpsysMeminfo' => 16, 'environment' => 17, 'eventslog' => 18, 'filePath' => 19, 'initialConfiguration' => 20, 'installationId' => 21, 'isSilent' => 22, 'logcat' => 23, 'mediaCodecList' => 24, 'packageName' => 25, 'phoneModel' => 26, 'product' => 27, 'radiolog' => 28, 'reportId' => 29, 'settingsGlobal' => 30, 'settingsSecure' => 31, 'settingsSystem' => 32, 'sharedPreferences' => 33, 'stackTrace' => 34, 'stackTraceHash' => 35, 'threadDetails' => 36, 'totalMemSize' => 37, 'userAppStartDate' => 38, 'userComment' => 39, 'userCrashDate' => 40, 'userEmail' => 41, ),
        self::TYPE_COLNAME       => array(ReportTableMap::COL_ID => 0, ReportTableMap::COL_ANDROID_VERSION => 1, ReportTableMap::COL_APPLICATION_LOG => 2, ReportTableMap::COL_APP_VERSION_CODE => 3, ReportTableMap::COL_APP_VERSION_NAME => 4, ReportTableMap::COL_AVAILABLE_MEM_SIZE => 5, ReportTableMap::COL_BRAND => 6, ReportTableMap::COL_BUILD => 7, ReportTableMap::COL_BUILD_CONFIG => 8, ReportTableMap::COL_CRASH_CONFIGURATION => 9, ReportTableMap::COL_CUSTOM_DATA => 10, ReportTableMap::COL_DATE_RECEIVED => 11, ReportTableMap::COL_DEVICE_FEATURES => 12, ReportTableMap::COL_DEVICE_ID => 13, ReportTableMap::COL_DISPLAY => 14, ReportTableMap::COL_DROPBOX => 15, ReportTableMap::COL_DUMPSYS_MEMINFO => 16, ReportTableMap::COL_ENVIRONMENT => 17, ReportTableMap::COL_EVENTSLOG => 18, ReportTableMap::COL_FILE_PATH => 19, ReportTableMap::COL_INITIAL_CONFIGURATION => 20, ReportTableMap::COL_INSTALLATION_ID => 21, ReportTableMap::COL_IS_SILENT => 22, ReportTableMap::COL_LOGCAT => 23, ReportTableMap::COL_MEDIA_CODEC_LIST => 24, ReportTableMap::COL_PACKAGE_NAME => 25, ReportTableMap::COL_PHONE_MODEL => 26, ReportTableMap::COL_PRODUCT => 27, ReportTableMap::COL_RADIOLOG => 28, ReportTableMap::COL_REPORT_ID => 29, ReportTableMap::COL_SETTINGS_GLOBAL => 30, ReportTableMap::COL_SETTINGS_SECURE => 31, ReportTableMap::COL_SETTINGS_SYSTEM => 32, ReportTableMap::COL_SHARED_PREFERENCES => 33, ReportTableMap::COL_STACK_TRACE => 34, ReportTableMap::COL_STACK_TRACE_HASH => 35, ReportTableMap::COL_THREAD_DETAILS => 36, ReportTableMap::COL_TOTAL_MEM_SIZE => 37, ReportTableMap::COL_USER_APP_START_DATE => 38, ReportTableMap::COL_USER_COMMENT => 39, ReportTableMap::COL_USER_CRASH_DATE => 40, ReportTableMap::COL_USER_EMAIL => 41, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'android_version' => 1, 'application_log' => 2, 'app_version_code' => 3, 'app_version_name' => 4, 'available_mem_size' => 5, 'brand' => 6, 'build' => 7, 'build_config' => 8, 'crash_configuration' => 9, 'custom_data' => 10, 'date_received' => 11, 'device_features' => 12, 'device_id' => 13, 'display' => 14, 'dropbox' => 15, 'dumpsys_meminfo' => 16, 'environment' => 17, 'eventslog' => 18, 'file_path' => 19, 'initial_configuration' => 20, 'installation_id' => 21, 'is_silent' => 22, 'logcat' => 23, 'media_codec_list' => 24, 'package_name' => 25, 'phone_model' => 26, 'product' => 27, 'radiolog' => 28, 'report_id' => 29, 'settings_global' => 30, 'settings_secure' => 31, 'settings_system' => 32, 'shared_preferences' => 33, 'stack_trace' => 34, 'stack_trace_hash' => 35, 'thread_details' => 36, 'total_mem_size' => 37, 'user_app_start_date' => 38, 'user_comment' => 39, 'user_crash_date' => 40, 'user_email' => 41, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('report');
        $this->setPhpName('Report');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Report');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('android_version', 'AndroidVersion', 'VARCHAR', false, 10, null);
        $this->addColumn('application_log', 'ApplicationLog', 'LONGVARCHAR', false, null, null);
        $this->addColumn('app_version_code', 'AppVersionCode', 'VARCHAR', false, 10, null);
        $this->addColumn('app_version_name', 'AppVersionName', 'VARCHAR', false, 100, null);
        $this->addColumn('available_mem_size', 'AvailableMemSize', 'VARCHAR', false, 100, null);
        $this->addColumn('brand', 'Brand', 'VARCHAR', false, 100, null);
        $this->addColumn('build', 'Build', 'LONGVARCHAR', false, null, null);
        $this->addColumn('build_config', 'BuildConfig', 'LONGVARCHAR', false, null, null);
        $this->addColumn('crash_configuration', 'CrashConfiguration', 'LONGVARCHAR', false, null, null);
        $this->addColumn('custom_data', 'CustomData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('date_received', 'DateReceived', 'TIMESTAMP', false, null, null);
        $this->addColumn('device_features', 'DeviceFeatures', 'LONGVARCHAR', false, null, null);
        $this->addColumn('device_id', 'DeviceId', 'VARCHAR', false, 100, null);
        $this->addColumn('display', 'Display', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dropbox', 'Dropbox', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dumpsys_meminfo', 'DumpsysMeminfo', 'LONGVARCHAR', false, null, null);
        $this->addColumn('environment', 'Environment', 'LONGVARCHAR', false, null, null);
        $this->addColumn('eventslog', 'Eventslog', 'LONGVARCHAR', false, null, null);
        $this->addColumn('file_path', 'FilePath', 'VARCHAR', false, 100, null);
        $this->addColumn('initial_configuration', 'InitialConfiguration', 'LONGVARCHAR', false, null, null);
        $this->addColumn('installation_id', 'InstallationId', 'VARCHAR', true, 100, null);
        $this->addColumn('is_silent', 'IsSilent', 'VARCHAR', false, 10, null);
        $this->addColumn('logcat', 'Logcat', 'LONGVARCHAR', false, null, null);
        $this->addColumn('media_codec_list', 'MediaCodecList', 'LONGVARCHAR', false, null, null);
        $this->addColumn('package_name', 'PackageName', 'VARCHAR', false, 100, null);
        $this->addColumn('phone_model', 'PhoneModel', 'VARCHAR', false, 100, null);
        $this->addColumn('product', 'Product', 'VARCHAR', false, 100, null);
        $this->addColumn('radiolog', 'Radiolog', 'LONGVARCHAR', false, null, null);
        $this->addColumn('report_id', 'ReportId', 'VARCHAR', false, 64, null);
        $this->addColumn('settings_global', 'SettingsGlobal', 'LONGVARCHAR', false, null, null);
        $this->addColumn('settings_secure', 'SettingsSecure', 'LONGVARCHAR', false, null, null);
        $this->addColumn('settings_system', 'SettingsSystem', 'LONGVARCHAR', false, null, null);
        $this->addColumn('shared_preferences', 'SharedPreferences', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stack_trace', 'StackTrace', 'LONGVARCHAR', false, null, null);
        $this->addColumn('stack_trace_hash', 'StackTraceHash', 'VARCHAR', false, 100, null);
        $this->addColumn('thread_details', 'ThreadDetails', 'VARCHAR', false, 1000, null);
        $this->addColumn('total_mem_size', 'TotalMemSize', 'VARCHAR', false, 100, null);
        $this->addColumn('user_app_start_date', 'UserAppStartDate', 'VARCHAR', false, 100, null);
        $this->addColumn('user_comment', 'UserComment', 'VARCHAR', false, 256, null);
        $this->addColumn('user_crash_date', 'UserCrashDate', 'VARCHAR', false, 100, null);
        $this->addColumn('user_email', 'UserEmail', 'VARCHAR', false, 100, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ReportTableMap::CLASS_DEFAULT : ReportTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Report object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReportTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReportTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReportTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReportTableMap::OM_CLASS;
            /** @var Report $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReportTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ReportTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReportTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Report $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReportTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ReportTableMap::COL_ID);
            $criteria->addSelectColumn(ReportTableMap::COL_ANDROID_VERSION);
            $criteria->addSelectColumn(ReportTableMap::COL_APPLICATION_LOG);
            $criteria->addSelectColumn(ReportTableMap::COL_APP_VERSION_CODE);
            $criteria->addSelectColumn(ReportTableMap::COL_APP_VERSION_NAME);
            $criteria->addSelectColumn(ReportTableMap::COL_AVAILABLE_MEM_SIZE);
            $criteria->addSelectColumn(ReportTableMap::COL_BRAND);
            $criteria->addSelectColumn(ReportTableMap::COL_BUILD);
            $criteria->addSelectColumn(ReportTableMap::COL_BUILD_CONFIG);
            $criteria->addSelectColumn(ReportTableMap::COL_CRASH_CONFIGURATION);
            $criteria->addSelectColumn(ReportTableMap::COL_CUSTOM_DATA);
            $criteria->addSelectColumn(ReportTableMap::COL_DATE_RECEIVED);
            $criteria->addSelectColumn(ReportTableMap::COL_DEVICE_FEATURES);
            $criteria->addSelectColumn(ReportTableMap::COL_DEVICE_ID);
            $criteria->addSelectColumn(ReportTableMap::COL_DISPLAY);
            $criteria->addSelectColumn(ReportTableMap::COL_DROPBOX);
            $criteria->addSelectColumn(ReportTableMap::COL_DUMPSYS_MEMINFO);
            $criteria->addSelectColumn(ReportTableMap::COL_ENVIRONMENT);
            $criteria->addSelectColumn(ReportTableMap::COL_EVENTSLOG);
            $criteria->addSelectColumn(ReportTableMap::COL_FILE_PATH);
            $criteria->addSelectColumn(ReportTableMap::COL_INITIAL_CONFIGURATION);
            $criteria->addSelectColumn(ReportTableMap::COL_INSTALLATION_ID);
            $criteria->addSelectColumn(ReportTableMap::COL_IS_SILENT);
            $criteria->addSelectColumn(ReportTableMap::COL_LOGCAT);
            $criteria->addSelectColumn(ReportTableMap::COL_MEDIA_CODEC_LIST);
            $criteria->addSelectColumn(ReportTableMap::COL_PACKAGE_NAME);
            $criteria->addSelectColumn(ReportTableMap::COL_PHONE_MODEL);
            $criteria->addSelectColumn(ReportTableMap::COL_PRODUCT);
            $criteria->addSelectColumn(ReportTableMap::COL_RADIOLOG);
            $criteria->addSelectColumn(ReportTableMap::COL_REPORT_ID);
            $criteria->addSelectColumn(ReportTableMap::COL_SETTINGS_GLOBAL);
            $criteria->addSelectColumn(ReportTableMap::COL_SETTINGS_SECURE);
            $criteria->addSelectColumn(ReportTableMap::COL_SETTINGS_SYSTEM);
            $criteria->addSelectColumn(ReportTableMap::COL_SHARED_PREFERENCES);
            $criteria->addSelectColumn(ReportTableMap::COL_STACK_TRACE);
            $criteria->addSelectColumn(ReportTableMap::COL_STACK_TRACE_HASH);
            $criteria->addSelectColumn(ReportTableMap::COL_THREAD_DETAILS);
            $criteria->addSelectColumn(ReportTableMap::COL_TOTAL_MEM_SIZE);
            $criteria->addSelectColumn(ReportTableMap::COL_USER_APP_START_DATE);
            $criteria->addSelectColumn(ReportTableMap::COL_USER_COMMENT);
            $criteria->addSelectColumn(ReportTableMap::COL_USER_CRASH_DATE);
            $criteria->addSelectColumn(ReportTableMap::COL_USER_EMAIL);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.android_version');
            $criteria->addSelectColumn($alias . '.application_log');
            $criteria->addSelectColumn($alias . '.app_version_code');
            $criteria->addSelectColumn($alias . '.app_version_name');
            $criteria->addSelectColumn($alias . '.available_mem_size');
            $criteria->addSelectColumn($alias . '.brand');
            $criteria->addSelectColumn($alias . '.build');
            $criteria->addSelectColumn($alias . '.build_config');
            $criteria->addSelectColumn($alias . '.crash_configuration');
            $criteria->addSelectColumn($alias . '.custom_data');
            $criteria->addSelectColumn($alias . '.date_received');
            $criteria->addSelectColumn($alias . '.device_features');
            $criteria->addSelectColumn($alias . '.device_id');
            $criteria->addSelectColumn($alias . '.display');
            $criteria->addSelectColumn($alias . '.dropbox');
            $criteria->addSelectColumn($alias . '.dumpsys_meminfo');
            $criteria->addSelectColumn($alias . '.environment');
            $criteria->addSelectColumn($alias . '.eventslog');
            $criteria->addSelectColumn($alias . '.file_path');
            $criteria->addSelectColumn($alias . '.initial_configuration');
            $criteria->addSelectColumn($alias . '.installation_id');
            $criteria->addSelectColumn($alias . '.is_silent');
            $criteria->addSelectColumn($alias . '.logcat');
            $criteria->addSelectColumn($alias . '.media_codec_list');
            $criteria->addSelectColumn($alias . '.package_name');
            $criteria->addSelectColumn($alias . '.phone_model');
            $criteria->addSelectColumn($alias . '.product');
            $criteria->addSelectColumn($alias . '.radiolog');
            $criteria->addSelectColumn($alias . '.report_id');
            $criteria->addSelectColumn($alias . '.settings_global');
            $criteria->addSelectColumn($alias . '.settings_secure');
            $criteria->addSelectColumn($alias . '.settings_system');
            $criteria->addSelectColumn($alias . '.shared_preferences');
            $criteria->addSelectColumn($alias . '.stack_trace');
            $criteria->addSelectColumn($alias . '.stack_trace_hash');
            $criteria->addSelectColumn($alias . '.thread_details');
            $criteria->addSelectColumn($alias . '.total_mem_size');
            $criteria->addSelectColumn($alias . '.user_app_start_date');
            $criteria->addSelectColumn($alias . '.user_comment');
            $criteria->addSelectColumn($alias . '.user_crash_date');
            $criteria->addSelectColumn($alias . '.user_email');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ReportTableMap::DATABASE_NAME)->getTable(ReportTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ReportTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ReportTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ReportTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Report or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Report object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Report) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReportTableMap::DATABASE_NAME);
            $criteria->add(ReportTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ReportQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReportTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReportTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the report table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReportQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Report or Criteria object.
     *
     * @param mixed               $criteria Criteria or Report object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Report object
        }

        if ($criteria->containsKey(ReportTableMap::COL_ID) && $criteria->keyContainsValue(ReportTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReportTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ReportQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReportTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ReportTableMap::buildTableMap();
