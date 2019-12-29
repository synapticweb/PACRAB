<?php

class Day {
	private $start_date;

	private $end_date;

	private $devices_info;

	public function setStartDate($start_date) {
		$this->start_date = $start_date;
	}

	public function getStartDate() {
		return $this->start_date;
	}

	public function setEndDate($end_date) {
		$this->end_date = $end_date;
	}

	public function getEndDate() {
		return $this->end_date;
	}

	public function setDevicesInfo($devices_info) {
		$this->devices_info = $devices_info;
	}

	public function getDevicesInfo() {
		return $this->devices_info;
	}	
}

class DeviceInfo {
	private $installation_id;

	private $identifier_string;

	private $num_reports;

	public function setInstallationId($installation_id) {
		$this->installation_id = $installation_id;
	}

	public function getInstallationId() {
		return $this->installation_id;
	}

	public function setIdentifierString($identifier_string) {
		$this->identifier_string = $identifier_string;
	}

	public function getIdentifierString() {
		return $this->identifier_string;
	}

	public function setNumReports($num_reports) {
		$this->num_reports = $num_reports;
	}

	public function getNumReports() {
		return $this->num_reports;
	}
}

function plain_get() {
	$dates = ReportQuery::create()->select('date_received')->orderByDateReceived()->find()->getData();
	$days = array();

	//The next code attempts to create day intervals on the basis of the receiving dates of the reports. These dates are stored in the db in the field date_received. The intervals are returned in the array days[][] as arrays with 2 elements: the start date and the end date of the interval.
	for($i = 0; $i < count($dates); ++$i) {
		$start_of_day = DateTime::createFromFormat('Y-m-d H:i:s', substr($dates[$i], 0, 10) . '00:00:00');
		$interval = new DateInterval('PT1S'); //1 second interval; purely formal.

		while($interval->d == 0 && $i < count($dates) - 1) {
			++$i;	
			$date_next = DateTime::createFromFormat('Y-m-d H:i:s', $dates[$i]);
			$interval = $start_of_day->diff($date_next);	
		}

		$end_of_day = new DateTime($start_of_day->format('Y-m-d H:i:s'));
		$end_of_day->add(new DateInterval('PT86399S'));
		$day = new Day();
		$day->setStartDate($start_of_day->format('Y-m-d H:i:s'));
		$day->setEndDate($end_of_day->format('Y-m-d H:i:s'));
		$days[] = $day;
	}

	$days = array_reverse($days);

	//next, we figure what devices crashed in every day interval we got in the preceding step. The found devices are stored in a third element of ...
	for ($i = 0; $i < count($days); ++$i) {
		$devices_details = ReportQuery::create()
			->select(array('installation_id', 'phone_model', 'brand', 'product', 'android_version'))
			->distinct()
			->filterByDateReceived(array('min' => $days[$i]->getStartDate(), 'max' => $days[$i]->getEndDate()))->find();

		$iterator = $devices_details->getIterator();
		$devices_info = array();
		
		while($iterator->valid()) {
			$device_details = $iterator->current();
			$identifier_string = $device_details['brand'] . '-' . $device_details['phone_model'] . '-' . $device_details['product'] . '-Android ' . $device_details['android_version'];
			$num_reports = ReportQuery::create()
			->filterByInstallationId($device_details['installation_id'])
			->filterByDateReceived(array('min' => $days[$i]->getStartDate(), 'max' => $days[$i]->getEndDate()))
			->count();

			$device_info = new DeviceInfo();
			$device_info->setInstallationId($device_details['installation_id']);
			$device_info->setIdentifierString($identifier_string);
			$device_info->setNumReports($num_reports);
			$devices_info[] = $device_info;
			$iterator->next();
		}

		$days[$i]->setDevicesInfo($devices_info);
	}
	
	Flight::render('plain_get', array('days' => $days));
}