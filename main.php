<?php

require_once "autoload.php";

$salaryManager = new SalaryManager();

$salaryManager->generateNext12MonthSalaryDates(
	(isset($argv[1]) ? $argv[1] : null)
);

echo "Done\n";