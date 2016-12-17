<?php

require_once "autoload.php";

$salaryManager = new SalaryManager();

$salaryManager->generateNextMonthlySalaryDates(
	(isset($argv[1]) ? (int)$argv[1] : SalaryManager::DEFAULT_CALCULATION_PERIOD),
	(isset($argv[2]) ? $argv[2] : null)
);

echo "Done\n";