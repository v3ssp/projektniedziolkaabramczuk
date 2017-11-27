<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=site_url()?>">Strona główna</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Aukcje<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?=anchor('aukcje','Wszystkie')?></li>
            <?php
            $rodzaje=$this->db->get('rodzaje')->result_array();
            foreach($rodzaje as $a) {
              ?>
              <li><?=anchor('aukcje/index/'.$a['nazwa'],ucfirst($a['nazwa']))?></li>
              <?php
            }
            ?>
          </ul>
        </li>
        <?php
        if($this->session->userdata('zalogowany')) {
          ?>
          <li><?=anchor('profil','<i class="glyphicon glyphicon-user"></i> '.$this->session->userdata('imie'))?></li>
          <li><?=anchor('wiadomosci','Wiadomości')?></li>
          <?php
        }
        else {
          ?>
          <li><?=anchor('rejestracja','Rejestracja')?></li>
          <li><?=anchor('logowanie','Logowanie')?></li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
