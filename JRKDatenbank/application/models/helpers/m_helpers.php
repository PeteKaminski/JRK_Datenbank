<?php
class Model_Helpers extends CI_Model {
	
	public function __construct()
	{
		
	}
	
	function transform_date($date,$to='eng_to_dt')//$to= dt_to_eng, oder eng_to_dt
	{
		$cache='';
		$datum='';
		switch($to)
		{
		  case 'dt_to_eng': $cache = explode('.',$date);
							if (count($cache)>1) $datum = $cache[2].'-'.$cache[1].'-'.$cache[0];
							else $datum = False;
							break;
		  case 'eng_to_dt': 
		  default:			$cache = explode('-',$date);
							if (count($cache)>1) $datum = $cache[2].'.'.$cache[1].'.'.$cache[0];
							else $datum= False;
							break;//obere break mit absicht weggelassen
		}
		return $datum;
	}

	function is_today($date)
	{
		$cache = FALSE;
		if ($date == date('d.m.Y')) $cache = TRUE;;
		return $cache;
	}

	function transform_timestamp($timestamp)//nach dt.
	{
		$cache = explode(' ',$timestamp);
		if (count($cache)>1)
		{
			
			if (is_today(transform_date($cache[0],'eng_to_dt'))) $stamp = $cache[1];
			else
			{
				$stamp = $cache[1].' '.transform_date($cache[0],'eng_to_dt');
			}
		}
		else $stamp = False;
	
		return $stamp;
	}	
}
	