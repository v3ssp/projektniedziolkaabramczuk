<div class="container">
  <?=form_open_multipart(site_url('profil/dodaj'))?>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Nazwa</span>
    <input class="form-control" type="text" name="nazwa" >
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Rodzaj</span>
    <select class="form-control" name="rodzaj">
      <?php
      foreach($rodzaje as $a) {
        ?>
        <option value="<?=$a['id']?>"><?=$a['nazwa']?></option>
        <?php
      }
      ?>
    </select>
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Opis</span>
    <textarea class="form-control" name="opis" rows="4"></textarea>
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Cena</span>
    <input class="form-control" type="number" min="1" name="cena">
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Minimalna cena*</span>
    <input class="form-control" type="number" min="1" name="minimalnaCena">
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Zmiana ceny**</span>
    <input class="form-control" type="number" min="1" name="zmianaCeny">
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Do kiedy</span>
    <input class="form-control" type="date" name="doKiedy" placeholder="yyyy-mm-dd">
  </p>

  <p class="input-group col-xs-12">
    <span class="input-group-addon">Zdjęcie</span>
    <input class="form-control" type="file" name="zdjecie" accept="image/*">
  </p>

  <p class="input-group col-xs-12">
    <input class="btn btn-default col-xs-12" type="submit" value="Dodaj aukcję">
  </p>

  <p>* - dotyczy tylko aukcji z ceną minimalną</p>
  <p>** - dotyczy tylko aukcji holenderskich</p>
  <p>Jeśli nie pokrywa się kategoria, wpisz dowolną liczbę</p>
  </form>
  <?=validation_errors('<div class="alert alert-danger">','</div>')?>
</div>
