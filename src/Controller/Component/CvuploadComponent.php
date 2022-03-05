<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use \SplFileObject;

class CVuploadComponent extends Component
{

public $components = ['Wordtotext', 'Filereader'];


public function upload_cv($user_id, $filename, $filetype, $tempPath, $uploadlocation, $default, $industry_id) 	{

			
					$resume		= '';
					$resumedata = array();
				
					if($filename !=''){
            
            if($this->getType($filetype) == true) {

              $path_info = pathinfo($filename);
              $ext = $path_info['extension'];
  						$file_name_without_ext = $path_info['filename'];
              
  						$new_file_name 			=	$file_name_without_ext.'_'.time().'.'.$ext;
  						if(move_uploaded_file($tempPath,$uploadlocation. $new_file_name)){ 
  							$resume		= 	$new_file_name;
  						} else {
  							$resume		= 	'';
  						}
            
            }
					}

					if($resume){
                
            $docText = $this->Wordtotext->convertToText($uploadlocation.$resume);

						if(empty($docText)) { $docText = 'empty'; }
						
            if(!empty($docText)) {
            
            $content = $this->cleanunwanted($docText);
                       
							$Table = TableRegistry::get('UserResumes');
              
              $resumes = $Table->find('all', [ 
              'conditions' => ['user_id' => $user_id]
              ]);
              $resumecount = $resumes->count();
              if($resumecount > 0){
              
               $Table->updateAll(['is_default' => 0], ['user_id' => $user_id]);
              
              }
      
      
              $addresume = $Table->newEntity();
              
              $addresume->user_id		=	$user_id;
							$addresume->name			=	$filename;
              $addresume->newname		=	$resume;
              $addresume->is_default =	$default;
							$addresume->content	=	$content;
              $addresume->modified	=	date('Y-m-d H:i:s');
              $addresume->created	=	date('Y-m-d H:i:s');

              if ($Table->save($addresume)) {

              }
              
              $Tableskills = TableRegistry::get('Skills');
              $skills = $Tableskills->find('all',
              ['fields'=>['Skills.id', 'Skills.name', 'Skills.slug'],
                'conditions'=>['Skills.industry_id' => $industry_id]
              ]);	


              
								foreach($skills as $skill) {
                
                   // debug($skill);
                  //  die;                
					
									$data =	array();
            										                  
                    $tempobject = $this->Filereader->searchwordlowercase($docText,$skill->slug);

										if(!empty($tempobject)) { 

                      $Table_us = TableRegistry::get('UserSkills');
											$skill_entry = $Table_us->find('all',['conditions'=>['user_id' => $user_id, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->user_id		=	$user_id;
          							$addskill->skill_id			=	$skill->id;
                        $addskill->skill_name	=	$skill->name;
          							$addskill->slug	=	$skill->slug;
                        $addskill->level	=	2;
          
          
                        if ($Table_us->save($addskill)) {}

											}
										}   
								}
				
						  } 
						} else { return 'error'; }
            
  return 'success';
  
 }
 
   function getType($filetype) {
      if( $filetype == 'text/plain' ) {
         return true;
      } elseif( $filetype == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ) {
         return true;
      } elseif( $filetype == 'application/pdf'  ) {
         return true;
      } elseif( $filetype == 'application/vnd.oasis.opendocument.text' ) {
         return true;
      } 
      return $ext;
   }
   
   
   function cleanunwanted($value)
  {
      $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
      $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
  
      return str_replace($search, $replace, $value);
  }
 

}
?>