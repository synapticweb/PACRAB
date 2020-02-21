<?php

/**
* This class encapsulates information about a day interval.
*/
class Day {
	/** 
	* @var string The beginning date (Y-m-d H:i:s) of the interval*/
	private $start_date;

	/** 
	* @var string The end date (Y-m-d H:i:s) of the interval*/
	private $end_date;

	/** 
	* @var DeviceInfo[] An array of DeviceInfo objects that contains information about the devices that produced reports on that specific day.*/
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
	/** 
	* @var string The installation unique ID of the app, as reported by ACRA. */
	private $installation_id;

	/** 
	* @var string An identifier string computed by PACRAB for every installation id. It is composed by the btand of the device, the phone model, the product name and the Android version, all separated by dashes.*/
	private $identifier_string;

	/** 
	* @var int The number of reports produced by this device on a specific day. */
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

/**
* This function returns an array of day intervals computed using the field date_received from the db. 
* @return Day[] The intervals are returned as an array of Day objects.
*/
function computeDays() {
	$dates = ReportQuery::create()->select('date_received')->orderByDateReceived('desc')->find()->getData();
	$days = array();
	$date_start = null;

	for($i = 0; $i < count($dates); ++$i) {
		$date_current = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dates[$i]); //I use DateTimeImmutable because when calling setTime below I want to create a new object instead of modifying itself.
		if($date_start == null)
			$date_start = $date_current;
		//Setting time part to 0 is necessary when comparing date objects that are in different days, but the difference between them is less than 24 hours. Before using this trick these dates were not compared correctly (see commit 21a0f71f1028f484f9). https://stackoverflow.com/questions/18102603/get-a-php-datetime-difference-in-days-considering-midnight-as-a-day-change.
		//Also, it is vital to use DateTime->days instead of DateTime->d: https://stackoverflow.com/questions/30446918/what-is-the-difference-between-the-days-and-d-property-in-dateinterval		
		$interval = $date_start->setTime(0,0,0)->diff($date_current->setTime(0,0,0));
		
		if($interval->days > 0) {
			$day = new Day();
			$day->setEndDate($date_start->format('Y-m-d H:i:s')); //because the dates are in reverse chronological order.
			$day->setStartDate($dates[$i - 1]);		
			$days[] = $day;	
			$date_start = $date_current;
		}
		
		if($i == count($dates) - 1) { //If we reached the oldest report date, this is the last iteration, so the previously computed $date_start doesn't matter anymore. This is why we have to set here the last interval.
			$day = new Day();
			$day->setEndDate($date_start->format('Y-m-d H:i:s'));
			$day->setStartDate($dates[$i]);
			$days[] = $day;
		} 
	}

	return $days;
}

function plain_get($page = 1) {
	session_start();
	//TODO: page < 1, page > $num_pages, empty db.
	if(isset($_SESSION['days']) && $page > 1)
		$days = $_SESSION['days'];
	else {
		$days = computeDays();
		$_SESSION['days'] = $days;
	}

	$offset = ($page - 1) * DAYS_PER_PAGE;
	$days_to_display = array_slice($days, $offset, DAYS_PER_PAGE);
	$num_pages = ceil(count($days) / DAYS_PER_PAGE);

	//next, we figure what devices crashed in every day interval we got in the preceding step. The found devices are stored in a third element of ...
	for ($i = 0; $i < count($days_to_display); ++$i) {
		$devices_details = ReportQuery::create()
			->select(array('installation_id', 'phone_model', 'brand', 'product', 'android_version'))
			->distinct()
			->filterByDateReceived(array('min' => $days_to_display[$i]->getStartDate(), 'max' => $days_to_display[$i]->getEndDate()))->find();

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

		$days_to_display[$i]->setDevicesInfo($devices_info);
	}
	
	Flight::render('plain_get', array('days' => $days_to_display, 'page' => $page, 'num_pages' => $num_pages));
}