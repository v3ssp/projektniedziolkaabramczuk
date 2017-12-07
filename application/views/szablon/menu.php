<?php
$this->session->set_userdata('aktualnaStrona',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
 ?>
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
          $powiadomienia=$this->db->get_where('powiadomienia',array('idUzytkownika'=>$this->session->userdata('id')))->result_array();
          ?>
          <li><?=anchor('profil','<i class="glyphicon glyphicon-user"></i> '.$this->session->userdata('imie'))?></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              &nbsp;<i class="glyphicon glyphicon-globe"></i>
              <sup><span class="label label-default"><?=count($powiadomienia)?></span></sup>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <?php foreach($powiadomienia as $a) {
                ?>
                <li>
                  <?=anchor('aukcje/szczegoly/'.$a['idAukcji'],$a['tresc'].' - zobacz aukcję')?>
                  <?=anchor('profil/oznacz/'.$a['id'],'<i class="glyphicon glyphicon-chevron-up"></i>Oznacz jako przeczytane')?>
                </li>
                <?php
              } ?>
            </ul>
          </li>
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
