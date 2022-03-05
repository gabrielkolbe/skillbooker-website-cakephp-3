<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Skills Controller
 *
 * @property \Jobs\Model\Table\SkillsTable $Skills
 */
class SyncController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('setstate', 'manager');  
        
    }
    
    public function isAuthorized($user)
    {
    
        if (isset($user['role_id']) && $user['role_id'] == '1') {
            return true;             
        } else {
          $this->Flash->error(__('Sorry, you dont have access to this page'));
          return $this->redirect(['plugin' => null, 'controller' => 'users', 'action' => 'login']);
        }
        
         return parent::isAuthorized($user);
    }   
     
     
    public function index()
    {
       
    }


    
public function runxml($action, $somecontent){


$filename = WWW_ROOT . '/files/'.$action.'.xml';
$delete = @unlink($filename);
if (@file_exists($filename))
{
  //$filesys = eregi_replace("/","\\",$filename);
  $filesys = preg_replace("/", "\\", $filename);
  $delete = @system("del $filesys");
  if (@file_exists($filename))
  {
    $delete = @chmod ($filename, 0775);
    $delete = @unlink($filename);
  	$delete = @system("del $filesys");
  }
}
 //the filename
//make the file, if it exists it will overwrite it
$fp = fopen($filename,"w") or die ("Error Opening File");

$somecontent = stripslashes($somecontent);
// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    if (fwrite($handle, $somecontent) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    fclose($handle);
} else {
    echo "The file $filename is not writable";
}

    $this->Flash->success('XML has been '.$action.' has been created');
    $this->render('Manager.Sync/index');
}

