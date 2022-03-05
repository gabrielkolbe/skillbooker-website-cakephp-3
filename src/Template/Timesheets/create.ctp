<?PHP

 

  $days_between = ceil(abs($end - $start) / 86400);

  $daylength = '86400';





<strong><u>Consultant / Contractor Name</u></strong> asdfasdf<BR />

<strong><u>LTD Co. Name</u></strong>  asdfasdf<BR />

<strong><u>Client</u></strong>asdfasdf<BR />

<strong><u>Month</u></strong> asdfasdf   <BR />

<strong><u>To be Approved by</u></strong> <asdfasdf<BR />

<strong><u>To be Received by</u></strong> asdfasdf <BR />

<BR /><BR />

<table border="1" padding="8px" margin="5px" width="100%">

<tr>

  <td><strong>Dates</strong></td>

  <td><strong>Start Time</strong></td>

  <td><strong>Finish Time</strong></td>

  <td><strong>Break</strong></td>

  <td><strong>Hours</strong></td>

</tr>

<?PHP



 print "<tr ";

 $dayofweek = date("D", $start);

 if( ($dayofweek == 'Sun') || ($dayofweek == 'Sat') ) { print " style='background-color:#ccc;' "; } 

 print "><td>";



print  date("D, d M Y", $start);



  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $stime; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') )  { print $stime; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') )  { print $stime; }

  if ( ($dayofweek == 'Sun') && ($sunday == '') ) { $amountofdays = $amountofdays + 1; } 

  if ( ($dayofweek == 'Sat') && ($saterday == '') ) { $amountofdays = $amountofdays + 1;} 

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $ftime; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print $ftime; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print $ftime; }

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $break; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print $break; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print $break; }

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print  round($hours, 2); $totalhours = $totalhours + $hours; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print round($hours, 2); $totalhours = $totalhours + $hours;}

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print round($hours, 2); $totalhours = $totalhours + $hours;}

  print "</td>

</tr>";  



for ($i = 1; $i <= $days_between; $i++) {



print "<tr ";

$day = ($start + ($daylength * $i));

$dayofweek = date("D", $day);

if( ($dayofweek == 'Sun') || ($dayofweek == 'Sat') ) { print " style='background-color:#ccc;' "; } 

print "><td>";

print date("D, d M Y", $day);

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $stime; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') )  { print $stime; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') )  { print $stime; }

  if ( ($dayofweek == 'Sun') && ($sunday == '') ) { $amountofdays = $amountofdays + 1; } 

  if ( ($dayofweek == 'Sat') && ($saterday == '') ) { $amountofdays = $amountofdays + 1;} 

  

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $ftime; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print $ftime; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print $ftime; }

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print $break; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print $break; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print $break; }

  print "</td><td>&nbsp;";

  if ( ($dayofweek <> 'Sun') && ($dayofweek <> 'Sat') ) { print round($hours, 2); $totalhours = $totalhours + $hours; }

  if ( ($dayofweek == 'Sun') && ($sunday == 'on') ) { print round($hours, 2); $totalhours = $totalhours + $hours; }

  if ( ($dayofweek == 'Sat') && ($saterday == 'on') ) { print round($hours, 2); $totalhours = $totalhours + $hours; }

  print "</td>

</tr>"; 

}

?>

<tr>

  <td colspan="4" align="left"><strong>Total Hours</strong></td>

  <td><?PHP print round($totalhours, 2); ?></td>

</tr> 

<tr>

  <td colspan="4" align="left"><strong>Total Days</strong></td>

  <td><?PHP $amountofdays = ($days_between - $amountofdays) + 1; print $amountofdays; ?></td>

</tr> 

</table>

<BR />





<?PHP } ?>