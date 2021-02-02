<?php

use Propel\Runtime\ActiveQuery\Criteria;
define("ASCENDING", 1);
define("DESCENDING", 2);
define("DATE_FORMAT", "Y-m-d H:i:s"); //de văzut dacă nu face clash cu ceva definit în framework-uri.

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

	/**
	* @var boolean A flag that indicates if this day is the last in the collection fetched.*/
	private $last = false;

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

	public function setLast($isLast) {
		$this->last = $isLast;
	}	

	public function isLast() {
		return $this->last;
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

//https://stackoverflow.com/a/19271434/6192350
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

/**
* This function returns an array of day intervals computed using the field date_received of the reports.
* @param $query ModelCriteria the query object that retrieves the dates.
* @param $direction string The direction of the processing. DESCENDING means the dates are processed from newer to older; ASCENDING means that dates are processed from older to newer. 
* @return Day[] The intervals are returned as an array of Day objects.
*/
function computeDays($query, $direction) {
	$dates = $query->find()->getData();
	$days = array();
	$date_start = null;

	for ($i = 0; $i < count($dates); ++$i) {
		//DateTimeImmutable because when calling setTime below I want to create a new object instead of modifying itself.
	 	$date_current = DateTimeImmutable::createFromFormat(DATE_FORMAT, $dates[$i]);
	 	if($date_start == null)
			$date_start = $date_current;

		//Ideea este să aflăm dacă data curentă se află într-o altă zi calendaristică față de data de start. De aceea se setează timpul celor 2 date la ora 0:00:00 și se face diferența.
		$interval = $date_start->setTime(0,0,0)->diff($date_current->setTime(0,0,0));

		if($interval->days > 0) {
			$day = new Day();
		
			if($direction == DESCENDING) {
			//Dacă procesarea este descendentă, cînd am găsit o diferență de o zi setăm $date_start ca sfîrșit al intervalului și data precedentă față de cea curentă ca început al intervalului.
				$day->setEndDate($date_start->format(DATE_FORMAT)); //because the dates are in reverse chronological order.
				$day->setStartDate($dates[$i - 1]);	
			}
			else {
			////Dacă procesarea este ascendentă, cînd am găsit o diferență de o zi setăm $date_start ca  început al intervalului și data precedentă față de cea curentă ca sfîrșit al intervalului.
				$day->setStartDate($date_start->format(DATE_FORMAT));
				$day->setEndDate($dates[$i - 1]);
			}

			$days[] = $day;	
			$date_start = $date_current;
		}
		
		if($i == count($dates) -1) {
		//Ca să identificăm un interval, este nevoie să existe cel puțin o dată mai nouă decît $end_date (ASCENDING) sau mai veche decît $start_date (DESCENDING). După ce am identificat penultimul interval, putem avea 1 sau mai multe date toate aparținînd aceleaiași zile, ultima zi, dar nu mai putem stabili limitele acestui interval pentru că nu mai este nimic după. Deci, cînd ajungem la ultima dată din colecție, setăm $start_date sau $end_date la această dată.
			$day = new Day();
			$day->setLast(true);

			if($direction == DESCENDING) {
				$day->setEndDate($date_start->format(DATE_FORMAT)); //because the dates are in reverse chronological order.
				$day->setStartDate($dates[$i]);	
			}
			else {
				$day->setStartDate($date_start->format(DATE_FORMAT));
				$day->setEndDate($dates[$i]);
			}
			$days[] = $day;	
		}

		//nu întoarcem decît DAYS_PER_PAGE intervals.
		if(count($days) == DAYS_PER_PAGE)
			break;
	 }
	 return $days;
}


/**
* Returns an array that has as indexes package names and as values the number of reports associated with that package. 
* Only packages with 1 or more reports are included in the result, the ones with 0 reports are ignored.
* @return array[string]int
*/
function reportsCountByPackage() {
	global $allowedPackages;
	$result = array();
	foreach ($allowedPackages as $package) {
		$count = ReportQuery::create()->filterByPackageName($package)->count();
		if($count > 0)
			$result[$package] = $count;
	}
	return $result;
}

/** 
* Funcția care extrage raporturile și le aranjează pentru afișare. Poate fi apelată a. fără niciun parametru
* b. cu unul dintre parametri != "null" și unul == "null". Niciodată ambii parametri nu pot fi != "null".
* @param string $newerThan If this parameter != "null" the function must return reports newer than the specified date.
* @param string $olderThan If this parameter != "null" the function must return reports older than the specified date.
* @return Day[] a collection of Day objects.
*/
function plain_get($newerThan = "null", $olderThan = "null") {
	session_start();
	$query = ReportQuery::create()->select('date_received');
	if(isset($_SESSION[FILTER]))
		$query->filterByPackageName($_SESSION[FILTER]);

	 if($newerThan == "null" && $olderThan == "null") {
	 //Se cere pagina rădăcină, "/". Se extrag deci toate raporturile. Direcția de procesare este dinspre raporturi mai noi spre raporturi mai vechi, deci raporturile sînt ordonate descrescător (cele mai noi primele) și apelăm computeDays cu DESCENDING.
		$query = $query->orderByDateReceived('desc');
		$days = computeDays($query, DESCENDING);
	}
	 else if ($olderThan != "null" && $newerThan == "null") {
	 //A fost apăsat un link "next", deci trebuie extrase raporturile mai vechi decît valoarea parametrului olderThan. Direcția de procesare este dinspre raporturi mai noi spre raporturi mai vechi, deci raporturile sînt ordonate descrecător (cele mai noi primele) și apelăm computeDays cu DESCENDING.
	 	if(!validateDate($olderThan, DATE_FORMAT))
	 		die("Invalid date format!"); 
	 	$query->filterByDateReceived($olderThan, Criteria::LESS_THAN)
	 			->orderByDateReceived('desc');
	 			$days = computeDays($query, DESCENDING);
	 		}

	 else if($olderThan == "null" && $newerThan != "null") {
	 //A fost apăsat un link "previous", deci trebuie extrase raporturile mai noi decît valoarea parametrului newerThan. Direcția de procesare este dinspre raporturi mai vechi spre raporturi mai noi, deci raporturile sînt ordonate crescător și apelăm computeDays cu ASCENDING. Datele TREBUIE returnate ascending deoarece, dacă ar fi returnate descending computeDays ar returna DAYS_PER_PAGE pornind de la cel mai nou raport înapoi, ori noi vrem să returneze DAYS_PER_PAGE pornind de la newerThan înainte.
	 	if(!validateDate($newerThan, DATE_FORMAT))
	 		die("Invalid date format!"); 
	 	$query->filterByDateReceived($newerThan, Criteria::GREATER_THAN)
	 			->orderByDateReceived('asc');
	 			$days = computeDays($query, ASCENDING);
	 		}
	 else
	 	die("This is not possible!");

	 if(count($days) == 0)
	 	die("No reports.");

	 //inversăm ordinea dacă avem date procesate ascending pentru că în pagină le ordonăm invers cronologic.
	 if($olderThan == "null" && $newerThan != "null")
	 	$days = array_reverse($days);

	 foreach ($days as $day) {
	 	$query = ReportQuery::create()
			->select(array('installation_id', 'phone_model', 'brand', 'product', 'android_version'))
			->distinct()
			->filterByDateReceived(array('min' => $day->getStartDate(), 'max' => $day->getEndDate()));
			if(isset($_SESSION[FILTER]))
				$query->filterByPackageName($_SESSION[FILTER]);

			$devices_details = $query->find();
			$iterator = $devices_details->getIterator();
			$device_infos = array();

			while($iterator->valid()) {
				$device_details = $iterator->current();
				$identifier_string = $device_details['brand'] . '-' . $device_details['phone_model'] . '-' . $device_details['product'] . '-Android ' . $device_details['android_version'];
				//am filtrat deja o dată, acum nu mai are rost.
				$num_reports = ReportQuery::create()
				->filterByInstallationId($device_details['installation_id'])
				->filterByDateReceived(array('min' => $day->getStartDate(), 'max' => $day->getEndDate()))
				->count();

				$device_info = new DeviceInfo();
				$device_info->setInstallationId($device_details['installation_id']);
				$device_info->setIdentifierString($identifier_string);
				$device_info->setNumReports($num_reports);
				$device_infos[] = $device_info;
				$iterator->next();
			}
	 	$day->setDevicesInfo($device_infos);
	 }

	 $packagesInfo = reportsCountByPackage();
	 //linkul "previous" nu apare dacă: a. sîntem pe pagina de start. b.dacă primul element al colecției are flagul last setat (am ajuns la cea mai nouă dată, nu sînt altele mai noi, deci "previous nu are sens.) 
	 if(!$days[0]->isLast() && !($olderThan == "null" && $newerThan == "null"))
	 	$newerThan_date = $days[0]->getEndDate();
	 else
	 	$newerThan_date = null;

	 //linkul "next" nu apare dacă ultimul element al colecției are flagul last setat (am ajuns la cea mai veche dată, nu sînt altele mai vechi, deci "next" nu are sens.) 
	 if(!$days[count($days) - 1]->isLast())
	 	$olderThan_date = $days[count($days) - 1]->getStartDate();
	 else
	 	$olderThan_date = null;

	 Flight::render('plain_get', array('packagesInfo' => $packagesInfo, 'days' => $days, 'newerThan' => $newerThan_date, 
		'olderThan' => $olderThan_date));
}