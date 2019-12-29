<?php

function show_report($report_pk) {
	$report = ReportQuery::create()->findPK($report_pk);
	Flight::render('show_reports', array('report' => $report));
}