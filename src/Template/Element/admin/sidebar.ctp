<style>
.menu_hide {
display:none;
}
</style>
<?php
  
$active_manager = '';
$active_jobs = '';
$active_candidates = '';
$active_projects = '';
$active_softwares = '';
$active_questions = '';
$active_tutorials = '';
$active_invoices = '';
$active_timesheets = '';
   
$menu_manager = 'menu_hide';
$menu_jobs = 'menu_hide';
$menu_candidates = 'menu_hide';
$menu_projects = 'menu_hide';
$menu_softwares = 'menu_hide';
$menu_questions = 'menu_hide';
$menu_tutorials = 'menu_hide';
$menu_invoices = 'menu_hide';
$menu_timesheets = 'menu_hide';
 
switch ($setstate) {
    case 'manager':
        $active_manager = 'active';
        $menu_manager = 'active';
        break; 
    case 'jobs':
        $active_jobs = 'active';
        $menu_jobs = 'active';
        break;
  case 'candidates':
        $active_candidates = 'active';
        $menu_candidates = 'active';
        break;
  case 'projects':
        $active_projects = 'active';
        $menu_projects = 'active';
        break;
  case 'softwares':
        $active_softwares = 'active';
        $menu_softwares = 'active';
        break;
  case 'questions':
        $active_questions = 'active';
        $menu_questions = 'active';
        break;
   case 'tutorials':
        $active_tutorials = 'active';
        $menu_tutorials = 'active';
        break; 
  case 'invoices':
        $active_invoices = 'active';
        $menu_invoices = 'active';
        break; 
  case 'timesheets':
        $active_timesheets = 'active';
        $menu_timesheets = 'active';
        break;               
}

