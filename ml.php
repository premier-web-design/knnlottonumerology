<?php
include(dirname(__FILE__) . '/vendor/autoload.php');
use Phpml\Classification\KNearestNeighbors;
class Lotto{
	private $csv;
	private $thunderballcsv;
	private $numbers;
	private $months;
	private $abbrmonths;
	private $drawmonth;
	function __construct(){
		$this->csv = dirname(__FILE__) . '/csv/newlottoresults.csv';
		$this->thunderballcsv = dirname(__FILE__) . '/csv/thunderballresults.csv';
		$this->numbers = array('A' => 1,'B' => 2,'C' => 3,'D' => 4,'E' => 5,'F' => 8,'G' => 3,'H' => 5,'I' => 1,'J' => 1,'K' => 2,'L' => 3,'M' => 4,'N' => 5,'O' => 7,'P' => 8,'Q' => 1,'R' => 2,'S' => 3,'T' => 4,'U' => 6,'V' => 6,'W' => 6,'X' => 5,'Y' => 1,'Z' => 7);
		$this->months = array('JANUARY','FEBUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER');
		$this->abbrmonths = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$this->drawmonth = array('1','2','3','4','5','6','7','8','9','10','11','12');
	}
	public function parsefile(){
		$drawmonth = $this->drawmonth;
		$export = array();
		$_export = array();
		foreach($drawmonth as $key => $month){
		$i = 0;
		$lotto = array();
		$_lotto = array();
		while($i < 59){
		$number = $i + 1;
		$numero = $this->numerology($this->months[$key]);
		$_lotto[] = array($numero,$number);
		$lotto[] = array($month,$number);
		$i++;
		}
		$export[] = $lotto;
		$_export[] = $_lotto;
		}
		return array($export,$_export);
	}
	public function parsethunderfile(){
		$drawmonth = $this->drawmonth;
		$export = array();
		$_export = array();
		foreach($drawmonth as $key => $month){
		$i = 0;
		$lotto = array();
		$_lotto = array();
		while($i < 39){
		$number = $i + 1;
		$numero = $this->numerology($this->months[$key]);
		$_lotto[] = array($numero,$number);
		$lotto[] = array($month,$number);
		$i++;
		}
		$export[] = $lotto;
		$_export[] = $_lotto;
		}
		return array($export,$_export);
	}
	public function numerology($str){
		$len = strlen($str);
		$numero = 0;
		for($i=0; $i<$len; $i++){
		$alpha  = $str[$i];
		$numero = $this->numbers[$alpha] + $numero;
		}
		//print the result
		return $numero;
		}
	public function train(){
		$array = array();
		$_array = array();
		$results = array();
		$csv = array_map('str_getcsv',file($this->csv));
			foreach($csv as $key => $parts){
				//if($key < 5){
				$day = trim($parts[1]);
				if($day == 'Wed'){$day = 'WEDNESDAY';}
				if($day == 'Sat'){$day = 'SATURDAY';}
				$date = $parts[2];
				$month = $parts[3];
				$year = $parts[4];
				$one = $parts[5];
				$two = $parts[6];
				$three = $parts[7];
				$four = $parts[8];
				$five = $parts[9];
				$six = $parts[10];
				$bonus = $parts[11];
				$k = array_search($month,$this->abbrmonths);
				$month = $this->months[$k];
			    $_monthval = $this->numerology($month);
				$monthval = $k + 1;
		     	$yearval = $parts[4];
				if(($day == 'WEDNESDAY') || ($day == 'SATURDAY')){
				$array[] = array($monthval,$parts[5]);
				$array[] = array($monthval,$parts[6]);
				$array[] = array($monthval,$parts[7]);
				$array[] = array($monthval,$parts[8]);
				$array[] = array($monthval,$parts[9]);
				$array[] = array($monthval,$parts[10]);
				$array[] = array($monthval,$parts[11]);
				$_array[] = array($_monthval,$parts[5]);
				$_array[] = array($_monthval,$parts[6]);
				$_array[] = array($_monthval,$parts[7]);
				$_array[] = array($_monthval,$parts[8]);
				$_array[] = array($_monthval,$parts[9]);
				$_array[] = array($_monthval,$parts[10]);
				$_array[] = array($_monthval,$parts[11]);
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$all = array($parts[5],$parts[6],$parts[7],$parts[8],$parts[9],$parts[10],$parts[11]);
				$i = 0;
				while($i < 59){
				$number  = 	$i + 1;
				if(!in_array($number,$all)){
				$array[] = array($monthval,$number);
				$_array[] = array($_monthval,$number);
				$results[] = 'Lose';
				}
				$i++;
				}
				
				}
		//	}
			}
			/* Losing Numbers */
			
			return array($array,$results,$_array);
	}
	public function thundertrain(){
		$array = array();
		$_array = array();
		$results = array();
		$csv = array_map('str_getcsv',file($this->thunderballcsv));
			foreach($csv as $key => $parts){
				//if($key < 5){
				$day = trim($parts[1]);
				if($day == 'Wed'){$day = 'WEDNESDAY';}
				if($day == 'Sat'){$day = 'SATURDAY';}
				if($day == 'Tue'){$day = 'TUESDAY';}
				if($day == 'Fri'){$day = 'FRIDAY';}
				$date = $parts[2];
				$month = $parts[3];
				$year = $parts[4];
				$one = $parts[5];
				$two = $parts[6];
				$three = $parts[7];
				$four = $parts[8];
				$five = $parts[9];
				$six = $parts[10];
		        $k = array_search($month,$this->abbrmonths);
				$month = $this->months[$k];
			    $_monthval = $this->numerology($month);
				$monthval = $k + 1;
		     	$yearval = $parts[4];
				if(($day == 'WEDNESDAY') || ($day == 'SATURDAY') || ($day == 'TUESDAY') || ($day == 'FRIDAY')){
				$array[] = array($monthval,$parts[5]);
				$array[] = array($monthval,$parts[6]);
				$array[] = array($monthval,$parts[7]);
				$array[] = array($monthval,$parts[8]);
				$array[] = array($monthval,$parts[9]);
				$array[] = array($monthval,$parts[10]);
				$_array[] = array($_monthval,$parts[5]);
				$_array[] = array($_monthval,$parts[6]);
				$_array[] = array($_monthval,$parts[7]);
				$_array[] = array($_monthval,$parts[8]);
				$_array[] = array($_monthval,$parts[9]);
				$_array[] = array($_monthval,$parts[10]);
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$results[] = 'Win';
				$all = array($parts[5],$parts[6],$parts[7],$parts[8],$parts[9],$parts[10]);
				$i = 0;
				while($i < 39){
				$number  = 	$i + 1;
				if(!in_array($number,$all)){
				$array[] = array($monthval,$number);
				$_array[] = array($_monthval,$number);
				$results[] = 'Lose';
				}
				$i++;
				}
				
				}
		//	}
			}
			/* Losing Numbers */
			
			return array($array,$results,$_array);
	}
    public function outcome($train){
		$outcome = array();
		$number = count($train);
		$i = 0;
		while($i < $number){
		$outcome[] = 'Win';
		$i++;		
		}
		return $outcome;
	}
	public function logToFile($filename, $msg) {
     // open file 
     $fd = fopen($filename, "a"); 
     // write string  
     $msg = $msg;

     fwrite($fd, $msg . "\n"); 
     // close file 
     fclose($fd); 
    }
}
/* Data */
$tensor = (new Lotto)->train();
$lotto = (new Lotto)->parsefile();
/* Train */
$classifier = new KNearestNeighbors();
$classifier->train($tensor[0],$tensor[1]);
/* Create Lotto Predictions */
$monthly = array();
foreach($lotto[0] as $key => $check){
foreach($check as $k => $_check){
$input = array($_check[0],$_check[1]);
$nkpred = $classifier->predict($input);
if($nkpred == 'Win'){
$month = $key + 1;
$monthly[] = array('Month' => $month,'Numbers' => $_check[1]);
}
}
}
/* Save to File */
$date = date('Y-m-d');
unlink(dirname(__FILE__) . '/files/' . $date . '.json');
(new Lotto)->logToFile(dirname(__FILE__) . '/files/' . $date . '.json',json_encode($monthly));

