<?php

class SalaryManager {

	const FIRST_DATE_FORMAT = 'Y-m-01';
	const DATE_FORMAT = 'Y-m-d';
	const DEFAULT_OUTPUT_FILE_EXTENSION = 'csv';
	const DEFAULT_CALCULATION_PERIOD = 12; // the default amount of months that salary dates should be calculated for

	/**
	 * @param null|string $fileName
	 * @param int $noOfMonths
	 */
	public function generateNextMonthlySalaryDates($noOfMonths = self::DEFAULT_CALCULATION_PERIOD, $fileName = null) {

		// the first month we calculate is the next month from now
		$calculationMonth = new DateTime(date(self::FIRST_DATE_FORMAT, strtotime('+1 month')));

		if (!$fileName) {
			$lastMonthToCalculate = date('m.Y', strtotime("+{$noOfMonths} month"));
			$fileName = "{$calculationMonth->format('m.Y')}-{$lastMonthToCalculate}." . self::DEFAULT_OUTPUT_FILE_EXTENSION;
		}

		$handle = fopen(self::getOutputFolder() . $fileName, 'w+');

		fputcsv($handle, ['Month', 'Salary Date', 'Bonus Date']);

		$count = 0;

		while ($count < $noOfMonths) {

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