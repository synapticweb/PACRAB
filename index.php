<?php

require_once 'setup.php';

Flight::route('POST /', 'insert_data');
Flight::route('GET /', 'plain_get');
Flight::route('GET /newerThan=@newerThan&olderThan=@olderThan', 'plain_get');
Flight::route('POST /setfilter', 'set_filter');
Flight::route('GET /installation_id=@installation_id&string_identifier=@string_identifier&start_date=@start_date&end_date=@end_date', 
	'reports_by_device_and_day');
Flight::route('GET /report=@report_pk', 'show_report');
Flight::route('GET /installation_id=@installation_id', 'reports_by_device');

Flight::start();