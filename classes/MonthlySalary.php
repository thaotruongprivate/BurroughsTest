<?php

/**
 * Class MonthlySalary
 *
 * This class describes a generic monthly salary payment, responsible for generic salary matters such as
 * on which date of a given month salary should be paid
 */
class MonthlySalary {

	private $month;
	private $year;

	const FORBIDDEN_DAYS = ['Saturday', 'Sunday'];
	const FALLBACK_DAY = 'last Friday';

	/**
	 * @param int $month
	 * @param int $year
	 */
	public function __construct($month, $year) {
		$this->month = $month;
		$this->year = $year;
	}

	/**
	 * @return DateTime
	 */
	public function getSalaryDate() {

		$firstDateOfTheMonth = new DateTime("{$this->year}-{$this->month}-01");

		$lastDateOfTheMonth = new DateTime("{$this->year}-{$this->month}-" . $firstDateOfTheMonth->format('t'));

		if (in_array($lastDateOfTheMonth->format('l'), self::FORBIDDEN_DAYS)) {
			$fallbackDate = new DateTime();
			$fallbackDate->setTimestamp(
				strtotime(
					self::FALLBACK_DAY,
					$lastDateOfTheMonth->getTimestamp()
				)
			);
			return $fallbackDate;
		}

		return $lastDateOfTheMonth;
	}


	/**
	 * @param int $month
	 */
	public function setMonth($month) {
		$this->month = $month;
	}

	/**
	 * @param int $year
	 */
	public function setYear($year) {
		$this->year = $year;
	}
}