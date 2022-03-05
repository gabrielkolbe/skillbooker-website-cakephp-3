<?php
namespace App\Controller\Component;
use Cake\Controller\Component;


class FilereaderComponent extends Component
{

/**
 * Description of filereader
 * The file has following functions
 * 
 * Function 1 - reads each character
 * 1. charreader($filename)
 * Function 2 - reads each character into array
 * 2. chararrayreader($filename)
 * Function 3 - reads file contents into array
 * 3. arrayreader($filename)
 * Funtion 4 - searches for similar words/ phrase in file, case sensitive
 * 4. searchwordcase($filename, $words)
 * Funtion 5 - searches for similar words/ phrase in file, case insensitive
 * 5. searchwordnocase($filename, $words)
 * 
 * @author: GB
 * @email: ganeshsurfs@gmail.com
 * @Website: N.A.
 */


    public function charreader($filename){
        // Starting Function filecharreader here

        $files = fopen($filename,"r") or exit("Unable to open file!");        
        $filechar = array();
        while (!feof($files)){
            $filechar = fgetc($files);
            //echo $filechar;
            $filearray[] = $filechar;
        }                                 
        
        fclose($files);
        return $filearray;
        // ending function filecharreader here
    }
    
    
    /*
     * File Character read function returning array
     */
    
    
    public function chararrayreader($filename){
        // Starting Function filechararrayreader here

        $filesopen = fopen($filename,"r") or exit("Unable to open file!");        
        $filearray = "";
        while (!feof($filesopen)){
            $filechar = fgetc($filesopen);
            $filearray .= $filechar;
            // echo $filearray;
        }
        
        fclose($filesopen);
        return $filearray;
        // ending function filecharreader here
    }
    
    
    /*
     * File Complete Function Contents Reader
     */
    
    public function arrayreader($filename){
        // Starting Function filereader here

        $filearray = file_get_contents($filename);
        // TEST FUNCTION: Printing filearray character.
        // var_dump($filearray);
        return $filearray;

        // ending function filereader here
    }
    
    /*
     * SEARCH FOR SPECIFIC WORDS IN A TEXT FILE
     */
    
    public function searchwordcase($filename, $words){
        // Starting function WordSearch here

        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));        
        fclose($handle);

        $locations = array();
        $pos = strpos($contents, $words, $offset);
        while ($pos !== false) {
        $locations[] = $pos;
        //print_r($pos);
        $offset = $pos + 1;
        $pos = strpos($contents, $words, $offset);

        }
        return $locations;
        //print_r($locations);

        
    // Ending Function WordSearch here 
        
    }
    
    /*
     * SEARCH FOR SPECIFIC WORDS IN A TEXT FILE, case insensitive
     */
    
    public function searchwordnocase($filename, $words){
        // Starting function WordSearch here

        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));        
        //$word = "testing";
        fclose($handle);
        
        $content = strtoupper($contents);
        $word = strtoupper($words);
        $locations = array();
        $pos = strpos($content, $word, $offset);
        while ($pos !== false) {
        $locations[] = $pos;
        //print_r($pos);
        $offset = $pos + 1;
        $pos = strpos($content, $word, $offset);

        }

        return $locations;
        //print_r($locations);
        
    // Ending Function WordSearch here           
    }
    
     public function searchwordlowercase($filename, $words){
        
        $offset = 1;
        $content = 'a';
        if(is_string($filename)){
          $content = strtolower($filename);
        }
        $word = 'a';
        if(is_string($words)){
          $word = strtolower($words);
        }
        $locations = array();
        $searched_words = array();
        $pos = strpos($content, $word, $offset);
        while ($pos !== false) {
        $locations[] = $pos;
        $searched_words[] = $word;
        
        //print_r($pos);
        $offset = $pos + 1;
        $pos = strpos($content, $word, $offset);

        }

        //return $locations;
        return $searched_words;
        //print_r($locations);
        
     
    }   
    
    
// Closing File Reader Class  

  function comparewords($filename, $inwords){
    
    //$file = fopen($filename,"r");
    $file = "text if this works";
    
    $word = explode(' ', $file);
    
    foreach($word as $wordkey => $wordvalue){
      echo $wordvalue;
    }
    fclose($file);    

         
    }  
}

?>