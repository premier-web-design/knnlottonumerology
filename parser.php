<?php
class Parser{
	public $predictionscsv;
	public $numredictionscsv;
	public $thunderpredictionscsv;
	public $numthunderpredictionscsv;
	function __construct(){
		$this->predictionscsv = dirname(__FILE__) . '/files/' . date('Y-m-d') . '.json';
		$this->numpredictionscsv = dirname(__FILE__) . '/files/' . date('Y-m-d') . '-numerology.json';
		$this->thunderpredictionscsv = dirname(__FILE__) . '/files/thunder/' . date('Y-m-d') . '.json';
		$this->numthunderpredictionscsv = dirname(__FILE__) . '/files/thunder/' . date('Y-m-d') . '-numerology-thunder.json';
	
	}
	public function parsecsv($file){
		print $file . '<br>';
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
(new Parser)->parsecsv((new Parser)->predictionscsv);
(new Parser)->parsecsv((new Parser)->numpredictionscsv);
(new Parser)->parsecsv((new Parser)->thunderpredictionscsv);
(new Parser)->parsecsv((new Parser)->numthunderpredictionscsv);
?>