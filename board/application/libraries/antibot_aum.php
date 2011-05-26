<?php
class antibot_aum
{
	private $max_num;
	private $result_check ;
        
	function __construct($max=9){	
		$this->max_num=$max ;
	}

	function random(){
		if($number=0) $number++;
		srand ((double) microtime( )*1000000);
		$random = rand(1, ($this->max_num)) ;
		return $random ;
	}

	function create(){
		$number1=$this->random();
		$number2=$this->random();
	
		$result=$number1+$number2 ;
		$this->result_check=$result;
		$_SESSION["result_check"] = $result;
		$text= $number1." + ".$number2 ;
		//$text= $this->number2text($number1)." บวก ".$this->number2text($number2);
		return $text ;
	}

	function number2text($number){
		$txtnum1 = array("ศูนย์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ด","แปด","เก้า","สิบ");
		$txtnum2 = array("","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน");
		$strlen = strlen($number[0]);

		$strlen = strlen($number);

		$convert = "";
		for($i=0;$i<$strlen;$i++){
			$n = substr($number, $i,1);
			if($n!=0){
				if($i==($strlen-1) AND $n==1){ $convert .= "เอ็ด"; }
				elseif($i==($strlen-2) AND $n==2){ $convert .= "ยี่"; }
				elseif($i==($strlen-2) AND $n==1){ $convert .= ""; }
				else{ $convert .= $txtnum1[$n]; }
			$convert .= $txtnum2[$strlen-$i-1];
			}
		}
		return $convert ;
	}

	function checkbot($result){
		if($result==$_SESSION["result_check"]) return TRUE;
		else return FALSE ;
	}
}