<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;


class EventcalendarComponent extends Component {


function getCalendar($post_id, $startmonth='now',$startYear='now',$startDay='now'){

    $this->curDate = array();
		
		if (!isset($_GET["cal_month"])){
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		} else {
			$this->curDate['month']=$_GET["cal_month"];
    }
        
		if (!isset($_GET["cal_year"])){
			$this->curDate['year']=$startYear=='now'?date("Y"):$startYear;			 
		} else {
			$this->curDate['year']=$_GET["cal_year"];
    }
        
		if (!isset($_GET["cal_focus"])){
			$this->curDate['focus']=$startDay=='now'?
			"{$this->curDate['year']}-{$this->curDate['month']}-".date('j'):"{$this->curDate['year']}-{$this->curDate['month']}-".$startDay;
		} else {
			$this->curDate['focus']=$_GET["cal_focus"];
		}
    
		//current month	
		$date_timestamp = mktime(0,0,0,$this->curDate['month'],1,$this->curDate['year']);
		
		//first day of current month (numerico da 0 a 6)
		$start_day = date("w",$date_timestamp);
		
		//numero di giorni del mese corrente
		$no_days_in_month = date("t",$date_timestamp);
		
		//If month's first day does not start with first Sunday, fill table cell with a space
		for ($i = 1; $i <= $start_day;$i++)
			$dates[1][$i] = " ";

		$row = 1;
		$col = $start_day+1;
		$num = 1;
		while($num<=31)
			{
				if ($num > $no_days_in_month)
					 break;
				else
					{
						$dates[$row][$col] = $num;
						if (($col + 1) > 7)
							{
								$row++;
								$col = 1;
							}
						else
							$col++;
						$num++;
					}//if-else
			}//while
			
		$mon_num = date("n",$date_timestamp);
		$temp_yr = $next_yr = $prev_yr = $this->curDate['year'];

		$prev = $mon_num  - 1;
		$next = $mon_num  + 1;

		//If January is currently displayed, month previous is December of previous year
		if ($mon_num  == 1)
			{
				$prev_yr = $this->curDate['year'] - 1;
				$prev = 12;
			}
    
		//If December is currently displayed, month next is January of next year
		if ($mon_num  == 12)
			{
				$next_yr = $this->curDate['year'] + 1;
				$next = 1;
			}

		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\">";

		$result.= 	"\n<tr > ";
		
		//$result.= "<td colspan=\"2\" class=\"calendar_heading\"><a href=\"?cal_month=$prev&amp;cal_year=$prev_yr".$this->buildQueryString("cal_month","cal_year")."\" >&laquo;</a></td>";
		
		$result.= "<td class=\"calendar_heading\" colspan=\"7\" >".date("F",$date_timestamp)." ".$temp_yr."</td>";
		
		//$result.= "<td colspan=\"2\" class=\"calendar_heading\"><a href=\"?cal_month=$next&amp;cal_year=$next_yr".$this->buildQueryString("cal_month","cal_year")."\" >&raquo;</a></td>";
		
		
		$result.="</tr>";
		  

			$dayName[]="Sun";
			$dayName[]="Mon";
			$dayName[]="Tue";
			$dayName[]="Wed";
			$dayName[]="Thu";
			$dayName[]="Fri";
			$dayName[]="Sat";		


		$result.= "\n<tr><td class=\"calendar_weekDays\"><span>{$dayName[0]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[1]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[2]}</span></td>";
		$result.= "<td class=\"calendar_weekDays\"><span>{$dayName[3]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[4]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[5]}</span></td><td class=\"calendar_weekDays\">
		<span>{$dayName[6]}</span></td></tr><tr>";
		//$result.= "<tr><td COLSPAN=7> </tr><tr ALIGN='center'>";
				
		$end = ($start_day > 4)? 6:5;

		for ($row=1;$row<=$end;$row++)
			{
				for ($col=1;$col<=7;$col++)
					{
						
						$t = isset($dates[$row][$col])?$dates[$row][$col]:"";
            
           $getevents = TableRegistry::get('EventDates');

          $events = $getevents->find('all', [ 
           'conditions' => ['DATE_FORMAT(event_date,"%e")' => $t, 'DATE_FORMAT(event_date,"%c")' => $this->curDate['month'], 'DATE_FORMAT(event_date,"%Y")' => $this->curDate['year'], 'post_id' => $post_id]                 
          ]);       	     

      $countevents = count($events);
						if ( $countevents > 0) {
							$result.= "\n<td class=\"calendar_link\">".$t."</td>";
						} else  {
							$result.= "\n<td class=\"calendar_simple\">".(($t == "" )? "&nbsp;" :$t)."</td>";
            }
					}
				
				if (($row + 1) != ($end+1))
					$result.= "</tr>\n<tr align=\"center\">";
				else
					$result.= "</tr></table>";
			}// for - row
			return $result;
	}


function insertCalendar($startmonth='now',$startYear='now',$startDay='now'){

    $this->curDate = array();
		
		if (!isset($_GET["cal_month"])){
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		} else {
			$this->curDate['month']=$_GET["cal_month"];
    }
        
		if (!isset($_GET["cal_year"])){
			$this->curDate['year']=$startYear=='now'?date("Y"):$startYear;			 
		} else {
			$this->curDate['year']=$_GET["cal_year"];
    }
        
		if (!isset($_GET["cal_focus"])){
			$this->curDate['focus']=$startDay=='now'?
			"{$this->curDate['year']}-{$this->curDate['month']}-".date('j'):"{$this->curDate['year']}-{$this->curDate['month']}-".$startDay;
		} else {
			$this->curDate['focus']=$_GET["cal_focus"];
		}
    
		//current month	
		$date_timestamp = mktime(0,0,0,$this->curDate['month'],1,$this->curDate['year']);
		
		//first day of current month (numerico da 0 a 6)
		$start_day = date("w",$date_timestamp);
		
		//numero di giorni del mese corrente
		$no_days_in_month = date("t",$date_timestamp);
		
		//If month's first day does not start with first Sunday, fill table cell with a space
		for ($i = 1; $i <= $start_day;$i++)
			$dates[1][$i] = " ";

		$row = 1;
		$col = $start_day+1;
		$num = 1;
		while($num<=31)
			{
				if ($num > $no_days_in_month)
					 break;
				else
					{
						$dates[$row][$col] = $num;
						if (($col + 1) > 7)
							{
								$row++;
								$col = 1;
							}
						else
							$col++;
						$num++;
					}//if-else
			}//while
			
		$mon_num = date("n",$date_timestamp);
		$temp_yr = $next_yr = $prev_yr = $this->curDate['year'];

		$prev = $mon_num  - 1;
		$next = $mon_num  + 1;

		//If January is currently displayed, month previous is December of previous year
		if ($mon_num  == 1)
			{
				$prev_yr = $this->curDate['year'] - 1;
				$prev = 12;
			}
    
		//If December is currently displayed, month next is January of next year
		if ($mon_num  == 12)
			{
				$next_yr = $this->curDate['year'] + 1;
				$next = 1;
			}

		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\">";

		$result.= 	"\n<tr > ";
		
		//$result.= "<td colspan=\"2\" class=\"calendar_heading\"><a href=\"?cal_month=$prev&amp;cal_year=$prev_yr".$this->buildQueryString("cal_month","cal_year")."\" >&laquo;</a></td>";
		
		$result.= "<td class=\"calendar_heading\" colspan=\"7\" >".date("F",$date_timestamp)." ".$temp_yr."</td>";
		
		//$result.= "<td colspan=\"2\" class=\"calendar_heading\"><a href=\"?cal_month=$next&amp;cal_year=$next_yr".$this->buildQueryString("cal_month","cal_year")."\" >&raquo;</a></td>";
		
		
		$result.="</tr>";
		  

			$dayName[]="Sun";
			$dayName[]="Mon";
			$dayName[]="Tue";
			$dayName[]="Wed";
			$dayName[]="Thu";
			$dayName[]="Fri";
			$dayName[]="Sat";		


		$result.= "\n<tr><td class=\"calendar_weekDays\"><span>{$dayName[0]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[1]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[2]}</span></td>";
		$result.= "<td class=\"calendar_weekDays\"><span>{$dayName[3]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[4]}</span></td><td class=\"calendar_weekDays\"><span>{$dayName[5]}</span></td><td class=\"calendar_weekDays\">
		<span>{$dayName[6]}</span></td></tr><tr>";
		//$result.= "<tr><td COLSPAN=7> </tr><tr ALIGN='center'>";
				
		$end = ($start_day > 4)? 6:5;

		for ($row=1;$row<=$end;$row++)
			{
				for ($col=1;$col<=7;$col++)
					{
						
						$t = isset($dates[$row][$col])?$dates[$row][$col]:"";	
            $t = trim($t); 

        
        $date = $this->curDate['year'].'-'.$this->curDate['month'].'-'.$t;

      	$result.= "\n<td class=\"calendar_simple\">";
        if(empty($t)){  $result.= '&nbsp;'; } else {   $result.= $t.'<input type="checkbox" name="data[selectedday]['.$date.']" value="1">&nbsp;';} 
        $result.= "</td>";

            
	}// for -col

				
				if (($row + 1) != ($end+1))
					$result.= "</tr>\n<tr align=\"center\">";
				else
					$result.= "</tr></table>";
			}// for - row
			return $result;
	}
  
  
  function buildQueryString(){
	$except=func_get_args();
		$query_string="";
		foreach($_GET as $name=>$value)
		{
			$continue=false;
			foreach ($except as $val) if ($val==$name){$continue=true;break;}
			if ($continue) continue;
			
			if (is_array($value))
			{
				foreach($value as $key=>$val)
				$query_string.="&amp;".$name."[".urlencode(stripslashes($key))."]=".urlencode(stripslashes($val));			
			}
			else
			$query_string.="&amp;".$name."=".urlencode(stripslashes($value));
		}
		return $query_string;
}      
  
  
}

?>