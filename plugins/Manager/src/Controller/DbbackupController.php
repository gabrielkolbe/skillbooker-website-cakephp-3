<?php
namespace Manager\Controller;

use Manager\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class DbbackupController extends AppController
{

      public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $location = WWW_ROOT . '/sql_backup/';        
        $databasename = DEFAULT_DATABASE;
        
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
      
        $this->loadModel('Dbtables');
        $backups = $this->Dbtables->find('list',['conditions'=>['Dbtables.type' => 'database'], 'order'=>['Dbtables.id' => 'DESC']]);
        $this->set('backups', $backups);
        
        $dumps = $this->Dbtables->find('list',['conditions'=>['Dbtables.type' => 'dump'], 'order'=>['Dbtables.id' => 'DESC']]);
        $this->set('dumps', $dumps);
            
        $this->paginate = [
                'conditions'=>['Dbtables.type' => 'table'],
                'order' => ['Dbtables.id' => 'DESC']
        ];
    
        $entries = $this->paginate($this->Dbtables);

        $this->set(compact('entries'));
        $this->set('_serialize', ['entries']);
        
        $databasename = DEFAULT_DATABASE;
        
        $savedname = $databasename.'_'.date('Y-m-d');
        $this->set('savedname', $savedname);
    }
    
    
        public function restorefromdump()
    {
       if ($this->request->is('post')) {

       if(!empty($this->request->data['database_id'])) {
      
            
          $database_id= $this->request->data['database_id'];
          
          $this->loadModel('Dbtables');
          $database = $this->Dbtables->find('all',['conditions'=>['Dbtables.id' => $database_id, 'Dbtables.type' => 'dump']]);
          $database = $database->first();
          $database = $database->name;
          
          $location = WWW_ROOT . '/sql_dump/'; 
          $file  = $location.$database;

          $server_name   = DEFAULT_HOST;
          $username      = DEFAULT_DATABASE_USER;
          $password      = DEFAULT_DATABASE_PASSWORD;
          $databasename = DEFAULT_DATABASE;
          $mysqllocation = "C:/xampp/mysql/bin/";

          if( (DEBUGMODE == true) && (empty($password)) )  {
            $cmd = "{$mysqllocation}mysql -h {$server_name} -u {$username}  {$databasename} < {$file}.sql";
          } else {
            $cmd = "{$mysqllocation}mysql -h {$server_name} -u {$username} -p{$password} {$databasename} < {$file}.sql";
          } 
          

          exec($cmd);
          
          $this->Flash->success('Database Dump restored');
        }

          return $this->redirect(['action' => 'index']);
      }      
    }
    

    public function backuptodump()
    {
       if ($this->request->is('post')) {
       if(!empty($this->request->data['savedname'])) {
       
       
          $location = WWW_ROOT . '/sql_dump/';   
          $savedname= $this->request->data['savedname'];
          $file = $location.$savedname;
          
          
          $id = $this->insert_table($savedname, 'dump');
          

          $server_name   = DEFAULT_HOST;
          $username      = DEFAULT_DATABASE_USER;
          $password      = DEFAULT_DATABASE_PASSWORD;
          $databasename =  DEFAULT_DATABASE;
          $mysqllocation = "C:/xampp/mysql/bin/";
          
          if( (DEBUGMODE == true) && (empty($password)) )  {
          $cmd = "{$mysqllocation}mysqldump --routines -h {$server_name} -u {$username}  {$databasename} > {$file}.sql";
          } else {
          $cmd = "{$mysqllocation}mysqldump --routines -h {$server_name} -u {$username} -p{$password} {$databasename} > {$file}.sql";
          }
          
          
          exec($cmd);


          $this->Flash->success('Database Dump complete');

        
        }
        
          return $this->redirect(['action' => 'index']);
      }      
    }

   
    public function restorefromfile()
  {
      if ($this->request->is('post')) {
       if(!empty($this->request->data['database_id'])) {

          $database_id = $this->request->data['database_id'];
          $location = WWW_ROOT . '/sql_backup/';
          
          $this->loadModel('Dbtables');
          $backups = $this->Dbtables->find('list',['conditions'=>['Dbtables.id' => $database_id, 'Dbtables.type' => 'database']]);
          
          $i = 0;
          $conn = ConnectionManager::get('default');
          foreach($backups as $backup ) {
            
            $file = $location.$backup.'.sql';
            $read = fopen($file, "r") or die("Unable to open file!");

          while (!feof($read) ) {
          $line = fgets($read);
          
          $conn = ConnectionManager::get('default');
          $conn->begin();
  
          if(!empty($line)) {
            
            $conn->execute($line);
            
          }
          $conn->commit();
  
          }
        
            fclose($read);


            $i++;
          }
          
          $this->Flash->success($i.' Tables has been inserted');
        
        }
        return $this->redirect(['action' => 'index']);
      }           
  }
  
  
    public function backuptofile()
    {
       if ($this->request->is('post')) {
       if(!empty($this->request->data['savedname'])) {
            
          $savedname= $this->request->data['savedname'];
          
          $id = $this->insert_table($savedname, 'database');
          
          $databasename = DEFAULT_DATABASE;
          $this->back_up_db($databasename, $savedname, $id);

          $this->Flash->success('Database Dump complete');
          return $this->redirect(['action' => 'index']);
        
        }
        return $this->redirect(['action' => 'index']);  
      }      
    } 

 
    public function back_up_db($databasename, $savedname, $id)
    {
          $location = WWW_ROOT . '/sql_backup/';
          $tables = $this->mysql_list_db_tables($databasename);
            
            $i = 0;
            foreach($tables as $key => $name) {
            foreach($name as $keys => $table_name) {
  
              $file = fopen($location.$savedname.'_'.$table_name.".sql","w");
              $line_count = $this->create_backup_sql($file, $table_name);
              $this->insert_table($savedname.'_'.$table_name, 'table', $id);
              fclose($file);
              //$deletedate = $this->delete_date();
              //$delfile = $table_name.$deletedate.".sql";
             // unlink($sqllocation.$delfile);
             // $message = $table_name." lines written: ".$line_count."";
              $i++;
        
            }
            }
            
            $this->Flash->success($i.' Tables has been saved to file');
                   
    }
  
    public function mysql_list_db_tables($databasename) 
    {
      $tables = Array();
      $conn = ConnectionManager::get('default');
      $stmt = $conn->execute("SHOW TABLES FROM $databasename");
      $tables = $stmt->fetchAll('assoc');
      return $tables;
    }
  
    public function delete_date()
    {
        
        $todaysdate = strtotime(date('Y-m-d'));
        $tendaysago = ($todaysdate - (24 * 60 * 60 * 10));
        $deletedate = date ( 'Y-md-d' ,$tendaysago);   
        return $deletedate;
    
    }
  
  
  
    public function create_backup_sql($file, $table_name) 
    {
      $line_count = 0;
      $sql_string = NULL;
      $sql_string = "TRUNCATE $table_name;";
      $sql_string .= "\n";
      $conn = ConnectionManager::get('default');
      $result = $conn->execute("SELECT * FROM `$table_name`");
      $tables_result = $result->fetchAll('assoc');
          
      foreach($tables_result as $value) {
      
        $sql_string .= "INSERT INTO $table_name VALUES(";
        $first = TRUE;

        foreach($value as $key => $va) {

          if (TRUE == $first) {
            $sql_string .= "'".$this->stripit($va)."' ";
            $first = FALSE;            
          } else {
            $sql_string .= ", '".$this->stripit($va)."' ";
          }

        }
        $sql_string .= ");";
        $sql_string .= "\n";
        if ($sql_string != ""){
          $line_count = $this->write_backup_sql($file,$sql_string,$line_count);        
        }
        $sql_string = NULL;
      }    
   
      return $line_count;
  }
  
    public function stripit($value)
  {
      $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
      $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
  
      return str_replace($search, $replace, $value);
  }
  
  
   public function write_backup_sql($file, $string_in, $line_count) { 
      fwrite($file, $string_in);
      return ++$line_count;
  }
  
    
   public function insert_table($table_name, $type, $id=null) {
      /*
        $connection = ConnectionManager::get('default');
        $connection->insert('dbtables', [
        'name' => $table_name,
        'type' => $type,
        'created' => date('Y-m-d'),
        'modified' => date('Y-m-d') ]
      ); 
      */
      
      $Table = TableRegistry::get('dbtables');
      $insert = $Table->newEntity();
      
      $insert->name = $table_name;
      $insert->type = $type;
      
      if(!empty($id)) {
       $insert->database_id = $id;
      }
      
      $insert->created = date('Y-m-d');
      $insert->modified = date('Y-m-d');
      
      if ($Table->save($insert)) {
          $id = $insert->id;
          return $id;
      }
   
   }

