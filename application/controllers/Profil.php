<?php
class Profil extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('uzytkownicyModel');
  }

  public function index() {
    $this->uzytkownicyModel->sprawdz();
    $data['tytul']='Mój profil';
    $this->load->view('szablon/start',$data);
    $this->load->view('szablon/menu');
    $this->load->view('profil/index');
    $this->load->view('szablon/koniec');
  }

  public function wyloguj() {
    $this->uzytkownicyModel->wyloguj();
    redirect(site_url());
  }
}