/* Create Lotto Predictions Using Numerology*/
$monthly = array();
foreach($lotto[1] as $key => $check){
foreach($check as $k => $_check){
$input = array($_check[0],$_check[1]);
$nkpred = $classifier->predict($input);
if($nkpred == 'Win'){
$month = $key + 1;
$monthly[] = array('Month' => $month,'Numbers' => $_check[1]);
}
}
}
/* Save to File */
$date = date('Y-m-d');
unlink(dirname(__FILE__) . '/files/' . $date . '-numerology.json');
(new Lotto)->logToFile(dirname(__FILE__) . '/files/' . $date . '-numerology.json',json_encode($monthly));
/* THunder Data */
$tensor = (new Lotto)->thundertrain();
$lotto = (new Lotto)->parsethunderfile();
/* Train */
$classifier = new KNearestNeighbors();
$classifier->train($tensor[0],$tensor[1]);
/* Create Lotto Predictions */
$monthly = array();
foreach($lotto[0] as $key => $check){
foreach($check as $k => $_check){
$input = array($_check[0],$_check[1]);
$nkpred = $classifier->predict($input);
if($nkpred == 'Win'){
$month = $key + 1;
$monthly[] = array('Month' => $month,'Numbers' => $_check[1]);
}
}
}
/* Save to File */
$date = date('Y-m-d');
unlink(dirname(__FILE__) . '/files/thunder/' . $date . 'thunder.json');
(new Lotto)->logToFile(dirname(__FILE__) . '/files/thunder/' . $date . '.json',json_encode($monthly));

/* Create Lotto Predictions Using Numerology*/
$monthly = array();
foreach($lotto[1] as $key => $check){
foreach($check as $k => $_check){
$input = array($_check[0],$_check[1]);
$nkpred = $classifier->predict($input);
if($nkpred == 'Win'){
$month = $key + 1;
$monthly[] = array('Month' => $month,'Numbers' => $_check[1]);
}
}
}
/* Save to File */
$date = date('Y-m-d');
unlink(dirname(__FILE__) . '/files/thunder/' . $date . '-numerology-thunder.json');
(new Lotto)->logToFile(dirname(__FILE__) . '/files/thunder/' . $date . '-numerology-thunder.json',json_encode($monthly));
?>