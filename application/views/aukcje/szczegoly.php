<?php
$rodzaj=$this->db->get_where('rodzaje',array('id'=>$aukcja['idRodzaju']))->row_array();
$wlasciciel=$this->db->get_where('uzytkownicy',array('id'=>$aukcja['idUzytkownika']))->row_array();
$wygrywajacy=$this->db->get_where('uzytkownicy',array('id'=>$aukcja['idWygrywajacego']))->row_array();
if($aukcja['zdjecie']) $zdjecie=base_url($aukcja['zdjecie']);
else $zdjecie=base_url('zdjecia/brak.png');
?>
<div class="container">
  <div class="col-xs-12 col-md-4">
    <img class="img-responsive" src="<?=$zdjecie?>">
  </div>
  <div class="col-xs-12 col-md-8">
    <h2><?=$aukcja['nazwa']?></h2>
    <p>Sprzedający: <?=$wlasciciel['imie'].' '.$wlasciciel['nazwisko']?></p>
    <p>Wygrywający: <?=$wygrywajacy['imie'].' '.$wygrywajacy['nazwisko']?></p>
    <p>Opis: <?=$aukcja['opis']?></p>
    <?php
    if($this->aukcjeModel->aktywna($aukcja['id'])) {
      if($this->session->userdata('zalogowany') && $this->session->userdata('id')!=$wlasciciel['id']) {
        switch($aukcja['idRodzaju']) {
          case '1':
          case '2': {
            ?>
            <?=form_open('aukcje/szczegoly/'.$aukcja['id'])?>
            <input class="form-control" type="number" name="cena" min="<?=($aukcja['cena']+0.01)?>" value="<?=$aukcja['cena']?>">
            <input class="btn btn-default" type="submit" name="podbij" value="Podbij cenę">
            </form>
            <?php
            break;
          }
          case '3': {
            ?>
            <ul class="list-group">
              <li class="list-group-item">Cena: <?=number_format($aukcja['cena'],2).' zł'?></li>
              <li class="list-group-item">Spadek co godzinę: <?=number_format($aukcja['zmianaCeny'],2).' zł'?></li>
            </ul>
            <?=form_open('aukcje/szczegoly/'.$aukcja['id'])?>
            <input class="btn btn-default" type="submit" name="kup" value="Kup teraz">
            </form>
            <?php
            break;
          }
        }
        ?>
        <div class="col-xs-12">
          <h3>Napisz wiadomość do sprzedającego</h3>
          <?=form_open('aukcje/szczegoly/'.$aukcja['id'])?>
            <textarea class="form-control" name="wiadomosc" rows="8" cols="80" style="resize: none;"></textarea>
            <input class="btn btn-default" type="submit" name="napisz" value="Napisz wiadomość">
          </form>
        </div>
        <?php
      }
      else {
        ?>
        <p><?=number_format($aukcja['cena'],2).' zł'?></p>
        <p>Działania związane z aukcjami tylko dla zalogowanych użytkowników.</p>
        <?php
      }
    }
    else {
      ?>
      <p>Cena: <?=number_format($aukcja['cena'],2).' zł'?></p>
      <p>Aukcja zakończona.</p>
      <?php
      if($this->session->userdata('zalogowany') && $this->session->userdata('id')!=$wlasciciel['id']) {
        ?>
        <div class="col-xs-12">
          <h3>Napisz wiadomość do sprzedającego</h3>
          <?=form_open('aukcje/szczegoly/'.$aukcja['id'])?>
            <textarea class="form-control" name="wiadomosc" rows="8" cols="80" style="resize: none;"></textarea>
            <input class="btn btn-default" type="submit" name="napisz" value="Napisz wiadomość">
          </form>
        </div>
        <?php
      }
    }
    ?>
  </div>
</div>
