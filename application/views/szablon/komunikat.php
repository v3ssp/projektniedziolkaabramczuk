<?php
if($this->session->flashdata('komunikat')) {
  ?>
  <div class="container">
    <p>
      <strong>Komunikat: </strong> <?=$this->session->flashdata('komunikat')?>
    </p>
  </div>
  <?php
}
 ?>
