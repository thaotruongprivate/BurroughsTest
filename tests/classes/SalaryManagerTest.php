<?php

/**
 * Class SalaryManagerTest
 * tests for methods in SalaryManager class
 */
class SalaryManagerTest extends PHPUnit_Framework_TestCase {

	public function testGenerateNextMonthlySalaryDatesCreateCsvFile() {

		$salaryManager = new SalaryManager();
		$salaryManager->generateNextMonthlySalaryDates();

		$this->assertFileExists(SalaryManager::getOutputFolder() . SalaryManager::getDefaultFileName());
	}

	/**
	 * @depends testGenerateNextMonthlySalaryDatesCreateCsvFile
	 */
	public function testGenerateNextMonthlySalaryDatesCreateNonEmptyCsvFile() {

		$fileContent = trim(file_get_contents(SalaryManager::getOutputFolder() . SalaryManager::getDefaultFileName()));

		$this->assertNotEmpty($fileContent);
	}
}
