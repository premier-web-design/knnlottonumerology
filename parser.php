<?php
class Parser{
	public $predictionscsv;
	public $numredictionscsv;
	public $europredictionscsv;
	public $euronumredictionscsv;
	public $thunderpredictionscsv;
	public $numthunderpredictionscsv;
	function __construct(){
		$this->predictionscsv = dirname(__FILE__) . '/files/' . date('Y-m-d') . '.json';
		$this->numpredictionscsv = dirname(__FILE__) . '/files/' . date('Y-m-d') . '-numerology.json';
		$this->europredictionscsv = dirname(__FILE__) . '/files/euro/' . date('Y-m-d') . '.json';
		$this->euronumpredictionscsv = dirname(__FILE__) . '/files/euro/' . date('Y-m-d') . '-numerology-euro.json';
		$this->thunderpredictionscsv = dirname(__FILE__) . '/files/thunder/' . date('Y-m-d') . '.json';
		$this->numthunderpredictionscsv = dirname(__FILE__) . '/files/thunder/' . date('Y-m-d') . '-numerology-thunder.json';
	
	}
	public function parsecsv($file,$name){
		print $name . '<br>';
		if(file_exists($file)){
			
			 $filem = $file;
             $file_arr = file($filem);
             $lr = $file_arr[count($file_arr) - 1];
             $xdata = json_decode($lr,1);
			
			 $all = array();
			 $i = 0;
			 while($i < 59){
			 $number = $i + 1;
			 $freq = 0;
			 foreach($xdata as $key => $data){
				 if($data['Numbers'] == $number){
					 $freq = $freq + 1;
				 }
			 }
			 if($freq > 1){
				 $all = array('Number' => $i,'Frequency' => $freq);
			 }
			 $i++;
			 }
			 
			  $this->_dump($all);
			  $this->thismonth($xdata);
		}
	}
	public function thismonth($xdata){
	$monthly = array();
	foreach($xdata as $key => $data){
	if($data['Month'] == date('N')){
	$monthly[] = $data['Numbers'];
	}
	}
	$this->_dump($monthly);
	}
	public function _dump($array){
    print '<pre>';
    print_r($array);
    print '</pre>';
    }
}
(new Parser)->parsecsv((new Parser)->predictionscsv,'Lotto');
(new Parser)->parsecsv((new Parser)->numpredictionscsv,'Lotto Numerology');
(new Parser)->parsecsv((new Parser)->thunderpredictionscsv,'Thunderball');
(new Parser)->parsecsv((new Parser)->numthunderpredictionscsv,'Thunderball Numerology');
(new Parser)->parsecsv((new Parser)->europredictionscsv,'Euro Millions');
(new Parser)->parsecsv((new Parser)->euronumpredictionscsv,'Euro Millions Numerology');
?>