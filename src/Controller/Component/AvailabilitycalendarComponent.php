<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;


class AvailabilitycalendarComponent extends Component {

  
  
function editCalendar($editme, $user_id, $startmonth='now',$startYear='now',$startDay='now') {


    $this->curDate = array();

		if (!isset($startmonth)){
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		} else {
			$this->curDate['month']=$startmonth;
    }
        
		if (!isset($startYear)){
			$this->curDate['year']=$startYear=='now'?date("Y"):$startYear;			 
		} else {
			$this->curDate['year']=$startYear;
    }
        
    $getevents = TableRegistry::get('User_Availability');
   
      $events = $getevents->find('all', [
      'fields' => ['event_date'],
       'conditions' => ['DATE_FORMAT(event_date,"%m")' => $this->curDate['month'], 'DATE_FORMAT(event_date,"%Y")' => $this->curDate['year'], 'user_id' => $user_id]                 
      ]);
      

      $days = array();
      foreach($events as $event){
        $eventdate = $event->event_date;
        $explode = explode("-", $eventdate);
        array_push($days, $explode['2']);
      }
      
     // dd($days);
      
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
  if($editme == 'yes') {
		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\" onClick=\"sendajax('/availability/edit/".date("m",$date_timestamp)."-".$temp_yr."')\">";
  } else {
		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\">";
  }

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
            
						if (in_array($t, $days)) {
							$result.= "\n<td class=\"calendar_link\">".$t."</td>";
						} else  {
              if( ($col == 1) || ($col == 7) ){
               	$result.= "\n<td class=\"calendar_weekend\">".(($t == "" )? "&nbsp;" :$t)."</td>";
              } else {
                $result.= "\n<td class=\"calendar_simple\">".(($t == "" )? "&nbsp;" :$t)."</td>";
              }

            }
					}
				
				if (($row + 1) != ($end+1))
					$result.= "</tr>\n<tr align=\"center\">";
				else
					$result.= "</tr></table>";
			}// for - row
			return $result;
	}


function insertCalendar($user_id, $startmonth='now',$startYear='now',$startDay='now') {

    $this->curDate = array();
		
		if (!isset($startmonth)){
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		} else {
			$this->curDate['month']=$startmonth;
    }
        
		if (!isset($startYear)){
			$this->curDate['year']=$startYear=='now'?date("Y"):$startYear;			 
		} else {
			$this->curDate['year']=$startYear;
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

		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\" id=\"insertcalendar\">";

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
        
              if( ($col == 1) || ($col == 7) ){
               	$result.= "\n<td class=\"calendar_weekend_select\">".(($t == "" )? "&nbsp;" :$t.'<input type="checkbox" name="selectedday['.$date.']" value="1">&nbsp;')."</td>"; 
              } else {
                $result.= "\n<td class=\"calendar_simple_select\">".(($t == "" )? "&nbsp;" :$t.'<input type="checkbox" name="selectedday['.$date.']" value="1">&nbsp;')."</td>"; 
              }
                     	     
       	    
              
      	 
	}// for -col

				
				if (($row + 1) != ($end+1))
					$result.= "</tr>\n<tr align=\"center\">";
				else
					$result.= "</tr></table>";
			}// for - row
			return $result;
	}

  
  
  function editTimesheet($editme='no', $slug, $file='editdays', $startmonth='now',$startYear='now',$startDay='now') {


    $this->curDate = array();

		if (!isset($startmonth)){
			$this->curDate['month']=$startmonth=='now'?date("n"):$startmonth;			 
		} else {
			$this->curDate['month']=$startmonth;
    }
        
		if (!isset($startYear)){
			$this->curDate['year']=$startYear=='now'?date("Y"):$startYear;			 
		} else {
			$this->curDate['year']=$startYear;
    }
        
    $time = TableRegistry::get('Timesheets');
   
      $timesheets = $time->find('all', [
       'conditions' => ['slug' => $slug]                 
      ]);
      
      $timesheets = $timesheets->first();

      $getdays = $timesheets->days;
      $days = explode(",", $getdays);

      
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
      
  if($editme == 'yes') {
		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\" onClick=\"sendajax('/timesheets/".$file."/".date("m",$date_timestamp)."-".$temp_yr."-".$slug."')\">";
  } else {
		$result= "<table summary=\"calendario\" border=\"0\" cellspacing=\"3\" cellpadding=\"1\" class=\"phpcalendar\">";
  }  




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
            
						if (in_array($t, $days)) {
							$result.= "\n<td class=\"calendar_link\">".$t."</td>";
						} else  {
              if( ($col == 1) || ($col == 7) ){
               	$result.= "\n<td class=\"calendar_weekend\">".(($t == "" )? "&nbsp;" :$t)."</td>";
              } else {
                $result.= "\n<td class=\"calendar_simple\">".(($t == "" )? "&nbsp;" :$t)."</td>";
              }
            }
					}
				
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