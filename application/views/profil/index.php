<div class="container">
  <ul class="list-group">
    <li class="list-group-item"><strong>Imię:</strong> <?=$this->session->userdata('imie')?></li>
    <li class="list-group-item"><strong>Nazwisko:</strong> <?=$this->session->userdata('nazwisko')?></li>
  </ul>
  <div class="btn-group-vertical col-xs-12">
    <?=anchor('profil/dodaj','Dodaj aukcję',array('class'=>'btn btn-default'))?>
    <?=anchor('profil/aukcje','Moje aukcje',array('class'=>'btn btn-default'))?>
    <?=anchor('profil/historia','Moje zakupy',array('class'=>'btn btn-default'))?>
    <?=anchor('profil/wyloguj','Wyloguj',array('class'=>'btn btn-default'))?>
  </div>
</div>
