<div class="container">
  <?php
  if($aukcje) {
    foreach($aukcje as $a) {
      if($a['zdjecie']) $zdjecie=base_url($a['zdjecie']);
      else $zdjecie=base_url('zdjecia/brak.png');
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <?=$a['nazwa']?>
        </div>
        <div class="panel-body">
          <div class="col-xs-12 col-md-2">
            <img class="img-responsive" src="<?=$zdjecie?>" alt="zdjecie">
          </div>
          <div class="col-xs-12 col-md-10">
            <p>Opis: <?=$a['opis']?></p>
            <p>Cena: <?=number_format($a['cena'],2).' zł'?></p>
            <?php
            if($usuwanie) {
              echo anchor('profil/usun/'.$a['id'],'Usuń aukcję',array('class'=>'btn btn-default'));
            }
             ?>
          </div>
        </div>
      </div>
      <?php
    }
  }
  else {
    ?>
    <p>Nie wygrałeś/prowadzisz żadnej aukcji.</p>
    <?php
  }
  ?>
</div>