?>
 <nav class="sidebar-nav">
          <div class="sidebar-header">
            <button class="nav-toggler nav-toggler-sm sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-sm">
              <span class="sr-only">Toggle nav</span>
            </button>
          </div>

          <div class="collapse nav-toggleable-sm" id="nav-toggleable-sm">

            <ul id="nav_sidebar" class="nav nav-pills nav-stacked">
                        
                
                <li  class="<?= $active_manager?>"><a href="#" class="subtitle">Manager</a>
                  <ul class="nav_sidebar <?= $menu_manager ?>">
                    <li><?= $this->Html->link('Site Settings',['plugin' => 'manager', 'controller' => 'sitesettings', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('User Credit',['plugin' => 'manager', 'controller' => 'UserCredit', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Email Inbox',['plugin' => 'manager', 'controller' => 'Inbox', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Email Outgoing',['plugin' => 'manager', 'controller' => 'email_templates', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Email Logs',['plugin' => 'manager', 'controller' => 'email_logs', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Email Layouts',['plugin' => 'manager', 'controller' => 'email_layouts', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Users',['plugin' => 'manager', 'controller' => 'users', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Messengers',['plugin' => 'manager', 'controller' => 'messengers', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Roles',['plugin' => 'manager', 'controller' => 'roles', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Custom Pages',['plugin' => 'manager', 'controller' => 'Custompages', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Tabs',['plugin' => 'manager', 'controller' => 'Tabs', 'action' => 'index']) ?></li> 
                    <li><?= $this->Html->link('Navigation',['plugin' => 'manager', 'controller' => 'navigations', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Countries',['plugin' => 'manager', 'controller' => 'countries', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Counties / States',['plugin' => 'manager', 'controller' => 'states', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Url Controllers',['plugin' => 'manager', 'controller' => 'urlcontrollers', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Url Views',['plugin' => 'manager', 'controller' => 'urlviews', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Images',['plugin' => 'manager', 'controller' => 'images', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Payments',['plugin' => 'manager', 'controller' => 'payments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Sales Options',['plugin' => 'manager', 'controller' => 'salesoptions', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Sync',['plugin' => 'manager', 'controller' => 'Sync', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('DB backup',['plugin' => 'manager', 'controller' => 'Dbbackup', 'action' => 'index']) ?></li>
                  </ul>
                </li>

                <li  class="<?= $active_projects ?>"><a href="#" class="subtitle">Projects</a>
                  <ul class="nav_sidebar <?= $menu_projects?>">
                    <li><?= $this->Html->link('Projects',['plugin' => 'manager', 'controller' => 'projects', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Project Templates',['plugin' => 'manager', 'controller' => 'project_templates', 'action' => 'index']) ?></li>
                  </ul>
                </li>
                
              <li  class="<?= $active_softwares ?>"><a href="#" class="subtitle">Softwares</a>
                  <ul class="nav_sidebar <?= $menu_softwares?>">
                    <li><?= $this->Html->link('Softwares',['plugin' => 'manager', 'controller' => 'Softwares', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Categories',['plugin' => 'manager', 'controller' => 'software_categories', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Features',['plugin' => 'manager', 'controller' => 'software_features', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Deployments',['plugin' => 'manager', 'controller' => 'software_deployments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Price Types',['plugin' => 'manager', 'controller' => 'software_pricetypes', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Supports',['plugin' => 'manager', 'controller' => 'software_supports', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Training',['plugin' => 'manager', 'controller' => 'software_trainings', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Demo Options',['plugin' => 'manager', 'controller' => 'software_demooptions', 'action' => 'index']) ?></li>
                  </ul>
                </li>

              <li  class="<?= $active_questions ?>"><a href="#" class="subtitle">Questions</a>
                  <ul class="nav_sidebar <?= $menu_questions?>">
                    <li><?= $this->Html->link('Questions',['plugin' => 'manager', 'controller' => 'Questions', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Answers',['plugin' => 'manager', 'controller' => 'question_answers', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Comments',['plugin' => 'manager', 'controller' => 'question_comments', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Skills',['plugin' => 'manager', 'controller' => 'question_skills', 'action' => 'index']) ?></li>
                  </ul>
                </li>
                
              <li  class="<?= $active_tutorials ?>"><a href="#" class="subtitle">Tutorials</a>
                  <ul class="nav_sidebar <?= $menu_tutorials?>">
                    <li><?= $this->Html->link('Tutorials',['plugin' => 'manager', 'controller' => 'Tutorials', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Tutorial Categories',['plugin' => 'manager', 'controller' => 'Tutorial_categories', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Tutorial Images',['plugin' => 'manager', 'controller' => 'Tutorial_images', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Tutorial Comments',['plugin' => 'manager', 'controller' => 'tutorial_comments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Tutorial Skills',['plugin' => 'manager', 'controller' => 'tutorial_skills', 'action' => 'index']) ?></li>

                  </ul>
                </li>     
            
            
                  <li  class="<?= $active_jobs ?>"><a href="#" class="subtitle">Jobs</a>
                  <ul class="nav_sidebar <?= $menu_jobs?>">
                    <li><?= $this->Html->link('Jobs',['plugin' => 'jobs', 'controller' => 'Jobs', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Applications',['plugin' => 'jobs', 'controller' => 'Jobapplications', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Job Type',['plugin' => 'jobs', 'controller' => 'Jobtypes', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Payment Intervals',['plugin' => 'jobs', 'controller' => 'Paymentintervals', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Salary Desc',['plugin' => 'jobs', 'controller' => 'Salarydescs', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Date Desc',['plugin' => 'jobs', 'controller' => 'Datedescs', 'action' => 'index']) ?></li> 
                    <li><?= $this->Html->link('Recruitment Progress',['plugin' => 'jobs', 'controller' => 'Recruitmentprogress', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Companies',['plugin' => 'jobs', 'controller' => 'Companies', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Contact Methods',['plugin' => 'jobs', 'controller' => 'Contactmethods', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Industries',['plugin' => 'jobs', 'controller' => 'Industries', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Sub industries',['plugin' => 'jobs', 'controller' => 'Subindustries', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Skills',['plugin' => 'jobs', 'controller' => 'Skills', 'action' => 'index']) ?></li>

                  </ul>
                </li>
                
                <li  class="<?= $active_candidates ?>"><a href="#" class="subtitle">Candidates</a>
                  <ul class="nav_sidebar <?= $menu_candidates?>">
                    <li><?= $this->Html->link('Candidates',['plugin' => 'Candidates', 'controller' => 'Candidates', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Status',['plugin' => 'Candidates', 'controller' => 'User_statuses', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Sources',['plugin' => 'Candidates', 'controller' => 'User_sources', 'action' => 'index']) ?></li>                    
                    <li><?= $this->Html->link('Ratings',['plugin' => 'Candidates', 'controller' => 'User_ratings', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Resumes',['plugin' => 'Candidates', 'controller' => 'User_resumes', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Employments',['plugin' => 'Candidates', 'controller' => 'User_employments', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Qualifications',['plugin' => 'Candidates', 'controller' => 'User_qualifications', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Publications',['plugin' => 'Candidates', 'controller' => 'User_publications', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Availability',['plugin' => 'Candidates', 'controller' => 'User_availability', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Articles',['plugin' => 'Candidates', 'controller' => 'User_articles', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Articles Categories',['plugin' => 'Candidates', 'controller' => 'User_article_categories', 'action' => 'index']) ?></li>
                  </ul>
                </li>
                
              <li  class="<?= $active_invoices ?>"><a href="#" class="subtitle">Invoices</a>
                  <ul class="nav_sidebar <?= $menu_invoices?>">
                    <li><?= $this->Html->link('Invoices',['plugin' => 'manager', 'controller' => 'invoices', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Invoice Entries',['plugin' => 'manager', 'controller' => 'invoice_entries', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Invoice Status',['plugin' => 'manager', 'controller' => 'invoice_statuses', 'action' => 'index']) ?></li>
                  </ul>
                </li>

                  <li  class="<?= $active_timesheets ?>"><a href="#" class="subtitle">Timesheets</a>
                  <ul class="nav_sidebar <?= $menu_timesheets?>">
                    <li><?= $this->Html->link('Timesheets',['plugin' => 'manager', 'controller' => 'timesheets', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Timesheet Users',['plugin' => 'manager', 'controller' => 'timesheet_users', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Timesheet Processes',['plugin' => 'manager', 'controller' => 'timesheet_processes', 'action' => 'index']) ?></li>
                  </ul>
                </li>

            </ul>
            <hr class="visible-xs m-t">
          </div>
        </nav>