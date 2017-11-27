<div class="container">
  <?php
  if($aukcje) {
    foreach($aukcje as $a) {
      $rodzaj=$this->db->get_where('rodzaje',array('id'=>$a['idRodzaju']))->row_array();
      $wlasciciel=$this->db->get_where('uzytkownicy',array('id'=>$a['idUzytkownika']))->row_array();
      $wygrywajacy=$this->db->get_where('uzytkownicy',array('id'=>$a['idWygrywajacego']))->row_array();
      if($a['zdjecie']) $zdjecie=base_url($a['zdjecie']);
      else $zdjecie=base_url('zdjecia/brak.png');
      ?>
      <div class="panel panel-default">
        <div class="panel-heading"><?=$a['nazwa']?></div>
        <div class="panel-body">
          <div class="col-xs-12 col-md-4">
            <img class="img-responsive" src="<?=$zdjecie?>" alt="">
          </div>
          <div class="col-xs-12 col-md-8">
            <ul class="list-group">
              <li class="list-group-item">Rodzaj: <?=$rodzaj['nazwa']?></li>
              <li class="list-group-item">Wystawiający: <?=$wlasciciel['imie'].' '.$wlasciciel['nazwisko']?></li>
              <li class="list-group-item">Wygrywający: <?=$wygrywajacy['imie'].' '.$wygrywajacy['nazwisko']?></li>
              <li class="list-group-item">Obecna cena: <?=number_format($a['cena'],2).' zł'?></li>
              <li class="list-group-item"><?=anchor('aukcje/szczegoly/'.$a['id'],'Szczegóły',array('class'=>'btn btn-default'))?></li>
            </ul>
          </div>
        </div>
        <div class="panel-footer">Termin: <?=$a['doKiedy']?></div>
      </div>
      <?php
    }
  }
  else {
    ?>
    <p>Nie ma obecnie żadnych aukcji w zadanej kategorii.</p>
    <?php
  }
  ?>
</div>
