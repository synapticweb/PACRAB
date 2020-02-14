<?php

require_once 'setup.php';

Flight::route('POST /', 'insert_data');
Flight::route('GET /', 'plain_get');
Flight::route('GET /offset=@offset', 'plain_get');
Flight::route('/installation_id=@installation_id&string_identifier=@string_identifier&start_date=@start_date&end_date=@end_date', 
	'reports_by_device_and_day');
Flight::route('/report=@report_pk', 'show_report');
Flight::route('/installation_id=@installation_id', 'reports_by_device');

Flight::start();