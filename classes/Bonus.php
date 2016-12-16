<?php

/**
 * Created by PhpStorm.
 * User: thaotruong
 * Date: 16.12.16
 * Time: 14:58
 */
class Bonus {

	const BONUS_DAY = 15;
	const FALLBACK_DAY = 'next Wednesday';
	const FORBIDDEN_DAYS = ['Saturday', 'Sunday'];

	/**
	 * @param int $month
	 * @param int $year
	 * @return DateTime
	 */
	public static function getBonusDate($month, $year) {
		
		$bonusDate = new DateTime("{$year}-{$month}-" . self::BONUS_DAY);
		
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
}