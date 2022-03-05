<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

class CalendarController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
          $this->Auth->allow();
        
        $this->viewBuilder()->layout('front');
        
    }
    

     public function index($theyear = null)
    {      
        $this->loadModel('Events');
        $events = $this->Events->find('all');
        
        $calevents = array();
        
        foreach($events as $event){
          $eventdate = $event->eventdate;
         
          if ( (!empty($eventdate)) || ($eventdate > 0) ) {
            $startdate = $eventdate->i18nFormat('yyyy-M-d');
            $calevents[$startdate] = $startdate;
          }
        }
        
        
        //return debug($calevents);

$month=date('n');
if( (!empty($theyear)) && (is_numeric($theyear)) ) { $year = $theyear; } else { $year=date('Y'); }
$thisyear=date('Y');
$nextyear=$year + 1;
$prevyear=$year - 1;
$day=date('d');
$months=array('January','February','March','April','May','June','July','August','September','October','November','December');

$calendar = '<a href = "/calendar/index/'.$prevyear.'" style="font-family:Verdana; font-size:20pt; color:#ff9900;"><</a> ';
$calendar .= '<span align=center style="font-family:Verdana; font-size:18pt; color:#ff9900;">'.$year.' ';
$calendar .= ' <a href = "/calendar/index/'.$nextyear.'" style="font-family:Verdana; font-size:20pt; color:#ff9900;">></a>';
$calendar .= '</span>';
$calendar .= '<BR><span style="color:#0000cc;">Events are Blue</span><BR>';
$calendar .= '<section id="event-search" class="bg-img-9"> 
	               <div class="event-container"> 
                
                <div class="container" style="margin-bottom:20px;">';

for ($line=1; $line<=3; $line++) {
	$calendar .= '<div class="col-md-12"><div class="row">';
	for ($column=1; $column<=4; $column++) {
		$this_month=($line-1)*4+$column;
		$first=date('w',mktime(0,0,0,$this_month,1,$year));
		$total=date('t',mktime(0,0,0,$this_month,1,$year));
		if ($first==0) $first=7;
		$calendar .= '<div class="col-md-3">';
		$calendar .= '<table border=0 align=center style="font-size:8pt; font-family:Verdana;">';
		$calendar .=  '<th colspan=7 align=center style="font-size:12pt; font-family:Arial; color:#666699;">'.$months[$this_month-1].'</th>';
		$calendar .=  '<tr><td style="color:#666666"><b>Mon</b></td><td style="color:#666666"><b>Tue</b></td>';
		$calendar .=  '<td style="color:#666666"><b>Wed</b></td><td style="color:#666666"><b>Thu</b></td>';
		$calendar .=  '<td style="color:#666666"><b>Fri</b></td><td style="color:#0000cc"><b>Sat</b></td>';
		$calendar .=  '<td style="color:#cc0000"><b>Sun</b></td></tr>';
		$calendar .=  '<tr><br>';
		$i=1;
		while ($i<$first) {
			$calendar .=  '<td> </td>';
			$i++;
		}
		$i=1;
		while ($i<=$total) {
			$rest=($i+$first-1)%7;
      
      $dayid = $year.'-'.$this_month.'-'.$i;
            
			if (($i==$day) && ($this_month==$month)) {
      
      if (in_array($dayid, $calevents)) {    
				$calendar .= '<td style="font-size:8pt; font-family:Verdana; background:#0000cc;" align=center>';
      } else {
				$calendar .= '<td style="font-size:8pt; font-family:Verdana; background:#ff0000;" align=center>';
      }
      

			} else {
      
      if (in_array($dayid, $calevents)) {    
				$calendar .= '<td style="font-size:8pt; font-family:Verdana; background:#0000cc;" align=center>';
      } else {
				$calendar .= '<td style="font-size:8pt; font-family:Verdana" align=center>';
      }
      

			}
      
			if (($i==$day) && ($this_month==$month)) {
      
      
      if (in_array($dayid, $calevents)) {    
        $calendar .= '<a href="/calendar/day/'.$dayid.'" style="color:#fff;">'.$i.'</a>';
      } else {
       	$calendar .= '<span style="color:#fff;">'.$i.'</span>';
      }

			}	else if ($rest==6) {
      
      if (in_array($dayid, $calevents)) {    
        $calendar .= '<a href="/calendar/day/'.$dayid.'" style="color:#fff;">'.$i.'</a>';
      } else {
				$calendar .= '<span style="color:#0000cc">'.$i.'</span>';
      }
                      

			} else if ($rest==0) {
      

      if (in_array($dayid, $calevents)) {    
        $calendar .= '<a href="/calendar/day/'.$dayid.'" style="color:#fff;">='.$i.'</a>';
      } else {
				$calendar .= '<span style="color:#cc0000">'.$i.'</span>';
      }
      

			} else {
      
        if (in_array($dayid, $calevents)) {    
        $calendar .= '<a href="/calendar/day/'.$dayid.'" style="color:#fff;">'.$i.'</a>';
      } else {
        $calendar .= $i;
      }

			}
   
			$calendar .= "</td>\n";
			if ($rest==0) $calendar .= "</tr>\n<tr>\n";
			$i++;
		}
		$calendar .= '</tr>';
		$calendar .= '</table>';
		$calendar .= '</div>';
	}
	$calendar .= '</div></div>';
}

$calendar .= '</div></div></section>';

$this->set('calendar' , $calendar );

}

        public function day($day = null)
    {  
        $this->loadModel('Events');   
        $event = $this->Events->find('all', [
            'conditions' => ['Events.eventdate' => $day],
            'contain' => ['Images']
        ])->first();
         

        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }
     
}