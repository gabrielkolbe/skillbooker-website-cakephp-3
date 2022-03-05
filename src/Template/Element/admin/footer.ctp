<BR><BR>

<div class="container-fluid container-fluid-spacious">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; <?= date('Y') ?> - <?= $sitename ?></span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                 <?php
                foreach ($footer_tab as $row) { 
                if($row->changestate == 1){
                  if (is_null($this->request->session()->read('Auth.User.id'))) {
                    echo '<li><a class="page-scroll" href="'.$row->taburl.'">'.$row->title.'</a></li>';
                   } else {
                      if(!empty($row->change_url)) { echo '<li><a class="page-scroll" href="'.$row->change_url.'">'.$row->change_title.'</a></li>'; }
                   }
                } else {
                 echo '<li><a class="page-scroll" href="'.$row->taburl.'">'.$row->title.'</a></li>';
                }    
                }
                ?>
                </ul>
            </div>
        </div>
</div>