# Salary date calculation application

This is a very small CLI application which will output text in the terminal and create a CSV file which will contain the dates of salary and bonus payments each month for the next n months. 

The rules for salary and bonus dates are as followed:

- The base salaries are paid on the last day of the month, unless that day is a Saturday, a Sunday (weekend). In that case, salaries are paid before the weekend. For the sake of this application, please do not take into account public holidays.

- On the 15th of every month bonuses are paid for the previous month, unless that day is a weekend. In that case, they are paid the first Wednesday after the 15th

To run the application, in the terminal, run 

$ php path_to_main.php no_of_months_ahead name_of_output_file
Example: 
- php main.php 12 2017.csv
- php main.php 3
- php main.php

no_of_months_ahead and name_of_output_file are both optional parameters. The default values for them are 12 and startmonth-endmonth.csv respectively. For example, if no parameters are provided, and the current month is Dec 2016, a .csv file will be created in folder csv, which will be named "01.2017-12.2017.csv" which contains the salary and bonus dates for each of the months between Jan 2017 and Dec 2017. That file will look like this: https://github.com/thaotruongprivate/MonthlySalaryDateCalculation/blob/master/csv/01.2017-12.2017.csv
