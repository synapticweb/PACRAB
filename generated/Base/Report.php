<?php

namespace Base;

use \ReportQuery as ChildReportQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ReportTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'report' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Report implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ReportTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the installation_id field.
     *
     * @var        string
     */
    protected $installation_id;

    /**
     * The value for the report_id field.
     *
     * @var        string
     */
    protected $report_id;

    /**
     * The value for the app_version_code field.
     *
     * @var        string
     */
    protected $app_version_code;

    /**
     * The value for the app_version_name field.
     *
     * @var        string
     */
    protected $app_version_name;

    /**
     * The value for the package_name field.
     *
     * @var        string
     */
    protected $package_name;

    /**
     * The value for the file_path field.
     *
     * @var        string
     */
    protected $file_path;

    /**
     * The value for the phone_model field.
     *
     * @var        string
     */
    protected $phone_model;

    /**
     * The value for the brand field.
     *
     * @var        string
     */
    protected $brand;

    /**
     * The value for the product field.
     *
     * @var        string
     */
    protected $product;

    /**
     * The value for the android_version field.
     *
     * @var        string
     */
    protected $android_version;

    /**
     * The value for the build field.
     *
     * @var        string
     */
    protected $build;

    /**
     * The value for the total_mem_size field.
     *
     * @var        string
     */
    protected $total_mem_size;

    /**
     * The value for the available_mem_size field.
     *
     * @var        string
     */
    protected $available_mem_size;

    /**
     * The value for the build_config field.
     *
     * @var        string
     */
    protected $build_config;

    /**
     * The value for the custom_data field.
     *
     * @var        string
     */
    protected $custom_data;

    /**
     * The value for the is_silent field.
     *
     * @var        string
     */
    protected $is_silent;

    /**
     * The value for the stack_trace field.
     *
     * @var        string
     */
    protected $stack_trace;

    /**
     * The value for the initial_configuration field.
     *
     * @var        string
     */
    protected $initial_configuration;

    /**
     * The value for the crash_configuration field.
     *
     * @var        string
     */
    protected $crash_configuration;

    /**
     * The value for the display field.
     *
     * @var        string
     */
    protected $display;

    /**
     * The value for the user_comment field.
     *
     * @var        string
     */
    protected $user_comment;

    /**
     * The value for the user_email field.
     *
     * @var        string
     */
    protected $user_email;

    /**
     * The value for the user_app_start_date field.
     *
     * @var        string
     */
    protected $user_app_start_date;

    /**
     * The value for the user_crash_date field.
     *
     * @var        string
     */
    protected $user_crash_date;

    /**
     * The value for the dumpsys_meminfo field.
     *
     * @var        string
     */
    protected $dumpsys_meminfo;

    /**
     * The value for the logcat field.
     *
     * @var        string
     */
    protected $logcat;

    /**
     * The value for the device_features field.
     *
     * @var        string
     */
    protected $device_features;

    /**
     * The value for the environment field.
     *
     * @var        string
     */
    protected $environment;

    /**
     * The value for the shared_preferences field.
     *
     * @var        string
     */
    protected $shared_preferences;

    /**
     * The value for the date_received field.
     *
     * @var        DateTime
     */
    protected $date_received;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Report object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Report</code> instance.  If
     * <code>obj</code> is an instance of <code>Report</code>, delegates to
     * <code>equals(Report)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Report The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [installation_id] column value.
     *
     * @return string
     */
    public function getInstallationId()
    {
        return $this->installation_id;
    }

    /**
     * Get the [report_id] column value.
     *
     * @return string
     */
    public function getReportId()
    {
        return $this->report_id;
    }

    /**
     * Get the [app_version_code] column value.
     *
     * @return string
     */
    public function getAppVersionCode()
    {
        return $this->app_version_code;
    }

    /**
     * Get the [app_version_name] column value.
     *
     * @return string
     */
    public function getAppVersionName()
    {
        return $this->app_version_name;
    }

    /**
     * Get the [package_name] column value.
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->package_name;
    }

    /**
     * Get the [file_path] column value.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->file_path;
    }

    /**
     * Get the [phone_model] column value.
     *
     * @return string
     */
    public function getPhoneModel()
    {
        return $this->phone_model;
    }

    /**
     * Get the [brand] column value.
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get the [product] column value.
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Get the [android_version] column value.
     *
     * @return string
     */
    public function getAndroidVersion()
    {
        return $this->android_version;
    }

    /**
     * Get the [build] column value.
     *
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * Get the [total_mem_size] column value.
     *
     * @return string
     */
    public function getTotalMemSize()
    {
        return $this->total_mem_size;
    }

    /**
     * Get the [available_mem_size] column value.
     *
     * @return string
     */
    public function getAvailableMemSize()
    {
        return $this->available_mem_size;
    }

    /**
     * Get the [build_config] column value.
     *
     * @return string
     */
    public function getBuildConfig()
    {
        return $this->build_config;
    }

    /**
     * Get the [custom_data] column value.
     *
     * @return string
     */
    public function getCustomData()
    {
        return $this->custom_data;
    }

    /**
     * Get the [is_silent] column value.
     *
     * @return string
     */
    public function getIsSilent()
    {
        return $this->is_silent;
    }

    /**
     * Get the [stack_trace] column value.
     *
     * @return string
     */
    public function getStackTrace()
    {
        return $this->stack_trace;
    }

    /**
     * Get the [initial_configuration] column value.
     *
     * @return string
     */
    public function getInitialConfiguration()
    {
        return $this->initial_configuration;
    }

    /**
     * Get the [crash_configuration] column value.
     *
     * @return string
     */
    public function getCrashConfiguration()
    {
        return $this->crash_configuration;
    }

    /**
     * Get the [display] column value.
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Get the [user_comment] column value.
     *
     * @return string
     */
    public function getUserComment()
    {
        return $this->user_comment;
    }

    /**
     * Get the [user_email] column value.
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Get the [user_app_start_date] column value.
     *
     * @return string
     */
    public function getUserAppStartDate()
    {
        return $this->user_app_start_date;
    }

    /**
     * Get the [user_crash_date] column value.
     *
     * @return string
     */
    public function getUserCrashDate()
    {
        return $this->user_crash_date;
    }

    /**
     * Get the [dumpsys_meminfo] column value.
     *
     * @return string
     */
    public function getDumpsysMeminfo()
    {
        return $this->dumpsys_meminfo;
    }

    /**
     * Get the [logcat] column value.
     *
     * @return string
     */
    public function getLogcat()
    {
        return $this->logcat;
    }

    /**
     * Get the [device_features] column value.
     *
     * @return string
     */
    public function getDeviceFeatures()
    {
        return $this->device_features;
    }

    /**
     * Get the [environment] column value.
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Get the [shared_preferences] column value.
     *
     * @return string
     */
    public function getSharedPreferences()
    {
        return $this->shared_preferences;
    }

    /**
     * Get the [optionally formatted] temporal [date_received] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateReceived($format = NULL)
    {
        if ($format === null) {
            return $this->date_received;
        } else {
            return $this->date_received instanceof \DateTimeInterface ? $this->date_received->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ReportTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [installation_id] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setInstallationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->installation_id !== $v) {
            $this->installation_id = $v;
            $this->modifiedColumns[ReportTableMap::COL_INSTALLATION_ID] = true;
        }

        return $this;
    } // setInstallationId()

    /**
     * Set the value of [report_id] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setReportId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->report_id !== $v) {
            $this->report_id = $v;
            $this->modifiedColumns[ReportTableMap::COL_REPORT_ID] = true;
        }

        return $this;
    } // setReportId()

    /**
     * Set the value of [app_version_code] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setAppVersionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->app_version_code !== $v) {
            $this->app_version_code = $v;
            $this->modifiedColumns[ReportTableMap::COL_APP_VERSION_CODE] = true;
        }

        return $this;
    } // setAppVersionCode()

    /**
     * Set the value of [app_version_name] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setAppVersionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->app_version_name !== $v) {
            $this->app_version_name = $v;
            $this->modifiedColumns[ReportTableMap::COL_APP_VERSION_NAME] = true;
        }

        return $this;
    } // setAppVersionName()

    /**
     * Set the value of [package_name] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setPackageName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->package_name !== $v) {
            $this->package_name = $v;
            $this->modifiedColumns[ReportTableMap::COL_PACKAGE_NAME] = true;
        }

        return $this;
    } // setPackageName()

    /**
     * Set the value of [file_path] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setFilePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_path !== $v) {
            $this->file_path = $v;
            $this->modifiedColumns[ReportTableMap::COL_FILE_PATH] = true;
        }

        return $this;
    } // setFilePath()

    /**
     * Set the value of [phone_model] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setPhoneModel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_model !== $v) {
            $this->phone_model = $v;
            $this->modifiedColumns[ReportTableMap::COL_PHONE_MODEL] = true;
        }

        return $this;
    } // setPhoneModel()

    /**
     * Set the value of [brand] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand !== $v) {
            $this->brand = $v;
            $this->modifiedColumns[ReportTableMap::COL_BRAND] = true;
        }

        return $this;
    } // setBrand()

    /**
     * Set the value of [product] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setProduct($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product !== $v) {
            $this->product = $v;
            $this->modifiedColumns[ReportTableMap::COL_PRODUCT] = true;
        }

        return $this;
    } // setProduct()

    /**
     * Set the value of [android_version] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setAndroidVersion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->android_version !== $v) {
            $this->android_version = $v;
            $this->modifiedColumns[ReportTableMap::COL_ANDROID_VERSION] = true;
        }

        return $this;
    } // setAndroidVersion()

    /**
     * Set the value of [build] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setBuild($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->build !== $v) {
            $this->build = $v;
            $this->modifiedColumns[ReportTableMap::COL_BUILD] = true;
        }

        return $this;
    } // setBuild()

    /**
     * Set the value of [total_mem_size] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setTotalMemSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_mem_size !== $v) {
            $this->total_mem_size = $v;
            $this->modifiedColumns[ReportTableMap::COL_TOTAL_MEM_SIZE] = true;
        }

        return $this;
    } // setTotalMemSize()

    /**
     * Set the value of [available_mem_size] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setAvailableMemSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->available_mem_size !== $v) {
            $this->available_mem_size = $v;
            $this->modifiedColumns[ReportTableMap::COL_AVAILABLE_MEM_SIZE] = true;
        }

        return $this;
    } // setAvailableMemSize()

    /**
     * Set the value of [build_config] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setBuildConfig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->build_config !== $v) {
            $this->build_config = $v;
            $this->modifiedColumns[ReportTableMap::COL_BUILD_CONFIG] = true;
        }

        return $this;
    } // setBuildConfig()

    /**
     * Set the value of [custom_data] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setCustomData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->custom_data !== $v) {
            $this->custom_data = $v;
            $this->modifiedColumns[ReportTableMap::COL_CUSTOM_DATA] = true;
        }

        return $this;
    } // setCustomData()

    /**
     * Set the value of [is_silent] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setIsSilent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->is_silent !== $v) {
            $this->is_silent = $v;
            $this->modifiedColumns[ReportTableMap::COL_IS_SILENT] = true;
        }

        return $this;
    } // setIsSilent()

    /**
     * Set the value of [stack_trace] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setStackTrace($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stack_trace !== $v) {
            $this->stack_trace = $v;
            $this->modifiedColumns[ReportTableMap::COL_STACK_TRACE] = true;
        }

        return $this;
    } // setStackTrace()

    /**
     * Set the value of [initial_configuration] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setInitialConfiguration($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->initial_configuration !== $v) {
            $this->initial_configuration = $v;
            $this->modifiedColumns[ReportTableMap::COL_INITIAL_CONFIGURATION] = true;
        }

        return $this;
    } // setInitialConfiguration()

    /**
     * Set the value of [crash_configuration] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setCrashConfiguration($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->crash_configuration !== $v) {
            $this->crash_configuration = $v;
            $this->modifiedColumns[ReportTableMap::COL_CRASH_CONFIGURATION] = true;
        }

        return $this;
    } // setCrashConfiguration()

    /**
     * Set the value of [display] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setDisplay($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->display !== $v) {
            $this->display = $v;
            $this->modifiedColumns[ReportTableMap::COL_DISPLAY] = true;
        }

        return $this;
    } // setDisplay()

    /**
     * Set the value of [user_comment] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setUserComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_comment !== $v) {
            $this->user_comment = $v;
            $this->modifiedColumns[ReportTableMap::COL_USER_COMMENT] = true;
        }

        return $this;
    } // setUserComment()

    /**
     * Set the value of [user_email] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setUserEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_email !== $v) {
            $this->user_email = $v;
            $this->modifiedColumns[ReportTableMap::COL_USER_EMAIL] = true;
        }

        return $this;
    } // setUserEmail()

    /**
     * Set the value of [user_app_start_date] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setUserAppStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_app_start_date !== $v) {
            $this->user_app_start_date = $v;
            $this->modifiedColumns[ReportTableMap::COL_USER_APP_START_DATE] = true;
        }

        return $this;
    } // setUserAppStartDate()

    /**
     * Set the value of [user_crash_date] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setUserCrashDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_crash_date !== $v) {
            $this->user_crash_date = $v;
            $this->modifiedColumns[ReportTableMap::COL_USER_CRASH_DATE] = true;
        }

        return $this;
    } // setUserCrashDate()

    /**
     * Set the value of [dumpsys_meminfo] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setDumpsysMeminfo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dumpsys_meminfo !== $v) {
            $this->dumpsys_meminfo = $v;
            $this->modifiedColumns[ReportTableMap::COL_DUMPSYS_MEMINFO] = true;
        }

        return $this;
    } // setDumpsysMeminfo()

    /**
     * Set the value of [logcat] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setLogcat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->logcat !== $v) {
            $this->logcat = $v;
            $this->modifiedColumns[ReportTableMap::COL_LOGCAT] = true;
        }

        return $this;
    } // setLogcat()

    /**
     * Set the value of [device_features] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setDeviceFeatures($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->device_features !== $v) {
            $this->device_features = $v;
            $this->modifiedColumns[ReportTableMap::COL_DEVICE_FEATURES] = true;
        }

        return $this;
    } // setDeviceFeatures()

    /**
     * Set the value of [environment] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setEnvironment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->environment !== $v) {
            $this->environment = $v;
            $this->modifiedColumns[ReportTableMap::COL_ENVIRONMENT] = true;
        }

        return $this;
    } // setEnvironment()

    /**
     * Set the value of [shared_preferences] column.
     *
     * @param string $v new value
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setSharedPreferences($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shared_preferences !== $v) {
            $this->shared_preferences = $v;
            $this->modifiedColumns[ReportTableMap::COL_SHARED_PREFERENCES] = true;
        }

        return $this;
    } // setSharedPreferences()

    /**
     * Sets the value of [date_received] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Report The current object (for fluent API support)
     */
    public function setDateReceived($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_received !== null || $dt !== null) {
            if ($this->date_received === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date_received->format("Y-m-d H:i:s.u")) {
                $this->date_received = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ReportTableMap::COL_DATE_RECEIVED] = true;
            }
        } // if either are not null

        return $this;
    } // setDateReceived()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ReportTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ReportTableMap::translateFieldName('InstallationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->installation_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ReportTableMap::translateFieldName('ReportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->report_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ReportTableMap::translateFieldName('AppVersionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->app_version_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ReportTableMap::translateFieldName('AppVersionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->app_version_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ReportTableMap::translateFieldName('PackageName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->package_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ReportTableMap::translateFieldName('FilePath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ReportTableMap::translateFieldName('PhoneModel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_model = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ReportTableMap::translateFieldName('Brand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ReportTableMap::translateFieldName('Product', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ReportTableMap::translateFieldName('AndroidVersion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->android_version = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ReportTableMap::translateFieldName('Build', TableMap::TYPE_PHPNAME, $indexType)];
            $this->build = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ReportTableMap::translateFieldName('TotalMemSize', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_mem_size = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ReportTableMap::translateFieldName('AvailableMemSize', TableMap::TYPE_PHPNAME, $indexType)];
            $this->available_mem_size = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ReportTableMap::translateFieldName('BuildConfig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->build_config = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ReportTableMap::translateFieldName('CustomData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->custom_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ReportTableMap::translateFieldName('IsSilent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_silent = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ReportTableMap::translateFieldName('StackTrace', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stack_trace = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ReportTableMap::translateFieldName('InitialConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->initial_configuration = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ReportTableMap::translateFieldName('CrashConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->crash_configuration = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ReportTableMap::translateFieldName('Display', TableMap::TYPE_PHPNAME, $indexType)];
            $this->display = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ReportTableMap::translateFieldName('UserComment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ReportTableMap::translateFieldName('UserEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ReportTableMap::translateFieldName('UserAppStartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_app_start_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ReportTableMap::translateFieldName('UserCrashDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_crash_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ReportTableMap::translateFieldName('DumpsysMeminfo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dumpsys_meminfo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ReportTableMap::translateFieldName('Logcat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logcat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ReportTableMap::translateFieldName('DeviceFeatures', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_features = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ReportTableMap::translateFieldName('Environment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->environment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ReportTableMap::translateFieldName('SharedPreferences', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shared_preferences = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ReportTableMap::translateFieldName('DateReceived', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date_received = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 31; // 31 = ReportTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Report'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReportTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildReportQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Report::setDeleted()
     * @see Report::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildReportQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReportTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ReportTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ReportTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ReportTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ReportTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ReportTableMap::COL_INSTALLATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'installation_id';
        }
        if ($this->isColumnModified(ReportTableMap::COL_REPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'report_id';
        }
        if ($this->isColumnModified(ReportTableMap::COL_APP_VERSION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'app_version_code';
        }
        if ($this->isColumnModified(ReportTableMap::COL_APP_VERSION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'app_version_name';
        }
        if ($this->isColumnModified(ReportTableMap::COL_PACKAGE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'package_name';
        }
        if ($this->isColumnModified(ReportTableMap::COL_FILE_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'file_path';
        }
        if ($this->isColumnModified(ReportTableMap::COL_PHONE_MODEL)) {
            $modifiedColumns[':p' . $index++]  = 'phone_model';
        }
        if ($this->isColumnModified(ReportTableMap::COL_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'brand';
        }
        if ($this->isColumnModified(ReportTableMap::COL_PRODUCT)) {
            $modifiedColumns[':p' . $index++]  = 'product';
        }
        if ($this->isColumnModified(ReportTableMap::COL_ANDROID_VERSION)) {
            $modifiedColumns[':p' . $index++]  = 'android_version';
        }
        if ($this->isColumnModified(ReportTableMap::COL_BUILD)) {
            $modifiedColumns[':p' . $index++]  = 'build';
        }
        if ($this->isColumnModified(ReportTableMap::COL_TOTAL_MEM_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'total_mem_size';
        }
        if ($this->isColumnModified(ReportTableMap::COL_AVAILABLE_MEM_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'available_mem_size';
        }
        if ($this->isColumnModified(ReportTableMap::COL_BUILD_CONFIG)) {
            $modifiedColumns[':p' . $index++]  = 'build_config';
        }
        if ($this->isColumnModified(ReportTableMap::COL_CUSTOM_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'custom_data';
        }
        if ($this->isColumnModified(ReportTableMap::COL_IS_SILENT)) {
            $modifiedColumns[':p' . $index++]  = 'is_silent';
        }
        if ($this->isColumnModified(ReportTableMap::COL_STACK_TRACE)) {
            $modifiedColumns[':p' . $index++]  = 'stack_trace';
        }
        if ($this->isColumnModified(ReportTableMap::COL_INITIAL_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'initial_configuration';
        }
        if ($this->isColumnModified(ReportTableMap::COL_CRASH_CONFIGURATION)) {
            $modifiedColumns[':p' . $index++]  = 'crash_configuration';
        }
        if ($this->isColumnModified(ReportTableMap::COL_DISPLAY)) {
            $modifiedColumns[':p' . $index++]  = 'display';
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'user_comment';
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'user_email';
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_APP_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'user_app_start_date';
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_CRASH_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'user_crash_date';
        }
        if ($this->isColumnModified(ReportTableMap::COL_DUMPSYS_MEMINFO)) {
            $modifiedColumns[':p' . $index++]  = 'dumpsys_meminfo';
        }
        if ($this->isColumnModified(ReportTableMap::COL_LOGCAT)) {
            $modifiedColumns[':p' . $index++]  = 'logcat';
        }
        if ($this->isColumnModified(ReportTableMap::COL_DEVICE_FEATURES)) {
            $modifiedColumns[':p' . $index++]  = 'device_features';
        }
        if ($this->isColumnModified(ReportTableMap::COL_ENVIRONMENT)) {
            $modifiedColumns[':p' . $index++]  = 'environment';
        }
        if ($this->isColumnModified(ReportTableMap::COL_SHARED_PREFERENCES)) {
            $modifiedColumns[':p' . $index++]  = 'shared_preferences';
        }
        if ($this->isColumnModified(ReportTableMap::COL_DATE_RECEIVED)) {
            $modifiedColumns[':p' . $index++]  = 'date_received';
        }

        $sql = sprintf(
            'INSERT INTO report (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'installation_id':
                        $stmt->bindValue($identifier, $this->installation_id, PDO::PARAM_STR);
                        break;
                    case 'report_id':
                        $stmt->bindValue($identifier, $this->report_id, PDO::PARAM_STR);
                        break;
                    case 'app_version_code':
                        $stmt->bindValue($identifier, $this->app_version_code, PDO::PARAM_STR);
                        break;
                    case 'app_version_name':
                        $stmt->bindValue($identifier, $this->app_version_name, PDO::PARAM_STR);
                        break;
                    case 'package_name':
                        $stmt->bindValue($identifier, $this->package_name, PDO::PARAM_STR);
                        break;
                    case 'file_path':
                        $stmt->bindValue($identifier, $this->file_path, PDO::PARAM_STR);
                        break;
                    case 'phone_model':
                        $stmt->bindValue($identifier, $this->phone_model, PDO::PARAM_STR);
                        break;
                    case 'brand':
                        $stmt->bindValue($identifier, $this->brand, PDO::PARAM_STR);
                        break;
                    case 'product':
                        $stmt->bindValue($identifier, $this->product, PDO::PARAM_STR);
                        break;
                    case 'android_version':
                        $stmt->bindValue($identifier, $this->android_version, PDO::PARAM_STR);
                        break;
                    case 'build':
                        $stmt->bindValue($identifier, $this->build, PDO::PARAM_STR);
                        break;
                    case 'total_mem_size':
                        $stmt->bindValue($identifier, $this->total_mem_size, PDO::PARAM_STR);
                        break;
                    case 'available_mem_size':
                        $stmt->bindValue($identifier, $this->available_mem_size, PDO::PARAM_STR);
                        break;
                    case 'build_config':
                        $stmt->bindValue($identifier, $this->build_config, PDO::PARAM_STR);
                        break;
                    case 'custom_data':
                        $stmt->bindValue($identifier, $this->custom_data, PDO::PARAM_STR);
                        break;
                    case 'is_silent':
                        $stmt->bindValue($identifier, $this->is_silent, PDO::PARAM_STR);
                        break;
                    case 'stack_trace':
                        $stmt->bindValue($identifier, $this->stack_trace, PDO::PARAM_STR);
                        break;
                    case 'initial_configuration':
                        $stmt->bindValue($identifier, $this->initial_configuration, PDO::PARAM_STR);
                        break;
                    case 'crash_configuration':
                        $stmt->bindValue($identifier, $this->crash_configuration, PDO::PARAM_STR);
                        break;
                    case 'display':
                        $stmt->bindValue($identifier, $this->display, PDO::PARAM_STR);
                        break;
                    case 'user_comment':
                        $stmt->bindValue($identifier, $this->user_comment, PDO::PARAM_STR);
                        break;
                    case 'user_email':
                        $stmt->bindValue($identifier, $this->user_email, PDO::PARAM_STR);
                        break;
                    case 'user_app_start_date':
                        $stmt->bindValue($identifier, $this->user_app_start_date, PDO::PARAM_STR);
                        break;
                    case 'user_crash_date':
                        $stmt->bindValue($identifier, $this->user_crash_date, PDO::PARAM_STR);
                        break;
                    case 'dumpsys_meminfo':
                        $stmt->bindValue($identifier, $this->dumpsys_meminfo, PDO::PARAM_STR);
                        break;
                    case 'logcat':
                        $stmt->bindValue($identifier, $this->logcat, PDO::PARAM_STR);
                        break;
                    case 'device_features':
                        $stmt->bindValue($identifier, $this->device_features, PDO::PARAM_STR);
                        break;
                    case 'environment':
                        $stmt->bindValue($identifier, $this->environment, PDO::PARAM_STR);
                        break;
                    case 'shared_preferences':
                        $stmt->bindValue($identifier, $this->shared_preferences, PDO::PARAM_STR);
                        break;
                    case 'date_received':
                        $stmt->bindValue($identifier, $this->date_received ? $this->date_received->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ReportTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getInstallationId();
                break;
            case 2:
                return $this->getReportId();
                break;
            case 3:
                return $this->getAppVersionCode();
                break;
            case 4:
                return $this->getAppVersionName();
                break;
            case 5:
                return $this->getPackageName();
                break;
            case 6:
                return $this->getFilePath();
                break;
            case 7:
                return $this->getPhoneModel();
                break;
            case 8:
                return $this->getBrand();
                break;
            case 9:
                return $this->getProduct();
                break;
            case 10:
                return $this->getAndroidVersion();
                break;
            case 11:
                return $this->getBuild();
                break;
            case 12:
                return $this->getTotalMemSize();
                break;
            case 13:
                return $this->getAvailableMemSize();
                break;
            case 14:
                return $this->getBuildConfig();
                break;
            case 15:
                return $this->getCustomData();
                break;
            case 16:
                return $this->getIsSilent();
                break;
            case 17:
                return $this->getStackTrace();
                break;
            case 18:
                return $this->getInitialConfiguration();
                break;
            case 19:
                return $this->getCrashConfiguration();
                break;
            case 20:
                return $this->getDisplay();
                break;
            case 21:
                return $this->getUserComment();
                break;
            case 22:
                return $this->getUserEmail();
                break;
            case 23:
                return $this->getUserAppStartDate();
                break;
            case 24:
                return $this->getUserCrashDate();
                break;
            case 25:
                return $this->getDumpsysMeminfo();
                break;
            case 26:
                return $this->getLogcat();
                break;
            case 27:
                return $this->getDeviceFeatures();
                break;
            case 28:
                return $this->getEnvironment();
                break;
            case 29:
                return $this->getSharedPreferences();
                break;
            case 30:
                return $this->getDateReceived();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Report'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Report'][$this->hashCode()] = true;
        $keys = ReportTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getInstallationId(),
            $keys[2] => $this->getReportId(),
            $keys[3] => $this->getAppVersionCode(),
            $keys[4] => $this->getAppVersionName(),
            $keys[5] => $this->getPackageName(),
            $keys[6] => $this->getFilePath(),
            $keys[7] => $this->getPhoneModel(),
            $keys[8] => $this->getBrand(),
            $keys[9] => $this->getProduct(),
            $keys[10] => $this->getAndroidVersion(),
            $keys[11] => $this->getBuild(),
            $keys[12] => $this->getTotalMemSize(),
            $keys[13] => $this->getAvailableMemSize(),
            $keys[14] => $this->getBuildConfig(),
            $keys[15] => $this->getCustomData(),
            $keys[16] => $this->getIsSilent(),
            $keys[17] => $this->getStackTrace(),
            $keys[18] => $this->getInitialConfiguration(),
            $keys[19] => $this->getCrashConfiguration(),
            $keys[20] => $this->getDisplay(),
            $keys[21] => $this->getUserComment(),
            $keys[22] => $this->getUserEmail(),
            $keys[23] => $this->getUserAppStartDate(),
            $keys[24] => $this->getUserCrashDate(),
            $keys[25] => $this->getDumpsysMeminfo(),
            $keys[26] => $this->getLogcat(),
            $keys[27] => $this->getDeviceFeatures(),
            $keys[28] => $this->getEnvironment(),
            $keys[29] => $this->getSharedPreferences(),
            $keys[30] => $this->getDateReceived(),
        );
        if ($result[$keys[30]] instanceof \DateTimeInterface) {
            $result[$keys[30]] = $result[$keys[30]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Report
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ReportTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Report
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setInstallationId($value);
                break;
            case 2:
                $this->setReportId($value);
                break;
            case 3:
                $this->setAppVersionCode($value);
                break;
            case 4:
                $this->setAppVersionName($value);
                break;
            case 5:
                $this->setPackageName($value);
                break;
            case 6:
                $this->setFilePath($value);
                break;
            case 7:
                $this->setPhoneModel($value);
                break;
            case 8:
                $this->setBrand($value);
                break;
            case 9:
                $this->setProduct($value);
                break;
            case 10:
                $this->setAndroidVersion($value);
                break;
            case 11:
                $this->setBuild($value);
                break;
            case 12:
                $this->setTotalMemSize($value);
                break;
            case 13:
                $this->setAvailableMemSize($value);
                break;
            case 14:
                $this->setBuildConfig($value);
                break;
            case 15:
                $this->setCustomData($value);
                break;
            case 16:
                $this->setIsSilent($value);
                break;
            case 17:
                $this->setStackTrace($value);
                break;
            case 18:
                $this->setInitialConfiguration($value);
                break;
            case 19:
                $this->setCrashConfiguration($value);
                break;
            case 20:
                $this->setDisplay($value);
                break;
            case 21:
                $this->setUserComment($value);
                break;
            case 22:
                $this->setUserEmail($value);
                break;
            case 23:
                $this->setUserAppStartDate($value);
                break;
            case 24:
                $this->setUserCrashDate($value);
                break;
            case 25:
                $this->setDumpsysMeminfo($value);
                break;
            case 26:
                $this->setLogcat($value);
                break;
            case 27:
                $this->setDeviceFeatures($value);
                break;
            case 28:
                $this->setEnvironment($value);
                break;
            case 29:
                $this->setSharedPreferences($value);
                break;
            case 30:
                $this->setDateReceived($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ReportTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setInstallationId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setReportId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAppVersionCode($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAppVersionName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPackageName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFilePath($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPhoneModel($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setBrand($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setProduct($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAndroidVersion($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setBuild($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTotalMemSize($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setAvailableMemSize($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setBuildConfig($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCustomData($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIsSilent($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setStackTrace($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setInitialConfiguration($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setCrashConfiguration($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setDisplay($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setUserComment($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setUserEmail($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setUserAppStartDate($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setUserCrashDate($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setDumpsysMeminfo($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setLogcat($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setDeviceFeatures($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setEnvironment($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setSharedPreferences($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setDateReceived($arr[$keys[30]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Report The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ReportTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ReportTableMap::COL_ID)) {
            $criteria->add(ReportTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ReportTableMap::COL_INSTALLATION_ID)) {
            $criteria->add(ReportTableMap::COL_INSTALLATION_ID, $this->installation_id);
        }
        if ($this->isColumnModified(ReportTableMap::COL_REPORT_ID)) {
            $criteria->add(ReportTableMap::COL_REPORT_ID, $this->report_id);
        }
        if ($this->isColumnModified(ReportTableMap::COL_APP_VERSION_CODE)) {
            $criteria->add(ReportTableMap::COL_APP_VERSION_CODE, $this->app_version_code);
        }
        if ($this->isColumnModified(ReportTableMap::COL_APP_VERSION_NAME)) {
            $criteria->add(ReportTableMap::COL_APP_VERSION_NAME, $this->app_version_name);
        }
        if ($this->isColumnModified(ReportTableMap::COL_PACKAGE_NAME)) {
            $criteria->add(ReportTableMap::COL_PACKAGE_NAME, $this->package_name);
        }
        if ($this->isColumnModified(ReportTableMap::COL_FILE_PATH)) {
            $criteria->add(ReportTableMap::COL_FILE_PATH, $this->file_path);
        }
        if ($this->isColumnModified(ReportTableMap::COL_PHONE_MODEL)) {
            $criteria->add(ReportTableMap::COL_PHONE_MODEL, $this->phone_model);
        }
        if ($this->isColumnModified(ReportTableMap::COL_BRAND)) {
            $criteria->add(ReportTableMap::COL_BRAND, $this->brand);
        }
        if ($this->isColumnModified(ReportTableMap::COL_PRODUCT)) {
            $criteria->add(ReportTableMap::COL_PRODUCT, $this->product);
        }
        if ($this->isColumnModified(ReportTableMap::COL_ANDROID_VERSION)) {
            $criteria->add(ReportTableMap::COL_ANDROID_VERSION, $this->android_version);
        }
        if ($this->isColumnModified(ReportTableMap::COL_BUILD)) {
            $criteria->add(ReportTableMap::COL_BUILD, $this->build);
        }
        if ($this->isColumnModified(ReportTableMap::COL_TOTAL_MEM_SIZE)) {
            $criteria->add(ReportTableMap::COL_TOTAL_MEM_SIZE, $this->total_mem_size);
        }
        if ($this->isColumnModified(ReportTableMap::COL_AVAILABLE_MEM_SIZE)) {
            $criteria->add(ReportTableMap::COL_AVAILABLE_MEM_SIZE, $this->available_mem_size);
        }
        if ($this->isColumnModified(ReportTableMap::COL_BUILD_CONFIG)) {
            $criteria->add(ReportTableMap::COL_BUILD_CONFIG, $this->build_config);
        }
        if ($this->isColumnModified(ReportTableMap::COL_CUSTOM_DATA)) {
            $criteria->add(ReportTableMap::COL_CUSTOM_DATA, $this->custom_data);
        }
        if ($this->isColumnModified(ReportTableMap::COL_IS_SILENT)) {
            $criteria->add(ReportTableMap::COL_IS_SILENT, $this->is_silent);
        }
        if ($this->isColumnModified(ReportTableMap::COL_STACK_TRACE)) {
            $criteria->add(ReportTableMap::COL_STACK_TRACE, $this->stack_trace);
        }
        if ($this->isColumnModified(ReportTableMap::COL_INITIAL_CONFIGURATION)) {
            $criteria->add(ReportTableMap::COL_INITIAL_CONFIGURATION, $this->initial_configuration);
        }
        if ($this->isColumnModified(ReportTableMap::COL_CRASH_CONFIGURATION)) {
            $criteria->add(ReportTableMap::COL_CRASH_CONFIGURATION, $this->crash_configuration);
        }
        if ($this->isColumnModified(ReportTableMap::COL_DISPLAY)) {
            $criteria->add(ReportTableMap::COL_DISPLAY, $this->display);
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_COMMENT)) {
            $criteria->add(ReportTableMap::COL_USER_COMMENT, $this->user_comment);
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_EMAIL)) {
            $criteria->add(ReportTableMap::COL_USER_EMAIL, $this->user_email);
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_APP_START_DATE)) {
            $criteria->add(ReportTableMap::COL_USER_APP_START_DATE, $this->user_app_start_date);
        }
        if ($this->isColumnModified(ReportTableMap::COL_USER_CRASH_DATE)) {
            $criteria->add(ReportTableMap::COL_USER_CRASH_DATE, $this->user_crash_date);
        }
        if ($this->isColumnModified(ReportTableMap::COL_DUMPSYS_MEMINFO)) {
            $criteria->add(ReportTableMap::COL_DUMPSYS_MEMINFO, $this->dumpsys_meminfo);
        }
        if ($this->isColumnModified(ReportTableMap::COL_LOGCAT)) {
            $criteria->add(ReportTableMap::COL_LOGCAT, $this->logcat);
        }
        if ($this->isColumnModified(ReportTableMap::COL_DEVICE_FEATURES)) {
            $criteria->add(ReportTableMap::COL_DEVICE_FEATURES, $this->device_features);
        }
        if ($this->isColumnModified(ReportTableMap::COL_ENVIRONMENT)) {
            $criteria->add(ReportTableMap::COL_ENVIRONMENT, $this->environment);
        }
        if ($this->isColumnModified(ReportTableMap::COL_SHARED_PREFERENCES)) {
            $criteria->add(ReportTableMap::COL_SHARED_PREFERENCES, $this->shared_preferences);
        }
        if ($this->isColumnModified(ReportTableMap::COL_DATE_RECEIVED)) {
            $criteria->add(ReportTableMap::COL_DATE_RECEIVED, $this->date_received);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildReportQuery::create();
        $criteria->add(ReportTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Report (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setInstallationId($this->getInstallationId());
        $copyObj->setReportId($this->getReportId());
        $copyObj->setAppVersionCode($this->getAppVersionCode());
        $copyObj->setAppVersionName($this->getAppVersionName());
        $copyObj->setPackageName($this->getPackageName());
        $copyObj->setFilePath($this->getFilePath());
        $copyObj->setPhoneModel($this->getPhoneModel());
        $copyObj->setBrand($this->getBrand());
        $copyObj->setProduct($this->getProduct());
        $copyObj->setAndroidVersion($this->getAndroidVersion());
        $copyObj->setBuild($this->getBuild());
        $copyObj->setTotalMemSize($this->getTotalMemSize());
        $copyObj->setAvailableMemSize($this->getAvailableMemSize());
        $copyObj->setBuildConfig($this->getBuildConfig());
        $copyObj->setCustomData($this->getCustomData());
        $copyObj->setIsSilent($this->getIsSilent());
        $copyObj->setStackTrace($this->getStackTrace());
        $copyObj->setInitialConfiguration($this->getInitialConfiguration());
        $copyObj->setCrashConfiguration($this->getCrashConfiguration());
        $copyObj->setDisplay($this->getDisplay());
        $copyObj->setUserComment($this->getUserComment());
        $copyObj->setUserEmail($this->getUserEmail());
        $copyObj->setUserAppStartDate($this->getUserAppStartDate());
        $copyObj->setUserCrashDate($this->getUserCrashDate());
        $copyObj->setDumpsysMeminfo($this->getDumpsysMeminfo());
        $copyObj->setLogcat($this->getLogcat());
        $copyObj->setDeviceFeatures($this->getDeviceFeatures());
        $copyObj->setEnvironment($this->getEnvironment());
        $copyObj->setSharedPreferences($this->getSharedPreferences());
        $copyObj->setDateReceived($this->getDateReceived());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Report Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->installation_id = null;
        $this->report_id = null;
        $this->app_version_code = null;
        $this->app_version_name = null;
        $this->package_name = null;
        $this->file_path = null;
        $this->phone_model = null;
        $this->brand = null;
        $this->product = null;
        $this->android_version = null;
        $this->build = null;
        $this->total_mem_size = null;
        $this->available_mem_size = null;
        $this->build_config = null;
        $this->custom_data = null;
        $this->is_silent = null;
        $this->stack_trace = null;
        $this->initial_configuration = null;
        $this->crash_configuration = null;
        $this->display = null;
        $this->user_comment = null;
        $this->user_email = null;
        $this->user_app_start_date = null;
        $this->user_crash_date = null;
        $this->dumpsys_meminfo = null;
        $this->logcat = null;
        $this->device_features = null;
        $this->environment = null;
        $this->shared_preferences = null;
        $this->date_received = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ReportTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
