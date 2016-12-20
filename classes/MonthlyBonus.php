<?php

/**
 * Class MonthlyBonus
 * This class describes a generic monthly bonus payment, responsible for generic bonus matters such as
 * on which date of a given month bonus should be paid
 */
class MonthlyBonus {

	private $month;
	private $year;

	const BONUS_DAY = 15;
	const FALLBACK_DAY = 'next Wednesday';
	const FORBIDDEN_DAYS = ['Saturday', 'Sunday'];

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
	public function getBonusDate() {

		$bonusDate = new DateTime("{$this->year}-{$this->month}-" . self::BONUS_DAY);
		
		if (in_array($bonusDate->format('l'), self::FORBIDDEN_DAYS)) {
			$fallbackDate = new DateTime();
			$fallbackDate->setTimestamp(
				strtotime(
					self::FALLBACK_DAY,
					$bonusDate->getTimestamp()
				)
			);

			return $fallbackDate;
		}

		return $bonusDate;
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