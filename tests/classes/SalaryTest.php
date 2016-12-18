<?php


class SalaryTest extends PHPUnit_Framework_TestCase {

	public function testGetSalaryDateReturnsDateTimeObject() {

		$month = rand(1,12);
		$year = rand(2016, 2020);

		$salary = new MonthlySalary($month, $year);

		$this->assertTrue(get_class($salary->getSalaryDate()) === DateTime::class);
	}

	public function testGetSalaryDateReturnsCorrectDate() {

		// first case, where we have to use a fallback date
		$month = 4;
		$year = 2017;

		$salary = new MonthlySalary($month, $year);

		$salaryDate = $salary->getSalaryDate()->format(SalaryManager::DATE_FORMAT);

		$this->assertEquals("2017-04-28", $salaryDate);

		// second case, where we can use the optimal date
		$month = 2;
		$year = 2017;

		$salary->setMonth($month);
		$salary->setYear($year);

		$salaryDate = $salary->getSalaryDate()->format(SalaryManager::DATE_FORMAT);

		$this->assertEquals("2017-02-28", $salaryDate);
	}
}
