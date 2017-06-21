<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashMachine extends CI_CONTROLLER{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] 				= 'Cash Machine';
		$data['content'] 			= 'cashMachine/index';
		$this->load->view('frame/content_all', $data);		
	}


	public function calculate()
	{
		$cash = intval($this->input->post('amount'));
		if( ($cash % 10)==0 ){
			$disp_money = array(100,50,20,10); 
			$final = '[ ';
			foreach ($disp_money as $key => $value) {
				$division = $cash/$value;
				if($division>=1){
					$divfloor = floor($division);
					$rest = $cash - ($divfloor * $value);
					#echo "cash: ".$cash."||| value: ".$value."||| diivison:".$division."||| divfloor:".$divfloor." ||| rest: ".$rest."<br>";
					$cash = $rest;
					$final.="[".$divfloor." x ".$value."] "; 
				}
			}
			$final.=" ]";
		}else{
			$final = "Note Unavailable Exception";
		}
		
		echo $final;

	}


}