/*   
     public function backuptable($table_name)
  {
      $location = WWW_ROOT . '/sql_backup/';
      $this->backuptable_action(DEFAULT_DATABASE, $location, $table_name);
      return $this->redirect(['action' => 'index']);
        
  }
  
    public function backuptable_action($sqllocation, $table_name)
  {
          
      $file = fopen($sqllocation.$table_name.".sql","w");
      $line_count = $this->create_backup_sql($file, $table_name);
      fclose($file);
      //$deletedate = $this->delete_date();
      //$delfile = $table_name.$deletedate.".sql";
     // unlink($sqllocation.$delfile);
      $message = $table_name." lines written: ".$line_count."";
      $this->Flash->success($message);  
           
  }
*/  
  
  public function restoretable($id)
  { 

      if(!empty($id)) {
       
        $this->loadModel('Dbtables');
        $table = $this->Dbtables->find('all',['conditions'=>['Dbtables.id' => $id, 'Dbtables.type' => 'table'], 'order'=>['Dbtables.id' => 'DESC']]);
        $table = $table->first();
        $table_name = $table->name;
        
        $location = WWW_ROOT . '/sql_backup/';
            
        $file = $location.$table_name.'.sql';
        
        $read = fopen($file, "r") or die("Unable to open file!");
        
        
        while (!feof($read) ) {
        $line = fgets($read);
        
        $conn = ConnectionManager::get('default');
        $conn->begin();

        if(!empty($line)) {
          
          $conn->execute($line);
          
        }
        $conn->commit();

        }  

        fclose($read);
        $this->Flash->success('Tables has been inserted');
        return $this->redirect(['action' => 'index']);      
      }      
  }


 

}
