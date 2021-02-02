
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- report
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `installation_id` VARCHAR(100) NOT NULL,
    `report_id` VARCHAR(64),
    `app_version_code` VARCHAR(10),
    `app_version_name` VARCHAR(100),
    `package_name` VARCHAR(100),
    `file_path` VARCHAR(100),
    `phone_model` VARCHAR(100),
    `brand` VARCHAR(100),
    `product` VARCHAR(100),
    `android_version` VARCHAR(10),
    `build` TEXT,
    `total_mem_size` VARCHAR(100),
    `available_mem_size` VARCHAR(100),
    `build_config` TEXT,
    `custom_data` TEXT,
    `is_silent` VARCHAR(10),
    `stack_trace` TEXT,
    `initial_configuration` TEXT,
    `crash_configuration` TEXT,
    `display` TEXT,
    `user_comment` VARCHAR(256),
    `user_email` VARCHAR(100),
    `user_app_start_date` VARCHAR(100),
    `user_crash_date` VARCHAR(100),
    `dumpsys_meminfo` TEXT,
    `logcat` TEXT,
    `device_features` TEXT,
    `environment` TEXT,
    `shared_preferences` TEXT,
    `date_received` DATETIME,
    `application_log` TEXT,
    `device_id` VARCHAR(100),
    `dropbox` TEXT,
    `eventslog` TEXT,
    `media_codec_list` TEXT,
    `radiolog` TEXT,
    `settings_global` TEXT,
    `settings_secure` TEXT,
    `settings_system` TEXT,
    `stack_trace_hash` VARCHAR(100),
    `thread_details` VARCHAR(1000),
    PRIMARY KEY (`id`),
    INDEX `installation_id` (`installation_id`),
    INDEX `date_received` (`date_received`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