public function rsssoftwarexml(){
$this->loadModel('Softwares');
$softwares = $this->Softwares->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Software of all descriptions</description>
<language>en</language>';
  
  foreach($softwares as $software){ 
    
    $content = $this->cleanunwanted($software->short_description);
    $title = $this->cleanunwanted($software->name);
  
  $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/softwares/view/'.$software->slug.'</link>
    <description>'.$content.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	

  $runxml = $this->runxml('rss_software', $somecontent);
  
}

public function rssquestionsxml(){
$this->loadModel('Questions');
$questions = $this->Questions->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Software of all descriptions</description>
<language>en</language>';
  
  foreach($questions as $question){ 
    

    $title = $this->cleanunwanted($question->name);
  
  $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/questions/view/'.$question->slug.'</link>
    <description>'.$title.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	

  $runxml = $this->runxml('rss_questions', $somecontent);
  
}
   


public function rssjobxml(){
$this->loadModel('Jobs');
$jobs = $this->Jobs->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Jobs, Freelance Projects, Tutorials</description>
<language>en</language>';
  
  foreach($jobs as $job){ 
    
    $content = $this->cleanunwanted($job->description);
    $title = $this->cleanunwanted($job->title);
  
  $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/jobboard/jobs/view/'.$job->slug.'</link>
    <description>'.$content.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	

  $runxml = $this->runxml('rss_jobs', $somecontent);
  
}


public function rsstutorialxml(){
$this->loadModel('Tutorials');
$tutorials = $this->Tutorials->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Jobs, Freelance Projects, Tutorials</description>
<language>en</language>';
  
  foreach($tutorials as $tutorial){ 
    
    $content = $this->cleanunwanted($tutorial->content);
    $title = $this->cleanunwanted($tutorial->title);
  
    $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/jobboard/jobs/view/'.$tutorial->id.'</link>
    <description>'.$content.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	
  $runxml = $this->runxml('rss_tutorials', $somecontent);

}




public function syncdistinctjobskills(){
//sync jobs skills to Distrinct job skills
          
  $this->loadModel('Jobskills');
  $jobskills = $this->Jobskills->find('all');
  
  $this->loadModel('JobskillDistincts');
  $this->JobskillDistincts->deleteAll(['id > ' => 0]);
       
      if(!empty($jobskills)){
          foreach($jobskills as $skill){ 
          
              $Table = TableRegistry::get('JobskillDistincts');
							$check = $Table->find('all',['conditions'=>['skill_id' => $skill->skill_id]]);
              $entrycount = $check->count();
                  
              if($entrycount < 1) {
                  
                  $jobskilldistinct = $Table->newEntity();
                  
    							$jobskilldistinct->skill_id = $skill->skill_id;
                  $jobskilldistinct->skill_name		=	$skill->skill_name;
    					    $jobskilldistinct->slug		=	$skill->slug;
                  $jobskilldistinct->industry_id		=	$skill->industry_id;
                  
                  $Table->save($jobskilldistinct); 
             }    
          }
      }          
    $this->Flash->success(__('Job Skills has been distinct synced.'));
    $this->render('Manager.Sync/index');         
}


public function alljobcontentskills(){
//sync all jobs content for skills

    $i = 0;

    $this->loadModel('Jobskills');
    $this->Jobskills->deleteAll(['id > ' => 0]);

    $this->loadModel('Jobs');  
    $jobs = $this->Jobs->find('all');

    foreach($jobs as $job) {
    
    $docText = $job->description;
    $docText = $this->cleanunwanted($docText);
    
          $this->loadComponent('Filereader');                  
            
            $Tableskills = TableRegistry::get('Skills');
              $skills = $Tableskills->find('all');	
							//$skills =  $skills->toArray();
                
								foreach($skills as $skill) { 
                            			
                    $tempobject = $this->Filereader->searchwordlowercase($docText,$skill->slug);

										if(!empty($tempobject)) { 
                    
                      $Table_us = TableRegistry::get('Jobskills');
											$skill_entry = $Table_us->find('all',['conditions'=>['job_id' => $job->id, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->job_id		=	$job->id;
          							$addskill->skill_id			=	$skill->id;
                        $addskill->skill_name	=	$skill->name;
          							$addskill->slug	=	$skill->slug;
                        $addskill->industry_id =	$skill->industry_id;
                        $addskill->created =	$job->created;
                        $Table_us->save($addskill);         
                        $i++;
											}
										}
                      
								 }
                         
   }
   
   $this->Flash->success(__('Job content Skills has been distinct synced. '.$i)); 
   $this->render('Manager.Sync/index'); 
}


public function jobcontentskills(){
//sync unscanned jobs content for skills

    $i = 0;

    $this->loadModel('Jobs');  
    $jobs = $this->Jobs->find('all',[
    'conditions'=>['Jobs.scanned'=>0],
    ]);

    foreach($jobs as $job) {
    
    $docText = $job->description;
    $docText = $this->cleanunwanted($docText);
    
          $this->loadComponent('Filereader');                  
            
            $Tableskills = TableRegistry::get('Skills');
              $skills = $Tableskills->find('all');	
							//$skills =  $skills->toArray();
                
								foreach($skills as $skill) { 
                            			
            										                  
                    $tempobject = $this->Filereader->searchwordlowercase($docText,$skill->slug);

										if(!empty($tempobject)) { 
                    

                      $Table_us = TableRegistry::get('Jobskills');
											$skill_entry = $Table_us->find('all',['conditions'=>['job_id' => $job->id, 'slug'=>$skill->slug]]);
                      $entrycount = $skill_entry->count();
                        
                      if($entrycount < 1) {
                      
                        $addskill = $Table_us->newEntity();
                        
                        $addskill->job_id		=	$job->id;
          							$addskill->skill_id			=	$skill->id;
                        $addskill->skill_name	=	$skill->name;
          							$addskill->slug	=	$skill->slug;
                        $addskill->industry_id =	$skill->industry_id;
                        $addskill->created =	$job->created;
                        $Table_us->save($addskill);         
                        $i++;

											}
										}
                      
								 }
                
                
         
          $job->scanned = 1;
          $this->Jobs->save($job);        
   }
   
   $this->Flash->success(__('Job content Skills has been distinct synced. '.$i)); 
   $this->render('Manager.Sync/index'); 
}



   function industrydistinct()
  {

      
      $this->loadModel('Jobs');
      $jobs = $this->Jobs->find('all',[
      'fields'=>['Industries.name', 'Industries.id'],
      'join' => [
                    [
                      'table' => 'industries',
                      'alias' => 'Industries',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Jobs.industry_id = Industries.id'
                      ]
                    ]
      ]                  
      ]);
          

  $this->loadModel('IndustryDistincts');
  $this->IndustryDistincts->deleteAll(['id > ' => 0]);
      
      $i = 0; 
      if(!empty($jobs)){
          foreach($jobs as $job){
          
              $Table = TableRegistry::get('IndustryDistincts');
							$check = $Table->find('all',['conditions'=>['industry_id' => $job->Industries['id']]]);
              $getdistinct = $check->first();

              $entrycount = $check->count();
                  
              if($entrycount < 1) {
               
                  $i++;  
                  $distinct = $Table->newEntity();
    							$distinct->industry_id = $job->Industries['id'];
                  $distinct->name		=	$job->Industries['name'];
                  $distinct->job_counts		=	$i;
                  
                  $Table->save($distinct);
                   
              }  
          }
      }          
    $this->Flash->success(__('Industry has been distinct synced.'));
    $this->render('Manager.Sync/index');          
  
  
  }

   function countrydistinct()
  {
      
      $this->loadModel('Jobs');
      $jobs = $this->Jobs->find('all',[
      'fields'=>['Country.name', 'Country.id'],
      'join' => [
                    [
                      'table' => 'countries',
                      'alias' => 'Country',
                      'type' => 'LEFT',
                      'conditions' => [
                       'Jobs.country_id = Country.id'
                      ]
                    ]
      ]                  
      ]);
          

  $this->loadModel('CountryDistincts');
  $this->CountryDistincts->deleteAll(['id > ' => 0]);
      
      $i = 0; 
      if(!empty($jobs)){
          foreach($jobs as $job){
          
              $Table = TableRegistry::get('CountryDistincts');
							$check = $Table->find('all',['conditions'=>['country_id' => $job->Country['id']]]);
              $getdistinct = $check->first();

              $entrycount = $check->count();
                  
              if(($entrycount < 1) && ($job->Country['id'] > 0) ) {
               
                  $i++;  
                  $distinct = $Table->newEntity();
    							$distinct->country_id = $job->Country['id'];
                  $distinct->name		=	$job->Country['name'];
                  $distinct->job_counts		=	$i;
                  
                  $Table->save($distinct);
                   
              }  
          }
      }          
    $this->Flash->success(__('Country has been distinct synced.'));
    $this->render('Manager.Sync/index');          
  
  
  }
  
  
  public function syncdistinctprojectskills(){
//sync jobs skills to Distrinct job skills
          
  $this->loadModel('Projectskills');
  $projectskills = $this->Projectskills->find('all');
  
  $this->loadModel('ProjectskillDistincts');
  $this->ProjectskillDistincts->deleteAll(['id > ' => 0]);
       
      if(!empty($projectskills)){
          foreach($projectskills as $skill){ 
          
              $Table = TableRegistry::get('ProjectskillDistincts');
							$check = $Table->find('all',['conditions'=>['skill_id' => $skill->skill_id]]);
              $entrycount = $check->count();
                  
              if($entrycount < 1) {
                  
                  $projectskilldistinct = $Table->newEntity();
                  
    							$projectskilldistinct->skill_id = $skill->skill_id;
                  $projectskilldistinct->skill_name		=	$skill->skill_name;
    					    $projectskilldistinct->slug		=	$skill->slug;
                  $projectskilldistinct->industry_id		=	$skill->industry_id;
                  
                  $Table->save($projectskilldistinct); 
             }    
          }
      }          
    $this->Flash->success(__('Project Skills has been distinct synced.'));
    $this->render('Manager.Sync/index');         
}





   function cleanunwanted($value)
  {
      $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
      $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
  
      $value = str_replace($search, $replace, $value);
  
      $remove = array('&nbsp;', 'rnrn', '&pound;', '&ndash;', '&rsquo;', '&middot;', '&lsquo;', '&bull;', '&amp;', '&#39;', '&ldquo;', '&rdquo;', '&', ' lt;', ' gt;', 'quot;', '    ', '  ',  ' ');
      $value = str_replace($remove, ' ', $value);
      
      $value = strip_tags(preg_replace("/&(?!#?[a-z0-9]+;)/", "&amp;",$value));
      
      return $value;
    
  }


public function rssprojectxml(){

$this->loadModel('Projects');
$projects = $this->Projects->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Freelance Projects, Freelance work, website builders, website design, logo design</description>
<language>en</language>';
  
  foreach($projects as $project){ 
  
            if(!empty($project->stage1)){
              $content = $project->stage1;
            }
            if(!empty($project->stage2)){
              $content = $content.$project->stage2;
            }
            if(!empty($project->stage3)){
              $content = $content.$project->stage3;
            }
            if(!empty($project->stage4)){
              $content = $content.$project->stage4;
            }
    
    $content = $this->cleanunwanted($content);
    $title = $this->cleanunwanted($projects->name);
  
  $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/projects/fullview/'.$project->slug.'</link>
    <description>'.$content.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	

  $runxml = $this->runxml('rss_projects', $somecontent);
  
}


public function rssexpiredjobsxml(){

$this->loadModel('Expiredjobs');
$jobs = $this->Expiredjobs->find('all');

$somecontent = '<?xml version="1.0" encoding="UTF-8"?'.'> ';
$somecontent = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>Skillbooker.com</title>
<link>http://Skillbooker.com</link>
<description>Jobs, php jobs, contact jobs, permanent jobs, java jobs, javascript jobs, Tutorials</description>
<language>en</language>';
  
  foreach($jobs as $job){ 
    
    $content = $this->cleanunwanted($job->description);
    $title = $this->cleanunwanted($job->title);
  
  $somecontent .= '
  <item>
    <title>'.$title.'</title>
    <link>http://www.skillbooker.com/jobboard/jobs/view/'.$job->slug.'</link>
    <description>'.$content.'</description>
  </item>';
    }
  $somecontent .= '
</channel>
</rss>';
	

  $runxml = $this->runxml('rss_expiredjobs', $somecontent);
  
}


public function syncdistinctquestionkills(){
//sync jobs skills to Distrinct job skills
          
  $this->loadModel('QuestionSkills');
  $skills = $this->QuestionSkills->find('all');
  
  $this->loadModel('QuestionskillDistincts');
  $this->QuestionskillDistincts->deleteAll(['id > ' => 0]);
       
      if(!empty($skills)){
          foreach($skills as $skill){ 
          
              $Table = TableRegistry::get('QuestionskillDistincts');
							$check = $Table->find('all',['conditions'=>['skill_id' => $skill->skill_id]]);
              $entrycount = $check->count();
                  
              if($entrycount < 1) {
                  
                  $questionkilldistinct = $Table->newEntity();
                  
    							$questionkilldistinct->skill_id = $skill->skill_id;
                  $questionkilldistinct->skill_name		=	$skill->skill_name;
    					    $questionkilldistinct->slug		=	$skill->slug;
                  $questionkilldistinct->industry_id		=	$skill->industry_id;
                  
                  $Table->save($questionkilldistinct); 
             }    
          }
      }          
    $this->Flash->success(__('Question Skills has been distinct synced.'));
    $this->render('Manager.Sync/index');         
}


public function syncdistinctuserkills(){
          
  $this->loadModel('UserSkills');
  $skills = $this->UserSkills->find('all');
  
  $this->loadModel('UserskillDistincts');
  $this->UserskillDistincts->deleteAll(['id > ' => 0]);
       
      if(!empty($skills)){
          foreach($skills as $skill){ 
          
              $Table = TableRegistry::get('UserskillDistincts');
							$check = $Table->find('all',['conditions'=>['skill_id' => $skill->skill_id]]);
              $entrycount = $check->count();
                  
              if($entrycount < 1) {
                  
                  $skilldistinct = $Table->newEntity();
                  
    							$skilldistinct->skill_id = $skill->skill_id;
                  $skilldistinct->skill_name		=	$skill->skill_name;
    					    $skilldistinct->slug		=	$skill->slug;
                  $skilldistinct->created		=	date();
                  
                  $Table->save($skilldistinct); 
             }    
          }
      }          
    $this->Flash->success(__('User Skills has been distinct synced.'));
    $this->render('Manager.Sync/index');         
}

}
