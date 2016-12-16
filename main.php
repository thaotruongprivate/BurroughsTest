<?php
/**
 * Created by PhpStorm.
 * User: thaotruong
 * Date: 16.12.16
 * Time: 15:00
 */

require_once "autoload.php";

$salaryManager = new SalaryManager();

$salaryManager->generateNext12MonthSalaryDates(
	(isset($argv[1]) ? $argv[1] : null)
);

echo "Done\n";