<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid container-fluid-spacious">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand navbar-brand-emphasized" href="/" target="_blank">
         <?= SITE ?>
        </a>
      </div>
      
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">

           <?php if (is_null($this->request->session()->read('Auth.User.id'))) { ?>
              <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
              <li><?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'register']) ?></li>
            <?php } else { ?>
            <li><?php $session_userid = $this->request->session()->read('Auth.User.id'); echo $this->Html->link('Welcome '.$this->request->session()->read('Auth.User.firstname'), ['controller' => 'Users', 'action' => 'view', $session_userid]) ?></li>
            <li class="active"><a href="/logout">Logout</a></li>
            <?php } ?>
      
        </ul>

      </div>
    </div>
  </nav>