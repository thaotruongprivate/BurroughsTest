<?php

/**
 * Created by PhpStorm.
 * User: thaotruong
 * Date: 16.12.16
 * Time: 14:57
 */
class Salary {

	const FORBIDDEN_DAYS = ['Saturday', 'Sunday'];
	const FALLBACK_DAY = 'last Friday';

	/**
	 * @param int $month
	 * @param int $year
	 * @return DateTime
	 */
	public static function getSalaryDate($month, $year) {

		$firstDateOfTheMonth = new DateTime("{$year}-{$month}-01");

		$lastDateOfTheMonth = new DateTime("{$year}-{$month}-" . $firstDateOfTheMonth->format('t'));

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
}