<?php

/**
* This class encapsulates information about a day interval.
*/
class Day {
	/** @var string The beginning date (Y-m-d H:i:s) of the interval*/
	private $start_date;

	/** @var string The end date (Y-m-d H:i:s) of the interval*/
	private $end_date;

	/** @var DeviceInfo[] An array of DeviceInfo objects that contains information about the devices that produced reports on that specific day.*/
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

/**
* This class encapsulates information about a specific device that produced a report.
*/
class DeviceInfo {
	/** @var string The installation unique ID of the app, as reported by ACRA. */
	private $installation_id;

	/** @var string An identifier string computed by PACRAB for every installation id. It is composed by the btand of the device, the phone model, the product name and the Android version, all separated by dashes.*/
	private $identifier_string;

	/** @var int The number of reports produced by this device on a specific day. */
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

function plain_get($offset = 0) {
	$dates = ReportQuery::create()->select('date_received')->orderByDateReceived('desc')->find()->getData();

	//The next code attempts to create day intervals on the basis of the receiving dates of the reports. These dates are stored in the db in the field date_received. The intervals are returned as an array of Day objects.
	$days = array();
	$date_start = null;
	$prev_offset = -1; $next_offset;
	$day_count = 0;

	for($i = $offset; $i >= 0; --$i) {
		$date_current = DateTime::createFromFormat('Y-m-d H:i:s', $dates[$i]);
		if($date_start == null)
			$date_start = $date_current;
		$interval = $date_start->diff($date_current);

		if($interval->d > 0) {
			$day_count++;
			$date_start = $date_current;
		}

//Prima idee a fost ca condiția să fie $day_count == DAYS_PER_PAGE. Problema este că în momentul în care $day_count devine DAYS_PER_PAGE mai este încă o ZI de decrementat pînă se ajunge la începutul paginii!
		if($day_count > DAYS_PER_PAGE) {
			$prev_offset = $i + 1; // Cînd $days_count devine > DAYS_PER_PAGE deja s-a intrat cu un record în pagina precedentă. Este deci necesar să corectăm.
			break;
		}
//Sistemul de mai sus nu funcționează la prima pagină deoarece $day_count nu ajunge niciodată mai mare decît DAYS_PER_PAGE. Este deci nevoie de o condiție specială.
		if($i == 0 && $day_count > 0) //$day_count > 0 e necesar pentru ca $prev_offset să nu fie setat la accesarea primei pagini.
			$prev_offset = 0;
	}

	$date_start = null;

	for($i = $offset; $i < count($dates); ++$i) {
		$date_current = DateTime::createFromFormat('Y-m-d H:i:s', $dates[$i]);
		if($date_start == null)
			$date_start = $date_current;
		$interval = $date_start->diff($date_current);
		
		if($interval->d > 0) {
			$day = new Day();
			$day->setEndDate($date_start->format('Y-m-d H:i:s')); //because the dates are in reverse chronological order
			$day->setStartDate($dates[$i - 1]);
			print print_r($day, true) . "<br>";
			$days[] = $day;	
			// if(count($days) == DAYS_PER_PAGE) {
			// 	$next_offset = $i;
			// 	break;
			// }
			$date_start = $date_current;
		}
		
		if($i == count($dates) - 1) { //If we reached the oldest report date, this is the last iteration, so the previously computed $date_start doesn't matter anymore. This is why we have to set here the last interval.
			$day = new Day();
			$day->setEndDate($date_start->format('Y-m-d H:i:s'));
			$day->setStartDate($dates[$i]);
			print print_r($day, true) . "<br>";

			$days[] = $day;
			$next_offset = -1;	
		} 
	}

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
	
	// Flight::render('plain_get', array('days' => $days, 'prev_offset' => $prev_offset, 'next_offset' => $next_offset));
}