
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
    `android_version` VARCHAR(10),
    `application_log` TEXT,
    `app_version_code` VARCHAR(10),
    `app_version_name` VARCHAR(100),
    `available_mem_size` VARCHAR(100),
    `brand` VARCHAR(100),
    `build` TEXT,
    `build_config` TEXT,
    `crash_configuration` TEXT,
    `custom_data` TEXT,
    `date_received` DATETIME,
    `device_features` TEXT,
    `device_id` VARCHAR(100),
    `display` TEXT,
    `dropbox` TEXT,
    `dumpsys_meminfo` TEXT,
    `environment` TEXT,
    `eventslog` TEXT,
    `file_path` VARCHAR(100),
    `initial_configuration` TEXT,
    `installation_id` VARCHAR(100) NOT NULL,
    `is_silent` VARCHAR(10),
    `logcat` TEXT,
    `media_codec_list` TEXT,
    `package_name` VARCHAR(100),
    `phone_model` VARCHAR(100),
    `product` VARCHAR(100),
    `radiolog` TEXT,
    `report_id` VARCHAR(64),
    `settings_global` TEXT,
    `settings_secure` TEXT,
    `settings_system` TEXT,
    `shared_preferences` TEXT,
    `stack_trace` TEXT,
    `stack_trace_hash` VARCHAR(100),
    `thread_details` VARCHAR(1000),
    `total_mem_size` VARCHAR(100),
    `user_app_start_date` VARCHAR(100),
    `user_comment` VARCHAR(256),
    `user_crash_date` VARCHAR(100),
    `user_email` VARCHAR(100),
    PRIMARY KEY (`id`),
    INDEX `installation_id` (`installation_id`),
    INDEX `date_received` (`date_received`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
