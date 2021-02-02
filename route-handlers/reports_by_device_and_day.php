<?php

function reports_by_device_and_day($installation_id, $string_identifier, $start_date, $end_date) {
	$reports_data = ReportQuery::create()
		->select(array('id', 'report_id', 'date_received'))
		->filterByInstallationId($installation_id)
		->filterByDateReceived(array('min' => $start_date, 'max' => $end_date))
		->orderByDateReceived()
		->find();

	$pks_ids_dates = $reports_data->getData();

	Flight::render('reports_by_device_and_day', array('installation_id' => $installation_id, 'identifier_string' => $string_identifier, 'date' => $start_date, 'pks_ids_dates' => $pks_ids_dates) );
}