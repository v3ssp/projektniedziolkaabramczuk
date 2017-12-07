<div class="container">
  <div class="col-xs-12 col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Wszystkie rozmowy</h4>
      </div>
      <div class="panel-body">
        <ul class="list-group">
          <?php
          if($rozmowy) {
            foreach($rozmowy as $a) {
              ?>
              <li class="list-group-item"><?=$a['imie'].' '.$a['nazwisko']?> <?=anchor('wiadomosci/rozmowa/'.$a['id'],'Otwórz rozmowę',array('class'=>'btn btn-default'))?></li>
              <?php
            }
          }
          else {
            ?>
            <li class="list-group-item">Brak rozmów</li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Wiadomości</h4>
      </div>
      <div class="panel-body">
        <ul class="list-group">
          <?php
          if($wiadomosci) {
            foreach($wiadomosci as $a) {
              $uzytkownik=$this->db->get_where('uzytkownicy',array('id'=>$a['idNadawcy']))->row_array();
              ?>
              <li class="list-group-item">
                <h4><?=$uzytkownik['imie'].' '.$uzytkownik['nazwisko']?> <small><?=$a['data']?></small></h4>
                <p><?=$a['tresc']?></p>
              </li>
              <?php
            }
          }
          else {
            ?>
            <li class="list-group-item">Brak wiadomości</li>
            <?php
          }
          if($id) {
            ?>
            <li class="list-group-item">
              <?=form_open('wiadomosci/rozmowa/'.$id)?>
              <textarea class="form-control" style="resize: none" name="wiadomosc" rows="8"></textarea>
              <input class="btn btn-default" style="margin-top: 10px" type="submit" name="" value="Napisz wiadomość">
              </form>
              <?=validation_errors('<div class="alert alert-danger">','</div>')?>
            </li>
            <?php
          }
          ?>

        </ul>
      </div>
    </div>
  </div>
</div>
