<div class="container">
  <?=form_open('logowanie')?>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Login</span>
      <input class="form-control" type="text" name="login">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <span class="input-group-addon">Hasło</span>
      <input class="form-control" type="password" name="haslo">
    </p>

    <p class="input-group col-xs-12 col-md-6 col-md-offset-3">
      <input class="btn btn-default col-xs-12" type="submit" value="Zaloguj">
    </p>
    
  </form>
  <?=validation_errors('<div class="alert alert-danger">','</div>')?>
</div>
