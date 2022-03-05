<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class RemovehtmlComponent extends Component
{
   
function cleanhtml($text){

    $text = str_replace("<p>&nbsp;</p>", "", $text); 
    $find =  array("justify", "Verdana, sans-serif", " style=", "font-size", "font-family", "mso-ansi-language", "mso-bidi-font-size", "EN-US", "<div>" , "</div>" , "<div " , "</div " ,  "class=" , "<!--" , "<xml>" , "<w:", "-->", "'", "<?", "<table", "<Table", "<TABLE", "<ta", "<TA", "MsoHeader", "0cm" , "0pt" , "margin", "text-indent", "MsoNormal", "0in", "tab-stops", "Arial", "mso-bidi", " pt ", "mso-list", "Times New Roman", "mso-spacerun", "lang=", "x-small", "id=", "line-height: ", "align=", "text-align:", "<h1", "</h1>", "\r" , "\n");
    $text = trim($text);
    $text = str_replace($find, ' ', $text);
    $text = str_replace('"', '&#39;', $text);
    $text = str_replace("'", "&#39;", $text); 
    $text = stripslashes($text);
    //$text = strip_tags($text);
    //$text = htmlspecialchars($var,ENT_QUOTES);
    
      
      return $text;

} 

   
}
?>