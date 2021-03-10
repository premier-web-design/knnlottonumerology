# Lottery Number Predictor
## General info
A simple machine learning based program that uses numerology and lottery draw data from the last 27 years to generate predictions on future lottery draws. Just updated to include predictions for Thunderball and Euromillions
	
## Dependancies
This project requires:
* PHP ML library 
* PHP 7
	
## Setup
For this script to work simply download the repo and run composer. The script needs to be exceuted as a background task or if you are working with your localhost (i.e. xampp) click on the cron.bat file to run the script with the cli (you will need to edit the path to php and the path to the ml.php file to get it to work.

To view the results after executing just open the parser.php file in your browser and the results for the current month will be displayed along with the most likely numbers to arise in the draws.

## Track Record
Saturday 27th Feb - Two Numbers (Lotto)

Saturday 6th March - Two Numbers (Lotto)

Saturday 6th March - Two Numbers (Thunderball)

## Notes

The predictions are determined as much by the time complexity of the data as well as they are the spatial complexity. If the same datasets are run at different times, different numbers are predicted. 

For example a run of the software on Saturday morning predicted two numbers in each draw, however a run of the same software on Sunday morning predicted three numbers in each draw, this is even though the inputted datasets were the same. The only component that had changed was the element relating to time complexity.

## Attributions
* [Data](http://lottery.merseyworld.com/)
* [PHP ML](https://php-ml.readthedocs.io/en/latest/)

## License
* [GPL v.3](http://www.gnu.org/licenses/gpl-3.0.en.html)
