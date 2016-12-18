<?php

class SalaryManagerTest extends PHPUnit_Framework_TestCase {

	public function testGenerateNextMonthlySalaryDatesPrintsOutput() {

		$this->expectOutputRegex('/Salary date is/');
		$this->expectOutputRegex('/bonus date is/');

		$salaryManager = new SalaryManager();
		$salaryManager->generateNextMonthlySalaryDates();
	}

	public function testGenerateNextMonthlySalaryDatesCreateCsvFile() {

		$calculationMonth = new DateTime(date(SalaryManager::FIRST_DATE_FORMAT, strtotime('+1 month')));

		$lastMonthToCalculate = date('m.Y', strtotime("+" . SalaryManager::DEFAULT_CALCULATION_PERIOD ." month"));
		$fileName = "{$calculationMonth->format('m.Y')}-{$lastMonthToCalculate}." . SalaryManager::DEFAULT_OUTPUT_FILE_EXTENSION;

		$salaryManager = new SalaryManager();
		$salaryManager->generateNextMonthlySalaryDates();

		$this->assertFileExists(SalaryManager::getOutputFolder() . $fileName);
	}

	/**
	 * @depends testGenerateNextMonthlySalaryDatesCreateCsvFile
	 */
	public function testGenerateNextMonthlySalaryDatesCreateNonEmptyCsvFile() {

		$calculationMonth = new DateTime(date(SalaryManager::FIRST_DATE_FORMAT, strtotime('+1 month')));

		$lastMonthToCalculate = date('m.Y', strtotime("+" . SalaryManager::DEFAULT_CALCULATION_PERIOD ." month"));
		$fileName = "{$calculationMonth->format('m.Y')}-{$lastMonthToCalculate}." . SalaryManager::DEFAULT_OUTPUT_FILE_EXTENSION;

		$salaryManager = new SalaryManager();
		$salaryManager->generateNextMonthlySalaryDates();

		$fileContent = trim(file_get_contents(SalaryManager::getOutputFolder() . $fileName));

		$this->assertTrue($fileContent !== '');
	}
}
