<?php

/**
 * Created by PhpStorm.
 * User: thaotruong
 * Date: 16.12.16
 * Time: 14:59
 */
class SalaryManager {

	const FIRST_DATE_FORMAT = 'Y-m-01';
	const DATE_FORMAT = 'Y-m-d';

	/**
	 * @param null|string $fileName
	 */
	public function generateNext12MonthSalaryDates($fileName = null) {

		$numberOfMonths = 12;

		// the first month we calculate is the next month from now
		$calculationMonth = new DateTime(date(self::FIRST_DATE_FORMAT, strtotime('+1 month')));

		if (!$fileName) {
			$lastMonthToCalculate = date('m.Y', strtotime("+{$numberOfMonths} month"));
			$fileName = $calculationMonth->format('m.Y') . '-' . $lastMonthToCalculate . '.csv';
		}

		$handle = fopen(self::getOutputFolder() . $fileName, 'w+');

		fputcsv($handle, ['Month', 'Salary Date', 'Bonus Date']);

		$count = 0;

		while ($count < $numberOfMonths) {

			$salaryDate = Salary::getSalaryDate(
				$calculationMonth->format('m'),
				$calculationMonth->format('Y')
			)->format(self::DATE_FORMAT);

			$bonusDate = Bonus::getBonusDate(
				$calculationMonth->format('m'),
				$calculationMonth->format('Y')
			)->format(self::DATE_FORMAT);

			echo "{$calculationMonth->format('m/Y')}: Salary date is {$salaryDate}, bonus date is {$bonusDate}\n";

			fputcsv(
				$handle,
				[
					$calculationMonth->format('m/Y'),
					$salaryDate,
					$bonusDate,
				]
			);

			$calculationMonth->modify('+1 month');
			$count++;
		}

		fclose($handle);

	}

	/**
	 * @return string
	 */
	public static function getOutputFolder() {
		return __DIR__ . '/../csv/';
	}
}