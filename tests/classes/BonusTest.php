<?php


class BonusTest extends PHPUnit_Framework_TestCase {

	public function testGetBonusDateReturnsDateTimeObject() {

		$month = rand(1,12);
		$year = rand(2016, 2020);

		$bonus = new MonthlyBonus($month, $year);

		$this->assertInstanceOf(DateTime::class, $bonus->getBonusDate());
	}

	public function testGetBonusDateReturnsCorrectDate() {

		// first case, where we have to use a fallback date
		$month = 4;
		$year = 2017;

		$bonus = new MonthlyBonus($month, $year);

		$bonusDate = $bonus->getBonusDate()->format(SalaryManager::DATE_FORMAT);

		$this->assertEquals("2017-04-19", $bonusDate);

		// second case, where we can use the optimal date
		$month = 2;
		$year = 2017;

		$bonus->setMonth($month);
		$bonus->setYear($year);

		$bonusDate = $bonus->getBonusDate()->format(SalaryManager::DATE_FORMAT);

		$this->assertEquals("2017-02-15", $bonusDate);
	}
}
