<?php
class Aukcje extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('uzytkownicyModel');
    $this->load->model('aukcjeModel');
  }

  public function index($nazwa=false) {
    $data['rodzaj']=$this->aukcjeModel->wczytajRodzaj($nazwa);
    $data['tytul']='Aukcje';
    if($data['rodzaj']) $data['tytul'].=' - '.ucfirst($nazwa);
    else $data['tytul']='Aukcje';
    $data['aukcje']=$this->aukcjeModel->wczytajWszystkieAukcje($data['rodzaj']);
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('aukcje/index');
    $this->load->view('szablon/koniec');
  }
}
