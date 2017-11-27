<div class="container">
  <?=form_open(site_url('rejestracja'))?>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Imię</span>
      <input class="form-control" type="text" name="imie">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Nazwisko</span>
      <input class="form-control" type="text" name="nazwisko">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Login</span>
      <input class="form-control" type="text" name="login">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Hasło</span>
      <input class="form-control" type="password" name="haslo">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Powtórz hasło</span>
      <input class="form-control" type="password" name="powtorzHaslo">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <input class="btn btn-default col-xs-12" type="submit" value="Zarejestruj">
    </p>

  </form>
  <?=validation_errors('<div class="alert alert-danger">','</div>')?>
</div>
